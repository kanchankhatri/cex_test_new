<?php
class User_model extends CI_Model {

	function __construct()
	{
        // Call the Model constructor
		parent::__construct();
		$this->load->database();
	}

	// function validate_user_credentials($params)
	// {
	// 	if(empty($params['email'])||empty($params['password'])){
	// 		return false;
	// 	}
	// 	$this->db->select('userid,email,password,status');
	// 	$this->db->from('user');
	// 	$check['email']=$params['email'];
	// 	$check['password']=(md5($params['password']));
	// 	$this->db->where($check);
	// 	$query = $this->db->get();
	// 	//echo $this->db->last_query();
	// 	$result = $query->result();
	// 	if(empty($result))
	// 		return false;
	// 	else
	// 		return $result;
	// }
	function get($params=array()) {
		if(!empty($params['select']))
			$this->db->select($params['select']);
		$this->db->from('user');
		if(!empty($params['where'])){
			$this->db->where($params['where']);
		}
		if(!empty($params['where_or'])){
			$this->db->or_where($params['where_or']);
		}
		if(!empty($params['where_in'])){
			$this->db->where_in(key($params['where_in']), $params['where_in'][key($params['where_in'])]);
		}
		if(!empty($params['limit'])){
			$this->db->limit($params['limit']);
		}
		if(!empty($params['offset'])){
			$this->db->offset($params['offset']);
		}
		if(!empty($params['order_by'])){
			$this->db->order_by(key($params['order_by']),$params['order_by'][key($params['order_by'])]);
		} else {
			$this->db->order_by('userid','desc');
		}
		$query = $this->db->get();
		// echo $this->db->last_query();exit;
		$result = $query->result();
		if(empty($result))
			return false;
		else
			return $result;
	}	
	function insert($params){
		if($params['name']=="" || $params['email']=="")
			throw new Exception ('Missing Required Params Name or Email');
		$check = array('where'=>array('email'=>$params['email']));
		$user = $this->get($check);
		if(!empty($user)){
			throw new Exception ('user already exist.');
		}
		$this->db->insert('user', $params);
		return $this->db->insert_id();
	}
	function update($params){
		if($params['name']=="" || $params['email']=="" || empty($params['where']))
			throw new Exception ('Missing Params For Update Operation');
		$check = array('where'=>array('userid'=>$params['where']['userid']));
		$user = $this->get($check);		
		if($user[0]->email != $params['email']){
			$check = array('where'=>array('email'=>$params['email'],'status'=>'active'));
			$user = $this->get($check);		
			if(!empty($user)){
				throw new Exception ('Cant update user with this email. user already exist.');
			}
		}				
		$this->db->where($params['where']);
		unset($params['where']);
		return $this->db->update('user', $params);
	}	
}