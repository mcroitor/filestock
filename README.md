# FileStock - file repository

The web application for file storage and management.

## Technologies

- **Backend**: PHP 8.x + SQLite
- **Frontend**: HTML5, Native JS, CSS (Skeleton)

## Features

- User registration and authentication. The application does not store raw email addresses in the database. Authentication is based on email + password input, while only `email_hash` and `password_hash` are stored.
- File upload and management. Users can upload files, view their file list, and delete files. Each file is associated with the user who uploaded it. File uploading must be followed by a file description.
- Any guest user can download any hosted file, only registered users can upload and manage files.
