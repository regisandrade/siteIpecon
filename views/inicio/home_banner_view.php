<?php
  $banner = $this->db
  				  ->order_by("id_banners","DESC")
  				  ->get("banners")->result();	  
?>

<!-- BEGIN BANNER -->
<!-- Banner de imagem -->
<div id="myCarousel" class="carousel slide">
	<div class="carousel-inner">
		<?php 
		$volta = 0;
		foreach($banner as $b){
		?>
			<div class="<?php echo ($volta == 0 ? 'active' : '') ?> item">
				<a href="<?php echo ($b->link ? base_url('index.php').'/'.$b->link : '#') ?>">
					<img style="width:100%" align="middle" height="483px" src='<?php echo image_url($b->imagem,'908x483')?>' />
				</a>
			</div>
		<?php 
			$volta++;
		}
		?>
	</div>

	<!-- Navegador do carousel -->
	<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>