<?php
class Customer_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function customer($select = '',$where = '')
	{
		$this->db->select($select);
		if ($where != '')
			$this->db->where($where);
		$this->db->from('customer');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function getCount($based_on = '')
	{
		if ($based_on == 'gender') 
		{
			$result = $this->db->query('SELECT COUNT(customer_id) Total,SUM(CASE WHEN `gender` = \'M\' THEN 1 ELSE 0 END) Male,SUM(CASE WHEN `gender`=\'F\' THEN 1 ELSE 0 END) Female FROM customer');
		}
		if ($based_on == 'income')
		{
			$result = $this->db->query('SELECT 
				SUM(CASE WHEN `yearly_income` = \'$10K - $30K\' THEN 1 ELSE 0 END) \'$10K - $30K\',
				SUM(CASE WHEN `yearly_income` = \'$30K - $50K\' THEN 1 ELSE 0 END) \'$30K - $50K\',
				SUM(CASE WHEN `yearly_income` = \'$50K - $70K\' THEN 1 ELSE 0 END) \'$50K - $70K\',
				SUM(CASE WHEN `yearly_income` = \'$70K - $90K\' THEN 1 ELSE 0 END) \'$70K - $90K\',
				SUM(CASE WHEN `yearly_income` = \'$90K - $110K\' THEN 1 ELSE 0 END) \'$90K - $110K\',
				SUM(CASE WHEN `yearly_income` = \'110K - $130K\' THEN 1 ELSE 0 END) \'$110K - $130K\',
				SUM(CASE WHEN `yearly_income` = \'$130K - $150K\' THEN 1 ELSE 0 END) \'$130K - $150K\',
				SUM(CASE WHEN `yearly_income` = \'$150K +\' THEN 1 ELSE 0 END) \'$150K +\'
				FROM customer');
		}
		if ($based_on == 'age_group')
		{
			$result = $this->db->query('SELECT 
				SUM(CASE WHEN age >=30 AND age <= 60 THEN 1 ELSE 0 END) AS \'30-60\',
				SUM(CASE WHEN age >60 AND age <= 80 THEN 1 ELSE 0 END) AS \'60-80\',
				SUM(CASE WHEN age >80 THEN 1 ELSE 0 END) AS \'80+\' 
				FROM(SELECT TIMESTAMPDIFF(YEAR,birthdate,CURDATE()) AS age FROM customer) age_table');
		}
		if ($based_on == 'marital_status')
		{
			$result = $this->db->query('SELECT COUNT(customer_id) AS count,marital_status FROM customer GROUP BY marital_status');
		}	
		if ($based_on == 'occupation')
		{
			$result = $this->db->query('SELECT COUNT(customer_id) AS count,occupation FROM customer GROUP BY occupation');
		}
		if ($based_on == 'member_card')
		{
			$result = $this->db->query('SELECT COUNT(customer_id) AS count,member_card FROM customer GROUP BY member_card');
		}
		if ($based_on == 'education')
		{
			$result = $this->db->query('SELECT COUNT(customer_id) AS count,education FROM customer GROUP BY education');
		}										
		return $result->result_array();		
	}
}