<?php 
	include VIEWS . '/partials/header.php';
	include VIEWS . '/partials/navbar.php'; 
?>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/index.php"><?= $lang->lang['Home_button']; ?></a></li>
        </ul>   
    </div>
</nav>
<br>
<div class="container">	
	<?php 
		include VIEWS . "/partials/message.php"; 
	?>
</div>
<div class="container">
	<div class="row login_form grey lighten-3 z-depth-4">
		<div class="row center-align">
			<div class="col s12">
				<h3 class="grey-text text-darken-2">
					<?= $lang->lang['Contact_button']; ?>
				</h3>	
			</div>
		</div>
		<?php 
			$email = isset($createBack['email']) ? $createBack['email'] : null;
			$message = isset($createBack['message']) ? $createBack['message'] : null;
		?>
		<form class="col s12" action="/contact/index.php?action=sendEmail" method="POST">
            <div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">email</i>
					<input id="email" type="email" class="validate" name="email" value="<?= $email; ?>" required>
					<label for="email">
						Correo electrónico:
					</label>
                </div>
                <div class="input-field col s12">
					<i class="material-icons prefix">message</i>
                    <textarea id="message" class="materialize-textarea" name="message" required><?= $message; ?></textarea>
                    <label for="message">Mensaje:</label>
                </div>
                <?php 
                    $a = rand(5, 15);
                    $b = rand(5, 15);
                ?>
                <h6 class="center-align">Necesito confirmar que no eres un robot</h6>
                <div class="input-field col s12">
                    <input type="text" name="a" hidden value="<?= $a; ?>">
                    <input type="text" name="b" hidden value="<?= $b; ?>">
                    <input id="input_text" type="number" data-length="10" name="response">
                    <label for="input_text">¿Cuánto es: <?= $a; ?> + <?= $b; ?>?</label>
                </div>
                
				<div class="col s12 m12 right-align">
					<button type="submit" class="waves-effect green lighten-1 btn">
						<i class="material-icons right">send</i>
						Enviar
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
<?php 
	include VIEWS . '/partials/footer.php'; 
?>
<!-- Aqui se puede incluir un script adicional para que no cargue en una página que no se desea -->
<?php include VIEWS . '/partials/close-html.php'; ?>