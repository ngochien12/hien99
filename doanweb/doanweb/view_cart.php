<?php
	require_once "./lib/db.php";
    

    if (isset($_POST["btnCheckOut"])) {
        $o_Total = $_POST["txtTotal"];
        $o_UserID = $_SESSION["current_user"]->f_ID;
        $o_OrderDate = strtotime("+7 hours", time());
        $str_OrderDate = date("Y-m-d H:i:s", $o_OrderDate);
        $sql = "insert into chitietdathang(OrderDate, UserID, Total) values('$str_OrderDate', $o_UserID, $o_Total)";
        $o_ID = write($sql);


        foreach ($_SESSION["cart"] as $proId => $q) {
            $sql = "select * from dathang where Id = $proId";
            $rs = load($sql);
            $row = $rs->fetch_assoc();
            $price = $row["Price"];
            $amount = $q * $price;
            $d_sql = "insert into dathang(Id, UserId, TongGia, loaiGiaoHang, TinhTrang, NgayDuKienGiaoHang, DiaChiGiaoHangId) values($o_id, $userid, $tonggia, $loaigiaohang, $tinhtrang, $ngaydukiengiaohang, $diachigiaohangid)";
            write($d_sql);
        }

		
        $_SESSION["cart"] = array();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Online shop</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
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
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="view_cart.php">
						<span class="glyphicon glyphicon-shopping-cart"></span>
						Giỏ hàng
					</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b></b> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Thông tin cá nhân</a></li>
							<li><a href="#">Tài khoản mật khẩu</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Thoát</a></li>
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
						<a href="product.php?id=<?= $row["Id"] ?>" class="list-group-item"><?= $row["TenSP"] ?></a>
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
						<h3 class="panel-title">giỏ hàng của bạn</h3>
					</div>
					<div class="panel-body">
						<form id="f" method="post" action="updateCart.inc.php">
							<input type="hidden" id="txtCmd" name="txtCmd">
							<input type="hidden" id="txtDProId" name="txtDProId">
							<input type="hidden" id="txtUQ" name="txtUQ">
						</form>
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Sản phẩm</th>
									<th>Giá</th>
									<th class="col-md-2">Số lượng</th>
									<th>Thành tiền
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$total = 0;
							foreach ($_SESSION["cart"] as $proId => $q) :
								$sql = "select * from dathang where Id = $proId";
								$rs = load($sql);
								$row = $rs->fetch_assoc();
								$amount = $q * $row["SoLuong"];
								$total += $amount;
							?>
								<tr>
									<td><?= $row["TenSP"] ?></td>
									<td><?= number_format($row["Price"]) ?></td>
									<!-- <td><?= $q ?></td> -->
									<td>
										<input class="quantity-textfield" type="text" name="" id="" value="<?= $q ?>">
									</td>
									<td><?= number_format($amount) ?></td>
									<td class="text-right">
										<a class="btn btn-xs btn-danger cart-remove" data-id="<?= $proId ?>" href="javascript:;" role="button">
											<span class="glyphicon glyphicon-remove"></span>
										</a>
										<a class="btn btn-xs btn-primary cart-update" data-id="<?= $proId ?>" href="javascript:;" role="button">
											<span class="glyphicon glyphicon-ok"></span>
										</a>
									</td>
								</tr>
							<?php
							endforeach;
							?>
							</tbody>
							<tfoot>
								<td>
									<a class="btn btn-success" href="index.php" role="button">
										<span class="glyphicon glyphicon-backward"></span>
										Tiếp tục mua hàng
									</a>
								</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><b><?= number_format($total) ?></b></td>
								<td class="text-right">
									<form method="POST" action="">
										<input type="hidden" name="txtTotal" value="<?= $total ?>">
										<button name="btnCheckOut" type="submit" class="btn btn-primary">
											<span class="glyphicon glyphicon-bell"></span>
											Thanh toán
										</button>
									</form>
								</td>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/jquery-3.1.1.min.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script src="assets/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
	<script type="text/javascript">
		$('.cart-remove').on('click', function() {
			var id = $(this).data('id');
			$('#txtDProId').val(id);
		    $('#txtCmd').val('D');
		    $('#f').submit();
		});

		$('.cart-update').on('click', function() {

			var q = $(this).closest('tr').find('.quantity-textfield').val();
			$('#txtUQ').val(q);

			var id = $(this).data('id');
			$('#txtDProId').val(id);
		    $('#txtCmd').val('U');

		    $('#f').submit();
		});

		$('.quantity-textfield').TouchSpin({
	        min: 1,
	        max: 69,
	        verticalbuttons: true,
            // step: 1,
            // decimals: 0,
            // boostat: 5,
            // maxboostedstep: 10,
            // postfix: '%'
	    });
	</script>
</body>
</html>