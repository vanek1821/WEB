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
			$tableRec = "";
			$row = Database::getAllConts();
			$recenzents = Database::getRecenzents();
			foreach ($recenzents as $recenzent) {
        		$tableRec .= "<option>". $recenzent['login'] ."</option>";
        	}
			foreach ($row as $record) {

				$_POST['tableBody'] .= "
					<tr>
						<td rowspan='3' class='col-xs-2'>" . $record['name'] . "</td>
						<td rowspan='3' class='col-xs-2'>". $record['author'] . "</td>
						<td> 
									
	      							<select class='form-control' id='sel1'>
	        							".$tableRec."
	      							</select>
	      				</td>
	      							
						<td>a</td>
						<td>a</td>
						<td>a</td>
						<td>a</td>
						<td>a</td>
						<td rowspan='3' class='col-xs-3'>
							<form method='post'>
								<button name='editButton' type='submit' class='btn btn-default btn-success btn-sm' value='".$record['id']."'>
									<span class='glyphicon glyphicon glyphicon-thumbs-up'></span> Přijmout
								</button>
								<button name='removeButton' type='submit' class='btn btn-default btn-danger btn-sm' value='".$record['id']."'>
									<span class='glyphicon glyphicon glyphicon-thumbs-down'></span> Vymazat
								</button>
							</form>
						</td>
						</tr>
						<tr>
							<td> 
									
	      							<select class='form-control' id='sel1'>
	        							".$tableRec."
	      							</select>
	      							
						</td>
						<td>a</td>
						<td>a</td>
						<td>a</td>
						<td>a</td>
						<td>a</td>
						</tr>
						<tr>
							<td> 
									
	      							<select class='form-control' id='sel1'>
	        							".$tableRec."
	      							</select>
	      							
						
						</td>
						<td>a</td>
						<td>a</td>
						<td>a</td>
						<td>a</td>
						<td>a</td>
					</tr>";
			}
			
		}

		
		public function doAuthorWork(){
			$tableBody = "";
			$row = Database::getAuthorsConts($this->author);
			foreach ($row as $record) {
				$tableBody .= "	
				<tr> 
					<td class='col-xs-3'>" . $record['name'] . "</td> 
					<td> ". $record['cont'] ." </td>
					<td class='col-xs-2'>
						<form method='post'>
							<button name='editButton' type='submit' class='btn btn-default btn-sm' value='".$record['id']."'>
								<span class='glyphicon glyphicon-edit'></span> Upravit
							</button>
							<button name='removeButton' type='submit' class='btn btn-default btn-sm' value='".$record['id']."'>
								<span class='glyphicon glyphicon-remove'></span> Vymazat
							</button>
						</form>
					</td> 
				</tr>";

			}

			$_POST['table'] = '
				<div class="container">
				  <table class="table table-bordered table-striped">
				    <thead class="thead-default">
				      <tr>
				        <th>Název příspěvku</th>
				        <th>Příspěvek</th>
				        <th>Akce</th>
				      </tr>
				    </thead>
				    <tbody>' 
				      . $tableBody .
				    '</tbody>
				  </table>
				</div>';

			if(isset($_POST['editButton'])){
				header('Location: http://localhost/index.php?page=edit_cont&id='.$_POST['editButton']);
			}
			if(isset($_POST['removeButton'])){
				Database::removeContribution($_POST['removeButton']);
				header('Location: http://localhost/index.php?page=cont');
			}
		}
		public function doRecWork(){
		}	
	}
?>