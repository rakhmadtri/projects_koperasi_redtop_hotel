<?php
class pelunasan_pinjaman_anggota extends MY_Controller{
    function __construct(){
        parent::__construct();
	    $this->load->model("pinjaman_model");
        $this->load->model("cicilan_model");
    }
    //Looping select pada list suratjalan
    public function index(){
    	// $this->data['transaksi_0']	=	$this->penjualan_model->all_transaksi_distinct();
        // $data['data_po']    =   $this->pembelian_model->select_approve("approve");
        $data['data_anggota']   =   $this->cicilan_model->get_cicilan();
    	$this->load->view("koperasi_pelunasan_pinjaman_anggota",$data);
    }
    public function update_transaksi_pinjaman(){
        // print_r($this->input->post());
        // die;
        $no_anggota = $this->input->post("no_anggota");
        $tgl_pembayaran     =  date("Y-m-d H:i:s");  

        $this->cicilan_model->update_pembayaran_by_no_anggota($no_anggota,$tgl_pembayaran);
        $this->pinjaman_model->update_pembayaran_header($no_anggota);
        redirect(base_url()."pelunasan_pinjaman_anggota");
    }
    public function list_pinjaman_anggota(){
        $no_anggota = $this->input->post("no_anggota");
        $data       = $this->cicilan_model->get_detail_cicilan_pelunasan($no_anggota);
     
        // print_r($data);
        header("content-type:application/json");
        echo json_encode($data);
    }


}
?>