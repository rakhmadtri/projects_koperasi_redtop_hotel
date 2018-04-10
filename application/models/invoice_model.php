<?php 

class invoice_model extends CI_Model{
  
  /**
   * __construct()
   */
  function __construct()
  {
    parent::__construct();
  }
  public function all_invoice(){
  	$result	=	$this->db->query("SELECT * FROM invoice WHERE 1");
  	return $result->result_array();
  }
}
?>