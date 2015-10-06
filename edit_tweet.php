<?php
require_once("src/connection.php");
session_start();
if (isset($_SESSION["user"]) == false) {
    header("location: login.php");
}


$myUser = $_SESSION["user"];
$tweetIdToShow = $_GET["tweet_id"];
$tweetToShow = Tweet::getTweetById($tweetIdToShow);
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $tweetToShow->setText($_POST["editedTweetText"]);
    $tweetToShow->updateTweet();
}


?>
<html>

<head>

</head>

<body>
<form method='POST' action='edit_tweet.php?tweet_id=<?php echo $_GET["tweet_id"]; ?>'>
    <br>
    <input type='text' name='editedTweetText'>
    <input type='submit' value='edit tweet'>
    <a href="main.php">link to main</a>
</form>

<?php


$tweetToShow = Tweet::getTweetById($tweetIdToShow);
if($tweetToShow != false) {
    echo "<b>Text of tweet</b>: {$tweetToShow->getText()}<br>";
    echo "Creation Date: {$tweetToShow->getCreationDate()}<br>";
}


