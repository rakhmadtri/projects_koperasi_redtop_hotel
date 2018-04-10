<?php 
class master_departemen extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("departemen_model");
        //ini di taruh di construct ,biar fungsi allCustomer() dapat di gunakan
		$this->data['all_departemen']	=	$this->departemen_model->select_Departemen();
    }
    public function index($kode_departemen=""){
    	$is_xls	=	$this->uri->segment(2);
    	if ($is_xls==TRUE) {
    		$this->load->view("xls_view_departemen",$this->data);
    	}else{
			if ($kode_departemen!="") {
				$this->$data['edit_departemen']	=	$this->departemen_model->select1_Departemen($kode_departemen);
			}
		$this->load->view("koperasi_master_departemen_view.php",$this->data);
    	}

    }

	public function cek_validation(){
		$txtInput	=	$this->input->post("data_js");
		$data		=	$this->general_cek_validation("master_departemen","*",array("hapus"=>0,"nama_departemen"=>$txtInput));
		if (count($data)>0) {
			echo "ADA";
		}else{
			echo "TIDAK ADA";
		}
	}
	public function	insertDepartemen(){
		$txtKodeDepartemen	=	$this->input->post("kode_departemen");
		$txtNamaDepartemen 	=	$this->input->post("nama_departemen");
		$txtKeterangan		=	$this->input->post("keterangan");

		
		if($txtKodeDepartemen ==""){
			$this->departemen_model->insert_departemen($txtNamaDepartemen,$txtKeterangan);
			$this->session->set_flashdata("notifikasi","update");
		}else{
			$this->departemen_model->edit_departemen($txtKodeDepartemen, $txtNamaDepartemen,$txtKeterangan);
			$this->session->set_flashdata("notifikasi","update");
		}
		
		redirect(base_url()."master_departemen");
	}
	public function deleteDepartemen($kode_departemen){
		$this->departemen_model->delete_Departemen($kode_departemen);
		$this->session->set_flashdata("notifikasi","delete");
		redirect(base_url()."master_departemen");

	}
	public function _remap(){
			$this->indexfixer->remap();
		}
}
?>