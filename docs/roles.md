# User roles and permissions

## List of roles

| Role  | Description                                  |
| ----- | -------------------------------------------- |
| guest | Guest - can only view and download files     |
| user  | User - can upload and delete their own files |
| admin | Admin - full access to all files             |

## User Profile

Users can edit:

- **Username** - display name (default "User_{RANDOM}")
- **Default locale** - default interface language
- **Password** - change password

## Permissions

### Guest

- View file list
- View file information
- Download files

### User

- All Guest permissions
- Upload files
- Delete own files
- Edit profile

### Admin

- All User permissions
- Delete any files
- Manage site settings
- Manage users (TODO)

## Authentication and Authorization

The site does not contain personal user data, and the username is optional. If a user does not specify a name, the default format "User_{RANDOM}" with a pseudo-random suffix is displayed.

Authentication is performed using email and password. The database stores the hashed email and hashed password. When logging in, the user enters their email and password, which are hashed and compared with the data in the database. If a match is found, the user is considered authenticated.

Password recovery via a temporary token is described as a target functionality and is in TODO status until the corresponding API endpoints are implemented.
