<?php 

Class cicilan_model extends CI_Model{
	// JANGAN DI UBAH ,KARENA DI GUNAKAN LEBIH DARI 1 CONTROLER ,SEBAIKNYA BUAT BARU SAJA JIKA INGIN MODIF
	public function insert_cicilan($order_id,$no_angsuran,$no_anggota,$jumlah,$bunga,$cicilan_perbulan,$keterangan="",$total_pinjaman,$jatuh_tempo='1'){
		$month		=	date("m")+$jatuh_tempo;
		$year		= 	date("Y");
		$tanggal 	= 	mktime(0,0,0,$month,25,$year);
		$date_format= 	date("Y-m-d",$tanggal);

		$this->db->insert("cicilan",array("order_id"=>$order_id,"no_anggota"=>$no_anggota,"jumlah"=>$jumlah,"total_pinjaman"=>$total_pinjaman,
						  				  "bunga"=>$bunga,"cicilan_perbulan"=>$cicilan_perbulan,
						  				  "keterangan"=>$keterangan,"angsuran_ke"=>$no_angsuran,
						  				  "jatuh_tempo"=>$date_format));
	}
	public function insert($data)
	{
		$this->db->insert('cicilan',$data);
	}

	public function select_anggota($search='%'){
		$result	=	$this->db->query("SELECT * FROM master_anggota WHERE hapus=0 AND (nama like '%".$search."%' OR no_anggota LIKE '%".$search."%')");
		return $result->result_array();
	}
	public function get_cicilan(){
		$result =	$this->db->query("SELECT *
										FROM cicilan ci
										JOIN master_anggota ma 
											ON ma.`no_anggota`=ci.`no_anggota`
										WHERE 1
										AND STATUS='belum'
										AND ci.`update_timestamp` IS NULL
										GROUP by ci.`no_anggota`");
		return $result->result_array();
	}
	public function select_cicilan($params){
			$result =	$this->db->query("SELECT *,sub.count_cicilan,SUM(cicilan_perbulan) AS sisa_pinjaman
										FROM cicilan
										JOIN
											(SELECT no_anggota,COUNT(*) AS count_cicilan FROM cicilan
												WHERE 1
												AND no_anggota='".$params."') sub
										ON  sub.no_anggota=cicilan.`no_anggota`
										WHERE 1
											AND cicilan.`status`='belum'
											AND cicilan.no_anggota='".$params."'
										ORDER BY cicilan.cicilan_id ASC LIMIT 1");
			// echo $this->db->last_query();
			return $result->result_array();
	}
	public function update_pembayaran($no_pinjaman,$angsuran_ke,$tgl_pembayaran,$id_pembayaran,$keterangan){
		$this->db->update("cicilan",
							array("status"=>'lunas',"update_timestamp"=>$tgl_pembayaran,"id_pembayaran"=>$id_pembayaran),
							array("order_id"=>$no_pinjaman,"angsuran_ke"=>$angsuran_ke,"keterangan"=>$keterangan));
	}
	public function update_pembayaran_by_no_anggota($no_anggota,$tgl_pembayaran){
		$this->db->update("cicilan",array("status"=>'lunas',"update_timestamp"=>$tgl_pembayaran),array("no_anggota"=>$no_anggota));
	}
	public function get_header_cicilan($no_anggota){
		$result = $this->db->query("SELECT CONCAT(ci.`order_id`,'-',ci.`keterangan`) AS id,CONCAT(ci.`order_id`,' - ',ci.`keterangan`) AS `text` FROM cicilan ci
									WHERE 1
									AND ci.`no_anggota`=$no_anggota
									AND STATUS='belum'
									AND ci.`update_timestamp` IS NULL
									GROUP BY ci.`order_id`,ci.`keterangan`;");
		return $result->result_array();
	}
	public function get_header_cicilan_old($no_anggota){
		$result = $this->db->query("SELECT ci.`no_anggota`,ci.`order_id`,ci.`keterangan` FROM cicilan ci
									WHERE 1
									AND ci.`no_anggota`=$no_anggota
									AND STATUS='belum'
									AND ci.`update_timestamp` IS NULL
									GROUP BY ci.`order_id`,ci.`keterangan`;");
		return $result->result_array();
	}
	public function get_detail_cicilan($no_anggota,$order_id,$keterangan){
		$result =	$this->db->query("SELECT *,sub.count_cicilan,SUM(cicilan_perbulan) AS sisa_pinjaman
									FROM cicilan
									JOIN
										(SELECT no_anggota,COUNT(*) AS count_cicilan FROM cicilan
											WHERE 1
											AND keterangan='".$keterangan."'
											AND no_anggota='".$no_anggota."'
											AND order_id='".$order_id."' ) sub
										ON  sub.no_anggota=cicilan.`no_anggota`
									WHERE 1
										AND cicilan.`keterangan`='".$keterangan."'
										AND cicilan.`status`='belum'
										AND cicilan.`update_timestamp` IS NULL
										AND cicilan.no_anggota='".$no_anggota."'
										AND cicilan.`order_id`='".$order_id."'
									ORDER BY cicilan.cicilan_id ASC LIMIT 1");
		return $result->result_array();
	}
	public function get_detail_cicilan_perbulan($order_id='',$keterangan='',$jatuh_tempo=''){
		$result =	$this->db->query(" SELECT *, COUNT(*) AS 'lama_cicilan'
										 FROM cicilan ci
										 LEFT JOIN master_anggota ma ON ci.`no_anggota`=ma.`no_anggota`
										 WHERE 1
										 AND ci.`order_id`='".$order_id."'
										 AND ci.`keterangan`='".$keterangan."'
										 AND ci.`jatuh_tempo`='".$jatuh_tempo."'
										 GROUP BY ci.`order_id`,ci.`keterangan`
										 ORDER BY ci.`order_id` LIMIT 1");
		return $result->result_array();
	}

	public function get_detail_cicilan_pelunasan($no_anggota){
		$result = $this->db->query("SELECT c.`order_id`,c.`keterangan`,c.`cicilan_perbulan`,COUNT(*) AS sisa_lama_cicilan,SUM(c.`cicilan_perbulan`) AS total_sisa_angsuran
									FROM cicilan c
									WHERE 1
									AND `status`='belum'
									AND no_anggota='".$no_anggota."'
									AND update_timestamp IS NULL
									GROUP BY no_anggota,order_id");
		// echo $this->db->last_query();
		// die();
		return $result->result_array();
	}
	public function update_pembayaran_header($order_id){
		$this->db->update("transaksi_pinjaman",array("status"=>"lunas"),array("id"=>$order_id));
	}
	public function update_transaksi_pembayaran_header($order_id){
		$this->db->update("transaksi",array("payment_status"=>"lunas"),array("order_id"=>$order_id));
	}

	public function delete_cicilan($order_id='',$keterangan=''){
		$this->db->delete("cicilan",array("order_id"=>$order_id,"keterangan"=>$keterangan,"status"=>"belum"));
	}

	public function delete_cicilan_penjualan($order_id,$keterangan){
		$this->db->delete("cicilan",array("order_id"=>$order_id,"keterangan"=>$keterangan));
	}

	public function get_data_cicilan($params_array,$group_by=''){
		$this->db->from('cicilan');
		if (is_array($params_array))
		{
			foreach ($params_array as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		else
		{
			die("ERROR1");
		}

		if ($group_by!='') {
			$this->db->select_sum('cicilan_perbulan');
			$this->db->group_by($group_by);
		}

		
		$query = $this->db->get()->result_array();
		// echo $this->db->last_query();
		if (!empty($query)) {
			return $query;
		}
		else{
			return 0;

		}
	}

}

?>