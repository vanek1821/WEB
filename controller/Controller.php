<?php

abstract class Controller {

	protected $view;

	abstract function Display();

	abstract function DoWork();
}


?>