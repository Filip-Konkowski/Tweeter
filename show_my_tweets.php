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
<h2>Your tweets</h2>



<?php

$allTweets = Tweet::loadAllUserTweets($myUser->getId());

foreach ($allTweets as $tweet){

    $userId = $tweet->getUserId();
    $allUsers = Users::getUserById($userId);
    echo "<br>Tweet by user name: {$allUsers->getUserName()}<br>";
    echo "Text: {$tweet->getText()}<br>";
    echo "Creation Date: {$tweet->getCreationDate()}<br>";
    echo "<a href='edit_tweet.php?tweet_id={$tweet->getId()}'>Edit tweet </a><br> ";
}

if ($_SERVER["REQUEST_METHOD"] === "POST"){

}
?>

</body>
</html>