<?php
class penerimaan_barang extends MY_Controller{
    function __construct(){
        parent::__construct();
	    $this->load->model("pembelian_model");
    }
    //Looping select pada list suratjalan
    public function index(){
    	// $this->data['transaksi_0']	=	$this->penjualan_model->all_transaksi_distinct();
        $data['data_po']    =   $this->pembelian_model->select_approve("approve");
    	$this->load->view("koperasi_penerimaan_barang",$data);
    }
   
        //Buat Autocomplete di transaksi pembelian @author : samuel
    public function all_transaksi_pembelian(){
        $order_id=$this->input->post("orderid");
        $data   =   $this->pembelian_model->get_header($order_id);

        if($data!=NULL){
            $data['order_detail']   =   $this->pembelian_model->get_detail($order_id);
        }
        // print_r($data);
        header("content-type:application/json");
        echo json_encode($data);
    }
    public function move_stok(){
        $order_id           = $this->input->post("nopo");
        $arrive_timestamp   = $this->input->post("tanggalkirim"); 

        $this->pembelian_model->move_into_stok($order_id);
        $this->pembelian_model->delete_from_temp_stok($order_id);
        $this->pembelian_model->update_arrive_timestamp($order_id, $arrive_timestamp);
        redirect(base_url()."penerimaan_barang");
    }

}
?>