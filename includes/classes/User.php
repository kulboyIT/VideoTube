<?php 


class User {
    private $conn, $sqlData;

    public function __construct($conn, $username){
        $this->conn = $conn;

        $query = $this->conn->prepare("SELECT * FROM users WHERE username = :un");
        $query->bindParam(":un", $username);
        $query->execute();
   
        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
      
    }

    public function getUsername(){
        return $this->sqlData["username"];
    }  

    public function getName(){
        return $this->sqlData["firstName"] . " " . $this->sqlData["lastName"];
    }

    public function getUserFirstName(){
        return $this->sqlData["firstName"];
    }  

    public function getUserLastName(){
        return $this->sqlData["lastName"];
    }  

    public function getUserProfilePic(){
        return $this->sqlData["profilePic"];
    }  

    public function getUserEmail(){
        return $this->sqlData["email"];
    }  


    //subscribers methods

    public function isSubscribedTo($userTo){
        $query = $this->conn->prepare("SELECT * FROM subscribers WHERE userTo = :userTo AND userFrom = :userFrom");
        $query->bindParam(":userTo", $userTO);
        $query->bindParam(":userFrom", $username);

        $username = $this->getUsername();

        $query->execute();

        return $query->rowCount() > 0;
    }

    //subscribers count

    public function getSubscriberCount(){
        
        $query = $this->conn->prepare("SELECT * FROM subscribers WHERE userTo = :userTo");
        $query->bindParam(":userTo", $username);

        $username = $this->getUsername();

        $query->execute();

        return $query->rowCount();
    
    }
}
?>