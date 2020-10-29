<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Check session is available or not
		if(!$this->session->userdata('admin_id') && !$this->session->userdata('admin_username') )
		return redirect('admin_login');
	}
	// Load Admin Dashboard
	public function index()
	{
		$this->load->model('Order_model', 'order');
		$order_domains = $this->order->get_order_domain();
		//echo "<pre>";print_r($order_domains);exit();
		$this->load->view('admin/order_detail', ['order_domains' => $order_domains]);
	}
	//order listing on dashbord
	public function order_details($orderid)
	{
		// print_r($_REQUEST);exit;
		$this->load->model('Order_model', 'order_detail');
		$order_view_detail = $this->order_detail->get_billing_info($orderid);
		$this->load->model('Order_model', 'user_detail');
		$user_information = $this->user_detail->get_domain_name($orderid);
		//get user ID
		$user_ID = $user_information[0]->user_id;
		$this->load->model('Order_model', 'usrId');
		$user_details = $this->usrId->get_user_info($user_ID);
		//get order ID
		$oredr_ID = $user_information[0]->order_id;
		$this->load->model('Order_model', 'odrID');
		$order_detail_info = $this->odrID->get_total_order($oredr_ID);
		// echo "<pre>";print_r($order_detail_info);exit();
		$this->load->view('admin/order_detail_page', ['order_view_detail' => $order_view_detail, 'user_information' => $user_information, 'user_details' => $user_details, 'order_detail_info' => $order_detail_info]);
	}

}