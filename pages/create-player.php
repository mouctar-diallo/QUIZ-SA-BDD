<?php 
@include('traitements/traitement.php');
?>
<div class="photo">
    <img id="output">
</div>
<div class="col-md-4 col-md-offset-4" id="inscript">
    <form action="Javascript:void(0);" method="post" enctype="multipart/form-data" id="form">
        <label for="nom" class="control-label">nom</label>
        <input type="text" class="form-control" error="error1" name="nom" id="nom" value="<?php echo $nom;?>">
        <span id="error1"></span>
        <label for="prenom" class="control-label">Prenom</label>
        <input type="text" class="form-control" error="error2"  name="prenom" id="prenom" value="<?php echo $prenom;?>">
        <span id="error2"></span>
        <label for="Login" class="control-label">Login</label>
        <input type="text" class="form-control" error="error3" name="Login" id="login" value="<?php echo $login;?>">
        <span id="error3"></span>
        <label for="password" class="control-label">Password</label>
        <input type="text" class="form-control" error="error4" name="password" id="password" value="<?php echo $password;?>">
        <span id="error4"></span>
        <label for="confirmer" class="control-label">Confirm</label>
        <input type="text" class="form-control" error="error5" name="confirmer" id="confirmer" value="<?php echo $confirmer;?>">
        <span id="error5"></span>
        <h4>Avatar</h4>
        <input type="file" class="btn btn-info" value="choisir un fichier" error="errorx"  name="image" id="avatar" onchange="loadFile(event)">
        <span error="errorx" id="errorx"><?php if(!empty($message)){ echo $message; } ?></span><br>
        <div class="col-md-4 col-md-offset-4">
            <input type="submit" class="btn-primary btn btn-block" id="save-player" name="inscription" value="Créer compte">
        </div>
    </form>
</div>


