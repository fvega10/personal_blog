<?php include VIEWS . '/partials/header.php';?>
<br>
<div class="container">
	<div class="row login_form grey lighten-3 z-depth-4">
		<div class="row center-align">
			<img src="/assets/media/logotype.png" width="150px" height="150px" alt="Logotipo">
			<div class="col s12">
				<h3 class="grey-text text-darken-2">
					Inicio de sesión
				</h3>	
			</div>
		</div>
		<form class="col s12" action="/authenticate/index.php?action=auth" method="POST">
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">email</i>
					<input id="email" type="email" class="validate" name="email">
					<label for="email">
						Correo electrónico:
					</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix">lock</i>
					<input id="password" type="password" class="validate" name="password">
					<label for="password">
						Contraseña:
					</label>
				</div>
				<div class="col s12 m12 right-align">
					<button type="submit" class="waves-effect waves-light btn">
						<i class="material-icons right">check</i>
						Ingresar
					</button>
					<a class="red darken-4 btn" href="/index.php">
						<i class="material-icons right">arrow_back</i>
						Regresar
					</a>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="container">	
	<?php 
		include VIEWS . "/partials/message.php"; 
	?>
</div>

<?php include VIEWS . '/partials/footer.php'; ?>
<!-- Aqui se puede incluir un script adicional para que no cargue en una página que no se desea -->

<?php include VIEWS . '/partials/close-html.php'; ?>
