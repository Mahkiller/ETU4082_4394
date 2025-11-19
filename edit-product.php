<?php
require_once 'inc/connection.php';
require_once 'inc/fonction.php';

$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($productId <= 0) {
    header('Location: all-products.php');
    exit;
}
$product = getProductById($DBH, $productId);
if (!$product) {
    header('Location: all-products.php');
    exit;
}
$categories = getCategories($DBH);

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'] ?? '';
    $category_id = $_POST['category_id'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $weight = $_POST['weight'] ?? '';
    $image = $_FILES['image'] ?? null;
    $image_name = $product['Image_name'];
    // Si une nouvelle image est uploadée
    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        function uploadImage($file, $productName, $targetDir = 'img/product/') {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($file['type'], $allowedTypes)) {
                return false;
            }
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $baseName = strtolower(str_replace(' ', '-', $productName));
            $filename = $baseName . '.' . $ext;
            $targetPath = $targetDir . $filename;
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                return $filename;
            }
            return false;
        }
        $new_image = uploadImage($image, $product_name);
        if ($new_image) {
            $image_name = $new_image;
        }
    }
    // Update Produit_karma
    $sql = "UPDATE Produit_karma SET id_category=?, Product_name=?, prix_product=?, Image_name=? WHERE id_product=?";
    $stmt = $DBH->prepare($sql);
    $stmt->execute([$category_id, $product_name, $price, $image_name, $productId]);
    // Update Produit_Details_karma
    $sql2 = "UPDATE Produit_Details_karma SET description=?, stock=?, brand=?, weight=? WHERE id_product=?";
    $stmt2 = $DBH->prepare($sql2);
    $stmt2->execute([$description, $stock, $brand, $weight, $productId]);
    header('Location: single-product.php?id=' . $productId);
    exit;
}
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
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
    </style>
</head>
<body>
    <?php include 'inc/navbarre.php'; ?>
    <section class="section_gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="single-product" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 30px; margin-top: 40px;">
                        <h2 class="text-center mb-4" style="font-weight:700;">Modifier le produit</h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="product_name">Nom du produit</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" value="<?= htmlspecialchars($product['Product_name']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Catégorie</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <option value="">-- Choisir une catégorie --</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['Category_ID'] ?>" <?= ($cat['Category_ID'] == $product['id_category']) ? 'selected' : '' ?>><?= htmlspecialchars($cat['Category_Name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Prix</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['prix_product']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($product['description']) ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="<?= htmlspecialchars($product['stock']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="brand">Marque</label>
                                <input type="text" class="form-control" id="brand" name="brand" value="<?= htmlspecialchars($product['brand']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="weight">Poids</label>
                                <input type="text" class="form-control" id="weight" name="weight" value="<?= htmlspecialchars($product['weight']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Image actuelle</label><br>
                                <img src="img/product/<?= htmlspecialchars($product['Image_name']) ?>" alt="<?= htmlspecialchars($product['Product_name']) ?>" style="max-width:150px;max-height:150px;">
                            </div>
                            <div class="form-group">
                                <label for="image">Nouvelle image (optionnel)</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="primary-btn" style="padding: 10px 30px; font-size: 18px;">Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
