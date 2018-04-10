<?php 
/**
* 
*/
class departemen_model extends CI_model
{
	
	public function select_departemen($search='%'){
			$result	=	$this->db->query("SELECT * FROM master_departemen WHERE 1 AND (nama_departemen like '%".$search."%' OR kode_departemen LIKE '%".$search."%')");
			return $result->result_array();
	}
	public function select1_departemen($search){
			$result	=	$this->db->query("SELECT * FROM master_departemen WHERE 1 AND kode_departemen='".$search."' ");
			return $result->result_array();
	}
	public function insert_departemen($nama_departemen,$keterangan){
		// echo $nik."-".$no_rekening;
		// die();
		$this->db->insert("master_departemen",array(
			"nama_departemen"=>$nama_departemen,
			"keterangan"=>$keterangan,
			));
	}
	public function edit_departemen($kode_departemen,$nama_departemen,$keterangan){
		$this->db->update("master_departemen",array(
			"nama_departemen"=>$nama_departemen,
			"keterangan"=>$keterangan,
			),array("kode_departemen"=>$kode_departemen)
		);
	}
	public function delete_departemen($kode_departemen){
		$this->db->update("master_departemen",array("hapus"=>"1"),array("kode_departemen"=>$kode_departemen));
	}

}
 ?>