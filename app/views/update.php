<?php
/*@var $user app\User */
?><!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Редактирование пользователя</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="container">
            <form method="post" action="">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?=$user->email?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Логин</label>
                    <input type="text" name="login" value="<?=$user->login?>" required="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Фамилия</label>
                    <input type="text" name="fname" value="<?=$user->fname?>" required="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" name="name" value="<?=$user->name?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Отчество</label>
                    <input type="text" name="lname" value="<?=$user->lname?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Дата рождения</label>
                    <input type="date" name="birth_date" value="<?=$user->birth_date?>" class="form-control">
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