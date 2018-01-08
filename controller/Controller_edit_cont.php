<?php
	//Editace příspěvku
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
			//získání příspěvku a nastavení vnitřních atributů
			$row = Database::getIDCont($this->contID);
			$row = array_shift($row);
			$this->contName = $row['name'];			
			$this->cont = $row['cont'];
			$this->file = $row['file'];

			//Tlačítko zpět
			if(isset($_POST['back'])){
				header("Location: http://localhost/index.php?page=cont");
			}

			//Upravení příspěvku
			if(isset($_POST['editContButton'])) {
				$this->contName = $_POST['contName'];
				$this->cont = $_POST['cont'];

				$target_dir = "uploads";
		        $tmp_name = $_FILES["file"]["tmp_name"];
		        $name = basename($_FILES["file"]["name"]);

		        //Podmínka měnící nahraný soubor
		        if(($name != NULL)&&($this->file != "$target_dir/$name")){
		        	$this->file = "$target_dir/$name";
		        	move_uploaded_file($tmp_name, $this->file);	
		        }

				Database::editContribution($this->contID, $this->contName, $this->cont, $this->file);
				header('Location: http://localhost/index.php?page=cont');
			}
			
		}
	}
?>