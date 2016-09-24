<?php
class Store_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function product($select = '',$where = '')
	{
		$this->db->select($select);
		if ($where != '')
			$this->db->where($where);
		$this->db->from('product');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function store($select = '',$where = '')
	{
		$this->db->select($select);
		if ($where != '')
			$this->db->where($where);
		$this->db->from('store');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function sale($table = 'sales_fact_1997',$select = '',$where = '',$join = [],$group_by = '')
	{
		$this->db->select($select);
		if ($where != '')
			$this->db->where($where);
		$this->db->from($table);
		if($join != [])
		{
			foreach ($join as $key => $value) {
				$this->db->join($value['table'],$value['on']);
			}
		}
		if($group_by != '')
		{
			$this->db->group_by($group_by);
		}	
		$result = $this->db->get();
		return $result->result_array();
	}	

	public function get_inventory_data($id)
	{
		$result = $this->db->query("SELECT SUM(A.units_ordered) as ordered,SUM(A.units_shipped) AS shipped,SUM(A.units_ordered)-SUM(A.units_shipped) diff,B.product_name FROM inventory_fact_1998 as A join product AS B ON A.product_id=B.product_id WHERE A.store_id=$id GROUP BY A.product_id ORDER BY diff DESC");
		return $result->result_array();
	}
}