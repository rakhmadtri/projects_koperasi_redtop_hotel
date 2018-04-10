<?php
class master_barang extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("barang_model");
    }
    public function index($is_xls=FALSE){
        // echo $is_xls;
        // print_r($this->uri->segment(2));
        // die();
        if ($is_xls==FALSE) {
            if(isset($_GET['query'])!=""){
               $this->data['all_product']=$this->barang_model->select_product();
            }
            else{
                $this->data['all_product']=$this->barang_model->select_product();
            }
            $this->load->view("koperasi_master_barang_view",$this->data);       
        }else{
            // echo "string";
            // echo $is_xls;
            // die();
            $data['all_product']=$this->barang_model->select_product();
            $this->load->view("xls_view_barang",$data);
        }
    }
    public function insertProduct(){
        $kodeBarang     =   $this->input->post("kode_barang");
        $product_type   =   $this->input->post("product_type");
        $namaBarang     =   $this->input->post("nama_barang"); 
        $txtDeskripsi   =   $this->input->post("deskripsi");
        $harga_beli     =   $this->input->post("harga_beli");
        $txtPresentase  =   $this->input->post("presentase");
        $harga_jual     =   $this->input->post("harga_jual");
        $txtStatus      =   1;
        // print_r($this->input->post());
        $cek_kode_barang =  $this->barang_model->cek_kode_barang($kodeBarang);
        if (empty($cek_kode_barang)) {
            $this->barang_model->insert_product($kodeBarang,$namaBarang,$txtDeskripsi,$harga_beli,$txtPresentase,$harga_jual,$txtStatus,$product_type);
        }else{
            $this->barang_model->edit_product($kodeBarang,$product_type,$namaBarang,$txtDeskripsi,$harga_beli,$txtPresentase,$harga_jual,$txtStatus);
            $var_username = $this->session->userdata("username");
            $cek_kode_barang[0]['account_id'] = $var_username[0]['account_id'];

            $this->barang_model->insert_log_product($cek_kode_barang[0]);
        }

     
        redirect(base_url()."master_barang");
    }
    public function created_xls(){
            $data['all_product']=$this->barang_model->select_product();
            // print_r($this->data);
            // die();
            $this->load->view("xls_view_barang",$data);
    }
    public function deleteBarang($kodeBarang){
        $this->barang_model->delete_barang($kodeBarang);
        redirect(base_url()."master_barang");
    }
    //Buat autocomplete di form transaksi
    public function allProduct($kode_barang_scanner=""){

        if ($kode_barang_scanner!="") {
            $data   =   $this->barang_model->select_product_autocomplete($kode_barang_scanner);
            header("content-type:application/json");
    		echo json_encode($data[0]);
        }
        else{
            $term   =   $this->input->get("term");
            $data   =   $this->barang_model->select_product_autocomplete($term);
            echo json_encode($data);
        }
        // echo $this->db->last_query();
    }

    //Buat autocomplete di form transaksi pengeluaran
    public function allProductInventaris($kode_barang_scanner=""){
        // $kode_barang = $this->input->get("kode_barang");
        header("content-type:application/json");
        if ($kode_barang_scanner!="") {
            $data   =   $this->barang_model->select_product_autocomplete($kode_barang_scanner);
            echo json_encode($data[0]);
        }
        else{
            $term   =   $this->input->get("kode_barang");
            $data   =   $this->barang_model->select_product_autocomplete($term);
            echo json_encode($data);
        }
        // echo $this->db->last_query();
    }
    public function allProductBeli(){
        $term   =   $this->input->get("term");
        $data   =   $this->barang_model->select_product_autocomplete_beli($term);
        echo json_encode($data);
    }

    // Buat validasi STOK di trx jual
    public function currentStok(){
        $kodeBarang     =   $this->input->post("id_barang");
        $qtyPesan       =   $this->input->post("qty");
        $product_type   =   $this->barang_model->cek_kode_barang($kodeBarang);
        
        $currentStok    =   $this->barang_model->select_stok_product_current($kodeBarang);

        if ($product_type[0]['type']!="jasa") {
            if (empty($currentStok) OR $qtyPesan>$currentStok[0]['stok']) {
                echo "OUT OF STOCK";
            }
        }
    }
    public function cek_validation(){
        $txtInput   =   $this->input->post("data_js");
        $data       =   $this->general_cek_validation("master_barang","*",array("status"=>1,"kode_barang"=>$txtInput));
        if (count($data)>0) {
            header("content-type:application/json");
            echo json_encode($data[0]);
        }
    }
    public function _remap(){
        $this->indexfixer->remap();
    }

}
?>