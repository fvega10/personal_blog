<?php
	include VIEWS . '/partials/header.php';
?>

	<?php 
		if (is_null($_SESSION['login'])) :
			include VIEWS . '/information/index.php';
 		else : 
			header("Location: /posts/index.php");
		endif; 
	?>


<?php include VIEWS . '/partials/footer.php'?>
<!-- Aqui se puede incluir un script adicional para que no cargue en una página que no se desea -->

<?php include VIEWS . '/partials/close-html.php'?>

