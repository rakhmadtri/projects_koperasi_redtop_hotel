<?php 

	/**
	* 
	*/
	class MY_Controller extends CI_Controller
	{
		// private $data;
		//jika ingin proses ini dipanggil sebelum menjalankan 
		//controller lainnya, taroh di constructor ini
		function __construct()
		{
			parent::__construct();
			$username=$this->session->userdata("username");
			$segment =$this->uri->segment(1);
			//Jika Belum Login
			if($username=="" && $this->uri->segment(1)!="login"){
				redirect(base_url()."login");
			}
			//Jika Sudah Login Hak akses
			/*else if($username!=""){
				if ($this->cekUrl($segment)==false && $segment!="login" && $segment!="created_xls" && $segment!="home" && $segment!="report" && $segment!="master_pt" && $segment!="master_customer" && $segment!="master_supplier" && $segment !="master_barang" && $segment!="master_user" && $segment!="invoice") {
					// redirect(base_url()."home");
					show_404(403);
				}
			}
			*/
				// print_r($this->session->userdata("username"));
				// for
				// die();
				// else{
				// 	show_404(404);
				// }

			// $this->load->model("user_model");
			// $this->load->model("supplier_model");
			// $this->load->model("customer_model");
			// $this->load->model("barang_model");
			// $this->load->model("penjualan_model");
			// $this->load->model("pembelian_model");
			// $this->load->model("invoice_model");
			// $this->load->model("cabang_model");
			// $this->data['count_user']				=count($this->user_model->allUser());
			// $this->data['count_pt']					=count($this->cabang_model->select_cabang());
			// $this->data['count_customer']			=count($this->customer_model->select_customer());
			// $this->data['count_supplier']			=count($this->supplier_model->select_supplier());
			// $this->data['count_barang']				=count($this->barang_model->select_product());
			// $this->data['count_surat_jalan']		=count($this->penjualan_model->select_surat_jalan());
			// $this->data['count_invoice']			=count($this->invoice_model->all_invoice());
			// $this->data['count_transaksi_penjualan']=count($this->penjualan_model->all_penjualan_now());
			// $this->data['count_transaksi_pembelian']=count($this->pembelian_model->all_pembelian_now());
			// $this->data['count_report_penjualan']	=count($this->penjualan_model->all_penjualan_now());
			// $this->data['count_report_stok']		=count($this->barang_model->select_stok_product_all());
			// print_r($this->data['summary_transaksi']);
		}
		public function cicilan_count_lunas($order_id,$keterangan="transaksi_pinjaman"){
			$result = $this->db->query("SELECT *
										FROM cicilan c
										WHERE 1
										AND c.`order_id`='".$order_id."'
										AND c.`keterangan`='".$keterangan."'
										AND c.`status`='lunas'
										AND c.`update_timestamp` IS NOT NULL");
			return $result->num_rows();
		}
		public function transaksi_pinjaman_count_lama_cicilan($order_id){
			$result = $this->db->query("SELECT *
										FROM transaksi_pinjaman tp
										WHERE 1
										AND tp.`id`='".$order_id."'")->result_array();
			if (!empty($result)) {
				return $result[0]['lama_cicilan'];
			}
			else{
				return 0 ;
			}
		}

		public function get_counter_angsuran($order_id,$keterangan="transaksi_pinjaman"){
			$result = $this->db->query("SELECT *,MIN(c.`angsuran_ke`) AS 'counter_angsuran'
										FROM cicilan c
										WHERE 1
										AND c.`order_id`='".$order_id."'
										AND c.`keterangan`='".$keterangan."'")->result_array();
			if (!empty($result)) {
				return $result[0];
			}
			else{
				return 0;
			}
		}


		public function insert_log_saldo($data_array){
			$this->db->insert("log_saldo_anggota");
		}

	  	public function general_cek_validation($namaTable,$txtInput,$kondisi){
			$this->db->select($txtInput);
			$this->db->where($kondisi);
			$result 	=$this->db->get($namaTable);
			return $result->result_array();
		}

		/* Batas funtion jayabaru */
		public function insert_transaksi_detail($table,$data_detail){
			$this->db->insert_batch($table,$data_detail);
		
		}
		public function insert_temp_stok($data_detail_stok){
			// print_r($data_detail_stok);
			// die();
			$this->db->insert_batch("temp_stok_barang",$data_detail_stok);
		}
		public function insert_stok($data_detail_stok){
			// print_r($data_detail_stok);
			// die();
			$this->db->insert_batch("stok_barang",$data_detail_stok);
		}
		public function cekPrimaryKey($table,$field,$params){
			$result	= $this->db->query("SELECT * FROM $table WHERE $field = '$params'  ");
		return $result->result_array();
		}
	    public function generatedKode($string,$params){
	        $result     =   $string.date("y").str_pad($params,4,0,STR_PAD_LEFT);
        	return $result;
    	}
    	public function get_last_id($namaTable,$namaField){
    		$result 	=	$this->db->query("SELECT COUNT(".$namaField.") AS maxId FROM ".$namaTable." ");
    		return $result->result_array();
    	}
    	public function cekUrl($currentUrl){
    		$hakAkses=$this->session->userdata("hak_akses");
    		foreach ($hakAkses as $key => $value) {
					if ($value['link_menu']==$currentUrl) {
						return true;
					}
				}
				return false;
		}

		public function validasi_pinjaman_anggota($type){
			$result =	$this->db->query("SELECT nominal_max FROM config_nominal_pinjaman WHERE 1 AND type='".$type."' ORDER BY id DESC")->result_array();
			return $result[0]['nominal_max'];
		}

		public function get_data_cicilan($params_array){
			$this->db->from('cicilan');
			if (is_array($params_array))
			{
				foreach ($params_array as $key => $value) {
					$this->db->where($key,$value);
				}
			}
			else
			{
				die("ERROR");
			}


			
			$query = $this->db->get()->result_array();

			if (!empty($query)) {
				return $query;
			}
			else{
				die("ERROR");

			}
		}

		public function insert_table_pembayaran($data){
			$this->db->insert('transaksi_pembayaran',$data);
			return $this->db->insert_id();
		}

		public function update_table_pembayaran($total_nominal,$id_pembayaran){
			$this->db->update('transaksi_pembayaran',array('total_nominal'=>$total_nominal),array('id'=>$id_pembayaran));
		}

		public function calculate_cicilan($id_pembayaran='',$params_array=''){
			if ($id_pembayaran!='') {
				$params = "AND ci.`id_pembayaran`=$id_pembayaran";
			}
			else{
				$params = '';
			}
			if ($params_array!='') {
				if (is_array($params_array)) {
					foreach ($params_array as $key => $value) {
						if ($key=='from') {
							$params .= " AND ci.update_timestamp>='".$value."' ";
						}
						if ($key=='to')
						{
							$params .= " AND ci.update_timestamp<='".$value." 23:59:59' ";
						}
					}
				}
			}
			$sql 	= "SELECT *,SUM(ci.`cicilan_perbulan`) AS sum_cicilan_nominal_pembayaran
								FROM cicilan ci
								WHERE 1
								AND ci.`id_pembayaran` IS NOT NULL
								$params
								GROUP BY ci.`id_pembayaran`";
			$result = $this->db->query($sql)->result_array();
			// echo $this->db->last_query();
			return $result;
		}

		public function calculate_transaksi_pembayaran($id_pembayaran='',$params_array=''){
			if ($id_pembayaran!='') {
				$params = "AND `id`=$id_pembayaran";
			}
			else{
				$params = '';
			}
			if ($params_array!='') {
				if (is_array($params_array)) {
					foreach ($params_array as $key => $value) {
						if ($key=='from') {
							$params .= " AND timestamp>='".$value."' ";
						}
						if ($key=='to')
						{
							$params .= " AND timestamp<='".$value." 23:59:59' ";
						}
					}
				}
			}
			$sql 	= "SELECT *
						FROM transaksi_pembayaran 
						WHERE 1
						$params  ";
			$result = $this->db->query($sql)->result_array();
			return $result;
		}
		public function print_r($value='')
		{
			echo "<pre>";
			print_r($value);
			echo "</pre>";
		}

	}
?>