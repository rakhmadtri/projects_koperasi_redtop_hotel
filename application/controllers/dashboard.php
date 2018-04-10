<?php
class dashboard extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("dashboard_model");
    }

    function index(){
        $data=array(
            'title'=>'Dashboard',
            'active_dashboard'=>'active',
            'dt_contact'=>$this->model_app->getAllData('tbl_contact'),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_dashboard');
        $this->load->view('element/v_footer');
    }
    public function insertChat(){
        $datauser   = $this->session->userdata("username");
        print_r($datauser);
        die();
        $dataChat   =   $this->input->post("txtChat");
        $this->dashboard_model->insert_chat($dataChat);
    }

}
