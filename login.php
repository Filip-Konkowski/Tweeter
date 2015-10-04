<?php
require_once("src/connection.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $error = "";
    $user = Users::login($_POST["mail"], $_POST["password"]);
    if($user != false){
        $_SESSION["user"] = $user; // Session to tablica "user" to klucz pod ktorym sobie trzymamy obiet $user
        header("location: main.php"); //przesyla do strony main.php
    }
    $error = "Zly login lub haslo";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tweeter</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<h1>Witaj</h1>

<form action="login.php" method="POST">
    <input type="text" name="mail" placeholder="Enter email">
    <input type="password" name="password" placeholder="Enter password">
    <input type="submit" value="login">
</form>
<div class="alert-warning">
    <?php //echo ($error); ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>