<div class="titulo">Cursos de Curta Duração</div>
<div class="cursos">
	<ul>
		<?php foreach($cursos as $e) {
			echo "<li><a href=\"".base_url().'cursos/getCurso/'.$e->Codg_Curso."\">".$e->Nome."</a></li>";
		} ?>
	</ul>
</div>