<?php 

class login extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        }



    public function index(){
      $this->load->view("login_view");
    }

    public function actionLogin(){
        $username=$this->input->post("email");
        $password=$this->input->post("password");
        if($username=="" || empty($password)){
            $this->session->set_flashdata("error","Harus diisi");
            redirect(base_url()."login");
        }
        else{
            $result=$this->user_model->cekUser($username,$password);
            if(count($result)>0){
                $aksesMenu=$this->user_model->all_menu($result[0]['id_menu']);
                $this->session->set_userdata("username",$result);
                $login_username = $result[0]['nama'];
                $this->session->set_flashdata("notif",$login_username);
                $this->session->set_userdata("hak_akses",$aksesMenu);
                $this->user_model->updateUser($username);
                redirect(base_url()."home");
            }
            else{
                $this->session->set_flashdata("error","- User Dan Password tidak Cocok -");
                redirect(base_url()."login");
            }
        }
        
    }
    public function profile(){
        $this->load->view("profile");
    }
    public function logoutUser(){
        $this->session->sess_destroy();
        redirect(base_url());
    }
    public function allUser(){
        $term   =   $this->input->get("term");
        $data   =   $this->user_model->cetak_user($term);
        echo json_encode($data);
    }
}
?>