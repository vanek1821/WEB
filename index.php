<?php
	ini_set('display_errors','1');
	session_start();

	function load($class){
		if (mb_strpos($class, "Controller")===false) {
			
			require("model/Database.php");
		} else {
			
			require("controller/$class.php");
		}
	}
	spl_autoload_register("load");

	if (isset($_GET['page'])) {
		$_GET['page'] = "Controller_".$_GET['page'];
		$controller = new $_GET['page'];
	} else {

		$controller = new Controller_mainPage;
	}

	$db = new Database;
	$controller->DoWork();
	$controller->Display();


	
?>