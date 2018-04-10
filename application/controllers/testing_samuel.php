<?php
class testing_samuel extends MY_Controller{
    function __construct(){
        parent::__construct();
	    $this->load->library("excel_reader");
	    $this->load->model("simpanan_model");
        $this->load->model("pinjaman_model");
        $this->load->model("penjualan_model");
    }
    public function index(){
    	// $this->load->view("koperasi_print_view");
    	$result['data_pinjaman_anggota'] =	$this->db->query("SELECT *
																FROM transaksi_pinjaman tp
																JOIN cicilan ci ON tp.`id`=ci.`order_id`
																JOIN master_anggota ma ON ma.`no_anggota`=tp.`no_anggota`
																WHERE 1
																AND ci.`status`='belum'
																AND ci.`keterangan`='transaksi_pinjaman'
																GROUP BY ma.`no_anggota`
																ORDER BY jatuh_tempo ASC")->result_array();
    	// print_r($result);
    	$this->load->view("koperasi_cetak_transaksi_pinjaman_dummy",$result);
    }
    public function cetak_pinjaman(){
    	// $this->load->view("koperasi_cetak_transaksi_pinjaman_dummy");
        $order_id=13;
        $result['data_detail_po']   =    $this->db->query("SELECT *,DATE_FORMAT(pe.`order_timestamp`,'%Y/%m/%d') AS pembelian_timestamp
                                                FROM pembelian pe 
                                                JOIN pembelian_detail pd ON pe.`order_id`=pd.`order_id`
                                                JOIN master_supplier su ON su.`kode_supplier`=pe.`kode_supplier`
                                                JOIN master_barang mb on mb.`kode_barang`=pd.`order_master_id`
                                                JOIN user u ON u.`account_id`=pe.`account_id`
                                                WHERE 1
                                                AND pe.`status`='pending'
                                                AND pe.`order_id`='".$order_id."' ")->result_array();
        // echo "<pre>";
        // print_r($result['data_detail_po']);
        // echo $result['data_detail_po'][0]['pembelian_timestamp'];
        // echo "</pre>";
        $this->load->view("koperasi_cetak_purchase_order_dummy",$result);
    }
    public function cetak_simpanan($transaksi_id=31){
            $data['header_simpanan']    =   $this->simpanan_model->get_header_simpanan($transaksi_id);
            $data['detail_simpanan']    =   $this->simpanan_model->get_detail_simpanan($transaksi_id);
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // die();
            $this->load->view("koperasi_cetak_transaksi_simpanan",$data);
    }
    public function cetak_pinjaman2(){
        $transaksi_id=34;
        $data['data_transaksi'] = $this->pinjaman_model->get_header_pinjaman($transaksi_id);
        $this->load->view("koperasi_cetak_transaksi_pinjaman",$data);
    }
    public function cetak_nota2(){
        $data['data_penjualan'] = $this->penjualan_model->select_nota(1);
        $this->load->view("koperasi_cetak_nota_dummy",$data);   
    }
    public function cetak_nota(){
        $data['data_penjualan'] = $this->penjualan_model->select_nota(4);
        $this->load->view("koperasi_cetak_nota",$data);   
    }
}
?>