
<h2 class="text-center">CREATE A QUIZZ</h2>
<div class="col-md-8 col-md-offset-2">
    <form action="" method="post">
        <div class="form-group">
            <label for="question" class="control-label">Questions</label>
            <textarea class="form-control" name="question" id="question" rows="3"></textarea>
            <label for="nombrePoints" class="control-label">Nombre points</label>
            <input type="number" name="nombrePoints" class="form-control">
            <label for="type" class="control-label">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="0">Choisissez le type</option>
                <option value="choixM">choix multiple</option>
                <option value="choixS">choix simple</option>
                <option value="choixT">choix texte</option>
            </select>
            <button id="add" class="btn-add"><img src="public/images/icones/add.png"></button>
            <input type="submit" name="enregister" value="Enregistrer" class="btn-save-question btn-primary">
        </div>
    </form>
</div>

