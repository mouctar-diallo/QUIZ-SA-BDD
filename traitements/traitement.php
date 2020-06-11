<?php
	include('../data/connectBdd.php'); 
//connexion user
if (isset($_POST['connexion'])) 
{
	$login =  $_POST['login'];
	$password = $_POST['password'];
	if (!empty($login) && !empty($password)) 
	{
		$user = connexion($login,$password);
		if ($user) {
			echo $user;
		}else{
			echo "incorrect";
		}
	}
	else
	{
		echo "empty";
	}
}

//inscription user
$nom=$prenom=$login=$password=$confirmer=$image=$message="";
if(isset($_POST['inscription']))
{
	$prenom = $_POST['prenom']; $nom = $_POST['nom']; $login= $_POST['Login']; 
	$password= $_POST['password']; $confirmer = $_POST['confirmer']; $image = $_POST['image'];
  if(!empty($prenom) && !empty($nom) && !empty($login) && !empty($password) && !empty($confirmer) &&  !empty($image))
  {
		if($password == $confirmer)
		{
      if (testLoginUnique($login)) 
      {
          $message = "le login existe dejà";
          echo 'yesLogin';
      }else{
          loadImage();
          if(isset($_SESSION['connect']))
          {
            $userConnect = saveUsers($nom,$prenom,$login,$password,$image,'admin',null);
          } else{
                $userConnect = saveUsers($nom,$prenom,$login,$password,$image,'joueur');
          }
          if ($userConnect) {
            echo $userConnect;
          }
      } 
		}else{
            $message = "les deux mot de passe doivent etre identiques";
            echo 'nopassword';
		}
	}else{
        $message = "remplissez tout les champs svp";
        echo 'empty';
	}
}

//telecharge l'image dans le dossier images du projet
function loadImage()
{
  $infoPhoto = false;

  if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
  {
    if ($_FILES['image']['size'] <= 2000000)
    {
      $infosfichier = pathinfo($_FILES['image']['name']);
      $extension_upload = $infosfichier['extension'];

      $extensions_autorisees = array('jpg','jpeg');
      if (in_array($extension_upload, $extensions_autorisees))
      {
        // On peut valider le fichier et le stocker dans le dossier images du projet
        move_uploaded_file($_FILES['image']['tmp_name'], 'public/images/' . basename($_FILES['image']['name']));
        $infoPhoto = true;
      }
    }
  }
  return $infoPhoto; 
}
//traitement des questions

$ErrorQuestion = $ErrorNbpoints = $ErrorType = $type=$nbpoints=$question= $noReponse="";
$reponses_vraie = array();
$reponses = array();
if (isset($_POST['enregistrer'])) {
	$question = $_POST['question'];
	$nbpoints= $_POST['nombrePoints'];
	$type= $_POST['type'];
	$nbreReponse = $_POST['nbreReponse'];
	if (!empty($nbpoints) && $nbpoints<=1) 
	{
		$ErrorNbpoints = "le nombre de points doit etre superieur a 1";
	}
	if (empty($question)) { 
		$ErrorQuestion = "la question est obligatoire";
	}else if(empty($nbpoints)){
		$ErrorNbpoints = "champ obligatoire";
	}else if(empty($type)){
		$ErrorType = "choisissez le type de reponse";
	}else if(!empty($_POST['champs'])){
	    $data = getData('questions');
	    $questions = array();
	    $questions['question'] = $question;
	    $questions['nombrePoints'] = $nbpoints;
	    $questions['type'] = $type;
	    for ($i=1; $i <= $nbreReponse ; $i++) {
	    	if (!empty($_POST['champs'.$i])) {
	    		$reponses[] = $_POST['champs'.$i];
	    	}else{
	    		$reponses[] = $_POST['champs'];
	    	}
	    }
	    $test = array(); $text = array();
	    $reponses_vraie = $_POST['champs'];
	    for ($i=0; $i < $nbreReponse; $i++) { 
	    	$questions['reponses']['valeur'.$i] = $reponses[$i];
	    	$test[] =  'champ'.($i+1);
	    	$text[] =  'champs';
	    	if (in_array($test[$i], $reponses_vraie) || (!empty($reponses_vraie) && $reponses_vraie == 'champs')){
	    		$questions['reponses']['result'.$i] = true;
	    	}else{
	    		$questions['reponses']['result'.$i] = false;
	    	}
	    }
	    $data[] = $questions;
	    saveData($data,'questions');
	    header('location:index.php?controlPage=accueil&p=addQ');
	}
}
?>