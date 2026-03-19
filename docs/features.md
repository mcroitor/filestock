# Features

## Files

- **View file list** - with pagination, sorting, and search
- **Download files**
- **Upload files** - with description, progress bar (authorized users only)
- **Delete files** - own files (user) or any files (admin)

## Users

- **Registration** - username, email, password
- **Login/Logout**
- **Roles** - guest, user, admin
- **Profile** - set username, default language, change password

## Admin Panel

- **User Management** - view, change role, delete
- **Settings Management** - view and edit config
- **File Management** - view all files, delete any

## Security

- **CSRF protection** - token for POST requests
- **Rate limiting** - limit login/registration attempts
- **Validation** - input data, file types, file size

## Internationalization (i18n)

- **Languages** - RU, EN
- **Switching** - in UI
- **Saving** - in session
- **Translation files** - JSON for frontend and backend
- **Partials** - translated on backend
- **Messages and static text** - translated on frontend

## Role-based Access

| Function            | Guest | User  | Admin |
| ------------------- | :---: | :---: | :---: |
| Authentication      |   ✓   |   ✗   |   ✗   |
| Logout              |   ✗   |   ✓   |   ✓   |
| View file list      |   ✓   |   ✓   |   ✓   |
| Download files      |   ✓   |   ✓   |   ✓   |
| Upload files        |   ✗   |   ✓   |   ✓   |
| Delete own files    |   ✗   |   ✓   |   ✓   |
| Delete any files    |   ✗   |   ✗   |   ✓   |
| User Management     |   ✗   |   ✗   |   ✓   |
| Settings Management |   ✗   |   ✗   |   ✓   |
