# Notizblock PHP

Eine einfache Full-Stack-Anwendung mit Symfony (Backend) und Vue 3 (Frontend), die über Docker gestartet wird.

## Technologien

- Backend: PHP 8.4 + Symfony 8.1
- Frontend: Vue 3 + Vite
- Datenbank: PostgreSQL 16
- Containerisierung: Docker + Docker Compose

## Voraussetzungen

Bevor du startest, stelle sicher, dass folgendes auf deinem Computer installiert ist:

- Docker Desktop oder Docker Engine
- Docker Compose
- Git

Prüfe die Installation mit:

```bash
docker --version
docker compose version
```

## Projekt klonen

```bash
git clone <dein-repository-url>
cd notizblock_php
```

## Installation und Start mit Docker

Im Projektroot (dort, wo auch die Datei `docker-compose.yml` liegt) führe den folgenden Befehl aus:

```bash
docker compose up --build
```

Dieser Befehl baut die Container automatisch und startet anschließend:

- Frontend: http://localhost:5173
- Backend API: http://localhost:8000
- PostgreSQL: localhost:5432

## Container stoppen

```bash
docker compose down
```

Wenn du die Datenbank ebenfalls komplett löschen möchtest, kannst du zusätzlich den Volume-Reset ausführen:

```bash
docker compose down -v
```

## Logs ansehen

```bash
docker compose logs -f
```

Oder nur für einen Service:

```bash
docker compose logs -f backend
docker compose logs -f frontend
docker compose logs -f database
```

## Wichtige Konfiguration

Die Docker-Umgebung ist in der Datei `docker-compose.yml` konfiguriert:

- `backend` läuft auf Port `8000`
- `frontend` läuft auf Port `5173`
- `database` verwendet PostgreSQL auf Port `5432`
- Die Verbindung zur Datenbank wird im Backend über `DATABASE_URL` gesetzt

## Neuladen nach Änderungen

Wenn du nur den Code geändert hast, reicht oft ein Neustart der betroffenen Container:

```bash
docker compose restart backend
docker compose restart frontend
```

Wenn du neue Abhängigkeiten oder Änderungen an den Dockerfiles gemacht hast, rebuildest du das Projekt:

```bash
docker compose up --build
```

## Häufige Probleme

### 1. Port schon belegt

Wenn `5173` oder `8000` bereits verwendet werden, ändere die Port-Map in `docker-compose.yml`.

### 2. Container starten nicht

Prüfe die Logs mit:

```bash
docker compose logs
```

### 3. Backend kann keine Verbindung zur Datenbank herstellen

Stelle sicher, dass der `database`-Container gestartet ist und die Umgebungsvariablen korrekt gesetzt sind.

## Projektstruktur

```text
notizblock_php/
├── backend/
│   ├── Dockerfile
│   ├── composer.json
│   └── src/
├── frontend/
│   ├── Dockerfile
│   ├── package.json
│   └── src/
├── docker-compose.yml
├── README.md
└── .gitignore
```

## Entwicklungsstatus

Die Anwendung ist für die lokale Entwicklung mit Docker vorbereitet. Für Production-Umgebungen sollten zusätzlich sichere Umgebungsvariablen und eine passende PostgreSQL-Konfiguration gesetzt werden.
