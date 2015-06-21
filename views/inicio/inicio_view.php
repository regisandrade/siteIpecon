<?php
$this->load->library('session');

$config = $this->db->get('configuracao')->result();
$config = isset($config[0])?$config[0]:0;

define("EMPRESA", $config->empresa);
define("EMAIL", $config->email);
define("FACEBOOK", $config->facebook);
define("TWITTER", $config->twitter);
define("LINKEDIN", $config->linkedin);
define("ENDERECO", $config->endereco);
define("TELEFONE_1", $config->telefone_1);
define("TELEFONE_2", $config->telefone_2);
define("LATITUDE", $config->latitude_endereco);
define("LONGITUDE", $config->longitude_endereco);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title><?php echo EMPRESA ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Régis Andrade - regisandrade@gmail.com" />
  <meta name="description" content="<?php  echo isset($metadescricao)?$metadescricao:$config->descricao?>">
  <meta name="robots" content="index, follow" />
  <meta property="og:title" content="<?php  echo isset($title)?$config->empresa.' - '.$title:$config->empresa.' - '.$config->slogan?>" />
  <meta property="og:image" content="<?php echo base_url()?>public/imagem/layout/logotipo.jpg" />
  <meta property="og:description" content="<?php  echo isset($metadescricao)?$metadescricao:$config->descricao?>" />

  <link rel="stylesheet" href="<?php echo base_url();?>public/util/bootstrap/css/bootstrap.css"/>
  <!--<link rel="stylesheet" href="<?php echo base_url();?>public/util/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">-->

  <link rel="stylesheet" href="<?php echo base_url();?>public/css/generico.css?<?php echo rand(1,1000); ?>"/>
  
  <link href="<?php echo base_url()?>public/css/dialog.css" rel="stylesheet" type="text/css" />
  
  <!--
  <link href="<?php echo base_url()?>public/imagem/layout/faf.png" rel="icon" />
  <link  rel="shortcut icon" href="<?php echo base_url();?>public/imagem/layout/fivecon.png" />-->

  <script src="<?php echo base_url()?>public/script/jquery-1.11.0.min.js" ></script>
  <script src="<?php echo base_url()?>public/script/jquery.validate.min.js"></script>
  <script src="<?php echo base_url()?>public/script/regras.validate.js"></script>
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

  <script src="<?php echo base_url()?>public/script/generica.js?<?php echo rand(1,100); ?>" ></script>

</head>
<body>
  <script>
   (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
   })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-157037-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

  </script>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
  
  <?php $conteudo = $this->uri->segment(1) ? 'conteudo140' : 'conteudo';?>

  <div id="tudo">
    <div id="<?php echo $conteudo ?>">
      <div id="topo">
        <?php $this->load->view('inicio/topo_view'); # Topo?>
      </div>
      <div id="principal">
      <?php 
        // Meio
        if(isset($pagina)){
          $this->load->view("{$pagina}_view");
        }else{
          $this->load->view("inicio/meio_view");
        }
      ?>
      </div> <!-- Fim da div#principal -->

      <div class="clear"></div>
    </div> <!-- Fim da div#conteudo -->
    <div id="rodape">
      <?php $this->load->view('inicio/rodape_view'); # Rodape?>
    </div>
  </div> <!-- Fim da div#tudo -->
  <!-- lightBox 2 javascript
  ================================================== -->
  <link href="<?php echo base_url()?>public/util/box/css/lightbox.css" rel="stylesheet" />
  <script type="text/javascript" src="<?php echo base_url()?>public/util/box/lightbox-2.6.min.js"></script>

  <!-- Le javascript
  ================================================== -->
  <script src="<?php echo base_url();?>public/util/bootstrap/js/bootstrap-alert.js"></script>
  <script src="<?php echo base_url();?>public/util/bootstrap/js/bootstrap-modal.js"></script>
  <script src="<?php echo base_url();?>public/util/bootstrap/js/bootstrap-transition.js"></script>
  <script src="<?php echo base_url();?>public/util/bootstrap/js/bootstrap-scrollspy.js"></script>
  <script src="<?php echo base_url();?>public/util/bootstrap/js/bootstrap-carousel.js"></script>

</body>
</html>
