<?php 
class Videos extends CI_Controller {

	public function index()
	{
		$data['pagina'] = 'videos/ver_videos';
		$this->load->view('inicio/inicio_view',$data);
	}
	
}