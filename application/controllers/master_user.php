<?php
class master_user extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("user_model");
    }
     public function index($is_xls=FALSE){	
		if ($is_xls==FALSE) {
				if(isset($_GET['query'])!=""){
				$this->data['all_user']=$this->user_model->allUser($_GET['query']);
			}
			else{
				$this->data['all_user']=$this->user_model->allUser();
			}

			$this->load->view("koperasi_master_user_view",$this->data);
		}else{
			$data['all_user']=$this->user_model->allUser();
			$this->load->view("xls_view_user",$data);
		}
	}
	public function preview(){
		$this->load->view("koperasi_master_user_view");
	}
	public function	insertUser(){
		$txtKode	=	$this->input->post("kode_User");
		$txtNama	=	$this->input->post("name");
		$txtEmail	=	$this->input->post("email");
		$txtPassword=	$this->input->post("password");
		$txtCategory=	$this->input->post("keterangan");
		if ($txtCategory=="root") {
			$idMenu	=	"1,2,4,5,6,7,8,9,10,11,12,13,14";
		}else{
			$idMenu	=	"1,2,4,5,6,7,8,9,10,11,12,13,14";
		}
		if ($txtKode=="") {
			$this->user_model->insert_user($txtNama,$txtEmail,$txtPassword,$txtCategory,$idMenu);
			echo $this->db->last_query();
		}else{
			$this->user_model->edit_user($txtKode,$txtNama,$txtEmail,$txtPassword,$txtCategory,$idMenu);
		echo $this->db->last_query();
		}
		redirect(base_url()."master_user");
	}
	public function deleteUser($account_id){
		$this->user_model->delete_user($account_id);
		redirect(base_url()."master_user");
	}
	public function allMenu(){
		$this->user_model->all_menu();
	}
	public function _remap(){
			$this->indexfixer->remap();
		}
}
?>
