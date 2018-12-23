<?php
require_once './cart.inc';

if (isset($_POST["txtCmd"])) {
	$cmd = $_POST["txtCmd"];
	$proId = $_POST["txtDProId"];
	$q = $_POST["txtUQ"];

	if ($cmd == "D") {
		delete_item($id);
	} else { // $cmd == "U"
		update_item($id, $q);
	}
	
	if (isset($_SERVER['HTTP_REFERER'])) {
	    $url = $_SERVER['HTTP_REFERER'];
	    header("location: $url");
	}
}