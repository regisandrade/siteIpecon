<div id="pagina-interna">
	<div class="internaCtrl">
		<div class="titulo">Depoimentos</div>
			<div class="texto">
			<?php foreach($depoimentos as $e) {
				echo "<p><strong>".$e->Nome."</strong> - <i>".$e->Curso."</i><br>";
				echo $e->Depoimento."</p><br>";
			} ?>
		</div>
	</div>
</div>