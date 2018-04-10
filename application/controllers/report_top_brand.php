<?php
class report_top_brand extends MY_Controller{
 	function __construct(){
        parent::__construct();
        $this->load->model("report_model");
    }
    public function index(){
        $var_download_file = $this->uri->segment(2);
    	if (isset($_GET['from']) && (isset($_GET['to'])) && ($_GET['from']!="" OR $_GET['to']!="")  ) {
		    	$from	=	$this->input->get("from");
		    	$to		=	$this->input->get("to");
		    	$data['all_brand']	=	$this->report_model->all_top_brand($from,$to);
    		}	
		else{
	    		$data['all_brand']	=	$this->report_model->all_top_brand();
		}
        if ($var_download_file=="xls") {
            $this->load->view("koperasi_report_export_top_brand_view",$data);                
        }
        else{              
            $this->load->view("koperasi_report_top_brand_view",$data);
        }

    }
    public function export_to_xls(){
        $dataStok['all_stok']       =   $this->report_model->select_stok_product_all();
        $this->load->view("koperasi_export_stok_xls_view",$dataStok);
    }
    public function _remap()
    {
        $this->indexfixer->remap();
    }
}
?>