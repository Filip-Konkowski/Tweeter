<?php
require_once("src/connection.php");
session_start();
if (isset($_SESSION["user"]) == false) {
    header("location: login.php");
}

$myUser = $_SESSION["user"];

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $myUser->setDescription($_POST["description"]);
    $myUser->saveToDB();

}
?>


<form method="POST" action="edit_user.php">
    <input type="text" name="description" placeholder="Enter new description">
    <input type="submit" value="Update">
</form>