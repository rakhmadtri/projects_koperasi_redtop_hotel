<?php 
class customer_model extends CI_Model
{
	public function select_customer($search='%'){
			$result	=	$this->db->query("select * from customer where hapus=0 AND (nama_customer like '%".$search."%' OR kode_customer LIKE '%".$search."%')");
			return $result->result_array();
	}
	public function select1_customer($search){
			$result	=	$this->db->query("select * from customer where kode_customer='".$search."' ");
			return $result->result_array();
	}
	public function insert_customer($nama,$email,$telfon,$alamat,$kodePT,$kodeKokab){
		$this->db->insert("customer",array(
			"nama_customer"=>$nama,
			"email"=>$email,
			"no_telfon"=>$telfon,
			"alamat"=>$alamat,
			"kode_pt"=>$kodePT,
			"kode_kokab"=>$kodeKokab
			));
		;
	}
	public function edit_customer($kode_customer,$nama_customer,$email,$no_telfon,$alamat,$kodePT,$kodeKokab){
		$this->db->update("customer",array(
			"nama_customer"=>$nama_customer,
			"email"=>$email,
			"no_telfon"=>$no_telfon,
			"alamat"=>$alamat,
			"kode_pt"=>$kodePT,
			"kode_kokab"=>$kodeKokab
			),array("kode_customer"=>$kode_customer)
		);
	}
	public function delete_customer($kode_customer){
		$this->db->update("customer",array("hapus"=>"1"),array("kode_customer"=>$kode_customer));
	}
	public function select_kota(){
		$result=	$this->db->query("SELECT * FROM master_kokab mk WHERE 1");
		return $result->result_array();
	}
}
?>