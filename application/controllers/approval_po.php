<?php
class approval_po extends MY_Controller{
    function __construct(){
        parent::__construct();
	    $this->load->model("pembelian_model");
    }
    //Looping select pada list suratjalan
    public function index(){
    	// $this->data['transaksi_0']	=	$this->penjualan_model->all_transaksi_distinct();
        $data['data_po']    =   $this->pembelian_model->select_approve();
    	$this->load->view("koperasi_approval_po",$data);
    }
   
        //Buat Autocomplete di transaksi pembelian @author : samuel
    public function all_transaksi_pembelian(){
        $order_id=$this->input->post("orderid");
        $data   =   $this->pembelian_model->get_header($order_id);
       // $data.  =   $this->penjualan_model->get_detail($order_id);
       //  print_r($data);
       //  echo "<br>";
       // print_r($data);
       // die();
        if($data!=NULL){
            $data['order_detail']   =   $this->pembelian_model->get_detail($order_id);
        }
        // print_r($data);
        header("content-type:application/json");
        echo json_encode($data);
    }
}
?>