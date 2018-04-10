<?php
class transaksi_resign extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("resign_model");
        $this->load->model("anggota_model");
        $this->data["account_login"]    =   $this->session->userdata("username");
        $this->load->helper('currency_format_helper');
    }
    public function index(){
        $data['data_anggota'] = $this->anggota_model->select_anggota();
        $this->load->view("koperasi_transaksi_resign_view", $data);
    }
    public function insertTransaction(){
        //$count                  =    count($this->input->post("kode_jenis_simpanan"));
        $no_anggota             =   $this->input->post("no_anggota");
        $keterangan             =   $this->input->post("keterangan");
        $get_order_id           =   $this->resign_model->insert_transaksi_resign($no_anggota,$keterangan);
        
        //Update status Anggota
        $this->resign_model->update_status_anggota($no_anggota);


       /* $detail                 =    array();
        for ($i=0; $i<$count; $i++) { 
            $item['NoPengunduranDiri']      =   $get_order_id;
            $item['kode_jenis_simpanan']    =   $kode_jenis_simpanan[$i];
            $item['jumlahTarik']            =   $jumlahTarik[$i];
            $detail[]= $item;   
        }
        $this->resign_model->insert_transaksi_penarikan($detail);*/
        redirect(base_url()."transaksi_resign");
    }
}
?>