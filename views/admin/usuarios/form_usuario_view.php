<?php
echo isset($error)?"<br><div class=\"alert alert-success\"><button class=\"close\" data-dismiss=\"alert\" type=\"button\"></button>{$error}</div>":"";
?>
<form name="form1" id="validar_formulario" method="post" action="">
<input name="us_id" type="hidden" value="<?php echo $this->uri->segment(4)?>">

<div class="buttons">
  <b><?php echo ($this->uri->segment(4) ? 'Alterar' : 'Adicionar') ?> Usuário</b>
  <button onclick="aplicar()" class="btn btn-primary" type="button"><i class="icon-check icon-white"></i> Aplicar</button>
  <button class="btn btn-primary" type="submit"><i class="icon-check icon-white"></i> Salvar</button>
  <a class="btn" href="<?php echo base_admin('usuarios/listar_usuarios')?>"><i class="icon-remove-circle"></i> Fechar</a>
</div>

<div class="content">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td width="20%">Nome:</td>
      <td width="80%"><input type="text" name="us_nome" class="input-xxlarge validate[required]" value="<?php echo $dados['us_nome']?>" maxlength="200"></td>
    </tr>
    <tr>
      <td>Cidade:</td>
      <td><input type="text" name="us_cidade" class="input-xlarge" value="<?php echo $dados['us_cidade']?>" maxlength="200"></td>
    </tr>
    <tr>
      <td>Estado:</td>
      <td><select name="estado" class="input-large">
            <option selected="" value="">UF</option>
            <option value="AC" <?php echo ($dados['us_estado'] == 'AC' ? 'selected="true"' : '') ?>>Acre</option>
            <option value="AL" <?php echo ($dados['us_estado'] == 'AL' ? 'selected="true"' : '') ?>>Alagoas</option>
            <option value="AP" <?php echo ($dados['us_estado'] == 'AP' ? 'selected="true"' : '') ?>>Amapá</option>
            <option value="AM" <?php echo ($dados['us_estado'] == 'AM' ? 'selected="true"' : '') ?>>Amazonas</option>
            <option value="BA" <?php echo ($dados['us_estado'] == 'BA' ? 'selected="true"' : '') ?>>Bahia</option>
            <option value="CE" <?php echo ($dados['us_estado'] == 'CE' ? 'selected="true"' : '') ?>>Ceará</option>
            <option value="DF" <?php echo ($dados['us_estado'] == 'DF' ? 'selected="true"' : '') ?>>Distrito Federal</option>
            <option value="ES" <?php echo ($dados['us_estado'] == 'ES' ? 'selected="true"' : '') ?>>Espírito Santo</option>
            <option value="GO" <?php echo ($dados['us_estado'] == 'GO' ? 'selected="true"' : '') ?>>Goiás</option>
            <option value="MA" <?php echo ($dados['us_estado'] == 'MA' ? 'selected="true"' : '') ?>>Maranhão</option>
            <option value="MT" <?php echo ($dados['us_estado'] == 'MT' ? 'selected="true"' : '') ?>>Mato Grosso</option>
            <option value="MS" <?php echo ($dados['us_estado'] == 'MS' ? 'selected="true"' : '') ?>>Mato Grosso do Sul</option>
            <option value="MG" <?php echo ($dados['us_estado'] == 'MG' ? 'selected="true"' : '') ?>>Minas Gerais</option>
            <option value="PA" <?php echo ($dados['us_estado'] == 'PA' ? 'selected="true"' : '') ?>>Pará</option>
            <option value="PB" <?php echo ($dados['us_estado'] == 'PB' ? 'selected="true"' : '') ?>>Paraíba</option>
            <option value="PR" <?php echo ($dados['us_estado'] == 'PR' ? 'selected="true"' : '') ?>>Paraná</option>
            <option value="PE" <?php echo ($dados['us_estado'] == 'PE' ? 'selected="true"' : '') ?>>Pernambuco</option>
            <option value="PI" <?php echo ($dados['us_estado'] == 'PI' ? 'selected="true"' : '') ?>>Piauí</option>
            <option value="RJ" <?php echo ($dados['us_estado'] == 'RJ' ? 'selected="true"' : '') ?>>Rio de Janeiro</option>
            <option value="RS" <?php echo ($dados['us_estado'] == 'RS' ? 'selected="true"' : '') ?>>Rio Grande do Sul</option>
            <option value="RN" <?php echo ($dados['us_estado'] == 'RN' ? 'selected="true"' : '') ?>>Rio Grande do Norte</option>
            <option value="RO" <?php echo ($dados['us_estado'] == 'RO' ? 'selected="true"' : '') ?> <?php echo ($dados['us_estado'] == 'AC' ? 'selected="true"' : '') ?>>Rondônia</option>
            <option value="RR" <?php echo ($dados['us_estado'] == 'RR' ? 'selected="true"' : '') ?>>Roraima</option>
            <option value="SE" <?php echo ($dados['us_estado'] == 'SE' ? 'selected="true"' : '') ?>>Santa Catarina</option>
            <option value="SP" <?php echo ($dados['us_estado'] == 'SP' ? 'selected="true"' : '') ?>>São Paulo</option>
            <option value="SE" <?php echo ($dados['us_estado'] == 'SE' ? 'selected="true"' : '') ?>>Sergipe</option>
            <option value="TO" <?php echo ($dados['us_estado'] == 'TO' ? 'selected="true"' : '') ?>>Tocantins</option>
          </select>
        </td>
    </tr>
    <tr>
      <td>Telefone:</td>
      <td><input type="text" name="us_telefone" class="input-medium" value="<?php echo $dados['us_telefone']?>" maxlength="14"></td>
    </tr>
    <tr>
      <td colspan="2"><strong>Dados para acessar o painel</strong></td>
    </tr>
    <tr>
      <td>E-mail:</td>
      <td><input type="text" name="us_email" value="<?php echo $dados['us_email']?>" class="input-xxlarge validate[required,custom[email]]" maxlength="200"></td>
    </tr>
    <tr>
      <td>Senha do usuário:</td>
      <td><input type="password" id="id_senha" name="senha" class="input-medium" <?php if($dados['us_id']==0){?>class="validate[required]"<?php }?> maxlength="200"></td>
    </tr>
    <tr>
      <td>Repetir senha do usuário:</td>
      <td><input type="password" name="senha2" class="input-medium" <?php if($dados['us_id']==0){?>class="validate[required,equals[id_senha]]"<?php }?> maxlength="200"></td>
    </tr>
    <script type="text/javascript">
      $(function(){
        $("#us_tipo").val(<?php echo $dados['us_tipo']?>);
      });
    </script>
    <?php if(get_user()->us_tipo==1){?>
    <tr>
      <td>Função do usuário:</td>
      <td><select class="input-large validate[required]" id="us_tipo" name="us_tipo">
            <option value="">Selecione</option>
            <option value="1">Administrador</option>
            <option value="2">Administrador de conteúdo</option>
          </select>
      </td>
    </tr>
    <?php }?>
    <script type="text/javascript">
      $(function(){
        $("#us_ativo").val(<?php echo $dados['us_ativo']?>);
      });
    </script>
    <tr>
      <td>Usuário pode logar no sistema?</td>
      <td><select class="input-large validate[required]" id="us_ativo" name="us_ativo">
            <option value="1">Sim</option>
            <option value="0">Não</option>
          </select>
      </td>
    </tr>
    <?php if(get_user()->us_tipo==1){?>
    <tr>
      <td>Permissão do usuário:</td>
      <td>
        <?php
        $permissao = json_decode($dados['us_permissao']);
        foreach($this->config->config['modulos'] as $modulo=> $descricao){
        ?>
          <strong class="nomePermissao"><?php echo $descricao?>: </strong>
          <input type="checkbox" name="us_permissao[<?php echo $modulo?>][adicionar]" <?php echo isset($permissao->{$modulo}->adicionar)?'checked':''?> value="1" /> Adicionar&nbsp;&nbsp;&nbsp;
          <input type="checkbox" name="us_permissao[<?php echo $modulo?>][editar]" <?php echo isset($permissao->{$modulo}->editar)?'checked':''?> value="1" /> Editar&nbsp;&nbsp;&nbsp;
          <input type="checkbox" name="us_permissao[<?php echo $modulo?>][remover]" <?php echo isset($permissao->{$modulo}->remover)?'checked':''?> value="1" /> Excluir<br>
        <?php }?>
      </td>
    </tr>
    <?php }?>
    <tr>
      <td>&nbsp;</td>
      <td><br>
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
    alerte('aqui');
    $("#validar_formulario").attr('action','<?php echo base_admin("usuarios/form_usuario/{$this->uri->segment(4)}".'?aplicar=sim')?>');
    $("#validar_formulario").submit();
  }
</script>