<?php
	Class Controller_user_editing extends Controller{


		public function __construct(){
				$this->view = "user_editing";
		}

		public function Display(){	
			require("view/template/template_konf.phtml");
		}
		
		public function doWork(){
		}
	}
?>