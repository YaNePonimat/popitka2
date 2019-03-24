<?php
namespace app;
/**
 * - email* 
- login 
- password* (хранится хешированный пароль, md5); 
- created_at (дата создания) 
- updated_at (дата обновления) 
- fname (фамилия) 
- name (имя) 
- lname (отчество) 
- birth_date (дата рождения) 
- is_blocked (заблокирован ли пользователь) 
- auth_key (ключ авторизации); 
И методами: 
- создание/обновление/удаление пользователя; 
- авторизации по логину и паролю; 
- авторизации по ключу; 
- регистрации; 
- восстановление пароля; 
- генерации пароля, если при регистрации поле оставлено пустым; 
- расчет возраста пользователя на основе даты рождения; 
- вывода полностью ФИО (к примеру, «Бережков Андрей Вячеславович); 
- вывода Фамилии и инициалов (к примеру, Бережков А.В.);
 */
class User
{
    public $id;
    public $email;
    public $login;
    public $password;
    public $created_at;
    public $updated_at;
    public $fname;
    public $name;
    public $lname;
    public $birth_date;
    public $is_blocked;
    public $auth_key;
    
    /**
     * добавление пользователя в базу данных
     * @param array $fields
     */
    public function create($fields)
    {
        $insertFields = array();
        $insertFields['email'] = $fields['email'];
        $insertFields['login'] = $fields['login'];
        $insertFields['name'] = $fields['name'];
        $insertFields['fname'] = $fields['fname'];
        $insertFields['lname'] = $fields['lname'];
        $insertFields['created_at'] = time();
        $insertFields['auth_key'] = bin2hex(random_bytes(32));
        if($fields['birth_date'])
        {
            $insertFields['birth_date'] = date('Y-m-d', strtotime($fields['birth_date']));
        }
        if($fields['password'])
        {
            $insertFields['password'] = md5($fields['password']);
        }
        else
        {
            $insertFields['password'] = $this->generateRandPassword();
        }
        \app\App::getApp()->getDbConnection()->insert('user', $insertFields);
    }
    /**
     * обновление пользователя с идентификатором $id
     * @param int|string $id
     * @param array $fields
     */
    public function update($id, $fields)
    {
        $updateFields = array();
        $updateFields['email'] = $fields['email'];
        $updateFields['login'] = $fields['login'];
        $updateFields['name'] = $fields['name'];
        $updateFields['fname'] = $fields['fname'];
        $updateFields['lname'] = $fields['lname'];
        if($fields['password'])
        {
            $updateFields['password'] = md5($fields['password']);
        }
        if($fields['birth_date'])
        {
            $updateFields['birth_date'] = date('Y-m-d', strtotime($fields['birth_date']));
        }
        $updateFields['updated_at'] = time();
        \app\App::getApp()->getDbConnection()->update('user', $updateFields, ['id' => $id]);
    }
    /**
     * удаление пользователя с идентификатором $id
     * @param int|string $id
     */
    public function delete($id)
    {
        \app\App::getApp()->getDbConnection()->delete('user', ['id' => $id]);
    }
    /**
     * авторизации по логину и паролю; 
     * @param string $login
     * @param string $pass
     * @return boolean
     */
    public function loginWithUsernamePass($login, $pass)
    {
        $statement = \app\App::getApp()->getDbConnection()->execute('SELECT * FROM user WHERE login=:login', [':login' => $login]);
        $row = $statement->fetch('assoc');
        if($row && $row['password'] === md5($pass))
        {
            \app\App::getApp()->loginUser($row['id']);
            return TRUE;
        }
        return false;
    }
    /**
     * авторизации по ключу
     * @param string $authKey
     * @return boolean
     */
    public function loginWithAuthKey($authKey)
    {
        $statement = \app\App::getApp()->getDbConnection()->execute('SELECT * FROM user WHERE auth_key=:auth_key', [':auth_key' => $authKey]);
        $row = $statement->fetch('assoc');
        if($row)
        {
            \app\App::getApp()->loginUser($row['id']);
            return TRUE;
        }
        return false;
    }
    
    /**
     * востановление пароля
     * @param string $token
     * @param string $newPassword
     */
    public function recoveryPassword($token, $newPassword)
    {
        $statement = \app\App::getApp()->getDbConnection()->execute('SELECT * FROM user WHERE token=:token', [':token' => $token]);
        $row = $statement->fetch('assoc');
        if($row)
        {
            $fields['password'] = md5($newPassword);
            $fields['token'] = '';
            \app\App::getApp()->getDbConnection()->update('user', $fields, ['id' => $row['id']]);
        }
    }
    
    /**
     * генерация случайного пароля
     * @return string
     */
    protected function generateRandPassword()
    {
        return bin2hex(random_bytes(16));
    }
    
    public function getAge()
    {
        $from = new \DateTime($this->birth_date);
        $to   = new \DateTime('today');
        return $from->diff($to)->y;
    }
    
    /**
     * полностью ФИО
     * @return string
     */
    public function getFullName()
    {
        $fullName = '';
        if($this->fname)
        {
            $fullName = $fullName.' '.$this->fname;
        }
        if($this->name)
        {
            $fullName = $fullName.' '.$this->name;
        }
        if($this->lname)
        {
            $fullName = $fullName.' '.$this->lname;
        }
        return $fullName;
    }
    
    /**
     * Фамилии и инициалов
     * @return string
     */
    public function getShortName()
    {
        $shortName = $this->fname;
        if($this->name)
        {
            $shortName = $shortName.' '.mb_substr($this->name, 0, 1, 'UTF-8').'.';
            if($this->lname)
            {
                $shortName = $shortName.mb_substr($this->lname, 0, 1, 'UTF-8').'.';
            }
        }
        else
        {
            if($this->lname)
            {
                $shortName = $shortName.' '.mb_substr($this->lname, 0, 1, 'UTF-8').'.';
            }
        }
        return $shortName;
    }
    
    public function registration($fields)
    {
        return $this->create($fields);
    }
}