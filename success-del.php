<?php
// success-del.php
require_once 'inc/connection.php';
require_once 'inc/fonction.php';

// Récupérer le prochain ID disponible
$sql = "SELECT MAX(id_product) as max_id FROM Produit_karma";
$stmt = $DBH->query($sql);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$nextId = $result['max_id'] ? $result['max_id'] + 1 : 1;
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Karma Shop - Suppression réussie</title>
    <link rel="shortcut icon" href="img/fav.png">
    <meta name="author" content="CodePixar">
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {
            padding-top: 100px;
            background: #f8f9fa;
        }
        .success-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 40px;
            margin-top: 40px;
            text-align: center;
        }
        .success-icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .btn-success {
            background: #28a745;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 4px;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            color: white;
            text-decoration: none;
        }
        .info-box {
            background: #e9f7ef;
            border: 1px solid #28a745;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
            text-align: left;
        }
    </style>
</head>
<body>
    <?php include 'inc/navbarre.php'; ?>
    
    <section class="section_gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="success-container">
                        <div class="success-icon">✅</div>
                        <h2 style="font-weight:700; color:#28a745; margin-bottom:20px;">
                            Suppression réussie !
                        </h2>
                        <p style="font-size:18px; color:#666; margin-bottom:30px;">
                            Le produit a été supprimé avec succès de la base de données.
                        </p>
                        
                        <!-- Information sur les IDs -->
                        <div class="info-box">
                            <h5 style="color:#28a745; margin-bottom:10px;">📊 Information système :</h5>
                            <p style="margin:0;">
                                <strong>Prochain ID disponible :</strong> ID <?= $nextId ?><br>
                                <small>L'ID a été libéré et sera réutilisé pour le prochain produit.</small>
                            </p>
                        </div>
                        
                        <a href="all-products.php" class="btn btn-success">
                            Voir les produits
                        </a>
                        <br>
                        <a href="insert-product.php" class="btn btn-outline-success mt-2">
                            Ajouter un nouveau produit
                        </a>
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
    <script src="js/vendor/bootstrap.min.js"></script>
</body>
</html>