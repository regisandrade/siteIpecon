<?php
class Artigos extends CI_Controller {

	public function index()
	{
		$data['pagina'] = 'artigos/artigos';

		$data['artigos'] = $this->db->get('artigo')->result();

		$this->load->view('inicio/inicio_view',$data);
	}
}