<?php

require_once("Users.php");
require_once("tweet.php");
require_once("comment.php");
require_once("message.php");

$userName = "";
$host = "localhost";
$pass = "";
$dbName = "tweeter";

$conn = new mysqli($host, $userName, $pass, $dbName);

if ($conn == false){
    die("Connection is not possible");
}

Users::setConnection($conn);
Tweet::setConnection($conn);
Comment::setConnection($conn);
Message::setConnection($conn);
//$createUser = Users::register("1@1", "123", "123", "To jest uzytkownik 1@! lalala", "Janusz111");
//var_dump($createUser);
//$login = Users::login("root1", "coderslab");
//$login->setDescription("lalalatu");
//$login->saveToDB();
//$login->getUserName();
//var_dump($login);

//$allOutbox = Message::viewAllOutboxByAuthorId(7);
//var_dump($allOutbox);

//$mess = Message::getReciverInfo(10);
//var_dump($mess);

//$mess = Message::getReciverName(10);
//echo ($mess);

//$newMessage1 = Message::createMessage(8,10, "Hi Janusz");
//var_dump($newMessage1);

//var_dump($login);
//$createComment = Comment::createComment(1,1,"To komentarz user-1 twee-1");
//var_dump($createComment);

/*
$gettweetById = Tweet::getTweetById(1);
foreach($gettweetById as $val) {
    echo "<br>". $val->getText();
    echo "date: {$val->getCreationDate()}";
}

$getComByTweetId = Comment::getCommentByTweetId(1);
foreach($getComByTweetId as $val){
    echo $val->getText();
    echo "date: {$val->getCreationDate()}";

}
*/

//$myNewTweet = Tweet::createTweet(1, "to jest pierwszy tweet");
//var_dump($myNewTweet);
