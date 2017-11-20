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

		public function doWork(){
			
			if (isset($_POST['loginbutton'])) {

				$this->login = $_POST['login'];
				$this->password = $_POST['password'];

				$row = Login::getUserLogin($this->login);
				$row = array_shift($row);

				$this->dblogin = $row['login'];
				$this->dbpassword = $row['password'];

				if (strcmp($this->login, $this->dblogin)) {
					echo "login sedí";
				}
				else echo "login nesedí";
			}

			
		}
	}


?>