<?php 
class resign_model extends CI_Model
{
	public function insert_transaksi_resign($no_anggota,$keterangan){
		$this->db->insert("resign",array("no_anggota"=>$no_anggota,"keterangan"=>$keterangan));
		return $this->db->insert_id();
	}
	public function insert_transaksi_penarikan($data_detail){
		$this->db->insert_batch("transaksi_penarikan",$data_detail);
	}
	public function select_no_penarikan($search='%'){
		$result	=	$this->db->query("SELECT * FROM resign WHERE 1 AND status=0 AND (NoPengunduranDiri like '%".$search."%')");
		return $result->result_array();
	}
	public function update_status_anggota($no_anggota){
		$this->db->update("master_anggota",array("hapus"=>2),array("no_anggota"=>$no_anggota));
	}
	// Salah
	public function select_penarikan_all($no_pengunduran){
		$result	=	$this->db->query("SELECT r.`NoPengunduranDiri`, ts.`no_anggota`, ma.`nama`, tsd.`kode_jenis_simpanan`,
									 mjs.`nama_simpanan`, SUM(tsd.`jumlah_simpanan`) AS 
						 			jumlah_simpanan FROM transaksi_simpanan ts
									JOIN resign r ON r.`no_anggota`=ts.`no_anggota`
									JOIN transaksi_simpanan_detail tsd ON ts.`kode_simpanan`=tsd.`kode_simpanan`
									JOIN master_jenis_simpanan mjs ON mjs.`kode_jenis_simpanan`=tsd.`kode_jenis_simpanan`
									JOIN master_anggota ma ON ma.`no_anggota`=ts.`no_anggota`
									WHERE r.`NoPengunduranDiri` = '".$no_pengunduran."' GROUP BY tsd.kode_jenis_simpanan;
									");
		if (!empty($result)) {
			return $result->result_array()[0];
		}
		else{
			return NULL;
		}
	}

	public function select_list_simpanan(){
		$result =	$this->db->query("SELECT *
									FROM master_jenis_simpanan mjs
									WHERE 1
									AND mjs.`hapus`=0");
		return $result->result_array();
	}
	public function get($no_pengunduran_diri){
		$result =	$this->db->query("SELECT *
										FROM resign r
										JOIN master_anggota ma ON r.`no_anggota`=ma.`no_anggota`
										WHERE 1
										AND ma.`hapus`=2
										AND r.`NoPengunduranDiri`='".$no_pengunduran_diri."'");
		if (!empty($result)) {
			return $result->result_array()['0'];
		}
		else{
			return NULL;
		}
	}
	public function get_detail_penarikan($no_anggota){
		$result =	$this->db->query("SELECT mjs.`nama_simpanan`,SUM(tsd.`jumlah_simpanan`) AS jumlah_simpanan,mjs.`kode_jenis_simpanan`
										FROM master_jenis_simpanan mjs
										LEFT JOIN transaksi_simpanan_detail tsd ON mjs.`kode_jenis_simpanan`=tsd.`kode_jenis_simpanan` 
										LEFT JOIN transaksi_simpanan ts ON ts.`kode_simpanan`=tsd.`kode_simpanan` 
										WHERE 1
										AND ts.`no_anggota`='".$no_anggota."'
										GROUP BY ts.`no_anggota`,tsd.`kode_jenis_simpanan`");
		return $result->result_array();
	}
	public function insert_table_transaksi_penarikan($data){
		$this->db->insert_batch("transaksi_penarikan",$data);
	}
	public function update_resign($no_pengunduran_diri){
		$this->db->update("resign",array("status"=>1),array("NoPengunduranDiri"=>$no_pengunduran_diri));
	}

}
 ?>