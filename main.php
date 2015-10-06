<?php
require_once("src/connection.php");
session_start();

if(isset($_SESSION["user"]) == false){
    header("location: login.php");
}
$myUser = $_SESSION["user"];

if($_SERVER["REQUEST_METHOD"] === "POST" ){
    Tweet::createTweet($myUser->getId(),$_POST["tweet"]);
}
echo ("Witaj " . $myUser->getEmail());
?>
<html>
<head>

</head>
<body>



<form action="main.php" method="POST" >
    <input type="text" name="tweet" placeholder="dodaj tweet">
    <input type="submit" value="send">
    <a href='messagesWindow.php?user_id=<?php echo $myUser->getId(); ?>'>create message</a>
</form>
    <a href='show_user.php?user_id=<?php echo $myUser->getId()?>'>User Profile</a><br>
    <br><a href='show_my_tweets.php?user_id=<?php echo $myUser->getId(); ?>'>Show my tweets</a><br>
<?php

$allTweets = Tweet::loadAllTweets();

foreach ($allTweets as $tweet){

    $userId = $tweet->getUserId();
    $allUsers = Users::getUserById($userId);
    echo "<br>Tweet by user name: {$allUsers->getUserName()}<br>";
    echo "Text: {$tweet->getText()}<br>";
    echo "Creation Date: {$tweet->getCreationDate()}<br>";
    echo "<a href='comment_tweet.php?tweet_id={$tweet->getId()}'>SHOW Tweet </a><br> ";
}

?>


</body>

</html>
