<?php

ini_set("display_errors",1);

    try {
        $localhost = "localhost";
        $dbname="ETU4082_4394";
        $user = "root";
        $pass = "";

        $DBH = new PDO("mysql:host=$localhost;dbname=$dbname", $user, $pass);

        //var_dump($DBH);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

?>