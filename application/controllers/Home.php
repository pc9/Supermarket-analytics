<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
	}

	public function index()
	{
		if(!$this->session->userdata('logged_in'))
		{
			redirect(base_url('/login'));
		}
		$this->load->model('customer_model');
		$this->load->model('store_model');
		$select = 'count(customer_id) as customers';
		$where = '';
		$data['total_customers'] = $this->customer_model->customer($select,$where)[0];
		$select = 'count(product_id) as products';
		$data['total_products'] = $this->store_model->product($select,$where)[0];
		$select = 'count(store_id) as stores';
		$data['total_stores'] = $this->store_model->store($select,$where)[0];
		$select = 'count(product_id) as sales';
		$table = 'sales_fact_1997';
		$sale_1997 = $this->store_model->sale($table,$select,$where)[0]['sales'];
		$table = 'sales_fact_1998';
		$sale_1998 = $this->store_model->sale($table,$select,$where)[0]['sales'];
		$data['total_sale'] = $sale_1997 + $sale_1998;
		$quarter_sale = [];
		$select = 'count(A.product_id) as sale,B.quarter,B.the_year';
		$table = 'sales_fact_1997 as A';
		$join = [
			0 => [
				'table' => 'time_by_day as B',
				'on' => 'A.time_id = B.time_id'
			]
		];
		$group_by = 'B.quarter';
		$quarter_sale_1997 = $this->store_model->sale($table,$select,$where,$join,$group_by);
		foreach ($quarter_sale_1997 as $key => $value) {
			array_push($quarter_sale, (object)['y'=>"".$value['the_year']." ".$value['quarter'],'item1'=>$value['sale']]);
		}
		$select = 'count(A.product_id) as sale,B.quarter,B.the_year';
		$table = 'sales_fact_1998 as A';
		$join = [
			0 => [
				'table' => 'time_by_day as B',
				'on' => 'A.time_id = B.time_id'
			]
		];
		$group_by = 'B.quarter';
		$quarter_sale_1998 = $this->store_model->sale($table,$select,$where,$join,$group_by);
		foreach ($quarter_sale_1998 as $key => $value) {
			array_push($quarter_sale, (object)['y'=>"".$value['the_year']." ".$value['quarter'],'item1'=>$value['sale']]);
		}		
		$data['quarter_sale'] = json_encode($quarter_sale);
		$data['header'] = $this->load->view('common/header',['title'=>'Dashboard'],true);
		$data['footer'] = $this->load->view('common/footer',[],true);
		$data['top_navbar'] = $this->load->view('common/top_navbar',[],true);
		$data['sidebar_menu'] = $this->load->view('common/sidebar_menu',['active'=>'dashboard'],true);
		$data['page_footer'] = $this->load->view('common/page_footer',[],true);
		$this->load->view('dashboard',$data);
	}

	public function login()
	{
		if($this->session->userdata('logged_in'))
		{
			redirect(base_url());
		}		
		$data['error_msg'] = ($x = $this->session->flashdata('error_msg'))?$x:'';
		$data['header'] = $this->load->view('common/header',['title'=>'Login'],true);
		$data['footer'] = $this->load->view('common/footer',[],true);		
		$data['csrf_name'] = $this->security->get_csrf_token_name();
		$data['csrf_hash'] = $this->security->get_csrf_hash();
		$this->load->view('login',$data);
	}

	public function authenticate()
	{
		$username = ($x = $this->input->post('username'))?$x:'';
		$password = ($x = $this->input->post('password'))?$x:'';
		if($username == '' || $password == '')
		{
			$this->session->set_flashdata('error_msg', 'Incomplete Data');
			redirect(base_url('/login'));
		}
		if($username == 'admin' && md5($password) == '21232f297a57a5a743894a0e4a801fc3')
		{
			$this->session->set_userdata('logged_in',TRUE);
			redirect(base_url());
		}
		else
		{
			$this->session->set_flashdata('error_msg', 'Incorrect username or password');
			redirect(base_url('/login'));
		}		
	}

	public function signout()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->session->unset_userdata('logged_in');
		}
		redirect(base_url());
	}

}
