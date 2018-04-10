<?php
class opname_stok extends MY_Controller{
    function __construct(){
        parent::__construct();
	    $this->load->library("excel_reader");
	    $this->load->model("opname_stok_model");
    }
    public function index(){
    	$this->load->view("koperasi_opname_view");
    }
    public function import_opname(){
    		sleep(3);
    		$config['upload_path'] = './temp_upload/';
			$config['allowed_types'] = 'xls'; 
			// print_r($config);
			$this->load->library('upload', $config);            
			if (!$this->upload->do_upload())
			{
			    $data = array('error' => $this->upload->display_errors());
			    print_r($data);
			 }
			else
			{
				$data = array('error' => false);
				$upload_data = $this->upload->data();
				// print_r($upload_data);
				// Masukkan nama file ke table upload_file_opname
				$this->opname_stok_model->insert_namafile($upload_data['file_name']);
				$this->load->library('excel_reader');
				$this->excel_reader->setOutputEncoding('230787');
				$file =  $upload_data['full_path'];
				$this->excel_reader->read($file);
				error_reporting(E_ALL ^ E_NOTICE);
				// Sheet 1
				$data = $this->excel_reader->sheets[0] ;
                $dataexcel = Array();
				for ($i = 2; $i <= $data['numRows']; $i++) {
				                        if($data['cells'][$i][1] == '') break;
				                        //$dataexcel[$i-1]['kode_barang'] = $data['cells'][$i][1];
				                        $dataexcel[$i-1]['kode_barang'] = ltrim($data['cells'][$i][1],"'");
				                        $dataexcel[$i-1]['qty'] 		= $data['cells'][$i][5];
				                        $dataexcel[$i-1]['keterangan'] 	= $data['cells'][$i][6];
				}
				$Berhasil=0;
				// Data Stok di XLS
				// echo "<pre>";
				// print_r($dataexcel);
				// echo "<pre>";
				// Ambil Data Stok di Database
				$dataStokDB	=	$this->opname_stok_model->select_stok_product_all();
				// echo "<pre>";
				// print_r($dataStokDB);
				// echo "<pre>";
				$counter=0;
				foreach ($dataexcel as $key => $value) {
					foreach ($dataStokDB as $key => $valueDb) {
						// Jika kode barang di xls dan di DB MATCH
						if ($value['kode_barang']==$valueDb['kode_barang']) {
							$current_qty =	($value['qty']-$valueDb['qty']); 
							$this->opname_stok_model->insert_stok_opname($value['kode_barang'],$current_qty,'opname',$value['keterangan']);


						}
						// else{
						// 	echo $counter++;
						// }
						// else if ($value['kode_barang'] != $valueDb['kode_barang'] ) {
						// 	echo "Not Match xls > DB";
						// }
					}
				}    
				// foreach ($dataexcel as $key => $value) {
				// 	$countLicense	= $this->productList_model->cekLicense($value['license']);
				// 	if (count($countLicense)<1) {
				// 			$this->productList_model->insertLicense($idBarang,$value['license'],"1");
				// 			$Berhasil++;
				// 	}
				// }
	    }
	redirect(base_url()."report_stok");
	}
}
?>