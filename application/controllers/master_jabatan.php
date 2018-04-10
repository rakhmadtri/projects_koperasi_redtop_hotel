<?php 
class master_jabatan extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("jabatan_model");
        //ini di taruh di construct ,biar fungsi allCustomer() dapat di gunakan
		$this->data['all_jabatan']	=	$this->jabatan_model->select_jabatan();
    }
    public function index($kode_jabatan=""){
    	$is_xls	=	$this->uri->segment(2);
    	if ($is_xls==TRUE) {
    		$this->load->view("xls_view_jabatan",$this->data);
    	}else{
			if ($kode_jabatan!="") {
				$this->$data['edit_anggota']	=	$this->jabatan_model->select1_jabatan($kode_jabatan);
			}		
		$this->load->view("koperasi_master_jabatan_view.php",$this->data);
    	}

    }

	public function cek_validation(){
		$txtInput	=	$this->input->post("data_js");
		$data		=	$this->general_cek_validation("master_jabatan","*",array("hapus"=>0,"nik"=>$txtInput));
		if (count($data)>0) {
			echo "ADA";
		}else{
			echo "TIDAK ADA";
		}
	}
	public function	insertJabatan(){
		$txtKodeJabatan	=	$this->input->post("kode_jabatan");
		$txtNamaJabatan	=	$this->input->post("nama_jabatan");
		$txtKeterangan	=	$this->input->post("keterangan");

		if($txtKodeJabatan ==""){
			$this->jabatan_model->insert_jabatan($txtNamaJabatan, $txtKeterangan);
			$this->session->set_flashdata("notifikasi","insert");
		}else{
			$this->jabatan_model->edit_jabatan($txtKodeJabatan, $txtNamaJabatan, $txtKeterangan);
			$this->session->set_flashdata("notifikasi","update");
		}
		
		redirect(base_url()."master_jabatan");
	}
	public function deleteJabatan($kode_jabatan){
		$this->jabatan_model->delete_jabatan($kode_jabatan);
		$this->session->set_flashdata("notifikasi","delete");
		redirect(base_url()."master_jabatan");
	}
	public function _remap(){
			$this->indexfixer->remap();
		}
}
 ?>