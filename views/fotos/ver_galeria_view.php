<div class="titulo"><?php echo $tituloGaleria->titulo?></div>
<div class="fotos-lightBox">
	<ul>
	<?php
		foreach ($fotosGaleria as $f) {
			echo "\t<li>
						<a href=\"".image_url($f->foto,'800x600')."\" data-lightbox=\"roadtrip\" class=\"image-link\" title=\"".$tituloGaleria->titulo."\">
							<img class=\"lightBox-image\" src=\"".image_url($f->foto,'300x200')."\" alt=\"\" />
						</a>
					</li>\n";
		}
	?>
	</ul>
</div>