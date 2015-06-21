<div class="titulo">Nossas Fotos</div>
<div class="fotos">
	<ul>
		<?php foreach($galerias as $g) { ?>
		<li><a href="<?php echo base_url('index.php').'/fotos/verGaleria/'.$g->id_galeria?>"><img src="<?php echo base_url()?>public/imagem/layout/camera.png">&nbsp;<?php echo $g->titulo; ?></a></li>
		<?php } ?>
	</ul>				
</div>