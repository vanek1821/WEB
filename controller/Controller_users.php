<?php
	//Zobrazení uživatelů
	Class Controller_users extends Controller{


		public function __construct(){
				$this->view = "users";
		}

		public function Display(){	
			require("view/template/template_konf.phtml");
		}
		
		public function doWork(){
			//Získání uživatelů z databáze
			$_POST['users'] = Database::getUsers();

			//Úprava uživatele
			if(isset($_POST['editUserButton'])){
				header('Location: http://localhost/index.php?page=user_edit&id='.$_POST['editUserButton']);
			}
		}
	}
?>