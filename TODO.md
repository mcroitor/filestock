# TODO - Development plan

## Phase 1: Basic Functionality (MVP)

### 1.1 Authentication

- [ ] Create API endpoints for `/auth/register`, `/auth/login`, and `/auth/reset`
- [ ] Add `login()` methods in User.php
- [ ] Add `register()` methods in User.php
- [ ] Add `resetPassword()` method in User.php
- [ ] Create login page (frontend)
- [ ] Create registration page (frontend)
- [ ] Create password reset page (frontend)
- [ ] Add session handling in API

### 1.2 Role-based API protection

- [ ] Update `api.php` — check authorization for upload/delete
- [ ] Implement check: user can delete only their own files
- [ ] Add admin check for deleting any files

### 1.3 Frontend and Backend Integration

- [ ] Connect API to frontend (fetch in app.js)
- [ ] Add UI for login/registration
- [ ] Add "Logout" button
- [ ] Show upload/delete buttons based on roles

### 1.4 Database Schema

- [ ] Create `users` table with fields: id, username, email_hash, password_hash, role (username is optional, email is hashed and used for login)
- [ ] Create `files` table with fields: id, user_id, filename, title, description, path, uploaded_at
- [ ] Create `config` table for storing configuration values, fields: id, name, value, type, description

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

### 4.2 Testing

- [ ] Unit tests for core classes
- [ ] API integration tests

## Phase 5: Deployment

### 5.1 Production

- [ ] Configure HTTPS
- [ ] Configure logging
- [ ] Configure database backup
- [ ] Add Docker health checks
