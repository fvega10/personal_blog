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
	<div class="row socia_media">
			<a href="https://www.facebook.com/fvegau.10/" class="right-align tooltipped" data-position="left" data-tooltip="Facebook"><img src="/assets/media/facebook.png" width="30" alt="Facebook"></a>
			<a href="https://www.instagram.com/fabriciovega/" class="right-align tooltipped" data-position="left" data-tooltip="Instagram"><img src="/assets/media/instagram.png" width="30" alt="Instagram"></a>
			<a href="/users/index.php?action=language" class="right-align tooltipped" data-position="left" data-tooltip="<?= $lang->lang['change_language']; ?>"><img src="/assets/media/traducir.png" width="30" alt="Cambiar idioma"></a>
	</div>
</div>
<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer" style="width: 75% !important ; height: 75% !important ;">
    <div class="modal-content">
		<div class="row">
			<div class="col s12 m2">
				<a href="#user"><img class="circle img_about" src="/assets/media/avatar-img-2.png"></a>
			</div>
			
			<div class="col s12 m8 offset-m2 tittle_about valign-wrapper">
				<h4 class="left-align">
					<?= $lang->lang['About_tittle']; ?>
					<br>
				</h4>
			</div>	
		</div>
		<hr>
		<p class="text-about" style="text-align: justify">
			<strong class="rotate"><i class="material-icons">format_quote</i></strong>	
			<?= $lang->lang['WhoIAm']; ?>
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
						<i class="left-align"><strong><?= $row['Category']; ?>: </strong><?= $row['name']; ?></i>
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
		<div class="col s12 m12 l4">
			<h5><?= $lang->lang['Development_projects']; ?></h5>
			<div class="row">
				<span class="plus">
					+
				</span>
				<span data-purecounter-duration="10" data-purecounter-delay="2" data-purecounter-end="100"
                class="purecounter">0</span>
			</div>
		</div>
		<div class="col s12 m12 l4" >
			<h5><?= $lang->lang['Year_experience']; ?></h5>
			<span class="plus">
				+
			</span>
			<span data-purecounter-duration="10" data-purecounter-delay="2" data-purecounter-end="10"
                class="purecounter">0</span>
		</div>
		<div class="col s12 m12 l4" >
			<h5><?= $lang->lang['Tools_used']; ?></h5>
			<span class="plus">
				+
			</span>
			<span data-purecounter-duration="10" data-purecounter-delay="2" data-purecounter-end="20"
                class="purecounter">0</span>
		</div>
	</div>
</div>
<div class="white contact_panel cardPrices">
	<div class="center-align" data-aos="fade-down">
		<h1 class="center-align teal-text text-darken-1"><?= $lang->lang['Services']; ?></h1>
		<div class="draw_line"></div>
	</div>
	<section class="header">
		<h3 class="left-align red-text text-lighten-2">
			<i class="material-icons">chevron_right</i>
			<?= $lang->lang['Service_1']; ?>
		</h3>
		<div class="row">
			<div class="col m5 s12 center-align">
				<img class="materialboxed" width="70%" src="/assets/media/websites.png" style="margin: 0 auto;">
			</div>
			<div class="col m7 s12">
				<p class="about_services">
					<?= $lang->lang['Service_1_Detail']; ?>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col s12 container">
				<div class="col s12 m4">
					<div class="card border">
						<div class="card-head cyan darken-3 center-align">
							<div class="card-head-content">
								<span><?= $lang->lang['Basic']; ?></span><br>
								<span class="price"><?= $lang->lang['Basic_Amount']; ?></span>
							</div>
						</div>
						<div class="card-content no-padding">
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_0']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_1']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_2']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_3']; ?></p>
							<p class="item-pricing-table"> </p>
							<p class="item-pricing-table"> </p>
							<div class="center-align">
								<a href="/contact/index.php?action=create&option=1" class="center-align btn waves-effect cyan darken-3 purchase-btn"><?= $lang->lang['Detail_Button']; ?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col s12 m4">
					<div class="card border">
						<div class="card-head grey darken-4 center-align">
							<div class="card-head-content">
								<span><?= $lang->lang['Intermediate']; ?></span><br>
								<span class="price"><?= $lang->lang['Intermediate_Amount']; ?></span>
							</div>
						</div>
						<div class="card-content no-padding">
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_0']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_1']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_2']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_4']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_5']; ?></p>
							<p class="item-pricing-table"></p>
							<div align="center">
								<a href="/contact/index.php?action=create&option=2" align="center" class="btn waves-effect grey darken-4 purchase-btn"><?= $lang->lang['Detail_Button']; ?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col s12 m4">
					<div class="card border">
						<div class="card-head deep-purple accent-4 center-align">
							<div class="card-head-content">
								<span><?= $lang->lang['Premium']; ?><span><br>
								<span class="price"><?= $lang->lang['Premium_Amount']; ?></span>
							</div>
						</div>
						<div class="card-content no-padding">
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_0']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_1']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_2']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_4']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_5']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_6']; ?></p>
							<div align="center">
								<a href="/contact/index.php?action=create&option=3" align="center" class="btn waves-effect deep-purple accent-4 purchase-btn"><?= $lang->lang['Detail_Button']; ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="header">
		<h3 class="left-align red-text text-lighten-2">
			<i class="material-icons">chevron_right</i>
			<?= $lang->lang['Service_2']; ?>
		</h3>
		<div class="row">
			<div class="col m5 s12 center-align">
				<img class="materialboxed" width="70%" src="/assets/media/software.png" style="margin: 0 auto;">
			</div>
			<div class="col m7 s12">
				<p class="about_services">
					<?= $lang->lang['Service_2_Detail']; ?>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col s12 container">
				<div class="col s12 m4 offset-m4">
					<div class="card border">
						<div class="card-head red darken-3 center-align">
							<div class="card-head-content">
								<span><?= $lang->lang['Business']; ?><span><br>
								<span class="price"><?= $lang->lang['Business_Amount']; ?></span>
							</div>
						</div>
						<div class="card-content no-padding">
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_7']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_8']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_9']; ?></p>
							<p class="item-pricing-table"><i class="material-icons">check</i> <?= $lang->lang['Detail_10']; ?></p>
							<div align="center">
								<a href="/contact/index.php?action=create&option=4" align="center" class="btn waves-effect waves-light red darken-3 purchase-btn"><?= $lang->lang['Detail_Button']; ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!--INFO-->
<div class="grey lighten-5 contact_panel">
	<div class="center-align" data-aos="fade-down">
		<h1><?= $lang->lang['Contact_title']; ?></h1>
		<h4><?= $lang->lang['Contact_info']; ?></h4>
	</div>
	<div class="center-align">
		<a href="https://wa.me/50687082379?text=Deseo%20información" class="btn-large btn waves-effect pulse"><i class="material-icons left">phone_android</i><?= $lang->lang['Contact_btn']; ?></a>
	</div>
	
	<br>
	<br>
</div>
<footer class="page-footer">
	<div class="container">
		<div class="row">
			<div class="col l6 s12">
				<h5 class="white-text"><?= $lang->lang['Firts_tittle_principal']; ?></h5>
				<i class="grey-text text-lighten-4" style="text-align: justify;">
					<?= $lang->lang['Phrase']; ?>
				</i>
			</div>
			<div class="col l4 offset-l2 s12">
				<h5 class="white-text">
					<?= $lang->lang['Third_tittle_principal']; ?>	
				</h5>
				<ul>
					<?php
					if(isset($collection)) :
						foreach ($collection as $row) :	
					?>
						<li>
							<a class="grey-text text-lighten-3" href="/posts/index.php?action=show&id=<?= $row['id']; ?>">
								- <?= $row['tittle']; ?>
							</a>
						</li>
					<?php
						endforeach;
					endif;
					?>
				</ul>
			</div>
			<div class="col l4 offset-l2 s12">
				<h5 class="white-text">
					<?= $lang->lang['Contact_button']; ?>	
				</h5>
				<ul>
					<li>
						<?= $lang->lang['Phone']; ?>:
						(+506) 87082379
					</li>
					
					<li>
						<a href="mailto:info@fabriciovega.com" class="grey-text text-lighten-3">
							fvegau@fabriciovega.com
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			&copy; <?php echo date('Y'); ?> <?= $lang->lang['CopyRight']; ?>
			<p class="grey-text text-lighten-4 right">
				<?= $lang->lang['Visited_number']; ?> #
				<span data-purecounter-duration="0.5" data-purecounter-end="<?= $counter[0]['cont'];?>"
				class="purecounter">0</span>
		</p>
		</div>
	</div>
</footer>