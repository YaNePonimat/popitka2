<?php
namespace app;
include 'Controller.php';
include 'User.php';
use Cake\Database\Connection;

class App
{
    /**
     *
     * @var App 
     */
    static $app;
    /**
     * 
     * @return App
     */
    public static function getApp()
    {
        return static::$app;
    }
    /**
     * 
     * @param App $app
     */
    protected static function setApp($app)
    {
        static::$app = $app;
    }
    /**
     *
     * @var array 
     */
    protected $config;
    
    /**
     * подключение к базе данных
     * @var Connection 
     */
    protected $dbConnetion;
    
    public function __construct()
    {
        session_start();
        $this->config = include __DIR__.'/../config.php';
        $this->initDb();
        static::setApp($this);
    }
    
    /**
     * установление соединения к базе данных
     */
    protected function initDb()
    {
        $this->dbConnetion = new Connection([
                'driver' => 'Cake\Database\Driver\Sqlite',
                'database' => $this->config['dbpath']
        ]);
    }
    
    /**
     * получение установленного соединения к базе данных
     * @return Connection
     */
    public function getDbConnection()
    {
        return $this->dbConnetion;
    }
    
    /**
     * запуск приложения
     * выбор действия
     * @param string $requestUri
     * @return string
     */
    public function run($requestUri)
    {
        $uri = explode('?', explode('/', trim($requestUri, '/'))[0])[0];
        $controller = new Controller();
        switch($uri)
        {
            case 'create':
                return $controller->createUser(); 
            case 'update':
                return $controller->updateUser();
            case 'delete':
                return $controller->deleteUser();
            case 'login-username-pass':
                return $controller->loginUsernamePass();
            case 'login-auth-key':
                return $controller->loginAuthKey();
            case 'recovery':
                return $controller->recovery();
        }
        return $controller->index();
    }
    
    /**
     * 
     * @return \app\User[]
     */
    public function getUsers()
    {
        $users = array();
        $statement = $this->getDbConnection()->execute('SELECT * FROM user');
        while($row = $statement->fetch('assoc')) 
        {
            $user = new User();
            $user->id = $row['id'];
            $user->auth_key = $row['auth_key'];
            $user->birth_date = $row['birth_date'];
            $user->created_at = $row['created_at'];
            $user->email = $row['email'];
            $user->fname = $row['fname'];
            $user->is_blocked = $row['is_blocked'];
            $user->login = $row['login'];
            $user->name = $row['name'];
            $user->password = $row['password'];
            $user->updated_at = $row['updated_at'];
            $user->lname = $row['lname'];
            $users[] = $user;
        }
        return $users;
    }
    
    /**
     * текущий авторизованный пользователь
     * @return \app\User
     */
    public function currentUser()
    {
        $user = new User();
        if(!isset($_SESSION['user-id']))
        {
            return null;
        }
        $statement = $this->getDbConnection()->execute('SELECT * FROM user WHERE id=:id', [':id' => $_SESSION['user-id']]);
        $row = $statement->fetch('assoc');
        if($row)
        {
            $user->auth_key = $row['auth_key'];
            $user->birth_date = $row['birth_date'];
            $user->created_at = $row['created_at'];
            $user->email = $row['email'];
            $user->fname = $row['fname'];
            $user->is_blocked = $row['is_blocked'];
            $user->login = $row['login'];
            $user->name = $row['name'];
            $user->password = $row['password'];
            $user->updated_at = $row['updated_at'];
            $user->lname = $row['lname'];
            return $user;
        }
        return null;
    }
    
    /**
     * получение пользователя по идентификатору
     * @param int|string $id
     * @return \app\User
     */
    public function getUserById($id)
    {
        $user = new User();
        $statement = $this->getDbConnection()->execute('SELECT * FROM user WHERE id=:id', [':id' => (int)$id]);
        $row = $statement->fetch('assoc');
        if($row)
        {
            $user->auth_key = $row['auth_key'];
            $user->birth_date = $row['birth_date'];
            $user->created_at = $row['created_at'];
            $user->email = $row['email'];
            $user->fname = $row['fname'];
            $user->is_blocked = $row['is_blocked'];
            $user->login = $row['login'];
            $user->name = $row['name'];
            $user->password = $row['password'];
            $user->updated_at = $row['updated_at'];
            $user->lname = $row['lname'];
            return $user;
        }
        return null;
    }
    
    public function loginUser($userId)
    {
        $_SESSION['user-id'] = $userId;
    }
}

