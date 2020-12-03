<?php 
	include VIEWS . '/partials/header.php';
	include VIEWS . '/partials/navbar.php'; 
?>
<nav>
    <div class="nav-wrapper">
        <a href="/index.php" class="brand-logo">
			<img width="40" src="/assets/media/logotype.png" alt="Logotipo" style="margin-top: 10px">
		</a>
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
<div class="container white">
	<div class="row center-align">
		<div class="col s12">
			<h3 class="grey-text text-darken-2">
				<?= $lang->lang['Contact_Form']; ?>
			</h3>
			<br>
			<div class="row center-align">
				<img id="avatar_contact" src="/assets/media/avatar-img-1.png" alt="Avatar" onmouseover="changSrc()" onmouseleave="changSrcBack()">
				<h5 class="center-align teal-text text-darken-4" id="message_contact"></h5>
				<h5 class="center-align red-text" id="message_contact_danger"></h5>
			</div>
		</div>
		<?php 
			$email = isset($createBack['email']) ? $createBack['email'] : null;
			$message = isset($createBack['message']) ? $createBack['message'] : null;
		?>
		<form class="col s12" id="form_contact">
			<div class="row">
				<div class="input-field col s12 m6">
					<input id="name" type="text" name="name" class="validate teal-text text-darken-2" required>
					<label for="name"><?= $lang->lang['Contact_Form_Name']; ?>:</label>
				</div>
			
				<div class="input-field col s12 m6">
					<input id="email" type="email" name="email" class="validate teal-text text-darken-2" required>
					<label for="email"><?= $lang->lang['Contact_Form_Email']; ?>:</label>
				</div>
			</div>
			<div class="row left-align">
				<div class="input-field col s12">
					<select name="subject" id="subject" class="browser-default" required>
					<?php 
						$option = isset($_GET['option']) ? $_GET['option'] : null;
						var_dump($_GET['option']);

						if(is_null($option)) :
					?>
							<option value="" disabled selected>Seleccione el plan deseado...</option>
					<?php
						endif;
					?>
						<option value="1" <?php if($option == "1") : echo "selected"; endif; ?> >Sitio Web - Básico</option>
						<option value="2" <?php if($option == "2") : echo "selected"; endif; ?> >Sitio Web - Intermedio</option>
						<option value="3" <?php if($option == "3") : echo "selected"; endif; ?> >Sitio Web - Premium</option>
						<option value="4" <?php if($option == "4") : echo "selected"; endif; ?> >Aplicación Web - Empresarial</option>
						<option value="5" <?php if($option == "5") : echo "selected"; endif; ?> >Otro</option>
					</select>
					
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<textarea id="message" name="message" class="materialize-textarea teal-text text-darken-2" required></textarea>
					<label for="message"><?= $lang->lang['Contact_Form_Message']; ?>:</label>
				</div>
			</div>
			<div class="row">
				<div class="col s12 right-align">
					<button id="btn_contact" type="button" class="btn" onclick="enviar()"><i class="material-icons left">send</i> <?= $lang->lang['Contact_Form_Button']; ?></button>
					<a href="/index.php" id="close_contact" class="modal-close waves-effect btn-flat btn red darken-4 grey-text text-lighten-5"><?= $lang->lang['Back_button']; ?></a>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	document.getElementById("name").focus();
	function changSrc()
	{
		document.getElementById("avatar_contact").src="../assets/media/avatar-img-2.png";
	}
	function changSrcBack()
	{
		document.getElementById("avatar_contact").src="../assets/media/avatar-img-1.png";
	}
	
	function enviar()
	{
		emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
		if(document.getElementById("name").value != "" &&
		document.getElementById("email").value != "" &&
		document.getElementById("message").value)
		{
			if(emailRegex.test(document.getElementById("email").value))
			{
				document.getElementById("btn_contact").innerHTML = "<img src='/assets/media/loading.gif' width='30' style='margin-top: 2px'>";
				
				$.ajax({
					url: "../users/index.php?action=sendEmail", 
					type: "POST", 
					data: $('#form_contact').serialize()
				}).done(function(message){
					if(message == "true"){
						document.getElementById("form_contact").className = "hide";
						document.getElementById("message_contact").innerHTML  = "¡Mensaje enviado exitosamente! - Message sent successfully";
						document.getElementById("message_contact_danger").innerHTML  = "";
					}else{
						document.getElementById("message_contact_danger").innerHTML  = message;
						//alert(message);	
						//location.reload();
					}
				});
			}
			else
			{
				document.getElementById("message_contact_danger").innerHTML  = "Correo electrónico incorrecto - Invalid email"
			}
		}
		else
		{
			document.getElementById("message_contact_danger").innerHTML  = "Todos los campos son requeridos - All inputs are required";
		}
	}
</script>
<?php 
	include VIEWS . '/partials/footer.php'; 
?>
<!-- Aqui se puede incluir un script adicional para que no cargue en una página que no se desea -->
<?php include VIEWS . '/partials/close-html.php'; ?>