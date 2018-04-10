<?php
class master_supplier extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("supplier_model");
    }
     public function index($kode_supplier=""){	
		$this->data['all_supplier']	=	$this->supplier_model->select_supplier();
    	if ($kode_supplier!="") {
	    	$this->data['edit_supplier']	=	$this->supplier_model->select1_supplier($kode_supplier);
    	}
        $this->load->view("koperasi_master_supplier_view",$this->data);
    }
    //Buat Autocomplete di TRX beli
    public function allSupplier(){
    	$term	=	$this->input->get("term");
    	$data	=	$this->supplier_model->select_supplier($term);
    	echo json_encode($data);
    }
	public function	insertSupplier(){
		$txtKode	=	$this->input->post("kode_supplier");
		$txtNama	=	$this->input->post("nama_supplier");
		$txtEmail	=	$this->input->post("email");
		$txtTelfon	=	$this->input->post("number");
		$txtalamat	=	$this->input->post("alamat");
		if ($txtKode=="") {
			$this->supplier_model->insert_supplier($txtNama,$txtEmail,$txtTelfon,$txtalamat);
		}else{
			$this->supplier_model->edit_supplier($txtKode,$txtNama,$txtEmail,$txtTelfon,$txtalamat);
		}

		redirect(base_url()."master_supplier");
	}
	public function deleteSupplier($kode_supplier){
		$this->supplier_model->delete_supplier($kode_supplier);
		redirect(base_url()."master_supplier");
	}
	public function _remap(){
			$this->indexfixer->remap();
		}
}
?>
