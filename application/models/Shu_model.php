<?php 
class Shu_model extends CI_model
{
	public function insert_shu_header($data)
	{
		$this->db->insert('shu',$data);
		return $this->db->insert_id();
	}

	public function insert_shu_detail($data)
	{
		$this->db->insert('shu_detail', $data);
	}

	public function select_all($params_array)
	{
		$this->db->select();
	}

	public function delete($params_array)
	{
		$this->db->delete('shu', $params_array);
	}
}
 ?>