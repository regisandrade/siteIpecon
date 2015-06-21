<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Objeto Comunicação e Tecnologia
 * @since		Version 1.0
 */
 
	function image_url($url,$_tamanho){ 
		if(!file_exists($url)){
			return "arquivo não existe";
		}
		// Verifica se existe a pasta cache se não existir a mesma é criada  
		if(!file_exists("cache/")){
			mkdir("cache/");
		}
			
		list($x,$y) = @explode('x',$_tamanho); 
		
		$info_imagem = @getimagesize($url);
		$x_original = $info_imagem[0];
		$y_original = $info_imagem[1];
		
		$info_img = @explode('.',$url);
		$info_img = array_reverse($info_img);
		$extensao = isset($info_img[0])?".".$info_img[0]:'.jpg';
		$path = "cache/".(str_ireplace('public/imagem/gerenciador/','',rtrim(dirname($url),'/')."/"));

		$nome_cache = str_ireplace($extensao,'',basename($url))."-".$_tamanho.$extensao;
		$nome_cache_completo = $path.$nome_cache;
		
		#se o diretorio for maior ele cria
	    if(!file_exists($path)){
			if(strpos("pasta".$path,'/')){
			$mpastas = @explode('/',$path);
			$di_atual = "";
			foreach($mpastas as $pa){
				$di_atual .= $pa."/";
				@mkdir($di_atual);
				}
			}
		}
		
		$CI =& get_instance();
		$CI->load->library("canvas"); 
		
		#verifica se a imagem já existe 
		if(file_exists($nome_cache_completo)){
			return base_url($nome_cache_completo); 
		}else{
		
			#verifica se dar para redimensionar e cortar a imagem
			if($x_original>=$x&&$y_original>=$y){
			
				#Calcula a nova largura com uma altura proporcional
				$novo_x = (100*$x)/$x_original;
				$novo_x = ($x_original*$novo_x)/100;
				$novo_y = $novo_x*$y_original/$x_original;

				#verifica se a altura preenche o espaco da nova imagem
				if($novo_y < $y){
					$novo_y = (100*$y)/$y_original;
					$novo_y = ($y_original*$novo_y)/100;
					$novo_x = $novo_y*$x_original/$y_original;
				}

				$novo_x = (int)($novo_x);
				$novo_y = (int)($novo_y);


				#agora CROP
				$CI->canvas->carrega($url)
							->redimensiona($novo_x,$novo_y)
							->grava($nome_cache_completo,100);

				$CI->canvas->carrega($nome_cache_completo)
							->posicaoCrop('meio','meio')
							->redimensiona($x,$y,"crop")
							->grava($nome_cache_completo,100);

				return base_url($nome_cache_completo);
			}		
		        
			$CI->canvas->carrega($url);
			$CI->canvas->redimensiona($x,$y,"preenchimento");
			$CI->canvas->hexa("#512824");
			$CI->canvas->grava($nome_cache_completo,100);  
		}
	    
		return base_url($nome_cache_completo);
 
	}
 
?>