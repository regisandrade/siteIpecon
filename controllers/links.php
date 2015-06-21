<?php
class Links extends CI_Controller {

	public function index()
	{
		$data['pagina'] = 'links/links';

		$data['links'] = $this->db
							->order_by('Tipo')
							->get('links')->result();

		$this->load->view('inicio/inicio_view',$data);
	}

}