<?php 
	include VIEWS . '/partials/header.php';
	include VIEWS . '/partials/navbar.php'; 
	
	if(isset($_SESSION['login'])) :

?>
<div class="container">	
	<?php 
		include VIEWS . "/partials/message.php"; 
	?>
</div>
<div class="container posts_section grey lighten-3 z-depth-4">

	<div class="row">
		<div class="col s12 right-align">
			<h1 class="center-align teal-text text-lighten-1">
				Mensajes recibidos
			</h1>
			<div class="draw_line"></div>
		</div>
		<div class="col s8 offset-s2">
			<table>
				<thead>
				<tr>
					<th>Id</th>
					<th>Correo electrónico</th>
					<th>Mensaje</th>
					<th>Fecha</th>
				</tr>
				</thead>

				<tbody>
	<?php
		if(isset($collection)) :
			foreach ($collection as $row) :		
	?>
				<tr>
					<td><?= $row['id']; ?></td>
                    <td><?= $row['email']; ?></td>
					<td><?= $row['user_message']; ?></td>
					<td><?= $row['date_message']; ?></td>
				</tr>
	<?php 
			endforeach;
		else: 

		endif;
	?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php 
	else :
		include VIEWS . '/partials/forbidden.php';
	endif;
	include VIEWS . '/partials/footer.php'; 
?>
<!-- Aqui se puede incluir un script adicional para que no cargue en una página que no se desea -->
<?php include VIEWS . '/partials/close-html.php'; ?>