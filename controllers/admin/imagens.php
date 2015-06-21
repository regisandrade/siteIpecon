<?php 
class Imagens extends CI_Controller{
	
	function gerenciador(){
		view_admin("imagens/gerenciador_view");
	}

	function set_ckeditor(){
		$_SESSION['ckeditor'] = true;
		redirect(base_admin('imagens/gerenciador/'));
	}

	function configura(){

		$_SESSION['ckeditor'] = false;

		if(isset($_GET['tam'])&&$_GET['tam']!=""){
			list($x,$y) = explode('x',$_GET['tam']);  
			$_SESSION['x'] =$x;
			$_SESSION['y'] = $y;
		}else{
			$_SESSION['x'] ='';
			$_SESSION['y'] = '';
		}
		redirect(base_admin('imagens/gerenciador/'));		
	}

	
	function upload(){
		if(isset($_SESSION['x'])&&isset($_SESSION['y'])&&$_SESSION['x']!='' && $_SESSION['y']!=''){
			$data['largura']= $_SESSION['x'];
			$data['altura'] = $_SESSION['y'];
		}

		$path = $_GET['pasta']."/";

		if(isset($_POST['atualizar'])){
			
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'gif|jpg|JPG|jpeg|JPEG|png';
			$config['overwrite'] = FALSE;
			$config['file_name'] = url_title(str_ireplace(array('png','jpg','jpeg','gif'),array('','',''),$_FILES['Filedata']['name']));

			$this->load->library("upload",$config);

			if(!file_exists($path)){
				mkdir($path);
			}

			if($this->upload->do_upload('Filedata')){
				$imagem = $this->upload->data();


				if($imagem['file_ext']=='.jpeg'||$imagem['file_ext']=='.jpg'||$imagem['file_ext']=='.png'||$imagem['file_ext']=='.gif'){
					//Chamo a biblioteca canvas
					$this->load->library("Canvas");
					$this->canvas->carrega($path.$imagem['file_name'])
						 ->hexa("#111111");
				}

				if(isset($_SESSION['x'])&&isset($_SESSION['y'])&&$_SESSION['x']!='' && $_SESSION['y']!=''){
					$this->canvas->redimensiona( $data['largura'], $data['altura'],"preenchimento");
				}

				$this->canvas->grava($path.$imagem['file_name'],100);

				redirect(base_admin('imagens/gerenciador/?pasta='.$_GET['pasta']));
			}else{
				redirect(base_admin('imagens/gerenciador/?pasta='.$_GET['pasta'])); 
			}

		}

	}
/*
| -------------------------------------------------------------------------
| FIM DO CONTROLLER
| -------------------------------------------------------------------------
*/	
}
?>