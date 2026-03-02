<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Файлы - FileStock</title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/skeleton.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FileStock</h1>
            <p>Файловый репозиторий</p>
            <div class="user-info">
                <span id="username"></span>
                <a href="/api.php?auth/logout" id="logoutBtn">Выйти</a>
            </div>
        </div>

        <div id="message" class="message hidden"></div>

        {{#can_upload}}
        <div class="upload-zone" id="uploadZone">
            <p>Перетащите файлы сюда или нажмите для выбора</p>
            <input type="file" id="fileInput" multiple hidden>
        </div>
        {{/can_upload}}

        <div class="file-list">
            <h3>Файлы</h3>
            <div id="fileList">
                <p>Загрузка файлов...</p>
            </div>
        </div>
    </div>

    <script src="/js/app.js"></script>
</body>
</html>
