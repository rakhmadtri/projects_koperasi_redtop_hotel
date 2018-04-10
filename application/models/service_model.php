<?php 
class service_model extends CI_Model
{
	public function insert_transaksi_header($kode_customer,$account_id,$total_customer_price,$namaup,$no_spk){
		$this->db->insert("transaksi",array("kode_customer"=>$kode_customer,"account_id"=>$account_id,"total_customer_price"=>$total_customer_price,
			"payment_status"=>"lunas","up_customer"=>$namaup,"no_spk"=>$no_spk));
		return $this->db->insert_id();
	}
	public function insert_transaksi_detail($data_detail){
		$this->db->insert_batch("transaksi_detail",$data_detail);
	}
	public function all_transaksi($order_id="%"){
		$result	=	$this->db->query("SELECT * FROM transaksi tr 
										JOIN transaksi_detail trd ON tr.order_id=trd.order_id 
											JOIN master_barang m ON trd.order_master_id = m.kode_barang 
												WHERE m.category = 'SPARE_PART' AND tr.order_id like '".$order_id."'");
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
										JOIN master_cabang mc ON mc.`kode_cabang`=c.`kode_cabang`");
		return $result->result_array();
	}
	public function get_penjualan($order_id){
		$result =	$this->db->query("SELECT * FROM transaksi tr 
										JOIN user u ON tr.account_id=u.account_id
										WHERE 1
										AND tr.`order_id`='".$order_id."'");
		return $result->result_array();
	}
	public function validasi_order($order_id){
		$result =	$this->db->query("SELECT * FROM transaksi tr WHERE tr.order_id ='".$order_id."' ");
		return $result->result_array();
	}
	public function insert_surat2($teknisi,$order_id){
		$this->db->insert("surat_jalan",array("id_teknisi"=>$teknisi,"order_id"=>$order_id));
	}
	public function select_surat_jalan(){
		$result =	$this->db->query("SELECT * FROM surat_jalan");
		return $result->result_array();
	}
	public function insert_invoice($no_invoice,$order_id,$payment_amount){
		$this->db->insert("invoice",array("no_invoice"=>$no_invoice,"order_id"=>$order_id,"payment_amount"=>$payment_amount));
	}
	public function update_invoice($order_id){
		$query	=	$this->db->update("invoice",array("payment_flag"=>1),array("order_id"=>$order_id));
	}
	//Buat Report
		// public function all_penjualan($from="1900-01-01",$to="3000-01-01"){
	public function all_penjualan($from,$to){
		$data		=		$this->db->query("SELECT p.order_id,p.order_timestamp,u.nama,p.total_customer_price,c.`nama_customer`
												FROM `transaksi` p
												JOIN `customer` c ON c.kode_customer=p.kode_customer
												JOIN USER u ON u.`account_id`=p.`account_id`
												WHERE 1
												AND p.payment_status='LUNAS'
												AND p.order_timestamp>='".$from."'
												AND p.order_timestamp<='".$to."'");
		return $data->result_array();
	}
	public function all_penjualan_now(){
		$data		=		$this->db->query("SELECT p.order_id,p.order_timestamp,u.nama,p.total_customer_price,c.`nama_customer`
												FROM `transaksi` p
												JOIN `customer` c ON c.kode_customer=p.kode_customer
												JOIN USER u ON u.`account_id`=p.`account_id`
												WHERE 1
												AND p.payment_status='LUNAS'");
		return $data->result_array();
	}
	public function create_invoice($order_id){
		$query	=	$this->db->query("SELECT tr.`order_id`,trd.`order_detail_id`,cu.`nama_customer`,tr.`order_timestamp`,tr.`total_customer_price`,tr.pph,tr.total_customer_pph,
											trd.`selling_price`,trd.`sub_total`,trd.`qty`,mb.`nama_barang`,mb.`deskripsi`,i.`no_invoice`
										FROM transaksi tr 
										JOIN transaksi_detail trd ON tr.`order_id`=trd.`order_id`
										JOIN customer cu ON cu.`kode_customer`=tr.`kode_customer`
										JOIN master_barang mb ON mb.`kode_barang`=trd.`order_master_id`
										JOIN invoice i ON i.`order_id`=tr.`order_id`
									WHERE 1
									AND tr.`order_id`='".$order_id."'");
		return $query->result_array();
	}
	public function select_transaksi($order_id){
		$result 	= $this->db->query("SELECT *
											FROM transaksi pe 
												JOIN transaksi_detail pd ON pe.`order_id`=pd.`order_id`
												JOIN customer cu ON cu.kode_customer=pe.kode_customer
												JOIN master_barang mb on mb.`kode_barang`=pd.`order_master_id`
											WHERE 1
												AND pe.`order_id`='".$order_id."' ");
		return $result->result_array();
	}
	public function select_last_trx(){
		$result 	=$this->db->query("SELECT MAX(order_id) AS max FROM transaksi");
		return $result->result_array();
	}
}
?>