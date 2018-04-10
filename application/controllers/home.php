<?php 
class home extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("penjualan_model");
		$this->load->model("report_model");
		$this->load->model("anggota_model");
		$this->load->helper("currency_format_helper");
	}
	public function index(){		
		$data['reminder_stok'] = $this->report_model->reminder_select_stok_product_all();
		$data['summary'] = $this->report_model->get_summary_transaksi();
		$data['summary_profit_by_month'] = $this->report_model->get_all_profit_by_month();
		$data['count_anggota'] = $this->anggota_model->select_anggota_all();

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die;
		$asset_by_harga_jual = 0;
		$asset_by_harga_beli = 0;
		$data['sum_transaksi_jual'] = 0;
		$data['sum_transaksi_beli'] = 0;
		$data['sum_profit_inventory'] = 0;
		$data['sum_profit_koperasi'] = 0;

		if (!empty($data['summary'])) {
			foreach ($data['summary'] as $key => $value) {
				$data['sum_transaksi_jual'] += $value['total_jual'];
				$data['sum_transaksi_beli'] += $value['total_beli'];
			}
		}
		if (!empty($data['summary_profit_by_month'])) {
			foreach ($data['summary_profit_by_month'] as $key => $value) {
				$data['sum_profit_inventory'] += $value['profit_inventory'];
				$data['sum_profit_koperasi'] += $value['profit_koperasi'];
			}
		}
		// die;
		// echo json_encode($data['summary']);
		// die;
         // $data['all_penjualan']    =   $this->report_model->all_penjualan();
         // header("content-type:application/json");
         // echo json_encode($data);
		$temp_value_inv = $this->report_model->get_value_inventory();
		if (!empty($temp_value_inv)) {
			foreach ($temp_value_inv as $key => $value) {
				$asset_by_harga_jual += $value['asset_by_harga_jual'];
				$asset_by_harga_beli += $value['asset_by_harga_beli'];
			}
		}
		$temp_profit_inventory 		= $this->report_model->get_profit_inventory();
		$temp_profit_koperasi 		= $this->report_model->get_profit_koperasi();
		$data['asset_by_harga_jual']= $asset_by_harga_jual;
		$data['asset_by_harga_beli']= $asset_by_harga_beli;
		$data['profit_by_year_inventory'] 	= $temp_profit_inventory[0];
		$data['profit_by_year_koperasi'] 	= $temp_profit_koperasi[0];
		// var_dump($data);
		// die;
		$this->load->view("home_view",$data);
	}
    public function insertChat(){
        $datauser   = $this->session->userdata("username");
        $dataChat   =   $this->input->post("txtChat");
        $this->dashboard_model->insert_chat($dataChat,$datauser[0]['id']);
        redirect(base_url());
    }
    public function send_mail(){
			$to="samuelerwardi@gmail.com";

			$from="samuel@gmai.com";
			$subject="subject";
		      $header  = 'MIME-Version: 1.0' . "\r\n";
	          $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	          $header .=  "From: $from" . "\r\n" .
	                     "Reply-To: $from";
	          $content ="Content email";
	          // $content.="Link Download Product ".$namaProduct.":<b>".$getLinkDownload."</b><br><br>";
	          
	          $var = mail($to,$subject,$content,$header);
	          var_dump($var);
	          die();
    }

}






?>