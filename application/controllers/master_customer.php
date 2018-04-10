<?php
class master_customer extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("customer_model");
        $this->load->model("cabang_model");
        //ini di taruh di construct ,biar fungsi allCustomer() dapat di gunakan
		$this->data['all_customer']	=	$this->customer_model->select_customer();
    }
    public function index($kode_customer=""){
    	$is_xls	=	$this->uri->segment(2);
    	if ($is_xls==TRUE) {
    		$this->load->view("xls_view_customer",$this->data);
    	}else{
			if ($kode_customer!="") {
				$this->$data['edit_customer']	=	$this->customer_model->select1_customer($kode_customer);
			}
		$this->data['master_kota']		=	$this->customer_model->select_kota();
		$this->data['master_cabang']	=	$this->cabang_model->select_cabang();
        $this->load->view("master_customer_view",$this->data);
    	}

    }
    // public function allCustomer(){
    // 	$term	=	$this->input->get("term");
    // 	$data	=	$this->customer_model->select_customer($term);
    // 	echo json_encode($data);
    // }
   public function allToko(){
    	$kodecustomer=$this->input->post("customer");
        $namacabang=$this->input->post("cabang");
        $data   = $this->cabang_model->select_cabang_trx($kodecustomer,$namacabang);
		header("content-type:application/json");
    	echo json_encode($data);
    } 
	public function	insertCustomer(){
		$txtKode	=	$this->input->post("kode");
		$txtIndukPt	=	$this->input->post("master");
		$txtKota	=	$this->input->post("master_kota");
		$txtNama	=	$this->input->post("name");
		$txtEmail	=	$this->input->post("email");
		$txtTelfon	=	$this->input->post("number");
		$txtalamat	=	$this->input->post("alamat");
		$validasi	=	$this->cekPrimaryKey("customer","nama_customer",$txtEmail);
		if (count($validasi)<=0) {
			if ($txtKode=="") {
				$this->customer_model->insert_customer($txtNama,$txtEmail,$txtTelfon,$txtalamat,$txtIndukPt,$txtKota);
			}else{
				$this->customer_model->edit_customer($txtKode,$txtNama,$txtEmail,$txtTelfon,$txtalamat,$txtIndukPt,$txtKota);
			}
		}else{
			//Jika nama duplikat
		}

		redirect(base_url()."master_customer");
	}
	public function deleteCustomer($kodeCustomer){
		$this->customer_model->delete_customer($kodeCustomer);
		redirect(base_url()."master_customer");
	}
	public function _remap(){
			$this->indexfixer->remap();
		}
}
?>
