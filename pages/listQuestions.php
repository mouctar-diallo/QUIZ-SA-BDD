<div class="row col-8">
    <form action="" method="post">
        <label for="nombre">nbre question/jeu</label>
            <div class="row">
                <input type="text" name="nombre" id="nombre" class="form-control col-6 m-2 h-25">
                <button class="btn btn-primary float-right">OK</button>
            </div>
    </form>
</div>
<h2 class="text-center">liste des questions</h2>
<div id="scrollZone" class="col">		
    <?php
        showQuestionsAndReponses();
    ?>
</div>	

