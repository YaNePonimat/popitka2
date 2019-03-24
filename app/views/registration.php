<?php
?><!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Регистрация/создание пользователя</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="container">
            <form method="post" action="">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?=$_POST['email']?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Логин</label>
                    <input type="text" name="login" value="<?=$_POST['login']?>" required="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Фамилия</label>
                    <input type="text" name="fname" value="<?=$_POST['fname']?>" required="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" name="name" value="<?=$_POST['name']?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Отчество</label>
                    <input type="text" name="lname" value="<?=$_POST['lname']?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Дата рождения</label>
                    <input type="date" name="birth_date" value="<?=$_POST['birth_date']?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password" value="" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" name="save" value="1" class="btn btn-md btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </body>
</html>