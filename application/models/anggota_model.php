<?php 
/**
* 
*/
class anggota_model extends CI_model
{
	
	public function select_anggota_all($search='%'){
			$result	=	$this->db->query("SELECT * FROM master_anggota ma
											JOIN master_jabatan mb ON ma.jabatan=mb.kode_jabatan
											JOIN master_departemen md ON ma.departemen=md.kode_departemen
											WHERE ma.hapus=0 AND (nama like '%".$search."%' OR no_anggota LIKE '%".$search."%')");
			return $result->result_array();
	}

	public function select_anggota($search='%'){
			$result	=	$this->db->query("SELECT * FROM master_anggota WHERE hapus=0 AND (nama like '%".$search."%' OR no_anggota LIKE '%".$search."%' OR nik LIKE '%".$search."%')");
			return $result->result_array();
	}
	public function autocomplete_select_anggota($search){
			$result	=	$this->db->query("SELECT * FROM master_anggota WHERE hapus=0 AND no_anggota='".$search."'");
			return $result->result_array();
	}
	public function select1_anggota($search){
			$result	=	$this->db->query("SELECT * FROM master_anggota WHERE no_anggota='".$search."' ");
			return $result->result_array();
	}
	public function insert_anggota($nik,$nama,$departemen,$jabatan,$alamat,$no_telpon,$no_rekening){
		// echo $nik."-".$no_rekening;
		// die();
		$this->db->insert("master_anggota",array(
			"nik"=>$nik,
			"nama"=>$nama,
			"departemen"=>$departemen,
			"jabatan"=>$jabatan,
			"alamat"=>$alamat,
			"no_telpon"=>$no_telpon,
			"no_rekening"=>$no_rekening
			));
		return $this->db->insert_id();
	}
	public function edit_anggota($no_anggota,$nik,$nama,$departemen,$jabatan,$alamat,$no_telpon,$no_rekening){
		$this->db->update("master_anggota",array(
			"nik"=>$nik,
			"nama"=>$nama,
			"no_telpon"=>$no_telpon,
			"departemen"=>$departemen,
			"jabatan"=>$jabatan,
			"alamat"=>$alamat,
			"no_telpon"=>$no_telpon,
			"no_rekening"=>$no_rekening
			),array("no_anggota"=>$no_anggota)
		);
	}
	public function delete_anggota($no_anggota){
		$this->db->update("master_anggota",array("hapus"=>"1"),array("no_anggota"=>$no_anggota));
	}







// Fungsi di bawah ini ,fungsi untuk ke yang bukan table master_anggota
	public function select_departemen(){
		$result 	=	$this->db->query("SELECT * FROM master_departemen WHERE hapus=0");
		return $result->result_array();
	}
	public function select_jabatan(){
		$result 	=	$this->db->query("SELECT * FROM master_jabatan WHERE hapus=0");
		return $result->result_array();
	}
	public function select_nominal_simpanan_pokok(){
		$result = $this->db->query("SELECT * FROM master_jenis_simpanan WHERE 1 AND hapus=0 AND prioritas=1 ");
		$result = $result->result_array();
		if (!empty($result)) {
			return $result[0];
		}
		else{
			return NULL;
		}
	}



}
 ?>