<?php
	require_once "./lib/db.php";
	if (!isset($_GET["id"])) {
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Online shop</title>
		<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">
						<span class="glyphicon glyphicon-home"></span>
					</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
						<li><a href="#">Link</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">Separated link</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">One more separated link</a></li>
							</ul>
						</li>
					</ul>
					<form class="navbar-form navbar-left">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">Tìm kiếm</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Giỏ hàng</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b></b> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="profile.php">Thông tin cá nhân</a></li>
								<li><a href="#">Tài khoản mật khẩu</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="logout.php">Thoát</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Danh mục</h3>
						</div>
						<div class="list-group">
							<?php
								$sql = "select * from danhmuc";
								$rs = load($sql);
								while ($row = $rs->fetch_assoc()) :
							?>
							<a href="product.php?id=<?= $row["Id"] ?>" class="list-group-item"><?= $row["Ten"] ?></a>
							<?php
								endwhile;
							?>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Nhà sản xuất</h3>
						</div>
						<div class="panel-body">
							Panel content
						</div>
					</div>
				</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">sản phẩm</h3>
						</div>
						<div class="panel-body">
							<div class="row">
							<?php
								$id = $_GET["id"];
								$sql = "select * from sanpham where Id = $id";
								$rs = load($sql);
								if ($rs->num_rows > 0) : 
									while ($row = $rs->fetch_assoc()) :
							?>
										<div class="col-sm-6 col-md-4">
									    <div class="thumbnail">
									        <img src="imgs/sp/<?= $row["HinhAnh"] ?>/main_thumbs.jpg" alt="...">
										    <div class="caption">
										    <h5><?= $row["TenSP"] ?></h5>
										    <h4><?= $row["Gia"] ?></h4>
										    <p style="height:40px,"><?= $row["HinhAnh"] ?></p>
										        <br>
										        <p>
                                                <a href="viewDetails.php?ProId=<?= $row["id"] ?>" class="btn btn-primary" role="button">Chi tiết</a>
										        <a href="#" class="btn btn-danger" role="button">
										        <span class="glyphicon glyphicon-shopping-cart"></span>
										        Đặt mua
										         </a>
										     </p>
										    </div>
										    </div>
										</div>
							<?php 
									endwhile;
								else :
							?>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									
									</div>
							<?php
								endif;
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="assets/jquery-3.1.1.min.js"></script>
		<script src="assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	</body>
</html>