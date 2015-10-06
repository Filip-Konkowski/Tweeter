<?php

require_once("src/connection.php");
session_start();

if (isset($_SESSION["user"]) == false){
    header("location: login.php");
}

$myUser = $_SESSION["user"];
?>


<html>
<head>

</head>
<body>
    <div>
        <a href="newMessage.php?userId=<?php echo $myUser->getId() ?>">new message</a>
    </div>
    <div>
        Outbox:
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET"){

    $outboxMessages = Message::viewAllOutboxByAuthorId($_GET["user_id"]);
    foreach ($outboxMessages as $message){
        $receiverId = $message->getReceiverId();
        $allUsers = Users::getUserById($receiverId);
        echo "<br>Message no: {$message->getId()}";
        echo "<br> <b>sent to:</b> {$allUsers->getUserName()}";
        echo "<br> text of message: {$message->getText()}<br>";
    }


}
?>
    </div>
    <div>
        <br><b>Inbox:</b>
    </div>
    <div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET"){

            $outboxMessages = Message::viewAllInboxByReceiverId($_GET["user_id"]);
            foreach ($outboxMessages as $key => $message){
                $receiverId = $message->getAuthorId();
                $allUsers = Users::getUserById($receiverId);
                echo "<br>Message no: ".  ($key+1);
                echo "<br> <b>sent to:</b> {$allUsers->getUserName()}";
                echo "<br> text of message: {$message->getText()}<br>";
            }


        }
        ?>
    </div>


</body>
</html>