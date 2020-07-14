<?php include VIEWS . '/partials/header.php';?>
<div class="social-information">
	<ul>
		<li>
			<a href="/index.php" target="_blank" class="earth">
				<i class="fas fa-home"></i> 
				<span>
					<?= isset($lang->lang['Home']) ? $lang->lang['Home'] : 'Inicio'; ?>
				</span>
			</a>
		</li>
		<li>
			<a href="/authenticate/index.php?action=languageLogin" class="earth">
	      		<i class="fas fa-language"></i>
	      		<span>
					<?= isset($lang->lang['ChangeLanguage']) ? $lang->lang['ChangeLanguage'] : 'Cambiar a inglés'; ?>
				</span>
	      	</a>
		</li>
	</ul>
</div>

<div class="container-fluid login_background">
	<img src="/assets/media/logotype.png" alt="Logotipo">
	<div class="row login_form">
		<div class="col-md-12">
      		<?php 
      			include VIEWS . "/partials/message.php"; 
  			?> 			
			<div class="row tittle_login_form">
				<h1>
					<i class="fas fa-unlock-alt"></i> 
					<?= isset($lang->lang['Forgot']) ? $lang->lang['Forgot'] : 'Olvidé mi contraseña'; ?>
				</h1>	
			</div>
			<form action="/authenticate/index.php?action=editForgot" method="POST" id="login_form">
				<div class="form-group">
					<input type="email" 
						id="email_login_form" 
						name="email" 
						value="<?= isset($createBack['email']) ? $createBack['email'] : '' ;?>" 
						class="form-control" required>
					<label 
						for="email_login_form" 
						class="label <?= isset($createBack['email']) ? 'active' : '' ;?>" 
						id="label_email_login_form">
						<?= isset($lang->lang['Email']) ? $lang->lang['Email'] : 'Correo electrónico'; ?>:
					</label>
				</div>
				<p><small><?= isset($lang->lang['ForgotEmail']) ? $lang->lang['ForgotEmail'] : 'Pronto recibirás un correo electrónico con tu nueva contraseña'; ?></small></p>
				<div class="form-group text-right">
					<button type="submit" class="btn btn-success" title="Registro">
						<i class="fas fa-paper-plane"></i> 
						<?= isset($lang->lang['SendButton']) ? $lang->lang['SendButton'] : 'Enviar'; ?>
					</button>
					<a class="btn btn-secondary" href="/authenticate/index.php?action=login">
						<i class="fas fa-sign-in-alt"></i> <?= isset($lang->lang['Login']) ? $lang->lang['Login'] : 'Iniciar sesión'; ?>
					</a>
				</div>
			</form>
		</div>
	</div>
</div>

	

<?php include VIEWS . '/partials/footer.php'; ?>
<!-- Aqui se puede incluir un script adicional para que no cargue en una página que no se desea -->

<?php include VIEWS . '/partials/close-html.php'; ?>
