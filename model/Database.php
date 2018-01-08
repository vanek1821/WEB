<?php

class Database{

  //Připojení k databázi
	private static $conn;

	function __construct (){
    //Přihlašení do databáze
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

    //Vrací všechny příspěvky jednoho autora
    public static function getAuthorsConts($author){
    	if(self::$conn!=NULL){
    		$query = "select * from contributions where author = :author";
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

    //Vrací všechny příspěvky
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

    //Vrací všechny přijaté příspěvky
    public static function getAcceptedConts(){
      if(self::$conn!=NULL){
        $query = "select * from contributions where decision = '1'";
        $data = self::$conn->prepare($query);
        $data->execute();
        return $data->fetchall();
      }
      else{
        echo "conn is null";
      }
    }

    //Vrací příspěvek dle ID
    public static function getIDCont($id){
    	if(self::$conn!=NULL){
    		$query = "select * from contributions where id = :id";
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

    //Získání všech uživatelů podle jejich e-mailů
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
  	
  	//přidá uživatele do databáze
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

    //Přidá příspěvek do databáze
    public static function addContribution($contName, $author, $cont, $file){
    	if(self::$conn!=NULL){
    		$query = "insert into `contributions` (`id`, `name`, `author`, `cont`, `file`, `decision`) VALUES (NULL, :contName, :author, :cont, :file, '0');";
    		$data = self::$conn->prepare($query);
	    	$data->bindparam(':contName', $contName);
	    	$data->bindparam(':author', $author);
	    	$data->bindparam(':cont', $cont);
        $data->bindparam(':file', $file);

	    	$data->execute();
    	}
    }

    //Upraví příspěvek v databázi
    public static function editContribution($contID, $contName, $cont, $file){
    	if(self::$conn!=NULL){

    		$query = "update `contributions` set `name` = '$contName', `cont` = '$cont', `file` = '$file' WHERE `id` = $contID";
    		$data = self::$conn->prepare($query);
	    	$data->bindparam(':name', $contName);
	   		$data->bindparam(':id', $contID);
	    	$data->bindparam(':cont', $cont);
        $data->bindparam(':file', $file);

	    	$data->execute();
    	}
    }
    
    //Vymaže příspěvek dle jeho ID
    public static function removeContribution($contID){
    	if(self::$conn!=NULL){

    		$query = "delete from `contributions` where `contributions`.`id` = $contID";
    		$data = self::$conn->prepare($query);
	   		$data->bindparam(':id', $contID);

	    	$data->execute();
    	}	
    }

    //Vrací všechny recenzenty
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

    //Vrací všechna hodnocení, dle id příspěvku, ke kterému patří
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

    //Získá ID uživatele dle jeho jména
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

    //Získá jméno uživatele dle jeho ID
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

    //Přidá hodnocení do databáze
    public static function addRev($contID, $userID){
     if(self::$conn!=NULL){
              $query = "insert into `reviews` (`id`, `user_id`, `cont_id`, `originality`, `quality`, `recommendation`, `overall`) values (NULL, '$userID', '$contID', '0', '0', '0', '0')";
        $data = self::$conn->prepare($query);
        $data->bindparam(':user_ID', $userID);
        $data->bindparam(':cont_ID', $contID);

        $data->execute();
      }
    }

    //Vymaže hodnocení z databáze
    public static function deleteRev($id){
     if(self::$conn!=NULL){
              $query = "delete from `reviews` where `reviews`.`id` = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);

        $data->execute();
      }
    } 

    //Vrací všechna hodnocení jednoho uživatele dle jeho id
    public static function getRevs($id){
      if(self::$conn!=NULL){
        $query = "select * from reviews where user_id = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);
        $data->execute();
        return $data->fetchall();
      }
    }

    //Vrací hodnocení dle jeho id
    public static function getRev($id){
      if(self::$conn!=NULL){
        $query = "select * from reviews where id = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);
        $data->execute();
        return $data->fetchall();
      }
    }

    //Vrací příspěvek dle jeho id
    public static function getCont($id){
     if(self::$conn!=NULL){
        $query = "select * from contributions where id = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);
        $data->execute();
        return $data->fetchall();
      }
    } 

    //Přidá hodnocení od recenzenta
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

    //Vrací všechny uživatele
    public static function getUsers(){
      if(self::$conn!=NULL){
        $query = "select * from users";
        $data = self::$conn->prepare($query);
        $data->execute();
        return $data->fetchall();
      }
    }

    //Vrací uživatele dle jeho ID
    public static function getUserWithID($id){
     if (self::$conn!=NULL){
        $query = "select * from users where id = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);
        $data->execute();
        return $data->fetchall();
      }
    }

    //Upraví uživatele v databázi
    public static function editUser($id, $login, $name, $email, $privileges){
        if(self::$conn!=NULL){
        $query = "update users set login = :login, name = :name, email = :email, privileges = :privileges WHERE id = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);
        $data->bindparam(':login', $login);
        $data->bindparam(':name', $name);
        $email = htmlspecialchars($email);
        $data->bindparam(':email', $email);
        $data->bindparam(':privileges', $privileges);
        $data->execute();
        }
      }

    //Nastaví přijatému příspěvku příznak v databázi
    public static function acceptCont($id){
      $dec = '1';
      if(self::$conn!=NULL){
        $query = "update contributions set decision = :dec WHERE id = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);
        $data->bindparam(':dec', $dec);
        $data->execute();
      }
    }

    //Nastaví odmítnutému příspěvku příznak v databázi
    public static function declineCont($id){
      $dec = '-1';
      if(self::$conn!=NULL){
        $query = "update contributions set decision = :dec WHERE id = :id";
        $data = self::$conn->prepare($query);
        $data->bindparam(':id', $id);
        $data->bindparam(':dec', $dec);
        $data->execute();
      }
    }
}

?>