<?php 
	include VIEWS . '/partials/header.php';
	include VIEWS . '/partials/navbar.php'; 
	
	if(isset($_SESSION['login'])) :

?>
<div class="container">
	<div class="row login_form grey lighten-3 z-depth-4">
		<div class="row center-align">
			<div class="col s12">
				<h3 class="grey-text text-darken-2">
					New Application
				</h3>	
			</div>
		</div>
		<form class="col s12" action="/applications/index.php?action=store" method="POST" enctype="multipart/form-data">
            <div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">filter_none</i>
					<input id="name" type="text" class="validate" name="name">
					<label for="name">
						Nombre de la aplicación:
					</label>
				</div>
                <div class="input-field col s12">
					<i class="material-icons prefix">filter_none</i>
					<input id="link" type="text" class="validate" name="link">
					<label for="link">
						Link del demo:
					</label>
				</div>
                <div class="input-field col s12">
					<div class="file-field input-field">
						<div class="btn">
							<span>Imágen de fondo</span>
							<input type="file" name="img">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text">
						</div>
					</div>
				</div>
				<div class="col s12 m12 right-align">
					<button type="submit" class="waves-effect green lighten-1 btn">
						<i class="material-icons right">check</i>
						Agregar
					</button>
					<a class="red darken-4 btn" href="/applications/index.php">
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
<?php 
	else :
		include VIEWS . '/partials/forbidden.php';
	endif;
	include VIEWS . '/partials/footer.php'; 
?>
<!-- Aqui se puede incluir un script adicional para que no cargue en una página que no se desea -->
<?php include VIEWS . '/partials/close-html.php'; ?>