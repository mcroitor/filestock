# User Interface

## Scope

- Simplicity and intuitiveness
- Fast loading and responsiveness
- Minimalist design

## Structure

- **Main page**: List of files with search and filter options, available to guests and authorized users (Main)
- **File view**: Page for viewing file information and downloading (View)
- **Authentication**: Login page for unauthorized users (Auth)
- **Registration**: Registration page for new users (Register)
- **File upload**: Form for uploading new files (Upload)
- **User profile**: View and edit user information (Profile)
- **Admin panel**: Manage site settings (Admin) - TODO

## Role-based Access

| Page           | Guest | User  | Admin |
| -------------- | :---: | :---: | :---: |
| Main           |   ✓   |   ✓   |   ✓   |
| View           |   ✓   |   ✓   |   ✓   |
| Auth           |   ✓   |   ✗   |   ✗   |
| Register       |   ✓   |   ✗   |   ✗   |
| Upload         |   ✗   |   ✓   |   ✓   |
| Profile        |   ✗   |   ✓   |   ✓   |
| Admin (config) |   ✗   |   ✗   |   ✓   |

## Interface Elements

- **Navigation**: Top menu with links to main pages and current user display
- **File cards**: Display file information (name, size, upload date) with buttons for download and delete (for owners and admins)
- **Forms**:
  - Authentication: Fields for email and password
  - Registration: Fields for name, email, and password
  - File upload: Field for file selection and upload button
  - Profile editing: Fields for changing name, email, and password
  - Search: Field for entering search query and search button
- **Notifications**: Messages about success or errors when performing actions (e.g., file upload or login)
- **Modals**: Confirmation for file deletion, profile editing
- **Pagination**: Navigation through pages when there are many files (users, settings, etc.)
