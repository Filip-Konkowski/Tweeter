<?php
/*

CREATE TABLE Tweets(
  tweet_id INT AUTO_INCREMENT,
  text VARCHAR(140),
  creation_date DATETIME,
  user_id INT,
  PRIMARY KEY (tweet_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE);
 */

class Tweet{
    static private $conn;

    private $id;
    private $userId;
    private $text;
    private $creationDate;

    static public function  setConnection (mysqli $newConnection){
        self::$conn = $newConnection;
    }
    static public function createTweet ($userId, $text){
        if(is_string($text) && strlen($text) <= 140){
            $sql = "INSERT INTO Tweets(text, creation_date, user_id) VALUES ('$text', NOW(), '$userId') ";
            $result = self::$conn->query($sql);
            if($result == true){
                $myTweet = new Tweet(self::$conn->insert_id, $userId, date("Y-m-d H:i:s"), $text);
                return $myTweet;
            }
        }
        return false;
    }
    static public function getTweetById ($id){
        $sql = "SELECT * FROM Tweets WHERE tweet_id=$id";
        $result = self::$conn->query($sql);
        if($result == true){
            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
                $tweetById = new Tweet($row["id"], $row["userId"], $row["text"], $row["creationDate"]);
                return $tweetById;
            }
        }
    }
    static public function loadAllTweets(){
        $ret = [];
        $sql = "SELECT * FROM Tweets ORDER BY creation_date DESC";
        $result = self::$conn->query($sql);
        if ($result == true){
            if($result->num_rows >0){
                while ($row = $result->fetch_assoc()){
                    $loadedTweets = new Tweet($row["tweet_id"],
                                            $row["user_id"],
                                            $row["text"],
                                            $row["creation_date"]);
                    $ret[]=$loadedTweets;
                }
            }
        }
        return $ret;
    }
    static public function loadAllUserTweets($userId){
        $ret= [];
        $sql = "SELECT * FROM Tweets WHERE user_id={$userId}";
        $result = self::$conn->query($sql);
        if ($result == true){
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    $tweetsByUserId = new Tweet($row["tweet_id"],
                                                $row["user_id"],
                                                $row["text"],
                                                $row["creation_date"]);
                    $ret[] = $tweetsByUserId;

                }
            }
        }
        return $ret;
    }
    public function __construct($newId, $newUserId, $newText, $newDate){
        $this->id = $newId;
        $this->creationDate = $newDate;
        $this->setText($newText);
        $this->userId = $newUserId;
    }
/*
    public function updateTweet (){
        $sql = "UPDATE Tweets SET text={$this->text} WHERE tweet_id={$this->id} ";
        $result = self::$conn->query($sql);
        return $result;
    }
*/
    public function getId()
    {
        return $this->id;
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function getText()
    {
        return $this->text;
    }
    public function setText($text)
    {
        if (is_string($text) && strlen($text) <= 140){
            $this->text = $text;
        }
    }
    public function getCreationDate()
    {
        return $this->creationDate;
    }
}
