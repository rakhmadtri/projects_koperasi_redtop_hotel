<?php 
class dashboard_model extends CI_Model
{
	public function insert_chat($chat,$account_id){
		$this->db->insert("history_chat",array("chat"=>$chat,"account_id"=>$account_id));
	}
	public function select_chat(){
		$result	=	$this->db->query("SELECT * FROM history_chat hc JOIN user u ON hc.account_id=u.id ORDER BY TIMESTAMP DESC LIMIT 10 ");
		return $result->result_array();
	}
	public function all_user(){
		$result =	$this->db->query("SELECT * FROM user ORDER BY regdate DESC limit 5");
		return $result->result_array();
	}
	public function all_customer(){
		$result =	$this->db->query("SELECT * FROM customer ORDER BY kode_customer DESC limit 5");
		return $result->result_array();
	}
	public function all_order(){
		$result =	$this->db->query("SELECT * FROM transaksi ORDER BY order_id DESC limit 5");
		return $result->result_array();	
	}
	public function all_invoice(){
		$result =	$this->db->query("SELECT * FROM invoice ORDER BY no_invoice DESC limit 5");
		return $result->result_array();	
	}

}
?>