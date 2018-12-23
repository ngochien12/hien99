<?php
session_start();
if (isset($_SESSION["dang_nhap_chua"])) {
	unset($_SESSION["dang_nhap_chua"]);
	unset($_SESSION["UserName"]);

	setcookie("auth_user_id", "", time() - 3600);
}

header('Location: login.php');