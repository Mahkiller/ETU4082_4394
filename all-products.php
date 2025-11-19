<?php
require_once 'inc/connection.php';
require_once 'inc/fonction.php';
$products = getProducts($DBH);
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Liste de tous les produits</title>
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
            <h2 class="text-center mb-4" style="font-weight:700;">Tous les produits</h2>
            <div class="row">
                <?php foreach($products as $product): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="single-product">
                        <img src="img/product/<?= htmlspecialchars($product['Image_name']) ?>" alt="<?= htmlspecialchars($product['Product_name']) ?>">
                        <div class="product-details">
                            <h6><?= htmlspecialchars($product['Product_name']) ?></h6>
                            <div class="price">
                                <h6><?= htmlspecialchars($product['prix_product']) ?> €</h6>
                            </div>
                            <a href="single-product.php?id=<?= $product['id_product'] ?>" class="primary-btn">Voir le produit</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php include 'inc/navbarre.php'; ?>
    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
