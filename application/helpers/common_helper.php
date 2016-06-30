<?php

function add_image_file_post($params,$rand=0){
	$data=array();
	$target_dir=$params['upload_to'];
	if($params['type']==''){
		$params['type']='category';
	}

	if($rand == 1){
		$file = mt_rand(1000,9999).'-'.basename($params['FILES'][$params['type'].'_image']["name"]);	
	} else {
		$file = basename($params['FILES'][$params['type'].'_image']["name"]);		
	}
	$target_file = $target_dir.$file;	
	$info = getimagesize($params['FILES'][$params['type'].'_image']['tmp_name']);
	if (!$info) {
		$data['status']=false;
		$data['message']='File is not an image';
	} else if (move_uploaded_file($_FILES[$params['type'].'_image']['tmp_name'], $target_file)) {
		$data['status']=true;
		$data['message']='File is uploaded';
		$data['image_path']=$file;
	}
	return $data;
}
function title_case($str){
	return ucwords(strtolower($str));
}
?>