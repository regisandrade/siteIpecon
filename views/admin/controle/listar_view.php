<div class="buttons">

<b>

<?php if($info['anexada']!=''){?>
<a style="border:none; background:none; font-size:17px; color:#09C; padding:0;" href="<?php echo base_admin('modulos/'.$info['anexada'])?>"><?php echo isset($this->config->config['modulos'][$info['anexada']])?$this->config->config['modulos'][$info['anexada']]:$info['anexada']?></a>
 >>
<?php }?>

<?php echo isset($this->config->config['modulos'][$info['modulo']])?$this->config->config['modulos'][$info['modulo']]:$info['modulo']?></b>

<?php if(permissao($info['modulo'],'adicionar')){?>
 <a class="btn btn-primary" href="<?php echo base_admin('controle/add')?>"><i class="icon-plus-sign icon-white"></i> Adicionar</a>
<?php }?>
<?php if(permissao($info['modulo'],'editar')){?>
 <a class="btn btn-primary" id="edit-button" href="javascript:void(0)"><i class="icon-pencil icon-white"></i> Editar</a>
<?php }?>
<?php if(permissao($info['modulo'],'remover')){?>
  <a class="btn btn btn-danger" id="remove-button" href="javascript:void(0)"><i class="icon-remove-circle icon-white"></i> Remover</a>
<?php }?>

</div>



<form id="form1" name="form1" method="post" action="<?php echo base_admin('controle/config_filtro')?>">

<table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
  <thead>
  <tr class="title">
  <td width="30px" valign="top">Nº
  <?php if($info['filtro']){?>
  <input type="text" style="width:28px" name="pk__<?php echo $info['pk']?>" />
  <?php }?>
  </td>
  <?php
  //Cabeçalho
  foreach($info['fields'] as $field => $f){
	if($f['type']=='varchar'||$f['type']=='img'||$f['type']=='fk'||$f['type']=='date'||($f['type']=='text'&&!isset($f['ckeditor']))){
  ?>
    <td valign="top" <?php echo $f['type']=='date'?'width="100px"':''?>><?php echo $f['label']?>

    <?php if($f['type']=='varchar'){?>
    <?php if($info['filtro']){?>
    <input type="text" style="width:95%" name="varchar__<?php echo $field?>" />
    <?php }?>
    <?php }?>

    <?php if($f['type']=='fk'){?>
    <?php if($info['filtro']){?>
    <br />
     <select style="width:200px; padding:3px;" name="fk__<?php echo $field?>">
      <option value="0">--Selecione--</option>
      <?php
	  $table_fks = $this->db->get($f['table_fk'])->result_array();
	  foreach($table_fks as $fk){
	  ?>
      <option value="<?php echo $fk[$f['fk_id']]?>"><?php echo $fk[$f['fk_text']]?></option>
      <?php }?>
    </select>
    <?php }?>
    <?php }?>


    </td>
  <?php }}?>

  <?php foreach($info['extensao'] as $extensao => $name_extensao){?>
  <td valign="top" width="<?php echo strlen($name_extensao)*10?>px"><?php echo $name_extensao?></td>
  <?php }?>

  <td width="120px" valign="top">Data atualização</td>
  <td width="80px" align="center" valign="top">Ordem
  <?php if($info['filtro']){?>
  <input class="button" type="submit" value="Filtrar" />
  <?php }?>
  </td>
  </tr>
  </thead>
  <tbody>
  <?php
  //dado do banco
  foreach($dados as $d){
  ?>
  <tr>
  <td><?php echo $d[$info['pk']]?></td>
  <?php

  //Cabeçalho
  foreach($info['fields'] as $field => $f){
	if($f['type']=='varchar'||$f['type']=='img'||$f['type']=='fk'||$f['type']=='date'||($f['type']=='text'&&!isset($f['ckeditor']))){
  ?>
    <td>
    <!-- Mostrando Valor Imagem -->
    <?php
	if($f['type']=='img'){

		if(strpos($d[$field],'.png')||strpos($d[$field],'.jpg')||strpos($d[$field],'.JPG')||strpos($d[$field],'.jpeg')||strpos($d[$field],'.gif')){
			if(@image_url($d[$field],'100x60')){
				echo '<img src=\''.(image_url($d[$field],'100x60')).'\' />';
				}
		 }else{
			   echo str_ireplace('public/imagem/gerenciador/','',$d[$field]);
			 }
		}

	if($f['type']=='fk'){
		$fk_table = $this->db->where($f['fk_id'],$d[$field])->get($f['table_fk'])->result_array();
		if(isset($fk_table[0])){
			echo $fk_table[0][$f['fk_text']];
			}else{
				echo "-";
				}
		}

	if($f['type']=='varchar'){
		echo $d[$field];
		}

	if($f['type']=='date'){
		echo date('d/m/Y',strtotime($d[$field]));
		}

	if($f['type']=='text'){
		echo texto($d[$field],100);
		}

	?>
    </td>
  <?php }}?>

  <?php foreach($info['extensao'] as $extensao => $name_extensao){?>
  <td><a class="btn btn-primary" href="<?php echo base_admin('modulos/'.$extensao.'/?pai='.$d[$info['pk']])?>"><?php echo $name_extensao?></a></td>
  <?php }?>

  <td align="center" style="font-size:12px;"><?php echo date('d/m/Y H:i:s',strtotime($d['update_data']))?></td>
  <td align="center">
  <div>
  <a href="<?php echo base_admin('controle/ordem/'.$d[$info['pk']].'/?direcao='.($d['ordem']+1))?>"><img src="<?php echo base_url()?>arquivoadmin/imagem/icon/subir.png" /></a>
  <?php echo $d['ordem']?> <a href="<?php echo base_admin('controle/ordem/'.$d[$info['pk']].'/?direcao='.($d['ordem']-1))?>"><img src="<?php echo base_url()?>arquivoadmin/imagem/icon/descer.png" /></a>
  </div>
  <input type="hidden" name="pk" value="<?php echo $d[$info['pk']]?>" />
  </td>
  </tr>

  <?php }?>
 </tbody>
</table>

</form>

<?php echo $links?>

<script>
$(function(){
	$(".table tbody tr").click(function(){

		$pk = $(this).find("input[name='pk']").val();

		$("#edit-button").attr('href','<?php echo base_admin('controle/editar/')?>/'+$pk);
		$("#remove-button").attr('href','<?php echo base_admin('controle/excluir/')?>/'+$pk);

		$(".table tbody tr").removeClass('marcada');
		$(this).addClass('marcada');
		});
	});
</script>
