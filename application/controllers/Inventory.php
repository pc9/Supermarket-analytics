<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

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
		$this->load->model('store_model');
		$select = 'store_id,store_name';
		$where = array('store_id !='=>'0');
		$data['store'] = $this->store_model->store($select,$where);
		$data['header'] = $this->load->view('common/header',['title'=>'Inventory'],true);
		$data['footer'] = $this->load->view('common/footer',[],true);
		$data['top_navbar'] = $this->load->view('common/top_navbar',[],true);
		$data['sidebar_menu'] = $this->load->view('common/sidebar_menu',['active'=>'inventory'],true);
		$this->load->view('inventory',$data);
	}

	public function get_inventory_data()
	{
		$store_id = ($x = $this->input->get('store_id'))?$x:0;
		$this->load->model('store_model');
		echo json_encode($this->store_model->get_inventory_data($store_id));
	}
}