<?php

require_once("src/connection.php");
session_start();

if(isset($_SESSION["user"]) == false){
    header("location: login.php");
}

$myUser = $_SESSION["user"];



?>
<html>

<head>

</head>

<body>
    <form method='POST' action='comment_tweet.php?tweet_id=<?php echo $_GET["tweet_id"]; ?>'>
        <br>
        <input type='text' name='commentText'>
        <input type='submit' value='comment'>
        <a href="main.php">link to main</a>
    </form>


<?php
if($_SERVER["REQUEST_METHOD"] === "POST") {

    $newComment = Comment::createComment($myUser->getId(), $_GET["tweet_id"], $_POST["commentText"]);

}

    $tweetIdToShow = $_GET["tweet_id"];
    $tweetToShow = Tweet::getTweetById($tweetIdToShow);
    if($tweetToShow != false){
        echo "<b>Text of tweet</b>: {$tweetToShow->getText()}<br>";

    }

    $allCommentsByTweet = Comment::getCommentByTweetId($_GET["tweet_id"]);
    foreach ($allCommentsByTweet as $value){
        $userId = $value->getUserId();
        $allUsers = Users::getUserById($userId);
        echo "<br>Comment text: {$value->getText()}";
        echo "<br><b>comment created by</b>: {$allUsers->getUserName()}";
        echo "<br>date of creation: {$value->getCreationDate()}<br>";
    }




?>


</body>

</html>