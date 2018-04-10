<?php
class generate_invoice extends MY_Controller{
    function __construct(){
        parent::__construct();
        // $this->load->model("invoice_model");
    }
     public function index($is_xls=FALSE){	
		if ($is_xls==FALSE) {
			if(isset($_GET['query'])!=""){
				// $this->data['all_invoice']=$this->invoice_model->all_invoice($_GET['query']);
			}
			else{
				// $this->data['all_invoice']=$this->invoice_model->all_invoice();
			}

			$this->load->view("invoice_view",$this->data);
		}else{
			$data['all_user']=$this->user_model->allUser();
			$this->load->view("xls_view_user",$data);
		}
	}
	// public function	insertUser(){
	// 	$txtKode	=	$this->input->post("kode");
	// 	$txtNama	=	$this->input->post("name");
	// 	$txtEmail	=	$this->input->post("email");
	// 	$txtPassword=	$this->input->post("password");
	// 	$txtStatus	=	$this->input->post("status");
	// 	if ($txtKode=="") {
	// 		$this->user_model->insert_user($txtNama,$txtEmail,$txtPassword,$txtStatus);
	// 	}else{
	// 		$this->user_model->edit_user($txtKode,$txtNama,$txtEmail,$txtPassword,$txtStatus);
	// 	}
	// 	redirect(base_url()."master_user");
	// }
	public function _remap(){
			$this->indexfixer->remap();
		}
}
?>
