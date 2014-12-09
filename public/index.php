<?php

	$action = "";

	if(isset($_REQUEST['action']))
		$action = $_REQUEST['action'];

	switch($action){

		case "test": include("./apiTest.php");

				break;

		default: include("./home.php");
				break;
	}
?>
