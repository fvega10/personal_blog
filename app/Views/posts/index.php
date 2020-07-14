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
				Posts
			</h1>
			<div class="draw_line"></div>
		</div>
		<div class="col s12 right-align">
			<a class="btn-floating btn-large waves-effect green lighten-1" href="/posts/index.php?action=create"><i class="material-icons">add</i></a>
		</div>
		<div class="col s8 offset-s2">
			<table>
				<thead>
					<tr>
						<th>Id</th>
						<th>Date post</th>
						<th>Tittle</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
	<?php
		if(isset($collection)) :
			foreach ($collection as $row) :	
	?>
				<tr>
					<td><?= $row['id']; ?></td>
					<td><?= $row['date_post']; ?></td>
					<td><?= $row['tittle']; ?></td>
					<td><?= $row['short_description']; ?></td>
					<td>
						<a class="btn-floating waves-effect grey darken-4" href="/posts/index.php?action=show&id=<?= $row['id']; ?>">
							<i class="material-icons">remove_red_eye</i>
						</a>
						<a class="btn-floating waves-effect lime darken-1" href="/posts/index.php?action=edit&id=<?= $row['id']; ?>">
							<i class="material-icons">edit</i>
						</a>
						<a class="btn-floating waves-effect waves-light red" href="/posts/index.php?action=destroy&id=<?= $row['id']; ?>">
							<i class="material-icons">delete</i>
						</a>
					</td>
				</tr>
	<?php
			endforeach;
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