<?php
class Transaksi_pengeluaran extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Pengeluaran_model");
        $this->data["account_login"]    =   $this->session->userdata("username");
        $this->load->helper('currency_format_helper');
    }
    public function index($orderid=''){
        $this->load->view("transaksi_pengeluaran_view",$this->data);
    }


    public function insertTransaction(){
        // echo "<pre>";
        // print_r($this->input->post());
        // echo "</pre>";
        // die;
        $order_id               =   $this->input->post("nopenjualan");
        $account_id             =   $this->data["account_login"][0]["account_id"];
        $kodeBarang             =   $this->input->post("kodebarang");
        $qty                    =   $this->input->post("qty");
        $price                  =   $this->input->post("harga");
        $grandtotal             =   $this->input->post("grandtotal");
        $ppn                    =   $this->input->post("pph");
        $total_after_ppn        =   $this->input->post("afterpph");
        $sub_total              =   $this->input->post("subtotal");

        $detail_stok            =   array();  
        $count                  =   count($this->input->post("kodebarang"));

        $data['account_id'] = $account_id;
        $data['total_before_ppn'] = $grandtotal;
        $data['ppn'] = $ppn;
        $data['total_after_ppn'] = $total_after_ppn;


        $id_pengeluaran = $this->Pengeluaran_model->insert($data);
        // Insert transaksi_detail
        $detail=array();
        for ($i=0; $i<$count; $i++) { 
            $item['pengeluaran_detail_id'] = $id_pengeluaran;
            $item['product_name']          = $kodeBarang[$i];
            $item['qty']                   = $qty[$i];
            $item['price']                 = $price[$i];
            $item['sub_total']             = $sub_total[$i];
            $detail[]   =$item;   
        }
        // echo "<pre>";
        // print_r($detail);
        // echo "</pre>";
        $this->Pengeluaran_model->insert_detail($detail);
        // die;
        redirect(base_url()."transaksi_pengeluaran",'refresh');
        //Untuk Cetak Nota
        // $data['data_penjualan'] = $this->penjualan_model->select_nota($get_order_id);
        // $this->load->view("koperasi_cetak_nota",$data); 
    }
    
    public function _remap(){
        $this->indexfixer->remap();
    }

}
?>