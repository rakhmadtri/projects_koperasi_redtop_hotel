<?php
class sales_to_cicilan extends MY_Controller{
    function __construct(){
        parent::__construct();
	    $this->load->model("penjualan_model");
        $this->load->model("cicilan_model");
    }
    //Looping select pada list suratjalan
    public function index(){
    	// $this->data['transaksi_0']	=	$this->penjualan_model->all_transaksi_distinct();
        $data['data_sales']    =   $this->penjualan_model->get_sales_anggota();
    	$this->load->view("koperasi_sales_to_cicilan_view",$data);
    }
    public function detail_sales(){
        $order_id   = $this->input->post("order_id");
        $data       = $this->penjualan_model->get_detail_Sales($order_id);
        
        // print_r($data);
        header("content-type:application/json");
        echo json_encode($data);
    }
    public function update_status(){
        $order_id       = $this->input->post("order_id");
        $data_sales = $this->penjualan_model->get_detail_Sales($order_id);

        // echo "<pre>";
        // print_r($data_sales);
        // echo "</pre>";
        // die;
        $old_data = array("cash"=>$data_sales[0]['cash'],
                          "kredit"=>$data_sales[0]['kredit'],
                          "grandtotal"=>$data_sales[0]['total_after_ppn']
                        );
        
        $old_data = json_encode($old_data);
        $nominal_kredit = $this->input->post("kredit");

        if ($data_sales[0]['total_after_ppn']>=$nominal_kredit) {
            $cash = $data_sales[0]['total_after_ppn'] - $nominal_kredit ;
            $kode_customer = $data_sales[0]['kode_customer'];
            echo $nominal_kredit;
            if ($nominal_kredit>0) {
                echo "IF";
                $this->penjualan_model->update_transaksi($order_id,$cash,$nominal_kredit,"cicilan",'1',$old_data);
                $this->cicilan_model->insert_cicilan($order_id,"1",$kode_customer,$nominal_kredit,"0",$nominal_kredit,"transaksi_penjualan",$nominal_kredit);   
            }
            else
            {
                echo "ELSE";
                $this->penjualan_model->update_transaksi($order_id,$cash,$nominal_kredit,"lunas",'0',$old_data);
                $this->cicilan_model->delete_cicilan($order_id,"transaksi_penjualan");
            }
        }
        redirect(base_url()."sales_to_cicilan");
    }
}
?>