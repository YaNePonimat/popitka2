Версия языка - PHP > 5.6.
Версия БД - sqllite > 3

После надо запустить git bash here из контекстного меню
Выполнить там команду 
git add readme.txt
git commit -m "fix readme"
git push origin master

1) Установить cakephp/database консольной командой composer require cakephp/database
https://github.com/cakephp/database
2) Скопировать проект из git репозитория
3)  создать  директорию для базы данных
4) создать в корне сайта файл config.php и указать путь до файла с базой данных

<?php

return array(
    'dbpath' => __DIR__.'/dbpath/file.db',//путь до файла с базой данных
);

4) Запустить скрипт install.php в корне сайта

для тестирования

5) установить phpunit https://phpunit.de/getting-started/phpunit-7.html командой composer require --dev phpunit/phpunit

6) установить codeception командой composer require "codeception/codeception" --dev

7) установить расширение Selenium IDE https://chrome.google.com/webstore/detail/selenium-ide/mooikfkahbdckldjjndioackbalphokd в браузер и загрузить приёмочные тесты из файла user.side



