<?php
	//Nástěnka
	class Controller_konf extends Controller{

		public function __construct() {

				$this->view = 'konf';
		}

		public function Display(){
			if($this->view !=""){
				require("view/template/template_konf.phtml");
			}
		}

		public function doWork(){
			$_POST['row'] = Database::getAcceptedConts();
			//Zobrazení příspěvku
			if(isset($_POST['displayButton'])){
        		header('Location: http://localhost/index.php?page=contribution&id='.$_POST['displayButton']);
        	}
		}

}
?>