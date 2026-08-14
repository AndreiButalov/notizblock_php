# Notizblock PHP

Eine moderne Full-Stack-Anwendung mit Symfony 8.1 (Backend) und Vue 3 (Frontend). Das Projekt ist vollständig für Docker containerisiert und wird über Docker Compose orchestriert.

## 🚀 Technologien

| Komponente | Stack |
|-----------|-------|
| **Backend** | PHP 8.4 + Symfony 8.1 |
| **Frontend** | Vue 3 + Vite |
| **Datenbank** | PostgreSQL 16 |
| **Containerisierung** | Docker + Docker Compose |

## 📋 Systemanforderungen

Dieses Projekt läuft **nur mit Docker**. Folgende Tools müssen installiert sein:

- **Docker Desktop** (Windows/Mac) oder **Docker Engine** + **Docker Compose** (Linux)
- **Git**

Installationen prüfen:

```bash
docker --version
docker compose version
```

## 🏃 Schnellstart

### 1. Repository klonen

```bash
git clone <dein-repository-url>
cd notizblock_php
```

### 2. Docker-Container starten

```bash
docker compose up --build
```

Dieser Befehl:
- Baut die Docker Images für Backend und Frontend
- Startet die PostgreSQL-Datenbank
- Mountet die Quellcodes der Containers

### 3. Zugriff auf die Anwendung

Nach dem Starten sind folgende URLs verfügbar:

| Service | URL |
|---------|-----|
| **Frontend** | http://localhost:5173 |
| **Backend API** | http://localhost:8000 |
| **PostgreSQL** | localhost:5432 |

## 🐳 Docker Befehle


### Logs eines bestimmten Services
```bash
docker compose logs -f backend
docker compose logs -f frontend
docker compose logs -f database
```

### Container neu starten (nach Code-Änderungen)
```bash
docker compose restart backend
docker compose restart frontend
```

### Kompletter Rebuild (nach Abhängigkeitsänderungen)
```bash
docker compose up --build
```

## 🔧 Konfiguration

Die gesamte Docker-Konfiguration befindet sich in `docker-compose.yml`:

### Services

**database** (PostgreSQL 16)
- Port: `5432`
- User: `app`
- Passwort: `changeme`
- Datenbank: `app`

**backend** (Symfony 8.1)
- Port: `8000`
- Python/CLI Server
- Umgebung: `dev` (optimiert für Entwicklung)

**frontend** (Vue 3 + Vite)
- Port: `5173`
- Dev Server mit Hot Module Replacement
- API-URL: `http://localhost:8000/api`

## 📂 Projektstruktur

```
notizblock_php/
├── backend/
│   ├── Dockerfile
│   ├── composer.json
│   ├── src/
│   ├── config/
│   ├── public/
│   └── migrations/
├── frontend/
│   ├── Dockerfile
│   ├── package.json
│   ├── src/
│   ├── vite.config.js
│   └── public/
├── docker-compose.yml
├── README.md
└── .gitignore
```

## 🐛 Häufige Probleme

### Port ist bereits in Benutzung

**Fehler:** "bind: address already in use"

**Lösung:** Port in `docker-compose.yml` ändern:
```yaml
ports:
  - "8001:8000"  # Neuer Port statt 8000
```

### Container starten nicht

**Lösung:** Logs prüfen
```bash
docker compose logs
docker compose logs backend
```

### Frontend kann Backend nicht erreichen

Sicherstellen, dass:
1. Der `backend`-Container läuft: `docker compose ps`
2. Die Umgebungsvariable `VITE_API_URL` korrekt gesetzt ist
3. Der `depends_on` in der `docker-compose.yml` richtig ist

### Datenbank-Verbindungsfehler

**Lösung:**
```bash
# Datenbank-Container neu starten
docker compose restart database

# Oder komplett löschen und neu anlegen
docker compose down -v
docker compose up
```

### Cache-Probleme

```bash
# Docker-Cache löschen
docker compose down
docker system prune -a
docker compose up --build
```

## 💡 Entwicklung


### Neue Abhängigkeiten hinzufügen

**Backend (PHP):**
```bash
# Container mit Bash starten
docker compose exec backend bash

# Composer Paket hinzufügen
composer require package-name

# Container verlassen
exit
```

**Frontend (Node.js):**
```bash
# Container mit Bash starten
docker compose exec frontend bash

# NPM Paket hinzufügen
npm install package-name

# Container verlassen
exit
```

Danach Container neu bauen:
```bash
docker compose up --build
```

