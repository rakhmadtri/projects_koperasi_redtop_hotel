<?php
class report_stok extends MY_Controller{
 	function __construct(){
        parent::__construct();
        $this->load->model("report_model");
    }
    public function index(){
    	if (isset($_GET['from']) && (isset($_GET['to'])) && ($_GET['from']!="" OR $_GET['to']!="")  ) {
		    	$from	=	$this->input->get("from");
		    	$to		=	$this->input->get("to");
		    	$data['all_stock']	=	$this->report_model->select_stok_product($from,$to);
    		}	
		else{
	    		$data['all_stock']	=	$this->report_model->select_stok_product_all();
		}
        // echo $this->db->last_query();
        // die;
        $this->load->view("koperasi_report_stok_view",$data);
    }
    public function export_stok_xls(){
        $dataStok['all_stok']       =   $this->report_model->select_stok_product_all();
        $this->load->view("koperasi_export_stok_xls_view",$dataStok);
    }
}
?>