<?php 
class Fotos extends CI_Controller {

	public function index()
	{
		$data['pagina'] = 'fotos/fotos';
		$data['galerias'] = $this->db->get('galerias')->result();
		$this->load->view('inicio/inicio_view',$data);
	}

	public function verGaleria()
	{
		$data['pagina'] = 'fotos/ver_galeria';

		$data['tituloGaleria'] = $this->db
								 ->where('id_galeria',$this->uri->segment(3))
								 ->get('galerias')->row();

		$data['fotosGaleria'] = $this->db
									 ->where('id_pai',$this->uri->segment(3))
									 ->get('fotos')->result();

		$this->load->view('inicio/inicio_view',$data);
	}

}