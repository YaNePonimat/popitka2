<?php
?><!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Авторизация</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="container">
            <form method="post" action="">
                <div class="form-group">
                    <label>Токен</label>
                    <input type="text" name="token" value="" required="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Новый пароль</label>
                    <input type="password" name="password" value="" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" name="save" value="1" class="btn btn-md btn-success">Сбросить</button>
                </div>
            </form>
        </div>
    </body>
</html>