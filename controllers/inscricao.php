<?php
class Inscricao extends CI_Controller {

	public function preInscricao()
	{
		$data['pagina'] = 'inscricao/inscricao';

		$data['cursos'] = $this->db
								->where('Status',1)
								->order_by('Nome')
								->get('curso')->result();

		$this->load->view('inicio/inicio_view',$data);
	}

	public function gravarPreInscricao()
	{
		$this->load->helper('my_email');

		/*echo "<pre>";
		print_r($this->input->post());
		echo "</pre>";*/
		//die();
		$config = $this->db->get('configuracao')->row();

		$curso = $this->db
					  ->where('Codg_Curso',$this->input->post('codg_curso'))
					  ->where('Status',1)
					  ->get('curso')->row();
		
		$data['pagina'] = 'inscricao/inscricao';		

		# Limpar formatação de campos
		$idNumero = str_replace('-', '', str_replace('.', '', $this->input->post('cpf')));
		
		# Passos:
		# 1. Verificar se o aluno já esta cadastrado no curso pretendente e ano também, não deixar prosseguir
		#    com o cadastro
		$tabela = 'aluno';

		$aluno = $this->db->where('Id_Numero', $idNumero)
						  ->where('Ano', $this->input->post('ano'))
						  ->where('Curso', $this->input->post('codg_curso'))
						  ->count_all_results($tabela);

		if ($aluno > 0) {
			$erroInscricao = 1;
			redirect(base_url('index.php').'/inscricao/preInscricao/'.$this->input->post('codg_curso').'/'.$erroInscricao);
			exit();
		}

		# Gravar dados
		$dadosAluno = array(
			'Ano' => $this->input->post('ano') ,
			'Id_Numero' => $idNumero,
			'Nome' => $this->input->post('nome'),
			'Data_Nascimento' => dataUSA($this->input->post('data_nascimento')),
			'Naturalidade' => $this->input->post('naturalidade'),
			'UF_Naturalidade' => $this->input->post('uf_1'),
			'Nacionalidade' => $this->input->post('nacionalidade'),
			'Sexo' => $this->input->post('sexo'),
			'RG' => $this->input->post('rg'),
			'Orgao' => $this->input->post('orgao'),
			'CPF' => $idNumero,
			'e_Mail' => $this->input->post('email'),
			'Data_Cadastro' => date('Y-m-d H:i:s'),
			'Status' => 0,
			'Curso' => $this->input->post('codg_curso'),
			'cidadeCurso' => null,
			'Web' => 1,
			'Enviado' => 0,
			'tituloEleitoral' => null,
			'reservista' => null,
			'estadoCivil' => null,
			'filiacaoPai' => null,
			'filiacaoMae' => null,
			'situacao' => 1,
			'twitter' => null
		);
		$this->db->insert($tabela,$dadosAluno);

		
		# 2. Verificar se o aluno já tem cadastro de endereço, caso sim, atualizar os dados do endereço, senão
		#    cadastrar um novo endereço
		$tabela = 'endereco';

		$endereco = $this->db->where('Id_Numero', $idNumero)
							 ->count_all_results($tabela);
		
		if ($endereco > 0) {
			# Atualizar o endereço
			$dadosEndereco = array(
				'Endereco' => $this->input->post('endereco'),
				'Bairro' => $this->input->post('bairro'),
				'CEP' => $this->input->post('cep'),
				'Cidade' => $this->input->post('cidade'),
				'UF' => $this->input->post('uf_2'),
				'Fone_Residencial' => $this->input->post('fone_residencial'),
				'Fone_Comercial' => $this->input->post('fone_comercial'),
				'Celular' => $this->input->post('celular'),
				'Data_Alteracao' => date('Y-m-d H:i:s')
			);
			$this->db->where('Id_Numero', $idNumero);
			$this->db->update($tabela, $dadosEndereco);			
		}else{
			# Gravar dados
			$dadosEndereco = array(
				'Id_Numero' => $idNumero,
				'Endereco' => $this->input->post('endereco'),
				'Bairro' => $this->input->post('bairro'),
				'CEP' => $this->input->post('cep'),
				'Cidade' => $this->input->post('cidade'),
				'UF' => $this->input->post('uf_2'),
				'Fone_Residencial' => $this->input->post('fone_residencial'),
				'Fone_Comercial' => $this->input->post('fone_comercial'),
				'Celular' => $this->input->post('celular'),
				'Data_Cadastro' => date('Y-m-d H:i:s'),
				'Tipo_Pessoa' => 'A'
			);
			$this->db->insert($tabela,$dadosEndereco);
		}
		

		# 3. Verificar se o aluno já tem cadastro de graduação, caso sim, atualizar os dados da graduação, senão,
		#    cadastrar uma nova graduação
		$tabela = 'graduacao';

		$graduacao = $this->db->where('Id_Numero', $idNumero)
							 ->count_all_results($tabela);

		if ($graduacao == 0) {
			# Gravar dados
			$dadosGraduacao = array(
				'Id_Numero' => $idNumero,
				'Curso_Graduacao' => $this->input->post('curso'),
				'Instituicao' => $this->input->post('instituicao'),
				'Sigla' => $this->input->post('sigla'),
				'Ano_Conclusao' => $this->input->post('conclusao'),
				'Data_Cadastro' => date('Y-m-d H:i:s')
			);
			$this->db->insert($tabela,$dadosGraduacao);
		}


		# 4. Verificar se o aluno já tem cadastro de usuário, caso sim, não gravar outro, e continuar o cadastro
		$tabela = 'usuario_aluno';

		$usuarioAluno = $this->db->where('Id_Numero', $idNumero)
								 ->count_all_results($tabela);

		if ($usuarioAluno == 0) {
			# Gravar dados
			$dadosUsuario = array(
				'Id_Numero' => $idNumero,
				'Login' => $this->input->post('email'),
				'Senha' => gerarSenha(),
				'Nome' => $this->input->post('nome'),
				'situacao' => 1,
				'status' => 1
			);
			$this->db->insert($tabela,$dadosUsuario);
		}

		//if ($this->input->post('codg_curso') != 24) {
			# 5. Capiturar o ultimo numero do boleto e somar + 1
			$tabela = 'boletos';

			$boletos = $this->db->count_all_results($tabela);

			if ($boletos == 0) {
				# Primeiro número
				$nossoNum = '99999999';
			}else{
				# 6. Gerar um novo boleto de pre-inscrição
				$dadosBoleto = $this->db
									->order_by('nossoNumero')
									->limit(1)							  
									->get($tabela)->row();
				//echo $this->db->last_query();
				# Novo número
				$nossoNum = $dadosBoleto->nossoNumero - 1;
				
				# Gravar dados
				$arrBoleto = array(
					'idNumero' => $idNumero,
					'nossoNumero' => $nossoNum,
					'codgCurso' => $this->input->post('codg_curso'),
					'data' => date('Y-m-d H:i:s'),
					'status' => null
				);
				$this->db->insert($tabela,$arrBoleto);
			}

			$de = $config->email;

			# 7. Enviar um e-mail com o link do boleto para o aluno imprimir
			$texto = '<!DOCTYPE html>
					<html>
					<head>
					<meta charset="UTF-8">
					<title>IPECON</title>
					</head>

					<body style="font-family: verdana, arial; font-size: 13px;">
						<div style="width: 98%;">
							<div style="width: 100%; height: 105px; background-color: #DDD; border: 1px solid #CCC; position: relative;">
								<img style="width: 250px; margin: 5px;" src="http://www.ipecon.com.br/imagens/marca.png" border="0" /></div>
							<div style="width: 99.3%; position: relative; border: 1px solid #CCC; padding-left: 5px;">
								<p>Prezado(a) <strong>'.$this->input->post('nome').'.</strong></p>
								<p>Agradecemos pela escolha de nossa instituição.<br />
								<br/><p>Garanta sua vaga efetuando o pagamento do boleto no valor de R$ 100,00 e enviando os seguintes documentos:</p>
								<ul>
									<li>Curriculum-Vitae simplificado; </li>
									<li>Fotocópia do Diploma de Curso Superior; </li>
									<li>Fotocópia da Carteira de Identidade; </li>
									<li>Fotocópia do CPF; </li>
									<li>Foto 3 x 4. </li>
								</ul>
								<p style="text-align: center;"><a href="http://www.ipecon.com.br/boletophp/boleto_itau.php?idNumero='.$idNumero.'&curso='.$this->input->post('codg_curso').'"><img style="width: 150px;" src="http://www.ipecon.com.br/imagens/imgBoletoBancario.jpg" border="0" /><br/>imprimir Boleto</a>
								<p>&nbsp;</p>
								<p>Atenciosamente,
								<br /><br />
								IPECON - Ensino e Consultoria<br>
							</div>
							<div style="width: 100%; height: 90px; text-align: center; font-size: 11px; position: relative; background-color: #DDD; border: 1px solid #CCC;">Av. T-4, nº 1.478, Ed. Absolut Business Style, sala A-132 (13º andar)<br>
											Setor Bueno, Goiânia/GO - CEP: 74.230-030<br>
											(62) 3214-2563 - (62) 3214-2563<br><br>
											<a href="'.$config->facebook.'"><img src="https://cdn1.iconfinder.com/data/icons/New-Social-Media-Icon-Set-V11/24/facebook.png" border="0" /></a>&nbsp;
											<a href="'.$config->twitter.'"><img src="https://cdn1.iconfinder.com/data/icons/New-Social-Media-Icon-Set-V11/24/twitter.png" border="0" /></a>&nbsp;
											<a href="'.$config->linkedin.'"><img src="https://cdn3.iconfinder.com/data/icons/free-social-icons/67/linkedin_circle_color-24.png" border="0" /></a>
							</div>
						</div>
					</body>
					</html>';
			$assunto = "[Não responda] Pré-inscrição realizada - IPECON - Pós-Graduação";
			if(!email($de,$this->input->post('email'),$assunto,$texto)){
				$erroInscricao = 3;
				redirect(base_url('index.php').'/inscricao/preInscricao/'.$this->input->post('codg_curso').'/'.$erroInscricao);
				exit();
			}

			# 8. Enviar um e-mail com o comprovante/dados da pre-inscrição
			$texto = '<!DOCTYPE html>
					<html>
					<head>
					<meta charset="UTF-8">
					<title>IPECON</title>
					</head>

					<body style="font-family: verdana, arial; font-size: 13px;">
						<div style="width: 98%;">
							<div style="width: 100%; height: 105px; background-color: #DDD; border: 1px solid #CCC; position: relative;">
								<img style="width: 250px; margin: 5px;" src="http://www.ipecon.com.br/imagens/marca.png" border="0" /></div>
							<div style="width: 99.3%; position: relative; border: 1px solid #CCC; padding-left: 5px;">
								<!-- Conteudo -->
								<h2 style="text-align: center;">Comprovante de Pré-Inscrição</h2>
								<label style="display: block; margin-bottom: 10px;"><strong>Curso</strong><br>'.$curso->Nome.'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Nome</strong><br>'.$this->input->post('nome').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Data de nascimento</strong><br>'.$this->input->post('data_nascimento').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Naturalidade</strong><br>'.$this->input->post('naturalidade').' / '.$this->input->post('uf_1').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Nacionalidade</strong><br>'.$this->input->post('nacionalidade').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Sexo</strong><br>'.$this->input->post('sexo').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Identidade (RG)</strong><br>'.$this->input->post('rg').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Orgão Exp.:</strong><br>'.$this->input->post('orgao').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>C.P.F.</strong><br>'.$this->input->post('cpf').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Endereço</strong><br>'.$this->input->post('endereco').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Bairro</strong><br>'.$this->input->post('bairro').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Cidade/Estado</strong><br>'.$this->input->post('cidade').'/'.$this->input->post('uf_2').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>CEP</strong><br>'.$this->input->post('cep').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Telefone Residência</strong><br>'.($this->input->post('fone_residencial') ? $this->input->post('fone_residencial') : "Não informado").'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Telefone Celular</strong><br>'.($this->input->post('celular') ? $this->input->post('celular') : "Não informado").'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Telefone Comercial</strong><br>'.($this->input->post('fone_comercial') ? $this->input->post('fone_comercial') : "Não informado").'</label>	
								<label style="display: block; margin-bottom: 10px;"><strong>e-Mail</strong><br>'.$this->input->post('email').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Curso de Graduação</strong><br>'.$this->input->post('curso').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Instituição</strong><br>'.$this->input->post('instituicao').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Sigla da Instituição</strong><br>'.$this->input->post('sigla').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Conclusão</strong><br>'.$this->input->post('conclusao').'</label>
								
								<p style="text-align: center;"><a href="http://www.ipecon.com.br/boletophp/boleto_itau.php?idNumero='.$idNumero.'&curso='.$this->input->post('codg_curso').'"><img style="width: 150px;" src="http://www.ipecon.com.br/imagens/imgBoletoBancario.jpg" border="0" /><br/>imprimir Boleto</a>
								<p>&nbsp;</p>
								<p>Atenciosamente,
								<br /><br />
								IPECON - Ensino e Consultoria<br>
							</div>
							<div style="width: 100%; height: 90px; text-align: center; font-size: 11px; position: relative; background-color: #DDD; border: 1px solid #CCC;">Av. T-4, nº 1.478, Ed. Absolut Business Style, sala A-132 (13º andar)<br>
											Setor Bueno, Goiânia/GO - CEP: 74.230-030<br>
											(62) 3214-2563 - (62) 3214-2563<br><br>
											<a href="'.$config->facebook.'"><img src="https://cdn1.iconfinder.com/data/icons/New-Social-Media-Icon-Set-V11/24/facebook.png" border="0" /></a>&nbsp;
											<a href="'.$config->twitter.'"><img src="https://cdn1.iconfinder.com/data/icons/New-Social-Media-Icon-Set-V11/24/twitter.png" border="0" /></a>&nbsp;
											<a href="'.$config->linkedin.'"><img src="https://cdn3.iconfinder.com/data/icons/free-social-icons/67/linkedin_circle_color-24.png" border="0" /></a>
							</div>
						</div>
					</body>
					</html>';
		/*}else{
			# 8. Enviar um e-mail com o comprovante/dados da pre-inscrição
			$texto = '<!DOCTYPE html>
					<html>
					<head>
					<meta charset="UTF-8">
					<title>IPECON</title>
					</head>

					<body style="font-family: verdana, arial; font-size: 13px;">
						<div style="width: 98%;">
							<div style="width: 100%; height: 105px; background-color: #DDD; border: 1px solid #CCC; position: relative;">
								<img style="width: 250px; margin: 5px;" src="http://www.ipecon.com.br/imagens/marca.png" border="0" /></div>
							<div style="width: 99.3%; position: relative; border: 1px solid #CCC; padding-left: 5px;">
								<!-- Conteudo -->
								<h2 style="text-align: center;">Comprovante de Pré-Inscrição</h2>
								<label style="display: block; margin-bottom: 10px;"><strong>Curso</strong><br>'.$curso->Nome.'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Nome</strong><br>'.$this->input->post('nome').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Data de nascimento</strong><br>'.$this->input->post('data_nascimento').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Naturalidade</strong><br>'.$this->input->post('naturalidade').' / '.$this->input->post('uf_1').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Nacionalidade</strong><br>'.$this->input->post('nacionalidade').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Sexo</strong><br>'.$this->input->post('sexo').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Identidade (RG)</strong><br>'.$this->input->post('rg').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Orgão Exp.:</strong><br>'.$this->input->post('orgao').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>C.P.F.</strong><br>'.$this->input->post('cpf').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Endereço</strong><br>'.$this->input->post('endereco').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Bairro</strong><br>'.$this->input->post('bairro').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Cidade/Estado</strong><br>'.$this->input->post('cidade').'/'.$this->input->post('uf_2').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>CEP</strong><br>'.$this->input->post('cep').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Telefone Residência</strong><br>'.($this->input->post('fone_residencial') ? $this->input->post('fone_residencial') : "Não informado").'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Telefone Celular</strong><br>'.($this->input->post('celular') ? $this->input->post('celular') : "Não informado").'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Telefone Comercial</strong><br>'.($this->input->post('fone_comercial') ? $this->input->post('fone_comercial') : "Não informado").'</label>	
								<label style="display: block; margin-bottom: 10px;"><strong>e-Mail</strong><br>'.$this->input->post('email').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Curso de Graduação</strong><br>'.$this->input->post('curso').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Instituição</strong><br>'.$this->input->post('instituicao').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Sigla da Instituição</strong><br>'.$this->input->post('sigla').'</label>
								<label style="display: block; margin-bottom: 10px;"><strong>Conclusão</strong><br>'.$this->input->post('conclusao').'</label>
								
								<p>&nbsp;</p>
								<p>Atenciosamente,
								<br /><br />
								IPECON - Ensino e Consultoria<br>
							</div>
							<div style="width: 100%; height: 90px; text-align: center; font-size: 11px; position: relative; background-color: #DDD; border: 1px solid #CCC;">Av. T-4, nº 1.478, Ed. Absolut Business Style, sala A-132 (13º andar)<br>
											Setor Bueno, Goiânia/GO - CEP: 74.230-030<br>
											(62) 3214-2563 - (62) 3214-2563<br><br>
											<a href="'.$config->facebook.'"><img src="https://cdn1.iconfinder.com/data/icons/New-Social-Media-Icon-Set-V11/24/facebook.png" border="0" /></a>&nbsp;
											<a href="'.$config->twitter.'"><img src="https://cdn1.iconfinder.com/data/icons/New-Social-Media-Icon-Set-V11/24/twitter.png" border="0" /></a>&nbsp;
											<a href="'.$config->linkedin.'"><img src="https://cdn3.iconfinder.com/data/icons/free-social-icons/67/linkedin_circle_color-24.png" border="0" /></a>
							</div>
						</div>
					</body>
					</html>';
		}// Fim da verificação do curso rápido
		*/
		
		$assunto = "[Não responda] Comprovante de pré-inscrição - IPECON - Pós-Graduação";
		if(!email($de,$this->input->post('email'),$assunto,$texto)){
			$erroInscricao = 4;
			redirect(base_url('index.php').'/inscricao/preInscricao/'.$this->input->post('codg_curso').'/'.$erroInscricao);
			exit();
		}		
		
		# 9. Enviar um e-mail para IPECON informando que mais uma inscrição foi realizada
		$texto = '<!DOCTYPE html>
				<html>
				<head>
				<meta charset="UTF-8">
				<title>IPECON</title>
				</head>

				<body style="font-family: verdana, arial; font-size: 13px;">
					<div style="width: 98%;">
						<div style="width: 100%; height: 105px; background-color: #DDD; border: 1px solid #CCC; position: relative;">
							<img style="width: 250px; margin: 5px;" src="http://www.ipecon.com.br/imagens/marca.png" border="0" /></div>
						<div style="width: 99.3%; position: relative; border: 1px solid #CCC; padding-left: 5px;">
							<!-- Conteudo -->
							<h2 style="text-align: center;">Nova Pré-Inscrição</h2><br>
							<label style="display: block; margin-bottom: 10px;"><strong>Aluno(a):</strong><br>'.$this->input->post('nome').'</label>
							<label style="display: block; margin-bottom: 10px;"><strong>Curso:</strong><br>'.$curso->Nome.'</label>
							<label style="display: block; margin-bottom: 10px;"><strong>Data de cadastro:</strong><br>'.dataHora().'</label>
							
						</div>
						<div style="width: 100%; height: 90px; text-align: center; font-size: 11px; position: relative; background-color: #DDD; border: 1px solid #CCC;">Av. T-4, nº 1.478, Ed. Absolut Business Style, sala A-132 (13º andar)<br>
										Setor Bueno, Goiânia/GO - CEP: 74.230-030<br>
										(62) 3214-2563 - (62) 3214-2563<br><br>
										<a href="'.$config->facebook.'"><img src="https://cdn1.iconfinder.com/data/icons/New-Social-Media-Icon-Set-V11/24/facebook.png" border="0" /></a>&nbsp;
										<a href="'.$config->twitter.'"><img src="https://cdn1.iconfinder.com/data/icons/New-Social-Media-Icon-Set-V11/24/twitter.png" border="0" /></a>&nbsp;
										<a href="'.$config->linkedin.'"><img src="https://cdn3.iconfinder.com/data/icons/free-social-icons/67/linkedin_circle_color-24.png" border="0" /></a>
						</div>
					</div>
				</body>
				</html>';
		$assunto = "[Não responda] Nova pré-inscrição realizada";
		if(!email($this->input->post('email'),$config->email,$assunto,$texto)){
			$erroInscricao = 5;
			redirect(base_url('index.php').'/inscricao/preInscricao/'.$this->input->post('codg_curso').'/'.$erroInscricao);
			exit();
		}

		# 10. Direcionar o aluno para uma página para impressão do boleto.
		redirect(base_url('index.php').'/inscricao/mensagemPreInscricao/'.$idNumero.'/'.$this->input->post('codg_curso'));

	}

	function mensagemPreInscricao(){
		$data['pagina'] = 'inscricao/mensagem_inscricao';

		$this->load->view('inicio/inicio_view',$data);
	}

}
?>
