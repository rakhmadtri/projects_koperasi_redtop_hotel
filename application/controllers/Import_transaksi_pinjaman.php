<?php 
class Import_transaksi_pinjaman extends MY_Controller
{
    function __construct()
    {   
        parent::__construct();
        $this->load->model("barang_model");
        $this->load->model("opname_stok_model");
        $this->load->model('penjualan_model');
        $this->load->model('anggota_model');
        $this->load->model('simpanan_model');
        $this->load->model('pinjaman_model');
        $this->load->model('cicilan_model');
        $this->data["account_login"] = $this->session->userdata("username");
        $this->load->helper('currency_format_helper');
    }
    public function index(){
        // $data['data_anggota'] =   $this->penjualan_model->select_anggota();
        $data['data_anggota'] =   $this->anggota_model->select_anggota_all();
        $this->load->view("koperasi_view_import_transaksi_pinjaman",$data);
    }
     public function insert(){
        $data = array();
        
        $nominal = $this->input->post('nominal');
        $anggota = $this->input->post('anggota');

        $get_order_id = $this->pinjaman_model->get_order_id();
        if ($get_order_id == 0){
            $get_order_id = 1;
        }else{
            $get_order_id = $get_order_id + 1;
        }
        $data['bunga'] = $nominal;
        $data['no_anggota'] = $anggota;
        $data['is_import'] = 1;
        $data['pinjaman_id'] = $this->generatedKode("PJ",$get_order_id);       
        $data['jumlah_pinjaman'] = $nominal;
        $data['total_pinjaman'] = $nominal;
        $data['lama_cicilan'] = 1;
        $data['keterangan'] = "import 2016";
        $data['status'] = "lunas";






        $last_id = $this->pinjaman_model->insert($data);

        if (is_numeric($last_id)) {
            $cicilan['angsuran_ke'] = 1;
            $cicilan['order_id'] = $last_id;
            $cicilan['no_anggota'] = $anggota;
            $cicilan['bunga'] = $nominal;
            $cicilan['keterangan'] = 'transaksi_pinjaman';
            $cicilan['jumlah'] = $nominal;
            $cicilan['total_pinjaman'] = $nominal;
            $cicilan['cicilan_perbulan'] = $nominal;
            $cicilan['jatuh_tempo'] = "2016-12-31 23:59:59";
            $cicilan['insert_timestamp'] = "2016-12-31 23:59:59";
            $cicilan['update_timestamp'] = "2016-12-31 23:59:59";
            $cicilan['status'] = "lunas";

            $this->cicilan_model->insert($cicilan);

            $this->session->set_flashdata("notifikasi","update");
        }
        redirect(base_url()."import_transaksi_pinjaman");
    }
}
?>