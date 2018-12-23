<?php
require_once './cart.inc';

 session_start();
 if (!isset($_SESSION["cart"])) {
 	$_SESSION["cart"] = array();
 }

if (isset($_POST["btnAddItemToCart"])) {
	$Id = $_POST["txtProID"];
	$q = $_POST["txtQuantity"];

     //if (array_key_exists(proId, $_SESSION["cart"])) {
     //    $_SESSION["cart"][proId] += $q;
     //} else {
     //    $_SESSION["cart"][proId] = $q;
     //}

	// print_r($_SESSION["cart"]);
	if (isset($_SERVER['HTTP_REFERER'])) {
	    $url = $_SERVER['HTTP_REFERER'];
	    header("location: $url");
	}
}