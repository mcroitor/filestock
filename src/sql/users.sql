CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email_hash TEXT UNIQUE NOT NULL,
    username TEXT,
    password_hash TEXT NOT NULL,
    role TEXT NOT NULL DEFAULT 'user' CHECK (role IN ('user', 'admin')),
    created_at DATETIME NOT NULL,
    language TEXT NOT NULL DEFAULT 'en'
);

CREATE INDEX IF NOT EXISTS idx_users_email_hash ON users(email_hash);
