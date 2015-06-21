<!DOCTYPE HTML>
<html>
<head>
	<title>Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo base_url();?>public/util/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>public/css/loginAdmin.css"/>
</head>

<body>
	<div id="topo">
		<img src="<?php echo base_url()?>arquivoadmin/imagem/logo.png" />
	</div>
	<div id="error"><?php echo validation_errors(); if(isset($error)){echo $error;}?></div>

	<form id="form1" name="form1" method="post" action="" class="form-horizontal">
		<div class="control-group">
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					<input class="span2" name="login" id="inputIcon" type="text" placeholder="Seu e-Mail">
				</div>
			</div>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input class="span2" name="senha" id="inputIcon" type="password" placeholder="Sua senha">
				</div>
			</div>
			<div class="controls">
				<button type="submit" class="btn btn-large btn-primary">Entrar</button>
			</div>

		</div>
	</form>

</body>
</html>