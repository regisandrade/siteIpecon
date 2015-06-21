<div class="titulo">Artigos</div>
<div class="artigos">
	<ul>
	<?php
	foreach($artigos as $e) {
		echo "<li><a href='".base_url()."artigos_publicados/".$e->Artigo."'>".substr($e->Descricao,0,47)."</a></li>";
	} ?>
	</ul>
</div>