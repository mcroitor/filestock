<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход - FileStock</title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/skeleton.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FileStock</h1>
            <p>Вход в систему</p>
        </div>

        <div id="message" class="message hidden"></div>

        <form id="loginForm">
            <div class="row">
                <div class="twelve columns">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="u-full-width" required>
                </div>
            </div>
            <div class="row">
                <div class="twelve columns">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" class="u-full-width" required>
                </div>
            </div>
            <div class="row">
                <div class="twelve columns">
                    <button type="submit" class="button-primary u-full-width">Войти</button>
                </div>
            </div>
        </form>

        <p style="text-align: center; margin-top: 20px;">
            Нет аккаунта? <a href="/register.html">Зарегистрироваться</a>
        </p>
    </div>

    <script src="/js/auth.js"></script>
</body>
</html>
