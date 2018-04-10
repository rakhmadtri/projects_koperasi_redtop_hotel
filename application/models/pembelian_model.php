<?php 
class pembelian_model extends CI_Model
{
	public function insert_transaksi_header($kode_supplier,$account_id,$grandTotal,$ppn,$total_supplier_price){
		$this->db->insert("pembelian",array("kode_supplier"=>$kode_supplier,"account_id"=>$account_id,"transaksi_noppn"=>$grandTotal,"ppn"=>$ppn,"total_transaksi"=>$total_supplier_price,"payment_status"=>"lunas"));
		return $this->db->insert_id();
	}
	public function insert_transaksi_detail($data_detail){
		$this->db->insert_batch("pembelian_detail",$data_detail);
	}
	public function all_pembelian($from,$to){
		$data		=		$this->db->query("SELECT p.`order_id`,p.`order_timestamp`,u.`nama`,p.`keterangan`,p.`total_transaksi`,s.`nama_supplier`
												FROM `pembelian` p
												JOIN `master_supplier` s ON p.`kode_supplier`=s.`kode_supplier`
												JOIN USER u ON u.`account_id`=p.`account_id`
												WHERE 1
												AND p.`payment_status`='LUNAS'
												AND p.`order_timestamp`>='".$from."'
												AND p.`order_timestamp`<='".$to."'");
		return $data->result_array();
	}
	public function all_pembelian_now(){
		$data		=		$this->db->query("SELECT p.`order_id`,p.`order_timestamp`,u.`nama`,p.`keterangan`,p.`total_transaksi`,s.`nama_supplier`
												FROM `pembelian` p
												JOIN `master_supplier` s ON p.`kode_supplier`=s.`kode_supplier`
												JOIN USER u ON u.`account_id`=p.`account_id`
												WHERE 1
												AND p.`payment_status`='LUNAS'");
		return $data->result_array();
	}
	public function select_transaksi_po($order_id){
		$result 	=		$this->db->query("SELECT *,DATE_FORMAT(pe.`order_timestamp`,'%Y/%m/%d') AS pembelian_timestamp
												FROM pembelian pe 
												JOIN pembelian_detail pd ON pe.`order_id`=pd.`order_id`
												JOIN master_supplier su ON su.`kode_supplier`=pe.`kode_supplier`
												JOIN master_barang mb on mb.`kode_barang`=pd.`order_master_id`
												JOIN user u ON u.`account_id`=pe.`account_id`
												WHERE 1
												AND pe.`status`='pending'
												AND pe.`order_id`='".$order_id."' ");
		return $result->result_array();
	}
	public function select_transaksi_po_report($order_id){
		$result 	=		$this->db->query("SELECT *,DATE_FORMAT(pe.`order_timestamp`,'%Y/%m/%d') AS pembelian_timestamp
												FROM pembelian pe 
												JOIN pembelian_detail pd ON pe.`order_id`=pd.`order_id`
												JOIN master_supplier su ON su.`kode_supplier`=pe.`kode_supplier`
												JOIN master_barang mb on mb.`kode_barang`=pd.`order_master_id`
												JOIN user u ON u.`account_id`=pe.`account_id`
												WHERE 1
												AND pe.`order_id`='".$order_id."' ");
		return $result->result_array();
	}

	public function delete_transaksi_detail($orderIdOld){
		$this->db->delete("pembelian_detail",array("order_id"=>$orderIdOld));
		// echo $this->db->last_query();
		// die();
	}

	//@author : samuel (combobox di pembelian)
	public function select_approve($statusOrder='pending'){
		$result 	=	$this->db->query("SELECT *
											FROM pembelian pe
											JOIN pembelian_detail pd ON pe.`order_id`=pd.`order_id`
											JOIN `user` u ON u.`account_id`=pe.`account_id`
											JOIN master_supplier ms ON ms.`kode_supplier`=pe.`kode_supplier`
											WHERE 1 AND pe.`status`='".$statusOrder."'
											GROUP BY pe.`order_id`");
		return $result->result_array();
	}
	public function get_header($order_id="%"){
		$result =	$this->db->query("SELECT * FROM pembelian pe JOIN master_supplier ms ON pe.`kode_supplier`=ms.`kode_supplier` WHERE pe.order_id='".$order_id."'");
		return count($result->result_array())> 0 ? $result->result_array()[0] : NULL;
	}
	public function get_detail($order_id="%"){
		$result =	$this->db->query("SELECT  * FROM pembelian_detail pd 
						JOIN master_barang mb ON mb.`kode_barang`=pd.`order_master_id` 
							JOIN pembelian pe ON pe.`order_id` = pd.`order_id`
							WHERE pd.order_id='".$order_id."'");
		return $result->result_array();
	}
	public function edit_status_pembelian($order_id, $transaksi_noppn, $total_transaksi, $status){
		$this->db->update("pembelian", array(
			"transaksi_noppn"=>$transaksi_noppn,
			"total_transaksi"=>$total_transaksi,
			"status"=>$status,
			"status_timestamp"=>date("Y-m-d")
			),array("order_id"=>$order_id));
	}
	public function move_into_stok($order_id){
        $this->db->query("INSERT INTO stok_barang(kode_barang,order_id_pembelian,qty,`status`)
                            SELECT t.`kode_barang`,t.`order_id_pembelian`,t.`qty`,t.`status` 
                            FROM temp_stok_barang t 
	                        JOIN pembelian p ON p.`order_id` = t.`order_id_pembelian`
	                        WHERE p.`order_id` = '".$order_id."' AND p.`status` = 'approve'");
    }
    public function delete_from_temp_stok($order_id){
    	$this->db->query("DELETE FROM temp_stok_barang WHERE order_id_pembelian='".$order_id."'");
    }
    public function delete_pembelian_detail($order_id){
    	$this->db->query("DELETE FROM pembelian_detail WHERE order_id='".$order_id."'");
    }
    public function update_arrive_timestamp($order_id, $arrive_timestamp){
    	$this->db->update("pembelian", 
    		array("arrive_timestamp"=>$arrive_timestamp,"status"=>"delivered"),
			array("order_id"=>$order_id));
    }

    public function update_status($order_id, $status){
    	$this->db->update("pembelian",array("status"=>$status),array("order_id"=>$order_id));
    }
}
?>