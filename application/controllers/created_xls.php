<?php
class created_xls extends MY_Controller{
    function __construct(){
        parent::__construct();
        //ini di taruh di construct ,biar fungsi allCustomer() dapat di gunakan
		$this->data['all_cabang']	=	$this->cabang_model->select_cabang();
    }
    public function index(){
		$this->load->view("xls_view_pt",$this->data);
    	// echo "string";
    	// die();
    }
}

?>