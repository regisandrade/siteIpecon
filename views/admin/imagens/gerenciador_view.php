<?php
if(!isset($_GET['pasta']) || empty($_GET['pasta'])){
	$_GET['pasta'] = "public/imagem/gerenciador/";
}

if(!file_exists($_GET['pasta'])){
	mkdir($_GET['pasta']);
}
	

#apagando uma foto
if(isset($_GET['apaga'])){
	if(is_file($_GET['apaga'])){
		unlink($_GET['apaga']);
		//Diretorio
	}else if(is_dir($_GET['apaga'])){
		if(!@rmdir($_GET['apaga'])){echo "Diretório não está vazio";}
	}
	redirect(current_url()."?pasta=".$_GET['pasta']);
}
	

if(substr($_GET['pasta'],-1)=="/"){
	$_GET['pasta'] = substr($_GET['pasta'],0,-1);
}	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo base_url()?>arquivoadmin/jquery-ui/css/ui-lightness/jquery-ui-1.9.2.custom.css" />
	<script src="<?php echo base_url()?>arquivoadmin/jquery-ui/js/jquery-1.8.3.js"></script>
	<script src="<?php echo base_url()?>arquivoadmin/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
	<script src="<?php echo base_url()?>arquivoadmin/upload/jquery.uploadify.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>arquivoadmin/upload/uploadify.css">

	<style>
		body{
			padding:0;
			margin:0;
			background:#FFF;
			font-size:12px;
			font-family:arial;
		}
		img{
			border:none;
		}
		a{
			text-decoration:none;
			color:#39C;	
		}
	</style>

	<script language=javascript>
	function envia_imagem(imagem,tipo) {
		<?php if(isset($_SESSION['ckeditor'])&&$_SESSION['ckeditor']==true){?>
			self.opener.seta_imagem_ckeditor('<?php echo base_url()?>'+imagem);
			self.close();
		<?php }else{?>
			self.opener.recebe_imagem(imagem,tipo);
			window.close();
		<?php }?>
	}
	</script>
	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'buttonText' : '<img src="<?php echo base_url()?>arquivoadmin/imagem/nova-imagem.png" />',
				'onQueueComplete' : function(queueData) {
					location = '<?php echo current_url()."?pasta=".$_GET['pasta']?>';
				},
				'formData'     : {
					'atualizar':'sim',
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : '<?php echo base_url()?>/arquivoadmin/upload/uploadify.swf',
				'uploader' : '<?php echo base_admin('imagens/upload/?pasta='.$_GET['pasta'])?>'
			});
		});
	</script>

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#f3f3f3">
	<tr>
		<td width="66%" style="font-size:16px;">
			Você está em: <strong style="color:#09F;"><?php 
			$dir = explode("/",$_GET['pasta']);
			$dir_atual = "";
			$dir_current = "";
			foreach($dir as $d){
				$dir_atual .= $d."/";
				$dir_current = $d;

				if($d!="public" && $d!="imagem"){
			?>
				<a style="font-size:17px;" title="Ir para <?php echo $d?>" href="?pasta=<?php echo $dir_atual?>" class="texto_pagina">
				<?php echo $d?> &raquo; </a>
			<?php
				}
			}
			?>
  			</strong>
		</td>
		<td width="23%" align="center">
			<form>
				<div id="queue"></div>
				<input id="file_upload" name="file_upload" type="file" multiple="true">
			</form>
		</td>
    	<td width="11%" align="left"><img style="cursor:pointer;" title="Criar nova pasta em <?php echo $dir_current?>" id="buttom-nova-pasta" src="<?php echo base_url()?>arquivoadmin/imagem/new-folder.png" />
		</td>
	</tr>
</table>

<div id="new-folder" style="display:none;">
	<form action="" style="padding:10px; background:#f3f3f3;" method="post" name="form1" id="form1">
		Nome da pasta: <input name="new_diretorio" type="text" />
		<input type="submit" value="Gravar Novo" />
	</form>
</div>

<div style="background:#F60; color:#FFF; font:bold 12px Arial, Helvetica, sans-serif;">
<?php 
if(isset($_POST['new_diretorio']) && $_POST['new_diretorio']!= "" && !file_exists("../".$_GET['pasta']."/".url_title($_POST['new_diretorio']))){
	mkdir($_GET['pasta']."/".url_title($_POST['new_diretorio']));
}
?>
</div>

<?php
// pega o endereço do diretório
$diretorio = $_GET['pasta']; 
// abre o diretório
$ponteiro  = opendir($diretorio);
//Listando as imagens

while ($nome_itens = readdir($ponteiro)) {
	if($nome_itens!=".."&&$nome_itens!="."&&$nome_itens!=" "){
		if(is_dir($_GET['pasta']."/".$nome_itens)){
?>
			<div title="<?php echo $nome_itens?>" style="border-bottom:1px solid #f3f3f3; width:85px; height:105px; border:1px solid #ccc; text-align:center; margin:5px; float:left; position:relative;">
				<a style="color:#f00; font-size:11px; text-decoration:none; position:absolute;top:0px; right:2px;"
					onclick="return confirm('Deseja realmente excluir essse diretório?\n\n Ela pode está sendo usado.')"
					href="?pasta=<?php echo $_GET['pasta']?>&apaga=<?php echo $_GET['pasta']."/".$nome_itens?>">Excluir</a>
				<br />

				<a href="?pasta=<?php echo $_GET['pasta']."/".$nome_itens?>" class="texto_pagina">
					<img width='70px' height="67px" src='<?php echo base_url('arquivoadmin/imagem/folder.png')?>'>
				</a>

				<br />
				<span style="font-size:9px; font-weight:bold;height:20px; background:#f3f3f3; color:#06F; display:block;"><?php echo substr($nome_itens,0,20) ?></span>
			</div>
<?php
		}
	}
}

// pega o endereço do diretório
$diretorio = $_GET['pasta']; 
// abre o diretório
$ponteiro  = opendir($diretorio);
//Listando as imagens
//Lista as imagens

while ($nome_itens = readdir($ponteiro)) {
	if($nome_itens!=".."&&$nome_itens!="."&&$nome_itens!=" "){	
		if(is_file($_GET['pasta']."/".$nome_itens)){
?>
			<div title="<?php echo $nome_itens;?>" style="border-bottom:1px solid #f3f3f3; width:85px;height:105px; border:1px solid #ccc; text-align:center; margin:5px; float:left; position:relative;">
				<a style="color:#f00; font-size:11px; text-decoration:none; position:absolute;top:0px; right:2px;"
				onclick="return confirm('Deseja realmente excluir está imagem?\n\n Ela pode está sendo usada.')"
				href="?pasta=<?php echo $_GET['pasta']?>&apaga=<?php echo $_GET['pasta']."/".$nome_itens?>">Excluir</a>
			<br />
			<?php if(strpos($nome_itens,'.png')||strpos($nome_itens,'.jpeg')||strpos($nome_itens,'.jpg')||strpos($nome_itens,'.JPG')||strpos($nome_itens,'.gif')){?>
			<a href="javascript: envia_imagem('<?php echo $_GET['pasta']."/".$nome_itens?>','img')" class="texto_pagina">
			<img style="height:63px; width:65px" src='<?php echo image_url($_GET['pasta']."/".$nome_itens,'63x65') ?>'>
			</a>
			<?php }else if(strpos($nome_itens,'.zip')|| strpos($nome_itens,'.rar')){?>
			<a href="javascript: envia_imagem('<?php echo $_GET['pasta']."/".$nome_itens?>','rar-icon.png')" class="texto_pagina">
			<img  style="height:63px; width:65px" src='<?php echo base_url()?>arquivoadmin/imagem/rar-icon.png'>
			</a>
			<?php }else if(strpos($nome_itens,'.pdf')){?>
			<a href="javascript: envia_imagem('<?php echo $_GET['pasta']."/".$nome_itens?>','pdf-icon.png')" class="texto_pagina">
			<img  style="height:63px; width:65px" src='<?php echo base_url()?>arquivoadmin/imagem/pdf-icon.png'>
			</a>
			<?php }else if(strpos($nome_itens,'.doc')||strpos($nome_itens,'.docx')){?>
			<a href="javascript: envia_imagem('<?php echo $_GET['pasta']."/".$nome_itens?>','word-icon.png')" class="texto_pagina">
			<img  style="height:63px; width:65px" src='<?php echo base_url()?>arquivoadmin/imagem/word-icon.png'>
			</a>

			<?php }else if(strpos($nome_itens,'.xls')||strpos($nome_itens,'.xlsx')){?>
			<a href="javascript: envia_imagem('<?php echo $_GET['pasta']."/".$nome_itens?>','excel-icon.png')" class="texto_pagina">
			<img  style="height:63px; width:65px" src='<?php echo base_url()?>arquivoadmin/imagem/excel-icon.png'>
			</a>
			<?php }else{?>
			<a href="javascript: envia_imagem('<?php echo $_GET['pasta']."/".$nome_itens?>','outros-file.png')" class="texto_pagina">
			<img  style="height:63px; width:65px" src='<?php echo base_url()?>arquivoadmin/imagem/outros-file.png'>
			</a>
			<?php }?>


			<br />
			<span style="font-size:9px; font-weight:bold; background:#f3f3f3; height:23px; color:#06F; display:block;"><?php echo substr($nome_itens,0,15) ?></span>
			</div>
<?php
		}
	}
}

?>
<script type="text/javascript">
$(function(){
	$('#buttom-nova-pasta').click(function(){
		$("#new-folder").dialog({title:$(this).attr('title'),width:600,modal:true});
	});
	$('#buttom-send-imagem-gerenciador').click(function(){
		$("#send-imagem-gerenciador").dialog({title:$(this).attr('title'),width:600,modal:true});
	});		
});
</script>
</body>
</html>