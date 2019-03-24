<?php
/*@var $user app\User */
$users = \app\App::getApp()->getUsers();
$currentUser = \app\App::getApp()->currentUser();
?><!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Главная страница</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <a href="/create/" class="btn btn-md btn-primary">Создание</a>
                <a href="/login-username-pass/" class="btn btn-md btn-primary">Авторизации по логину и паролю</a>
                <a href="/login-auth-key/" class="btn btn-md btn-primary">Авторизации по ключу</a>
                <a href="/create/" class="btn btn-md btn-primary">Регистрация</a>
                <a href="/recovery/" class="btn btn-md btn-primary">Восстановление пароля</a>
            </div>
            <div class="row">
                <p><?=$currentUser ? 'Текущий пользователь: '.$currentUser->getFullName(): 'Пользователь не авторизован'?></p>
            </div>
            <div class="row">
                <h1>Пользователи</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>email</th>
                            <th>login</th>
                            <th>password</th>
                            <th>created_at</th>
                            <th>updated_at</th>
                            <th>fname</th>
                            <th>name</th>
                            <th>lname</th>
                            <th>birth_date</th>
                            <th>is_blocked</th>
                            <th>auth_key</th>
                            <th>getAge()</th>
                            <th>getFullName()</th>
                            <th>getShortName()</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($users as $user)
                        {
                            ?>
                            <tr>
                                <td>
                                    <a href="<?='/update?id='.$user->id?>" class="btn btn-sm btn-success">редактировать</a>
                                    <a href="<?='/delete?id='.$user->id?>" class="btn btn-sm btn-danger">удалить</a>
                                </td>
                                <td><?=$user->email;?></td>
                                <td><?=$user->login;?></td>
                                <td><?=$user->password;?></td>
                                <td><?=$user->created_at ? date('Y-m-d', $user->created_at) : '';?></td>
                                <td><?=$user->updated_at ? date('Y-m-d', $user->updated_at) : '';?></td>
                                <td><?=$user->fname;?></td>
                                <td><?=$user->name;?></td>
                                <td><?=$user->lname;?></td>
                                <td><?=$user->birth_date;?></td>
                                <td><?=$user->is_blocked;?></td>
                                <td><?=$user->auth_key;?></td>
                                <td><?=$user->getAge();?></td>
                                <td><?=$user->getFullName();?></td>
                                <td><?=$user->getShortName();?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<!--<div class="row justify-content-center align-items-center">
                <a href="/update/" class="btn btn-md btn-primary">Обновление</a>
            </div>
            <div class="row justify-content-center align-items-center">
                <a href="/delete/" class="btn btn-md btn-primary">Удаление</a>
            </div>-->