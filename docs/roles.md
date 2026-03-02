# User Roles and Permissions

## List of Roles

| Role  | Description                                  |
| ----- | -------------------------------------------- |
| guest | Guest - can only view and download files     |
| user  | User - can upload and delete their own files |
| admin | Admin - full access to all files             |

Note: `guest` is a runtime (unauthenticated) role and is not stored in the `users` table.

## Permissions

### Guest

- View file list
- Download files

### User

- All permissions of Guest
- Upload files
- Delete their own files

### Admin

- All permissions of User
- Delete any files
- Manage users

## Capabilities

| Name            | Guest | User | Admin |
| --------------- | ----- | ---- | ----- |
| list_files      | +     | +    | +     |
| view_file       | +     | +    | +     |
| download_file   | +     | +    | +     |
| upload_file     | -     | +    | +     |
| delete_own_file | -     | +    | +     |
| delete_any_file | -     | -    | +     |
| list_users      | -     | -    | +     |
| view_user       | -     | +    | +     |
| create_user     | +     | -    | +     |
| delete_user     | -     | -    | +     |
| change_role     | -     | -    | +     |
| login           | +     | -    | -     |
| logout          | -     | +    | +     |
