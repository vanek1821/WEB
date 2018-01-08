<?php
	//Hodnocení
	Class Controller_review extends Controller{
		

		protected $revID;
		protected $contName;
		protected $cont;
		protected $author;
		protected $originality;
		protected $quality;
		protected $recommendation;
		protected $overall;

		public function __construct(){
				$this->view = "review";
				$this->revID = $_GET['id'];
			
		}

		public function Display(){	
			require("view/template/template_konf.phtml");
		}
		

		public function doWork(){
			$rev = Database::getRev($this->revID);
			$rev = array_shift($rev);
			$this->contName;
			$cont = Database::getIDCont($rev['cont_id']);
			$cont = array_shift($cont);
			$this->contName = $cont['name'];			
			$this->cont = $cont['cont'];

			//Tlačítko zpět
			if(isset($_POST['back'])){
				header("Location: http://localhost/index.php?page=cont");
			}

			//Uložení hodnocení a jeho přidání do databáze
			if(isset($_POST['reviewButton'])){
				$this->originality = $_POST['originality'];
				$this->quality = $_POST['quality'];
				$this->recommendation = $_POST['recommendation'];
				$this->overall = ( $this->originality + $this->quality + $this->recommendation )/3;
				Database::addReview($this->revID, $this->originality, $this->quality, $this->recommendation, $this->overall);

				header("Location: http://localhost/index.php?page=cont");
			}
		}
	}
?>