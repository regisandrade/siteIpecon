<!--<div class="content">
<div class="conteudo contato">-->
<div id="pagina-interna">
	<div class="internaCtrl">
        <div class="Titulo">Contato</div>


    <table width="800px" border="0" cellspacing="0" cellpadding="0" style="margin:60px 0 0 160px;">
      <tr>
        <td valign="top" width="50%">
    <?php
    if(isset($msg)){
    ?>
    <div class="msg"><?php echo $msg?></div>
    <?php
        }
    ?>

    <form action="" method="post" >


    <style>
    .t-field td{padding-right:5px;}
    .contato input[type="text"], .contato textarea {width: 340px}
    .contato textarea{width:500px;}
    </style>



    <table class="t-field" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:30px">
      <tr>
        <td><input value="Nome" onfocus="if(this.value=='Nome'){this.value=''}" onblur="if(this.value==''){this.value='Nome'}"  name="nome" id="nome" type="text" /></td>
        <td><input name="email" value="E-mail" onfocus="if(this.value=='E-mail'){this.value=''}" onblur="if(this.value==''){this.value='E-mail'}" id="nome" type="text" class="ob" /></td>
      </tr>
      <tr>
        <td><input value="Telefone" onfocus="if(this.value=='Telefone'){this.value=''}" onblur="if(this.value==''){this.value='Telefone'}" name="telefone" id="nome" type="text" /></td>
        <td><input value="Assunto" onfocus="if(this.value=='Assunto'){this.value=''}" onblur="if(this.value==''){this.value='Assunto'}" name="assunto" id="nome" type="text" class="ob" /></td>
      </tr>
    </table>



    <textarea onfocus="if(this.value=='Mensagem'){this.value=''}" onblur="if(this.value==''){this.value='Mensagem'}" name="mensagem" id="mensagem"  cols="52" rows="10" class="ob" >Mensagem</textarea><br />
    <input name="" id="limpar" value="Enviar" type="submit" />
    </form>

    </td>
    <td valign="top" style="padding-left:20px;">

   <div class="contacts">
   <strong>Contatos:</strong><br />
      <?php echo "E-mail :". $config->email  . "<br>"  ?>
   </div>

   <div>
    <strong>Facebook:</strong><br />
    <a href="<?php echo $config->facebook ?>" target="_blank"><?php echo $config->facebook?></a>
   </div>

   <div>
    <strong>Instagram:</strong><br />
    <a href="<?php echo $config->instagram ?>" target="_blank"><?php echo $config->instagram?></a>
   </div>

    </td>
  </tr>
</table>

<!-- </div>
</div>-->
</div>
</div>