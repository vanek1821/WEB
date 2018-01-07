<?php

	Class Controller_user_edit extends Controller{


		public function __construct(){
				$this->view = "user_edit";
		}

		public function Display(){	
			require("view/template/template_konf.phtml");
		}
		
		public function doWork(){
			$_POST['users'] = Database::getUsers();
			if(isset($_POST['editUserButton'])){
				header('Location: http://localhost/index.php?page=user_editing&id='.$_POST['editUserButton']);
			}

		}
	}
?>