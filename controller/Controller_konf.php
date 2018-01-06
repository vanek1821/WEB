<?php

	class Controller_konf extends Controller{

		public function __construct() {

			if($_SESSION['privileges']==1){
				$this->view = 'konfAdmin';
			}
			if($_SESSION['privileges']==2){
				$this->view = 'konfRecenzent';
			}
			if($_SESSION['privileges']==3){
				$this->view = 'konfAutor';
			}
		}

		public function doWork(){

		}

		public function Display(){

		if($this->view !=""){
			require("view/template/template_konf.phtml");
		}
	}
}
?>