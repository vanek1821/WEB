<?php
	//Nový příspěvek
	Class Controller_new_cont extends Controller{

		protected $contName;
		protected $cont;
		protected $author;
		protected $file;

		public function __construct(){
				$this->view = "new_cont";
			
		}

		public function Display(){	
			require("view/template/template_konf.phtml");
		}
		

		public function doWork(){
			//Tlačítko zpět
			if(isset($_POST['back'])){
				header("Location: http://localhost/index.php?page=cont");
			}
			//Přidání nového příspěvku
			if(isset($_POST['addNewContButton'])) {
				$this->contName = $_POST['contName'];	
				$this->cont = $_POST['cont'];
				$this->author = $_SESSION['user'];
				$target_dir = "uploads";
		        $tmp_name = $_FILES["file"]["tmp_name"];
		        $name = basename($_FILES["file"]["name"]);
		        $this->file = "$target_dir/$name";
		        move_uploaded_file($tmp_name, "$target_dir/$name");

		        //Přidání příspěvku do databáze
				Database::addContribution($this->contName,$this->author,$this->cont, $this->file);		
				header('Location: http://localhost/index.php?page=cont');
			}
			
		}
	}
?>