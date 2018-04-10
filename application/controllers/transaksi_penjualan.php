<?php
class transaksi_penjualan extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("penjualan_model");
        $this->load->model("cicilan_model");
        $this->data["account_login"]    =   $this->session->userdata("username");
        $this->load->helper('currency_format_helper');
    }
    public function index($orderid=''){
        if ($orderid!='') {
            $this->data['detail_penjualan'] =  $this->penjualan_model->select_nota($orderid); 
            $this->data['detail_cicilan']   =  $this->cicilan_model->get_data_cicilan(array('order_id'=>$orderid,'keterangan'=>'transaksi_penjualan'));
        }
        $this->data['data_anggota'] =   $this->penjualan_model->select_anggota();
        $this->load->view("transaksi_penjualan_view",$this->data);
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

    public function index_edit_penjualan(){
        $data['data_transaksi'] = $this->penjualan_model->get_transaksi();
        $this->load->view("koperasi_transaksi_penjualan_edit_view",$data);
    }

    public function redirect_penjualan(){
        $order_id = $this->input->post("order_id");
        redirect(base_url()."transaksi_penjualan/".$order_id);
    }
    public function insertTransaction(){
        // echo "<pre>";
        // print_r($this->input->post());
        // echo "</pre>";
        // die;
        $order_id               =   $this->input->post("nopenjualan");
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


        // die();
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
                $get_order_id       = $this->penjualan_model->insert_transaksi_header($kode_customer,$account_id,$grandtotal,$ppn,$total_after_ppn,"cicilan",$cash,$kredit,"1","kredit",$order_id); 

                $this->cicilan_model->insert_cicilan($get_order_id,"1",$kode_customer,$kredit,"0",$kredit,"transaksi_penjualan",$kredit);   
            }



        }
        //Jika bayar lunas
        else {
            // Untuk yang bukan ANGGOTA otomatis bayar FULL CASH ,maka PARAMS terkahir == "cash" di isi dengan $AFTERPPN dan tidak insert CICILAN
            $get_order_id       = $this->penjualan_model->insert_transaksi_header($kode_customer,$account_id,$grandtotal,$ppn,$total_after_ppn,"lunas",$total_after_ppn,$kredit,"0","cash",$order_id);            
        }

        // Proses Edit Nota
        if ($order_id!='') {
            $log_data_pembayaran = array();
            $log_data_pinjaman   = array();
            $log_data['data_transaksi']         = $this->penjualan_model->get_penjualan($order_id);
            $log_data['data_transaksi_detail']  = $this->penjualan_model->get_penjualan_detail($order_id);
            $data_transaksi = json_encode($log_data);

            if (!empty($log_data['data_transaksi'])) {
                if ($log_data['data_transaksi'][0]['payment_method']=='kredit') {
                    // Return 1 Data
                    $log_data_pinjaman['total_hutang_before']   = $this->cicilan_model->get_data_cicilan(array('no_anggota'=>$log_data['data_transaksi'][0]['kode_customer'],
                                                                                      'status'=>'belum','update_timestamp'=> NULL,'keterangan'=>'transaksi_penjualan'),
                                                                                      'no_anggota');
                    // Return 1 Data
                    $log_data_pinjaman['detail_pinjaman_before']= $this->cicilan_model->get_data_cicilan(array('order_id'=>$log_data['data_transaksi'][0]['order_id'],'keterangan'=>'transaksi_penjualan'));
                    
                    // Jika Pembelian Sebelumnya ada Hutang ,Hapus Table di cicilan
                    $this->cicilan_model->delete_cicilan_penjualan($log_data['data_transaksi'][0]['order_id'],"transaksi_penjualan");

                    // Log Hutang Setelah Data di Hapus
                    $log_data_pinjaman['total_hutang_after']   = $this->cicilan_model->get_data_cicilan(array('no_anggota'=>$log_data['data_transaksi'][0]['kode_customer'],
                                                                                      'status'=>'belum','update_timestamp'=> NULL,'keterangan'=>'transaksi_penjualan'),
                                                                                      'no_anggota');
                    // Jika Hutang nya sudah di bayarkan ,Hapus di table transaksi_pembayaran
                    if (!empty($log_data_pinjaman['detail_pinjaman_before']) && !empty($log_data_pinjaman['detail_pinjaman_before'][0]['id_pembayaran']) ) {

                        $log_data_pembayaran['data_pembayaran_before'] = $this->calculate_transaksi_pembayaran($log_data_pinjaman['detail_pinjaman_before'][0]['id_pembayaran']);
                        $log_data_pembayaran['data_pembayaran_after']  = $this->calculate_cicilan($log_data_pinjaman['detail_pinjaman_before'][0]['id_pembayaran']);

                        // Update Table Pembayaran
                        $this->update_table_pembayaran($log_data_pembayaran['data_pembayaran_after'][0]['sum_cicilan_nominal_pembayaran'],$log_data_pinjaman['detail_pinjaman_before'][0]['id_pembayaran']);
                    }
                }

                $data_pinjaman      = json_encode($log_data_pinjaman);
                $data_pembayaran    = json_encode($log_data_pembayaran);

                $this->penjualan_model->insert_log_penjualan($log_data['data_transaksi'][0]['order_id'],$data_transaksi,$data_pinjaman,$data_pembayaran);


                // Hapus Data di table transaski
                $this->penjualan_model->delete_transaksi($order_id);
                // Hapus Data di table_transaksi_detail
                $this->penjualan_model->delete_transaksi_detail($order_id);
                // Hapus Data di table Stok
                $this->penjualan_model->delete_stok_penjualan(array('order_id_penjualan'=>$order_id));
            }
            else
            {
                echo "PLEASE CONTACT ADMINISTRATOR !";
                die;
            }
             
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
        // print_r($data['detail_penjualan']);
        $this->load->view("koperasi_view_transaksi_penjualan",$data);
    }
    public function json_detail_penjualan(){
        $order_id = $this->input->get("order_id");
        $data = $this->penjualan_model->select_nota($order_id);
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die;
        header("content-type:application/json");
        echo json_encode($data);

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
    public function _remap(){
        $this->indexfixer->remap();
    }

}
?>