<?php 
	include VIEWS . '/partials/header.php';
	 
	
	if(isset($_SESSION['login'])) :
        include VIEWS . '/partials/navbar.php';
    else :
?>
        <nav>
            <div class="nav-wrapper">
                <a href="/index.php" class="brand-logo">
                    <img width="40" src="/assets/media/logotype.png" alt="Logotipo" style="margin-top: 10px">
                </a>
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
		<div class="col s11 m11 center-align grey lighten-3 z-depth-4">
			<div class="col s12">
				<h1 class="grey-text text-darken-2 post_title">
					<?= $collection['tittle']; ?>
				</h1>
                <div class="draw_line"></div>
                <br>
                <img src="<?= $collection['img']; ?>" alt="<?= $collection['img']; ?>" width="70%">
			</div>
            <div class="col s12">
                <p class="flow-text">
                <?= $collection['long_description']; ?>
                </p>  
                
            </div>
            <div class="col s12">
            <?php 
                if(!is_null($collection['link']))
                {
                    echo $collection['link'];
                }
            ?>
            </div>
            <br>
        <?php 
            if(isset($_SESSION['login'])) :
        ?>
                <div class="col s12 right-align">
                    <a class="lime darken-1 btn" href="/posts/index.php?action=edit&id=<?= $collection['id']; ?>">
                        <i class="material-icons right">edit</i>
                        Editar Post
                    </a>
                    <a class="blue-grey darken-4 btn" href="/posts/index.php">
                        <i class="material-icons left">arrow_back</i>
                        <?= $lang->lang['Back_button']; ?>
                    </a>
                    <a class="btn waves-effect waves-light" href="/contact/index.php?action=create">
                        <i class="material-icons left">phone_android</i>
                        <?= $lang->lang['Contact_button']; ?>
                    </a>
                </div>
        <?php
            else :
        ?>
                <div class="col s12 right-align">
                    <a class="btn blue-grey darken-4" href="/index.php">
                        <i class="material-icons left">arrow_back</i>
                        <?= $lang->lang['Back_button']; ?>
                    </a>
                    <a class="btn waves-effect waves-light" href="/contact/index.php?action=create">
                        <i class="material-icons left">phone_android</i>
                        <?= $lang->lang['Contact_button']; ?>
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
                    <i class="material-icons red-text" style="position: relative;top: 7px;font-size: 30px;">favorite</i>

                    </strong><i><?= $collection['counter_likes']; ?></i>
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
<hr>
<br>
                <a id="like_counter" class="btn waves waves-effect pulse red white-text" href="/posts/index.php?action=like&id=<?= $collection['id']; ?>">
                        Me gusta
                        <i class="material-icons left">thumb_up</i>
                </a>
                <br>
                <br>
    <hr>
                <br>
                <br>
            <?php else : ?>
                <i class="material-icons red-text text-darken-4">favorite</i>
            <?php endif; ?>
            </div>      
        </div>
        <br>
		<br>
		<div class="col s11 m11 grey lighten-3 z-depth-4" style="margin-top: 10px;">
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