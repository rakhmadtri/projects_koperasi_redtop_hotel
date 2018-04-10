<?php 

Class opname_stok_model extends CI_Model{
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
										GROUP BY sb.`kode_barang`");
		return $result->result_array();
	}
	public function insert_namafile($nama_file){
		$this->db->insert("upload_file_opname",array("nama_file"=>$nama_file));
	}
	public function insert_stok_opname($kode_barang,$qty,$status,$keterangan=''){
		$this->db->insert("stok_barang",array("kode_barang"=>$kode_barang,"qty"=>$qty,"status"=>$status,"keterangan"=>$keterangan));
	}
}




 ?>