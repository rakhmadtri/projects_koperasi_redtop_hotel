<?php 
class simpanan_model extends CI_Model
{

	public function insert($data)
	{
		$this->db->insert("transaksi_simpanan", $data);
		return $this->db->insert_id();
	}
	public function insert_jenis_simpanan($nama_simpanan,$keterangan){
		$this->db->insert("master_jenis_simpanan",array("nama_simpanan"=>$nama_simpanan,"keterangan"=>$keterangan));
		return $this->db->insert_id();
	}
	public function insert_transaksi_simpanan($no_anggota,$total_simpanan){
		$this->db->insert("transaksi_simpanan",array("no_anggota"=>$no_anggota,"total_simpanan"=>$total_simpanan));
		return $this->db->insert_id();
	}
	public function insert_transaksi_simpanan_detail($data_detail){
		$this->db->insert_batch("transaksi_simpanan_detail",$data_detail);
	}
	public function edit_jenis_simpanan($kode_jenis_simpanan,$nama_simpanan,$keterangan){
		$this->db->update("master_jenis_simpanan",array(
			"nama_simpanan"=>$nama_simpanan,
			"keterangan"=>$keterangan
			),array("kode_jenis_simpanan"=>$kode_jenis_simpanan)
		);
	}
	public function delete_jenis_simpanan($kode_jenis_simpanan){
		$this->db->update("master_jenis_simpanan",array("hapus"=>"1"),array("kode_jenis_simpanan"=>$kode_jenis_simpanan));
	}
	public function select_jenis_simpanan(){
		$result		=	$this->db->query("SELECT * FROM master_jenis_simpanan WHERE hapus=0 AND prioritas NOT IN (1,9)");
			return $result->result_array();
	}
	public function get_header_simpanan($transaksi_id){
		$result 	=	$this->db->query("SELECT *
											FROM transaksi_simpanan ts
											JOIN master_anggota ma ON ma.`no_anggota`=ts.`no_anggota`
											WHERE 1
											AND ts.`kode_simpanan`='".$transaksi_id."'")->result_array();
		return $result[0];
	}
	public function get_detail_simpanan($transaksi_id){
		$result 	=	$this->db->query("SELECT tsd.`kode_jenis_simpanan`,mjs.`nama_simpanan`,tsd.`jumlah_simpanan`
											FROM transaksi_simpanan ts
											JOIN transaksi_simpanan_detail tsd ON ts.`kode_simpanan`=tsd.`kode_simpanan`
											JOIN master_jenis_simpanan mjs ON mjs.`kode_jenis_simpanan`=tsd.`kode_jenis_simpanan`
											WHERE 1
											AND ts.`kode_simpanan`='".$transaksi_id."'");
		return $result->result_array();
	}
}
?>