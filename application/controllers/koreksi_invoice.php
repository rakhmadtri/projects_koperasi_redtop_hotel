<?php
class koreksi_invoice extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("penawaran_model");
    }
    public function index($is_xls=FALSE){	
		if ($is_xls==FALSE) {
			if(isset($_GET['query'])!=""){
				$this->data['all_penawaran']=$this->penawaran_model->all_penawaran($_GET['query']);
			}
			else{
				$this->data['all_penawaran']=$this->penawaran_model->all_penawaran();
			}
			$this->load->view("penawaran_view",$this->data);
		}else{
			$data['all_user']=$this->user_model->allUser();
			$this->load->view("xls_view_user",$data);
		}
	}
    public function cetak_penawaran($order_id){
    	$data['detail_penawaran'] = $this->penawaran_model->select_1penawaran($order_id);
    	$data['data_penawaran']	  = $this->penawaran_model->select_detail_penawaran($order_id);
    	$data['data_sparepart']   = $this->penawaran_model->select_detail_spare_part($order_id);
    	
        $this->load->view("v_print_penawaran",$data);
    }
	public function _remap(){
		$this->indexfixer->remap();
	}
}
?>


