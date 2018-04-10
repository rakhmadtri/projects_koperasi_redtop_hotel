<?php
class report_transaksi_pembayaran extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("report_model");
    }
    public function index($xls=''){
        $data['selisih_nominal_cicilan'] = array();
        $data_cicilan               = $this->calculate_cicilan('',array('from'=>"2016-04-01",'to'=>"2016-04-26"));
        // var_dump($data_cicilan);
        // die;
        $data_transaksi_pembayaran  = $this->calculate_transaksi_pembayaran();
        foreach ($data_cicilan as $key => $value_cicilan) {
            foreach ($data_transaksi_pembayaran as $key => $value) {
                if ($value_cicilan['id_pembayaran']==$value['id']) {
                    if ($value_cicilan['sum_cicilan_nominal_pembayaran']!=$value['total_nominal']) {
                        // Data-Data yang Ada Selisih
                        $data['selisih_nominal_cicilan'] = array('table_cicilan'=>$value_cicilan,'table_transaksi_pembayaran'=>$value); 
                    }
                }
            }
        }
        // var_dump($data['selisih_nominal_cicilan']);
        // die;

          if (isset($_GET['from']) && isset($_GET['to']) && isset($_GET['group_by'])) {
                $from       =   !empty($this->input->get("from"))?$this->input->get("from"):'1970-01-01';
                $to         =   !empty($this->input->get("to"))?$this->input->get("to"):'2025-12-31';
                $group_by   =   !empty($this->input->get("group_by"))?$this->input->get("group_by"):"";
                /*$status     =   $this->input->get("statusPembayaran"); */ 
                $params_array = array('timestamp_from'=>$from,'timestamp_to'=>$to);
                $data['all_pembayaran']    =   $this->report_model->all_pembayaran($params_array,$group_by);
                // print_r($data['all_pembayaran']);
            }   
            else{
                $data['all_pembayaran']    =   $this->report_model->all_pembayaran('','');
            }
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // die;
            // echo $this->db->last_query();
            $this->load->view("koperasi_report_transaksi_pembayaran",$data);
    }


    public function _remap(){
        $this->indexfixer->remap();
    }
}
?>