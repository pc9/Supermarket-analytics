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
		$result = $this->db->query('SELECT COUNT(customer_id) AS total FROM customer');
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
		if ($based_on == 'country') 
		{
			$result = $this->db->query('SELECT DISTINCT(country),COUNT(customer_id) AS count FROM customer GROUP BY country ORDER BY country');
		}
		if ($based_on == 'state')
		{
			$result = $this->db->query('SELECT DISTINCT(state_province),COUNT(customer_id) AS count,country FROM customer GROUP BY state_province');
		}
		if ($based_on == 'city')
		{
			$result = $this->db->query('SELECT DISTINCT(city),COUNT(customer_id) AS count,state_province,country FROM customer GROUP BY city');
		}		
		return $result->result_array();		
	}

	public function get_valuable_customers($year,$month,$deciding_param,$frequency_of_visit_value,$profit_value)
	{
		$table = 'sales_fact_1997';
		if($year == '1997')
		{
			$table = 'sales_fact_1997';
		}
		if($year == '1998')
		{
			$table = 'sales_fact_1998';
		}
		if($deciding_param == 'frequency_of_visit')
		{
			$result = $this->db->query("SELECT A.customer_id,D.fullname,COUNT(DISTINCT(A.time_id)) AS count FROM $table AS A JOIN time_by_day AS B ON A.time_id = B.time_id JOIN product AS C ON A.product_id=C.product_id JOIN customer AS D ON A.customer_id=D.customer_id  WHERE  B.the_month='$month' AND B.the_year='$year'  GROUP BY A.customer_id HAVING count>='$frequency_of_visit_value' order by count desc");
		}
		if($deciding_param == 'profit')
		{
			$result = $this->db->query("SELECT A.customer_id,D.fullname,SUM(A.store_sales - A.store_cost) AS profit FROM $table AS A JOIN time_by_day AS B ON A.time_id = B.time_id JOIN product AS C ON A.product_id=C.product_id JOIN customer AS D ON A.customer_id=D.customer_id  WHERE  B.the_month='$month' AND B.the_year='$year'  GROUP BY A.customer_id HAVING profit>='$profit_value' order by profit desc");
		}	
		if($deciding_param == 'both')
		{
			$result = $this->db->query("SELECT A.customer_id,D.fullname,SUM(A.store_sales - A.store_cost) AS profit,COUNT(DISTINCT(A.time_id)) AS count FROM $table AS A JOIN time_by_day AS B ON A.time_id = B.time_id JOIN product AS C ON A.product_id=C.product_id JOIN customer AS D ON A.customer_id=D.customer_id  WHERE  B.the_month='$month' AND B.the_year='$year'  GROUP BY A.customer_id HAVING profit>='$profit_value' AND count>='$frequency_of_visit_value' order by D.fullname desc");
		}			
		return $result->result_array();
	}

	public function get_customer_sales_data($table,$id)
	{
		$result = $this->db->query("SELECT SUM(A.store_sales) as sales,SUM(A.store_sales - A.store_cost) AS profit,B.the_month FROM $table AS A JOIN time_by_day AS B ON A.time_id = B.time_id JOIN product AS C ON A.product_id=C.product_id JOIN customer AS D ON A.customer_id=D.customer_id  WHERE  A.customer_id=$id GROUP BY B.the_month ORDER BY B.time_id");
		return $result->result_array();
	}

	public function get_customer_visit_count($table,$id)
	{
		$result = $this->db->query("SELECT COUNT(DISTINCT(A.time_id)) AS count,B.the_month FROM $table AS A JOIN time_by_day AS B ON A.time_id = B.time_id  WHERE  A.customer_id=$id GROUP BY B.the_month ORDER BY B.time_id");
		return $result->result_array();
	}

	public function get_new_customers($year,$base_month,$target_month)
	{
		$result = $this->db->query("SELECT DISTINCT(A.customer_id),C.fullname FROM sales_fact_$year AS A JOIN time_by_day AS B ON A.time_id = B.time_id JOIN customer AS C ON A.customer_id=C.customer_id WHERE A.customer_id NOT IN (SELECT DISTINCT(A.customer_id) FROM sales_fact_$year AS A JOIN time_by_day AS B ON A.time_id=B.time_id WHERE B.the_month='$base_month') AND B.the_month='$target_month'");
		return $result->result_array();
	}
}