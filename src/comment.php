<?php
/*

CREATE TABLE Comments (
            comment_id INT AUTO_INCREMENT,
            text VARCHAR(140),
            creation_date DATETIME,
            user_id INT,
            tweet_id INT,
            PRIMARY KEY(comment_id),
            FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
            FOREIGN KEY (tweet_id) REFERENCES Tweets(tweet_id) ON DELETE CASCADE);
 */

class Comment{
    static private $conn;

    private $id;
    private $userId;
    private $tweetId;
    private $creationDate;
    private $text;


    static public function setConnection (mysqli $newComment){
        self::$conn = $newComment;
    }
    static public function createComment( $userId, $tweetId, $text ){
        $sql = "INSERT INTO Comments (user_id, tweet_id, creation_date, text )
                VALUES ('$userId', '$tweetId', NOW(), '$text' )";
        $result = self::$conn->query($sql);
        if($result = true && strlen($result) <= 60){
            $myComment = new Comment(self::$conn->insert_id, $userId, $tweetId, $text,  date("Y-m-d H:i:s")  );
            return $myComment;
        }
    }

    static public function getCommentByTweetId($tweetId){
        $sql = "SELECT * FROM Comments WHERE tweet_id={$tweetId}";
        $result = self::$conn->query($sql);
        $ret = [];
        if($result == true){
            if($result->num_rows > 0 ){
                while($row = $result->fetch_assoc()){
                    $commentByTweetId = new Comment($row["comment_id"],
                                                    $row["user_id"],
                                                    $row["tweet_id"],
                                                    $row["text"],
                                                    $row["creation_date"]);
                    $ret[] = $commentByTweetId;

                }
            }
        }
        return $ret;
    }
    public function __construct($newId, $newUserId, $newTweetId, $newText, $newCreationDate ){
        $this->id = $newId;
        $this->userId = $newUserId;
        $this->tweetId = $newTweetId;
        $this->setText($newText);
        $this->creationDate = $newCreationDate;


    }
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
        if(is_string($text) == true && strlen($text) <= 60){
            $this->text = $text;
        }
    }
    public function getCreationDate()
    {
        return $this->creationDate;
    }




}