<?php
class Usuarios extends CI_Controller{

	function __construct(){
		parent::__construct();
	}


	function email_exists($email){
		return $this->db->where("us_email",$email)->get("usuarios")->num_rows>=1?TRUE:FALSE;
	}


	function listar_usuarios(){
		$data['users'] = $this->db->get("usuarios")->result();
		$data['pagina'] = 'usuarios/listar_usuarios';
		view_admin("inicio_view",$data);
	}


	function form_usuario(){

		if(count($_POST)){
			$data['dados'] = valida_fields('usuarios',$_POST);
		}else{
			if($this->uri->segment(4)){
				$user_array = $this->db->where('us_id',$this->uri->segment(4))->get('usuarios')->result_array();
				$data['dados'] = $user_array[0];
			}else{
				$data['dados'] = array('us_id'=>0,'us_nome'=>'','us_estado'=>'','us_permissao'=>'','us_cidade'=>'','us_email'=>'','us_telefone'=>'','us_tipo'=>'','us_ativo'=>1);
			}
		}

		if(isset($_POST['us_nome']) && $_POST['us_email']!=""){
			$senha_descript = $_POST['senha'];
			if($_POST['senha']!=""){
				$_POST['us_pw'] = sha1($_POST['senha']);
			}
			//Editar ou Inserir
			if($_POST['us_id']==0){
				if(!$this->email_exists($_POST['us_email'])){
					$_POST['us_permissao'] = json_encode($_POST['us_permissao']);
					$this->db->insert('usuarios',valida_fields('usuarios',$_POST));
					$data['dados'] = array('us_id'=>'','us_nome'=>'','us_estado'=>'','us_cidade'=>'','us_email'=>'','us_telefone'=>'','us_tipo'=>'','us_ativo'=>1);
					$data['error'] = 'Cadastrado com sucesso!';
				}else{
					$data['error'] = 'E-mail já existe';
				}
			}else{
				//Alterar
				if(isset($_POST['us_permissao'])){
					$_POST['us_permissao'] = json_encode($_POST['us_permissao']);
				}
				$this->db->where('us_id',$this->uri->segment(4))->update('usuarios',valida_fields('usuarios',$_POST));
				$user_array = $this->db->where('us_id',$this->uri->segment(4))->get('usuarios')->result_array();
				$data['dados'] = $user_array[0];
				$data['error'] = 'Alterado com sucesso!';
			}
		}

		$data['pagina'] = 'usuarios/form_usuario';
		view_admin("inicio_view",$data);
	}




	function apagar_usuario(){
		$this->db->where('us_id',$this->uri->segment(4))->delete("usuarios");
		redirect(base_admin("usuarios/listar_usuarios"));
		}

	function deslogar_user(){
		$_SESSION['logadminxli'] = FALSE;
		redirect(base_admin(""));
		}


	public function login(){
		$this->load->library('form_validation');
	    view_admin("login_view");
		}

	public function entrar(){

			$this->load->library('form_validation');

			$this->form_validation->set_rules("login","Login","required");
			$this->form_validation->set_rules("senha","Senha","required|max_length[14]|min_length[4]");

			if($this->form_validation->run()){

				$login = $this->db
				              ->where("us_email",$this->input->post("login"))
							  ->where("us_pw",sha1($this->input->post("senha")))
							  ->get("usuarios")->result();

				if(count($login)){

					$_SESSION['logadminxli'] = $login[0];
					redirect(base_admin());
					}else{
						$data['error'] = "<p>Dados não encontrados.</p>";
						view_admin("usuarios/login_view",$data);
						}
				}else{
					view_admin("usuarios/login_view");
					}

		}

	}

?>