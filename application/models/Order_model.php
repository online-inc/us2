<?php
if(!defined('BASEPATH')) exit('NO Direct script access allowed');

class Order_model extends CI_model
{
	//get total order
	public function get_order_domain()
	{
		$query = $this->db->select('*')
				->from('orders')
				->join('users', 'orders.user_id = users.id')
				->get();
		//echo "<pre>";print_r($query->result());exit();
		return $query->result();
	}
	//Get Domain Name
	public function get_domain_name($orderID)
	{
		$domain_name = $this->db->select('*')
					   ->from('order_items')
					   ->join('orders', 'order_items.order_id = orders.id')
					   ->where('order_number', $orderID)
					   ->get();
		//echo "<pre>";print_r($domain_name->result());exit();
		return $domain_name->result();
	}
	//Billing Information
	public function get_billing_info($orderID)
	{
		$billingData = $this->db->select('*')
					   ->from('orders')
					   ->where(['order_number'=>$orderID])
					   ->get();
		//echo "<pre>";print_r($billingData->result());exit();
		return $billingData->result();
	}
	//get user detail
	public function get_user_info($user_id)
	{
		$user_info = $this->db->select('*')
					 ->from('users')
					 ->where('id', $user_id)
					 ->get();
					 //print_r($user_info->result());exit();
		return $user_info->result();
	}
	//get order detail
	public function get_total_order($oredr_ID)
	{
		$order_details = $this->db->select('*')
						 ->from('order_items')
						 ->where('order_id', $oredr_ID)
						 ->get();
		//print_r($order_details->result());exit();
		return $order_details->result();
	}
	
}