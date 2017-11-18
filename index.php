<?php
	echo "Hello world!";

	ini_set('display_errors','1');
	session_start();

	function load($class){
		if (mb_strpos($class, "controller")===false) {
			require("model/$class.php");
		} else {
			@require("controller/$class.php");
		}
	}
	spl_autoload_register("load");

	if (isset($_GET['page'])) {
		$_GET['page'] = "Controller_".$_GET['page'];
		$controller = new $_GET['page'];
	} else {
		$controller = new Controller_main;
	}

	$db = new Datatbase;
	$controller->DoWork();
	$controller->Display();


	
?>