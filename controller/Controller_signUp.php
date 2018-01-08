<?php
	//Rehistrace uživatele
	class Controller_signUp extends Controller{

		protected $login;
		protected $password;
		protected $name;
		protected $email;
		protected $privileges;

		public function __construct(){
			$this->view = "signUp";
		}

		public function Display(){

		if($this->view !=""){
			require("view/template/template.phtml");
		}
	}

		public function doWork(){
			//Zaregistrování uživatele
			if(isset($_POST['signUpButton'])){

				$this->login = $_POST['login'];
				$this->password = $_POST['password'];
				$this->name = $_POST['name'];
				$this->email = $_POST['email'];
				$this->privileges = 3;
				$confirm = $_POST['confirm'];


				//Jednotlivé chybějící údaje nutné k registraci
				if (strcmp($this->login, "")==0) {
					header('Location: index.php?page=signUp&miss=login');
				}
				else if (strcmp($this->name, "")==0) {
					header('Location: index.php?page=signUp&miss=name');
				}
				else if (strcmp($this->password, "")==0) {
					header('Location: index.php?page=signUp&miss=password');
				}
				else if (strcmp($this->email, "")==0) {
					header('Location: index.php?page=signUp&miss=e-mail');
				}
				else if (strcmp($this->password, $confirm)!=0){
					header('Location: index.php?page=signUp&miss=notConfirmed');
				}
				else if (Database::getAllLogin($this->login)!=null) {
					header('Location: index.php?page=signUp&miss=loginAlreadyExists');
				}
				else if (Database::getAllEmail($this->email)!=null) {
					header('Location: index.php?page=signUp&miss=emailAlreadyExists');
				}
				else {	
						header('Location: index.php?page=mainPage');
						Database::addUser($this->login,$this->password,$this->name,$this->email,$this->privileges);
				}
			}
		}
	}

?>