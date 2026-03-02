CREATE TABLE IF NOT EXISTS config (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT UNIQUE NOT NULL,
    value TEXT NOT NULL,
    type TEXT NOT NULL,
    description TEXT NOT NULL
);

INSERT OR IGNORE INTO config (name, value, type, description) VALUES
    ('app_name', 'FileStock', 'string', 'Application display name'),
    ('default_language', 'en', 'string', 'Default UI language'),
    ('items_per_page', '20', 'int', 'Default number of items per page'),
    ('max_upload_size_bytes', '10485760', 'int', 'Maximum upload file size in bytes'),
    ('allowed_file_extensions', 'txt,pdf,jpg,jpeg,png,zip', 'csv', 'Comma-separated list of allowed file extensions'),
    ('password_reset_token_ttl_sec', '3600', 'int', 'Password reset token lifetime in seconds'),
    ('session_ttl_sec', '86400', 'int', 'Session lifetime in seconds'),
    ('enable_registration', '1', 'bool', 'Allow new user registration'),
    ('enable_password_reset', '1', 'bool', 'Allow password reset flow');
