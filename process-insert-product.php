<?php
require_once 'inc/connection.php';
require_once 'inc/fonction.php';

// Fonction d'upload d'image
function uploadImage($file, $productName, $targetDir = 'img/product/') {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'] ?? '';
    $category_id = $_POST['category_id'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $weight = $_POST['weight'] ?? '';
    $image = $_FILES['image'] ?? null;

    // Upload de l'image
    $image_name = uploadImage($image, $product_name);
    if (!$image_name) {
        die('Erreur lors de l\'upload de l\'image.');
    }

    // Insertion dans Produit_karma
    $sql = "INSERT INTO Produit_karma (id_category, Product_name, prix_product, Image_name) VALUES (?, ?, ?, ?)";
    $stmt = $DBH->prepare($sql);
    if ($stmt->execute([$category_id, $product_name, $price, $image_name])) {
        $id_product = $DBH->lastInsertId();
        // Insertion dans Produit_Details_karma
        $sql2 = "INSERT INTO Produit_Details_karma (id_product, description, stock, brand, weight) VALUES (?, ?, ?, ?, ?)";
        $stmt2 = $DBH->prepare($sql2);
        if ($stmt2->execute([$id_product, $description, $stock, $brand, $weight])) {
            header('Location: home.php');
            exit;
        } else {
            die('Erreur lors de l\'insertion des détails du produit.');
        }
    } else {
        die('Erreur lors de l\'insertion du produit.');
    }
} else {
    header('Location: insert-product.php');
    exit;
}
?>
