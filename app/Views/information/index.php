<!--WELCOME-->
<div class="home">
	<div class="home_layer red darken-1"></div>
	<div class="row home_tittle valign-wrapper" data-aos="fade-up" data-aos="fade-up"
		data-aos-easing="linear"
		data-aos-duration="1500">
		<div class="col s12 m12 center-align">				
			<h1 class="center-align"><?= $lang->lang['Firts_tittle_principal']; ?></h1>
			<h5><?= $lang->lang['Firts_tittle_secondary']; ?></h5>
			<a class="waves-effect waves-light btn-large pulse modal-trigger" href="#modal1"><?= $lang->lang['About_button']; ?></a>
		</div>
	</div>
</div>
<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
		<div class="row">
			<div class="col s2">
				<a href="#user"><img class="circle img_about" src="/assets/media/avatar-img.png"></a>
			</div>
			<div class="col s8 offset-s2 tittle_about valign-wrapper">
				<h4 class="right-align"><?= $lang->lang['About_tittle']; ?></h4>
			</div>
		</div>
		<hr>
		<p class="text-about" style="text-align: center">
	  		<strong class="rotate"><i class="material-icons">format_quote</i></strong>	
			Oriundo de Ciudad Quesada, San Carlos, Alajuela, CR.
			<br>
			Tengo <?php echo (date("Y") - 1991); ?> años de edad.
			<br>
			Desde pequeño he sido amante de los número y del fútbol.
			<br>
			Actualmente soy Lic. en Administración de Negocios, además Ingeniero del Software.
			<br>
			Mi pasión cambió cerca de los 19 años, pasando de entrenar en campos de fútbol todos los días, ha estar sentado en un escritorio
			digitando líneas de código de varios lenguajes de programación e interesantes tecnologías que ayudan a complementarlas para que estas sean maravillosas.
			<br>
			Mi objetivo principal es: Visualizar necesidades en la población de manera que, con el conocimiento en el ambiente tecnológico pueda aportar mi granito de arena.
			<br>
			Cada vez que ingreso a un sitio web en donde se ofrece "X" servicio y estos están inundados en publicidad, me lloran los ojos e intento desarrollar algo parecido.
			<br>
			Quiero poder ayudar a pequeños empresarios con la creación de palancas tecnológicas que les permita proyectar su negocios a otro nivel.
			<br>
			Esto se ha convertido en un verdadero hobbie para mí.
			<strong><i class="material-icons">format_quote</i></strong>
		</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat"><?= $lang->lang['Close_button']; ?></a>
    </div>
</div>
<div class="applications grey lighten-4">
	<br>
	<h1 class="center-align red-text text-lighten-2" data-aos="fade-down"><?= $lang->lang['Second_tittle_principal']; ?></h1>
	<p class="center-align red-text text-lighten-2"><?= $lang->lang['Second_tittle_secondary']; ?></p>
	<div class="carousel" data-aos="fade-up">
<?php
	if(isset($applications)) :
		foreach ($applications as $row) :	
?>
          <a class="carousel-item" href="<?= $row['link']; ?>" target="_blank" style="z-index: -2; opacity: 0.2; visibility: visible; transform: translateX(194.5px) translateY(100px) translateX(-400px) translateZ(-400px);">
			<img src="<?= $row['img']; ?>" width="100%">
          </a>
<?php 
		endforeach;
	endif;
?>
	</div>
</div>
<!--PROJECTS-->
<div class="projects center-align">
	<div class="row">
		<div class="center-align">
			<h1 class="teal-text text-lighten-1" data-aos="fade-down"><?= $lang->lang['Third_tittle_principal']; ?></h1>
			<div class="draw_line"></div>
		</div>
	</div>
	<div class="row">
	<?php
	if(isset($collection)) :
		foreach ($collection as $row) :	
	?>
			<div class="col s12 m4" data-aos="flip-up">
				<div class="card hoverable">
					<div class="card-image waves-effect waves-block waves-light">
						<img class="activator" src="<?= $row['img']; ?>">
					</div>
					<div class="card-content">
						<span class="card-title activator grey-text text-lighten-1"><?= $row['tittle']; ?><i class="material-icons right">arrow_upward</i></span>
						<p><a class="waves-effect lime darken-1 btn" href="/posts/index.php?action=show&id=<?= $row['id']; ?>">Ver post</a></p>
					</div>
					<div class="card-reveal">
						<span class="card-title grey-text text-lighten-1"><?= $row['tittle']; ?><i class="material-icons right">close</i></span>
						<p><?= $row['short_description']; ?></p>
						<i class="left-align"><strong>Categoría: </strong><?= $row['name']; ?></i>
					</div>
				</div>
			</div>
	<?php
		endforeach;
	endif;
	?>
		</div>
	</div>
</div>
<!--INFO-->
<div class="teal lighten-1 information">
	<div class="center-align" data-aos="fade-down">
		<h1><?= $lang->lang['Four_tittle_principal']; ?></h1>
		<div class="draw_line_info"></div>
	</div>
	<div class="row center-align">
		<div class="col s12 m4" data-aos="fade-right">
			<h5><?= $lang->lang['Development_projects']; ?></h5>
			<div class="row">
				<span class="plus">
					+
				</span>
				<span data-purecounter-duration="10" data-purecounter-end="50"
                class="purecounter">0</span>
			</div>
		</div>
		<div class="col s12 m4" data-aos="fade-left">
			<h5><?= $lang->lang['Year_experience']; ?></h5>
			<span class="plus">
				+
			</span>
			<span data-purecounter-duration="10" data-purecounter-end="10"
                class="purecounter">0</span>
		</div>
		<div class="col s12 m4" data-aos="fade-down">
			<h5><?= $lang->lang['Tools_used']; ?></h5>
			<span class="plus">
				+
			</span>
			<span data-purecounter-duration="10" data-purecounter-end="20"
                class="purecounter">0</span>
		</div>
	</div>
</div>
<!--TECHNOLOGIES KNOWLEADE-->
<div class=" technologies">
	<div class="center-align" data-aos="fade-down">
		<h1 class="teal-text text-lighten-1"><?= $lang->lang['Five_tittle_principal']; ?></h1>
	</div>
	<div class="row">
		<div class="col s8" data-aos="flip-right">
			<img class="materialboxed" width="100%" src="/assets/media/java.jpg">
		</div>
		<div class="col s4 valign-wrapper" data-aos="flip-right">
			<img class="materialboxed" width="100%" src="/assets/media/c.jpg">
		</div>
	</div>
	<div class="row">
		<div class="col s4" data-aos="flip-right">
			<img class="materialboxed" width="100%" src="/assets/media/php.jpg">
		</div>
		<div class="col s8" data-aos="flip-right">
			<img class="materialboxed" width="100%" src="/assets/media/type_script.png">
		</div>
	</div>
	<div class="row">
		<div class="col s6" data-aos="flip-left">
			<img class="materialboxed" width="100%" src="/assets/media/html_js_css.png">
		</div>
		<div class="col s3" data-aos="flip-left">
			<img class="materialboxed" width="100%" src="/assets/media/bootstrap.png">
		</div>
		<div class="col s3" data-aos="flip-left">
			<img class="materialboxed" width="100%" src="/assets/media/materialize.png">
		</div>
	</div>
	<div class="row">
		<div class="col s6" data-aos="flip-right">
			<img class="materialboxed" width="100%" src="/assets/media/angular.png">
		</div>
		<div class="col s3" data-aos="flip-right">
			<img class="materialboxed" width="100%" src="/assets/media/react.png">
		</div>
		<div class="col s3" data-aos="flip-right">
			<img class="materialboxed" width="100%" src="/assets/media/laravel.jpg">
		</div>
	</div>
	<div class="row">
		<div class="col s6" data-aos="flip-left">
			<img class="materialboxed" width="100%" src="/assets/media/mariadb.png">
		</div>
		<div class="col s3" data-aos="flip-left">
			<img class="materialboxed" width="100%" src="/assets/media/mysql.jpg">
		</div>
		<div class="col s3" data-aos="flip-left">
			<img class="materialboxed" width="100%" src="/assets/media/phpmyadmin.jpg">
		</div>
	</div>
	<div class="row">
		<div class="col s3" data-aos="flip-right">
			<img class="materialboxed" width="100%" src="/assets/media/illustrator.jpg">
		</div>
		<div class="col s3" data-aos="flip-right">
			<img class="materialboxed" width="100%" src="/assets/media/photoshop.png">
		</div>
		<div class="col s6" data-aos="flip-right">
			<img class="materialboxed" width="100%" src="/assets/media/android.jpg">
		</div>
	</div>
</div>
<div class="visited_section red darken-1 valign-wrapper">
	<div class="row">
		<div class="col s12 center-align" data-aos="fade-down">
			<h1 class="grey-text text-lighten-5">
				<i class="large material-icons grey-text text-lighten-5">favorite</i>
				<br>
				<?= $lang->lang['Visited_number']; ?> #
				<span data-purecounter-duration="5" data-purecounter-end="<?= $counter[0]['cont'];?>"
                class="purecounter">0</span>
			</h1>
			<h5 class="grey-text text-lighten-5"><?= $lang->lang['Visited_thanks']; ?></h5>
		</div>
	</div>
</div>



