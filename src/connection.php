<?php

require_once("Users.php");
require_once("tweet.php");
require_once("comment.php");
require_once("message.php");

$userName = "";
$host = "";
$pass = "";
$dbName = "";

$conn = new mysqli($host, $userName, $pass, $dbName);

if ($conn == false){
    die("Connection is not possible");
}

Users::setConnection($conn);
Tweet::setConnection($conn);
Comment::setConnection($conn);
Message::setConnection($conn);
