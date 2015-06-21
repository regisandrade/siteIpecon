<div id="pagina-interna">
    <div class="internaCtrl">
        <div class="titulo">Notícias</div>
        <div class="noticias-interna">
             <?php foreach($noticia as $n){ ?>
                <?php $link =  base_url('index.php/noticia/descricao_noticia/'.$n->id_noticia);?>
             <a class="boxNews" href="<?php echo $link ?>">
             <div class="titulo-noticia">
                  <?php echo $n->titulo?>
             </div>

             <?php
                  /*Formatação da data*/
                  $espaco =  explode(" ",$n->insert_data);
                  $data = explode("-",$espaco[0]);
             ?>
             <div class="dta"><?php echo $data[2]."/". $data[1]."/".$data[0];  ?></div>

             <div class="descricao">
                 <?php echo texto($n->texto,400,"....") ?><p id="noticia-mais">Saiba Mais..</p>
             </div>
             </a>
             <?php } ?>


        </div>
	</div>
</div>

<script>var url = '<?php echo base_url()?>'; </script>
<script type="text/javascript" src="<?php echo base_url()?>public/util/box/jquery.lightbox-0.5.js"></script>
<script type="text/javascript">
    $(function() {
        $('.box-expandir').lightBox();
    });
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/util/box/jquery.lightbox-0.5.css" media="screen" />