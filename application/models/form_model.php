<?php 	
	class form_model extends CI_Model{
	
	public function cek_validation($txtInput){
		$result		=	$this->db->query("SELECT email FROM user WHERE 1 AND status=1 AND email='".$txtInput."'");
		return $result->result_array();
	}

}


 ?>