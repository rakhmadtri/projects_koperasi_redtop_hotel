<?php
class Report_mutasi_anggota extends MY_Controller{
 	function __construct(){
        parent::__construct();
        $this->load->model("report_model");
        $this->load->helper('currency_format');
        $this->load->model('Pengeluaran_model');
        $this->load->model('Penjualan_model');
        $this->load->model('anggota_model');
        $this->load->helper('currency_format');
        $this->load->model('pinjaman_model');
        $this->load->model('shu_model');
    }
    public function index($is_xls=false){
        $get_profit_inventory = 0;
        $get_import_data = 0;
        $get_pengeularan = 0;
        $periode = $this->input->get("periode")?$this->input->get("periode"):date("Y");
        $anggota = $this->anggota_model->select_anggota_all();

        // $start_year = $periode?$this->input->get("periode"):date("Y");
        // $end_year = $periode?$this->input->get("periode"):date("Y");


        $calculate_shu = $this->report_model->calculate_shu($periode,$periode);
        
        // CEK DISINI UNTUK MENEMUKAN ANGGOTA YANG MENDAPATKAN SHU
        // $this->print_r($calculate_shu);
        // foreach ($calculate_shu as $key => $value) {
        //     echo $value['nama']."<br>";
        // }
        // die;


        if (!empty($periode)){
            // $simpanan = $this->report_model->sum_simpanan(array('YEAR(ts.created_timestamp)'=>$periode));
            $simpanan = $this->report_model->sum_simpanan();

            $import_data = $this->report_model->select_import(array('YEAR(created_timestamp)'=>$periode));
            
            $get_profit_inventory = $this->report_model->get_profit_inventory($periode);

            $pinjaman = $this->pinjaman_model->select('*,sum(bunga) as nominal',
                                                    array('YEAR(time_created)'=>$periode),
                                                    array('YEAR(time_created)'));

            
            $get_pengeluaran = $this->Pengeluaran_model->select_header('*,SUM(total_after_ppn) AS grand_total, 
                                                                        YEAR(timestamp) AS year',
                                                                        array('YEAR(timestamp)'=>$periode),
                                                                        array('YEAR(timestamp)'));
            $get_profit_inventory_elektronik = $this->Penjualan_model->select('SUM(total_after_ppn) AS grand_total, 
                                                                                YEAR(order_timestamp) AS year',
                                                                                array('YEAR(order_timestamp)'=>$periode,'is_elektronik'=>1),
                                                                                array('YEAR(order_timestamp)'));
            // // PEMBAGI === UNTUK YANG MASIH AKTIF
            $get_profit_inventory_aktif = $this->report_model->get_profit_inventory_anggota_aktif($periode);
            $get_profit_inventory_elektronik_aktif = $this->Penjualan_model->select('SUM(total_after_ppn) AS grand_total, 
                                                                                YEAR(order_timestamp) AS year',
                                                                                array('YEAR(order_timestamp)'=>$periode,
                                                                                        'is_elektronik'=>1,
                                                                                        'master_anggota.hapus'=>0),
                                                                                array('YEAR(order_timestamp)'));

            $get_profit_pinjaman_aktif = $this->pinjaman_model->select('*,sum(bunga) as nominal',
                                                                        array('YEAR(time_created)'=>$periode,'hapus'=>0),
                                                                        array('YEAR(time_created)'));
        }
        // else{
        //     $simpanan = $this->report_model->sum_simpanan();

        //     $import_data  = $this->report_model->select_import();

        //     $get_profit_inventory = $this->report_model->get_profit_inventory();

        //     $pinjaman = $this->pinjaman_model->select('*,sum(bunga) as nominal',
        //                                                 null,
        //                                                 array('YEAR(time_created)'));

        //     $get_pengeluaran = $this->Pengeluaran_model->select_header('*,SUM(total_after_ppn) AS grand_total, 
        //                                                                 YEAR(timestamp) AS year',
        //                                                                 '',
        //                                                                 array('YEAR(timestamp)'));
        //     $get_profit_inventory_elektronik = $this->Penjualan_model->select('SUM(total_after_ppn) AS grand_total, 
        //                                                                         YEAR(order_timestamp) AS year',
        //                                                                         array('is_elektronik'=>1),
        //                                                                         array('YEAR(order_timestamp)'));
        //     // PEMBAGI === UNTUK YANG MASIH AKTIF
        //     $get_profit_inventory_aktif = $this->report_model->get_profit_inventory_anggota_aktif();
        //     $get_profit_inventory_elektronik_aktif = $this->Penjualan_model->select('SUM(total_after_ppn) AS grand_total, 
        //                                                                         YEAR(order_timestamp) AS year',
        //                                                                         array('is_elektronik'=>1,'master_anggota.hapus'=>0),
        //                                                                         array('YEAR(order_timestamp)'));
        //     $get_profit_pinjaman_aktif = $this->pinjaman_model->select('*,sum(bunga) as nominal',
        //                                                                 array('hapus'=>0),
        //                                                                 array('YEAR(time_created)'));

        // }
        // var_dump($simpanan);
        // die;


        // $this->print_r($get_profit_inventory_aktif);
        // $this->print_r($get_profit_inventory_elektronik);
        // echo $this->db->last_query();
        // die;

        // CALCULATE SUM PROFIT
        $sum_pengeluaran = $this->calculate_sum($get_pengeluaran, 'grand_total');
        $sum_import_data = $this->calculate_sum($import_data, 'nominal');
        $sum_profit_inventory = $this->calculate_sum($get_profit_inventory, 'untung_by_order');
        $sum_profit_pinjaman = $this->calculate_sum($pinjaman, 'nominal');
        $sum_profit_inventory_elektronik = $this->calculate_sum($get_profit_inventory_elektronik, 'grand_total');


        // AKTIF
        $sum_profit_inventory_aktif = $this->calculate_sum($get_profit_inventory_aktif, 'untung_by_order');
        $sum_profit_inventory_elektronik_aktif = $this->calculate_sum($get_profit_inventory_elektronik_aktif, 'grand_total');
        $sum_profit_pinjaman_aktif = $this->calculate_sum($get_profit_pinjaman_aktif,'nominal');

        $grand_total_profit = $sum_profit_inventory + $sum_profit_inventory_elektronik + 
                                $sum_import_data + $sum_profit_pinjaman - $sum_pengeluaran ;


        // 60% DARI KEUNTUNGAN
        $total_profit_anggota = $grand_total_profit * 60 / 100;
        // 70% DARI KEUNTUNGAN YANG DISHARE POS
        $total_profit_pos = $total_profit_anggota * 70 / 100;
        // 30% DARI KEUNTUNGAN YANG DISHARE SIMPANAN
        $total_profit_simpanan = $total_profit_anggota * 30 / 100;


        $nilai_pembagi_berdasarkan_anggota_aktif =  $sum_profit_inventory_aktif + 
                                                    $sum_profit_inventory_elektronik_aktif + 
                                                    $sum_profit_pinjaman_aktif ;

        // echo "TOTAL PROFIT ALL ANGGOTA==>".$total_profit_anggota."<br>";
        // echo "TOTAL PROFIT ALL ANGGOTA 70%==>".$total_profit_pos."<br>";
        // echo "TOTAL PROFIT ALL ANGGOTA 30%==>".$total_profit_simpanan."<br>";

        // echo "TOTAL NILAI PEMBAGI POS ==>".$sum_profit_inventory_aktif."<br>";
        // echo "TOTAL NILAI PEMBAGI is_elektronik==>".$sum_profit_inventory_elektronik_aktif."<br>";
        // echo "TOTAL NILAI PEMBAGI PINJAMAN==>".$sum_profit_pinjaman."<br>";

        
       // echo "sum_profit_inventory_aktif==>".$sum_profit_inventory_aktif."<br>";
       // echo "sum_profit_inventory_elektronik_aktif==>".$sum_profit_inventory_elektronik_aktif."<br>";
       // echo "sum_profit_pinjaman_aktif==>".$sum_profit_pinjaman_aktif."<br>";                                         

        if (!empty($calculate_shu) && is_array($calculate_shu)) {
            $grand_total_shu_simpanan_ekonomi = 0;
            $grand_total_shu_ekonomi = 0;
            $grand_total_shu_simpanan = 0;
            foreach ($calculate_shu as $key => $value) {
                $grand_total_shu = 0;
                $calculate_shu[$key]['shu_simpanan'] = $value['t_union.total_simpanan'] / $simpanan['total_simpan'] * $total_profit_simpanan;
                $calculate_shu[$key]['shu_ekonomi'] = (($value['t_union.untung_penjualan'] + 
                                                        $value['t_union.untung_penjualan_elektronik'] + 
                                                        $value['t_union.untung_peminjaman']) / 
                                                        $nilai_pembagi_berdasarkan_anggota_aktif) * $total_profit_pos;

                // echo "Value Penjualan==>".$value['t_union.untung_penjualan']."<br>";
                // echo "Value Penjualan ELEKTRONIK==>".$value['t_union.untung_penjualan_elektronik']."<br>";
                // echo "Value PINJAMAN==>".$value['t_union.untung_peminjaman']."<br>";
                // echo "Nilai Pembagi ===>".$nilai_pembagi_berdasarkan_anggota_aktif."<br>";
                // echo "NILAI PERKALIAN ===>".$total_profit_pos."<br>";
                // $this->print_r($calculate_shu[$key]['shu_ekonomi']);
                // die;

                $calculate_shu[$key]['grand_total_shu'] = $calculate_shu[$key]['shu_simpanan'] + $calculate_shu[$key]['shu_ekonomi'];

                // echo "VALUE EKONOMI POS==>".$value['t_union.untung_penjualan'].'EKONOMI ELEKTRONIK==>'.$value['t_union.untung_penjualan_elektronik'].'VALUE SIMPANAN==>'.$value['t_union.total_simpanan'].'SHU EKONOMI==>'.$calculate_shu[$key]['shu_ekonomi'].'GRAND TOTAL==>'.$calculate_shu[$key]['grand_total_shu']."<br>";
                // die;
                // echo $calculate_shu[$key]['shu_ekonomi']."<br>";

                $grand_total_shu_ekonomi += $calculate_shu[$key]['shu_ekonomi'];
                $grand_total_shu_simpanan += $calculate_shu[$key]['shu_simpanan'];
                $grand_total_shu_simpanan_ekonomi += $calculate_shu[$key]['grand_total_shu'];
            }
        }
        // DEBUG NOMINAL GRAND TOTAL PER KATEGORI BISNIS
        // var_dump($grand_total_shu_simpanan_ekonomi);
        // var_dump($grand_total_shu_ekonomi);
        // var_dump($grand_total_shu_simpanan);
        // die;

        // $data['all_anggota'] = $anggota;
        $data['import_data']['data'] = $import_data;
        $data['list_shu'] = $calculate_shu;

        // $this->print_r($list_shu)

        $data['data']['profit_inventory'] = $get_profit_inventory;
        $data['data']['profit_inventory_elektronik'] = $get_profit_inventory_elektronik;
        $data['data']['profit_pinjaman'] = $pinjaman;

        $data['subtotal']['subtotal_saldo_simpanan'] = $simpanan['total_simpan'];
        $data['subtotal']['subtotal_shu_simpanan'] = $grand_total_shu_simpanan;
        $data['subtotal']['subtotal_shu_ekonomi'] = $grand_total_shu_ekonomi;
        $data['subtotal']['subtotal_shu_total'] = $grand_total_shu_simpanan_ekonomi;


        $data['total_pengeluaran'] = $get_pengeluaran;
        $data['periode'] = $periode;
        // $this->print_r($data['subtotal']);
        // die;
        // $this->print_r($calculate_shu);

        // echo "string";
        // die;
        // $this->print_r($total_profit_anggota);
        // $this->print_r($grand_total_profit);
        // die;
        if (!$is_xls) {
            $this->load->view("koperasi_report_mutasi_anggota_view",$data);            
        }
        else{
            $this->load->view("koperasi_export_shu_xls_view",$data);
        }

    }

    public function insert()
    {

        $summary_transaksi_shu = json_encode($this->input->post("summary_transaksi_shu"));

        $periode = $this->input->post("periode");
        $subtotal_saldo_simpanan = $this->input->post("subtotal_saldo_simpanan");
        $subtotal_shu_simpanan = $this->input->post("subtotal_shu_simpanan");
        $subtotal_shu_ekonomi = $this->input->post("subtotal_shu_ekonomi");
        $subtotal_shu_total = $this->input->post("subtotal_shu_total");
        $subtotal_pengeluaran = $this->input->post("subtotal_pengeluaran");

        $nik = $this->input->post("nik");
        $no_anggota = $this->input->post("no_anggota");
        $shu_ekonomi = $this->input->post("shu_ekonomi");
        $shu_simpanan = $this->input->post("shu_simpanan");
        $saldo_simpanan = $this->input->post("total_simpanan");
        $grand_total_shu = $this->input->post("grand_total_shu");


        if (is_array($no_anggota) && !empty($no_anggota)) {
            // INSERT HEADER
            // echo "string";
            // die;
            $header['periode'] = $periode;
            $header['subtotal_saldo_simpanan'] = $subtotal_saldo_simpanan;
            $header['subtotal_shu_ekonomi'] =  $subtotal_shu_ekonomi;
            $header['subtotal_shu_simpanan'] = $subtotal_shu_simpanan;
            // $header['subtotal_pengeluaran'] = $subtotal_pengeluaran;
            $header['summary_transaksi_shu'] = $summary_transaksi_shu;

            $header['grand_total_shu'] = $subtotal_shu_total; 
            // $this->print_r($header);
            // die();
            $delete['periode'] = $periode;
            $this->shu_model->delete($delete);
            $id = $this->shu_model->insert_shu_header($header);
            // echo $this->db->last_query();
            if ($id && is_numeric($id)) {
                foreach ($no_anggota as $key => $value) {
                    $data['shu_id'] = $id;
                    $data['no_anggota'] = $value;
                    $data['saldo_simpanan'] = $saldo_simpanan[$key];
                    $data['shu_ekonomi'] = $shu_ekonomi[$key];
                    $data['shu_simpanan'] = $shu_simpanan[$key];
                    $data['shu_total'] = $grand_total_shu[$key];
                    // $data['saldo_simpanan'] = $
                    $this->shu_model->insert_shu_detail($data);
                }
            }
        }

        // $this->shu_model->insert();
        // die();
        redirect(base_url()."report_mutasi_anggota/report?periode=$periode",'refresh');
    }


    public function report($is_xls = false)
    {
        $periode = $this->input->get("periode");

        $params_array['periode'] = $periode;
        $this->db->select('*');
        $this->db->from('shu');
        if (is_array($params_array) && !empty($params_array)) {
            $this->db->where($params_array);
        }
        $data['summary'] = $this->db->get()->result_array();
        if (!empty($data['summary']) && count(($data['summary']))==1) {
            $data['summary'][0]['summary_transaksi_shu'] = (Array)json_decode($data['summary'][0]['summary_transaksi_shu']);
            $this->db->select('*');
            $this->db->from('shu_detail');
            $this->db->join('master_anggota', 'shu_detail.no_anggota = master_anggota.no_anggota');
            $this->db->where(array('shu_id'=>$data['summary'][0]['id']));
            $data['detail'] = $this->db->get()->result_array();
        }
        // echo $this->db->last_query();
        // die;
        // $this->print_r($data);
        // die;
        $data['data'] = $data;
        if (!$is_xls) {
            $this->load->view('koperasi_view_report_shu',$data);
        }
        else{
            $this->load->view("koperasi_export_report_shu_xls_view", $data);
        }

    }

    public function calculate_sum($data_array, $key_array){
        $result = 0;
        if (is_array($data_array)) {
            foreach ($data_array as $key => $value) {
                if (is_numeric($value[$key_array])) {
                    $result += $value[$key_array];
                }
            }
        }
        return $result;
    }

    public function show_modal_old($no_anggota=1){
        $no_anggota=$this->input->get("term");
        $data['result'] = $this->report_model->saldo_anggota_mutasi_general();
        header("content-type:application/json");
        echo json_encode($data);
        // print_r($data['result'][0]['no_anggota']);
        // echo $data['result'][0]['no_anggota'];
        // $this->load->view('testing_modal', $data);
    }
    public function show_modal_search(){
        $from = $this->input->get("from");
        $to   = $this->input->get("to");
        
        $data['result']  =  $this->report_model->saldo_anggota_mutasi_general_search($from,$to);
        header("content-type:application/json");
        echo json_encode($data);
    }
    public function show_modal($no_anggota=1){
        $no_anggota=$this->input->get("term");
        $data['result'] = $this->report_model->report_shu_anggota();
        header("content-type:application/json");
        echo json_encode($data);
        // print_r($data['result'][0]['no_anggota']);
        // echo $data['result'][0]['no_anggota'];
        // $this->load->view('testing_modal', $data);
    }

    public function _remap(){
        $this->indexfixer->remap();
    }
}
?>