<?php
 verifica_usuario_logado();
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Gerenciador de conteúdo</title>

	<link href="<?php echo base_url("arquivoadmin/css/layout.css");?>" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url();?>arquivoadmin/validar/css/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>public/util/bootstrap/css/bootstrap.min.css"/>
	<link  rel="shortcut icon" href="<?php echo base_url();?>/public/imagem/layout/fivecon.png" />
	<link rel="stylesheet" href="<?php echo base_url()?>arquivoadmin/jquery-ui/css/ui-lightness/jquery-ui-1.9.2.custom.css" />

	<script src="<?php echo base_url()?>arquivoadmin/jquery-ui/js/jquery-1.8.3.js"></script>
	<script src="<?php echo base_url()?>arquivoadmin/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

	<script>
	$(function(){
		$(".datepicker").datepicker({"dateFormat":'yy-mm-dd'});
	});
	</script>
	<script src="<?php echo base_url();?>arquivoadmin/validar/js/languages/jquery.validationEngine-pt_BR.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo base_url();?>arquivoadmin/validar/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>

	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#validar_formulario").validationEngine();
		});
	</script>
</head>

<body>
	<div id="geral">
		<div id="topo">
			<div id="info_admin">
				<h3>Área Administrativa</h3>
				<span><?php echo get_user()->us_nome; ?></span>
				<a href="<?php echo base_admin("usuarios/deslogar_user"); ?>">Sair</a>
			</div>

			<div id="info_objeto">
				<a target="_blank" href="http://www.ipecon.com.br/">
					<img src="<?php echo base_url("arquivoadmin/imagem/logo.png"); ?>" />
				</a>
			</div>
		</div>
	</div>

	<!--@@@@@ Menu @@@@@-->
	<div id="menu">
		<div id='menu_conteudo'>
			<ul id="mymenu">
				<li><?php echo gerar_link(array(1,2),base_admin(),'Conteúdo')?>
					<ul>
					<?php
					foreach($this->config->config['menu'] as $modulo=> $descricao){
					?>
						<li><?php echo gerar_link(array(1,2),base_admin('modulos/'.$modulo),$descricao)?></li>
					<?php }?>
					</ul>
				</li>
				<li><a href="<?php echo base_admin()?>">Usuários</a>
					<ul>
						<li><a href="<?php echo base_admin("usuarios/listar_usuarios");?>">LISTA DE USUÁRIOS</a></li>
						<li><a href="<?php echo base_admin("usuarios/form_usuario");?>">NOVO USUÁRIO</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div id="geral2">
		<?php
		if(isset($pagina)){
			$this->load->view($this->config->config['folder_admin'].'/'.$pagina."_view");
		}
		?>
		<script type="text/javascript" src="<?php echo base_url()?>arquivoadmin/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>arquivoadmin/ckeditor/adapters/jquery.js"></script>
		<script type="text/javascript">
		<!--
		$('.texto').ckeditor({
			filebrowserBrowseUrl: '<?php echo base_admin('imagens/set_ckeditor')?>',
			filebrowserImageBrowseUrl: '<?php echo base_admin('imagens/set_ckeditor')?>',
			filebrowserFlashBrowseUrl: '<?php echo base_admin('imagens/set_ckeditor')?>',
			filebrowserUploadUrl: '<?php echo base_admin('imagens/set_ckeditor')?>',
			filebrowserImageUploadUrl: '<?php echo base_admin('imagens/set_ckeditor')?>',
			filebrowserFlashUploadUrl: '<?php echo base_admin('magens/set_ckeditor')?>',
			toolbar:
				[
					['Bold', 'Italic', '-', 'NumberedList', 'BulletedList'],
					['Styles','Format','Font','FontSize'],
					['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
					['TextColor','BGColor'],'/',
					['Image','Table','HorizontalRule','-','Link', 'Unlink','-','Source'],
					['Maximize', 'ShowBlocks','-','RemoveFormat','YouTube']
				]
		});

		function seta_imagem_ckeditor(img){
			CKEDITOR.tools.callFunction(1,img);
		};

		//-->
		</script>
	</div>

	<script type="text/javascript">
		var id_imagem = '';
		var field_imagem = '';
		function recebe_imagem(imagem,tipo){
			if(tipo=='img'||tipo==undefined){
				$(id_imagem).attr('src','<?php echo base_url()?>'+imagem);
			}else{
				$(id_imagem).attr('src','<?php echo base_url()?>arquivoadmin/imagem/'+tipo);
			}
			$(field_imagem).val(imagem);
		}

		function abrir_gerenciador(_id_imagem,_field_imagem){
			id_imagem = _id_imagem;
			field_imagem = _field_imagem;
			window.open('<?php echo base_admin('imagens/configura/')?>','Gerenciador','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=1000,height=450,left=' + ((screen.width - 800)/ 2) + ',top=' + (screen.height - 600) / 2+'');
		}
	</script>

</body>
</html>

