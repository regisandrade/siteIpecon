<?php
class Depoimentos extends CI_Controller {

	public function index()
	{
		$data['pagina'] = 'depoimentos/depoimentos';

		$data['depoimentos'] = $this->db->select('aluno.Nome,depoimento.Depoimento,curso.Nome as Curso')
										->join('aluno','aluno.Id_Numero = depoimento.Aluno')
										->join('curso','curso.Codg_Curso = depoimento.Codg_Curso')
										->where('depoimento.STATUS',1)
										->order_by('depoimento.DATA DESC')
										->get('depoimento')->result();

		$this->load->view('inicio/inicio_view',$data);
	}

}
