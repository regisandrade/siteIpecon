<div class="titulo">Links</div>
<div class="links">
	<ul>
	<?php foreach($links as $e) {
		echo "<li><a href=\"http://".$e->Link."\" target=\"_blank\">".$e->Descricao."</a></li>";
	} ?>
	</ul>
</div>