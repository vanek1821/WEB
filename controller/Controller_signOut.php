<?php
	//Odhlášení uživatele
	Class Controller_signOut extends Controller{

		public function __construnct(){
			$this->view = 'mainPage';
			
		}
		public function Display(){

		if($this->view !=""){
			require("view/template/template.phtml");
		}
	}

		public function doWork(){
			$_SESSION['signed'] =false;
			$_SESSION['user']="";
			$_SESSION['privileges'] = 0;
			header('Location: index.php');
		}

	}

?>