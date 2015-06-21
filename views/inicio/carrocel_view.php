<?php $portifolio = $this->db
->order_by('ordem','DESC')
->get('portifolio')->result(); ?>
<script type="text/javascript" src="<?php echo base_url()?>public/util/script/jcarousellite_1.0.1.js"></script>

<script type="text/javascript">

$(function(){

$(".car_move").jCarouselLite({

    btnNext: ".prev-box",
    btnPrev: ".next-box",
    speed:1000,
	auto: 12000,
	vertical:false,
	visible:<?php echo count($portifolio) < 5 ? count($portifolio) : 5;  ?>
});
});

</script>

<img class="next-box" src="<?php echo base_url(); ?>public/imagem/layout/pre-box.fw.png" />
<div class="box-carrocel">
<div class="car_move">
<ul>

<?php

 foreach($portifolio as $ptf){
?>

<li style="width:180px; height:125px;">
   <img src="<?php echo image_url($ptf->imagem,'160x101')?>" alt="img" />
</li>

<?php }?>

</ul>

</div>
</div>

<img class="prev-box" src="<?php echo base_url(); ?>public/imagem/layout/next-box.fw.png" />
