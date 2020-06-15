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
//enregistrer questions
function saveQuetions($question,$nbrePoints,$type)
{
    global $bdd;
    $query = $bdd->prepare('INSERT INTO questions values(null,?,?,?)');
    $result = $query->execute(array($question,$nbrePoints,$type));
    if ($result == 1) {
        return true;
    }
   return false;
}
// recuperons l'id de la question pour l'associer aux reponses
function lastInsertId()
{
    global $bdd;
    $query = $bdd->query('SELECT MAX(id) FROM questions');
    $result = $query->fetch();
    if($result>0){
        return $result[0];
    }
}
//insertion reponse(s)
function insertAnswerQuestions($reponses,$statut,$id_questions)
{
    global $bdd;
    $query = $bdd->prepare('INSERT INTO reponses values(null,?,?,?)');
    $res = $query->execute(array($reponses,$statut,$id_questions));
    if ($res==1) {
        return true;
    }
    return false;
}
//liste des questions

function showQuestionsAndReponses()
{
    global $bdd;
    //cherchons la nombre de questions
    $query = $bdd->query("SELECT  * FROM questions");
    $nombreQuestions = $query->fetchAll();?>
    <div class="col">
        <?php
            for ($i=0; $i <= (count($nombreQuestions)-1); $i++) { 
                $id = $nombreQuestions[$i]['id'];
                $query = $bdd->query("SELECT  * FROM questions where id = $id");
                while($resultQuestions = $query->fetch())
                {?>
                    <div class="ligne row">
                        <div class="card-header bg-info  text-white border border-rounded opacity-50 w-100"><?php echo $resultQuestions['question']; ?></div>
                <?php  
                    $reps = $bdd->query("SELECT  * FROM reponses where id_questions = $id");
                    while($result = $reps->fetch())
                    {   
                        if($resultQuestions['type']=='choixS')
                        { 
                            if($result['statut']==1)
                            {
                                ?>
                                    <div class="card-body w-75">
                                        <input type="radio" name="result<?= $id?>" checked = "checked">
                                        <?php echo $result['reponses']; ?>
                                    </div>
                                <?php
                            }else{
                                ?>
                                    <div class="card-body w-75">
                                        <input type="radio" name="result<?= $id?>">
                                        <?php echo $result['reponses']; ?>
                                    </div>
                                <?php
                            }
                        }else  if($resultQuestions['type']=='choixM'){
                            if($result['statut']==1)
                            {
                                ?>
                                    <div class="card-body w-75">
                                        <input type="checkbox" name="result[]" checked = "checked">
                                        <?php echo $result['reponses']; ?>
                                    </div>
                                <?php
                            }else{
                                ?>
                                    <div class="card-body w-75">
                                        <input type="checkbox" name="result[]">
                                        <?php echo $result['reponses']; ?>
                                    </div>
                                <?php
                            }
                        }else{
                            ?>
                                <div class="card-body  w-75">
                                    <input type="text" class="form-control w-50" readonly name="resultat" value="<?= $result['reponses'];?>">
                                </div>
                            <?php
                        }
                    } ?>
                        <div class="float-right">
                            <button class="update btn btn-primary glyphicon glyphicon-pencil mr-5" id="<?= $id ?>"></button>
                            <button class="delete btn btn-danger glyphicon glyphicon-remove mr-5" id="<?= $id?>"></button>
                        </div></div>
                    <?php  
                }
            }?>
    </div>
<?php
}
//suppresion des questions
function deleteQuestions($id_question)
{
    global $bdd; $sup=false;
    $sql = $bdd->prepare('DELETE FROM questions WHERE id = ?');
    $res = $sql->execute(array($id_question));
    if($res == 1){
        $sup = true;
    }
    return $sup;
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