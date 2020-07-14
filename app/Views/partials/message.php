<div class="row">
    <div class="col s4 offset-s4 alert <?php echo $message->getLevel(); ?>">
        <p class="center-align">
        <?php
            echo $message->getMessage();
        ?>
        </p>
    </div>
</div>