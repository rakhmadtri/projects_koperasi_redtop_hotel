<?php
class transaksi_pembelian extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("pembelian_model");
        $this->load->model("barang_model");
        $this->data["account_login"]	=	$this->session->userdata("username");
    }
    public function index($orderId=""){
        if ($orderId!="") {
            $this->data['detail_pembelian'] =  $this->pembelian_model->select_transaksi_po($orderId); 
            $this->load->view("koperasi_transaksi_pembelian_po_approve_view",$this->data);
        }else{
            $this->load->view("koperasi_transaksi_pembelian_po_view");
        }        
    }
    public function insertTransaction(){
        // print_r($this->input->post());
        // die();
        $count              =    count($this->input->post("kodebarang"));
		//ambil user yang melayani transaksi pembelian tsb
		$nopembelian        =   $this->input->post("nopembelian");
        $accountId	        =   $this->data["account_login"][0]["account_id"];
    	$txtKodeSupplier	=	$this->input->post("kodesupplier");
        $kodeBarang         =   $this->input->post("kodebarang");
        $qty                =   $this->input->post("qty");
        $buying_price       =   $this->input->post("harga");
        $sub_total          =   $this->input->post("subtotal");
        $grandTotal         =   $this->input->post("grandtotal");
        $totalPph           =   $this->input->post("pph");
        $totalSupplierPrice =   $this->input->post("afterpph");
        $statusPembelian    =   $this->input->post("button");
        // Jika pembelian di approve oleh manager
        if ($nopembelian!="" && $statusPembelian=="approve") {
                $this->pembelian_model->edit_status_pembelian($nopembelian, $grandTotal, $totalSupplierPrice,$statusPembelian);
                for ($i=0; $i<$count; $i++) {
                $item_stok['status']                = "barangmasuk";         
                $item_stok['kode_barang']           = $kodeBarang[$i];
                $item_stok['order_id_pembelian']    = $nopembelian;
                $item_stok['qty']                   = $qty[$i];
                $detail_stok[]                      = $item_stok;  
                }

                $detail=array();
                for ($i=0; $i<$count; $i++) { 
                    $item['order_id']       =   $nopembelian;
                    $item['order_master_id']=   $kodeBarang[$i];
                    $item['qty']            =   $qty[$i];
                    $item['buying_price']   =   $buying_price[$i];
                    $item['sub_total']      =   $sub_total[$i];
                    $detail[]   =$item;   
                }
                
                $this->pembelian_model->delete_pembelian_detail($nopembelian);
                $this->insert_transaksi_detail("pembelian_detail",$detail);
                // Validasi Jika di delete semua kode barang nya ,namun di klik Approve
                if ($grandTotal!=0) {
                        $this->insert_temp_stok($detail_stok);
                }
                redirect(base_url()."approval_po");
        }
        else if ($nopembelian!="" && $statusPembelian!="approve") {
            # Jika pemesanan di reject
            $this->pembelian_model->update_status($nopembelian,$statusPembelian);
            redirect(base_url()."approval_po");
        }
        // Insert Transaksi --> Default status == pending
        else{
            
            $get_order_id   = $this->pembelian_model->insert_transaksi_header($txtKodeSupplier,$accountId,$grandTotal,$totalPph,$totalSupplierPrice);
            $detail=array();
            $detail_stok=array();
            for ($i=0; $i<$count; $i++) { 
                $item['order_id']       =   $get_order_id;
                $item['order_master_id']=   $kodeBarang[$i];
                $item['qty']            =   $qty[$i];
                $item['buying_price']   =   $buying_price[$i];
                $item['sub_total']      =   $sub_total[$i];
                $detail[]   =$item;   
            }
       
            for ($i=0; $i<$count; $i++) {
                $item_stok['status']                = "barangmasuk";         
                $item_stok['kode_barang']           = $kodeBarang[$i];
                $item_stok['order_id_pembelian']    = $get_order_id;
                $item_stok['qty']                   = $qty[$i];
                $item_stok['harga_beli']            = $buying_price[$i];
                $presentase                         = $this->barang_model->select_presentase($kodeBarang[$i],$item_stok['harga_beli']);
                $item_stok['harga_jual']            = $presentase;
                $detail_stok[]                      = $item_stok;  
            }

            $this->insert_transaksi_detail("pembelian_detail",$detail);
            // redirect(base_url()."transaksi_pembelian");

            $data_po['data_detail_po']   =   $this->pembelian_model->select_transaksi_po($get_order_id);

            $this->load->view("koperasi_cetak_purchase_order_dummy",$data_po);
        }

    }
    public function viewTransaksiPembelian($orderId){
        $data['detail_pembelian']   =   $this->pembelian_model->select_transaksi_po_report($orderId);
        $this->load->view("view_transaksi_pembelian",$data);
    }
    public function _remap(){
        $this->indexfixer->remap();
    }
}
?>