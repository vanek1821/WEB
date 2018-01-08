<?php

	Class Controller_contribution extends Controller{

		protected $contID;
		protected $contName;
		protected $cont;
		protected $author;
		protected $file;

		public function __construct(){
				$this->view = "contribution";
				$this->contID = $_GET['id'];
			
		}

		public function Display(){	
			require("view/template/template_konf.phtml");
		}
		

		public function doWork(){
			//Zobrazení příspěvku
			$row = Database::getIDCont($this->contID);
			$row = array_shift($row);

			//Nastavení vnitřních atributů
			$this->contName = $row['name'];			
			$this->cont = $row['cont'];
			$this->author = $row['author'];
			$this->file = $row['file'];

			//Tlačítko zpět
			if(isset($_POST['back'])){
				header("Location: http://localhost/index.php?page=cont");
			}			
		}
	}
?>