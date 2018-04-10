<?php 
class jenis_simpanan extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("simpanan_model");
        //ini di taruh di construct ,biar fungsi allCustomer() dapat di gunakan
		
    }
    public function index(){
    	$data['list_jenis_simpanan'] = $this->simpanan_model->select_jenis_simpanan();
		$this->load->view("koperasi_master_jenis_simpanan",$data);
    }
	public function	insertJenisSimpanan(){
		$kode_jenis_simpanan	=	$this->input->post("kode_jenis_simpanan");
		$nama_simpanan	 		=	$this->input->post("nama_simpanan");
		$keterangan				=	$this->input->post("keterangan");
	
		if($kode_jenis_simpanan ==""){
			$this->simpanan_model->insert_jenis_simpanan($nama_simpanan, $keterangan);
			$this->session->set_flashdata("notifikasi","update");
		}else{
			$this->simpanan_model->edit_jenis_simpanan($kode_jenis_simpanan, $nama_simpanan, $keterangan);
			$this->session->set_flashdata("notifikasi","update");
		}

		redirect(base_url()."master_jenis_simpanan");
	}
	public function deleteJenisSimpanan($kode_jenis_simpanan){
		$this->simpanan_model->delete_jenis_simpanan($kode_jenis_simpanan);
		$this->session->set_flashdata("notifikasi","delete");
		redirect(base_url()."master_jenis_simpanan");
	}
		// Author @samuel Buat autocomplate di TRx Simpanan
    public function allJenisSimpanan(){
    	$term	=	$this->input->get("term");
    	$data	=	$this->simpanan_model->select_jenis_simpanan($term);
    	echo json_encode($data);
    }
	public function _remap(){
			$this->indexfixer->remap();
		}
}
 ?>