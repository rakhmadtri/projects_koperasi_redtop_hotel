<?php
class master_pt extends MY_Controller{
    function __construct(){
        parent::__construct();
        //ini di taruh di construct ,biar fungsi allCustomer() dapat di gunakan
		$this->data['all_cabang']	=	$this->cabang_model->select_cabang();
    }
    public function index($kode_cabang=""){
    	$is_xls	=	$this->uri->segment(2);
    	if ($is_xls==TRUE) {
    		$this->load->view("xls_view_pt",$this->data);
    	}else{
			if ($kode_cabang!="") {
				$this->$data['edit_cabang']	=	$this->cabang_model->select1_cabang($kode_cabang);
			}
	        $this->load->view("master_pt_view",$this->data);
    	}

    }
    public function allCabang(){
    	$term	=	$this->input->get("term");
    	$data	=	$this->cabang_model->select_cabang($term);
    	header("content-type:application/json");
    	echo json_encode($data);
    }
    //Buat Autocomplete di Penjualan pada field pelanggan
    public function allPT(){
    	$term	=	$this->input->get("term");
    	$data 	=	$this->cabang_model->select1_cabang($term);
    	echo json_encode($data);
    }
    public function allKota(){
    	$kodepelanggan=$this->input->post("kodepelanggan");
    	$data 	= $this->cabang_model->select_kota($kodepelanggan);
    	header("content-type:application/json");
    	echo json_encode($data);
    }

	public function	insertCabang(){
		$txtKode		=	$this->input->post("kode");
		$txtNama		=	$this->input->post("name");
		$txtDeskripsi	=	$this->input->post("deskripsi");

		$cek = $this->cabang_model->cek_nama($txtNama);
		
		if ($txtKode=="") {
			if(count($cek) > 0){
				$this->session->set_flashdata("key", "Nama Sudah digunakan");
			}else{
				$this->cabang_model->insert_cabang($txtNama,$txtDeskripsi);
			}
			
		}else{
			$this->cabang_model->edit_cabang($txtKode,$txtNama,$txtDeskripsi);
		}

		redirect(base_url()."master_pt");
	}
	public function deleteCabang($kodeCabang){
		$this->cabang_model->delete_cabang($kodeCabang);
		redirect(base_url()."master_pt");
	}
	public function _remap(){
		$this->indexfixer->remap();
	}
}
?>
