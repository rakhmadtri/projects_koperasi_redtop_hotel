<?php 
class master_anggota extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("anggota_model");
	    $this->load->model("simpanan_model");
        //ini di taruh di construct ,biar fungsi allCustomer() dapat di gunakan
		$this->data['all_anggota']	=	$this->anggota_model->select_anggota_all();
    }
    public function index(){
    	$is_xls	=	$this->uri->segment(2);
		$this->data['nama_departemen']=$this->anggota_model->select_departemen();
		$this->data['nama_jabatan']	  =$this->anggota_model->select_jabatan();
    	if ($is_xls=="xls") {
    		$this->load->view("koperasi_export_master_anggota_xls_view",$this->data);
    	}else{
			$this->load->view("koperasi_master_anggota_view",$this->data);
    	}

    }

	public function cek_validation(){
		$txtInput	=	$this->input->post("data_js");
		$data		=	$this->general_cek_validation("master_anggota","*",array("hapus"=>0,"nik"=>$txtInput));
		if (count($data)>0) {
			echo "ADA";
		}else{
			echo "TIDAK ADA";
		}
	}
	public function	insertAnggota(){
		$txtNoAnggota	=	$this->input->post("no_anggota");
		$txtNik 		=	$this->input->post("nik");
		$txtNama		=	$this->input->post("nama");
		$txtDepartemen	=	$this->input->post("departemen");
		$txtJabatan		=	$this->input->post("jabatan");
		$txtAlamat		=	$this->input->post("alamat");
		$txtNoTelpon	=	$this->input->post("no_telpon");
		$txtNoRekening	= 	$this->input->post("no_rekening");
		if($txtNoAnggota ==""){
			$no_anggota =	$this->anggota_model->insert_anggota($txtNik, $txtNama, $txtDepartemen, $txtJabatan, $txtAlamat, $txtNoTelpon, $txtNoRekening);
			$data_simpanan_pokok = $this->anggota_model->select_nominal_simpanan_pokok();
			if ($data_simpanan_pokok != NULL) {
				$get_order_id           		=   $this->simpanan_model->insert_transaksi_simpanan($no_anggota,$data_simpanan_pokok['nominal']);
				$detail=array();
				$item['kode_simpanan']          =   $get_order_id;
				$item['kode_jenis_simpanan']    =   $data_simpanan_pokok['kode_jenis_simpanan'];
				$item['jumlah_simpanan']        =   $data_simpanan_pokok['nominal'];
				$detail[]= $item;   
				$this->simpanan_model->insert_transaksi_simpanan_detail($detail);
			}
			$this->session->set_flashdata("notifikasi","update");
		}else{
			$this->anggota_model->edit_anggota($txtNoAnggota, $txtNik, $txtNama, $txtDepartemen, $txtJabatan, $txtAlamat, $txtNoTelpon, $txtNoRekening);
			$this->session->set_flashdata("notifikasi","update");
		}
		redirect(base_url()."master_anggota");

		// redirect(base_url()."master_anggota",$data_departemen);
	}
	public function deleteAnggota($no_anggota){
		$this->anggota_model->delete_anggota($no_anggota);
		$this->session->set_flashdata("notifikasi","delete");
		redirect(base_url()."master_anggota");
	}
	// Author @samuel Buat autocomplate di TRx Simpanan
    public function allAnggota(){
    	$term	=	$this->input->get("term");
    	$data	=	$this->anggota_model->select_anggota($term);
    	header("content-type:application/json");
    	echo json_encode($data);
    }
	// Author @samuel Buat autocomplate di TRx Pinjaman
    public function autocomplete_allAnggota(){
    	$term	=	$this->input->get("term");
    	$data	=	$this->anggota_model->autocomplete_select_anggota($term);
    	header("content-type:application/json");
    	echo json_encode($data);
    }
	public function _remap(){
			$this->indexfixer->remap();
	}
}
 ?>