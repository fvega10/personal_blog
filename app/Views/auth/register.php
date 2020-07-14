<?php include VIEWS . '/partials/header.php';?>

<div class="container-fluid login_background">
	<img src="/assets/media/logotype.png" alt="Logotipo">
	<div class="row login_form">
		<div class="col-md-12">
      		<?php 
      			include VIEWS . "/partials/message.php"; 
  			?> 			
			<div class="row tittle_login_form">
				<h1>
					<i class="fas fa-user-plus"></i> 
					<?= isset($lang->lang['Register']) ? $lang->lang['Register'] : 'Registro'; ?>
				</h1>	
			</div>
			<form action="/authenticate/index.php?action=register" method="POST" id="login_form">
				<div class="form-group">
					<input 
						type="email" 
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
				<div class="form-group">
					<input 
						type="password" 
						id="password_login_form" 
						name="password" 
						value="<?= isset($createBack['password']) ? $createBack['password'] : '' ;?>" 
						class="form-control" required>
					<label 
						for="password_login_form" 
						class="label <?= isset($createBack['password']) ? 'active' : '' ;?>" 
						id="label_password_login_form">
							<?= isset($lang->lang['Password']) ? $lang->lang['Password'] : 'Contraseña'; ?>:
					</label>
				</div>

				<div class="form-group">
					<input 
						type="password" 
						id="repassword_login_form" 
						name="repassword" 
						value="<?= isset($createBack['repassword']) ? $createBack['repassword'] : '' ;?>" 
						class="form-control" required>
					<label 
						for="repassword_login_form" 
						class="label <?= isset($createBack['repassword']) ? 'active' : '' ;?>" 
						id="label_repassword_login_form">
							<?= isset($lang->lang['RePassword']) ? $lang->lang['RePassword'] : 'Confirmar contraseña'; ?>:
					</label>
				</div>
				
				<div class="form-group text-right">
					<button type="submit" class="btn btn-success" title="Registro">
						<i class="fas fa-check-circle"></i> 
						<?= isset($lang->lang['RegisterButton']) ? $lang->lang['RegisterButton'] : 'Registrarme'; ?>
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
