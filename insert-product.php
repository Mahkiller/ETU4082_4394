<?php
require_once 'inc/connection.php';
require_once 'inc/fonction.php';
$categories = getCategories($DBH);
?>

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
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        /* Espacement pour le navbar fixe */
        body {
            padding-top: 100px;
        }
        
        .form-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 40px;
            margin-top: 40px;
        }
        
        /* Reset des styles de formulaire */
        .form-group {
            margin-bottom: 25px;
            clear: both;
        }
        
        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
            width: 100%;
        }
        
        .form-control {
            border-radius: 4px;
            border: 1px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
            width: 100%;
            display: block;
        }
        
        .form-control:focus {
            border-color: #4d4d4d;
            box-shadow: 0 0 0 2px rgba(77, 77, 77, 0.1);
        }
        
        .primary-btn {
            padding: 12px 40px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 4px;
            transition: all 0.3s ease;
            margin-top: 20px;
        }
        
        .primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        /* Assurer que les éléments sont sur des lignes séparées */
        .form-group > * {
            display: block;
            width: 100%;
        }
    </style>
</head>
<body>
	<?php include 'inc/navbarre.php'; ?>

	<section class="section_gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-8">
					<div class="form-container">
						<h2 class="text-center mb-4" style="font-weight:700;">Insérer un nouveau produit</h2>
						<form action="process-insert-product.php" method="POST" enctype="multipart/form-data">
							<!-- Nom du produit -->
							<div class="form-group">
								<label for="product_name">Nom du produit</label>
								<input type="text" class="form-control" id="product_name" name="product_name" required placeholder="Entrez le nom du produit">
							</div>
							
							<!-- Catégorie -->
							<div class="form-group">
								<label for="category_id">Catégorie</label>
								<select class="form-control" id="category_id" name="category_id" required>
									<option value="">-- Choisir une catégorie --</option>
									<?php foreach ($categories as $cat): ?>
										<option value="<?= $cat['Category_ID'] ?>"><?= htmlspecialchars($cat['Category_Name']) ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							
							<!-- Prix -->
							<div class="form-group">
								<label for="price">Prix (€)</label>
								<input type="number" step="0.01" class="form-control" id="price" name="price" required placeholder="0.00">
							</div>
							
							<!-- Description -->
							<div class="form-group">
								<label for="description">Description</label>
								<textarea class="form-control" id="description" name="description" rows="4" required placeholder="Décrivez le produit..."></textarea>
							</div>
							
							<!-- Stock et Marque -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="stock">Stock</label>
										<input type="number" class="form-control" id="stock" name="stock" required placeholder="Quantité">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="brand">Marque</label>
										<input type="text" class="form-control" id="brand" name="brand" required placeholder="Nom de la marque">
									</div>
								</div>
							</div>
							
							<!-- Poids -->
							<div class="form-group">
								<label for="weight">Poids (kg)</label>
								<input type="number" step="0.01" class="form-control" id="weight" name="weight" required placeholder="0.00">
							</div>
							
							<!-- Image -->
							<div class="form-group">
								<label for="image">Image du produit</label>
								<input type="file" class="form-control" id="image" name="image" accept="image/*" required>
								<small class="form-text text-muted">Formats acceptés: JPG, PNG, GIF, WEBP</small>
							</div>
							
							<!-- Bouton -->
							<div class="text-center">
								<button type="submit" class="primary-btn">Insérer le produit</button>
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