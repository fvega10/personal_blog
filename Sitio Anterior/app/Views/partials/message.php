<div class="row">
    <div class="col s8 offset-s2 alert <?php echo $message->getLevel(); ?>" style="padding: 10px">
        <p class="center-align white-text">
        <?php
            echo $message->getMessage();
        ?>
        </p>
    </div>
</div>