<?php
class report_transaksi_pinjaman extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("report_model");
    }
    public function index(){
          if (isset($_GET['from']) && (isset($_GET['to'])) && (isset($_GET['group_by'])) ) {
            $from       =   !empty($this->input->get("from"))?$this->input->get("from"):'1970-01-01';
            $to         =   !empty($this->input->get("to"))?$this->input->get("to"):'2025-12-31';
            $group_by   =   !empty($this->input->get("group_by"))?$this->input->get("group_by"):"";
            /*$status     =   $this->input->get("statusPembayaran"); */ 
            $params_array = array('timestamp_from'=>$from,'timestamp_to'=>$to);
                /*$status     =   $this->input->get("statusPembayaran"); */  
                $data['all_pinjaman']    =   $this->report_model->new_all_pinjaman($params_array,$group_by);
                // echo $this->db->last_query();
                // die;
            }   
            else{
                $data['all_pinjaman']    =   $this->report_model->new_all_pinjaman();
            }
            $this->load->view("koperasi_report_pinjaman_view",$data);
    }
}
?>