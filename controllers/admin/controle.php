<?php
class Controle extends CI_Controller{
	private $modulo;
	private $table;
	private $pk;
	private $extensao;
	private $anexada;
	private $where_fk;
	private $order_fk;


	private $fields;
	private $info;


	public function __construct(){

		parent::__construct();
		$this->modulo = $_SESSION['modulo']['modulo'];
		$this->table = $_SESSION['modulo']['table'];
		$this->pk = $_SESSION['modulo']['pk'];
		$this->fields = $_SESSION['modulo']['fields'];
		$this->anexada = $_SESSION['modulo']['anexada'];
		$this->extensao = $_SESSION['modulo']['extensao'];
		$this->pai = isset($_SESSION['modulo']['pai'])?$_SESSION['modulo']['pai']:0;

		$this->where_fk = isset($_SESSION['modulo']['where_fk']) ? $_SESSION['modulo']['where_fk'] : null;
		$this->order_fk = isset($_SESSION['modulo']['order_fk']) ? $_SESSION['modulo']['order_fk'] : null;

		$this->info = array(
			'modulo'=>$this->modulo,
			'table'=>$this->table,
			'pk'=>$this->pk,
			'fields'=>$this->fields,
			'extensao'=>$this->extensao,
			'anexada'=>$this->anexada,
			'pai'=>$this->pai,
			'filtro'=>isset($_SESSION['modulo']['filtro'])?$_SESSION['modulo']['filtro']:false,
			'where_fk'=>$this->where_fk,
			'order_fk'=>$this->order_fk
		);



		}


	//Cria um array na sessão com informações de listagem
	public function config_filtro(){

		unset($_POST['pk']);
		$_SESSION['filtros'] = array();
		foreach($_POST as $field => $p){
			if(!empty($p)){
			list($type,$field) = explode('__',$field);
			  $_SESSION['filtros'][] = array('type'=>$type,'field'=>$field,'val'=>$p);
			}
			}

		redirect(base_admin('controle/listar'));

		}



	public function listar(){

		//Verifica se há algum filtro no array
		if(isset($_SESSION['filtros'])&&count($_SESSION['filtros'])>0){
			 foreach($_SESSION['filtros'] as $filto){

				  if($filto['type']=='pk'){
					   $this->db->where($filto['field'],$filto['val']);
					  }

				  if($filto['type']=='varchar'){
					  $this->db->like($filto['field'],$filto['val']);
					  }

				  if($filto['type']=='fk'){
					  $this->db->where($filto['field'],$filto['val']);
					  }

				 }
			}

		//Verifica se é uma extensão
		if($this->pai!=0){
			$this->db->where('id_pai',$this->pai);
			}


		$dados = $this->db
		  ->order_by("ordem",'DESC')
		  ->order_by($this->pk,'DESC')
		  ->get($this->table)
		  ->result_array();

		$this->load->library('paginacao');
		$this->paginacao->por_pagina(10);
		$data['dados'] = $this->paginacao->rows($dados);
		$data['links'] = $this->paginacao->links();


		$data['info'] = $this->info;
		$data['pagina'] = 'controle/listar';
		view_admin('inicio_view',$data);
		}

	public function add(){
		$data['info'] = $this->info;

		$data['pagina'] = 'controle/add';
		view_admin('inicio_view',$data);
		}

	public function editar(){
		$data['info'] = $this->info;
		$data['pagina'] = 'controle/editar';
		view_admin('inicio_view',$data);
		}

	public function ordem(){

		$this->db->where($this->pk,$this->uri->segment(4))->update($this->table,array(
		'ordem'=>$_GET['direcao']
		));
		redirect(base_admin('controle/listar'));
		}

	public function salvar_novo(){
		 $_POST['insert_data'] = date('Y-m-d H:i:s');
		 $_POST['update_data'] = date('Y-m-d H:i:s');

		 if($this->pai!=0){
			 $_POST['id_pai'] = $this->pai;
			 }

		 $this->db->insert($this->table,$_POST);

		if(isset($_GET['aplicar'])&&$_GET['aplicar']=='sim'){
		 redirect(base_admin('controle/add/'));
		 }else{
			 redirect(base_admin('controle/listar'));
			 }

		}

	public function salvar_update(){
		 $_POST['update_data'] = date('Y-m-d H:i:s');

		 $this->db->where($this->pk,$this->uri->segment(4))->update($this->table,$_POST);

		 if(isset($_GET['aplicar'])&&$_GET['aplicar']=='sim'){
		 redirect(base_admin('controle/editar/'.$this->uri->segment(4)));
		 }else{
			 redirect(base_admin('controle/listar'));
			 }
		}

	public function excluir(){

		if(!permissao($this->modulo,'remover')){
			 redirect(base_admin('controle/listar'));exit;
	     }

		 $this->db->where($this->pk,$this->uri->segment(4))->delete($this->table);
		 redirect(base_admin('controle/listar'));
		}


	}