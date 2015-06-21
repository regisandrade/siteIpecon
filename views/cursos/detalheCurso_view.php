<div class="titulo"><?php echo $curso->Nome?></div>
<div class="divInscricao"><a href="<?php echo base_url('index.php').'/inscricao/preInscricao/'.$this->uri->segment(3)?>" class="btn btn-warning"><i class="icon-align-justify"></i>&nbsp;Realizar pré-inscrição</a></div>
<div class="detalheCurso">
	<?php
	if ($curso->CurtaDuracao == 'S') {
	?>
		<label>Carga Horária</label>
		<span><?php echo $curso->duracao; ?></span>

		<?php if(!empty($curso->apresentacao)){ ?>
			<label>Objetivos</label>
			<span><?php echo $curso->apresentacao; ?></span>
		<?php 
		}

		if(!empty($curso->publico)){ ?>
			<label>A quem se destina</label>
			<span><?php echo $curso->publico; ?></span>
		<?php 
		}

		if(!empty($curso->metodologia)){ ?>
		<label>Metodologia</label>
		<span><?php echo $curso->metodologia; ?></span>
		<?php }?>

		<label>Disciplinas</label>
		<span><?php echo $curso->disciplinas; ?></span>

		<label>Professor</label>
		<span><?php echo $curso->corpoDocente; ?></span>

		<label>Certificado</label>
		<span><?php echo $curso->certificados; ?></span>

		<label>Número de Vagas</label>
		<span><?php echo $curso->numeroVagas; ?></span>

		<label>Horário das Aulas</label>
		<span><?php echo $curso->horario; ?></span>

		<label>Início / Datas / Duração do Curso</label>
		<span><?php echo $curso->datas; ?></span>

		<label>Documentos para Inscrição</label>
		<span><?php echo $curso->inscricao; ?></span>

		<label>INFORMAÇÕES E INSCRIÇÕES</label>
		<span><?php echo $curso->coordenacaogeral; ?></span>
	<?php
	} else {
		if (!empty($curso->apresentacao)) {
	?>
		<label>Apresentação</label>
		<span><?php echo $curso->apresentacao ?></span>
		<?php
		}
		if (!empty($curso->publico)) {
		?> 
		<label>Público Alvo</label>
		<span><?php echo $curso->publico; ?></span>
		<?php
		}
		?> 
		<label>Datas Importante</label>
		<span><?php echo $curso->datas; ?></span>
		<label>Documentos para Inscrição</label>
		<span><?php echo $curso->inscricao; ?></span>
		<?php
		if (!empty($curso->avaliacao)) {
		?>
		<label>Avaliação</label>
		<span><?php echo $curso->avaliacao; ?></span>
		<?php
		}
		?> 
		<label>Disciplinas</label>
		<span><?php echo $curso->disciplinas; ?></span>
		<?php
		if (!empty($curso->metodologia)) {
		?>
		<label>Metodologia</label>
		<span><?php echo $curso->metodologia; ?></span>
		<?php
		}
		?> 
		<label>Certificados</label>
		<span><?php echo $curso->certificados; ?></span>
		<label>Duração do Curso</label>
		<span><?php echo $curso->duracao ?></span>
		<label>Número de Vagas</label>
		<span><?php echo $curso->numeroVagas; ?></span>
		<label>Coordenação Geral</label>
		<span><?php echo $curso->coordenacaogeral; ?></span>
		<?php
		if (!empty($curso->coordenacaoacademica)) {
		?>
	          <label>Coordenação Acadêmica</label>
	          <span><?php echo $curso->coordenacaoacademica; ?></span>
		<?php
		}
		?>               
		<label>Horário das Aulas</label>
		<span><?php echo $curso->horario; ?></span>
		<?php
		if (!empty($curso->processo)) {
		?>
		<label>Processo Seletivo</label>
		<span><?php echo $curso->processo; ?></span>
		<?php
		}
		?>
		<label>Corpo Docente</label>
		<span><?php echo $curso->corpoDocente; ?></span>
		<!--<label>Informações</label>
		<span><?php echo $curso->informacoes; ?></span>-->
	<?php
	}
	?>	
</div>