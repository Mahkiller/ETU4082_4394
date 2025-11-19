<?php

ini_set("display_errors",1);

function getCategories($DBH) {
    $query = $DBH->query("SELECT * FROM Category_karma");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getProducts($DBH) {
    $query = $DBH->query("SELECT * FROM Produit_karma");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getFeaturedProducts($DBH) {
    // Pour la page d'accueil : 1 produit phare par catégorie
    $sql = "
        SELECT p.* 
        FROM Produit_karma p
        INNER JOIN (
            SELECT id_category, MIN(id_product) as min_id
            FROM Produit_karma 
            GROUP BY id_category
        ) p2 ON p.id_category = p2.id_category
        ORDER BY RAND() 
        LIMIT 3
    ";
    return $DBH->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function getProductsByCategory($DBH, $categoryId) {
    // Pour une catégorie spécifique : tous les produits ou 3 aléatoires
    $sql = "SELECT * FROM Produit_karma WHERE id_category = ? ORDER BY RAND() LIMIT 3";
    $query = $DBH->prepare($sql);
    $query->execute([$categoryId]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getProductById($DBH, $productId) {
    $sql = "
        SELECT p.*, d.description, d.stock, d.brand, d.weight, c.Category_Name
        FROM Produit_karma p
        LEFT JOIN Produit_Details_karma d ON p.id_product = d.id_product
        LEFT JOIN Category_karma c ON p.id_category = c.Category_ID
        WHERE p.id_product = ?
        LIMIT 1
    ";
    $stmt = $DBH->prepare($sql);
    $stmt->execute([$productId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>