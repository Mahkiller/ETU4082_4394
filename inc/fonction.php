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

function getRandomProductsByCategory($DBH) {
    $query = $DBH->query("
        SELECT p.* FROM Produit_karma p
        JOIN (
            SELECT id_category, MIN(id_product) as min_id
            FROM Produit_karma
            GROUP BY id_category
        ) as t ON p.id_category = t.id_category
        GROUP BY p.id_category
        ORDER BY RAND()
        LIMIT 3
    ");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

?>