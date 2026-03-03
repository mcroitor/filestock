# TODO - Development plan

## Phase 1: Basic Functionality (MVP)

### 1.0 Database Schema and Initialization

- [x] Create `users` table with fields: id, username, email_hash, password_hash, role (username is optional, email is hashed and used for login)
- [x] Create `files` table with fields: id, user_id, filename, title, description, size, path, uploaded_at
- [x] Create `config` table for storing configuration values, fields: id, name, value, type, description
- [x] Seed default values in `config` table (`app_name`, language, pagination, upload/auth limits)
- [x] Add database initialization/migration script for creating tables and indexes

### 1.1 Authentication

- [x] Create API endpoints for `/auth/register`, `/auth/login`, and `/auth/reset`
- [x] Add `login()` methods in User.php
- [x] Add `register()` methods in User.php
- [ ] Add `resetPassword()` method in User.php
- [ ] Add reset token generation and expiration handling
- [ ] Add reset confirmation flow (token + email validation)
- [ ] Create `cli/user-create.php` for creating users from CLI (for testing/admin purposes)
- [ ] Invalidate reset token after successful password update
- [ ] Create login page (frontend)
- [ ] Create registration page (frontend)
- [ ] Create password reset page (frontend)
- [x] Add session handling in API

### 1.2 Role-based API protection

- [ ] Update `api.php` — check authorization for upload/delete
- [ ] Implement check: user can delete only their own files
- [ ] Add admin check for deleting any files
- [ ] Define and implement endpoint access matrix for guest/user/admin

### 1.3 Frontend and Backend Integration

- [ ] Connect API to frontend (fetch in app.js)
- [ ] Add UI for login/registration
- [ ] Add "Logout" button
- [ ] Show upload/delete buttons based on roles

### 1.4 MVP Smoke Testing

- [ ] Add smoke tests for register/login/logout flow
- [ ] Add smoke tests for upload/list/delete file flow
- [ ] Add smoke tests for role-based restrictions (guest vs user vs admin)

## Phase 2: Core Development

### 2.1 Core Classes Implementation

- [ ] Implement `Mc\Role` class for role management
- [ ] Implement `Mc\User` class for user management
- [ ] Implement `Mc\Localization` class for handling translations

### 2.2 Templating

- [ ] Create basic page templates
  - [ ] file.list.tpl
  - [ ] file.view.tpl
  - [ ] file.edit.tpl
  - [ ] user.login.tpl
  - [ ] user.register.tpl
  - [ ] admin.users.tpl

### 2.3 Translations

- [ ] Create default translation file `en.php`
- [ ] Create translation files `ru.php`, `ro.php`
- [ ] Implement language switcher in UI
- [ ] Load translations based on user preference

### 2.4 Modular System Support

- [x] Define module layout (`src/backend/extensions/<module_name>`)
- [x] Define module bootstrap contract (single entry file for route/service registration)
- [x] Implement module loader in `api.php` (scan enabled modules and include bootstrap)
- [x] Add module manifest format (name, version, dependencies, enabled flag)
- [ ] Add config storage for enabled/disabled modules
- [x] Add dependency validation between modules before bootstrap
- [x] Add safe module initialization (isolation + clear error logging)
- [x] Move auth routes from `api.php` to `extensions/auth` module
- [ ] Add CLI command for module management (list/enable/disable)
- [ ] Add docs section: how to create and connect a new module

## Phase 3: Feature Expansion

### 3.1 File Management

- [ ] Add pagination for file list
- [ ] Add sorting by name/date/size
- [ ] Add file search
- [ ] Restrict allowed file types
- [ ] Restrict maximum file size

### 3.2 Admin Panel (for admin)

- [ ] User list page
- [ ] Delete users
- [ ] Change user roles

### 3.3 UI Improvements

- [ ] Responsive design
- [ ] File upload progress indication
- [ ] Notifications (toast messages)
- [ ] Confirmation before deletion

## Phase 4: Security and Stability

### 4.1 Security

- [ ] Input validation
- [ ] CSRF protection
- [ ] API rate limiting
- [ ] Suspicious activity logging
- [ ] Add password policy (minimal length and complexity rules)
- [ ] Harden session cookies (HttpOnly, Secure, SameSite)
- [ ] Rotate session ID after successful login

### 4.2 Testing

- [ ] Unit tests for core classes
- [ ] API integration tests

## Phase 5: Deployment

### 5.1 Production

- [ ] Configure HTTPS
- [ ] Configure logging
- [ ] Configure database backup
- [ ] Add Docker health checks
