<?php
class Inicio extends CI_Controller {

	public function index()
	{
	    set_menu('home');
		$this->load->view('inicio/inicio_view');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */