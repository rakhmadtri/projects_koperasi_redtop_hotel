<?php 

class penawaran_model extends CI_Model{
  
  /**
   * __construct()
   */
  function __construct()
  {
    parent::__construct();
  }
  public function all_penawaran(){
    $result = $this->db->query("SELECT * 
                                  FROM transaksi tr
                                    JOIN transaksi_detail trd ON tr.`order_id`=trd.`order_id`
                                    JOIN master_barang mb ON trd.`order_master_id`=mb.`kode_barang`
                                    JOIN customer c ON c.`kode_customer` = tr.`kode_customer`
                                    JOIN master_cabang mc ON mc.`kode_cabang` = c.`kode_pt`
                                  WHERE 1 GROUP BY tr.`order_id`
                                 ");
    return $result->result_array();
  }
  public function select_1penawaran($order_id){
  	$result	=	$this->db->query("SELECT * 
                                  FROM transaksi tr
                                    JOIN customer c ON c.`kode_customer`=tr.`kode_customer`
                                    JOIN master_cabang mc ON c.`kode_pt`=mc.`kode_cabang`
                                    JOIN master_kokab mk ON mk.`kota_id`=c.`kode_kokab`
                                    JOIN invoice i ON i.`order_id` = tr.`order_id`
                                  WHERE 1
                                  AND tr.order_id='".$order_id."' ");
  	return $result->result_array();
  }
  public function select_detail_penawaran($order_id){
    $result = $this->db->query("SELECT * 
                                  FROM transaksi tr
                                    JOIN transaksi_detail trd ON tr.`order_id`=trd.`order_id`
                                    JOIN master_barang mb ON trd.`order_master_id`=mb.`kode_barang`
                                  WHERE 1
                                  AND tr.order_id='".$order_id."'
                                  ");
    return $result->result_array();
  }
  public function select_detail_spare_part($order_id){
    $result = $this->db->query("SELECT * 
                                  FROM transaksi tr
                                    JOIN transaksi_detail trd ON tr.`order_id`=trd.`order_id`
                                    JOIN master_barang mb ON trd.`order_master_id`=mb.`kode_barang`
                                  WHERE 1
                                  AND mb.`category` != 'A-PRODUCT'
                                  AND tr.`order_id`='".$order_id."'
                                  ");
    return $result->result_array();
  }
}
  

?>