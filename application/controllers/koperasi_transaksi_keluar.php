<?php
class koperasi_transaksi_keluar extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("penjualan_model");
        $this->load->model("cicilan_model");
        $this->data["account_login"]    =   $this->session->userdata("username");
        $this->load->helper('currency_format_helper');
    }
    public function index(){
        if (isset($_GET['trxid'])) {
            $orderId=$_GET['trxid'];
            $this->data['detail_penjualan'] =  $this->penjualan_model->select_transaksi($orderId); 
        }
        $this->data['data_anggota'] =   $this->penjualan_model->select_anggota();
        $this->load->view("koperasi_transaksi_pengeluaran_view",$this->data);
    }
    public function view_edit_transaction(){
        if (isset($_GET['trxid'])) {
            $orderId=$_GET['trxid'];
            $this->data['detail_penjualan'] =  $this->penjualan_model->select_transaksi($orderId); 
            // $this->data['detail_product']   =  $this->penjualan_model->select_detail_penjualan($orderId);
        }
        // $this->data['master_cabang']    = $this->cabang_model->select_cabang();
        // print_r($this->data);
        $this->load->view("transaksi_penjualan_edit",$this->data);
    }
    public function insertTransaction(){
        // print_r($this->input->post());
        // die();
        // Ambil nilai pembayaran CASH dan kredit
        $cash                   =   $this->input->post("cash");
        $kredit                 =   $this->input->post("kredit");
        // Untuk Cek Payment status, apakah Cicilan Atau Lunas
        $kode_customer          =   $this->input->post("anggota");
        $account_id             =   $this->data["account_login"][0]["account_id"];
        $kodeBarang             =   $this->input->post("kodebarang");
        $qty                    =   $this->input->post("qty");
        $selling_price          =   $this->input->post("harga");
        $grandtotal             =   $this->input->post("grandtotal");
        $ppn                    =   $this->input->post("pph");
        $total_after_ppn        =   $this->input->post("afterpph");
        $sub_total              =   $this->input->post("subtotal");

        $detail_stok            =   array();  
        $count                  =   count($this->input->post("kodebarang"));

        // Jika bayar TIDAK lunas ,"" -> Untuk New Customer karena tidak ada inputan name "kredit"

        if ($kredit!="" AND $kredit!=0){
            // Validasi Max Hutang di inventory
            $select_hutang_anggota      = $this->penjualan_model->select_hutang_anggota($kode_customer);
            $validasi_pinjaman_anggota  = $this->validasi_pinjaman_anggota("pinjaman_inventory");
    
            if ($select_hutang_anggota+$kredit > $validasi_pinjaman_anggota)
            {        
                echo "<script type='text/javascript'>alert('TOTAL PINJAMAN INVENTORY'"+$select_hutang_anggota+"')</script>";
                die();
                // $a=$this->session->set_flashdata("error","TOTAL PINJAMAN INVENTORY".$select_hutang_anggota);
                // redirect(base_url()."transaksi_penjualan");
                // print_r($a);
                // die();
            }
            else{
                $get_order_id       = $this->penjualan_model->insert_transaksi_header($kode_customer,$account_id,$grandtotal,$ppn,$total_after_ppn,"cicilan",$cash,$kredit,"1","kredit"); 

                $this->cicilan_model->insert_cicilan($get_order_id,"1",$kode_customer,$kredit,"0",$kredit,"transaksi_penjualan",$kredit);   
            }



        }
        //Jika bayar lunas
        else {
            // Untuk yang bukan ANGGOTA otomatis bayar FULL CASH ,maka PARAMS terkahir == "cash" di isi dengan $AFTERPPN dan tidak insert CICILAN
            $get_order_id       = $this->penjualan_model->insert_transaksi_header($kode_customer,$account_id,$grandtotal,$ppn,$total_after_ppn,"lunas",$total_after_ppn);            
        }
        
        // Insert transaksi_detail
        $detail=array();
        for ($i=0; $i<$count; $i++) { 
            $item['order_id']           =   $get_order_id;
            $item['order_master_id']    =   $kodeBarang[$i];
            $item['qty']                =   $qty[$i];
            $temp_harga_beli            =   $this->penjualan_model->get_detail_barang($kodeBarang[$i]);
            $item['buying_price']       =   $temp_harga_beli['harga_beli'];
            $item['selling_price']      =   $selling_price[$i];
            $item['sub_total']          =   $sub_total[$i];
            $detail[]   =$item;   
        }
        // Insert Ke Stok
        for ($i=0; $i<$count; $i++) {
            // Jika Type dari master barang == product
            $type_barang = $this->penjualan_model->get_detail_barang($kodeBarang[$i]);
            if ($type_barang['type']=="product"){        
                $item_stok['status']               =   "barangkeluar";         
                $item_stok['order_id_penjualan']   =   $get_order_id;
                $item_stok['kode_barang']          =   $kodeBarang[$i];
                $item_stok['qty']                  =   "-".$qty[$i];
                $detail_stok[]                     =   $item_stok;   
            }        
        }
        // echo "<pre>";
        // print_r($detail);
        // echo "</pre>";
        // echo "<pre>";
        // print_r($detail_stok);
        // echo "</pre>";
        $this->insert_transaksi_detail("transaksi_detail",$detail);
        $this->insert_stok($detail_stok);
        
        //Untuk Cetak Nota
        $data['data_penjualan'] = $this->penjualan_model->select_nota($get_order_id);
        $this->load->view("koperasi_cetak_nota",$data); 
        // redirect(base_url()."transaksi_penjualan");
    }
    //buat Delete Transaction by produk
    public function delete_detail_transaksi(){
        $orderId    =   $this->input->get($trxid);
        $this->penjualan_model->delete_transaksi_detail($orderId);
    }
    //Tidak jadi di gunakan
    public function delete_detail_transaksi2(){
        $orderId    =   $this->input->get("trxid");
        $kodeBarang =   $this->input->get("kodebarang");
        $this->penjualan_model->click_delete_transaksi_detail($orderId,$kodeBarang);
        redirect($_SERVER('HTTP_REFERER'));
    }

    //Buat autocomplete di surat jalan
    public function allTransaksi(){
        $order_id=$this->input->post("orderid");
        $data   =   $this->penjualan_model->get_header($order_id);
       // $data.  =   $this->penjualan_model->get_detail($order_id);
       //  print_r($data);
       //  echo "<br>";
       // print_r($data);
       // die();
        if($data!=NULL){
            $data['order_detail']   =   $this->penjualan_model->get_detail($order_id);
        }
        header("content-type:application/json");
        echo json_encode($data);
    }
    //Untuk View hasil print Out
    public function cetak_jual(){
        $data['data_penjualan']    =   $this->penjualan_model->all_transaksi_distinct();
        //print_r($data);
        $this->load->view("v_penjualan",$data);
    }
    public function print_penjualan($order_id){
        $cekOrder   =   $this->penjualan_model->validasi_order($order_id);
        if (count($cekOrder)==1) {
                $data_penjualan['dt_contact']=$this->penjualan_model->get_header($order_id);
                $data_penjualan['dt_order']=$this->penjualan_model->get_penjualan($order_id);
                $data_penjualan['dt_penjualan']=$this->penjualan_model->get_detail($order_id);
                // print_r($data_penjualan);
                $this->load->view('v_print_suratjalan',$data_penjualan);
        }else{
            redirect(base_url());
        }

    }

    public function viewTransaksiPenjualan($orderId){
        $data['detail_penjualan']   =   $this->penjualan_model->select_nota($orderId);
        // $this->load->view("view_transaksi_penjualan");
        $this->load->view("koperasi_view_transaksi_penjualan",$data);
    }
    //Belum di pakai ,report untuk design baru
    public function viewTransaksi(){
        $this->load->view("view_transaksi_by_order");
    }
    public function validasi_hutang(){
        $no_anggota     = $this->input->post("no_anggota");
        $nominal_kredit = $this->input->post("nominal_kredit");

        $select_hutang_anggota      = $this->penjualan_model->select_hutang_anggota($no_anggota);
        $validasi_pinjaman_anggota  = $this->validasi_pinjaman_anggota("pinjaman_inventory");
        
        if ($select_hutang_anggota+$nominal_kredit > $validasi_pinjaman_anggota){
            $total_hutang = $select_hutang_anggota+$nominal_kredit;
            echo "TOTAL PINJAMAN INVENTORY Rp. $total_hutang";
        }


    }

}
?>