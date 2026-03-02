# Architecture

## Review

```text
┌─────────────┐     ┌─────────────┐
│   Frontend  │────▶│   Backend   │
│   (nginx)   │◀────│  (PHP-FPM)  │
└─────────────┘     └──────┬──────┘
                           │
                    ┌──────▼──────┐
                    │   SQLite    │
                    │  (files.db) │
                    └─────────────┘
```

## Components

### Frontend

- **nginx** - web server for static files
- Proxies API requests to the backend

### Backend

- **PHP-FPM** - PHP interpreter
- **SQLite** - database for file metadata

### Data Storage

- **src/backend/data/data.sqlite** - SQLite database (tables: users, files, config)
- **src/backend/uploads/** - directory for storing uploaded files
