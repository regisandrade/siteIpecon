<?php
class Empresa extends CI_Controller {

	public function index()
	{
		$data['pagina'] = 'empresa/empresa';

		$data['empresa'] = $this->db->get('empresa')->result();
		$this->load->view('inicio/inicio_view',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */