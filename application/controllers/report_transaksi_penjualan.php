<?php
class report_transaksi_penjualan extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("report_model");
        $this->load->library("crystalreport");
    }
    public function index()
    {
        $var_download_file = $this->uri->segment(2);
            if (isset($_GET['from']) && (isset($_GET['to'])) && $_GET['from']!="" && $_GET['to']!="") {
                $from       =   $this->input->get("from");
                $to         =   $this->input->get("to");
                /*$status     =   $this->input->get("statusPembayaran"); */  
                $data['all_penjualan']    =   $this->report_model->all_penjualan($from,$to);
                // echo $this->db->last_query();
            }   
            else{
                $data['all_penjualan']    =   $this->report_model->all_penjualan();
            }
            if ($var_download_file=="xls") {
                $this->load->view("koperasi_report_export_transaksi_penjualan_view",$data);                
            }
            if ($var_download_file=='pdf'){
                if (isset($_GET['from']) && (isset($_GET['to'])) && $_GET['from']!="" && $_GET['to']!="") {
                    $parameter=array(
                        1 => $from,
                        2 => $to." 23:59:59"
                    );
                }
                else{
                    $parameter = array(
                        1 => date("Y-m-d"),
                        2 => date("Y-m-d 23:59:59")
                    );
                }
                $this->crystalreport->generate("report/laporan_penjualan.rpt","laporan_penjualan",$parameter);
            }
            // echo "<pre>";
            // print_r($data['all_penjualan']);
            // echo "</pre>";
            // die();
        $this->load->view("koperasi_report_transaksi_penjualan_view",$data);
    }
    public function _remap()
    {
        $this->indexfixer->remap();
    }
}
?>