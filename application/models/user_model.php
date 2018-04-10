<?php 

class user_model extends CI_Model{
  
  /**
   * __construct()
   */
  function __construct()
  {
    parent::__construct();
  }
	public function cekUser($idEmail,$password=""){
		$sql	=	"select * from user where email='".$idEmail."'";	
		if ($password!="") {
			// $sql	.=	" and password=md5('".$password."') and status=1 and hapus=0;";
			$result	=	$this->db->query("SELECT * FROM user WHERE 1 AND status=1 AND hapus=0 AND email=? AND password=md5(?)",array($idEmail,$password));
			// echo $this->db->last_query();
			// die();
			return $result->result_array();
		}else{
			$result	=	$this->db->query($sql);
			return $result->num_rows();
		}
	}
	public function insert_user($nama,$email,$password,$category,$idMenu){
		$this->db->insert("user",array(
			"nama"=>$nama,
			"email"=>$email,
			"password"=>md5($password),
			"regdate"=>date("Y-m-d h:i:s"),
			"keterangan"=>$category,
			"id_menu"=>$idMenu
			));
		;
	}
	public function edit_user($account_id,$nama,$email,$password,$category,$idMenu){
		$this->db->update("user",array("nama"=>$nama,"email"=>$email,"password"=>md5($password),"keterangan"=>$category,"id_menu"=>$idMenu),
					array("account_id"=>$account_id));
	}
	//Update Last Login
	public function updateUser($idEmail){
		$this->db->update("user",array("lastlogin"=>date("Y-m-d h:i:s")),
					array("email"=>$idEmail));
	}
	public function allUser($query="%"){
		$result	=	$this->db->query("SELECT * from user da
									  WHERE 1
									  		AND hapus=0
									  		AND (da.account_id like '%".$query."%'	
										  OR da.email like '%".$query."%'
										  OR da.nama like '%".$query."%')
						  ");
		return $result->result_array();

	}
	public function delete_user($account_id){
		$this->db->update("user",array("hapus"=>"1"),array("account_id"=>$account_id));
		// echo $this->db->last_query();
		// die();
	}
	public function cetak_user($params="%"){
		$result =	$this->db->query("SELECT u.account_id AS kodekurir,u.nama AS namakurir FROM user u WHERE u.keterangan='kurir' AND status=1 AND (u.nama like '%".$params."%' OR u.email LIKE '%".$params."%')");
		return $result->result_array();
	}
	public function changePassword($idUser,$newPassword){
		$result =	$this->db->update("data_anggota",array("password"=>md5($newPassword)),array("account_id"=>$idUser));
	}
	public function all_menu($params){
		$result=	$this->db->query("SELECT * FROM menu_web WHERE id_menu IN($params)");
		return $result->result_array();
	}
}
?>