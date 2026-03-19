-- FileStock Database Initialization
PRAGMA foreign_keys = ON;

CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    seed TEXT NOT NULL,                 -- unique seed for each user to enhance security
    username TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,         -- hash of the email for privacy
    password TEXT NOT NULL,             -- hash of the password for security
    role TEXT NOT NULL DEFAULT 'user',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS files (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    name TEXT NOT NULL,
    description TEXT,
    size INTEGER NOT NULL,
    path TEXT NOT NULL,
    uploaded_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE INDEX IF NOT EXISTS idx_users_email ON users(email);
CREATE INDEX IF NOT EXISTS idx_files_user_id ON files(user_id);
CREATE INDEX IF NOT EXISTS idx_files_uploaded_at ON files(uploaded_at);

-- Configuration table
CREATE TABLE IF NOT EXISTS config (
    key TEXT PRIMARY KEY,
    value TEXT,
    type TEXT NOT NULL DEFAULT 'string',
    description TEXT,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Default configuration values
INSERT OR IGNORE INTO config (key, value, type, description) VALUES
    ('items_per_page', '20', 'int', 'Number of items per page'),
    ('max_file_size', '10485760', 'int', 'Maximum file size in bytes (10MB)'),
    ('allowed_extensions', 'jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,zip,rar,txt', 'string', 'Allowed file extensions'),
    ('site_name', 'FileStock', 'string', 'Site name'),
    ('site_url', 'http://localhost:8080', 'string', 'Site URL'),
    ('default_locale', 'ru', 'string', 'Default locale (ru or en)'),
    ('rate_limit_login_max', '5', 'int', 'Max login attempts per window'),
    ('rate_limit_login_window', '60', 'int', 'Login rate limit window in seconds'),
    ('rate_limit_register_max', '3', 'int', 'Max registration attempts per window'),
    ('rate_limit_register_window', '60', 'int', 'Registration rate limit window in seconds');
