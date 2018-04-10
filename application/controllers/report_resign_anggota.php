<?php
class report_resign_anggota extends MY_Controller{
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
            $data['list_resign']    =   $this->report_model->list_resign();
        }
        if ($is_xls=="xls") {
            $this->load->view("koperasi_export_simpanan_xls_view",$data);
        }
        $this->load->view("koperasi_report_resign_anggota",$data);
    }
    public function detail_resign_anggota(){
        $no_anggota=$this->input->get("term");
        $data['result'] = $this->report_model->detail_penarikan_anggota($no_anggota);
        header("content-type:application/json");
        echo json_encode($data);
    }
    public function _remap(){
            $this->indexfixer->remap();
    }
}
?>