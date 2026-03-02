# REST API

## Endpoints

### Users

| Method | Path                          | Description                    |
| ------ | ----------------------------- | ------------------------------ |
| POST   | `/api.php/auth/register`      | Register a user                |
| POST   | `/api.php/auth/login`         | Login a user                   |
| POST   | `/api.php/auth/logout`        | Logout a user                  |
| POST   | `/api.php/auth/reset`         | Reset password                 |
| GET    | `/api.php/users/me`           | Get current user info          |
| GET    | `/api.php/users/{email_hash}` | Get user details               |
| GET    | `/api.php/users`              | Get list of users (admin only) |
| DELETE | `/api.php/users/{id}`         | Delete a user (admin only)     |

### Files

| Method | Path                           | Description       |
| ------ | ------------------------------ | ----------------- |
| GET    | `/api.php/files`               | Get list of files |
| GET    | `/api.php/files/{id}`          | Get file details  |
| POST   | `/api.php/files`               | Upload a file     |
| DELETE | `/api.php/files/{id}`          | Delete a file     |
| GET    | `/api.php/files/{id}/download` | Download a file   |

## Authentication model

- Authentication is session-based (`PHPSESSID` cookie).
- Register/login requests accept plain `email` and `password`; server stores only `email_hash` and `password_hash`.
- Protected endpoints require an active session and return `401 Unauthorized` when session is missing or invalid.

### Auth endpoints contract

#### POST /api.php/auth/register

Request (`application/json`):

```json
{
    "email": "user@example.com",
    "password": "secret",
    "username": "mike"
}
```

Notes:

- `username` is optional.
- `email_hash = SHA-256(email)` is computed on server side.

Response: `201 Created` (or `409 Conflict` if user already exists).

#### POST /api.php/auth/login

Request (`application/json`):

```json
{
    "email": "user@example.com",
    "password": "secret"
}
```

Response: `200 OK` + session cookie.

Example response body:

```json
{
    "id": 7,
    "email_hash": "<sha256>",
    "username": "mike",
    "role": "user"
}
```

If username is not set in database, it will be returned as `anonymous_{id}` (e.g. `anonymous_7`).

#### POST /api.php/auth/logout

Response: `200 OK` (session invalidated).

#### POST /api.php/auth/reset

Request (`application/json`):

```json
{
    "email": "user@example.com"
}
```

Reset flow:

- Server computes `email_hash = SHA-256(email)` and searches user by `email_hash`.
- If user exists, server sends confirmation email with an expiring reset token.
- User opens confirmation link with `email` and `token`.
- Server validates token, generates a new password, stores its hash in DB, and sends the new password to email.
- If user does not exist, endpoint still returns success to prevent user enumeration.

Response: `200 OK`.

### Auth-related errors

- `400 Bad Request` - invalid or incomplete payload
- `401 Unauthorized` - invalid credentials or missing/expired session
- `409 Conflict` - user with the same `email_hash` already exists
- `429 Too Many Requests` - optional rate limiting

## Users endpoints contract

### GET /api.php/users/me

Auth: required (any authenticated user).

Response: `200 OK`.

Example response body:

```json
{
    "id": 7,
    "email_hash": "<sha256>",
    "username": "mike",
    "role": "user",
    "language": "en",
    "created_at": "2024-01-01 12:00:00"
}
```

### GET /api.php/users/{email_hash}

Auth: required (any authenticated user).

Used from file details page to view file owner information.

Response: `200 OK` or `404 Not Found`.

Example response body:

```json
{
    "email_hash": "<sha256>",
    "username": "mike",
    "role": "user",
    "language": "en"
}
```

### GET /api.php/users

Auth: required (`admin` only).

Response: `200 OK`.

Example response body:

```json
[
    {
        "id": 7,
        "email_hash": "<sha256>",
        "username": "mike",
        "role": "user",
        "language": "en",
        "created_at": "2024-01-01 12:00:00"
    },
    {
        "id": 1,
        "email_hash": "<sha256>",
        "username": "admin",
        "role": "admin",
        "language": "en",
        "created_at": "2024-01-01 10:00:00"
    }
]
```

### DELETE /api.php/users/{id}

Auth: required (`admin` only).

Response: `200 OK` or `404 Not Found`.

Example response body (`200 OK`):

```json
{
    "status": "deleted",
    "id": 7
}
```

## Files endpoints contract

### GET /api.php/files

Auth: not required.

Response: `200 OK`.

Returns files list available for guest and authenticated users.

```json
[
    {
        "id": 1,
        "filename": "example.txt",
        "title": "Quarterly report",
        "description": "Q1 financial report",
        "user_id": 7,
        "size": 1024,
        "uploaded_at": "2024-01-01 12:00:00"
    }
]
```

### GET /api.php/files/{id}

Auth: not required.

Response: `200 OK` or `404 Not Found`.

Example response body:

```json
{
    "id": 1,
    "filename": "example.txt",
    "title": "Quarterly report",
    "description": "Q1 financial report",
    "user_id": 7,
    "size": 1024,
    "path": "/uploads/2024/01/example.txt",
    "uploaded_at": "2024-01-01 12:00:00"
}
```

### POST /api.php/files

Auth: required (`user` or `admin`).

Request: `multipart/form-data`

- `file` - file to upload
- `title` - file title
- `description` - file description

Response: `201 Created`

Example response body:

```json
{
    "id": 11,
    "filename": "example.txt",
    "title": "Quarterly report",
    "description": "Q1 financial report",
    "user_id": 7,
    "size": 1024,
    "uploaded_at": "2024-01-01 12:00:00"
}
```

### DELETE /api.php/files/{id}

Auth: required (`user` or `admin`).

Authorization rules:

- `user` can delete only own file.
- `admin` can delete any file.

Response: `200 OK`, `403 Forbidden`, or `404 Not Found`.

### GET /api.php/files/{id}/download

Auth: not required.

Response: `200 OK` with file in the response body
