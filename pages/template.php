
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MOUC-DEV | QUIZZ SA</title>
	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
	<link rel="stylesheet" href="public/dataTables/media/css/jquery.dataTables.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="header">
				<div class="logo">
					<img src="public/images/logoQuiz.png">
				</div>
				<h2 class="header-text" id="text">The pleasure of playing</h2>
					<input type="submit" class="btn-deconnexion" name="deconnexion" value="Deconnexion" id="btn-deconnexion">
			</div>
		</div>
		<div class="row" id="pages">
			<!--charge all pages here...!!!-->
            <?php
                include('pages/connexion.php'); 
			?>
		</div>
	</div>
<script src="public/dataTables/media/js/jquery.js"></script>
<script src="public/dataTables/media/js/jquery.dataTables.min.js"></script>
<script src="public/script/script.js"></script>
<script src="public/script/validation.js"></script>
<script src="public/script/ajax.js"></script>
<script>
	$(document).ready( function () {
		$('#example').DataTable();
	});
</script>
</body>
</html>
