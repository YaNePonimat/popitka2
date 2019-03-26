Версия языка - PHP > 5.6.
Версия БД - sqllite > 3

Установить xampp и запустить
После надо запустить git bash here из контекстного меню
Выполнить там команду 
git add readme.txt
git commit -m "fix readme"
git push origin master

1) Установить cakephp/database консольной командой composer require cakephp/database
https://github.com/cakephp/database
2)  создать  директорию для базы данных dbpath
3) создать в корне сайта файл config.php и указать путь до файла с базой данных

<?php

return array(
    'dbpath' => __DIR__.'/dbpath/file.db',//путь до файла с базой данных
);

4) Запустить скрипт install.php в корне сайта

для тестирования

5) установить phpunit https://phpunit.de/getting-started/phpunit-7.html командой composer require --dev phpunit/phpunit

6) установить codeception командой composer require "codeception/codeception" --dev

7) Юнит тесты - vendor\bin\phpunit.bat tests\UserTest.php
Функциональные - vendor\bin\codecept.bat run acceptance tests\UserCodeceptionTest



