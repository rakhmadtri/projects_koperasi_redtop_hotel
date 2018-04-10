<?php 

	class testreport extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->library("crystalreport");
		}

		public function index(){
			$parameter = array(
				1 => "2016-01-01",
				2 => "2016-02-29"
			);
			$this->crystalreport->generate("report/laporan_penjualan.rpt","laporan_penjualan",$parameter);
		}
	}

 ?>