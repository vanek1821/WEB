<?php

	class Controller_login extends Controller{

		//login - zadáno uživatelem
		protected $login;
		//password - heslo zadáno uživatelem
		protected $password;
		//dblogin - jmeno uzivatele v databazi
		protected $dblogin;
		//dbpassoword - heslo uzivatele v databazi
		protected $dbpassword;

		public function __construct(){
			$this->view = "login";
		}

		public function Display(){

		if($this->view !=""){
			require("view/template/template.phtml");
		}
	}

		public function doWork(){
			
			if (isset($_POST['loginButton'])) {

				$this->login = $_POST['login'];
				$this->password = $_POST['password'];

				$row = Database::getAllLogin($this->login);
				$row = array_shift($row);

				$this->dblogin = $row['login'];
				$this->dbpassword = $row['password'];

				if($_SESSION['signed']==true){
					header('Location: index.php?page=login&login_status=already_logged');
				}
				else {
					if(strcmp($this->login, $this->dblogin)==0){
						if(strcmp($this->password, $this->dbpassword)==0){
							$_SESSION['signed'] = true;
							$_SESSION['user'] = $this->login;
							$_SESSION['privileges'] = $row['privileges'];

							header('Location: index.php?page=konf');
						}
						else{
							header('Location: index.php?page=login&login_status=wrong_password');
						}
					}
					else {
						header('Location: index.php?page=login&login_status=unknown_user');
					}
				}
				if (isset($_POST['newAccountButton'])) {
					header('Location: index.php?page=signUp');
				}
			}
		}
	}	

?>