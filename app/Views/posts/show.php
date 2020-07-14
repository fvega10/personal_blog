<?php 
	include VIEWS . '/partials/header.php';
	 
	
	if(isset($_SESSION['login'])) :
        include VIEWS . '/partials/navbar.php';
    else :
?>
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="/index.php"><?= $lang->lang['Home_button']; ?></a></li>
                    <li><a href="/contact/index.php?action=create"><?= $lang->lang['Contact_button']; ?></a></li>
                </ul>   
            </div>
        </nav>
        <br>
<?php
    endif;        
?>
<div class="container">	
	<?php 
		include VIEWS . "/partials/message.php"; 
	?>
</div>

<div class="posts_show_section">
	<div class="row">
		<div class="col s9 center-align grey lighten-3 z-depth-4">
			<div class="col s12">
				<h1 class="grey-text text-darken-2">
					<?= $collection['tittle']; ?>
				</h1>
                <div class="draw_line"></div>
                <br>
                <img src="<?= $collection['img']; ?>" alt="<?= $collection['img']; ?>" width="70%">
			</div>
            <div class="col s12">
                <p class="flow-text left-align">
                <?= $collection['long_description']; ?>
                </p>  
                
            </div>
            <div class="col s12">
            <?php 
                if(!is_null($collection['link']))
                {
            ?>
                <?= $collection['link']; ?>
            <?php
                }
            ?>
            </div>
            <br>
        <?php 
            if(isset($_SESSION['login'])) :
        ?>
                <div class="col s12">
                    <a class="lime darken-1 btn" href="/posts/index.php?action=edit&id=<?= $collection['id']; ?>">
                        <i class="material-icons right">edit</i>
                        Editar Post
                    </a>
                    <a class="red darken-4 btn" href="/posts/index.php">
                        <i class="material-icons right">arrow_back</i>
                        Regresar
                    </a>
                </div>
        <?php
            else :
        ?>
                <div class="col s12 back_show">
                    <a class="red darken-4 btn" href="/index.php">
                        <i class="material-icons right">arrow_back</i>
                        <?= $lang->lang['Back_button']; ?>
                    </a>
                </div>
        <?php
            endif;
        ?>
            <div class="col s12 left-align">
                <strong><?= $lang->lang['Autor_tittle']; ?>: </strong><i><?= $collection['fullname']; ?></i>
                <strong><?= $lang->lang['Publish_tittle']; ?>: </strong><i><?= $collection['date_post']; ?></i>
                <strong><?= $lang->lang['Category_tittle']; ?>: </strong><i><?= $collection['name']; ?></i>
            </div>
            <div class="col s12 left-align">
                <h5>
                    <strong><?= $lang->lang['Likes_tittle']; ?>: </strong><i><?= $collection['counter_likes']; ?></i>
                </h5>
<?php
    $continue = false;
    if(isset($visit)){
        foreach ($visit as $row){	
            if($row['ip'] == $myip){
                $continue = true;    
            }
        }
    }
                if(!$continue) :
?>
                <a id="like_counter" class="red darken-4 btn-floating pulse" href="/posts/index.php?action=like&id=<?= $collection['id']; ?>">
                        <i class="material-icons">favorite_border</i>
                </a>
                <br>
                <br>
            <?php else : ?>
                <i class="material-icons red-text text-darken-4">favorite</i>
            <?php endif; ?>
            </div>      
		</div>
		<div class="col s2 offset-s1 grey lighten-3 z-depth-4">
            <h5><?= $lang->lang['Other_articles']; ?></h5>
            <div class="collection">
<?php
    if(isset($allPosts)) :
        foreach ($allPosts as $row) :	
            if($row['id'] != $collection['id']) :
                
?>
                <a href="/posts/index.php?action=show&id=<?= $row['id']; ?>" class="collection-item"><?= $row['tittle']; ?></a>
<?php
            endif;
        endforeach;
    endif;
?>
            </div>
        </div>
	</div>
</div>
<?php 
	include VIEWS . '/partials/footer.php'; 
?>
<!-- Aqui se puede incluir un script adicional para que no cargue en una página que no se desea -->
<?php include VIEWS . '/partials/close-html.php'; ?>