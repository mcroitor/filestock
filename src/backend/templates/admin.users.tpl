<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пользователи - FileStock</title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/skeleton.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FileStock</h1>
            <nav>
                <a href="/">Файлы</a>
                <a href="/admin/users">Пользователи</a>
                <a href="/api.php?auth/logout">Выйти</a>
            </nav>
        </div>

        <div id="message" class="message hidden"></div>

        <div class="admin-panel">
            <h2>Управление пользователями</h2>
            
            <table class="u-full-width">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Роль</th>
                        <th>Дата регистрации</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody id="userList">
                    <tr>
                        <td colspan="6">Загрузка...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="/js/admin.js"></script>
</body>
</html>
