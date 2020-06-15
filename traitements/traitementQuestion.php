<?php
include('../data/connectBdd.php'); 

//SAVE QUESTION
$ErrorQuestion = $ErrorNbpoints = $ErrorType = $type=$nbpoints=$question= $noReponse="";
$reponses_vraie = array();
$reponses = array();

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
        
    //insert question
    if (saveQuetions($question,$nbpoints,$type)) 
    {
        $id_questions = lastInsertId();
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
            $responses = $reponses[$i];
            $test[] =  'champ'.($i+1);
            $text[] =  'champs';
            if (in_array($test[$i], $reponses_vraie) || (!empty($reponses_vraie) && $reponses_vraie == 'champs')){
                $statut = 1;
            }else if($type=='choixT'){
                $statut = 1;
            }else{
                $statut = 0;
            }
            if (insertAnswerQuestions($responses,$statut,$id_questions)) {
                echo "response saved";
            }   
        }
    }
}

//LISTE DES QUESTIONS
/*function showQuestionsAndReponses()
{
    global $bdd; $tab = array();
    //cherchons la nombre de questions
    $query = $bdd->query("SELECT  * FROM questions");
    $nombreQuestions = $query->fetchAll(); 
    for ($i=1; $i < count($nombreQuestions); $i++) { 

        $query = $bdd->query("SELECT  * FROM questions where id = $i");
        while($resultQuestions = $query->fetch())
        {
                $tab[$i]['question'] = $resultQuestions['question']; 
                $tab[$i]['type'] = $resultQuestions['type']; 
            $reps = $bdd->query("SELECT  * FROM reponses where id_questions = $i");
            while($result = $reps->fetch())
            {   
                $tab[$i]['reponses'][] = $result['reponses'];
                $tab[$i]['statut'][] = $result['statut'];
            }   
        }
    }

    return $tab;
}
$tabQuestionEtReponses = showQuestionsAndReponses():
echo json_encode($tabQuestionEtReponses);*/
