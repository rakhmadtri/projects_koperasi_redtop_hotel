<?php 
class transaksi_pinjaman extends MY_Controller
{
	function __construct()
	{	
		parent::__construct();
		$this->load->model("pinjaman_model");
        $this->load->model("cicilan_model");
		$this->data["account_login"] = $this->session->userdata("username");
        $this->load->helper('currency_format_helper');
	}
	public function index(){
        if (isset($_GET['trxid'])) {
            $orderId=$_GET['trxid'];
        }
        $data['data_anggota']   =   $this->pinjaman_model->select_anggota();
        $data['data_nominal']   =   $this->pinjaman_model->select_nominal();
        $this->load->view("koperasi_transaksi_pinjaman_view",$data);
    }
     public function insertTransaction(){
        // print_r($this->input->post());
        // die();
        $account_id             =   $this->data["account_login"][0]["account_id"];
        $jumlah_pinjaman        =   $this->input->post("jumlah_pinjaman");
        $jumlahAngsuran         =   $this->input->post("angsuran");
        $bunga			        =   $this->input->post("bunga");
       
        $no_anggota             =   $this->input->post("no_anggota");
        $lama_cicilan           =   $this->input->post("lama_cicilan");
        $total_hutang           =   $jumlah_pinjaman + $bunga;
        $keterangan				= 	$this->input->post("keperluan");

        $get_order_id = $this->pinjaman_model->get_order_id();
        
        if ($get_order_id == 0){
            $get_order_id = 1;
        }else{
            $get_order_id = $get_order_id + 1;
        }
        $getIdPinjaman    = $this->pinjaman_model->insert_transaksi_pinjaman($this->generatedKode("PJ",$get_order_id),$no_anggota,$jumlah_pinjaman,$lama_cicilan,$bunga,$keterangan,$total_hutang);
        
        for ($i=1; $i <=$lama_cicilan ; $i++) { 
            //  public function insert_cicilan($order_id,$no_anggota,$jumlah,$bunga,$cicilan_perbulan,$keterangan="")
            $this->cicilan_model->insert_cicilan($getIdPinjaman,$i,$no_anggota,$jumlah_pinjaman,$bunga,$jumlahAngsuran,"transaksi_pinjaman",$total_hutang,$i);
        }

        $data['data_transaksi'] = $this->pinjaman_model->get_header_pinjaman($getIdPinjaman);
        $this->load->view("koperasi_cetak_transaksi_pinjaman",$data);
    }
    public function currentPinjaman(){
        $no_anggota                           =   $this->input->post("no_anggota");
        $resultTotalPinjaman['total_pinjaman']=   $this->pinjaman_model->select_pinjaman($no_anggota);
        $resultTotalPinjaman['nominal_max']   =   $this->pinjaman_model->select_max_pinjaman("pinjaman_koperasi");
        header("content-type:application/json");
        echo json_encode($resultTotalPinjaman);
    }

    public function nominalPinjaman(){
        $params                           =   $this->input->get("jumlah_pinjaman");
        $data['set_pinjaman']             =   $this->pinjaman_model->select_set_nominal($params);
        // $resultTotalPinjaman['nominal_max']   =   $this->pinjaman_model->select_max_pinjaman();
        // $data= $this->db->last_query();
        header("content-type:application/json");
        echo json_encode($data);
    }
}
?>