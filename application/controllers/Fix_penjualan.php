<?php
class Fix_penjualan extends MY_Controller{
    function __construct(){
        parent::__construct();
	    $this->load->library("excel_reader");
	    $this->load->model("simpanan_model");
        $this->load->model("pinjaman_model");
        $this->load->model("penjualan_model");
    }
    public function index(){
    	$result = $this->db->query("SELECT * FROM transaksi tr
							WHERE 1 
							AND tr.`total_after_ppn`!=tr.`cash`
							AND tr.`kode_customer`='newCustomer';")->result_array();
    	foreach ($result as $key => $value) {
    		echo $value['order_id']."<br>";
    		$this->db->update("transaksi",array("cash"=>$value['total_after_ppn']),array("order_id"=>$value['order_id']));
    	}
    }
}
?>