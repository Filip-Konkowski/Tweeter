<?php
/*

CREATE TABLE Messages (
            message_id INT AUTO_INCREMENT,
            text VARCHAR(255),
            creation_date DATETIME,
            author_id INT,
            receiver_id INT,
            PRIMARY KEY (message_id),
            FOREIGN KEY (author_id) REFERENCES Users(user_id) ON DELETE CASCADE,
            FOREIGN KEY (receiver_id) REFERENCES Users(user_id) ON DELETE CASCADE);


 */

class Message {
    static private $conn;

    private $id;
    private $authorId;
    private $receiverId;
    private $text;
    private $creationDate;

    static public function setConnection(mysqli $newConnection){
        self::$conn = $newConnection;
    }
    static public function createMessage($authorId, $receiverId, $text){
        $sql = "INSERT INTO Messages(text, creation_date, author_id, receiver_id) VALUES('$text', NOW(), '$authorId', '$receiverId' )";
        $result = self::$conn->query($sql);
        if($result == true){
            $newMessage = new Message(self::$conn->insert_id, $authorId, $receiverId, $text, date("Y-m-d H:i:s"));
            return $newMessage;
        }
        return false;
    }

    static public function viewAllOutboxByAuthorId($authorId){
        $ret = [];
        $sql = "SELECT * FROM Messages WHERE author_id='$authorId'";
        $result = self::$conn->query($sql);
        if($result == true){
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    $outboxMessage = new Message($row["message_id"],
                                                $row["author_id"],
                                                $row["receiver_id"],
                                                $row["text"],
                                                $row["creation_date"]);
                    $ret[] = $outboxMessage;
                }
            }
            return $ret;
        }

    }

    static public function viewAllInboxByReceiverId($receiverId){
        $res = [];
        $sql = "SELECT * FROM Messages WHERE receiver_id='$receiverId'";
        $result = self::$conn->query($sql);
        if ($result == true){
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    $inboxMasseges = new Message($row["message_id"],
                                                $row["author_id"],
                                                $row["receiver_id"],
                                                $row["text"],
                                                $row["creation_date"]);
                    $res[] = $inboxMasseges;
                }
            }
        }
        return $res;
    }

    public function __construct($newId, $newAuthorId, $newReceiverId, $newText, $newCreationDate){
        $this->id =$newId;
        $this->authorId = $newAuthorId;
        $this->receiverId = $newReceiverId;
        $this->setText($newText);
        $this->creationDate = $newCreationDate;
    }
    public function getId(){
        return $this->id;
    }
    public function getAuthorId(){
        return $this->authorId;
    }
    public function getReceiverId(){
        return $this->receiverId;
    }

    public function getText(){
        return $this->text;
    }
    public function setText($text){
        if (is_string($text)){
            $this->text = $text;
        }
    }
    public function getCreationDate(){
        return $this->creationDate;
    }


}