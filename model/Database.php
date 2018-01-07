<?php

class Database{

	private static $conn;

	function __construct (){

		$servername = "localhost";
		$dbname = "semestralka_web";
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
    public static function getAllLogin($name) {
    	
	    if(self::$conn!=NULL){
	     	$query = "select * from users where login = :login"; 
	    	$data = self::$conn->prepare($query);
	      
	      	$name = htmlspecialchars($name);
	      
	      	$data->bindparam(':login', $name);
	    	$data->execute();
	      	
	      	return $data->fetchall();
  		}
  		else{
  			echo "conn is null";
  		}
    }
    public static function getAuthorsConts($author){
    	if(self::$conn!=NULL){
    		$query = "select id, name, cont from contributions where author = :author";
    		$data = self::$conn->prepare($query);

    		$author = htmlspecialchars($author);

    		$data->bindparam(':author', $author);
    		$data->execute();


    		return $data->fetchall();
    	}
    	else{
    		echo "conn is null";
    	}
    }
    public static function getAllConts(){
    	if(self::$conn!=NULL){
    		$query = "select * from contributions";
    		$data = self::$conn->prepare($query);

    		$data->execute();

    		
    		return $data->fetchall();
    	}
    	else{
    		echo "conn is null";
    	}
    }
    public static function getIDCont($id){
    	if(self::$conn!=NULL){
    		$query = "select name, cont from contributions where id = :id";
    		$data = self::$conn->prepare($query);

    		$id = htmlspecialchars($id);

    		$data->bindparam(':id', $id);
    		$data->execute();


    		return $data->fetchall();
    	}
    	else{
    		echo "conn is null";
    	}
    }

    public static function getAllEmail($email) {
    	
	    if(self::$conn!=NULL){
	     	$query = "select * from users where email = :email"; 
	    	$data = self::$conn->prepare($query);
	      
	      	$email = htmlspecialchars($email);
	      
	      	$data->bindparam(':email', $email);
	    	$data->execute();
	      	
	      	return $data->fetchall();
  		}
  		else{
  			echo "conn is null";
  		}
  	}
  	/**
  	* přidá uživatele do databáze
  	*/
    public static function addUser($login, $password, $name, $email, $privileges){
      	if(self::$conn!=NULL){
	    	$query = "insert into `users` (`id`, `login`, `password`, `privileges`, `name`, `email`) values (NULL, '$login', '$password', '$privileges', '$name', '$email')";
	    	$data = self::$conn->prepare($query);
	    	$data->bindparam(':login', $login);
	    	$data->bindparam(':password', $password);
	    	$data->bindparam(':name', $name);
	    	$data->bindparam(':email', $email);
	    	$data->bindparam(':privileges', $privileges);

	    	$data->execute();
      	}
    }
    public static function addContribution($contName, $author, $cont){
    	if(self::$conn!=NULL){
    		$query = "insert into `contributions` (`id`, `name`, `author`, `cont`) VALUES (NULL, '$contName', '$author', '$cont')";
    		$data = self::$conn->prepare($query);
	    	$data->bindparam(':name', $contName);
	    	$data->bindparam(':author', $author);
	    	$data->bindparam(':cont', $cont);

	    	$data->execute();
    	}
    }
    public static function editContribution($contID, $contName, $cont){
    	if(self::$conn!=NULL){

    		$query = "update `contributions` set `name` = '$contName', `cont` = '$cont' WHERE `id` = $contID";
    		$data = self::$conn->prepare($query);
	    	$data->bindparam(':name', $contName);
	   		$data->bindparam(':id', $contID);
	    	$data->bindparam(':cont', $cont);

	    	$data->execute();
    	}
    }
    public static function removeContribution($contID){
    	if(self::$conn!=NULL){

    		$query = "delete from `contributions` where `contributions`.`id` = $contID";
    		$data = self::$conn->prepare($query);
	   		$data->bindparam(':id', $contID);

	    	$data->execute();
    	}	
    }
    public static function getRecenzents(){

	    if(self::$conn!=NULL){
	     	$query = "select login from users where privileges = 2"; 
	    	$data = self::$conn->prepare($query);
	  
	    	$data->execute();
	      	
	      	return $data->fetchall();
  		}
  		else{
  			echo "conn is null";
  		}
  	}

    public static function getContRevs($contID){
      if (self::$conn!=NULL){
        $query = "select * from `reviews` WHERE `cont_id` = $contID";
        $data = self::$conn->prepare($query);
        $data->bindparam(':cont_id', $contID);

        $data->execute();

        return $data->fetchall();
      }
      else{
        echo "conn is null";
      }
    }

    public static function getUserID($login){
     if (self::$conn!=NULL){
        $query = "select id from users where login = :login";
        $data = self::$conn->prepare($query);
        $data->bindparam(':login', $login);

        $data->execute();

        return $data->fetchall();
      }
      else{
        echo "conn is null";
      } 
    }
    public static function getUserName($id){
     if (self::$conn!=NULL){
        $query = "select login from users where id = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);

        $data->execute();

        return $data->fetchall();
      }
      else{
        echo "conn is null";
      } 
    } 
    public static function addRev($contID, $userID){
     if(self::$conn!=NULL){
              $query = "insert into `reviews` (`id`, `user_id`, `cont_id`, `originality`, `quality`, `recommendation`, `overall`) values (NULL, '$userID', '$contID', '0', '0', '0', '0')";
        $data = self::$conn->prepare($query);
        $data->bindparam(':user_ID', $userID);
        $data->bindparam(':cont_ID', $contID);

        $data->execute();
      }
    }
    public static function deleteRev($id){
     if(self::$conn!=NULL){
              $query = "delete from `reviews` where `reviews`.`id` = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);

        $data->execute();
      }
    } 
    public static function getRevs($id){
      if(self::$conn!=NULL){
        $query = "select * from reviews where user_id = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);
        $data->execute();
        return $data->fetchall();
      }
    }
    public static function getRev($id){
      if(self::$conn!=NULL){
        $query = "select * from reviews where id = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);
        $data->execute();
        return $data->fetchall();
      }
    }
    public static function getCont($id){
     if(self::$conn!=NULL){
        $query = "select * from contributions where id = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);
        $data->execute();
        return $data->fetchall();
      }
    } 
    public static function addReview($id, $originality, $quality, $recommendation, $overall){
      if(self::$conn!=NULL){
        $query = "update reviews set originality = :originality, quality = :quality, recommendation = :recommendation, overall = :overall WHERE id = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);
        $data->bindparam(':originality', $originality);
        $data->bindparam(':quality', $quality);
        $data->bindparam(':recommendation', $recommendation);
        $data->bindparam(':overall', $overall);
        $data->execute();
      }
    }
    public static function getUsers(){
      if(self::$conn!=NULL){
        $query = "select * from users";
        $data = self::$conn->prepare($query);
        $data->execute();
        return $data->fetchall();
      }
    }
}

?>