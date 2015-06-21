<?php
class Alunos extends CI_Controller {

	public function index()
	{
		#code...
	}

	public function entrar(){
		$resultado = $this->db->select('usuario_aluno.Login
										,usuario_aluno.Id_Numero
										,usuario_aluno.Senha
										,aluno.Status
										,aluno.Nome
										,aluno.e_Mail
										,aluno.Ano')
                            ->join('aluno','aluno.Id_Numero = usuario_aluno.Id_Numero')
                            ->where('usuario_aluno.Login',trim($this->input->post('login')))
                            ->where('usuario_aluno.Senha',trim($this->input->post('senha')))
                            ->get('usuario_aluno')->row();;
        if ($resultado) {
        	# Criando variáveis de sessão        	
			$_SESSION['login'] = $resultado->Login;
			$_SESSION['psw'] = $resultado->Senha;
			$_SESSION['nome'] = $resultado->Nome;
			$_SESSION['id_numero'] = $resultado->Id_Numero;
			$_SESSION['eMail'] = $resultado->e_Mail;
			$_SESSION['ano'] = $resultado->Ano;
        	
        	redirect(base_url().'aluno/selecionarCurso.php');
        }else{
        	$data['msgErro'] = "<strong>Atenção!!</strong><br>Login ou Senha não cadastrada.";
        	$this->load->view('inicio/inicio_view',$data);
        }
        
        
     }
}