<?php
class transaksi_service extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("service_model");
        $this->load->model("cabang_model");
        $this->data["account_login"]	=	$this->session->userdata("username");
        $this->load->helper('currency_format_helper');
    }
    public function index(){
        $this->data['master_cabang']    = $this->cabang_model->select_cabang();
        $this->load->view("transaksi_service_view",$this->data);
    }
    public function insertTransaction(){
        // print_r($this->input->post());
        // die();
        $count =    count($this->input->post("kodebarang"));
		//ambil user yang melayani transaksi tsb
		$accountId	        =   $this->data["account_login"][0]["account_id"];
    	$txtKodePelanggan	=	$this->input->post("kodepelanggan");
        $namaup             =   $this->input->post("namaup");
        $pph                =   $this->input->post("pph");
        $totalCustomerPrice =   $this->input->post("grandtotal");
        $kodeBarang         =   $this->input->post("kodebarang");
        $qty                =   $this->input->post("qty");
        $sub_total          =   $this->input->post("subtotal");
        $selling_price      =   $this->input->post("harga");
        // print_r($this->input->post());
        // die();
        $maxOrderId   = $this->service_model->select_last_trx();

        $no_spk       = $this->generatedKode("SPK/",$maxOrderId[0]['max']);
        //Insert Transaksi
        $get_order_id = $this->service_model->insert_transaksi_header($txtKodePelanggan,$accountId,$totalCustomerPrice,$namaup,$no_spk);
        //print_r($kodeBarang);
        $this->service_model->insert_invoice($this->generatedKode("INV",$get_order_id),$get_order_id,$totalCustomerPrice);
        $detail=array();
        for ($i=0; $i<$count; $i++) { 
            $item['order_id']       =   $get_order_id;
            $item['order_master_id']=   $kodeBarang[$i];
            $item['qty']            =   $qty[$i];
            $item['selling_price']  =   $selling_price[$i];
            $item['sub_total']      =   $sub_total[$i];
            $detail[]   =$item;   
        }
        for ($i=0; $i<$count; $i++) {
            $item_stok['status']     =   "barangkeluar";         
            $item_stok['order_id']   =   $get_order_id;
            $item_stok['kode_barang']=   $kodeBarang[$i];
            $item_stok['qty']        =   "-".$qty[$i];
            $detail_stok[]           =   $item_stok;   
        }
        $this->insert_transaksi_detail("transaksi_detail",$detail);
        $this->insert_stok($detail_stok);
        redirect(base_url()."transaksi_service");
    }
    //Buat autocomplete di surat jalan
    public function allTransaksi(){
        $order_id=$this->input->post("orderid");
        $data   =   $this->service_model->get_header($order_id);
       // $data.  =   $this->penjualan_model->get_detail($order_id);
       //  print_r($data);
       //  echo "<br>";
       // print_r($data);
       // die();
        if($data!=NULL){
            $data['order_detail']   =   $this->service_model->get_detail($order_id);
        }
        header("content-type:application/json");
        echo json_encode($data);
    }
    //Untuk View hasil print Out
    public function cetak_jual(){
        $data['data_penjualan']    =   $this->service_model->all_transaksi_distinct();
        print_r($data);
        $this->load->view("v_penjualan",$data);
    }
    public function print_penjualan($order_id){
        $cekOrder   =   $this->penjualan_model->validasi_order($order_id);
        if (count($cekOrder)==1) {
                $data_penjualan['dt_contact']=$this->penjualan_model->get_header($order_id);
                $data_penjualan['dt_order']=$this->penjualan_model->get_penjualan($order_id);
                $data_penjualan['dt_penjualan']=$this->penjualan_model->get_detail($order_id);
                // print_r($data_penjualan);
                $this->load->view('v_print_penjualan',$data_penjualan);
        }else{
            redirect(base_url());
        }

    }
    public function insertSuratJalan(){
        $teknisi        =   $this->input->get("kurir");
        $orderid        =   $this->input->get("orderid");
        // $order_id        =   $this->input->post("nopenjualan");
        // $a               =   $this->input->post("tanggalkirim");
        // $tanggal         =   explode("/", $a);
        // $tanggalkirim    =   $tanggal[2]."-".$tanggal[0]."-".$tanggal[1];
        if ($teknisi !="" && $orderid !="") {
                $this->penjualan_model->insert_surat2($teknisi,$orderid);
                $this->print_penjualan($orderid);
        }
        else{
            redirect('HTTP_REFERER');
        }
        // redirect(base_url()."transaksi_penjualan/print_penjualan/".$order_id);
    }
    public function generatedKode($string,$params){
        $result     =   $string.date("dmy").str_pad($params,5,0,STR_PAD_LEFT);
        return $result;
    }
    public function viewTransaksiPenjualan($orderId){
        $data['detail_penjualan']   =   $this->service_model->select_transaksi($orderId);
        $this->load->view("view_transaksi_service",$data);
    }
}
?>