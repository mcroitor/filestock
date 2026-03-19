# TODO - Roadmap

Backend will use core classes for all business logic. The core can only be modified by the user who created it.

Frontend is based on Skeleton CSS for basic styling and responsiveness.

## Phase 0: Preparation

- [ ] Class `Mc\User` for user management
- [ ] Backend: add `backend/src/api.php` (REST endpoints + partial rendering)
- [ ] Backend: fill `backend/src/templates/` with partial templates (`user`, `files`, `admin`)
- [ ] Backend: add `backend/src/modules/` for business logic modules
- [ ] Backend: add `backend/src/locales/` and language files (`ru.json`, `en.json`)
- [ ] Frontend: add `frontend/src/js/utils.js` (utility functions)
- [ ] Guest mode: Guest access to file list and download without authentication
- [ ] DB: synchronize `backend/src/sqlschems/init.sql` with `docs/database.md`
- [ ] Documentation: formulate Auth page "for unauthenticated users"

### Phase 0 - Implementation Details

- [ ] `backend/src/api.php`: include `config.php`, initialize router, unified JSON response and error handling
- [ ] modules
  - [ ] module bootstrap contract (single entry file for route/service registration)
  - [ ] module loader in `api.php` (scan enabled modules and include bootstrap)
  - [ ] module manifest format (name, version, dependencies)
- [ ] `backend/src/api.php`: include modules. Modules process routes `auth/*`, `files/*`, `admin/config/*`, `i18n/*`, `csrf`, `partial/*` according to `docs/api.md`
- [ ] `backend/src/templates/user/`
  - [ ] `nav-guest.partial.html` - navigation panel for guests (files/login/register)
  - [ ] `nav-user.partial.html` - navigation panel for authenticated users
  - [ ] `auth-login.partial.html` - login form
  - [ ] `auth-register.partial.html` - registration form
  - [ ] `profile.partial.html` - user profile form
- [ ] `backend/src/templates/files/`
  - [ ] `files-list.partial.html` - list of files
  - [ ] `upload-form.partial.html` - file upload form
  - [ ] `view.partial.html` - file view page
- [ ] `backend/src/templates/admin/`
  - [ ] `manage-site.partial.html` - admin panel for site configuration
  - [ ] `manage-users.partial.html` - admin panel for user management
  - [ ] `manage-files.partial.html` - admin panel for file management
- [ ] `backend/src/modules/`: basic modules
  - [ ] `auth.php` - registration, login, logout, password reset
  - [ ] `files.php` - file management (list, upload, delete, info)
  - [ ] `config.php` - site configuration management
  - [ ] `i18n.php` - language and translation management
  - [ ] `profile.php` - user profile management
  - [ ] `admin.php` - admin panel
- [ ] `backend/src/locales/ru.json`: keys for auth / files / admin / common / pagination / messages
- [ ] `backend/src/locales/en.json`: mirrored set of keys from `ru.json`
- [ ] `frontend/src/js/utils.js`: utilities
  - [ ] `requestJson`
  - [ ] `escapeHtml`
  - [ ] `formatFileSize`
  - [ ] `formatDate`
  - [ ] `debounce`
- [ ] Guest access (backend): `GET /api.php/files` and `GET /api.php/files/{id}/download` available without session
- [ ] Guest access (frontend): main page renders file list for Guest, upload / delete hidden
- [ ] Guest access (frontend): routes `/login` and `/register` remain only for unauthenticated users
- [ ] DB migration: check scenario for updating existing DB after removing `seed` and adding `default_locale`

## Phase 1: Basic Functionality (MVP)

- [ ] Frontend: basic SPA structure, routing, partials loading
- [ ] Backend: basic API endpoints for authentication and file management
- [ ] Authentication (login, register, logout)
- [ ] API role-based protection
- [ ] Integration of frontend and backend
- [ ] Site configuration in DB
- [ ] i18n, language switching, language files (ru.json, en.json)
- [ ] User profile (username, default_locale, password change)
- [ ] Password reset API

### Phase 1 - Implementation Details

- [ ] `GET /api.php/profile`: return `id`, `username`, `email`, `role`, `default_locale`
- [ ] `PUT /api.php/profile`: update `username`, validate length and allowed characters
- [ ] `PUT /api.php/profile/password`: change password using `current_password` + `new_password`
- [ ] `POST /api.php/auth/password/reset-request`: generate token, TTL, rate limit
- [ ] `POST /api.php/auth/password/reset`: validate token, update password hash, invalidate token
- [ ] Frontend partial `profile.partial.html`: profile form + password change UI
- [ ] Frontend app/auth: handle responses from profile/reset API and display errors

## Phase 2: Deployment

- [ ] Dockerfile for backend
- [ ] frontend on nginx
- [ ] docker-compose for local development

### Phase 2 - Implementation Details

- [ ] `Dockerfile` for backend: use official PHP image with FPM, copy source, install dependencies, expose port 9000
  - [ ] Use `php:8.2-fpm` as base image
  - [ ] Install SQLite extension (`pdo_sqlite`)
- [ ] frontend on nginx: simple nginx config to serve static files from `frontend/src`
  - [ ] Use official `nginx:alpine` image
  - [ ] Configure nginx to serve `index.html` and static assets
  - [ ] Configure nginx to proxy API requests to backend on `/api.php`
- [ ] `compose.yml`: define services for backend and frontend, link them together, set environment variables for backend (e.g. `ADMIN_USER`, `ADMIN_PASSWORD`), volume for uploads and DB

## Phase 3: Security

- [ ] Input validation and sanitization
- [ ] CSRF protection
- [ ] Rate limiting
