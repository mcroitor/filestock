# Architecture

## Review

```txt
┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│   Browser   │────▶│   Frontend  │────▶│   Backend   │
│   (SPA)     │◀────│   (nginx)   │◀────│  (PHP-FPM)  │
└─────────────┘     └─────────────┘     └──────┬──────┘
                                               │
                                        ┌──────▼──────┐
                                        │   SQLite    │
                                        │  (files.db) │
                                        └─────────────┘
```

## Components

### Frontend (SPA)

- **nginx** - web server for static files
- **index.html** - skeleton with zones (#navMenu, #mainContent)
- **app.js** - content management and routing
- Partial templates are loaded via API

### Backend

- **PHP-FPM** - PHP interpreter
- **API** (`api.php`, Planned) - JSON endpoints + partial HTML
- **SQLite** - database

Components with status `Planned` describe the target architecture. Their implementation is outlined in `TODO.md` (Phase 0).

### Project Structure

```txt
backend/
├── db/
│   └── init.sql               # SQLite initialization
├── uploads/                   # Uploaded files
├── src/
│   ├── config.php             # Configuration and bootstrap
│   ├── api.php                # API endpoints (Planned)
│   ├── templates/             # HTML partials (Planned)
│   │   ├── user/              # User templates (Planned)
│   │   ├── files/             # File templates (Planned)
│   │   └── admin/             # Admin templates (Planned)
│   ├── modules/               # Backend modules (Planned)
│   ├── locales/               # i18n files ru/en (Planned)
│   └── core/                  # Core (classes Mc\*)

frontend/
├── src/
│   ├── index.html             # SPA skeleton
│   ├── css/
│   │   ├── normalize.css     # CSS normalization
│   │   ├── skeleton.css      # Skeleton CSS
│   │   └── app.css          # Custom styles
│   └── js/
│       ├── app.js            # SPA logic
│       ├── auth.js           # Authentication
│       ├── i18n.js           # Translations
│       └── utils.js          # Utility functions (Planned)
```

## SPA concept

1. Browser loads `index.html` and `app.js`
2. `app.js` loads CSRF and i18n, checks authorization for protected actions
3. Guest can view the file list and download files
4. Menu is loaded from `/api.php/partial/nav`
5. Page content is loaded from `/api.php/partial/{name}`
6. Routing via History API (without page reload)
