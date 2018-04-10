<?php 
class Transaksi_elektronik extends MY_Controller
{
	function __construct()
	{	
		parent::__construct();
		$this->load->model("barang_model");
        $this->load->model("opname_stok_model");
        $this->load->model('penjualan_model');
        $this->load->model('anggota_model');
		$this->data["account_login"] = $this->session->userdata("username");
        $this->load->helper('currency_format_helper');
	}
	public function index(){
        // $data['data_anggota'] =   $this->penjualan_model->select_anggota();
        $data['data_anggota'] =   $this->anggota_model->select_anggota_all();
        $this->load->view("koperasi_view_transaksi_elektronik",$data);
    }
     public function insertTransaction(){
        $data = array();
        
        $nominal = $this->input->post('nominal');
        $anggota = $this->input->post('anggota');

        $data['total_before_ppn'] = $nominal;
        $data['total_after_ppn'] = $nominal;
        $data['cash'] = $nominal;
        $data['kode_customer'] = $anggota;
        $data['account_id'] = $this->data["account_login"][0]["account_id"];
        $data['is_elektronik'] = 1;
        $data = $this->penjualan_model->insert($data);
        if (is_numeric($data)) {
            $this->session->set_flashdata("notifikasi","update");
        }
        redirect(base_url()."transaksi_elektronik");
    }
}
?>