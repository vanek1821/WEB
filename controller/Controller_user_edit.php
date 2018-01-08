<?php
	//Úprava uživatele
	Class Controller_user_edit extends Controller{

		protected $id;
		protected $name;
		protected $login;
		protected $email;
		protected $privileges;

		public function __construct(){
				$this->view = "user_edit";
				$this->id = $_GET['id'];
		}

		public function Display(){	
			require("view/template/template_konf.phtml");
		}
		
		public function doWork(){
			
			$user = Database::getUserWithID($this->id);
			$user = array_shift($user);

			$this->name = $user['name'];
			$this->login = $user['login'];
			$this->email = $user['email'];
			$this->privileges = $user['privileges'];

			if(isset($_POST['backButton'])){
				header('Location: http://localhost/index.php?page=users');
			}

			//Změna údajů uživatele
			if(isset($_POST['editUserButton'])){
				$this->name = $_POST['nameBox'];
				$this->login = $_POST['loginBox'];
				$this->email = $_POST['mailBox'];
				$this->privileges = $_POST['privilegesSel'];
				Database::editUser($this->id, $this->login, $this->name, $this->email, $this->privileges);
				header('Location: http://localhost/index.php?page=users');
				
			}

		}
	}
?>