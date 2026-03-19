# REST API

## Endpoints

### Auth

| Method | Path                                   | Description             |
| ------ | -------------------------------------- | ----------------------- |
| POST   | `/api.php/auth/login`                  | Login                   |
| POST   | `/api.php/auth/register`               | Register                |
| POST   | `/api.php/auth/logout`                 | Logout                  |
| GET    | `/api.php/auth/me`                     | Current user            |
| POST   | `/api.php/auth/password/reset-request` | Password reset request  |
| POST   | `/api.php/auth/password/reset`         | Password reset by token |

### Files

| Method | Path                           | Description                        |
| ------ | ------------------------------ | ---------------------------------- |
| GET    | `/api.php/files`               | File list (available to Guest)     |
| POST   | `/api.php/files`               | Upload file                        |
| DELETE | `/api.php/files/{id}`          | Delete file                        |
| GET    | `/api.php/files/{id}`          | File information                   |
| GET    | `/api.php/files/{id}/download` | Download file (available to Guest) |

### Profile

| Method | Path                        | Description     |
| ------ | --------------------------- | --------------- |
| GET    | `/api.php/profile`          | Profile data    |
| PUT    | `/api.php/profile`          | Update profile  |
| PUT    | `/api.php/profile/password` | Change password |

### Admin

| Method | Path                             | Description          |
| ------ | -------------------------------- | -------------------- |
| GET    | `/api.php/admin/users`           | User list            |
| PUT    | `/api.php/admin/users/{id}/role` | Change role          |
| DELETE | `/api.php/admin/users/{id}`      | Delete user          |
| GET    | `/api.php/admin/config`          | Configuration list   |
| PUT    | `/api.php/admin/config/{key}`    | Update configuration |
| GET    | `/api.php/admin/files`           | All files            |
| DELETE | `/api.php/admin/files/{id}`      | Delete file          |

### Other

| Method | Path                      | Description               |
| ------ | ------------------------- | ------------------------- |
| GET    | `/api.php/i18n`           | Translations              |
| POST   | `/api.php/i18n/locale`    | Change language           |
| GET    | `/api.php/csrf`           | CSRF token                |
| GET    | `/api.php/partial/{name}` | HTML partial              |
| GET    | `/api.php/partial/nav`    | Menu (with username/role) |

## Examples

### GET /api.php/files

```json
{
    "files": [
        {"id": 1, "name": "file.txt", "size": 1024, "uploaded_at": "2024-01-01 12:00:00"}
    ],
    "pagination": {
        "page": 1,
        "limit": 20,
        "total": 1,
        "total_pages": 1
    }
}
```

### POST /api.php/files

Request: `multipart/form-data`

- `file` - file
- `description` - description

Response: `201 Created`

```json
{"id": 1, "name": "file.txt", "description": ""}
```

### GET /api.php/partial/nav

Returns HTML menu:

- For guests: links "Login", "Register"
- For authenticated users: username, role, "Logout" button, "Manage" link (for admin)

## Partials

```txt
GET /api.php/partial/nav                       → templates/user/nav-*.html
GET /api.php/partial/user/auth-login            → templates/user/auth-login.partial.html
GET /api.php/partial/user/auth-register         → templates/user/auth-register.partial.html
GET /api.php/partial/user/profile               → templates/user/profile.partial.html
GET /api.php/partial/files/files-list          → templates/files/files-list.partial.html
GET /api.php/partial/files/upload-form          → templates/files/upload-form.partial.html
GET /api.php/partial/files/view                 → templates/files/view.partial.html
GET /api.php/partial/admin/manage-site        → templates/admin/manage-site.partial.html
```
