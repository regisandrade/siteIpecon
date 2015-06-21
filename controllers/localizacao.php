<?php

class Localizacao extends CI_Controller {

	public function index()
	{
		$data['pagina'] = 'localizacao/localizacao';

		$this->load->view('inicio/inicio_view',$data);
	}

}