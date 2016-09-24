<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		if(!$this->session->userdata('logged_in'))
		{
			redirect(base_url('/login'));
		}		
	}

	public function index()
	{	
		$data['header'] = $this->load->view('common/header',['title'=>'Valuable Customers'],true);
		$data['footer'] = $this->load->view('common/footer',[],true);
		$data['top_navbar'] = $this->load->view('common/top_navbar',[],true);
		$data['sidebar_menu'] = $this->load->view('common/sidebar_menu',['active'=>'valuable_customers'],true);
		$this->load->view('customers',$data);	
	}

	public function summarization()
	{
		$this->load->model('customer_model','customer');
		$data['total_count'] = $this->customer->getCount()[0]; 
		$based_on = 'gender';
		$data['customers_count_by_gender'] = json_encode($this->customer->getCount($based_on)[0]);
		$based_on = 'income';
		$data['customers_count_by_income'] = json_encode($this->customer->getCount($based_on)[0]);
		$based_on = 'age_group';
		$data['customers_count_by_age'] = json_encode($this->customer->getCount($based_on)[0]);	
		$based_on = 'marital_status';
		$temp = $this->customer->getCount($based_on);		
		foreach ($temp as $key => $value) {
			$data['customers_count_by_marital_status'][$value['marital_status']] = $value['count'];			
		}
		$data['customers_count_by_marital_status'] = json_encode($data['customers_count_by_marital_status']);
		$based_on = 'occupation';
		$temp = $this->customer->getCount($based_on);		
		foreach ($temp as $key => $value) {
			$data['customers_count_by_occupation'][$value['occupation']] = $value['count'];			
		}
		$data['customers_count_by_occupation'] = json_encode($data['customers_count_by_occupation']);
		$based_on = 'member_card';
		$temp = $this->customer->getCount($based_on);		
		foreach ($temp as $key => $value) {
			$data['customers_count_by_member_card'][$value['member_card']] = $value['count'];			
		}
		$data['customers_count_by_member_card'] = json_encode($data['customers_count_by_member_card']);	
		$based_on = 'education';
		$temp = $this->customer->getCount($based_on);		
		foreach ($temp as $key => $value) {
			$data['customers_count_by_education'][$value['education']] = $value['count'];			
		}
		$data['customers_count_by_education'] = json_encode($data['customers_count_by_education']);	
		$based_on = 'country';
		$temp = $this->customer->getCount($based_on);
		$country = $temp;
		foreach ($temp as $key => $value) {
			$data['customers_count_by_country'][$value['country']] = $value['count'];						
		}
		$data['customers_count_by_country'] = json_encode($data['customers_count_by_country']);
		$based_on = 'state';
		$temp = $this->customer->getCount($based_on);
		$state = $temp;
		foreach ($temp as $key => $value) {
			$data['customers_count_by_state'][$value['state_province']] = $value['count'];						
		}
		$data['customers_count_by_state'] = json_encode($data['customers_count_by_state']);
		$based_on = 'city';
		$temp = $this->customer->getCount($based_on);
		$data['customers_count_by_city'] = (object) [
			'name'=>'Country',
			'children'=>[]
		];
		foreach ($country as $key => $value) {
			array_push($data['customers_count_by_city']->children, 
					(object)['name'=>$value['country'],'children'=>[]]
			);
		}
		foreach ($state as $key => $value) {
			foreach ($data['customers_count_by_city']->children as $key2 => $value2) {
				if($value2->name == $value['country'])
				{
					array_push($data['customers_count_by_city']->children[$key2]->children, 
						(object)['name'=>$value['state_province'],'children'=>[]]
					);
				}
			}
		}
		foreach ($temp as $key => $value) {
			foreach ($data['customers_count_by_city']->children as $key2 => $value2) {
				if($value2->name == $value['country'])
				{
					foreach ($value2->children as $key3 => $value3) {
						if($value3->name == $value['state_province'])
						{
							array_push($data['customers_count_by_city']->children[$key2]->children[$key3]->children, 
								(object)[
									'name'=> $value['city'],'size'=> $value['count']
								]
							);
						}	
					}
				}
			}				
		}
		$data['customers_count_by_city'] = json_encode($data['customers_count_by_city']);		
		$data['header'] = $this->load->view('common/header',['title'=>'Customers Summarization'],true);
		$data['footer'] = $this->load->view('common/footer',[],true);
		$data['top_navbar'] = $this->load->view('common/top_navbar',[],true);
		$data['sidebar_menu'] = $this->load->view('common/sidebar_menu',['active'=>'customers_summ'],true);
		$this->load->view('customers_summarization',$data);		
	}

	public function valuable_customers()
	{
    $deciding_param = ($x = $this->input->get('deciding_param'))?$x:'both';
    $frequency_of_visit_value = ($x = $this->input->get('frequency_of_visit_value'))?intval($x):0;
    $profit_value = ($x = $this->input->get('profit_value'))?intval($x):0;
    $year = ($x = $this->input->get('year'))?$x:'1997';
    $month = ($x = $this->input->get('month'))?$x:'January';
    $this->load->model('customer_model');
    echo json_encode($this->customer_model->get_valuable_customers($year,$month,$deciding_param,$frequency_of_visit_value,$profit_value));
	}

	public function view($id)
	{
		if(!$id || $id<0)
		{
			redirect(base_url('customers'));
		}
		$this->load->model('customer_model');
		$where = ['customer_id'=>$id];
		$select = '';
		$data['user'] = $this->customer_model->customer($select,$where)[0];
		$data['sales_data'] = [
			'1997' => [
				'month' => [],
				'sales' => [],
				'profit' => []
			],
			'1998' => [
				'month' => [],
				'sales' => [],
				'profit' => []
			]		
		];
		$table = 'sales_fact_1997'; 
		$result = $this->customer_model->get_customer_sales_data($table,$id);
		foreach ($result as $key => $value) {
			array_push($data['sales_data']['1997']['month'], $value['the_month']);
			array_push($data['sales_data']['1997']['sales'], $value['sales']);
			array_push($data['sales_data']['1997']['profit'], $value['profit']);
		}
		$table = 'sales_fact_1998'; 
		$result = $this->customer_model->get_customer_sales_data($table,$id);
		foreach ($result as $key => $value) {
			array_push($data['sales_data']['1998']['month'], $value['the_month']);
			array_push($data['sales_data']['1998']['sales'], $value['sales']);
			array_push($data['sales_data']['1998']['profit'], $value['profit']);
		}		
		$data['sales_data'] = json_encode($data['sales_data']);
		$data['visit_data'] = [
			'1997' => [
				'month' => [],
				'frequency' => []
			],
			'1998' => [
				'month' => [],
				'frequency' => []
			]		
		];
		$table = 'sales_fact_1997';
		$result = $this->customer_model->get_customer_visit_count($table,$id);
		foreach ($result as $key => $value) {
			array_push($data['visit_data']['1997']['month'], $value['the_month']);
			array_push($data['visit_data']['1997']['frequency'], $value['count']);
		}
		$table = 'sales_fact_1998';
		$result = $this->customer_model->get_customer_visit_count($table,$id);
		foreach ($result as $key => $value) {
			array_push($data['visit_data']['1998']['month'], $value['the_month']);
			array_push($data['visit_data']['1998']['frequency'], $value['count']);
		}		
		$data['visit_data'] = json_encode($data['visit_data']);
		$data['header'] = $this->load->view('common/header',['title'=>'Valuable Customer'],true);
		$data['footer'] = $this->load->view('common/footer',[],true);
		$data['top_navbar'] = $this->load->view('common/top_navbar',[],true);
		$data['sidebar_menu'] = $this->load->view('common/sidebar_menu',['active'=>'valuable_customers'],true);
		$this->load->view('customer_profile',$data);			
	}

	public function trend()
	{
		$data['header'] = $this->load->view('common/header',['title'=>'Customer Trend'],true);
		$data['footer'] = $this->load->view('common/footer',[],true);
		$data['top_navbar'] = $this->load->view('common/top_navbar',[],true);
		$data['sidebar_menu'] = $this->load->view('common/sidebar_menu',['active'=>'customer_trend'],true);
		$this->load->view('customer_trend',$data);			
	}

	public function get_new_customers()
	{
    $year = ($x = $this->input->get('year'))?$x:'1997';
    $base_month = ($x = $this->input->get('base_month'))?$x:'January';
    $target_month = ($x = $this->input->get('target_month'))?$x:'February';
    $this->load->model('customer_model');
    echo json_encode($this->customer_model->get_new_customers($year,$base_month,$target_month));
	}
}