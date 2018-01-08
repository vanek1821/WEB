<?php
	//Hlavní stránka
	class Controller_mainPage extends Controller{


		public function __construct(){
			$this->view = "mainPage";
		}

		public function doWork(){
			$_SESSION['user'];
		}
		public function Display(){

		if($this->view !=""){
			require("view/template/template.phtml");
		}
	}
	}


?>