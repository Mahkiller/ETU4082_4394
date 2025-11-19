<?php
require_once 'inc/connection.php';
require_once 'inc/fonction.php';

// Traitement de la suppression
if (isset($_GET['delete_id'])) {
    $deleteId = intval($_GET['delete_id']);
    if (deleteProduct($DBH, $deleteId)) {
        // Redirection vers la page de succès
        header('Location: success-del.php');
        exit;
    } else {
        // Redirection vers une page d'erreur si besoin
        header('Location: all-product.php?error=1');
        exit;
    }
}

$products = getProducts($DBH);
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Karma Shop - Tous les produits</title>
    <link rel="shortcut icon" href="img/fav.png">
    <meta name="author" content="CodePixar">
    <meta name="description" content="">
    <meta name="keywords" content="">
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
            transition: all 0.3s ease;
        }
        .single-product:hover {
            transform: scale(1.03);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .single-product img {
            max-height: 200px;
            object-fit: contain;
            margin: 0 auto 10px auto;
            display: block;
            transition: transform 0.3s ease;
        }
        .single-product:hover img {
            transform: scale(1.05);
        }
        .product-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 15px;
        }
        .primary-btn {
            flex: 1;
            text-align: center;
            padding: 10px 15px;
            margin: 0;
        }
        .edit-icon, .delete-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        .edit-icon:hover {
            background: #f8f9fa;
        }
        .delete-icon:hover {
            background: #ffe6e6;
        }
        .edit-icon img, .delete-icon img {
            width: 20px;
            height: 20px;
            margin: 0;
        }
        
        /* Modal de confirmation */
        .modal-confirm {
            color: #636363;
            width: 400px;
        }
        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
        }
        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }
        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }
        .modal-confirm .modal-body {
            color: #999;
        }
        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
        }
        .modal-confirm .btn {
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            margin: 0 5px;
        }
        .modal-confirm .btn-danger {
            background: #f15e5e;
        }
        .modal-confirm .btn-danger:hover {
            background: #ee3535;
        }
        .modal-confirm .btn-default {
            background: #c1c1c1;
        }
        .modal-confirm .btn-default:hover {
            background: #a8a8a8;
        }
        
        /* Message d'erreur */
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        
        /* Compteur de produits */
        .product-count {
            background: #e9ecef;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <?php include 'inc/navbarre.php'; ?>
    
    <!-- Section principale -->
    <section class="section_gap">
        <div class="container">
            <!-- Message d'erreur -->
            <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                <div class="error-message">
                    ❌ Erreur lors de la suppression du produit. Veuillez réessayer.
                </div>
            <?php endif; ?>
            
            <h2 class="text-center mb-4" style="font-weight:700;">Tous les produits</h2>
            
            <!-- Compteur de produits -->
            <div class="product-count">
                <?php 
                $productCount = count($products);
                echo $productCount . " produit" . ($productCount > 1 ? 's' : '') . " disponible" . ($productCount > 1 ? 's' : '');
                ?>
            </div>
            
            <div class="row">
                <?php if (empty($products)): ?>
                    <div class="col-12 text-center">
                        <div class="alert alert-warning">
                            <h4>Aucun produit trouvé</h4>
                            <p>La base de données ne contient aucun produit pour le moment.</p>
                            <a href="insert-product.php" class="btn btn-primary mt-2">
                                Ajouter le premier produit
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach($products as $product): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-product">
                            <img src="img/product/<?= htmlspecialchars($product['Image_name']) ?>" alt="<?= htmlspecialchars($product['Product_name']) ?>">
                            <div class="product-details">
                                <h6><?= htmlspecialchars($product['Product_name']) ?></h6>
                                <div class="price">
                                    <h6><?= number_format($product['prix_product'], 2) ?> €</h6>
                                </div>
                                <div class="product-actions">
                                    <a href="single-product.php?id=<?= $product['id_product'] ?>" class="primary-btn">Voir le produit</a>
                                    <div style="display: flex; gap: 5px;">
                                        <a href="edit-product.php?id=<?= $product['id_product'] ?>" class="edit-icon" title="Modifier le produit">
                                            <img src="img/features/f-icon5.png" alt="Modifier">
                                        </a>
                                        <a href="#" class="delete-icon" title="Supprimer le produit" 
                                           onclick="confirmDelete(<?= $product['id_product'] ?>, '<?= htmlspecialchars(addslashes($product['Product_name'])) ?>')">
                                            <img src="img/features/f-icon6.png" alt="Supprimer">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-confirm">
                <div class="modal-header flex-column">
                    <h4 class="modal-title w-100">Confirmer la suppression</h4>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer le produit "<strong id="productName"></strong>" ?</p>
                    <p>Cette action est irréversible.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <a href="#" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
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

    <!-- Scripts -->
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

    <script>
    function confirmDelete(productId, productName) {
        // Mettre à jour le modal avec les informations du produit
        document.getElementById('productName').textContent = productName;
        
        // Lien vers la suppression
        document.getElementById('confirmDeleteBtn').href = '?delete_id=' + productId;
        
        // Afficher le modal
        $('#deleteModal').modal('show');
    }
    </script>
</body>
</html>