# Database Schema

## Tables

### users

| Column        | Type     | Constraints               | Description          |
| ------------- | -------- | ------------------------- | -------------------- |
| id            | INTEGER  | PRIMARY KEY AUTOINCREMENT | User ID              |
| email_hash    | TEXT     | UNIQUE NOT NULL           | SHA-256 hashed email |
| username      | TEXT     |                           | Username             |
| password_hash | TEXT     | NOT NULL                  | Password hash        |
| role          | TEXT     | NOT NULL DEFAULT 'user'   | Role (user, admin)   |
| created_at    | DATETIME | NOT NULL                  | Creation date        |
| language      | TEXT     | NOT NULL DEFAULT 'en'     | Preferred language   |

### files

| Column      | Type     | Constraints               | Description          |
| ----------- | -------- | ------------------------- | -------------------- |
| id          | INTEGER  | PRIMARY KEY AUTOINCREMENT | File ID              |
| user_id     | INTEGER  | FOREIGN KEY               | ID of the owner user |
| filename    | TEXT     | NOT NULL                  | File name            |
| title       | TEXT     | NOT NULL                  | File title           |
| description | TEXT     | NOT NULL                  | File description     |
| size        | INTEGER  | NOT NULL                  | File size in bytes   |
| path        | TEXT     | NOT NULL                  | File path            |
| uploaded_at | DATETIME | NOT NULL                  | Upload date          |

### config

| Column      | Type    | Constraints               | Description        |
| ----------- | ------- | ------------------------- | ------------------ |
| id          | INTEGER | PRIMARY KEY AUTOINCREMENT | Config ID          |
| name        | TEXT    | UNIQUE NOT NULL           | Config name        |
| value       | TEXT    | NOT NULL                  | Config value       |
| type        | TEXT    | NOT NULL                  | Config value type  |
| description | TEXT    | NOT NULL                  | Config description |

## Indexes

```sql
CREATE INDEX idx_users_email_hash ON users(email_hash);
CREATE INDEX idx_files_user_id ON files(user_id);
CREATE INDEX idx_files_uploaded_at ON files(uploaded_at);
```
