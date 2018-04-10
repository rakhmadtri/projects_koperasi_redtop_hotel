<?php 
class supplier_model extends CI_Model
{
	public function select_supplier($search='%'){
			$result	=	$this->db->query("select * from master_supplier where hapus=0 AND nama_supplier like '%".$search."%'");
			return $result->result_array();
	}
	public function select1_supplier($search){
			$result	=	$this->db->query("select * from master_supplier where hapus=0 AND kode_supplier='".$search."' ");
			return $result->result_array();
	}
	public function insert_supplier($nama,$email,$telfon,$alamat){
		$this->db->insert("master_supplier",array(
			"nama_supplier"=>$nama,
			"email"=>$email,
			"no_telfon"=>$telfon,
			"alamat"=>$alamat
			));
		;
	}
	public function edit_supplier($kode_supplier,$nama_supplier,$email,$no_telfon,$alamat){
		$this->db->update("master_supplier",array(
			"nama_supplier"=>$nama_supplier,
			"email"=>$email,
			"no_telfon"=>$no_telfon,
			"alamat"=>$alamat
			),array("kode_supplier"=>$kode_supplier)
		);
	}
	public function	delete_supplier($kode_supplier){
		$this->db->update("master_supplier",array("hapus"=>"1"),array("kode_supplier"=>$kode_supplier));
	}
}
?>