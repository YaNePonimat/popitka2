<?php
include "vendor/autoload.php";
include "app/App.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ERROR|E_WARNING);
$app = new \app\App();
echo $app->run($_SERVER['REQUEST_URI']);
