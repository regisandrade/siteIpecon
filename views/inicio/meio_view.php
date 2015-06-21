<?php
$noticias = $this->db->order_by("id_noticia","desc")
                 ->limit(4)
                 ->get('noticias')
                 ->result();
$cursos = $this->db
               ->where('Status','1')
               ->where('CurtaDuracao','N')
               ->order_by('Ordem','DESC')
               ->get('curso')
               ->result();
?>
<!-- conteudo -->
<div id="conteudo">

  <!-- banners -->
  <div id="banner">
    <div id="bg-banner-esquerda"></div>
    <div id="bg-banner-meio"><?php $this->load->view("inicio/home_banner_view"); ?></div>
    <div id="bg-banner-direita"></div>
  </div>
  <!-- /banners -->

  <!-- cursos -->
  <div id="cursos">
    <ul>
    <?php
    $volta = 0;
    $estilo = null;
    echo "<li style=\"left: 165px; top: 32px; color: red;\"><a href=\"".base_url()."cursos/getCurtaDuracao/\"><strong style=\"color: red;\">Cursos de Curta Duração<br>Clique e confira</strong></a></li>";
    foreach ($cursos as $curso) {
      switch ($volta) {
        case '0':
          $estilo = "left: 155px; top: 32px;";
          break;
        case '1':
          $estilo = "left: 120px; top: 32px;";
          break;
        case '2':
          $estilo = "left: 165px; top: 55px; width: 23.5%;";
          break;
        case '3':
          $estilo = "left: 235px; top: 55px;";
          break;
        case '4':
          $estilo = "left: 200px; top: 55px;";
          break;
        case '5':
          $estilo = "left: 165px; top: 115px; width: 23.5%;";
          break;
        case '6':
          $estilo = "left: 235px; top: 115px;";
          break;
      }
      echo "<li style=\"".$estilo."\"><a href=\"".base_url()."cursos/getCurso/".$curso->Codg_Curso."\">".str_replace(' de ', ' de <br>', str_replace(': ',': <br>',$curso->Nome))."</a></li>";
      /* if ($volta == 3) {
        echo "<li style=\"".$estilo."\"><a href=\"".base_url()."cursos/getCurso/".$curso->Codg_Curso."\">".str_replace(' de ', ' de <br>', $curso->Nome).'|'.$volta."</a></li>";
      }
      else {
        echo "<li style=\"".$estilo."\"><a href=\"".base_url()."cursos/getCurso/".$curso->Codg_Curso."\">".str_replace(' e ', ' e <br>', $curso->Nome).'|'.$volta."</a></li>";
      } */
      $volta++;
    }
    ?>
    </ul>
  </div>
  <!-- cursos -->

  <!-- login-noticias-facebook -->
  <div id="login-noticias-facebook">
    <div id="conteudo-login-noticias-facebook">
      <div id="conteudo-login">
        <h4>PORTAL DO ALUNO</h4>
        <!-- Formulario login -->
        <form id="form1" name="form1" method="post" action="<?php echo base_url('index.php')?>/alunos/entrar" class="form-horizontal">
          <div class="control-group">
            <div class="controls">
              <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
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
              <button type="submit" class="btn btn-large btn-block btn-warning">Efetuar Login</button>
              <a href="javascript:void(0)" onclick="">Esqueceu sua senha?</a>
            </div>
            <div class="controls">
            <?php
            if (isset($msgErro)) {
                 echo "<div class=\"alert alert-error fade in erroLogin \">
                 <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button>".$msgErro."</div>";
            }
            ?>
            </div>
          </div>
        </form>
        <!-- /Formulario login -->
      </div>
      <div id="conteudo-noticia">
        <span><img src="<?php echo base_url(); ?>public/imagem/layout/icon-noticias.png" />Notícias</span>
        <ul>
          <?php
          foreach ($noticias as $noticia) {
            echo '<li><a href="'.base_url().'noticias/verNoticia/'.$noticia->id_noticia.'">'.substr($noticia->titulo,0,91).'</a></li>';
          }
          ?>
        </ul>
      </div>
      <div id="conteudo-facebook">
        <div class="fb-like-box" data-href="https://www.facebook.com/ipeconposgraduacao" data-width="250" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
      </div>
    </div>
  </div>
  <!-- login-noticias-facebook -->
</div>
<!-- /conteudo -->
