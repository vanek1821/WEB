<?php

	Class Controller_edit_cont extends Controller{

		protected $contID;
		protected $contName;
		protected $cont;
		protected $author;

		public function __construct(){
				$this->view = "edit_cont";
				$this->contID = $_GET['id'];
			
		}

		public function Display(){	
			require("view/template/template_konf.phtml");
		}
		

		public function doWork(){
			$row = Database::getIDCont($this->contID);
			$row = array_shift($row);
			$this->contName = $row['name'];			
			$this->cont = $row['cont'];

			if(isset($_POST['back'])){
				header("Location: http://localhost/index.php?page=cont");
			}
			if(isset($_POST['editContButton'])) {
				$this->contName = $_POST['contName'];
				$this->cont = $_POST['cont'];

				Database::editContribution($this->contID, $this->contName, $this->cont);
				header('Location: http://localhost/index.php?page=cont');
			}
			
		}
	}
?>