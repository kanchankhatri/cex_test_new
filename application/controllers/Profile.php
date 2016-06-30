<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('common');		
		$this->load->model('user_model');		
	}
	public function index()
	{
		$this->list_profiles();		
	}
	function list_profiles() {
		try{
			$data=array();
			$ids='';
			if(isset($_GET['ids'])){
				$ids = $_GET['ids'];
			}
			$id_arr = array();
			$params = array();
			if($ids!='') {
				$id_arr = explode(',', $ids);
				$params['where_in']['userid'] = $id_arr;
			}
			$params['select'] = 'userid,email,name,pic,phone,status';
			$params['order_by']['userid'] = 'desc';
			$data['profiles'] = $this->user_model->get($params);
			$data['sections'] = array($this->load->view('list_profile',$data,true));
			$this->load->view('index',$data);
		} catch (Exception $e){
			show_error($e->getMessage());
		}
	}
	function detail($userid) {
		try{
			$data=array();
			$params = array();			
			$params['select'] = 'userid,email,name,pic,phone,creationtime,status';			
			$data['profile_detail'] = $this->user_model->get(array('where'=>array('userid'=>$userid)));
			$params['select'] = 'userid';
			$params['order_by']['userid'] = 'desc';			
			$params['where']['status'] = 'active';			
			$data['profiles'] = $this->user_model->get($params);

			$data['sections'] = array($this->load->view('detail',$data,true));
			$this->load->view('index',$data);
		} catch (Exception $e){
			show_error($e->getMessage());
		}
	}
	function add(){
		try {
			$data=array();
			if(!empty($_POST)){
				// print_r($_POST); print_r($_FILES);exit;
				$params = array_map('trim',$_POST);
				$params['name']=htmlentities($_POST['name']);			
				$params['phone']=$_POST['phone'];
				$insert=true;
				if(!empty($_FILES)  && $_FILES['profile_pic_image']['name']!=''){
					$img_params = $_POST;
					$img_params['upload_to'] = constant('PROFILEPIC');
					$img_params['type'] = 'profile_pic';
					$img_params['FILES'] = $_FILES;
					$data_res = add_image_file_post($img_params,1);
					// print_r($data_res);exit;
					$data['error']=$data_res['message'];
					if ($data_res['status']==true) {
						$insert=true;
						$params['pic'] = $data_res['image_path'];
						// $this->user_model->insert($params);					
					} else {
						$insert=false;
					}
				}
				// print_r($params);exit;
				if($insert){
					$userid = $this->user_model->insert($params);
					$data['error']='User Added. Check - <a href="'.base_url('/profile/detail/'.$userid).'">'.$userid.'</a>';
				} else {
					$data['profile_detail'] = $_POST;
					if($data['error']==''){
						$data['error']='Failed to add User. please try again';
					}
				}
			}						
		} catch (Exception $e){
			// show_error($e->getMessage());	
			$data['error']= $e->getMessage();
			$data['profile_detail'] = $_POST;
		}
		$data['sections'] = array($this->load->view('manage_profile',$data,true));
		$this->load->view('index',$data);
	}
	function edit($userid){
		try {
			$data['profile_detail'] = $this->user_model->get(array('where'=>array('userid'=>$userid)));
			if(empty($data['profile_detail'])){
				show_404('user not found');
			}
			if(!empty($_POST)){
				// print_r($_FILES);exit;
				$params = array_map('trim',$_POST);
				$params['name']=htmlentities($_POST['name']);			
				$params['phone']=$_POST['phone'];
				$insert=true;
				if(!empty($_FILES) && $_FILES['profile_pic_image']['name']!=''){
					$img_params = $_POST;
					$img_params['upload_to'] = constant('PROFILEPIC');
					$img_params['type'] = 'profile_pic';
					$img_params['FILES'] = $_FILES;
					$data_res = add_image_file_post($img_params);
					$data['error']=$data_res['message'];
					if ($data_res['status']==true) {
						$insert=true;
						$params['pic'] = $data_res['image_path'];
						// $this->user_model->insert($params);					
					} else {
						$insert=false;
					}
				}
				$data['profile_detail'] = $_POST;
				if($insert){
					$params['where']['userid']=$userid;
					// print_r($params);exit;
					$this->user_model->update($params);
					$data['error']='User Updated. Check - <a href="'.base_url('/profile/detail/'.$userid).'">'.$userid.'</a>';
				} else {					
					$data['error']='Failed to update User. please try again';
				}
			}			
		} catch (Exception $e){
			// show_error($e->getMessage());	
			$data['error']= $e->getMessage();
			$data['profile_detail'] = $_POST;
		}
		$data['sections'] = array($this->load->view('manage_profile',$data,true));
		$this->load->view('index',$data);
	} 
	function paginate($type,$action,$currentid){
		switch ($action) {
			case 'profile_detail':
			if($type=='prev'){
				$params['where'] = 'userid < '.$currentid;
				$params['order_by']['userid']='desc';
			}
			if($type=='next'){
				$params['where'] = 'userid > '.$currentid;
				$params['order_by']['userid']='asc';
			}
			$params['limit']="1";
			
			$data['profile_detail'] = $this->user_model->get($params);			
			$this->load->view('detail',$data);
			break;
		}
	}
}