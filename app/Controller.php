<?php
namespace app;
class Controller
{
    public function recovery()
    {
        $user = new User();
        if(isset($_POST['save']))
        {
            if($user->recoveryPassword($_POST['token'], $_POST['password']))
            {
                header('Location: /');
            }
        }
        return include __DIR__.'/views/recovery.php';
    }
    
    public function loginUsernamePass()
    {
        $user = new User();
        if(isset($_POST['save']))
        {
            if($user->loginWithUsernamePass($_POST['login'], $_POST['password']))
            {
                header('Location: /');
            }
        }
        return include __DIR__.'/views/login.php';
    }
    
    public function loginAuthKey()
    {
        $user = new User();
        if(isset($_POST['save']))
        {
            if($user->loginWithAuthKey($_POST['auth_key']))
            {
                header('Location: /');
            }
        }
        return include __DIR__.'/views/login-auth-key.php';
    }
    
    public function createUser()
    {
        if(isset($_POST['save']))
        {
            $user = new User();
            $user->registration($_POST);
            header('Location: /');
        }
        return include __DIR__.'/views/registration.php';
    }
    
    public function deleteUser()
    {
        $user = new User();
        $user->delete($_GET['id']);
        header('Location: /');
    }
    
    public function updateUser()
    {
        $user = new User();
        $statement = App::getApp()->getDbConnection()->execute('SELECT * FROM user WHERE id=:id', [':id' => $_GET['id']]);
        $row = $statement->fetch('assoc');
        if(!$row)
        {
            header('Location: /');
        }
        if(isset($_POST['save']))
        {
            $user->update($_GET['id'], $_POST);
            $statement = App::getApp()->getDbConnection()->execute('SELECT * FROM user WHERE id=:id', [':id' => $_GET['id']]);
            header('Location: /');
        }
        if($row)
        {
            $user->birth_date = $row['birth_date'];
            $user->email = $row['email'];
            $user->fname = $row['fname'];
            $user->login = $row['login'];
            $user->name = $row['name'];
            $user->lname = $row['lname'];
        }
        
        
        return include __DIR__.'/views/update.php';
    }
    
    public function index()
    {
        return include __DIR__.'/views/index.php';
    }
}

