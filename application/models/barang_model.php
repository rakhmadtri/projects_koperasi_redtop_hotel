<?php 

Class barang_model extends CI_Model{
	
	public function select_product($search='%'){
		$result	=	$this->db->query("select * from master_barang where 1 AND hapus=0 AND (nama_barang like '%".$search."%' OR kode_barang LIKE '%".$search."%')");
		return $result->result_array();
	}
	public function cek_kode_barang($kode_barang){
		$result	=	$this->db->query("select * from master_barang where 1 AND kode_barang='".$kode_barang."'");
		return $result->result_array();
	}
	public function select_stok_byproduct($kode_barang){
		$result =	$this->db->query("SELECT * FROM stok_barang sb 
										JOIN master_barang mb ON mb.kode_barang=sb.kode_barang
										WHERE 1 AND sb.kode_barang='".$kode_barang."' AND mb.category !='JASA' ");
		return $result->result_array();
	}
	public function select_product_category($search='%'){
		$result =	$this->db->query("SELECT * FROM master_barang WHERE 1 AND kode_barang='".$search."' AND hapus=0");
		return $result->result_array();
	}
	public function select_product_autocomplete($search='%'){
		$result	=	$this->db->query("SELECT * FROM master_barang mb WHERE 1 AND mb.`status`= '1' AND mb.`hapus` = '0' 
										AND (mb.`nama_barang` LIKE '%".$search."%' OR mb.`kode_barang` LIKE '%".$search."%')");
		return $result->result_array();
	}
	public function select_product_autocomplete_beli($search='%'){

		$result	=	$this->db->query("SELECT * FROM master_barang mb
										WHERE 1 AND mb.`status`= '1' 
										AND mb.`hapus` = '0' 
										AND mb.`type` !='jasa'
										AND (mb.`nama_barang` LIKE '%".$search."%' OR mb.`kode_barang` LIKE '%".$search."%') 
										GROUP BY mb.`kode_barang`");
		// $result=	$this->db->query("SELECT * FROM master_barang mb WHERE 1
		// 								AND mb.`kode_barang` LIKE '%".$search."%' OR mb.`nama_barang` LIKE '%".$search."%' OR mb.`deskripsi` LIKE '%".$search."%'
		// 							");
		return $result->result_array();
	}
	public function insert_product($kode_barang,$nama_barang,$deskripsi,$harga_beli,$presentase,$harga_jual,$status,$type){
		$this->db->insert("master_barang",array("kode_barang"=>$kode_barang,"nama_barang"=>$nama_barang,"deskripsi"=>$deskripsi,"harga_beli"=>$harga_beli,"presentase"=>$presentase,"harga_jual"=>$harga_jual,"status"=>$status,"type"=>$type));
	}
	public function edit_product($kode_barang,$type,$nama_barang,$deskripsi,$harga_beli,$presentase,$harga_jual,$status){
		$this->db->update("master_barang",array("nama_barang"=>$nama_barang,"type"=>$type,"deskripsi"=>$deskripsi, "harga_beli"=>$harga_beli, "presentase"=>$presentase, "harga_jual"=>$harga_jual, "status"=>$status,),array("kode_barang"=>$kode_barang));
	}
	public function delete_barang($kode_barang){
		$this->db->update("master_barang",array("hapus"=>"1"),array("kode_barang"=>$kode_barang));
	}
	//Buat Report
	public function select_stok_product($from,$to){
		$result =	$this->db->query("SELECT mb.`kode_barang`,mb.`nama_barang`,
											SUM(CASE WHEN sb.`status`='barangmasuk' THEN sb.`qty` END)'barangmasuk',
											SUM(CASE WHEN sb.`status`='barangkeluar' THEN sb.`qty` END)'barangkeluar',
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
											AND mb.`category`!='JASA'
											AND mb.`category`!='TRANSPORT'
											AND sb.`timestamp`>='".$from." 00:00:00' 
											AND sb.`timestamp`<='".$to." 23:59:59' 
										GROUP BY sb.`kode_barang`");
		return $result->result_array();
	}
	public function select_stok_product_all(){
		$result =	$this->db->query("SELECT mb.`kode_barang`,mb.`nama_barang`,
											SUM(CASE WHEN sb.`status`='barangmasuk' THEN sb.`qty` END)'barangmasuk',
											SUM(CASE WHEN sb.`status`='barangkeluar' THEN sb.`qty` END)'barangkeluar',
											sub.qty
										FROM master_barang mb 
										JOIN stok_barang sb ON mb.kode_barang=sb.kode_barang
										JOIN
											(SELECT a.`kode_barang`,SUM(a.`qty`) AS qty 
											FROM stok_barang a WHERE 1
											GROUP BY a.`kode_barang`)sub
											ON sub.kode_barang=mb.`kode_barang`
										WHERE 1
											AND mb.`category`!='JASA'
											AND mb.`category`!='TRANSPORT'
										GROUP BY sb.`kode_barang`");
		return $result->result_array();
	}
	//buat validasi stok penjualan
	public function select_stok_product_current($kode_barang){
		$result =	$this->db->query("SELECT sb.`kode_barang`,SUM(sb.qty)AS stok FROM stok_barang sb 
										JOIN master_barang mb ON mb.`kode_barang`=sb.`kode_barang`
										WHERE 1										
										AND sb.kode_barang='".$kode_barang."'
										GROUP BY sb.`kode_barang`");
		return $result->result_array();
	}		
	public function select_presentase($kode_barang,$buying_price){
		$result = $this->db->query("SELECT * FROM master_barang mb WHERE mb.`kode_barang`='".$kode_barang."'");
		$result = $result->result_array();
		$var	=	$result[0]['presentase']*$buying_price/100;
		$var	=	$var+$buying_price;
		// echo $var;
		// die();
		return $var;
	}
	public function insert_log_product($data_log){
		$this->db->insert("master_barang_log",$data_log);
	}


	// Buat History Stok
	public function select_history_stok($kode_barang,$from='1970-01-01',$to='2025-12-31'){
		$result =	$this->db->query("SELECT a.`kode_barang`,DATE(a.`timestamp`) AS 'timestamp',a.`keterangan`,a.`status`,mb.`nama_barang`,
										SUM(CASE WHEN a.`status`='opname' AND a.`keterangan`='saldo_awal' THEN a.`qty` ELSE '0' END)'saldoawal',	
										SUM(CASE WHEN a.`status`='barangmasuk' THEN a.`qty` ELSE '0' END)'barangmasuk',
										SUM(CASE WHEN a.`status`='barangkeluar' THEN a.`qty` ELSE '0' END)'barangkeluar',
										SUM(CASE WHEN a.`status`='opname' AND a.`keterangan`!='saldo_awal' THEN a.`qty` ELSE '0' END)'opname'
										FROM stok_barang a 
											 JOIN master_barang mb ON a.`kode_barang`=mb.`kode_barang`
										WHERE 1
											AND a.`timestamp`>='1970-01-01 00:00:00' 
											AND a.`timestamp`<='2025-12-31 23:59:59' 
											AND a.`kode_barang`='".$kode_barang."'
										GROUP BY a.`kode_barang`,DATE(a.`timestamp`), a.status");
		// echo $this->db->last_query();
		return $result->result_array();
	}
}

?>