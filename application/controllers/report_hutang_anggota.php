<?php
class report_hutang_anggota extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("report_model");
    }
    public function index($xls=''){
          if (isset($_GET['bulan_proses'])) 
            {
                $bulan_proses       =   $this->input->get("bulan_proses");
                $data['list_hutang_anggota']    =   $this->report_model->list_hutang_anggota($bulan_proses);
                // echo $this->db->last_query();
            }   
            else{
                $data['list_hutang_anggota']    =   $this->report_model->list_hutang_anggota();
            }
            if ($xls!='') {
                $this->load->view("koperasi_export_hutang_anggota_xls_view",$data);
            }
            $this->load->view("koperasi_report_hutang_anggota_view",$data);
    }
    public function _remap(){
        $this->indexfixer->remap();
    }
}
?>