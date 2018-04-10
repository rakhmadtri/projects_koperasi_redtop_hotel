<?php
class header_test extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("form_model");
	}
	public function index(){
		$this->load->view("transaksi_penjualan_view");
	}
	public function cek_validation(){
		$txtInput	=	$this->input->post("data_js");
		$data		=	$this->form_model->cek_validation($txtInput);
		if (count($data)>0) {
			echo "ADA";
		}else{
			echo "TIDAK ADA";
		}
		
	}
}
?>