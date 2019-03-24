<?php
namespace tests;
include_once __DIR__.'/../app/common.php';

class UserCodeceptionTest extends \Codeception\Test\Unit
{
    /**
     * функциональный тест для формы авторизации
     * Создаётся новый пользователь
     * Далее логин и пароль вводятся через форму.
     * Авторизованного пользоввателя перекинет на главную страницу, нде будет выведена фраза "текущий пользователь"
     */
    public function testAuthForm()
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
        $scenario = new \Codeception\Scenario($this);
        $I = new \AcceptanceTester($scenario);
        $I->amOnPage('/login-username-pass/');
        $I->fillField('login', $fileds['login']);
        $I->fillField('password', $fileds['password']);
        $I->click('[type=submit]');
        $I->amOnPage('/');
        $I->see('fname name lname');
        $user->delete($row['id']);
    }
    
    /**
     * функциональный тест для формы регистрации
     * Открывается форма регистрации
     * Заполняются поля
     * Нажимается кнопка "Сохранить"
     * Должна открыться страница со списокм пользователей,
     * где должен быть выведен логин только что зарегестрированного  пользователя
     */
    public function testRegistrationForm()
    {
        $user = new \app\User();
        $fileds = array();
        $fileds['email'] = uniqid("mail").'@example.com';
        $fileds['login'] = uniqid("login");
        $fileds['name'] = 'name';
        $fileds['fname'] = 'fname';
        $fileds['lname'] = 'lname';
        $fileds['password'] = 'password';
        $fileds['birth_date'] = date('Y-m-d', rand(0, time()));
        $scenario = new \Codeception\Scenario($this);
        $I = new \AcceptanceTester($scenario);
        $I->amOnPage('/create/');
        $I->fillField('form input[name=email]', $fileds['email']);
        $I->fillField(['name' => 'login'], $fileds['login']);
        $I->fillField(['name' => 'password'], $fileds['password']);
        $I->fillField(['name' => 'name'], $fileds['name']);
        $I->fillField(['name' => 'fname'], $fileds['fname']);
        $I->fillField(['name' => 'lname'], $fileds['lname']);
        $I->fillField(['name' => 'birth_date'], $fileds['birth_date']);
        $I->click('form button[type=submit]');
        $I->see($fileds['login']);
        $statement = \app\App::getApp()->getDbConnection()->execute('SELECT * FROM user WHERE login=:login', [':login' => $fileds['login']]);
        $row = $statement->fetch('assoc');
        $user->delete($row['id']);
    }
}