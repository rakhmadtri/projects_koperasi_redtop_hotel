<?php 
/**
* 
*/
class transaksi_submit_cicilan extends MY_Controller
{

	function __construct()
	{	
		parent::__construct();
		$this->load->model("cicilan_model");
	}
	public function index(){
		$data['data_anggota']	=	$this->cicilan_model->get_cicilan();
		$this->load->view("koperasi_submit_cicilan_view",$data);
	}
	public function select_cicilan_header(){
		$no_anggota =	$this->input->get("term");
		$data 	  	=	$this->cicilan_model->get_header_cicilan($no_anggota);

    	header("content-type:application/json");
    	echo json_encode($data);
	}
	public function select_cicilan_detail(){
		$params 	 =	explode("-",$this->input->get("params"));
		$no_anggota  =	$this->input->get("no_anggota");
		$order_id  	 =	$params[0];
		$keterangan  =	$params[1];

		$data['detail_pinjaman'] 	=	$this->cicilan_model->get_detail_cicilan($no_anggota,$order_id,$keterangan);

    	header("content-type:application/json");
    	echo json_encode($data);
	}
	public function submit_cicilan(){
		$user_id  = $this->session->userdata("username");
		$id_login = $user_id[0]['account_id'];

		$temp_no_pinjaman 	=	explode("-",$this->input->post("no_pinjaman"));
		$no_pinjaman		=	$temp_no_pinjaman[0];
		$angsuran_ke		=	$this->input->post("angsuran_ke");
		$tgl_jatuh_tempo	=	$this->input->post("tgl_jatuh_tempo");
		$tgl_pembayaran		=	$this->input->post("tgl_pembayaran");
		$keterangan 		=	$this->input->post("keterangan");
		$tgl_pembayaran 	=	$tgl_pembayaran." ".date("H:i:s");  
		
		// Return 1 Data Array
		$get_data_cicilan = $this->get_data_cicilan(array("order_id"=>$no_pinjaman,"angsuran_ke"=>$angsuran_ke,"keterangan"=>$keterangan));
		if (count($get_data_cicilan)==1) {
			var_dump($get_data_cicilan);
			$get_id_pembayaran = $this->insert_table_pembayaran(array('account_id'=>$id_login,
												 'total_nominal'=>$get_data_cicilan[0]['cicilan_perbulan']));
		}
		else{
			// Data lebih dari 1
			die('ERROR');
		}

		$this->cicilan_model->update_pembayaran($no_pinjaman,$angsuran_ke,$tgl_pembayaran,$get_id_pembayaran,$keterangan);


		if ($keterangan=="transaksi_pinjaman") 
		{
			$count_cicilan = $this->cicilan_count_lunas($no_pinjaman);
	        $lama_cicilan  = $this->transaksi_pinjaman_count_lama_cicilan($no_pinjaman);
	        if ($count_cicilan==$lama_cicilan) {
	        	$this->cicilan_model->update_pembayaran_header($no_pinjaman);
	        }
		}
		else
		{
			$this->cicilan_model->update_transaksi_pembayaran_header($no_pinjaman);
		}
		redirect(base_url()."transaksi_submit_cicilan");
	}
}

?>