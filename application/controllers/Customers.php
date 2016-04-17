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
		$this->load->model('customer_model','customer');
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
		$data['header'] = $this->load->view('common/header',['title'=>'Customers'],true);
		$data['footer'] = $this->load->view('common/footer',[],true);
		$data['top_navbar'] = $this->load->view('common/top_navbar',[],true);
		$data['sidebar_menu'] = $this->load->view('common/sidebar_menu',['active'=>'customers'],true);
		$this->load->view('customers',$data);		
	}
}