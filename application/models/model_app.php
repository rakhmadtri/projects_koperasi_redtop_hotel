<?php 
class model_app extends CI_Model{

    public function selectUser($idEmail,$password=""){
        $sql    =   "select * from data_anggota where email='".$idEmail."'";    
        if ($password!="") {
            $sql    .=  " and password=md5('".$password."') and status=1;";
            $result =   $this->db->query($sql);
            return $result->result_array();
        }else{
            $result =   $this->db->query($sql);
            return $result->num_rows();
        }
    }
    public function insertUser($nama,$email,$password){
        $this->db->insert("data_anggota",array(
            "nama"=>$nama,
            "email"=>$email,
            "password"=>md5($password),
            "regdate"=>date("Y-m-d h:i:s")
            ));
        ;
    }
    public function updateUser($idEmail){
        $this->db->update("data_anggota",array("lastlogin"=>date("Y-m-d h:i:s")),
                    array("email"=>$idEmail));
    }
    public function confirmUser($encrypt){
        $result=$this->db->query("select * from data_anggota where MD5(CONCAT(email,nama))='".$encrypt."' and status=0");
        if (!empty($result)) {
            $queryUpdate=$this->db->update("data_anggota",array("status"=>1),array("md5(CONCAT(email,nama))"=>$encrypt));
        }
        return $result->result_array();
    }
    public function allUser($query="%"){
//       join data_anggota_profile dap on da.account_id=dap.account_id
        $result =   $this->db->query("SELECT * from data_anggota da
                                      WHERE da.account_id like '%".$query."%'   
                                          OR da.email like '%".$query."%'
                                          OR da.account_mobile like '%".$query."%'
                                          OR da.nama like '%".$query."%'
                          ");
        return $result->result_array();

    }
    public function changePassword($idUser,$newPassword){
        $result =   $this->db->update("data_anggota",array("password"=>md5($newPassword)),array("account_id"=>$idUser));
    }
}
?>