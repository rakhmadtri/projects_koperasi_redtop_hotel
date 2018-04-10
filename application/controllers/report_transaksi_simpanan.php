<?php
class report_transaksi_simpanan extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("report_model");
    }
    public function index(){
        $is_xls =   $this->uri->segment(2);
        if (isset($_GET['from']) && (isset($_GET['to'])) ) 
        {
            $from       =   $this->input->get("from");
            $to         =   $this->input->get("to");
            $nama       =   $this->input->get("nama_simpanan");
            /*$status     =   $this->input->get("statusPembayaran"); */  
            $data['all_simpanan']    =   $this->report_model->all_simpanan($from,$to,$nama);
            // echo $this->db->last_query();
        }   
        else
        {
            $data['all_simpanan']    =   $this->report_model->all_simpanan_now();
            // echo $this->db->last_query();
        }
        if ($is_xls=="xls") {
            $this->load->view("koperasi_export_simpanan_xls_view",$data);
        }
        // $this->print_r($data['all_simpanan']);
        // die;

        $data['jenis_simpan']    =   $this->report_model->all_jenis_simpanan();
        $this->load->view("koperasi_report_simpanan_view",$data);
    }
    public function _remap(){
            $this->indexfixer->remap();
    }
}
?>