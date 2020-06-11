<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOUC-DEV | QUIZZ SA</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="<?=WEBROOT?>/public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=WEBROOT?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=WEBROOT?>/public/css/style.css">
    <link rel="stylesheet" href="<?=WEBROOT?>/public/dataTables/media/css/jquery.dataTables.css">
</head>

<body>
    <div class="row">
        <div class="header">
            <div class="logo">
                <img src="public/images/logoQuiz.png">
            </div>
            <h2 class="header-text" id="text">The pleasure of playing</h2>
                <input type="submit" class="btn-deconnexion" name="deconnexion" value="Deconnexion" id="btn-deconnexion">
        </div>
    </div>
    <!-- page  here -->
    <div class="row ml-1">
            <div class="bar-side">
                <div class="avatar">
                    <img src="public/images/<?php if(!empty($photo)){ echo $photo; } ?>">
                </div>
                <strong class="first-last-name"><?php if(!empty($prenom) && !empty($nom)){ echo $prenom . ' ' . $nom; } ?></strong>
                <div class="menu-side">
                    <div class="vertical-menu">
                        <a class="nav-lien" lien="index.php?page=admin&p=dashbord" href="#">Tableau de bord<img src="public/images/icones/ic-liste.png" class="icone-menu"></a>
                        <a class="nav-lien" lien="index.php?page=admin&p=listq" href="#">Liste Questions<img src="public/images/icones/ic-liste.png" class="icone-menu"></a>
                        <a class="nav-lien" lien="index.php?page=admin&p=add" href="#">Créer Admin<img src="public/images/icones/ajout.png" class="icone-menu"></a>
                        <a class="nav-lien" lien="index.php?page=admin&p=listj" href="#">Liste joueurs<img src="public/images/icones/ic-liste.png" class="icone-menu"></a>
                        <a class="nav-lien" lien="index.php?page=admin&p=addQ" href="#">Créer Questions<img src="public/images/icones/ic-ajout.png" class="icone-menu"></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content-admin" id="accueil">
            <?php
                require_once("./pages/dashboard.php");
            ?>
        </div>

<script src="<?=WEBROOT?>/public/dataTables/media/js/jquery.js"></script>
<script src="<?=WEBROOT?>/public/dataTables/media/js/jquery.dataTables.min.js"></script>
<script src="<?=WEBROOT?>/public/script/script.js"></script>
<script src="<?=WEBROOT?>/public/script/ajax.js"></script>
</body>
</html>