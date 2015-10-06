<?php
require_once("src/connection.php");
session_start();

$myUser = $_SESSION["user"];

?>

<html>
<head>

</head>
<body>
    <form action="newMessage.php" method="POST">
    <fieldset>
        <label>
            <label>
            <textarea cols="40" rows="10" name="text"></textarea>
            </label>
            <label>
            <select name="reciverId">
                <?php
                $allUsers = Users::getAllUsers();
                foreach ($allUsers as $user){
                    echo "<option value={$user->getId()}>{$user->getUserName()}</option>";
                }
                ?>

            </select>
            </label>
            <input type="submit" name="send" value="send">

        </label>
    </fieldset>
    </form>
    <a href='messagesWindow.php?user_id=<?php echo $myUser->getId(); ?>'> messages</a>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $newMessage =  Message::createMessage($myUser->getId(), $_POST["reciverId"], $_POST["text"]);
}
