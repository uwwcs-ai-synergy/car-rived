<?php

	$action = "";

	if(isset($_REQUEST['action']))
		$action = $_REQUEST['action'];

	switch($action){

		default: include("./home.php");
				break;
	}
?>
