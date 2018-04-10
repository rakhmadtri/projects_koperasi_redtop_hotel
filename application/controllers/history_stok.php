<?php
class history_stok extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("barang_model");
        $this->load->model("report_model");
    }
     public function index(){
     	$params = $this->input->get("kode_barang");	
     	if (!empty($params)) {
     		// echo "Search Barang";
     		$data['detail_history_barang'] = $this->barang_model->select_history_stok($params);     		
     	}
        // echo $this->db->last_query();
        // // die;
     	$data['data_barang'] = $this->barang_model->select_product();
      //   echo "<pre>";
     	// print_r($data['detail_history_barang']);
      //   echo "</pre>";
      //   die;
     	$this->load->view("koperasi_report_history_stok",$data);
    }

	public function _remap(){
			$this->indexfixer->remap();
	}
}
?>
