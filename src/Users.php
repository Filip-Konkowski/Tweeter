<?php
/*

CREATE TABLE Users (
  user_id INT AUTO_INCREMENT,
  email VARCHAR(60) UNIQUE,
  password CHAR(60),
  description VARCHAR(255),
  PRIMARY KEY (user_id));

  ALTER TABLE Users ADD user_name VARCHAR(30);
 */

class Users{
    static private $conn;
    private $id;
    private $userName;
    private $email;
    private $description;

    static public function  setConnection (mysqli $newConnection){
        self::$conn = $newConnection;
    }
    static public function login($email, $password){
        $sql = "SELECT * FROM Users WHERE email='$email'";
        $result = self::$conn->query($sql);

        if($result == true){
            if($result->num_rows == 1){
                $row = $result->fetch_assoc();

                if (password_verify($password, $row["password"])){
                    $loggedUser = new Users ($row["user_id"], $row["email"], $row["description"], $row["user_name"]);
                    return $loggedUser;
                }
            }
        }
    }
    static public function register($newEmail, $password, $password2, $newDescription, $newUserName){
        if ($password != $password2){
            return false;
        }

        $hassedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO Users (email, password, description, user_name)
        VALUES ('$newEmail', '$hassedPassword', '$newDescription', '$newUserName')";
        $result = self::$conn->query($sql);
        if($result == true){
            $newUser = new Users(self::$conn->insert_id, $newEmail, $newDescription, $newUserName);
            return $newUser;
        }
        return false;
    }
    static public function getUserById($id){
        $sql = "SELECT * FROM Users WHERE user_id ={$id}";
        $return = self::$conn->query($sql);
        if($return == true){
            if($return->num_rows == 1){
                $row = $return->fetch_assoc();
                $loggedUser = new Users($row["user_id"], $row["email"], $row["description"], $row["user_name"] );
                return$loggedUser;
            }
        }
    }
    static public function getAllUsers(){
        $ret = [];
        $sql = "SELECT * FROM Users ";
        $result = self::$conn->query($sql);
        if ($result == true){
            if($result->num_rows > 0 ){
                while ($row = $result->fetch_assoc()){
                    $loadedUser = new Users($row["user_id"], $row["email"], $row["description"], $row["user_name"]);
                    $ret[] = $loadedUser;
                }
            }
        }
        return $ret;
    }
    public function __construct($newId, $newEmail, $newDescription, $newUserName){
        $this->id =$newId;
        $this->email = $newEmail;
        $this->description = $newDescription;
        $this->setUserName($newUserName);

    }

    public function saveToDB(){
        $sql = "UPDATE Users SET description='{$this->description}' WHERE user_id='{$this->id}'";
        $result = self::$conn->query($sql);
        return $result;
    }


    public function createTweet($tweetText){
        // TO DO After implementing tweet add function to create new Tweet by user
    }
    public function getAllTweets(){
        $ret = [];
        // TO DO After implementing tweet add function load all new Tweet by user
        return $ret;
    }
    public function createComment($commentText){

        // TO DO After implementing comment add function to create new Comment by user

    }

    public function getAllComment($commentText){
        $ret = [];
        // TO DO After implementing comment add function load all new comment by user
        return $ret;
    }
    public function getId(){
        return $this->id;
    }
    public function setUserName($newUserName)
    {
        if (is_string($newUserName) && strlen($newUserName) < 60) {
            $this->userName = $newUserName;
        }
    }
    public function getUserName(){
            return $this->userName;
    }

    public function getEmail (){
        return $this->email;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($newDescription)
    {
        if(is_string($newDescription) && strlen($newDescription) <255){
            $this->description = $newDescription;
        }
    }

}