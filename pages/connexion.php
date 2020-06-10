<div class="container-fluid"  id="authentification">
	<div class="content-image row no-gutters">
		<div class="formulaire">
			<h2>LOGIN</h2>
			<form method="POST" action="Javascript:void(0);" id="form">
				<div class="form-gr">
					<span id="error-1"></span>
					<i class="icone"><img src="public/images/login.jpg"></i>
					<input type="text" name="login" error="error-1" id="login" placeholder="Login" class="form-control">
					<span id="error-2"></span>
					<i class="icone"><img src="public/images/pwd.png"></i>
					<input type="password" name="password" id="password" error="error-2" placeholder="Password" class="form-control">
					<span id="error-3"><?php if(!empty($error)){ echo $error; } ?></span>
					<input type="submit" name="connexion" class="btn btn-primary"  value="Sign in" id="btn-connexion"><br>
				</div>
			</form>
				<p class="text-center"><a href="" id="create-player">create account</a></p>
		</div>
	</div>
</div>