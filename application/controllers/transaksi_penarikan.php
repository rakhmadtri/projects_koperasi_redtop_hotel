<?php
class transaksi_penarikan extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("resign_model");
        $this->load->model("anggota_model");
        $this->data["account_login"]    =   $this->session->userdata("username");
        $this->load->helper('currency_format_helper');
    }
    public function index(){
        $data['data_resign']    = $this->resign_model->select_no_penarikan();
        $data['list_simpanan']  = $this->resign_model->select_list_simpanan();
        $this->load->view("koperasi_transaksi_penarikan_view", $data);
    }
    public function insertTransaction(){
        $data_post            = $this->input->post();

        foreach ($data_post as $key => $value) {
         if(strstr($key,"simpanan_")==true){
                $kode_jenis_simpanan  = str_replace("simpanan_", "", $key);
                $no_pengunduran       =   $this->input->post("no_pengunduran");
                $this->db->insert("transaksi_penarikan",array("NoPengunduranDiri"=>$no_pengunduran,"kode_jenis_simpanan"=>$kode_jenis_simpanan,"jumlahTarik"=>$value));
            }
        }
        $this->resign_model->update_resign($no_pengunduran);
        redirect(base_url()."transaksi_penarikan");
    }
    public function getDataPenarikan(){
        $no_pengunduran = $this->input->get('no_pengunduran');
        $data['data_resign'] = $this->resign_model->select_penarikan_all($no_pengunduran);
        header("content-type:application/json");
        echo json_encode($data);
    }
    public function getDataResign($no_pengunduran){
        $data  = $this->resign_model->get($no_pengunduran);
        $data['detail_penarikan']  = $this->resign_model->get_detail_penarikan($data['no_anggota']);
        header("content-type:application/json");
        echo json_encode($data);   
    }

}
?>