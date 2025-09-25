<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$file = __DIR__ . "/data.json";

// GET = Daten laden
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (file_exists($file)) {
        echo file_get_contents($file);
    } else {
        echo json_encode(
            ["meals" => [], "plan" => []],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }
    exit;
}

// POST = Daten speichern
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = file_get_contents("php://input");
    if ($input) {
        $data = json_decode($input, true);
        if ($data !== null) {
            file_put_contents(
                $file,
                json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            );
            echo json_encode(["status" => "ok"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Invalid JSON"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "No input"]);
    }
    exit;
}

http_response_code(405);
echo json_encode(["error" => "Method not allowed"]);
