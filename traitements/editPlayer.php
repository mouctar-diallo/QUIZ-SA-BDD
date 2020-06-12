<?php
include('../data/connectBdd.php'); 
if (isset($_POST['id']) && isset($_POST['value']) && isset($_POST['cible'])) 
{
    $id_player = $_POST['id'];
    $newValue = $_POST['value'];
    $cible = $_POST['cible'];
    if (editPlayers($id_player,$cible,$newValue)) {
        echo "modifié avec succès";
    }
}