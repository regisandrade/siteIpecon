<?php

/*
-----------------VEJA UM MODELO COMPLETO-----------------

	public function <nome_do_modelo>(){
		$_SESSION['modulo'] = array();
		$_SESSION['modulo']['modulo']  = '<nome_do_modelo>';
		$_SESSION['modulo']['table'] = '<nome_da_tabela_do_modelo>';
		$_SESSION['modulo']['pk'] = '<nome_chave_primaria>';
		$_SESSION['modulo']['anexada'] = 'produtos';
		$_SESSION['modulo']['extensao'] = array();
		$_SESSION['modulo']['pai'] = @$_GET['pai'];
		$_SESSION['modulo']['order'] = 'coluna'; // Coluna utilizada para ordenar a consulta
		$_SESSION['modulo']['order_fk'] = 'coluna_fk'; // Coluna utilizada para ordenar a consulta FK

		//Definindo os campos da tabela
		$_SESSION['modulo']['fields'] =
		array(
		'<campo_chave_primaria>'=>array('type'=>'pk','label'=>'<label_ou_nome_campo>'),
		'<campo_imagem>'=>array('type'=>'img','label'=>'<label_ou_nome_campo>'),
		'<campo_varchar>'=>array('type'=>'varchar','size'=>200,'notnull'=>0,'label'=>'<label_ou_nome_campo>'),
		'<campo_texto_simples>'=>array('type'=>'text','label'=>'<label_ou_nome_campo>'),
		'<campo_texto_rico_ckeditor>'=>array('type'=>'text','ckeditor'=>1,'label'=>'<label_ou_nome_campo>'),
		'<campo_data>'=>array('type'=>'date','notnull'=>0,'label'=>'<label_ou_nome_campo>'),
		'<campo_chave_estrangeira>'=>array('type'=>'fk','table_fk'=>'<nome_tabela_estrangeira>','fk_id'=>'<id_tabela_estrangeira>','fk_text'=>'<campo_texto_tabela_estrangeira>','label'=>'<label_ou_nome_campo>'),
		);
		//Instalando o modulo
		$this->install();
		//ir para controlador
		redirect(base_admin('controle/listar'));
	}

------FIM DO EXEMPLO---------

*/

class Modulos extends CI_Controller{

   public function __construct(){
	   parent::__construct();
	   $_SESSION['filtros'] = array();
	   }

	public function configuracao(){
		$_SESSION['modulo'] = array();
		$_SESSION['modulo']['modulo']  = 'configuracao';
		$_SESSION['modulo']['table'] = 'configuracao';
		$_SESSION['modulo']['pk'] = 'id_configuracao';
		$_SESSION['modulo']['anexada'] = '';
		$_SESSION['modulo']['extensao'] = array();

		//Definindo os campos da tabela
		$_SESSION['modulo']['fields'] =
		array(
		'id_configuracao'=>array('type'=>'pk','label'=>'N°'),
		'empresa'=>array('type'=>'varchar','size'=>200,'notnull'=>0,'label'=>'Empresa'),
		'slogan'=>array('type'=>'varchar','size'=>200,'notnull'=>0,'label'=>'Slogan'),
		'descricao'=>array('type'=>'text','size'=>200,'notnull'=>0,'label'=>'Descrição'),
		'email'=>array('type'=>'varchar','size'=>200,'notnull'=>0,'label'=>'E-mail'),
		'endereco'=>array('type'=>'text','label'=>'Endereço'),
		'telefone_1'=>array('type'=>'varchar','size'=>15,'notnull'=>0,'label'=>'Telefone 1'),
		'telefone_2'=>array('type'=>'varchar','size'=>15,'notnull'=>1,'label'=>'Telefone 2'),
		'facebook'=>array('type'=>'varchar','size'=>300,'notnull'=>0,'label'=>'Facebook'),
		'twitter'=>array('type'=>'varchar','size'=>300,'notnull'=>0,'label'=>'Twitter'),
		'linkedin'=>array('type'=>'varchar','size'=>300,'notnull'=>0,'label'=>'LinkedIn'),
		'meta_descricao'=>array('type'=>'text','label'=>'Meta Descrição'),
		'latitude_endereco'=>array('type'=>'text','label'=>'Latitude'),
		'longitude_endereco'=>array('type'=>'text','label'=>'Longitude'),

		);
		//Instalando o modulo
		$this->install();
		//ir para controlador
		redirect(base_admin('controle/listar'));
	}


	public function noticias(){
		$_SESSION['modulo'] = array();
		$_SESSION['modulo']['modulo']  = 'noticias';
		$_SESSION['modulo']['table'] = 'noticias';
		$_SESSION['modulo']['pk'] = 'id_noticia';
		$_SESSION['modulo']['anexada'] = '';
		$_SESSION['modulo']['extensao'] = array();

		//Definindo os campos da tabela
		$_SESSION['modulo']['fields'] =
		array(
		'id_noticia'=>array('type'=>'pk','label'=>'Nº'),
		'titulo'=>array('type'=>'varchar','size'=>200,'label'=>'Titulo'),
		'texto'=>array('type'=>'text','ckeditor'=>1,'label'=>'Texto'),
		);
		//Instalando o modulo
		$this->install();
		//ir para controlador
		redirect(base_admin('controle/listar'));
	}

	public function galerias(){
		$_SESSION['modulo'] = array();
		$_SESSION['modulo']['modulo']  = 'galerias';
		$_SESSION['modulo']['table'] = 'galerias';
		$_SESSION['modulo']['pk'] = 'id_galeria';
		$_SESSION['modulo']['anexada'] = '';
		$_SESSION['modulo']['extensao'] = array('fotos'=>'Fotos');

		//Definindo os campos da tabela
		$_SESSION['modulo']['fields'] =
		array(
		'id_galeria'=>array('type'=>'pk','label'=>'Nº'),
		//'imagem'=>array('type'=>'img','label'=>'Imagem Capa'),
		'titulo'=>array('type'=>'varchar','size'=>200,'label'=>'Título'),
		);
		//Instalando o modulo
		$this->install();
		//ir para controlador
		redirect(base_admin('controle/listar'));
	}

	public function fotos(){
		$_SESSION['modulo'] = array();
		$_SESSION['modulo']['modulo']  = 'fotos';
		$_SESSION['modulo']['table'] = 'fotos';
		$_SESSION['modulo']['pk'] = 'id_foto';
		$_SESSION['modulo']['anexada'] = 'galerias';
		$_SESSION['modulo']['extensao'] = array();
		$_SESSION['modulo']['pai'] = @$_GET['pai'];

		//Definindo os campos da tabela
		$_SESSION['modulo']['fields'] =
		array(
		 'id_foto'=>array('type'=>'pk','label'=>'Nº'),
		 //'nome'=>array('type'=>'varchar','size'=>200,'notnull'=>0,'label'=>'nome'),
		 'foto'=>array('type'=>'img','label'=>'Foto'),
		 //'texto'=>array('type'=>'text','ckeditor'=>1,'label'=>'Texto')
		);

		//Instalando o modulo
		$this->install();
		//ir para controlador

		redirect(base_admin('controle/listar'));
	}

	public function empresa(){
		$_SESSION['modulo'] = array();
		$_SESSION['modulo']['modulo']  = 'empresa';
		$_SESSION['modulo']['table'] = 'empresa';
		$_SESSION['modulo']['pk'] = 'id_empresa';
		$_SESSION['modulo']['anexada'] = '';
		$_SESSION['modulo']['extensao'] = array();

		//Definindo os campos da tabela
		$_SESSION['modulo']['fields'] =
		array(
		'id_empresa'=>array('type'=>'pk','label'=>'Nº'),
		'titulo'=>array('type'=>'varchar','size'=>200,'label'=>'Titulo'),
		'texto'=>array('type'=>'text','ckeditor'=>1,'label'=>'Texto'),
		);
		//Instalando o modulo
		$this->install();
		//ir para controlador
		redirect(base_admin('controle/listar'));
	}

	public function banners(){
		$_SESSION['modulo'] = array();
		$_SESSION['modulo']['modulo']  = 'banners';
		$_SESSION['modulo']['table'] = 'banners';
		$_SESSION['modulo']['pk'] = 'id_banners';
		$_SESSION['modulo']['anexada'] = '';
		$_SESSION['modulo']['extensao'] = array();

		//Definindo os campos da tabela
		$_SESSION['modulo']['fields'] =
		array(
		'id_banners'=>array('type'=>'pk','label'=>'Nº'),
		'imagem'=>array('type'=>'img','label'=>'Imagem'),
		'titulo'=>array('type'=>'varchar','size'=>200,'label'=>'Titulo'),
		'link'=>array('type'=>'varchar','size'=>200,'label'=>'Link'),
		);
		//Instalando o modulo
		$this->install();
		//ir para controlador
		redirect(base_admin('controle/listar'));
	}

	public function descricaoCursos(){
		$_SESSION['modulo'] = array();
		$_SESSION['modulo']['modulo']  = 'descricaoCursos';
		$_SESSION['modulo']['table'] = 'descricaoCursos';
		$_SESSION['modulo']['pk'] = 'id_descricao_curso';
		$_SESSION['modulo']['anexada'] = '';
		$_SESSION['modulo']['extensao'] = array();
		$_SESSION['modulo']['order_fk'] = 'Nome';
		$_SESSION['modulo']['where_fk'] = 'Status = 1';

		//Definindo os campos da tabela
		$_SESSION['modulo']['fields'] =
		array(
			'id_descricao_curso'=>array('type'=>'pk','label'=>'Nº'),
			'codg_curso_descricao'=>array('type'=>'fk','table_fk'=>'curso','fk_id'=>'Codg_Curso','fk_text'=>'Nome','label'=>'Curso'),
			//'nome'=>array('type'=>'varchar','size'=>200,'label'=>'Nome'),
			'apresentacao'=>array('type'=>'text','ckeditor'=>1,'label'=>'Apresentação'),
			'publico'=>array('type'=>'text','ckeditor'=>1,'label'=>'Público Alvo'),
			'datas'=>array('type'=>'text','ckeditor'=>1,'label'=>'Datas Importantes'),
			'inscricao'=>array('type'=>'text','ckeditor'=>1,'label'=>'Inscrição'),
			'avaliacao'=>array('type'=>'text','ckeditor'=>1,'label'=>'Avaliação'),
			'disciplinas'=>array('type'=>'text','ckeditor'=>1,'label'=>'Disciplinas'),
			'metodologia'=>array('type'=>'text','ckeditor'=>1,'label'=>'Matodologia'),
			'certificados'=>array('type'=>'text','ckeditor'=>1,'label'=>'Certificados'),
			'duracao'=>array('type'=>'text','ckeditor'=>1,'label'=>'Duração do Curso'),
			'numeroVagas'=>array('type'=>'text','ckeditor'=>1,'label'=>'Número de Vagas'),
			'coordenacaogeral'=>array('type'=>'text','ckeditor'=>1,'label'=>'Coordenação Geral'),
			'coordenacaoacademica'=>array('type'=>'text','ckeditor'=>1,'label'=>'Coordenação Acadêmica'),
			'horario'=>array('type'=>'text','ckeditor'=>1,'label'=>'Horário das Aulas'),
			'processo'=>array('type'=>'text','ckeditor'=>1,'label'=>'Processo Seletivo'),
			'corpoDocente'=>array('type'=>'text','ckeditor'=>1,'label'=>'Corpo Docente'),
			'informacoes'=>array('type'=>'text','ckeditor'=>1,'label'=>'Informações'),
		);
		//Instalando o modulo
		$this->install();
		//ir para controlador
		redirect(base_admin('controle/listar'));
	}

	public function cursos(){
		$_SESSION['modulo'] = array();
		$_SESSION['modulo']['modulo']  = 'cursos';
		$_SESSION['modulo']['table'] = 'curso';
		$_SESSION['modulo']['pk'] = 'Codg_Curso';
		$_SESSION['modulo']['anexada'] = '';
		$_SESSION['modulo']['extensao'] = array();

		//Definindo os campos da tabela
		$_SESSION['modulo']['fields'] =
		array(
			'Codg_Curso'=>array('type'=>'pk','label'=>'Nº'),
			'Nome'=>array('type'=>'varchar','size'=>200,'label'=>'Nome'),
			'Qtde_Horas'=>array('type'=>'varchar','size'=>40,'label'=>'Carga Horária'),
			'Data_Inicio'=>array('type'=>'date','size'=>200,'label'=>'Dt. Início'),
			'Data_Fim'=>array('type'=>'date','size'=>200,'label'=>'Dt. Fim'),
			'Status'=>array('type'=>'varchar','size'=>1,'label'=>'Status'),
			'flagMba'=>array('type'=>'varchar','size'=>1,'label'=>'MBA?'),
		);
		//Instalando o modulo
		$this->install();
		//ir para controlador
		redirect(base_admin('controle/listar'));
	}

	public function instalacao(){
		$_SESSION['modulo'] = array();
		$_SESSION['modulo']['modulo']  = 'instalacao';
		$_SESSION['modulo']['table'] = 'instalacao';
		$_SESSION['modulo']['pk'] = 'id_instalacao';
		$_SESSION['modulo']['anexada'] = '';
		$_SESSION['modulo']['extensao'] = array();

		//Definindo os campos da tabela
		$_SESSION['modulo']['fields'] =

		array(

		 'id_instalacao'=>array('type'=>'pk','label'=>'Nº'),
		 'titulo'=>array('type'=>'varchar','size'=>200,'notnull'=>0,'label'=>'Titulo'),
		 'resumo'=>array('type'=>'text','size'=>200,'label'=>'Introdução'),
		 'texto'=>array('type'=>'text','ckeditor'=>1,'label'=>'Texto'),

		);

		//Instalando o modulo
		$this->install();
		//ir para controlador

		redirect(base_admin('controle/listar'));
	 }


    /*INSTALL MODULO NÃO MEXER*/
	public function install(){

		if(!$this->db->table_exists($_SESSION['modulo']['table'])){
			$SQL_TABLE = "CREATE TABLE ".$_SESSION['modulo']['table']."(";

			foreach($_SESSION['modulo']['fields'] as $field => $f){

				//PRIMARY KEY
				if($f['type']=='pk'){
					$SQL_TABLE .= $field." integer not null auto_increment primary key,";
					}

				//VARCHAR
				if($f['type']=='varchar'){
					$null = isset($f['notnull'])?'':' not null';
					$SQL_TABLE .= $field." varchar(".$f['size'].") {$null},";
					}

				//VARCHAR
				if($f['type']=='img'){
					$SQL_TABLE .= $field." varchar(200),";
					}

				//VARCHAR
				if($f['type']=='date'){
					$null = isset($f['notnull'])?'':' not null';
					$SQL_TABLE .= $field." date $null,";
					}

				//VARCHAR
				if($f['type']=='datetime'){
					$null = isset($f['notnull'])?'':' not null';
					$SQL_TABLE .= $field." datetime $null,";
					}

				//VARCHAR
				if($f['type']=='fk'){
					$SQL_TABLE .= $field." integer default 0,";
					}

				//VARCHAR
				if($f['type']=='text'){
					$null = isset($f['notnull'])?'':' not null';
					$SQL_TABLE .= $field." text $null,";
					}
				}

			if(isset($_SESSION['modulo']['pai'])){
				$SQL_TABLE .= "id_pai integer default 0,";
				}

			$SQL_TABLE .= "ordem integer default 1,";
			$SQL_TABLE .= "insert_data datetime default '0000-00-00 00:00:00',";
			$SQL_TABLE .= "update_data datetime default '0000-00-00 00:00:00');";

			$this->db->query($SQL_TABLE);


			//echo "Tabela <b>".$_SESSION['modulo']['table']."</b> criada<br>";
			}else{
				//echo "Ja existe a tabela <b>".$_SESSION['modulo']['table']."</b><br>";
				}

		}

}




