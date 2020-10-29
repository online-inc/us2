<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct(){

		parent:: __construct();
		if(!$this->session->userdata('id') && ! $this->session->userdata('username') )
		return redirect('login');

    }
    
	public function index()
	{

		$user_id = $this->session->userdata('id');
		$this->load->model('AccountModel');
		$productData = $this->AccountModel->fetchProduct($user_id);

		$this->load->view('account/index',['product'=>$productData]);
	}

	public function settings()
	{
		
		$this->load->view('account/settings');
	}
	
	public function logout(){
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('username');
// 		$this->session->sess_destroy();
            // $this->load->helper('cookie');
            // session_destroy();
            // setcookie('CI_user_id', null,"online.inc","/");
            // setcookie('CI_user_name', null,"online.inc","/");
            // $session->destroy();
        // delete_cookie("CI_user_id",".online.inc","/");
        // delete_cookie("CI_user_name",".online.inc","/");
		return redirect('login');
	}
}
