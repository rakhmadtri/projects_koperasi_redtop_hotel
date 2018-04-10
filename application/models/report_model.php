<?php 
/**
* 
*/
class report_model extends CI_model{
	var $year;

	public function __construct(){
		$this->year =date("Y");
	}

	public function select_import($params_array='')
	{
		$this->db->select('*');
		$this->db->from('import_data');
		if (is_array($params_array)) {
			$this->db->where($params_array);
		}
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function get_transaksi_pembelian(){

	}
	//Buat Report
	public function select_stok_product($from,$to){
		$result =	$this->db->query("SELECT mb.`kode_barang`,mb.`nama_barang`,
											SUM(CASE WHEN sb.`status`='barangmasuk' THEN sb.`qty` END)'barangmasuk',
											SUM(CASE WHEN sb.`status`='barangkeluar' THEN sb.`qty` END)'barangkeluar',
											SUM(CASE WHEN sb.`status`='opname' THEN sb.`qty` END)'opname',
											sub.qty
										FROM master_barang mb 
										JOIN stok_barang sb ON mb.kode_barang=sb.kode_barang
										JOIN
											(SELECT a.`kode_barang`,SUM(a.`qty`) AS qty 
											FROM stok_barang a WHERE 1
											AND a.`timestamp`>='".$from." 00:00:00' 
											AND a.`timestamp`<='".$to." 23:59:59' 
											GROUP BY a.`kode_barang`)sub
											ON sub.kode_barang=mb.`kode_barang`
										WHERE 1
											AND mb.`type`!='jasa'
											AND sb.`timestamp`>='".$from." 00:00:00' 
											AND sb.`timestamp`<='".$to." 23:59:59' 
										GROUP BY sb.`kode_barang`");
		return $result->result_array();
	}
	public function select_stok_product_all(){
		$result =	$this->db->query("SELECT mb.`kode_barang`,mb.`nama_barang`,mb.`harga_jual`,
											SUM(CASE WHEN sb.`status`='barangmasuk' THEN sb.`qty` END)'barangmasuk',
											SUM(CASE WHEN sb.`status`='barangkeluar' THEN sb.`qty` END)'barangkeluar',
											SUM(CASE WHEN sb.`status`='opname' THEN sb.`qty` END)'opname',
											sub.qty
										FROM master_barang mb 
										JOIN stok_barang sb ON mb.kode_barang=sb.kode_barang
										JOIN
											(SELECT a.`kode_barang`,SUM(a.`qty`) AS qty 
											FROM stok_barang a WHERE 1
											GROUP BY a.`kode_barang`)sub
											ON sub.kode_barang=mb.`kode_barang`
										WHERE 1
										AND mb.`type`!='jasa'
										GROUP BY sb.`kode_barang`");
		// echo $this->db->last_query();
		return $result->result_array();
	}
	// Buat report Penjualan Ex jayabaru
	// public function all_penjualan($from,$to,$status="%"){
	// 	$data		=		$this->db->query("SELECT p.order_id,p.order_timestamp,u.nama,p.total_after_ppn
	// 											FROM `transaksi` p
	// 											JOIN `customer` c ON c.kode_customer=p.kode_customer
	// 											JOIN USER u ON u.`account_id`=p.`account_id`
	// 											WHERE 1
	// 											AND inv.`payment_status` LIKE '%".$status."%'
	// 											AND p.order_timestamp>='".$from."'
	// 											AND p.order_timestamp<='".$to."'");
	// 	return $data->result_array();
	// }
	// public function all_penjualan_now(){
	// 	$data		=		$this->db->query("SELECT p.order_id,p.order_timestamp,u.nama,p.total_after_ppn
	// 											FROM `transaksi` p
	// 											JOIN USER u ON u.`account_id`=p.`account_id`
	// 											WHERE 1
	// 											AND p.payment_status='LUNAS'");
	// 	return $data->result_array();
	// }
	//Buat report pembelian
	public function all_pembelian($from='1970-01-01',$to='2025-12-31'){
		$data		=		$this->db->query("SELECT p.`order_id`,p.`order_timestamp`,u.`nama`,p.`status`,p.`total_transaksi`,s.`nama_supplier`
												FROM `pembelian` p
												JOIN `master_supplier` s ON p.`kode_supplier`=s.`kode_supplier`
												JOIN USER u ON u.`account_id`=p.`account_id`
												WHERE 1
												AND p.`payment_status`='LUNAS'
												AND p.`order_timestamp`>='".$from."'
												AND p.`order_timestamp`<='".$to." 23:59:59'");
		return $data->result_array();
	}
	public function all_pembelian_now(){
		$data		=		$this->db->query("SELECT p.`order_id`,p.`order_timestamp`,u.`nama`,p.`status`,p.`total_transaksi`,s.`nama_supplier`
												FROM `pembelian` p
												JOIN `master_supplier` s ON p.`kode_supplier`=s.`kode_supplier`
												JOIN USER u ON u.`account_id`=p.`account_id`
												WHERE 1
												AND p.`payment_status`='LUNAS'");
		return $data->result_array();
	}
	// Mutasi Anggota
	public function saldo_anggota_mutasi_general(){
		$result 	=		$this->db->query("SELECT ma.`no_anggota`,ma.`nama`,IFNULL(sub.total_simpan,0) AS total_simpan,IFNULL(sub_cicilan.total_pinjam,0) AS total_pinjam,
												SUM(IFNULL(sub.total_simpanan,0)-IFNULL(sub_cicilan.total_pinjam,0)) AS saldo
												FROM master_anggota ma 
												LEFT JOIN
												(SELECT *,SUM(ts.`total_simpanan`) AS total_simpan
													FROM transaksi_simpanan ts
													WHERE 1
													GROUP BY ts.`no_anggota`)
													sub ON sub.no_anggota=ma.`no_anggota`
												LEFT JOIN 
												(SELECT *,SUM(c.`cicilan_perbulan`) AS total_pinjam
													FROM cicilan c
													WHERE 1
													AND c.`update_timestamp` IS NULL
													AND c.`status`='belum'
													GROUP BY c.`no_anggota`)
													sub_cicilan  
														ON sub_cicilan.no_anggota=ma.`no_anggota`
												WHERE 1
												AND ma.`hapus`=0
												GROUP BY ma.`no_anggota`;");
		return $result->result_array();
	}
	public function saldo_anggota_mutasi_general_search($from,$to){
		$result 	=		$this->db->query("SELECT ma.`no_anggota`,ma.`nama`,IFNULL(sub.total_simpan,0) AS total_simpan,IFNULL(sub_cicilan.total_pinjam,0) AS total_pinjam,
												SUM(IFNULL(sub.total_simpanan,0)-IFNULL(sub_cicilan.total_pinjam,0)) AS saldo
												FROM master_anggota ma 
												LEFT JOIN
												(SELECT *,SUM(ts.`total_simpanan`) AS total_simpan
													FROM transaksi_simpanan ts
													WHERE 1
													AND ts.`created_timestamp` >='".$from." 00:00:00'
													AND ts.`created_timestamp` <='".$to." 23:59:59'
													GROUP BY ts.`no_anggota`)
													sub ON sub.no_anggota=ma.`no_anggota`
												LEFT JOIN 
												(SELECT *,SUM(c.`cicilan_perbulan`) AS total_pinjam
													FROM cicilan c
													WHERE 1
													AND insert_timestamp >='".$from." 00:00:00'
													AND insert_timestamp <='".$to." 23:59:59'
													AND c.`update_timestamp` IS NULL
													AND c.`status`='belum'
													GROUP BY c.`no_anggota`)
													sub_cicilan  
														ON sub_cicilan.no_anggota=ma.`no_anggota`
												WHERE 1
												AND ma.`hapus`=0
												GROUP BY ma.`no_anggota`;");
		return $result->result_array();
	}
	public function all_simpanan($from,$to,$param){
		if ($from=="" OR $to=="") {
			$from="1970-01-01";
			$to=date("Y-m-d");
		}
		$data		=		$this->db->query("SELECT ts.`kode_simpanan`,tsd.`kode_simpanan_detail`,
												ma.`no_anggota`, DATE_FORMAT(ts.`created_timestamp`, '%Y/%m/%d') AS tgl_simpan, ma.`nama`, tsd.`kode_jenis_simpanan`,
												mjs.`nama_simpanan`, tsd.`jumlah_simpanan`,ts.`total_simpanan`
												FROM transaksi_simpanan ts
												JOIN master_anggota ma ON ma.`no_anggota`= ts.`no_anggota`
												LEFT JOIN transaksi_simpanan_detail tsd ON ts.`kode_simpanan`=tsd.`kode_simpanan`
												LEFT JOIN master_jenis_simpanan mjs ON mjs.`kode_jenis_simpanan`=tsd.`kode_jenis_simpanan`
												WHERE 1
												AND mjs.`nama_simpanan` LIKE '%".$param."%'
												AND ts.`created_timestamp` >='".$from."'
												AND ts.`created_timestamp` <= '".$to." 23:59:59'");
		// echo $this->db->last_query();
		// die();
		return $data->result_array();
	}

	// CUSTOM SIMPANAN
	public function sum_simpanan($params_array='',$group_by='')
	{
		$this->db->select('ts.`kode_simpanan`,tsd.`kode_simpanan_detail`,
							ma.`no_anggota`, ts.`created_timestamp` AS tgl_simpan, ma.`nama`, tsd.`kode_jenis_simpanan`,
							mjs.`nama_simpanan`, SUM(ts.`total_simpanan`) AS total_simpan');
		$this->db->from('transaksi_simpanan ts');
		$this->db->join('master_anggota ma','ma.no_anggota= ts.no_anggota');
		$this->db->join('transaksi_simpanan_detail tsd','ts.kode_simpanan= tsd.kode_simpanan','left');
		$this->db->join('master_jenis_simpanan mjs','mjs.kode_jenis_simpanan=tsd.kode_jenis_simpanan','left');
		if (is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (is_array($group_by)) {
			$this->db->group_by($group_by);
		}
		$data = $this->db->get()->result_array();
		// echo $this->db->last_query();
		// die();
		if (!empty($data)){
			return $data[0];
		}
		return false;
	}



	public function all_simpanan_now(){
		$data		=		$this->db->query("SELECT ts.`kode_simpanan`,tsd.`kode_simpanan_detail`,
												ma.`no_anggota`, DATE_FORMAT(ts.`created_timestamp`, '%Y/%m/%d') AS tgl_simpan, ma.`nama`, tsd.`kode_jenis_simpanan`,
												mjs.`nama_simpanan`, tsd.`jumlah_simpanan`,ts.`total_simpanan`
												FROM transaksi_simpanan ts
												JOIN master_anggota ma ON ma.`no_anggota`= ts.`no_anggota`
												LEFT JOIN transaksi_simpanan_detail tsd ON ts.`kode_simpanan`=tsd.`kode_simpanan`
												LEFT JOIN master_jenis_simpanan mjs ON mjs.`kode_jenis_simpanan`=tsd.`kode_jenis_simpanan`");
		// echo $this->db->last_query();
		// die();
		return $data->result_array();
	}
	public function all_jenis_simpanan(){
		$data		=		$this->db->query("SELECT * FROM master_jenis_simpanan");
		return $data->result_array();
	}
	public function all_pinjaman($from,$to){
		$data		=		$this->db->query("SELECT tp.`id`, DATE_FORMAT(tp.`time_created`, '%Y/%m/%d') AS tglPinjam, 
												tp.`pinjaman_id`, ma.`no_anggota`, ma.`nama`, tp.`jumlah_pinjaman`, 
												tp.`lama_cicilan`, tp.`bunga`,keterangan	
												FROM transaksi_pinjaman tp
												JOIN master_anggota ma ON ma.`no_anggota` = tp.`no_anggota`
													AND tp.`time_created` >='".$from."'
													AND tp.`time_created` <= '".$to." 23:59:59'");
		return $data->result_array();
	}
	public function all_pinjaman_now(){
		$data		=		$this->db->query("SELECT tp.`id`, DATE_FORMAT(tp.`time_created`, '%Y/%m/%d') AS tglPinjam, 
												tp.`pinjaman_id`, ma.`no_anggota`, ma.`nama`, tp.`jumlah_pinjaman`, 
												tp.`lama_cicilan`, tp.`bunga`,keterangan	
												FROM transaksi_pinjaman tp
												JOIN master_anggota ma ON ma.`no_anggota` = tp.`no_anggota`");
		return $data->result_array();
	}

	public function new_all_pinjaman($params_array='',$group_by=''){
		$this->db->select('*');
		$this->db->from('cicilan');
		$this->db->join('master_anggota','master_anggota.no_anggota=cicilan.no_anggota');
		if (is_array($params_array)) {
			foreach($params_array as $key => $value) {
				if ($key=='timestamp_from')
				{
					$this->db->where("insert_timestamp >=",$value);
				}
				else
				{
					$this->db->where("insert_timestamp <=",$value." 23:59:59");
				}
			}
		}
		$group_by_array = array("order_id","keterangan");
		if ($group_by!='') {
			$group_by_array = array($group_by);
			$this->db->select_sum('cicilan_perbulan');
		}
		$this->db->group_by($group_by_array);
		$result = $this->db->get()->result_array();
		// var_dump($result);
		// echo $this->db->last_query();
		// die;
		return $result;
	}


	public function all_penjualan($from='2017-01-01',$to='2018-12-31'){
		$data		=		$this->db->query("SELECT 
											t.`order_id`,t.`order_timestamp`,ma.`no_anggota`, ma.`nama` as nama_anggota, mb.`kode_barang`, mb.`nama_barang`, td.`qty`,
											t.`total_before_ppn`, t.`ppn`, t.`total_after_ppn`,t.`cash`,t.`kredit`
											FROM transaksi t
											LEFT JOIN transaksi_detail td ON td.`order_id` = t.`order_id`
											LEFT JOIN master_anggota ma ON ma.`no_anggota` = t.`kode_customer`
											LEFT JOIN master_barang mb ON mb.`kode_barang` = td.`order_master_id`
											WHERE 1
											AND t.`order_timestamp` >='".$from."'
											AND t.`order_timestamp` <= '".$to." 23:59:59'
											GROUP BY t.`order_id`												
											ORDER BY t.`order_id` ASC");
		return $data->result_array();
	}
	public function reminder_select_stok_product_all(){
		$result =	$this->db->query("SELECT mb.`kode_barang`,mb.`nama_barang`,mb.`harga_jual`,
											SUM(CASE WHEN sb.`status`='barangmasuk' THEN sb.`qty` END)'barangmasuk',
											SUM(CASE WHEN sb.`status`='barangkeluar' THEN sb.`qty` END)'barangkeluar',
											SUM(CASE WHEN sb.`status`='opname' THEN sb.`qty` END)'opname',
											sub.qty
										FROM master_barang mb 
										JOIN stok_barang sb ON mb.kode_barang=sb.kode_barang
										JOIN
											(SELECT a.`kode_barang`,SUM(a.`qty`) AS qty 
												FROM stok_barang a 
												WHERE 1
												AND a.`qty`<=10
												GROUP BY a.`kode_barang`
											)sub
											ON sub.kode_barang=mb.`kode_barang`
										WHERE 1
										GROUP BY sb.`kode_barang`");
		return $result->result_array();
	}
	public function all_top_brand($from='1970-01-01',$to='2025-12-31'){
		$result =	$this->db->query("SELECT mb.`kode_barang`,mb.`nama_barang`,trd.`buying_price`,trd.`selling_price`,SUM(trd.`qty`) AS qty_jual,
										SUM((trd.`selling_price`-trd.`buying_price`)*trd.`qty`) AS keuntungan
										FROM transaksi_detail trd
										JOIN transaksi tr ON tr.order_id=trd.order_id
										JOIN master_barang mb ON trd.`order_master_id`=mb.`kode_barang`
										WHERE 1
										AND tr.payment_status='lunas'
										AND trd.`created_timestamp`>='".$from."'
										AND trd.`created_timestamp`<='".$to." 23:59:59'
										GROUP BY trd.`order_master_id`
										ORDER BY keuntungan DESC");

		return $result->result_array();
	}
	public function list_hutang_anggota($year_month="")
	{
		if ($year_month=="") {
			$year_month=date("Y-m");
		}
		$result =	$this->db->query("
										SELECT ma.`no_anggota`,ma.`nik`,md.`nama_departemen`,ma.`nama`,'".$year_month."' AS jatuh_tempo,
											IFNULL(sub_hutang_pinjaman.hutang,0) AS 'pinjaman_koperasi',
											IFNULL(sub_hutang_penjualan.hutang,0) AS 'pinjaman_belanja',
											IFNULL(sub_iuran.simpanan,0) AS 'iuran',
											IFNULL(sub_hutang_pinjaman.hutang,0)+IFNULL(sub_hutang_penjualan.hutang,0)+IFNULL(sub_iuran.simpanan,0) AS 'total' 
										FROM master_anggota ma
										JOIN master_departemen md ON md.`kode_departemen`=ma.`departemen`
										LEFT JOIN
										(
											SELECT ma.`nik`,ma.`nama`,SUM(a.`cicilan_perbulan`) AS hutang ,a.* 
											FROM cicilan a
											JOIN master_anggota ma ON ma.`no_anggota`=a.`no_anggota` 
											WHERE 1
											AND DATE_FORMAT(a.`jatuh_tempo`,'%Y-%m')='".$year_month."'
											AND a.`status`='belum' 
											AND a.`keterangan`='transaksi_pinjaman'
											AND update_timestamp IS NULL
											GROUP BY a.`no_anggota`
										) sub_hutang_pinjaman
											ON sub_hutang_pinjaman.no_anggota=ma.`no_anggota`
										LEFT JOIN
										(
											SELECT ma.`nik`,ma.`nama`,SUM(a.`cicilan_perbulan`) AS hutang ,a.* 
											FROM cicilan a
											JOIN master_anggota ma ON ma.`no_anggota`=a.`no_anggota` 
											WHERE 1
											AND DATE_FORMAT(a.`jatuh_tempo`,'%Y-%m')='".$year_month."'
											AND a.`status`='belum' 
											AND a.`keterangan`='transaksi_penjualan'
											AND update_timestamp IS NULL
											GROUP BY a.`no_anggota`
										) sub_hutang_penjualan 
											ON sub_hutang_penjualan.no_anggota=ma.`no_anggota`	
										LEFT JOIN
											(
											SELECT ma.`no_anggota`,ma.`nama`,
											(SELECT nominal FROM master_jenis_simpanan mjs WHERE mjs.prioritas=2) AS simpanan
											FROM master_anggota ma
											WHERE 1
											AND ma.`hapus`=0
											AND ma.`no_anggota` NOT IN
											(
												SELECT ts.`no_anggota`
													FROM transaksi_simpanan ts
													JOIN transaksi_simpanan_detail tsd ON tsd.`kode_simpanan`=ts.`kode_simpanan`
													JOIN master_jenis_simpanan mjs ON mjs.`kode_jenis_simpanan`=tsd.`kode_jenis_simpanan`
													WHERE 1
													AND DATE_FORMAT(ts.`created_timestamp`,'%Y-%m')='".$year_month."'
											)
										) sub_iuran
											ON sub_iuran.no_anggota=ma.`no_anggota`
										WHERE 1
										AND ma.`hapus`=0
										");
		return $result->result_array();
	}
	public function report_shu_anggota()
	{
		$result = $this->db->query("SELECT tp.`id`,ma.`nama`,mj.`nama_jabatan`,md.`nama_departemen`,
										SUM(tp.`bunga`) AS 'untung_by_order',
										'TRANSAKSI PINJAMAN' AS keterangan
									FROM transaksi_pinjaman tp 
									JOIN master_anggota ma ON ma.`no_anggota`=tp.`no_anggota`
									JOIN master_jabatan mj ON mj.`kode_jabatan`=ma.`jabatan`
									JOIN master_departemen md ON md.`kode_departemen`=ma.`departemen`
									WHERE 1
									AND tp.`status`='lunas'
									GROUP BY ma.`no_anggota`,tp.`id`
										UNION
									SELECT tr.order_id,ma.`nama`,mj.`nama_jabatan`,md.`nama_departemen`,
										SUM((`selling_price`-`buying_price`)*qty) AS 'untung_by_order',
										'TRANSAKSI PENJUALAN' AS keterangan
									FROM transaksi tr
									JOIN transaksi_detail td ON tr.`order_id`=td.`order_id`
									JOIN master_anggota ma ON ma.`no_anggota`=tr.`kode_customer`
									JOIN master_jabatan mj ON mj.`kode_jabatan`=ma.`jabatan`
									JOIN master_departemen md ON md.`kode_departemen`=ma.`departemen`
									WHERE 1
									AND tr.`payment_status`='lunas'
									GROUP BY ma.`no_anggota`,tr.`order_id`");
		return $result->result_array();	
	}
	public function list_resign(){
		$result = $this->db->query("SELECT *,SUM(tp.`jumlahTarik`) AS jumlah_penarikan
									FROM master_anggota ma 
									JOIN resign r ON r.`no_anggota`=ma.`no_anggota`
									JOIN master_departemen md ON md.`kode_departemen`=ma.`departemen`
									JOIN master_jabatan mj ON mj.`kode_jabatan`=ma.`jabatan`
									LEFT JOIN transaksi_penarikan tp ON tp.`NoPengunduranDiri`=r.`NoPengunduranDiri`
									WHERE 1
									AND ma.`hapus`=2
									GROUP BY ma.`no_anggota`,r.`NoPengunduranDiri`");
		return $result->result_array();
	}
	public function detail_penarikan_anggota($no_anggota){
		$result = $this->db->query("SELECT *
									FROM master_anggota ma 
									JOIN resign r ON r.`no_anggota`=ma.`no_anggota`
									LEFT JOIN transaksi_penarikan tp ON tp.`NoPengunduranDiri`=r.`NoPengunduranDiri`
									JOIN master_jenis_simpanan mjs ON mjs.`kode_jenis_simpanan`=tp.`kode_jenis_simpanan`
									WHERE 1
									AND ma.`no_anggota`='".$no_anggota."'
									AND ma.`hapus`=2;");
		return $result->result_array();
	}
	public function get_summary_transaksi(){
		$result = $this->db->query("SELECT tr.`order_timestamp`,DATE_FORMAT(tr.`order_timestamp`,'%M') AS bulan,
										IFNULL(SUM(tr.`total_after_ppn`),0) AS total_jual,
										IFNULL(sub.total_beli,0) AS total_beli
									FROM transaksi tr
									LEFT JOIN
										(
										SELECT pe.`order_timestamp`,DATE_FORMAT(pe.`order_timestamp`,'%M')AS bulan,
											SUM(pe.`total_transaksi`) AS total_beli
											,pe.`order_id`
										FROM pembelian pe
										WHERE 1
										AND YEAR(pe.`order_timestamp`)='".$this->year."'
										GROUP BY MONTH(pe.`order_timestamp`)
										)sub
											ON MONTH(sub.order_timestamp)=MONTH(tr.`order_timestamp`)
									WHERE 1
									AND YEAR(tr.`order_timestamp`)='".$this->year."'
									GROUP BY MONTH(tr.`order_timestamp`)
									UNION
									SELECT  tr.`order_timestamp`,DATE_FORMAT(sub2.`order_timestamp`,'%M') AS bulan2,
										IFNULL(SUM(tr.`total_after_ppn`),0) AS total_jual,
										IFNULL(sub2.total_beli,0)
									FROM transaksi tr
									RIGHT JOIN
										(
										SELECT pe.`order_timestamp`,DATE_FORMAT(pe.`order_timestamp`,'%M')AS bulan,
											SUM(pe.`total_transaksi`) AS total_beli
											,pe.`order_id`
										FROM pembelian pe
										WHERE 1
										AND YEAR(pe.`order_timestamp`)='".$this->year."'
										GROUP BY MONTH(pe.`order_timestamp`)
										)sub2
											ON MONTH(sub2.order_timestamp)=MONTH(tr.`order_timestamp`)
									WHERE 1
									AND YEAR(sub2.`order_timestamp`)='".$this->year."'
									GROUP BY MONTH(sub2.`order_timestamp`);");
	// echo $this->db->last_query();
	// die;
		return $result->result_array();
	}
	// Query Buat Di Home View SUMMARY
	public function get_value_inventory(){
		$result = $this->db->query("SELECT  mb.`kode_barang`,mb.`nama_barang`,mb.`harga_beli`,mb.`harga_jual`,
										SUM(sb.`qty`) AS qty,
										SUM(sb.`qty`)*mb.`harga_jual` AS 'asset_by_harga_jual',
										SUM(sb.`qty`)*mb.`harga_beli` AS 'asset_by_harga_beli'
									FROM stok_barang sb 
									JOIN master_barang mb ON mb.`kode_barang`=sb.`kode_barang`
									WHERE 1
										AND mb.`status`=1
										AND mb.`hapus`=0
										AND mb.`type`!='jasa'
									GROUP BY sb.`kode_barang`");
		return $result->result_array();
	}
	public function get_profit_inventory($year=''){
		if ($year=='') 
		{
			$sql = "SELECT DATE_FORMAT(tr.`order_timestamp`,'%Y') AS 'waktu_transaksi', 
							SUM((`selling_price`-`buying_price`)*qty) AS 'untung_by_order'
											FROM transaksi tr
											JOIN transaksi_detail td ON tr.`order_id`=td.`order_id`
											WHERE 1
											AND tr.`payment_status`='lunas'
											-- AND YEAR(tr.`order_timestamp`)='".$this->year."'
											GROUP BY YEAR(tr.`order_timestamp`)";
		}
		else
		{
			$sql = "SELECT DATE_FORMAT(tr.`order_timestamp`,'%Y') AS 'waktu_transaksi',
							SUM((`selling_price`-`buying_price`)*qty) AS 'untung_by_order'
									FROM transaksi tr
									JOIN transaksi_detail td ON tr.`order_id`=td.`order_id`
									WHERE 1
									AND tr.`payment_status`='lunas'
									AND YEAR(tr.`order_timestamp`)='".$year."'
									GROUP BY YEAR(tr.`order_timestamp`)";
		}
		$result = $this->db->query($sql)->result_array();
		// echo $this->db->last_query();
		// die;
		if (!empty($result)) {
			return $result;
		}
		else{
			return 0;
		}
	}

	public function get_profit_inventory_anggota_aktif($year=''){
		if ($year=='') 
		{
			$sql = "SELECT DATE_FORMAT(tr.`order_timestamp`,'%Y') AS 'waktu_transaksi', 
							SUM((`selling_price`-`buying_price`)*qty) AS 'untung_by_order'
											FROM transaksi tr
											JOIN master_anggota ON master_anggota.no_anggota = tr.kode_customer
											JOIN transaksi_detail td ON tr.`order_id`=td.`order_id`
											WHERE 1
											AND master_anggota.hapus = 0
											AND tr.`payment_status`='lunas'
											-- AND YEAR(tr.`order_timestamp`)='".$this->year."'
											GROUP BY YEAR(tr.`order_timestamp`)";
		}
		else
		{
			$sql = "SELECT DATE_FORMAT(tr.`order_timestamp`,'%Y') AS 'waktu_transaksi',
							SUM((`selling_price`-`buying_price`)*qty) AS 'untung_by_order'
									FROM transaksi tr
									JOIN master_anggota ON master_anggota.no_anggota = tr.kode_customer
									JOIN transaksi_detail td ON tr.`order_id`=td.`order_id`
									WHERE 1
									AND master_anggota.hapus = 0
									AND tr.`payment_status`='lunas'
									AND YEAR(tr.`order_timestamp`)='".$year."'
									GROUP BY YEAR(tr.`order_timestamp`)";
		}
		$result = $this->db->query($sql)->result_array();
		// echo $this->db->last_query();
		// die;
		if (!empty($result)) {
			return $result;
		}
		else{
			return 0;
		}
	}

	public function calculate_shu($start_year=1970,$end_year=2025)
	{
		$result = $this->db->query("SELECT master_anggota.no_anggota,master_anggota.nik,master_anggota.nama,
									IFNULL(SUM(t_union.untung_peminjaman),0) AS 't_union.untung_peminjaman',
									IFNULL(SUM(t_union.untung_penjualan),0) AS 't_union.untung_penjualan',
									IFNULL(SUM(t_union.untung_penjualan_elektronik),0) AS 't_union.untung_penjualan_elektronik',
									IFNULL(SUM(t_union.total_simpanan),0) AS 't_union.total_simpanan'
								FROM master_anggota
								INNER JOIN
								(
								SELECT ma.no_anggota,ma.`nama`,mj.`nama_jabatan`,md.`nama_departemen`,
									SUM(tp.`bunga`) AS 'untung_peminjaman',
									0 AS untung_penjualan,
									0 AS untung_penjualan_elektronik,
									0 AS total_simpanan
								FROM transaksi_pinjaman tp 
									JOIN master_anggota ma ON ma.`no_anggota`=tp.`no_anggota`
									JOIN master_jabatan mj ON mj.`kode_jabatan`=ma.`jabatan`
									JOIN master_departemen md ON md.`kode_departemen`=ma.`departemen`
								WHERE 1
									AND tp.`status`='lunas'
									AND YEAR(tp.time_created) >= $start_year
									AND YEAR(tp.time_created) <= $end_year
								GROUP BY ma.`no_anggota`
								UNION
								SELECT ma.no_anggota,ma.`nama`,mj.`nama_jabatan`,md.`nama_departemen`,
									0 AS untung_peminjaman,
									SUM((`selling_price`-`buying_price`)*qty) AS 'untung_penjualan',
									0 AS untung_penjualan_elektronik,
									0 AS total_simpanan
								FROM transaksi tr
									JOIN transaksi_detail td ON tr.`order_id`=td.`order_id`
									JOIN master_anggota ma ON ma.`no_anggota`=tr.`kode_customer`
									JOIN master_jabatan mj ON mj.`kode_jabatan`=ma.`jabatan`
									JOIN master_departemen md ON md.`kode_departemen`=ma.`departemen`
								WHERE 1
									AND tr.`payment_status`='lunas'
									AND YEAR(tr.`order_timestamp`) >= $start_year
									AND YEAR(tr.`order_timestamp`) <= $end_year
								GROUP BY ma.`no_anggota`
								UNION
								SELECT ma.no_anggota,ma.`nama`,mj.`nama_jabatan`,md.`nama_departemen`,
									0 AS untung_peminjaman,
									0 AS untung_penjualan,
									SUM(tr.total_after_ppn) AS 'untung_penjualan_elektronik',
									0 AS total_simpanan
								FROM transaksi tr
									JOIN master_anggota ma ON ma.`no_anggota`=tr.`kode_customer`
									JOIN master_jabatan mj ON mj.`kode_jabatan`=ma.`jabatan`
									JOIN master_departemen md ON md.`kode_departemen`=ma.`departemen`
								WHERE 1
									AND tr.is_elektronik = 1
									AND tr.`payment_status`='lunas'
									AND YEAR(tr.`order_timestamp`) >= $start_year
									AND YEAR(tr.`order_timestamp`) <= $end_year
								GROUP BY ma.`no_anggota`
								UNION
								SELECT ma.no_anggota,ma.nama,mj.nama_jabatan,md.nama_departemen,
									0 AS untung_peminjaman,
									0 AS untung_penjualan,
									0 AS untung_penjualan_elektronik,
									SUM(ts.`total_simpanan`) AS total_simpanan
								FROM `transaksi_simpanan` ts
									JOIN `master_anggota` ma ON `ma`.`no_anggota`= `ts`.`no_anggota`
									JOIN master_jabatan mj ON mj.`kode_jabatan`= ma.`jabatan`
									JOIN master_departemen md ON md.`kode_departemen`=ma.`departemen`
									LEFT JOIN `transaksi_simpanan_detail` tsd ON `ts`.`kode_simpanan`= `tsd`.`kode_simpanan`
									LEFT JOIN `master_jenis_simpanan` mjs ON `mjs`.`kode_jenis_simpanan`=`tsd`.`kode_jenis_simpanan`
								WHERE 1
									-- AND YEAR(ts.created_timestamp) >= $start_year
									-- AND YEAR(ts.created_timestamp) <= $end_year
								GROUP BY `ma`.`no_anggota`
								) t_union
									ON master_anggota.no_anggota = t_union.no_anggota
								WHERE 1
								AND master_anggota.hapus=0
								GROUP BY master_anggota.no_anggota
								ORDER BY master_anggota.nama ASC;");
		return $result->result_array();
	}

	public function get_profit_koperasi($year=''){
		if ($year=='') 
		{
			$sql = "SELECT DATE_FORMAT(tp.`time_created`,'%Y') AS 'waktu_transaksi',
							SUM(tp.`bunga`) AS 'untung_by_order'
						FROM transaksi_pinjaman tp 
					WHERE 1
						AND tp.`status`='lunas'
						AND YEAR(tp.`time_created`)='".$this->year."'
					GROUP BY YEAR(tp.`time_created`)";
		}
		else
		{
			$sql = "SELECT DATE_FORMAT(tp.`time_created`,'%Y') AS 'waktu_transaksi',
							SUM(tp.`bunga`) AS 'untung_by_order'
						FROM transaksi_pinjaman tp 
					WHERE 1
						AND tp.`status`='lunas'
					GROUP BY YEAR(tp.`time_created`)";
		}
		$result = $this->db->query($sql)->result_array();
		if (!empty($result)) {
			return $result;
		}
		else{
			return 0;
		}
	}


	public function all_pembayaran($params_array,$group_by='account_id'){
		$this->db->select('*');
		$this->db->from('transaksi_pembayaran');
		$this->db->join('cicilan', 'transaksi_pembayaran.id = cicilan.id_pembayaran');
		$this->db->join('master_anggota', 'master_anggota.no_anggota = cicilan.no_anggota');

		if (is_array($params_array)) {
			foreach($params_array as $key => $value) {
				if ($key=='timestamp_from')
				{
					$this->db->where("timestamp >=",$value);
				}
				else
				{
					$this->db->where("timestamp <=",$value." 23:59:59");
				}
			}
		}

		if ($group_by!='') {
			$this->db->select_sum('cicilan_perbulan');
			$this->db->group_by($group_by);
		}

		$result = $this->db->get()->result_array();
		// var_dump($result);
		// echo $this->db->last_query();
		// die;
		return $result;
	}
	public function get_all_profit_by_month(){
		$result = $this->db->query("SELECT DATE_FORMAT(tr.`order_timestamp`,'%M') AS bulan,
									SUM((`selling_price`-`buying_price`)*qty) AS 'profit_inventory',
									IFNULL(subPinjaman.untung_koperasi,0) AS 'profit_koperasi'
									FROM transaksi tr 
									JOIN transaksi_detail td ON tr.`order_id`=td.`order_id` 
									LEFT JOIN ( SELECT tp.`time_created`,DATE_FORMAT(tp.`time_created`,'%M')AS bulan, 
											SUM(tp.`bunga`) AS untung_koperasi ,tp.`id`
											FROM transaksi_pinjaman tp
											WHERE 1 
											AND YEAR(tp.`time_created`)='".$this->year."' 
											GROUP BY MONTH(tp.`time_created`) 
										 )subPinjaman 
										 ON MONTH(subPinjaman.`time_created`)=MONTH(tr.`order_timestamp`) 
									WHERE 1 
									AND tr.`payment_status`='lunas'
									AND YEAR(tr.`order_timestamp`)='".$this->year."' 
									GROUP BY MONTH(tr.`order_timestamp`)
									UNION
									SELECT subPinjaman2.`bulan` AS 'bulan',
									IFNULL(SUM((`selling_price`-`buying_price`)*qty),0) AS 'profit_inventory',
									IFNULL(subPinjaman2.untung_koperasi,0) AS 'profit_koperasi'
									FROM transaksi tr 
									JOIN transaksi_detail td ON tr.`order_id`=td.`order_id` 
									RIGHT JOIN ( SELECT tp.`time_created`,DATE_FORMAT(tp.`time_created`,'%M')AS bulan,`status`, 
											SUM(tp.`bunga`) AS untung_koperasi ,tp.`id`
											FROM transaksi_pinjaman tp
											WHERE 1 
											AND YEAR(tp.`time_created`)='".$this->year."' 
											GROUP BY MONTH(tp.`time_created`) 
										 )subPinjaman2 
										 ON MONTH(subPinjaman2.`time_created`)=MONTH(tr.`order_timestamp`) 
									WHERE 1 
									AND subPinjaman2.`status`='lunas'
									AND YEAR(subPinjaman2.`time_created`)='".$this->year."' 
									GROUP BY MONTH(subPinjaman2.`time_created`);")->result_array();
		if (!empty($result)) {
			return $result;
		}
		else{
			return 0;
		}
	}
}
?>