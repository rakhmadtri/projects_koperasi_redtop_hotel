<?php 
class Pengeluaran_model extends CI_Model
{
	private $table = "transaksi_pengeluaran";
	private $table_detail = "transaksi_pengeluaran_detail";
	public function insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function insert_detail($data)
	{
		$this->db->insert_batch($this->table_detail, $data);
	}

	public function select_header($select='*', $params_array='', $group_by='', $order_by='')
	{
		$this->db->select($select);
		$this->db->from($this->table);
		if (is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (is_array($group_by)) {
			$this->db->group_by($group_by);
		}
		if (is_array($order_by)) {
			foreach ($order_by as $key => $value) {
				$this->db->order_by($value);
			}
		}
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function select_detail($id="")
	{
		$this->db->select('*');
		$this->db->where(array("pengeluaran_detail_id"=>$id));
		$result = $this->db->get($this->table_detail)->result_array();
		return $result;
	}
}
?>