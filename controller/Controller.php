<?php

abstract class Controller {

	protected $view;

	public function Display(){

		if($this->view !=""){
			require("view/template/template.phtml");
		}
	}

	abstract function DoWork();
}


?>