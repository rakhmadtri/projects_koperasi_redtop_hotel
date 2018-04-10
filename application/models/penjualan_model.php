<?php 
class penjualan_model extends CI_Model
{
	public function insert_transaksi_header($kode_customer,$account_id,$sub_total,$ppn,$total_after_ppn,$payment_status,$cash="0",$kredit="0",$lama_cicilan="0",$payment_method="cash",$log_order_id=''){
		$this->db->insert("transaksi",
							array("kode_customer"=>$kode_customer,"account_id"=>$account_id,"total_before_ppn"=>$sub_total,
									"ppn"=>$ppn,"total_after_ppn"=>$total_after_ppn,"payment_status"=>$payment_status,
									"cash"=>$cash,"kredit"=>$kredit,"lama_cicilan"=>$lama_cicilan,
									"payment_method"=>$payment_method,"log_order_id"=>$log_order_id));
		return $this->db->insert_id();
	}

	public function insert($data)
	{
		$this->db->insert("transaksi", $data);
		return $this->db->insert_id();
	}


	public function select($select='*', $params_array='', $group_by='', $order_by='')
	{
		$this->db->select($select);
		$this->db->from('transaksi');
		$this->db->join('master_anggota','master_anggota.no_anggota = transaksi.kode_customer','left');
		if (is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (is_array($group_by)) {
			$this->db->group_by($group_by);
		}
		if (is_array($order_by)) {
			foreach ($order_by as $key => $value) {
				$this->db->order_by($value);
			}
		}
		$result = $this->db->get()->result_array();
		return $result;
	}


	// Edit Trx
	public function update_header($oldOrderId,$txtKodePelanggan,$accountId,$totalCustomerPrice,$namaup,$ppn,$totalppn){
		$this->db->update("transaksi",array("kode_customer"=>$txtKodePelanggan,"account_id"=>$accountId,"total_customer_price"=>$totalCustomerPrice,
			"payment_status"=>"lunas","up_customer"=>$namaup,"ppn"=>$ppn,"total_customer_ppn"=>$totalppn ),array("order_id"=>$oldOrderId));
	}
	public function insert_transaksi_detail($data_detail){
		$this->db->insert_batch("transaksi_detail",$data_detail);
	}
	public function delete_transaksi($order_id){
		$this->db->delete("transaksi",array("order_id"=>$order_id));
	}

	public function delete_transaksi_detail($orderIdOld){
		$this->db->delete("transaksi_detail",array("order_id"=>$orderIdOld));
		// echo $this->db->last_query();
		// die();
	}
	public function select_category($kodeBarang){
		$result =	$this->db->query("SELECT * FROM master_barang mb WHERE mb.kode_barang='".$kodeBarang."' ");
		return $result->result_array();
	}
	//Tidak jadi di gunakan
	public function click_delete_transaksi_detail($orderIdOld,$kodeBarang){
		$this->db->delete("transaksi_detail",array("order_id"=>$orderIdOld,"order_master_id"=>$kodeBarang));
	}
	public function all_transaksi($order_id="%"){
		$result	=	$this->db->query("SELECT * FROM transaksi tr 
										JOIN transaksi_detail trd ON tr.order_id=trd.order_id WHERE tr.order_id like '".$order_id."'");
		return $result->result_array();
	}
	public function all_transaksi_distinct($order_id="%"){
		$result	=	$this->db->query("SELECT tr.order_id 
										FROM transaksi tr 
											JOIN transaksi_detail trd ON tr.order_id=trd.order_id 
										WHERE 1
										AND tr.order_id like '".$order_id."' 
										AND tr.order_id NOT IN
										(SELECT order_id FROM surat_jalan)
										GROUP BY tr.order_id");
		return $result->result_array();
	}

	public function all_transaksi_distinctSpk($order_id="%"){
		$result	=	$this->db->query("SELECT tr.order_id 
										FROM transaksi tr 
											JOIN transaksi_detail trd ON tr.order_id=trd.order_id 
										WHERE 1
										AND tr.order_id like '".$order_id."' 
										AND tr.order_id NOT IN
										(SELECT order_id FROM spk)
										GROUP BY tr.order_id");
		return $result->result_array();
	}

		//Buat Cetak
	public function get_header($order_id="%"){
		$result =	$this->db->query("SELECT * FROM transaksi tr JOIN customer c ON c.kode_customer=tr.kode_customer WHERE tr.order_id='".$order_id."'");
		return count($result->result_array())> 0 ? $result->result_array()[0] : NULL;
	}
	public function get_detail($order_id="%"){
		$result =	$this->db->query("SELECT  * FROM transaksi_detail tr JOIN master_barang mb ON mb.kode_barang=tr.order_master_id WHERE tr.order_id='".$order_id."'");
		return $result->result_array();
	}
	public function get_detail_suratjalan($order_id="%"){
		$result =	$this->db->query("SELECT * 
										FROM `transaksi` tr 
										JOIN transaksi_detail td ON tr.`order_id`=td.`order_id`
										JOIN master_barang mb ON mb.`kode_barang`=td.`order_master_id`
										JOIN customer c ON c.`kode_customer`=tr.`kode_customer`
										JOIN master_cabang mc ON mc.`kode_cabang`=c.`kode_pt`
										JOIN master_kokab mk ON mk.`kota_id`=c.`kode_kokab`
										JOIN surat_jalan sj ON sj.`order_id` = tr.`order_id`
										JOIN user u ON u.`account_id` = sj.`id_teknisi`
										WHERE 1
										AND td.`order_id`='".$order_id."' ");
		return $result->result_array();
	}
	public function get_detail_spk($order_id="%"){
		$result =	$this->db->query("SELECT * 
										FROM `transaksi` tr 
										JOIN transaksi_detail td ON tr.`order_id`=td.`order_id`
										JOIN master_barang mb ON mb.`kode_barang`=td.`order_master_id`
										JOIN customer c ON c.`kode_customer`=tr.`kode_customer`
										JOIN master_cabang mc ON mc.`kode_cabang`=c.`kode_pt`");
		return $result->result_array();
	}
	public function get_penjualan($order_id){
		$result =	$this->db->query("SELECT * FROM transaksi tr 
										JOIN user u ON tr.account_id=u.account_id
										WHERE 1
										AND tr.`order_id`='".$order_id."'");
		return $result->result_array();
	}
	public function get_penjualan_detail($order_id){
		$result = 	$this->db->query("SELECT * FROM transaksi_detail trd 
										JOIN master_barang mb ON trd.`order_master_id`=mb.`kode_barang` 
										WHERE 1
										AND trd.`order_id`='".$order_id."'");
		return $result->result_array();
	}

	public function validasi_order($order_id){
		$result =	$this->db->query("SELECT * FROM transaksi tr WHERE tr.order_id ='".$order_id."' ");
		return $result->result_array();
	}
	public function insert_surat2($teknisi,$order_id){
		$this->db->insert("surat_jalan",array("id_teknisi"=>$teknisi,"order_id"=>$order_id));
	}
	public function insert_surat3($teknisi,$order_id){
		$this->db->insert("spk",array("id_teknisi"=>$teknisi,"order_id"=>$order_id));
	}
	public function select_surat_jalan(){
		$result =	$this->db->query("SELECT * FROM surat_jalan");
		return $result->result_array();
	}
	public function delete_surat_jalan($orderId){
		$this->db->delete("surat_jalan",array("order_id"=>$orderId));
	}
	public function insert_invoice($no_invoice,$order_id,$payment_amount){
		$this->db->insert("invoice",array("no_invoice"=>$no_invoice,"order_id"=>$order_id,"payment_amount"=>$payment_amount));
	}
	public function update_invoice($order_id,$flag){
		$query	=	$this->db->update("invoice",array("payment_flag"=>$flag),array("order_id"=>$order_id));
	}
	public function update_trx_invoice($no_invoice,$payment_amount){
		$this->db->update("invoice",array("payment_amount"=>$payment_amount,"flag"=>0),array("no_invoice"=>$no_invoice));
	}
	//Buat Report
		// public function all_penjualan($from="1900-01-01",$to="3000-01-01"){
	public function all_penjualan($from,$to,$status="%",$masterKota="%"){
		$data		=		$this->db->query("SELECT p.order_id,p.order_timestamp,u.nama,p.total_customer_price,c.`nama_customer`,
													nama_cabang,kokab_nama,inv.payment_flag
												FROM `transaksi` p
												JOIN `customer` c ON c.kode_customer=p.kode_customer
												JOIN USER u ON u.`account_id`=p.`account_id`
												JOIN master_cabang mc ON mc.kode_cabang=c.kode_pt
												JOIN master_kokab mk ON mk.kota_id=c.kode_kokab
												JOIN invoice inv ON inv.order_id=p.order_id
												WHERE 1
												AND inv.`payment_flag` LIKE '%".$status."%'
												AND mk.kota_id	LIKE '%".$masterKota."%'
												AND p.order_timestamp>='".$from."'
												AND p.order_timestamp<='".$to."'");
		return $data->result_array();
	}
	public function all_penjualan_now(){
		$data		=		$this->db->query("SELECT p.order_id,p.order_timestamp,u.nama,p.total_customer_price,c.`nama_customer`,
													nama_cabang,kokab_nama,inv.payment_flag
												FROM `transaksi` p
												JOIN `customer` c ON c.kode_customer=p.kode_customer
												JOIN USER u ON u.`account_id`=p.`account_id`
												JOIN master_cabang mc ON mc.kode_cabang=c.kode_pt
												JOIN master_kokab mk ON mk.kota_id=c.kode_kokab
												JOIN invoice inv ON inv.order_id=p.order_id
												WHERE 1
												AND p.payment_status='LUNAS'");
		return $data->result_array();
	}
	public function create_invoice($order_id){
		$query	=	$this->db->query("SELECT tr.`order_id`,trd.`order_detail_id`,cu.`nama_customer`,tr.`order_timestamp`,tr.`total_customer_price`,tr.ppn,tr.total_customer_ppn,
											trd.`selling_price`,trd.`sub_total`,trd.`qty`,mb.`nama_barang`,mb.`deskripsi`,mb.`license`,i.`no_invoice`,mb.category
										FROM transaksi tr 
										JOIN transaksi_detail trd ON tr.`order_id`=trd.`order_id`
										JOIN customer cu ON cu.`kode_customer`=tr.`kode_customer`
										JOIN master_barang mb ON mb.`kode_barang`=trd.`order_master_id`
										JOIN invoice i ON i.`order_id`=tr.`order_id`
									WHERE 1
									AND tr.`order_id`='".$order_id."'
									ORDER BY mb.category ASC ");
		return $query->result_array();
	}
	public function create_invoice2($order_id){
		$query	=	$this->db->query("SELECT tr.`order_id`,trd.`order_detail_id`,cu.`nama_customer`,cu.`no_telfon`,mk.`kokab_nama`,tr.`order_timestamp`,tr.`total_customer_price`,tr.ppn,tr.total_customer_ppn,
											tr.`up_customer`,trd.`selling_price`,trd.`sub_total`,trd.`qty`,mb.`nama_barang`,mb.`deskripsi`,mb.`license`,i.`no_invoice`,mb.category
										FROM transaksi tr 
										JOIN transaksi_detail trd ON tr.`order_id`=trd.`order_id`
										JOIN customer cu ON cu.`kode_customer`=tr.`kode_customer`
										JOIN master_barang mb ON mb.`kode_barang`=trd.`order_master_id`
										JOIN master_kokab mk ON mk.`kota_id` = cu.`kode_kokab`
										JOIN invoice i ON i.`order_id`=tr.`order_id`
									WHERE 1
									AND tr.`order_id`='".$order_id."'
									
									ORDER BY mb.category ASC ");
		return $query->result_array();
	}


	public function create_kwitansi($order_id){
		$result =	$this->db->query("SELECT invoice.`no_invoice`,invoice.`payment_amount`,transaksi.`currency`,mb.`nama_barang`,
											transaksi.`order_id`,mc.`kode_cabang`,mc.`nama_cabang`,c.`nama_customer`
										FROM invoice 
											JOIN transaksi ON invoice.`order_id`=transaksi.`order_id`
											JOIN transaksi_detail trd ON transaksi.`order_id`=trd.`order_id`
											JOIN customer c ON c.`kode_customer`=transaksi.`kode_customer`
											JOIN master_cabang mc ON c.`kode_pt`=mc.`kode_cabang`
											JOIN master_barang mb ON mb.`kode_barang`=trd.`order_master_id`
										WHERE 1
											AND transaksi.`order_id`='".$order_id."'");
		return $result->result_array();
	}

	public function select_transaksi($order_id){
		$result 	= $this->db->query("SELECT *
										FROM transaksi pe 
											JOIN transaksi_detail pd ON pe.`order_id`=pd.`order_id`
											JOIN customer cu ON cu.kode_customer=pe.kode_customer
											JOIN master_barang mb ON mb.`kode_barang`=pd.`order_master_id`
											JOIN `master_cabang` mc ON mc.`kode_cabang`=cu.`kode_pt`
											JOIN master_kokab mk ON mk.`kota_id`=cu.`kode_kokab`
										WHERE 1
											AND pe.`order_id`='".$order_id."' ");
		return $result->result_array();
	}
    public function report_rugi_laba_now(){
        $result =   $this->db->query("SELECT mb.`kode_barang`,mb.`nama_barang`,jual.total AS total_jual,beli.total AS total_beli,(IFNULL(jual.total,0)-IFNULL(beli.total,0)) AS keuntungan
										FROM master_barang mb 
										LEFT JOIN
										(SELECT trd.`order_master_id` AS kode,SUM(trd.`sub_total`) AS total FROM transaksi tr 
										JOIN transaksi_detail trd ON tr.`order_id`=trd.`order_id`
										JOIN invoice inv ON tr.`order_id`=inv.`order_id`
										WHERE 1
										AND tr.`payment_status`='LUNAS'
										AND inv.`payment_flag`=2
										GROUP BY trd.`order_master_id`)jual ON jual.kode=mb.`kode_barang`
										LEFT JOIN
										(SELECT pd.`order_master_id` AS kode,SUM(pd.`sub_total`) AS total FROM 
										pembelian pe JOIN pembelian_detail pd ON pe.`order_id`=pd.`order_id`
										WHERE 1
										AND pe.`payment_status`='LUNAS'
										GROUP BY pd.`order_master_id`)beli ON beli.kode=mb.`kode_barang`");
	// echo $this->db->last_query();
  		return $result->result_array();
    }
    public function report_rugi_laba($from,$to){
        $result =   $this->db->query("SELECT mb.`kode_barang`,mb.`nama_barang`,jual.total AS total_jual,beli.total AS total_beli,(IFNULL(jual.total,0)-IFNULL(beli.total,0)) AS keuntungan
										FROM master_barang mb 
										LEFT JOIN
										(SELECT trd.`order_master_id` AS kode,SUM(trd.`sub_total`) AS total FROM transaksi tr 
										JOIN transaksi_detail trd ON tr.`order_id`=trd.`order_id`
										JOIN invoice inv ON tr.`order_id`=inv.`order_id`
										WHERE 1
										AND tr.`payment_status`='LUNAS'
										AND inv.`payment_flag`=2
										AND inv.`payment_timestamp`>='".$from." 00:00:00'
										AND inv.`payment_timestamp`<='".$to." 23:59:59'
										GROUP BY trd.`order_master_id`)jual ON jual.kode=mb.`kode_barang`
										LEFT JOIN
										(SELECT pd.`order_master_id` AS kode,SUM(pd.`sub_total`) AS total FROM 
										pembelian pe JOIN pembelian_detail pd ON pe.`order_id`=pd.`order_id`
										WHERE 1
										AND pe.`order_timestamp`>='".$from." 00:00:00'
										AND pe.`order_timestamp`<='".$to." 23:59:59'
										AND pe.`payment_status`='LUNAS'
										GROUP BY pd.`order_master_id`)beli ON beli.kode=mb.`kode_barang`");
// echo $this->db->last_query();
		return $result->result_array();
    }
    public function get_grafik(){
    	$result =	$this->db->query("SELECT DATE_FORMAT(iv.`payment_timestamp`,'%M-%Y') AS '0',SUM(tr.`total_customer_price`) AS '1' FROM transaksi tr 
										JOIN invoice iv ON tr.`order_id`=iv.`order_id`
										WHERE 1 
										AND iv.`payment_flag`=2
										AND tr.`payment_status`='LUNAS'
										GROUP BY DATE_FORMAT(iv.`payment_timestamp`,'%M%')");
    	// echo $this->db->last_query();
    	return $result->result_array();
    }
    // Buat Grafik di home
    // Product terlaris berdasarkan master barang dan periode
    //$dateFrom,$dateTo,$kodeBarang
    public function sell_by_product_month(){
    	$result 	=	$this->db->query("SELECT DATE_FORMAT(inv.`payment_timestamp`,'%Y-%m') AS bulan,SUM(trd.`sub_total`) AS totalPrice,SUM(trd.`qty`) AS totalQty,mb.`nama_barang`
							FROM transaksi tr
							JOIN transaksi_detail trd ON tr.`order_id`=trd.`order_id`
							JOIN master_barang mb ON trd.`order_master_id`=mb.`kode_barang`
							JOIN invoice inv ON inv.`order_id`=tr.`order_id`
							WHERE 1
							AND tr.`payment_status`='LUNAS'
							AND inv.`payment_flag`=2
							AND inv.`payment_timestamp`>='2015-01-01'
							AND inv.`payment_timestamp`<='3000-12-12'
							GROUP BY trd.`order_master_id`,MONTH(inv.`payment_timestamp`)");
    	// echo $this->db->last_query();
    	return $result->result_array();
    }
    //Table lain dari Model lain
	public function select_anggota($search='%'){
			$result	=	$this->db->query("SELECT * FROM master_anggota ma
											JOIN master_departemen md ON ma.`departemen`=md.`kode_departemen` 
											WHERE ma.`hapus`=0 AND (ma.`nama` like '%".$search."%' OR ma.`no_anggota` LIKE '%".$search."%')");
			return $result->result_array();
	}
	public function select_nota($order_id){
		$result 	=		$this->db->query("SELECT t.`order_id`,t.`kode_customer`,
												DATE_FORMAT(t.`order_timestamp`, '%Y/%m/%d') AS tgl_nota,
												ma.`nama`, mb.`kode_barang`, mb.`nama_barang`,	td.`qty`, 
												td.`selling_price`, t.`total_before_ppn`, td.`sub_total`,
												t.`ppn`, t.`total_after_ppn`, t.`kredit`, t.`cash`
											FROM transaksi t
												JOIN transaksi_detail td ON t.`order_id`=td.`order_id`
												JOIN master_barang mb ON mb.`kode_barang`=td.`order_master_id`
												LEFT JOIN master_anggota ma ON ma.`no_anggota`=t.`kode_customer`
											WHERE td.`order_id` = '".$order_id."'");
		return $result->result_array();
	}
	public function select_hutang_anggota($no_anggota){
		$result 	=		$this->db->query("SELECT cicilan.`no_anggota`,SUM(cicilan.`cicilan_perbulan`) AS total_hutang_inventory
												FROM cicilan 
												WHERE 1
												AND cicilan.`keterangan`='transaksi_penjualan'
												AND cicilan.`update_timestamp` IS NULL
												AND cicilan.`status`='belum'
												AND cicilan.`no_anggota`=$no_anggota
												GROUP BY cicilan.`no_anggota`")->result_array();
		if (!empty($result)) 
		{
			return $result[0]['total_hutang_inventory'];
		}
		else
		{
			return 0;
		}	
	}
	public function get_detail_barang($kode_barang){
		$result 	=		$this->db->query("SELECT * 
												FROM master_barang mb 
												WHERE 1
												AND mb.`kode_barang`='".$kode_barang."'")->result_array();
		return $result[0];
	}

	public function get_sales_anggota(){
		$result = $this->db->query(" SELECT * FROM `transaksi` tr
			 						JOIN master_anggota ma ON tr.`kode_customer`=ma.`no_anggota`
									WHERE 1
			 						AND tr.`update` IS NULL")->result_array();

		return $result;
	}

	public function get_transaksi(){
		$result = $this->db->query("SELECT * FROM transaksi")->result_array();
		return $result;
	}

	public function get_detail_Sales($order_id){
		$result = $this->db->query(" SELECT * FROM `transaksi` tr
			 						JOIN transaksi_detail trd ON tr.`order_id`=trd.`order_id`
			 						JOIN master_barang mb ON mb.kode_barang=trd.order_master_id
			 						WHERE 1
			 						AND tr.`order_id`='".$order_id."'")->result_array();

		return $result;	
	}

	public function update_transaksi($order_id, $cash, $kredit,$payment_status='cicilan', $lama_cicilan='1', $old_data){
		$this->db->update("transaksi",array("cash"=>$cash,"kredit"=>$kredit,"payment_status"=>$payment_status,"lama_cicilan"=>$lama_cicilan, "update"=>$old_data), array("order_id"=>$order_id));
	}

	public function insert_log_penjualan($order_id,$data_penjualan,$data_pinjaman,$data_pembayaran){
		$this->db->insert("log_transaksi_penjualan",array("order_id"=>$order_id,"transaksi"=>$data_penjualan,"pinjaman"=>$data_pinjaman,"pembayaran"=>$data_pembayaran));
	}

	public function delete_stok_penjualan($params_array){
		$this->db->delete("stok_barang",$params_array);
	}
}
?>