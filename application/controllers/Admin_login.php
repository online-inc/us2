<?php
if(!defined('BASEPATH')) exit('NO Direct script access allowed');
		
class Admin_login extends MY_Controller{

	public function __construct(){

		parent:: __construct();
		// Check session is available or not
		if($this->session->userdata('admin_id') && $this->session->userdata('admin_username'))
		return redirect('admin/dashboard');

    }

		//Load Login page
    public function index(){


		$this->form_validation->set_rules('uname','User Name','required|alpha_numeric');
		$this->form_validation->set_rules('password','Password','required|max_length[12]');
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");

		if($this->form_validation->run()){

			$uname = $this->input->post('uname');
			$password = $this->input->post('password');

			$this->load->model('Admin_model');

            $data = $this->Admin_model->isAdminValidate($uname,$password);
            
			if($data){

				$this->load->library('session');
				$this->session->set_userdata('admin_id',$data['admin_id']);
				$this->session->set_userdata('admin_username',$data['admin_username']);
			
				return redirect('admin');
			}
			else{

				$this->session->set_flashdata('Login_Failed','Invalid Username/Password');
				return redirect('admin_login');

			}
		} 
		else{

            $this->load->view('admin/login');
		}

    }


}
?>