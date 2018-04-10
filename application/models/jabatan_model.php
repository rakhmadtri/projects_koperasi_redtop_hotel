<?php 
/**
* 
*/
class jabatan_model extends CI_model
{
	
	public function select_jabatan($search='%'){
			$result	=	$this->db->query("SELECT * FROM master_jabatan WHERE hapus=0 AND (nama_jabatan like '%".$search."%' OR kode_jabatan LIKE '%".$search."%')");
			return $result->result_array();
	}
	public function select1_jabatan($search){
			$result	=	$this->db->query("SELECT * FROM master_jabatan WHERE kode_jabatan='".$search."' ");
			return $result->result_array();
	}
	public function insert_jabatan($nama_jabatan, $keterangan){
		// echo $nik."-".$no_rekening;
		// die();
		$this->db->insert("master_jabatan",array(
			"nama_jabatan"=>$nama_jabatan,
			"keterangan"=>$keterangan
			));
	}
	public function edit_jabatan($kode_jabatan, $nama_jabatan, $keterangan){
		$this->db->update("master_jabatan",array(
			"nama_jabatan"=>$nama_jabatan,
			"keterangan"=>$keterangan
			),array("kode_jabatan"=>$kode_jabatan)
		);
	}
	public function delete_jabatan($kode_jabatan){
		$this->db->update("master_jabatan",array("hapus"=>"1"),array("kode_jabatan"=>$kode_jabatan));
	}
}
 ?>