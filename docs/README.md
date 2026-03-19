# Technical documentation FileStock

- [Architecture](architecture.md)
- [API](api.md)
- [Features](features.md)
- [User Interface](interface.md)
- [Database](database.md)
- [Roles and Permissions](roles.md)
- [Development Plan](TODO.md)

A website for storing and managing files. Implemented in PHP 8.x using SQLite for data storage. The frontend is built as an SPA using native JavaScript and Skeleton CSS styles. The project is deployed using Docker and Docker Compose.

The application does not store any personal user data. Authentication is based on email + password input, while only email_hash and password_hash are stored.

Users can upload files, view their file list, and delete files. Each file is associated with the user who uploaded it. File uploading must be followed by a file description.

Any guest user can download any hosted file, only registered users can upload and manage files.
