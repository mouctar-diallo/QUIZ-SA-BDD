<?php
include('../data/connectBdd.php');
    $query = $bdd->query
        (   'SELECT * 
            FROM users 
            WHERE profil = "joueur" 
            ORDER BY score DESC'
        );
    $result = $query->fetchAll();
    echo json_encode($result);
?> 