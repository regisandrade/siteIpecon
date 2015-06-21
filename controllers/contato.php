<?php 

class Contato extends CI_Controller {


	public function index()
	{
		
	set_menu('contato');	
	 
	 $this->load->helper('my_email');
	
		if($this->input->post("nome")){
			$dados = array(
			"Nome"=>$_POST["nome"],
			"Email"=>$_POST["email"],
			"Telefone"=>$_POST["telefone"],
			"Assunto"=>$_POST["assunto"],
			"Mensagem"=>$_POST["mensagem"]
			);
			
		$config = $this->db->get('configuracao')->result();				
		
		if(email($config[0]->email,$config[0]->email,"Email do site - ".$dados['Nome'],$dados)){
			$data['msg'] = "Enviado com sucesso.";
			}else{
				$data['msg'] = "<label>Desculpe, Erro ao enviar seu email.</label>";
				}
		}
		
		
		
		$data['pagina'] = "contato/contato";
		$this->load->view('inicio/inicio_view',$data);
	}


	public function reserva()
	{
		
	 
	 $this->load->helper('my_email');
	
		if($this->input->post("nome")){
			$dados = array(
			"Nome"=>$_POST["nome"],
			"Cidade"=>$_POST["cidade"],
			"UF"=>$_POST["uf"],
			"Email"=>$_POST["email"],
			"Telefone"=>$_POST["fone"],
			"DataRetirada"=>$_POST["datai"],
			"DataEntrega"=>$_POST["datae"],
			"Categoria"=>$_POST["categoria"],
			"Obs. "=>$_POST["obs"]
			);
			
		$config = $this->db->get('configuracao')->result();				
		
		if(email($config[0]->email,$config[0]->email,"Email do site - ".$dados['Nome'],$dados)){
			$data['msg'] = "Enviado com sucesso.";
			}else{
				$data['msg'] = "<label>Desculpe, Erro ao enviar seu email.</label>";
				}
		}
		
		
		
		$data['pagina'] = "contato/reserva";
		$this->load->view('inicio/inicio_view',$data);
	}	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>