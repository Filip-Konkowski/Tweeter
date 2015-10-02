<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 02.10.15
 * Time: 11:12
 */
require_once("Users.php");
$userName = "";
$host = "";
$pass = "";
$dbName = "";

$conn = new mysqli($host, $userName, $pass, $dbName);

if ($conn == false){
    die("Connection is not possible");
}

Users::setConnection($conn);
//$createUser = Users::register("nowy@goo.pl", "haslo1", "haslo1", "Taki zapis");
//var_dump($createUser);
//$login = Users::login("apf1234@goo.pl", "haslo1");
//$login->setDescription("lalalatu");
//$login->saveToDB();
//var_dump($login);
