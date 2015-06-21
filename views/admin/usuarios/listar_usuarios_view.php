<div class="buttons">
  <b>Usuários</b>
  <a class="btn btn-primary" href="<?php echo base_admin('usuarios/form_usuario')?>"><i class="icon-plus-sign icon-white"></i> Adicionar</a>
  <a class="btn btn-primary" id="edit-button" href="javascript:void(0)"><i class="icon-pencil icon-white"></i> Editar</a>
  <a class="btn btn btn-danger" id="remove-button" href="javascript:void(0)"><i class="icon-remove-circle icon-white"></i> Remover</a>
</div>

<table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
  <thead>
  <tr class="title">
    <td width="40%">Nome</td>
    <td width="25%">E-mail</td>
    <td width="15%">Telefone</td>
    <td width="20%">Função</td>
  </tr>
  </thead>
  <tbody>
  <?php foreach($users as $u){?>
  <tr>
    <td><?php echo $u->us_nome?></td>
    <td><?php echo $u->us_email?></td>
    <td><?php echo $u->us_telefone?></td>
    <td><?php echo tipo_usuario($u->us_tipo)?></td>
    <input type="hidden" name="pk" value="<?php echo $u->us_id?>" />
  </tr>
<?php }?>
  <tbody>
</table>
<script>
$(function(){
  $(".table tbody tr").click(function(){

    $pk = $(this).find("input[name='pk']").val();

    $("#edit-button").attr('href','<?php echo base_admin('usuarios/form_usuario/')?>/'+$pk);
    $("#remove-button").attr('href','<?php echo base_admin('usuarios/apagar_usuario/')?>/'+$pk);

    $(".table tbody tr").removeClass('marcada');
    $(this).addClass('marcada');
    });
  });
</script>