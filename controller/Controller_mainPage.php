<?php

	class Controller_mainPage extends Controller{


		public function __construct(){
			$this->view = "mainPage";
		}

		public function doWork(){
			
		}
		public function Display(){

		if($this->view !=""){
			require("view/template/template.phtml");
		}
	}
	}


?>