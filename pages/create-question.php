<?php 
@include('traitements/traitementQuestion.php');
?>
<h2 class="text-center">CREATE A QUIZZ</h2>
<div class="col-md-8 col-md-offset-2">
    <form action="" method="post" id='form'>
    <input type="hidden" id="nbre" name="nbreReponse" value="0">
        <div class="form-group">
            <label for="question" class="control-label">Questions</label>
            <textarea class="form-control" name="question" id="question" rows="3"><?php if(isset($question)) echo $question;?></textarea>
            <span id="textearea"></span>
            <label for="nombrePoints" class="control-label">Nombre points</label>
            <input type="number" name="nombrePoints" id="error-nbpoints" class="form-control" value="<?= $nbpoints ?>">
            <span id="nbpoints"></span>
            <label for="type" class="control-label">Type</label>
            <select name="type" id="type" class="form-control" id="error-type">
                <option value="0">Choisissez le type</option>
                <option value="choixM">choix multiple</option>
                <option value="choixS">choix simple</option>
                <option value="choixT">choix texte</option>
            </select>
            <span id="vide"><?= $ErrorType ?></span>
            <button id="add" class="btn-add"><img src="public/images/icones/add.png"></button>

            <div class="dynamique" id="dynamique">
            
            </div>
            <input type="submit" name="enregistrer" id="enregistrer" value="Enregistrer" class="btn-save-question btn-primary">
        </div>
    </form>
</div>


