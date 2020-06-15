<?php
include('../data/connectBdd.php'); 
if (isset($_POST['id_question'])) 
{
    $id_question = $_POST['id_question'];
    if (deleteQuestions($id_question)) 
    {
        echo "supprimer";
    }else {
        echo "non";
    }
}