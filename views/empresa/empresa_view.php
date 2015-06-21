    <?php foreach($empresa as $e) { ?>
    <div class="titulo">
		<?php echo  $e->titulo; ?>
    </div>

    <div class="texto">
         <?php echo imagensLightBox($e->texto); ?>
    </div>
    <?php } ?>