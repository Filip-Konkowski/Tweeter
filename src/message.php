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
    static public function sendMessage(){

    }

    /*
    static public function theReceiverAdress(){

    }
    */
    static public function viewAllOutboxByUserId(){

    }
    static public function viewAllInboxByUserId(){

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