<?php
    is_connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MOUC-DEV | QUIZZ-SA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="<?=WEBROOT?>/public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=WEBROOT?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=WEBROOT?>/public/css/style.css">
   
</head>
<body>
    <div class="player-page">
    <div class="row">
        <div class="header-player col-12">
           <div class="row">
                <div class="col-4">
                    <div class="logo w-25">
                        <img src="public/images/logoQuiz.png">
                    </div>
                </div>

                <div class="col-4 ">
                    <h2 class="text-center mt-5 header-text" id="text">The pleasure of playing</h2>
                </div>

                <div class="row col">
                    <div class="w-50">
                        <input type="submit" class="btn-quit w-75 mt-5 mr-4" name="quitter" value="quitter" id="btn-quit">
                    </div>
                    <div class="w-50">
                        <input type="submit" class="btn-logout  w-100  mt-5 mr-3" name="deconnexion" value="Deconnexion" id="btn-logout">
                    </div>
                </div>

           </div>
        </div>
   

        <div class="col-8 ml-2 mt-3 border border-dark">
                <h3 class="text-center">Questions 1/10</h3>
                <form action="" method="post">
                    <textarea class="form-control bg-light w-100 text-center" readonly name="question" id="question" cols="100" rows="6"></textarea>
                    <div class="row col-1 mt-3 bg-light p-3 float-right mr-1">20pts</div>
                    <h1 class="text-center">print responses herer</h1>
                </form>
        </div>
            <div class="row col-4 ml-1 mt-3">
                <div class="info-player">
                    <div class="phot-player">
                        <img src="public/images/img5.jpg" alt="">
                    </div>
                    <h3><p class="text-center">mamadou mouctar diallo</p></h3>
                </div>
                <table class="table-stripped table-bordered table-hover w-100 mt-4">
                    <thead>
                        <tr>
                            <th  class="text-center bg-primary">nom</th>
                            <th  class="text-center bg-primary">prenom</th>
                            <th  class="text-center bg-primary">score</th>
                        </tr>
                    </thead>
                    <tbody id="top-players">
                        
                    </tbody>
                </table>
        </div>
    </div>
    </div>
    <script src="<?=WEBROOT?>/public/script/ajax.js"></script>
</body>
</html>