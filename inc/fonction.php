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

function deleteProduct($DBH, $productId) {
    try {
        // Commencer une transaction
        $DBH->beginTransaction();
        
        // Supprimer d'abord les détails du produit
        $sql1 = "DELETE FROM Produit_Details_karma WHERE id_product = ?";
        $stmt1 = $DBH->prepare($sql1);
        $stmt1->execute([$productId]);
        
        // Ensuite supprimer le produit
        $sql2 = "DELETE FROM Produit_karma WHERE id_product = ?";
        $stmt2 = $DBH->prepare($sql2);
        $stmt2->execute([$productId]);
        
        // Valider la transaction
        $DBH->commit();
        
        // Réinitialiser l'AUTO_INCREMENT APRÈS la transaction
        resetAutoIncrement($DBH);
        
        return true;
    } catch (Exception $e) {
        // Vérifier s'il y a une transaction active avant de rollback
        if ($DBH->inTransaction()) {
            $DBH->rollBack();
        }
        error_log("Erreur suppression produit: " . $e->getMessage());
        return false;
    }
}

function resetAutoIncrement($DBH) {
    try {
        // Récupérer le plus grand ID actuel
        $sql = "SELECT MAX(id_product) as max_id FROM Produit_karma";
        $stmt = $DBH->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxId = $result['max_id'] ? $result['max_id'] + 1 : 1;
        
        // Réinitialiser l'AUTO_INCREMENT
        $sql = "ALTER TABLE Produit_karma AUTO_INCREMENT = $maxId";
        $DBH->exec($sql);
        return true;
    } catch (Exception $e) {
        error_log("Erreur reset auto_increment: " . $e->getMessage());
        return false;
    }
}

function getProductDetailsView($DBH) {
    $sql = "
        SELECT 
            p.id_product,
            p.Product_name,
            p.prix_product,
            p.Image_name,
            c.Category_Name,
            d.description,
            d.stock,
            d.brand,
            d.weight
        FROM Produit_karma p
        LEFT JOIN Category_karma c ON p.id_category = c.Category_ID
        LEFT JOIN Produit_Details_karma d ON p.id_product = d.id_product
        ORDER BY p.id_product
    ";
    return $DBH->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
?>