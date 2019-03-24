<?php
include "vendor/autoload.php";
use Cake\Database\Connection;

function installdb()
{
    $config = include 'config.php';
    file_put_contents($config['dbpath'], '');
    $connection = new Connection([
                'driver' => 'Cake\Database\Driver\Sqlite',
                'database' => $config['dbpath']
        ]);
    $connection->execute("CREATE TABLE user ("
            . "id INTEGER PRIMARY KEY,"
            . "email text NOT NULL UNIQUE,"
            . "login text NULL,"
            . "password text NOT NULL,"
            . "created_at INTEGER NULL,"//timestamp
            . "updated_at INTEGER NULL,"//timestamp
            . "fname text NULL,"
            . "name text NULL,"
            . "lname text NULL,"
            . "birth_date text NULL,"//формат времени YYYY-MM-DD
            . "is_blocked INTEGER DEFAULT 0,"//timestamp
            . "auth_key text NULL,"
            . "token text NULL"//код для восстановления
            . ")");
    echo "Success install";
}
installdb();

