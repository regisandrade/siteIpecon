<?php 

class Obj{
	private $ordem = array();
	private $limit_inicio;
	private $limit_fim;
	private $where;
	private $like;
	private $ci;
	
	function __construct(){
		$this->ci = & get_instance();
		}
	
	
	###RETORNA UM CAMPO DE UM FORM
	function field($form,$field){
	$con = $this->ci->db->where(array('co_field'=>$field,'co_form'=>$form))->get('conteudo')->result();
	if(count($con)){
		return $con[0]->co_valor;
		}else{
			return "";
			}
	}
	
	
	
	//Retorna uma array de objetos de um determinado
	function form($form,$limit=0){
	 	
    $array_objetos = array();
	
	//Caso haja limit
	if(!empty($this->limit_fim)&&!is_null($this->limit_fim)&&$this->limit_fim!=0){
		$this->ci->db->limit($this->limit_fim,$this->limit_inicio);
		}
	
	//Caso haja limit
	if(count($this->ordem)){
		foreach($this->ordem as $index => $value){
		$this->ci->db->order_by($index,$value);
		}
	}else{
		$this->ci->db->order_by('co_ordem',"ASC");
		}
	
	
	//COndições
	if(count($this->where)){
		foreach($this->where as $index => $value){
		$this->ci->db->where($index,$value);
		}
	}

	//COndições
	if(count($this->like)){
		foreach($this->like as $index => $value){
		$this->ci->db->like($index,$value);
		}
	}	
	
    $rows = $this->ci->db->where('co_form',$form)->group_by('co_id')->get('conteudo')->result();
    
	foreach($rows as $rw){
	$this->ci->db->where('co_form',$form)->where('co_id',$rw->co_id);
	$con = $this->ci->db->get('conteudo')->result();
	if(count($con)){
		
		$obj = new stdClass();
		$obj->{'co_id'} = $con[0]->co_id;
		foreach($con as $c){
			$obj->{$c->co_field} = $c->co_valor;
			}
		$obj->{"co_pai"} = 	$c->co_pai;
		$array_objetos[] = $obj;	
		}else{
			return "";
			}
	 }
	 
	self::limpar_obj();
	return $array_objetos;
	}
	
	
	
	function conteudo($id){
		
		$con = $this->ci->db->where('co_id',$id)->get('conteudo')->result();
		if(count($con)){
			
			$obj = new stdClass();
			$obj->co_id = $id;
			foreach($con as $c){
				$obj->{$c->co_field} = $c->co_valor;
				}
				
			return $obj;	
			}else{
				return "";
				}
	 
		}
	
	
	
	function limpar_obj(){
		$this->ordem = NULL;
	    $this->limit_inicio = NULL;
	    $this->limit_fim = NULL;
		$this->where = NULL;
		$this->like = NULL;
		}
	
	public function limit($fim,$inicio=0){
		$this->limit_inicio = $inicio;
		$this->limit_fim = $fim;
		return $this;
		}
		
	public function where($where = array()){
		$this->where = $where;
		return $this;
		}

	public function like($like = array()){
		$this->like = $like;
		return $this;
		}
		
	public function order_by($ordem){
		$this->ordem = $ordem;
		return $this;
		}
	}

?>