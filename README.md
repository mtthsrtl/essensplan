# 🍽️ Essensplan – Webapp

Leichtgewichtig, ohne Frameworks, mit Drag and Drop. Datenspeicherung per PHP in einer JSON. Optional als PWA installierbar.

---

## 🎬 Demo

![Essensplan Demo](./essensplan.gif)

*(Das GIF zeigt Drag & Drop, Pool, Tagesansicht und die Historie in Aktion.)*

---

## Features

- Drag and Drop von Mahlzeiten in Tage
- 8 Tage sichtbar, 4 Spalten oben und 4 unten, immer ab heute
- Maximal 2 Mahlzeiten pro Tag, hart begrenzt
- Pool zeigt nur Mahlzeiten, die nicht bereits geplant sind
- Historie: abgelaufene Tage wandern nach `history`, bleiben für Auswertungen erhalten
- Seite zur Pflege der Mahlzeiten, hinzufügen, bearbeiten, löschen
- Burger Menü oben links, mobil tauglich
- PWA fähig, Icons und Manifest enthalten
- Keine externen Frameworks, nur Vanilla JS und SortableJS

---

## Projektstruktur

```text
essensplan/
├─ index.html            # Hauptansicht mit Tagen und Pool
├─ meals.html            # Verwaltung der Mahlzeiten
├─ history.html          # Kalenderartige Historie
├─ api.php               # JSON laden und speichern
├─ data.json             # Persistente Daten: meals, plan, history
├─ manifest.json         # PWA Manifest
├─ service-worker.js     # Service Worker optional
└─ img/
   ├─ back.jpg           # Hintergrund
   ├─ favicon.ico
   ├─ icon.png
   ├─ icon-512.png
   ├─ essensplan.gif     # Demo GIF
   └─ …                  # Weitere Bilder der Mahlzeiten
````

## Anforderungen

- Webserver mit PHP 8, Apache oder Nginx
- Schreibrechte für `data.json` durch den Webserver Nutzer
- SortableJS wird via CDN geladen

---

## Installation

1. Repository in das Webroot kopieren, z. B. `/var/www/html/essensplan`.
2. Schreibrechte für `data.json` setzen:
   ```bash
   sudo chown www-data:www-data /var/www/html/essensplan/data.json
   sudo chmod 664 /var/www/html/essensplan/data.json
Seite aufrufen:

arduino
Code kopieren
https://deine-domain/essensplan/
Datenformat
Beispiel data.json:
```text
{
  "meals": [
    { "id": 1, "name": "Spaghetti", "image": "img/spaghetti.jpeg" },
    { "id": 2, "name": "Pizza",     "image": "img/pizza.jpeg" }
  ],
  "plan": {
    "2025-09-25": [1],
    "2025-09-26": [2]
  },
  "history": {
    "2025-09-20": [2]
  }
}
```

Nutzung
Auf index.html kannst du Mahlzeiten aus dem Pool per Drag and Drop in die Tage ziehen.

Pro Tag sind maximal 2 Einträge erlaubt. Ein dritter Drop wird abgewiesen, die Fläche zeigt kurz ein Schloss an.

Alte Tage werden beim Laden erkannt, nach history verschoben, die Mahlzeiten erscheinen wieder im Pool.

Über das Burger Menü:

Aktualisieren lädt Daten neu und schließt das Menü

Mahlzeiten öffnet meals.html zum Pflegen der Stammdaten

history.html zeigt die Historie in einem kompakten Kalendergrid.

Lizenz
MIT License
