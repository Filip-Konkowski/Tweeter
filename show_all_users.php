<?php

require_once("src/connection.php");
session_start();

if(isset($_SESSION["user"]) == false){
    header("location: login.php");
}
$myUser = $_SESSION["user"];
$allUsers = Users::getAllUsers();
foreach($allUsers as $user){
    echo "{$user->getEmail()}";
    echo "<a href='show_all_user.php?user_id={$user->getEmail()}'>link</a>";
    echo "<br>";
}