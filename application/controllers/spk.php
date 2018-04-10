<?php
class spk extends MY_Controller{
    function __construct(){
        parent::__construct();
	    $this->load->model("penjualan_model");
    }
    //Looping select pada list suratjalan
    public function index(){
    	$this->data['transaksi_0']	=	$this->penjualan_model->all_transaksi_distinctSpk();
    	$this->load->view("spk_view",$this->data);
    }
    //Cetak suratjalan ke customer
    public function cetak_spk(){
        $orderid        =   $this->input->get("orderid");
        $cekOrder   =   $this->penjualan_model->validasi_order($orderid);
        if (count($cekOrder)==1) {
            $orderid =$this->input->get("orderid");
            $kurir =$this->input->get("kurir");
            $this->penjualan_model->insert_surat3($kurir,$orderid);
            $this->data['detail_spk']   =   $this->penjualan_model->get_detail_suratjalan($orderid);
            // echo $this->db->last_query();
            // die();
            // print_r($this->data['detail_spk']);
            // echo $this->db->last_query();
            // echo "string";
            // die();
        	$this->load->view("v_print_spk",$this->data);
        }else{
            redirect(base_url());
        }
       } 
}
?>