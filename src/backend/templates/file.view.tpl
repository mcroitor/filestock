<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{filename}} - FileStock</title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/skeleton.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FileStock</h1>
            <a href="/">Назад к списку</a>
        </div>

        <div class="file-view">
            <h2>{{filename}}</h2>
            
            <table class="u-full-width">
                <tr>
                    <td><strong>Имя файла:</strong></td>
                    <td>{{filename}}</td>
                </tr>
                <tr>
                    <td><strong>Размер:</strong></td>
                    <td>{{filesize}}</td>
                </tr>
                <tr>
                    <td><strong>Дата загрузки:</strong></td>
                    <td>{{uploaded_at}}</td>
                </tr>
                <tr>
                    <td><strong>Загрузил:</strong></td>
                    <td>{{username}}</td>
                </tr>
            </table>

            <div class="file-actions">
                <a href="{{download_url}}" class="button button-primary">Скачать</a>
                {{#can_delete}}
                <button class="button button-danger" onclick="deleteFile({{file_id}})">Удалить</button>
                {{/can_delete}}
            </div>
        </div>
    </div>

    <script src="/js/app.js"></script>
</body>
</html>
