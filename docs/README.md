# Project Structure

```text
.
├── docker-compose.yml         # Main compose file
└── src/
    ├── backend/
    │   ├── index.php          # Entry point for API, redirects to api.php
    │   ├── api.php            # API request handling logic
    │   ├── config.php         # Application configuration
    │   ├── core/              # Application core classes
    │   ├── localization/      # Application localization classes
    │   └── templates/         # Application templates
    └── frontend/
        ├── index.html
        ├── theme/
        │   ├── normalize.css
        │   ├── skeleton.css
        │   └── app.css
        └── js/
            └── app.js
```
