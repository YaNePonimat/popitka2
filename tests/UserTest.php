<?php
namespace tests;
use \PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * тестирование метода авторизации.
     * Создаётся пользователь с рандомными данными.
     * Вызывается метод авторизации по логину и паролю и сравнивается возврщаемый результат с ожидаемым.
     * 
     * Вызывается метод авторизации по ключу и сравнивается возврщаемый результат с ожидаемым.
     * Тестовый пользователь удаляется
     */
    public function testAuth()
    {
        $user = new \app\User();
        $fileds = array();
        $fileds['email'] = uniqid("mail").'@example.com';
        $fileds['login'] = uniqid("login");
        $fileds['name'] = 'name';
        $fileds['fname'] = 'fname';
        $fileds['lname'] = 'lname';
        $fileds['password'] = uniqid();
        $fileds['birth_date'] = date('Y-m-d');
        $user->create($fileds);
        $loginResultWithUsernamePass = $user->loginWithUsernamePass($fileds['login'], $fileds['password']);       
        $this->assertEquals($loginResultWithUsernamePass, true, 'With login pass');
        $statement = \app\App::getApp()->getDbConnection()->execute('SELECT * FROM user WHERE login=:login', [':login' => $fileds['login']]);
        $row = $statement->fetch('assoc');
        $loginResultWithAuthKey = $user->loginWithAuthKey($row['auth_key']);
        $this->assertEquals($loginResultWithAuthKey, true, 'With auth_key');
        $user->delete($row['id']);
    }
    /**
     * метода регистрации; 
     * Создаётся пользователь с рандомными данными.
     * Проверяется, появился ли пользователь с указанными данными
     * Тестовый пользователь удаляется
     */
    public function testRegistration()
    {
        $user = new \app\User();
        $fileds = array();
        $fileds['email'] = uniqid("mail").'@example.com';
        $fileds['login'] = uniqid("login");
        $fileds['name'] = 'name';
        $fileds['fname'] = 'fname';
        $fileds['lname'] = 'lname';
        $fileds['password'] = uniqid();
        $fileds['birth_date'] = date('Y-m-d');
        $user->registration($fileds);
        $statement = \app\App::getApp()->getDbConnection()->execute('SELECT * FROM user WHERE login=:login', [':login' => $fileds['login']]);
        $row = $statement->fetch('assoc');
        $this->assertEquals($row['email'], $fileds['email'], 'Registration');
        $user->delete($row['id']);
    }
    
    /**
     * метода генерации пароля
     * Создаётся пользователь с рандомными данными без указания пароля.
     * Данные поля password сравнивается с пустой строкой и с хэшом пустой строки
     * Тестовый пользователь удаляется
     */
    public function testPassGenerator()
    {
        $user = new \app\User();
        $fileds['email'] = uniqid("mail").'@example.com';
        $fileds['login'] = uniqid("login");
        $fileds['name'] = 'name';
        $fileds['fname'] = 'fname';
        $fileds['lname'] = 'lname';
        $fileds['password'] = '';
        $fileds['birth_date'] = date('Y-m-d');
        $user->registration($fileds);
        $statement = \app\App::getApp()
                ->getDbConnection()
                ->execute('SELECT * FROM user WHERE login=:login', [':login' => $fileds['login']]);
        $row = $statement->fetch('assoc');
        
        $this->assertEquals($row 
                && $row['password'] !== '' 
                && $row['password'] !== md5(''), true, 'Pass generator');
        
        $user->delete($row['id']);
    }
    
    /**
     * расчета возраста пользователя;
     * Создаётся пользователь с рандомными данными
     * Проверяется метод getAge
     * Тестовый пользователь удаляется
     */
    public function testAgeCounter()
    {
        $user = new \app\User();
        $fileds['email'] = uniqid("mail").'@example.com';
        $fileds['login'] = uniqid("login");
        $fileds['name'] = 'name';
        $fileds['fname'] = 'fname';
        $fileds['lname'] = 'lname';
        $fileds['password'] = 'password';
        $fileds['birth_date'] = date('Y-m-d', rand(0, time()));
        $user->registration($fileds);
        $statement = \app\App::getApp()->getDbConnection()->execute('SELECT * FROM user WHERE login=:login', [':login' => $fileds['login']]);
        $row = $statement->fetch('assoc');
        $user->birth_date = $fileds['birth_date'];
        $from = new \DateTime($fileds['birth_date']);
        $to   = new \DateTime('today');
        $this->assertEquals($from->diff($to)->y, $user->getAge(), 'Age counter');
        $user->delete($row['id']);
    }
}