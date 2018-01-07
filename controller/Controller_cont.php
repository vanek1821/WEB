<?php

	Class Controller_cont extends Controller{

		protected $author;
		protected $rec;

		public function __construct(){
			switch ($_SESSION['privileges']) {
				case '1':
					$this->view = "admin_cont";
					break;
				case '2':
					$this->view = "rec_cont";
					break;
				case '3';
					$this->view = "author_cont";
					break;
				default:
					echo "?";
					break;
			}	
		}

		public function Display(){
			if($this->view !=""){
				require("view/template/template_konf.phtml");
			}
		}

		public function doWork(){
			if (isset($_POST['newContButton'])) {
				header('Location: index.php?page=new_cont');
			}
			switch ($_SESSION['privileges']) {
				case '1':
					$this->doAdminWork();
					break;
				case '2':
					$this->rec = $_SESSION['user'];
					$this->doRecWork();
					break;
				case '3';
					$this->author = $_SESSION['user'];
					$this->doAuthorWork();
					break;
				default:
					echo "?";
					break;
			}	
		}	

		public function doAdminWork(){
			$_POST['tableBody'] = "";
			$_POST['tableRec'] = "";
			$_POST['row'] = Database::getAllConts();
			$recenzents = Database::getRecenzents();
			foreach ($recenzents as $recenzent) {
        		$_POST['tableRec'] .= "<option>". $recenzent['login'] ."</option>";
        	}
        	if(isset($_POST['assignButton1'])){
        		$sel1 = $_POST['sel1'];
        		$row = Database::getUserId($sel1);
        		$array = array_shift($row);
        		Database::addRev($_POST['assignButton1'], $array['id']);
        	}
        	if(isset($_POST['assignButton2'])){
        		$sel2 = $_POST['sel2'];
        		$row = Database::getUserId($sel2);
        		$array = array_shift($row);
        		Database::addRev($_POST['assignButton2'], $array['id']);
        	}
        	if(isset($_POST['assignButton3'])){
        		$sel3 = $_POST['sel3'];
        		$row = Database::getUserId($sel3);
        		$array = array_shift($row);
        		Database::addRev($_POST['assignButton3'], $array['id']);
        	}
        	if(isset($_POST['removeRevButton'])){
        		Database::deleteRev($_POST['removeRevButton']);
        	}
		}

		
		public function doAuthorWork(){
			$_POST['tableBody'] = "";
			$_POST['row'] = Database::getAuthorsConts($this->author);

			if(isset($_POST['editButton'])){
				header('Location: http://localhost/index.php?page=edit_cont&id='.$_POST['editButton']);
			}
			if(isset($_POST['removeButton'])){
				Database::removeContribution($_POST['removeButton']);
				header('Location: http://localhost/index.php?page=cont');
			}
		}
		public function doRecWork(){
			$_POST['revOptions'] = "";
			$tmp = Database::getUserID($_SESSION['user']);
			$tmp = array_shift($tmp);
			$id = $tmp['id'];
			$_POST['revs'] = Database::getRevs($id); 
			for ($i=0; $i < 6; $i++) { 
				$_POST['revOptions'] .= $i;
			}
			if(isset($_POST['reviewButton'])){
				echo 'kliknuto';
				header('Location: http://localhost/index.php?page=review&id='.$_POST['reviewButton']);
			}
		}	
	}
?>