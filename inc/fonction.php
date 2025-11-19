<?php

ini_set("display_errors",1);

function getCategories($DBH) {
    $query = $DBH->query("SELECT * FROM Category_karma");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

?>