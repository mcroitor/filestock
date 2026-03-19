# Database Schema

## Tables

### users

| Column     | Type     | Constraints               | Description           |
| ---------- | -------- | ------------------------- | --------------------- |
| id         | INTEGER  | PRIMARY KEY AUTOINCREMENT | User ID               |
| email      | TEXT     | UNIQUE NOT NULL           | SHA-256 hash of email |
| username   | TEXT     | NOT NULL                  | Username              |
| password   | TEXT     | NOT NULL                  | Password hash         |
| role       | TEXT     | NOT NULL DEFAULT 'user'   | Role (user, admin)    |
| created_at | DATETIME | NOT NULL                  | Creation date         |

### files

| Column      | Type     | Constraints               | Description                          |
| ----------- | -------- | ------------------------- | ------------------------------------ |
| id          | INTEGER  | PRIMARY KEY AUTOINCREMENT | File ID                              |
| user_id     | INTEGER  | FOREIGN KEY               | ID of the user who uploaded the file |
| name        | TEXT     | NOT NULL                  | File name                            |
| description | TEXT     |                           | File description                     |
| size        | INTEGER  | NOT NULL                  | File size in bytes                   |
| path        | TEXT     | NOT NULL                  | File path                            |
| uploaded_at | DATETIME | NOT NULL                  | Upload date                          |

### config

| Column      | Type     | Constraints               | Description              |
| ----------- | -------- | ------------------------- | ------------------------ |
| key         | TEXT     | PRIMARY KEY               | Configuration key        |
| value       | TEXT     |                           | Value                    |
| type        | TEXT     | NOT NULL DEFAULT 'string' | Type (string, int, bool) |
| description | TEXT     |                           | Description              |
| updated_at  | DATETIME | NOT NULL                  | Update date              |

## Indexes

```sql
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_files_user_id ON files(user_id);
CREATE INDEX idx_files_uploaded_at ON files(uploaded_at);
```

## Configuration (config table)

| Key                        | Type   | Description                              |
| -------------------------- | ------ | ---------------------------------------- |
| items_per_page             | int    | Items per page                           |
| max_file_size              | int    | Max file size (bytes)                    |
| allowed_extensions         | string | Allowed extensions                       |
| site_name                  | string | Site name                                |
| site_url                   | string | Site URL                                 |
| default_locale             | string | Default language (ru, en)                |
| rate_limit_login_max       | int    | Max login attempts                       |
| rate_limit_login_window    | int    | Login rate limit window (seconds)        |
| rate_limit_register_max    | int    | Max registration attempts                |
| rate_limit_register_window | int    | Registration rate limit window (seconds) |
