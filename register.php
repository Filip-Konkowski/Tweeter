<?php
require_once("src/connection.php");
session_start();



if($_SERVER["REQUEST_METHOD"] === "POST"){
    $newUser = Users::register($_POST["email"], $_POST["password1"], $_POST["password2"], $_POST["description"]);
    if($newUser != false){
        $_SESSION["user"] =$newUser;
        header("location: main.php");
    }
    echo "Blad podczas rejestracji";
}

?>

<form method="POST" action="register.php">
    <input type="text" name="email" placeholder="Enter your email">
    <input type="password" name="password1" placeholder="Enter password">
    <input type="password" name="password2" placeholder="Enter password">
    <input type="text" name="description" placeholder="Enter some text">
    <input type="submit" value="Register">
</form>
