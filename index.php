<?php
 define("WEBROOT","http://localhost/QUIZ-SA-BDD");
include('data/connectBdd.php');

	if (isset($_GET['statut']) && $_GET['statut']=='deconnecter') 
	{
		deconnexion();
		header('location:index.php');
	}
	if(isset($_GET['page'])) 
	{
		$page= $_GET['page'];
		switch ($page) 
		{
			case 'admin':
				require_once('./pages/accueil.php');
			break;
			case 'player':
				require_once('./pages/joueur.php');
			break;
			case 'create':
				require_once('./pages/create-player.php');
			break;
		}
	}else {
		require_once('./pages/template.php');
	}
?>

<script src="<?=WEBROOT?>/public/script/validation.js"></script>
<script src="<?=WEBROOT?>/public/script/questions.js"></script>
