<?php

	Class Controller_new_cont extends Controller{

		protected $contName;
		protected $cont;
		protected $author;

		public function __construct(){
				$this->view = "new_cont";
			
		}

		public function Display(){	
			require("view/template/template_konf.phtml");
		}
		

		public function doWork(){
			if(isset($_POST['back'])){
				header("Location: http://localhost/index.php?page=cont");
			}
			if(isset($_POST['addNewContButton'])) {
				$this->contName = $_POST['contName'];	
				$this->cont = $_POST['cont'];
				$this->author = $_SESSION['user'];
				
				Database::addContribution($this->contName,$this->author,$this->cont);		
				header('Location: http://localhost/index.php?page=cont');
			}
			
		}
	}
?>