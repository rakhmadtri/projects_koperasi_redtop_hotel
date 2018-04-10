<?php
class report_transaksi_pembelian extends MY_Controller{
 	function __construct(){
        parent::__construct();
        $this->load->model("report_model");
    }
    public function index(){
        $var_download_file = $this->uri->segment(2);
        // print_r($this->input->get());
        // var_dump($var_download_file);
        // die();
    	if (isset($_GET['from']) && (isset($_GET['to']))) {
                $from   =   !empty($this->input->get("from"))?$this->input->get("from"):'1970-01-01';
                $to     =   !empty($this->input->get("to"))?$this->input->get("to"):'2025-12-31';
                $data['all_pembelian']    =   $this->report_model->all_pembelian($from,$to);
                // echo $this->db->last_query();
                // die();
            }   
        else{
            $data['all_pembelian']    =   $this->report_model->all_pembelian();
        }
        if ($var_download_file=="xls") {
            $this->load->view("koperasi_report_export_transaksi_pembelian_view",$data);                
        }
        else{              
            $this->load->view("koperasi_report_transaksi_pembelian_view",$data);
        }
    }
    public function _remap()
    {
        $this->indexfixer->remap();
    }


}
?>