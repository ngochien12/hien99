<?php
	session_start();
	if (!isset($_SESSION["dang_nhap_chua"])) {
		$_SESSION["dang_nhap_chua"] = 0;
	}

	require_once './lib/db.php';
	if (isset($_POST["btnLogin"])) {
		$UserName = $_POST["txtUserName"];
		$PassWord = $_POST["txtPassword"];
		$nd_password = $PassWord;//md5($password);
        $nd_username = $UserName;
		$sql = "select * from nguoidung where UserName = '$nd_username' and Password = '$nd_password'";
		$rs = load($sql);
		if ($rs->num_rows > 0) {
			$_SESSION["UserName"] = $rs->fetch_object();
			$_SESSION["dang_nhap_chua"] = 1;

			// lÆ°u cookie, thÃ´ng tin cáº§n lÆ°u lÃ  id cá»§a ngÆ°á»i dÃ¹ng
			if(isset($_POST["cbRemember"])) {
				$user_id = $_SESSION["UserName"]->Id;
				setcookie("auth_user_id", $user_id, time() + 86400);
			}

			header("Location: index.php");
		} 
		    else if ($UserName == "" || $PassWord =="") {
			echo "username hoặc password bạn không được để trống!";          
            }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
</head>
<body>
	<br>
	<br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form method="post" action="">
					<div class="form-group">
						<label for="txtUserName">Tên đăng nhập</label>
						<input type="text" class="form-control" id="txtUserName" name="txtUserName" placeholder="John">
					</div>
					<div class="form-group">
						<label for="txtPassword">Mật khẩu</label>
						<input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="******">
					</div>
					<div class="checkbox">
						<label>
							<input name="cbRemember" type="checkbox"> Ghi nhận
						</label>
					</div>
					<button type="submit" class="btn btn-success btn-block" name="btnLogin">
					<span class="glyphicon glyphicon-user"></span>
					đăng nhập
					</button>
				</form>
			</div>
		</div>
	</div>
	<script src="assets/jquery-3.1.1.min.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>