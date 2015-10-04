<?php

require_once("src/connection.php");
session_start();

if(isset($_SESSION["user"]) == false){
    header("location: login.php");
}

$myUser = $_SESSION["user"];
//$myTweets = Tweet::loadAllUserTweets($myUser->getId());

if ($_SERVER["REQUEST_METHOD"] == "GET" or "POST"){
    $tweetIdToShow = $_GET["tweet_id"];
    $tweetToShow = Tweet::getTweetById($tweetIdToShow);
    if($tweetToShow != false){
        echo "Text tweeta: {$tweetToShow->getText()}<br>";
    }

}
?>


<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $newComment = Comment::createComment($myUser->getId(), $_GET["tweet_id"], $_POST["commentText"]  );
    $allCommentsByTweet = Comment::getCommentByTweetId($_GET["tweet_id"]);
    foreach ($allCommentsByTweet as $value){
        echo "Comment of this Tweet: {$value->getText()}<br>";
    }


}
?>
<form method='POST' action='show_tweet.php?tweet_id=<?php echo $_GET["tweet_id"];?>'>
    <br>
    <input type='text' name='commentText'>
    <input type='submit' value='comment'>
    <a href="main.php">link to main</a>
</form>


