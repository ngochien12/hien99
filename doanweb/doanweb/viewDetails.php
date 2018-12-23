<?php
require_once "./lib/db.php";

$ProId = $_REQUEST["Id"];

$sql = "Update Sanpham Set LuotXem = LuotXem + 1 Where Id = $ProId";
$rs = write($sql);
header('Location: details.php');
?>
