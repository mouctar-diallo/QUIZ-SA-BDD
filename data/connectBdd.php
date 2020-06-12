<?php
  session_start();
  $bdd = new PDO('mysql:host=localhost;dbname=quizz_odc','root','');
//fonction de connexion
function connexion($login,$password){
    global $bdd; $user=$profil = "";
    $query  = $bdd->prepare('SELECT * FROM users WHERE login =? AND password=?');
    $query->execute(array($login,$password));
    $result = $query->fetch();
    if($result){
       
        $_SESSION['user'] = $result;
        $_SESSION['connect'] = 'connecter';
        if($result['profil'] == "admin"){
            $user = "admin";
        }else{
            $user = "player";
        }
    }
    return $user;
}
//insertion users
function saveUsers($nom,$prenom,$login,$password,$image,$profil,$score=0)
{
    global $bdd;
    $test = " ";
    $query = $bdd->prepare('INSERT INTO users(id,nom,prenom,login,password,image,profil,score) VALUES (null,?,?,?,?,?,?,?)');
    $result = $query->execute(array($nom,$prenom,$login,$password,$image,$profil,$score));//score prend null par defaut
    if ($result==1) 
    {
        if($profil=="admin")
        {
            $test = "admin";
        } else{
            $test = "player";
        }
    }
    return $test;
}
//unique login
function testLoginUnique($login)
{
    global $bdd;
    $test = false;
    $query = $bdd->query('SELECT * FROM users');
    while($result = $query->fetch())
    {
        if ($login == $result['login']) 
        {
           $test = true;
        }
    }
    return $test;
}
//supprimer un utilisateur (joueur)
function deletePlayers($id)
{
    global $bdd; $sup=false;
    $sql = $bdd->prepare('DELETE FROM users WHERE id = ?');
    $res = $sql->execute(array($id));
    if($res == 1){
        $sup = true;
    }
    return $sup;
}
//modifier joueur 
function editPlayers($id_player,$cible,$attribut)
{
    global $bdd; $test =false;
    $sql = $bdd->prepare("UPDATE users SET $cible = ? WHERE id = ?");
    $result=$sql->execute(array($attribut,$id_player));
    if ($result == 1) {
        $test =  true;
    }
    return $test;
}
//deconnexion
function deconnexion(){
    session_destroy();
}
//tester si user est connecté
function is_connect(){
    if (!isset($_SESSION['connect'])) {
       header('location:index.php');
    }
}
?>