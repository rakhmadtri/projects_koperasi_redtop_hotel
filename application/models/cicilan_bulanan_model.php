<?php 
Class cicilan_bulanan_model extends CI_Model{

	public function select_cicilan_bulanan($tahun_bulan='',$no_anggota="%",$departemen="",$start=0,$perpage=2){
		if ($no_anggota=="%" || $no_anggota=='') {
			$params1 = "LIKE '%".$no_anggota."%'";
		}
		else{
			$params1 = " = $no_anggota";
		}
		if ($departemen=='') {
			$params2 = "LIKE '%".$departemen."%'";
		}
		else{
			$params2 = " = $departemen";
		}
		$result	=	$this->db->query("SELECT * 
										FROM cicilan ci
										JOIN master_anggota ma ON ci.`no_anggota`=ma.`no_anggota`
										WHERE 1
										AND ma.`no_anggota` $params1
										AND ma.`departemen` $params2
										AND status='belum'
										AND ci.`update_timestamp` IS NULL
										AND LEFT(jatuh_tempo,7)='".$tahun_bulan."'
										LIMIT $start,$perpage");
		return $result->result_array();
	}
	public function list_departemen_anggota($kode_departemen,$no_anggota){
		$result =	$this->db->query("SELECT ma.`nama`,md.`nama_departemen`,md.`kode_departemen`
										FROM master_anggota ma
										JOIN master_departemen md ON ma.`departemen`=md.`kode_departemen`
										WHERE 1
											AND ma.`hapus`=0 
											AND md.`hapus`=0
											AND md.`kode_departemen` LIKE '%".$kode_departemen."%'
											AND ma.`no_anggota` LIKE '%".$no_anggota."%'");
		// die();
		return $result->result_array();
	}
	public function select_departemen($search='%'){
		$result	=	$this->db->query("SELECT * FROM master_departemen WHERE 1 AND (nama_departemen like '%".$search."%' OR kode_departemen LIKE '%".$search."%')");
		return $result->result_array();
	}
	public function select_bulan_jatuh_tempo(){
		$result =	$this->db->query("SELECT DATE_FORMAT(jatuh_tempo,'%Y-%m') AS bulan
										FROM cicilan
										WHERE 1
										AND `status`='belum'
										AND update_timestamp IS NULL
										GROUP BY DATE_FORMAT(jatuh_tempo,'%Y-%m')
										ORDER BY bulan ASC");
		return $result->result_array();
	}
	public function update_cicilan_bulanan($data){
		foreach ($data as $key => $value) {
			$this->db->update("cicilan",array("update_timestamp"=>$value['update_timestamp'],"status"=>$value["status"],"id_pembayaran"=>$value["id_pembayaran"]),
										array("order_id"=>$value['order_id'],"jatuh_tempo"=>$value['jatuh_tempo']."-25"));
		}
	}
	public function count_cicilan_bybulan($bulan_proses,$no_anggota="%",$departemen="%"){
		$result =	$this->db->query("SELECT * 
										FROM cicilan ci
										JOIN master_anggota ma ON ci.`no_anggota`=ma.`no_anggota`
										WHERE 1
										AND ma.`nik` LIKE '%".$no_anggota."%'
										AND ma.`departemen` LIKE '%".$departemen."%'
										AND status='belum'
										AND ci.`update_timestamp` IS NULL
										AND LEFT(jatuh_tempo,7)='".$bulan_proses."'");
		return count($result->result_array());
	}
}
?>