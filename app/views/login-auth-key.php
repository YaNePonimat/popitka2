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
                    <label>Ключ</label>
                    <input type="text" name="auth_key" value="" required="" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" name="save" value="1" class="btn btn-md btn-success">Войти</button>
                </div>
            </form>
        </div>
    </body>
</html>