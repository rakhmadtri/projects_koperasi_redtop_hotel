<?php
class invoice extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("penjualan_model");
        $this->load->helper("terbilang");
    }
	public function index($params,$flag){

		if ($params=="" OR $flag=="" AND ($flag!="1" OR $flag!="2")) {
			redirect(base_url());
		}
		else if($flag=="1"){
			$data['result']	=	$this->penjualan_model->create_invoice2($params);
			$this->penjualan_model->update_invoice($params,$flag);						
			$this->load->view("v_print_invoice",$data);
		}else if ($flag=="2") {
			$this->penjualan_model->update_invoice($params,$flag);
			$data['detail_kwitansi']	=	$this->penjualan_model->create_kwitansi($params);
			$this->load->view("v_print_kwitansi",$data);
		}else if ($flag=="3") {
			$this->load->view("v_print_penawaran");
		}else if ($flag=="4") {
			$this->load->view("v_print_spk");
		}


    }
	public function _remap(){
		$this->indexfixer->remap();
	}

}
?>