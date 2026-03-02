<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование файла - FileStock</title>
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

        <div id="message" class="message hidden"></div>

        <form id="editForm">
            <h2>Редактирование файла</h2>
            
            <div class="row">
                <div class="twelve columns">
                    <label for="filename">Имя файла</label>
                    <input type="text" id="filename" name="filename" class="u-full-width" value="{{filename}}" required>
                </div>
            </div>

            <div class="row">
                <div class="twelve columns">
                    <button type="submit" class="button-primary">Сохранить</button>
                    <a href="/file/{{file_id}}" class="button">Отмена</a>
                </div>
            </div>
        </form>
    </div>

    <script src="/js/app.js"></script>
</body>
</html>
