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
					Edit Category
				</h3>	
			</div>
		</div>
		<form class="col s12" action="/categories/index.php?action=update&id=<?= $collection['id']; ?>" method="POST">
            <div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">filter_none</i>
					<input id="category_name" type="text" class="validate" name="category_name" value="<?= $collection['name']?>">
					<label for="category_name">
						Nombre de la categoría:
					</label>
				</div>
				<div class="col s12 m12 right-align">
					<button type="submit" class="waves-effect lime darken-1 btn">
						<i class="material-icons right">edit</i>
						Editar
					</button>
					<a class="red darken-4 btn" href="/categories/index.php">
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