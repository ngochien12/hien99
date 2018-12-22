<?php
if (!isset($_GET["id"])) {
	header('Location: index.php');
}
?>

<div class="row">
	<?php
		$id = $_GET["id"];
		$sql = "select * from products where CatID = $id";
		$rs = load($sql);
		if ($rs->num_rows > 0) :
			while ($row = $rs->fetch_assoc()) :
	?>
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail">
			<img src="imgs/sp/<?= $row["ProID"] ?>/main_thumbs.jpg" alt="...">
			<div class="caption">
				<h5><?= $row["ProName"] ?></h5>
				<h4><?= $row["Price"] ?></h4>
				<p style="height: 40px"><?= $row["TinyDes"] ?></p>
				<br>
				<p>
					<a href="#" class="btn btn-primary" role="button">Chi tiết</a>
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
		Không có sản phẩm thoả điều kiện.
	</div>
	<?php
		endif;
	?>
</div>