<?php
	is_connect();
	if(!empty($_SESSION['user']))
	{
		$nom = $_SESSION['user']['nom'];
		$prenom= $_SESSION['user']['prenom'];
		$photo = $_SESSION['user']['image'];
	}

	if (isset($_GET['p'])) {
		$page  = $_GET['p'];
		switch ($page) {
			case 'listq':
				require_once('pages/listQuestions.php');
			break;
			case 'add':
				require_once('pages/inscription.php');
			break;
			case 'listj':
				require_once('pages/listPlayer.php');
			break;
			case 'addQ':
				require_once('pages/create-question.php');
			break;
			case 'dashbord':
				require_once('pages/dashboard.php');
			break;
			case 'edit':
				require_once('pages/editQuestion.php');
			break;
		}
	}else{
		require_once('./pages/templateAdmin.php');
	}
?>


