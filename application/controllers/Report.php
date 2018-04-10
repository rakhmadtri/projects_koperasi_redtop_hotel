<?php
class Report extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("customer_model");
        $this->load->model("barang_model");
        $this->load->model("pembelian_model");
        $this->load->model("penjualan_model");
        //ini di taruh di construct ,biar fungsi allCustomer() dapat di gunakan
		$this->data['all_customer']	=	$this->customer_model->select_customer();
    }
    public function index($params){
            if ($params=="stok") {
                $this->reportStok();
            }else if ($params=="TransaksiPenjualan") {
                $this->TransaksiPenjualan();
            }else if ($params=="TransaksiPembelian") {
                $this->TransaksiPembelian();        
            }
    }
    public function reportStok(){
    	if (isset($_GET['from']) && (isset($_GET['to']))) {
		    	$from	=	$this->formatTanggal($this->input->get("from"));
		    	$to		=	$this->formatTanggal($this->input->get("to"));
    	    	$this->data['all_stock']	=	$this->barang_model->select_stok_product($from,$to);
    		}	
    		else{
		    	$this->data['all_stock']	=	$this->barang_model->select_stok_product_all();
    		}
        $this->load->view("report_stok_view",$this->data);
    }
    public function TransaksiPenjualan(){
        if (isset($_GET['from']) && (isset($_GET['to'])) && (isset($_GET['statusPembayaran'])) && (isset($_GET['master_kota']))) {
                $from       =   $this->formatTanggal($this->input->get("from"));
                $to         =   $this->formatTanggal($this->input->get("to"));
                $status     =   $this->input->get("statusPembayaran");   
                $masterKota =   $this->input->get("master_kota");
                $this->data['all_penjualan']    =   $this->penjualan_model->all_penjualan($from,$to,$status,$masterKota);
                // echo $this->db->last_query();
            }   
            else{
                $this->data['all_penjualan']    =   $this->penjualan_model->all_penjualan_now();
            }
                $this->data['master_kota']      =   $this->customer_model->select_kota();
        $this->load->view("report_transaksi_penjualan_view",$this->data);
    }
    public function TransaksiPembelian(){
        if (isset($_GET['from']) && (isset($_GET['to']))) {
                $from   =   $this->formatTanggal($this->input->get("from"));
                $to     =   $this->formatTanggal($this->input->get("to"));
                $this->data['all_pembelian']    =   $this->pembelian_model->all_pembelian($from,$to);
                // echo $this->db->last_query();
            }   
            else{
                $this->data['all_pembelian']    =   $this->pembelian_model->all_pembelian_now();
                // print_r($this->data['all_pembelian']);
            }
        $this->load->view("report_transaksi_pembelian_view",$this->data);
    }
    public function RugiLaba(){
        if (isset($_GET['from']) && (isset($_GET['to']))) {
                $from   =   $this->formatTanggal($this->input->get("from"));
                $to     =   $this->formatTanggal($this->input->get("to"));
                $this->data['all_rugilaba']    =   $this->penjualan_model->report_rugi_laba($from,$to);
            }   
            else{
                $this->data['all_rugilaba']    =   $this->penjualan_model->report_rugi_laba_now();
                // print_r($this->data['all_pembelian']);
            }
        $this->load->view("report_rugi_laba_view",$this->data);
    }
	public function formatTanggal($params){
		$tampung	=	explode("/", $params);
		$return		=	$tampung[2]."-".$tampung[0]."-".$tampung[1];
		return $return;
	}    
	public function _remap(){
		$this->indexfixer->remap();
	}
}
?>
