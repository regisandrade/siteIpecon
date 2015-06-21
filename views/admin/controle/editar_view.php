<?php
if(!permissao($info['modulo'],'editar')){
	echo "Você não tem permissão para editar ".$info['modulo'];exit;
	}
?>

<?php
$dados = $this->db->where($info['pk'],$this->uri->segment(4))->get($info['table'])->result_array();
$dados = $dados[0];
?>

<form name="form1" id="validar_formulario" method="post" action="<?php echo base_admin("controle/salvar_update/".$this->uri->segment(4))?>">

<div class="buttons">

<b>Editar: <?php echo $info['modulo']?></b>

    <button onclick="aplicar()" class="btn btn-primary" type="button"><i class="icon-check icon-white"></i> Aplicar</button>
    <button class="btn btn-primary" type="submit"><i class="icon-check icon-white"></i> Salvar</button>
    <a class="btn" href="<?php echo base_admin('controle/listar')?>"><i class="icon-remove-circle"></i> Fechar</a>
</div>

<div class="content">
<table width="100%" border="0" cellspacing="0" cellpadding="4">

   <tr>
    <td width="150px" align="right"><strong>Ordem: </strong></td>
    <td><input type="text"  value="<?php echo $dados['ordem']?>" style="width:50px" name="ordem" /></td>
  </tr>

  <?php foreach($info['fields'] as $field => $f){?>


    <?php if($f['type']=='fk'){?>
    <tr>
      <td align="right"><strong><?php echo $f['label']?>:</strong></td>
      <td>
      <select <?php if(isset($f['notnull'])){echo "class='validate[required]'";}?> name="<?php echo $field?>">
        <option value="<?php echo isset($f['notnull'])?'':'0';?>">--Selecione--</option>
        <?php
        if(isset($info['where_fk'])){
          $this->db->where($info['where_fk']);
        }
        if(isset($info['order_fk'])){
          $this->db->order_by($info['order_fk']);
        }
        $table_fks = $this->db->get($f['table_fk'])->result_array();
        foreach($table_fks as $fk){
        ?>
        <option <?php echo $dados[$field]==$fk[$f['fk_id']]?'selected':''?> value="<?php echo $fk[$f['fk_id']]?>"><?php echo $fk[$f['fk_text']]?></option>
        <?php }?>
      </select>
      </td>
    </tr>
    <?php }?>



     <?php if($f['type']=='date'){?>
    <tr>
      <td align="right"><strong><?php echo $f['label']?>:</strong></td>
      <td><input type="text" class="datepicker validate[required]" style="width:120px" name="<?php echo $field?>" value="<?php echo $dados[$field]?>" /></td>
    </tr>
    <?php }?>



    <?php
    if($f['type']=='img'){

  	  $nome_itens = $dados[$field];
  	  if(strpos($nome_itens,'.png')||strpos($nome_itens,'.jpeg')||strpos($nome_itens,'.JPG')||strpos($nome_itens,'.jpg')||strpos($nome_itens,'.gif')){
  	   $src = $dados[$field];
  	  }else if(strpos($nome_itens,'.zip') || strpos($nome_itens,'.rar')){
  		$src = 'arquivoadmin/imagem/rar-icon.png';
  	  }else if(strpos($nome_itens,'.pdf')){
  		$src = 'arquivoadmin/imagem/pdf-icon.png';
  	  }else if(strpos($nome_itens,'.doc')||strpos($nome_itens,'.docx')){
  	    $src = 'arquivoadmin/imagem/word-icon.png';
  	  }else if(strpos($nome_itens,'.xls')||strpos($nome_itens,'.xlsx')){
  		  $src = 'arquivoadmin/imagem/excel-icon.png';
  		  }else{

  			  }

  	  ?>
    <tr>
      <td><strong><?php echo $f['label']?>:</strong></td>
      <td>
      <div style="padding:10px; text-align:center; background:#f3f3f3; max-width:100px; border:1px solid #d9d9d9;">
      <input type="hidden" id="rece_imagem_<?php echo $field?>" value="<?php echo $dados[$field]?>" name="<?php echo $field?>"  />
      <a style="font-size:13px; text-decoration:none;" onclick="return abrir_gerenciador('#img_<?php echo $field?>','#rece_imagem_<?php echo $field?>')"  href="javascript:void(0)">
       <img id="img_<?php echo $field?>" style="max-width:70px; max-height:70px;"
       src="<?php echo base_url($src)?>" />
       </a>
       <br />
     <a style="font-size:13px;" onclick="return abrir_gerenciador('#img_<?php echo $field?>','#rece_imagem_<?php echo $field?>')"  href="javascript:void(0)">Enviar</a>
    </div>
      </td>
    </tr>
    <?php }?>


    <?php if($f['type']=='varchar'){?>
    <tr>
      <td align="right"><strong><?php echo $f['label']?>:</strong></td>
      <td><input type="text" <?php if(isset($f['notnull'])){echo "class='validate[required]'";}?>  value="<?php echo $dados[$field]?>"style="width:50%" maxlength="<?php echo $f['size']?>" name="<?php echo $field?>" /></td>
    </tr>
    <?php }?>


    <?php if($f['type']=='text'){?>
    <tr>
      <td align="right"><strong><?php echo $f['label']?>:</strong></td>
      <td><textarea <?php if(isset($f['notnull'])){echo "class='validate[required]'";}?> <?php echo isset($f['ckeditor'])?'class="texto"':''?> style="width:50%" name="<?php echo $field?>"><?php echo $dados[$field]?></textarea></td>
    </tr>
    <?php }?>

  <?php }?>

 <tr>
    <td align="right"></td>
    <td>
    <button onclick="aplicar()" class="btn btn-primary" type="button"><i class="icon-check icon-white"></i> Aplicar</button>
    <button class="btn btn-primary" type="submit"><i class="icon-check icon-white"></i> Salvar</button>
    <a class="btn" href="<?php echo base_admin('controle/listar')?>"><i class="icon-remove-circle"></i> Fechar</a>
      </td>
  </tr>

</table>

</div>

</form>
<script>
function aplicar(){
	$("#validar_formulario").attr('action','<?php echo base_admin("controle/salvar_update/".$this->uri->segment(4).'?aplicar=sim')?>');
	$("#validar_formulario").submit();
	}
</script>