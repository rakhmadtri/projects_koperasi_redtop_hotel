<?php
class transaksi_simpanan extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("simpanan_model");
        $this->data["account_login"]    =   $this->session->userdata("username");
        $this->load->helper('currency_format_helper');
    }
    public function index(){
        if (isset($_GET['trxid'])) {
            $orderId=$_GET['trxid'];
            $this->data['detail_penjualan'] =  $this->penjualan_model->select_transaksi($orderId); 
        }
        $this->load->view("koperasi_transaksi_simpanan_view",$this->data);
    }
    public function insertTransaction(){
        // print_r($this->input->post());
        // die();
        $count                  =    count($this->input->post("kode_jenis_simpanan"));
        $kode_jenis_simpanan    =   $this->input->post("kode_jenis_simpanan");
        $jumlah_simpanan        =   $this->input->post("nominal");
        $no_anggota             =   $this->input->post("no_anggota");
        $total_simpanan         =   $this->input->post("grandtotal");
     
        $get_order_id           =   $this->simpanan_model->insert_transaksi_simpanan($no_anggota,$total_simpanan);
        

        $detail                 =    array();
        for ($i=0; $i<$count; $i++) { 
            $item['kode_simpanan']          =   $get_order_id;
            $item['kode_jenis_simpanan']    =   $kode_jenis_simpanan[$i];
            $item['jumlah_simpanan']        =   $jumlah_simpanan[$i];
            $detail[]= $item;   
        }
        $this->simpanan_model->insert_transaksi_simpanan_detail($detail);

        $data['header_simpanan']    =   $this->simpanan_model->get_header_simpanan($get_order_id);
        $data['detail_simpanan']    =   $this->simpanan_model->get_detail_simpanan($get_order_id);
        $this->load->view("koperasi_cetak_transaksi_simpanan",$data);
     
    }
}
?>