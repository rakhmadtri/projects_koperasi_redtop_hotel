<?php 
class Import_transaksi_simpanan extends MY_Controller
{
	function __construct()
	{	
		parent::__construct();
		$this->load->model("barang_model");
        $this->load->model("opname_stok_model");
        $this->load->model('penjualan_model');
        $this->load->model('anggota_model');
        $this->load->model('simpanan_model');
		$this->data["account_login"] = $this->session->userdata("username");
        $this->load->helper('currency_format_helper');
	}
	public function index(){
        // $data['data_anggota'] =   $this->penjualan_model->select_anggota();
        $data['data_anggota'] =   $this->anggota_model->select_anggota_all();
        $this->load->view("koperasi_view_import_transaksi_simpanan",$data);
    }
     public function insert(){
        $data = array();
        
        $nominal = $this->input->post('nominal');
        $anggota = $this->input->post('anggota');

        $data['total_simpanan'] = $nominal;
        $data['no_anggota'] = $anggota;
        $data['is_import'] = 1;
        $data = $this->simpanan_model->insert($data);
        if (is_numeric($data)) {
            $this->session->set_flashdata("notifikasi","update");
        }
        redirect(base_url()."import_transaksi_simpanan");
    }
}
?>