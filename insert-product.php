<?php
require_once 'inc/connection.php';
require_once 'inc/fonction.php';
$categories = getCategories($DBH);
?>

<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Karma Shop</title>

	<!--
            CSS
            ============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
<style>
.single-product {
	min-height: 420px;
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	box-sizing: border-box;
	background: #fff;
	border-radius: 8px;
	box-shadow: 0 2px 8px rgba(0,0,0,0.05);
	padding: 15px;
	margin-bottom: 20px;
}
.single-product img {
	max-height: 200px;
	object-fit: contain;
	margin: 0 auto 10px auto;
	display: block;
}
.product-details {
	flex: 1;
	display: flex;
	flex-direction: column;
	justify-content: space-between;
}
</style>
</head>
<body>
	<?php include 'inc/navbarre.php'; ?>

	<section class="section_gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-8">
					<div class="single-product" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 30px; margin-top: 40px;">
						<h2 class="text-center mb-4" style="font-weight:700;">Insérer un nouveau produit</h2>
						<form action="process-insert-product.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="product_name">Nom du produit</label>
								<input type="text" class="form-control" id="product_name" name="product_name" required>
							</div>
							<div class="form-group">
								<label for="category_id">Catégorie</label>
								<select class="form-control" id="category_id" name="category_id" required>
									<option value="">-- Choisir une catégorie --</option>
									<?php foreach ($categories as $cat): ?>
										<option value="<?= $cat['Category_ID'] ?>"><?= htmlspecialchars($cat['Category_Name']) ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="price">Prix</label>
								<input type="number" step="0.01" class="form-control" id="price" name="price" required>
							</div>
							<div class="form-group">
								<label for="description">Description</label>
								<textarea class="form-control" id="description" name="description" rows="3" required></textarea>
							</div>
							<div class="form-group">
								<label for="stock">Stock</label>
								<input type="number" class="form-control" id="stock" name="stock" required>
							</div>
							<div class="form-group">
								<label for="brand">Marque</label>
								<input type="text" class="form-control" id="brand" name="brand" required>
							</div>
							<div class="form-group">
								<label for="weight">Poids</label>
								<input type="number" step="0.01" class="form-control" id="weight" name="weight" required>
							</div>
							<div class="form-group">
								<label for="image">Image du produit</label>
								<input type="file" class="form-control" id="image" name="image" accept="image/*" required>
							</div>
							<div class="text-center mt-4">
								<button type="submit" class="primary-btn" style="padding: 10px 30px; font-size: 18px;">Insérer le produit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>About Us</h6>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
							magna aliqua.
						</p>
					</div>
				</div>
				<div class="col-lg-4  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Newsletter</h6>
						<p>Stay update with our latest</p>
						<div class="" id="mc_embed_signup">
							<form target="_blank" novalidate="true" action="#" method="get" class="form-inline">
								<div class="d-flex flex-row">
									<input class="form-control" name="EMAIL" placeholder="Enter Email" required type="email">
									<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
								</div>
								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget mail-chimp">
						<h6 class="mb-20">Instragram Feed</h6>
						<ul class="instafeed d-flex flex-wrap">
							<li><img src="img/i1.jpg" alt=""></li>
							<li><img src="img/i2.jpg" alt=""></li>
							<li><img src="img/i3.jpg" alt=""></li>
							<li><img src="img/i4.jpg" alt=""></li>
							<li><img src="img/i5.jpg" alt=""></li>
							<li><img src="img/i6.jpg" alt=""></li>
							<li><img src="img/i7.jpg" alt=""></li>
							<li><img src="img/i8.jpg" alt=""></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Follow Us</h6>
						<p>Let us be social</p>
						<div class="footer-social d-flex align-items-center">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0">
					Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
				</p>
			</div>
		</div>
	</footer>

	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>