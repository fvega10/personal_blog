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
					New Post
				</h3>	
			</div>
		</div>
		<form class="col s12" action="/posts/index.php?action=store" method="POST" enctype="multipart/form-data">
            <div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">date_range</i>
					<input type="text" class="datepicker" name="date_post" required>
					<label for="date_post">
						Fecha del Post:
					</label>
				</div>

				<div class="input-field col s12">
					<i class="material-icons prefix">title</i>
					<input id="tittle" type="text" class="validate" name="tittle" required>
					<label for="tittle">
						Título:
					</label>
				</div>

				<div class="input-field col s12">
					<i class="material-icons prefix">description</i>
					<textarea id="long_description" class="materialize-textarea" name="long_description" required></textarea>
					<label for="long_description">
						Descripción larga:
					</label>
				</div>

				<div class="input-field col s12">
					<i class="material-icons prefix">short_text</i>
					<textarea id="short_description" class="materialize-textarea" name="short_description" required></textarea>
					<label for="short_description">
						Descripción Corta:
					</label>
				</div>

				<div class="input-field col s12">
					<i class="material-icons prefix">insert_link</i>
					<input id="link" type="text" class="validate" name="link">
					<label for="link">
						Link de video:
					</label>
				</div>
				<div class="input-field col s12">
					<select name="category_id" required>
						<option value="" disabled selected>Seleccione la categoría:</option>
					<?php 
					if(isset($collection)) :
						foreach ($collection as $row) :	
					?>
						<option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
					<?php
						endforeach;
					endif;
					?>
					</select>
					<label>Seleccione:</label>
				</div>

				<div class="input-field col s12">
					<div class="file-field input-field">
						<div class="btn">
							<span>Imágen de fondo</span>
							<input type="file" name="img" required>
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
					<a class="red darken-4 btn" href="/posts/index.php">
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