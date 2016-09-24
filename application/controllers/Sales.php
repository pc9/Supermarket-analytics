<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->helper(array('regression'));
		if(!$this->session->userdata('logged_in'))
		{
			redirect(base_url('/login'));
		}		
	}

	public function index()
	{
		$this->load->model('store_model');
		$quarter_sale = [];
		$where = '';
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
		$x = [];
		$y = [];
		foreach ($quarter_sale as $key => $value) {
			array_push($x, $key+1);
			array_push($y, intval($value->item1));
		}
		$result = linear_regression($x,$y);
		$predicted_quarter_sale = [];
		$count = count($quarter_sale);
		for($i=1;$i<=4;$i++)
		{
			array_push($predicted_quarter_sale, (object)['y'=>"1999 Q".$i,'item1'=>round($result['m']*($count+$i) + $result['b'])]);	
		}
		$data['line_data'] = json_encode($result);
		$data['predicted_quarter_sale'] = json_encode($predicted_quarter_sale);
		$data['header'] = $this->load->view('common/header',['title'=>'Sales'],true);
		$data['footer'] = $this->load->view('common/footer',[],true);
		$data['top_navbar'] = $this->load->view('common/top_navbar',[],true);
		$data['sidebar_menu'] = $this->load->view('common/sidebar_menu',['active'=>'sales'],true);
		$this->load->view('sales',$data);
	}
}