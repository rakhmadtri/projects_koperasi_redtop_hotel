<?php 
class cabang_model extends CI_Model
{
	public function select_cabang($search='%'){
			$result	=	$this->db->query("select * from master_cabang where hapus=0 AND (nama_cabang like '%".$search."%' OR kode_cabang LIKE '%".$search."%') GROUP BY nama_cabang");
			return $result->result_array();
	}
	//buat autocomplete
	public function select_cabang_trx($kode_pt,$kota_id){
			$result	=	$this->db->query("SELECT *
											FROM customer c
											JOIN master_cabang mc ON mc.`kode_cabang`=c.`kode_pt`
											JOIN master_kokab mk ON mk.`kota_id`=c.`kode_kokab`
											WHERE 1
											AND c.hapus=0
											AND c.`kode_pt`='".$kode_pt."'
											AND mk.kota_id ='".$kota_id."' ");
			return $result->result_array();
	}
	public function select1_cabang($search='%'){
			$result	=	$this->db->query("select * from master_cabang WHERE hapus=0 AND status=1 AND (nama_cabang like '%".$search."%' OR kode_cabang like '%".$search."%' OR deskripsi like '%".$search."%')");
			return $result->result_array();
	}
	//buat Autocomplete di transaksi penjualan
	public function select_kota($params){
		$result =	$this->db->query("SELECT * FROM customer c
							JOIN master_cabang mc ON c.`kode_pt`=mc.`kode_cabang`
							JOIN master_kokab mk ON c.`kode_kokab`=mk.`kota_id`
							WHERE 1 AND c.kode_pt='".$params."'
							GROUP by mk.kota_id ");
		return $result->result_array();
	}
	public function insert_cabang($nama_cabang,$deskripsi){
		$this->db->insert("master_cabang",array(
			"nama_cabang"=>$nama_cabang,
			"deskripsi"=>$deskripsi
			));
		;
	}
	public function cek_nama($nama_cabang){
		$result = $this->db->query("select * from master_cabang where nama_cabang ='".$nama_cabang."' and hapus = 0 ");
		return $result->result_array();

	}
	public function edit_cabang($kode_cabang,$nama_cabang,$deskripsi){
		$this->db->update("master_cabang",array(
			"nama_cabang"=>$nama_cabang,
			"deskripsi"=>$deskripsi
			),array("kode_cabang"=>$kode_cabang)
		);
	}
	public function delete_cabang($kode_cabang){
		$this->db->update("master_cabang",array("hapus"=>"1"),array("kode_cabang"=>$kode_cabang));
	}
}
?>