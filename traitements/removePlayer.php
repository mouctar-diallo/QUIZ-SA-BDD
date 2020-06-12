<?php
include('../data/connectBdd.php'); 
if (isset($_POST['id'])) 
{
    $id_player = $_POST['id'];
    if (deletePlayers($id_player)) 
    {
        echo "supprimer";
    }
}