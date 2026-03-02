<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - FileStock</title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/skeleton.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FileStock</h1>
            <p>Регистрация</p>
        </div>

        <div id="message" class="message hidden"></div>

        <form id="registerForm">
            <div class="row">
                <div class="twelve columns">
                    <label for="username">Имя пользователя</label>
                    <input type="text" id="username" name="username" class="u-full-width" required>
                </div>
            </div>
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
                    <label for="confirmPassword">Подтверждение пароля</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="u-full-width" required>
                </div>
            </div>
            <div class="row">
                <div class="twelve columns">
                    <button type="submit" class="button-primary u-full-width">Зарегистрироваться</button>
                </div>
            </div>
        </form>

        <p style="text-align: center; margin-top: 20px;">
            Уже есть аккаунт? <a href="/login.html">Войти</a>
        </p>
    </div>

    <script src="/js/auth.js"></script>
</body>
</html>
