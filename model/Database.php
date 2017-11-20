<?php

class Database{

	private static $conn;

	public function __contstruct(){
		$servername = "localhost";
		$dbname = "web";
		$username = "root";
		$password = "";

		try {
	       self::$conn = new pdo('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8', $username, $password);    
	       self::$conn-> setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    } 
      	catch(pdoexception $e) {
       		echo "error: " . $e->getmessage();
      	}  
	}

	 /**
     * Vrací všechny údaje o uživateli podle uživatelského jména
     * $name uživatelské jméno
     */
    public static function returnAllLogin($name) {
      $query = "select * from users where login = :login"; 
    	$data = self::$conn->prepare($query);
      
      $name = htmlspecialchars($name);
      
      $data->bindparam(':login', $name);
    	$data->execute();
      return $data->fetchall();
    }
}

?>