<?php
require_once("src/connection.php");
session_start();

if(isset($_SESSION["user"]) == false){
    header("location: login.php");
}
$myUser = $_SESSION["user"];

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $userIdToShow = $_GET["user_id"];
    $userToShow = Users::getUserById($userIdToShow);
    if($userToShow != false){
        echo "Stron usera {$userToShow->getEmail()}<br>";
        echo "Name of user: {$userToShow->getUserName()}<br>";
        echo "Description of user: {$userToShow->getDescription()}<br>";
    }

}