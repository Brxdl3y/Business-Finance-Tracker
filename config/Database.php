<?php
session_start();
class Database{
	
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "brad"; 
    
    public function getConnection(){		
		// $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		// uncomment the above line and comment the below line if you are using xampp
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database, 3307);

		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>