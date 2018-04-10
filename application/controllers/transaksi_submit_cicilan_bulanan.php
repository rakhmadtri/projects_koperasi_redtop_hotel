<?php
class transaksi_submit_cicilan_bulanan extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("cicilan_bulanan_model");
        $this->load->model("cicilan_model");
        $this->load->helper("currency_format_helper");
        $this->data["account_login"]    =   $this->session->userdata("username");
        $this->load->helper('terbilang_helper');

    }
    public function index(){
        $page= $this->input->get("page");
        if ($page=="") {
            $page=1;
        }
        $bulan_proses           =   $this->input->get("bulan_proses");
        $kode_departemen        =   $this->input->get("departemen");
        $no_anggota             =   $this->input->get("no_anggota");

        if ($bulan_proses=='') {
            $bulan_proses=date("Y-m");
        }

        $data['list_departemen']    =   $this->cicilan_bulanan_model->list_departemen_anggota($kode_departemen,$no_anggota);
        $data['data_departemen']    =   $this->cicilan_bulanan_model->select_departemen();
        $data['data_bulan']         =   $this->cicilan_bulanan_model->select_bulan_jatuh_tempo();
        $this->load->library('pagination');
        $config['base_url']         =   base_url()."transaksi_submit_cicilan_bulanan?bulan_proses=$bulan_proses&no_anggota=$no_anggota&kode_departemen=$kode_departemen";
        $config['total_rows']       =   $this->cicilan_bulanan_model->count_cicilan_bybulan($bulan_proses,$no_anggota,$kode_departemen);
        $config['use_page_numbers'] =   TRUE;
        $config['per_page']         =   10000; 
        $config['page_query_string']=   true;
        $config['query_string_segment']='page';


// $this->produk_model->view_product($search,($page-1) * $config['per_page'],$config['per_page']);
        $data['cicilan_bulanan']    =   $this->cicilan_bulanan_model->select_cicilan_bulanan($bulan_proses,$no_anggota,$kode_departemen,($page-1)*$config['per_page'],$config['per_page']);
        $this->pagination->initialize($config); 
        // echo "<pre>";
        // print_r($config['total_rows']);
        // echo "</pre>";
        // die();
        // die();
// echo $config['total_rows'];

        // $data['no_anggota']     =   $this->cicilan_bulanan_model->select_cicilan_bulanan($no_anggota);
        // print_r($data);
        // echo $this->db->last_query();
        // print_r($data);
        // die();
        // echo "<pre>";
        // print_r($data['cicilan_bulanan']);
        //         echo "</pre>";
        // die();
        $this->load->view("koperasi_transaksi_submit_cicilan_bulanan_view",$data);
    }
    public function insertTransaction(){
        $user_id  = $this->session->userdata("username");
        $id_login = $user_id[0]['account_id'];

        $order_id               =   $this->input->post("checkbox");
        $jatuh_tempo            =   $this->input->post("proses_bulanan");
        $submit                 =   $this->input->post("submit");
        $count_order_id         =   count($order_id);
        // print_r($this->input->post());
        // $this->get_data_cicilan();
        // print_r(array_count_values($array));
        // print_r($order_id);
        // die;
        
        // Jika data di cetak dan langsung di bayarkan tanpa perlu Entry di Form pembayaran Cicilan 
        if ($submit=="save") {
            $total_nominal = 0;
            $get_id_pembayaran = $this->insert_table_pembayaran(array('account_id'=>$id_login,
                                                                      'total_nominal'=>$total_nominal));

            $detail =   array();
            for ($i=0; $i<$count_order_id; $i++) { 
                    $temp_order_id                  =   explode("-", $order_id[$i]);
                    $item['order_id']               =   $temp_order_id[0];
                    $item['keterangan']             =   $temp_order_id[1];
                    $get_detail_cicilan             =   $this->cicilan_model->get_detail_cicilan_perbulan($temp_order_id[0],$temp_order_id[1],$jatuh_tempo."-25"); 

                    $item['cicilan_perbulan']       =   $get_detail_cicilan[0]['cicilan_perbulan'];
                    $item['total_pinjaman']         =   $get_detail_cicilan[0]['total_pinjaman'];
                    $item['detail_anggota']         =   $get_detail_cicilan[0]['no_anggota']."-".$get_detail_cicilan[0]['nama'];
                    $item['update_timestamp']       =   date("Y-m-d");
                    $item['status']                 =   "lunas";
                    $item['jatuh_tempo']            =   $jatuh_tempo;
                    $item['id_pembayaran']          =   $get_id_pembayaran;
                    $detail[]                       =   $item;
                    $total_nominal                  +=  $get_detail_cicilan[0]['cicilan_perbulan'];

                    if ($temp_order_id[1]=="transaksi_pinjaman") 
                    {
                        $var_count_lama_cicilan     = $this->transaksi_pinjaman_count_lama_cicilan($temp_order_id[0]);
                        $var_cicilan_ke             = $this->get_counter_angsuran($temp_order_id[0]);
                        $count_cicilan_lunas        = $this->cicilan_count_lunas($temp_order_id[0]);
                        $detail[$i]['lama_cicilan'] = $var_count_lama_cicilan;
                        $detail[$i]['cicilan_ke']   = $var_cicilan_ke['counter_angsuran']+$count_cicilan_lunas;
                        
                        // Update Table transaksi_pinjaman SET status LUNAS . 
                        // Agak Ribet karena saat proses Queue Statusnya belum di update tp sudah akan update Header dahulu
                        if ($detail[$i]['cicilan_ke'] == $var_count_lama_cicilan) {
                            $this->cicilan_model->update_pembayaran_header($temp_order_id[0]);
                        }
                    }
                    else
                    {
                        $detail[$i]['lama_cicilan'] = 1;
                        $detail[$i]['cicilan_ke']   = 1;
                        $this->cicilan_model->update_transaksi_pembayaran_header($temp_order_id[0]);
                    }
            }


            // Proses Update Batch 
            $this->cicilan_bulanan_model->update_cicilan_bulanan($detail);
            // UPDATE table Pembayaran
            $this->update_table_pembayaran($total_nominal,$get_id_pembayaran);
        }
        else{
            echo "Belum Action";
        }
        // redirect(base_url()."");

        // Buat Counter Banyak nya Pinjaman Koperasi & inventory    
        $temp_counter = $this->count_array($detail);
        if (is_array($temp_counter)) {
            $detail['header']['count_pinjaman_inventory'] = $temp_counter['count_pinjaman_inventory'];
            $detail['header']['count_pinjaman_koperasi']  = $temp_counter['count_pinjaman_koperasi'];
        }
        else{
            $$detail['count_pinjaman_inventory'] = 0;
            $$detail['count_pinjaman_koperasi']  = 0;
        }
        // echo "<pre>";
        // print_r($detail);
        // echo "</pre>";
        // die;
        $this->cetak_laporan_cicilan_bulanan($detail);
        // redirect($_SERVER['HTTP_REFERER']);

    }
    // Buat Generate PDF
    public function cetak_laporan_cicilan_bulanan($detail){
        // $this->load->view("koperasi_cetak_transaksi_pinjaman_dummy");
        $data['list_pinjaman'] = $detail;
        $this->load->view("koperasi_cetak_transaksi_pinjaman_dummy",$data);
    }
    // Buat Generate XLS
    public function cetak_laporan_cicilan_bulanan_xls(){
        $this->load->view("koperasi_cetak_transaksi_pinjaman_dummy_xls");
    }

    public function count_array($data_pinjaman){
        $data['count_pinjaman_koperasi']  = 0;
        $data['count_pinjaman_inventory'] = 0;
        if (is_array($data_pinjaman)) {
            foreach ($data_pinjaman as $key => $value) {
                if ($value['keterangan']=='transaksi_penjualan') {
                    $data['count_pinjaman_inventory'] += 1;
                }
                if ($value['keterangan']=='transaksi_pinjaman') {
                    $data['count_pinjaman_koperasi'] += 1;
                }
            }
            return $data;
        }
        else
        {
            return 0;
        }
    }
    public function _remap(){
        $this->indexfixer->remap();
    }
}
?>