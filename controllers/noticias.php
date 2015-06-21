<?php
class Noticias extends CI_Controller {

	public function index()
	{
		$data['pagina'] = 'noticias/noticias';

		$data['noticias'] = $this->db->get('noticias')->result();
		$this->load->view('inicio/inicio_view',$data);
	}

	public function verNoticia()
	{
		$data['pagina'] = 'noticias/ver_noticia';

		$data['noticia'] = $this->db
		                        ->where('id_noticia',$this->uri->segment(3))
		                        ->get('noticias')->row();

		$this->load->view('inicio/inicio_view',$data);
	}

}