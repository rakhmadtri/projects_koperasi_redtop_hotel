<?php 
class koperasi_stok_awal extends MY_Controller
{
	function __construct()
	{	
		parent::__construct();
		$this->load->model("barang_model");
        $this->load->model("opname_stok_model");
		$this->data["account_login"] = $this->session->userdata("username");
        $this->load->helper('currency_format_helper');
	}
	public function index(){
        $data['list_barang']    =   $this->barang_model->select_product();
        $this->load->view("koperasi_stok_awal_view",$data);
    }
     public function insertTransaction(){
        // print_r($this->input->post());
        // die();
        $kode_barang = $this->input->post("kode_barang");
        $qty_stok = $this->input->post("qty_stok");                        
        $this->opname_stok_model->insert_stok_opname($kode_barang,$qty_stok,"opname","saldo_awal");
        redirect(base_url()."koperasi_stok_awal");
    }
}
?>