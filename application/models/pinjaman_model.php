<?php 
class pinjaman_model extends CI_Model
{
	public function insert_transaksi_pinjaman($pinjaman_id,$no_anggota,$jumlah_pinjaman,$lama_cicilan,$bunga,$keterangan,$total_pinjaman){
		$this->db->insert("transaksi_pinjaman",array("pinjaman_id"=>$pinjaman_id,"no_anggota"=>$no_anggota,"jumlah_pinjaman"=>$jumlah_pinjaman,
			"total_pinjaman"=>$total_pinjaman,"lama_cicilan"=>$lama_cicilan,"bunga"=>$bunga,"keterangan"=>$keterangan));
		return $this->db->insert_id();
	}

	public function insert($data)
	{
		$this->db->insert("transaksi_pinjaman",$data);
		return $this->db->insert_id();	
	}

	public function select($select='*',$params_array=null, $group_by=null)
	{
		$this->db->select($select);
		$this->db->from('transaksi_pinjaman');
		$this->db->join('master_anggota','master_anggota.no_anggota = transaksi_pinjaman.no_anggota');
		if (is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (is_array($group_by)) {
			$this->db->group_by($group_by);
		}
		$result = $this->db->get()->result_array();
		return $result;

	}

	public function get_order_id(){
		$result = $this->db->query("SELECT * FROM transaksi_pinjaman");
		return $result->num_rows();
	}
	public function select_anggota($search='%'){
		$result	=	$this->db->query("SELECT * FROM master_anggota WHERE hapus=0 AND (nama like '%".$search."%' OR no_anggota LIKE '%".$search."%')");
		return $result->result_array();
	}
	public function select_nominal($search='%'){
		$result	=	$this->db->query("SELECT * FROM config_pinjaman WHERE 1 AND (jumlah_pinjaman like '%".$search."%')");
		return $result->result_array();
	}
	// Buat Ajax JS
	public function select_set_nominal($search){
		$result	=	$this->db->query("SELECT * FROM config_pinjaman WHERE 1 AND jumlah_pinjaman='".$search."'");
		return $result->result_array();
	}
	public function select_pinjaman($no_anggota){
		$result =	$this->db->query("SELECT no_anggota,SUM(cicilan_perbulan) AS total_hutang FROM cicilan 
										WHERE 1 
									  AND keterangan='transaksi_pinjaman'
									  AND no_anggota='".$no_anggota."'	
									  AND `status`='belum' GROUP BY no_anggota");
		return $result->result_array();
	}
	public function select_max_pinjaman($type="pinjaman_inventory"){
		$result =	$this->db->query("SELECT nominal_max FROM config_nominal_pinjaman WHERE 1 AND type='".$type."' ORDER BY id DESC");
		return $result->result_array();
	}
	public function get_header_pinjaman($transaksi_id){
		$result =	$this->db->query("SELECT *
										FROM transaksi_pinjaman tp
										JOIN master_anggota ma ON tp.`no_anggota`=ma.`no_anggota`
										WHERE 1
										AND id='".$transaksi_id."'")->result_array();
		return $result[0];
	}
	public function update_pembayaran_header($no_anggota){
		$this->db->update("transaksi_pinjaman",array("status"=>"lunas"),array("no_anggota"=>$no_anggota));
	}
}
 ?>