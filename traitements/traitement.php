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
?>