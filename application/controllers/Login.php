<?php
if(!defined('BASEPATH')) exit('NO Direct script access allowed');
		
class Login extends MY_Controller{

	public function __construct(){

		parent:: __construct();
		if($this->session->userdata('id') && $this->session->userdata('username'))
		return redirect('account');

    }

    public function index(){

	
		$this->form_validation->set_rules('uname','User Name','required|alpha_numeric');
		$this->form_validation->set_rules('pwd','Password','required');
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");

		if($this->form_validation->run()){

			$uname = $this->input->post('uname');
			$password = $this->input->post('pwd');
			
			//Load cookies helper
			
            $this->load->helper('cookie');
            
            
			$this->load->model('Loginmodel');

            $data = $this->Loginmodel->isvalidate($uname,$password);
            
			if($data){

				$this->session->set_userdata('id',$data['id']);
				$this->session->set_userdata('username',$data['username']);
				
				// setcookie("CI_user_id", $data['id'], time() + (86400 * 30), "/", "online.inc");
				// setcookie('CI_user_name',$data['username'], time() + (86400 * 30), "/", "online.inc");
				// $cookie = get_cookie('CI_user_name');  
				// echo $_COOKIE['id'];
				// print_r($_COOKIE);
				// exit;
				
				// cart functionality insert in database
				
				$this->load->model('Domain');
				$cart_user_id = $this->session->userdata('id');
				if($this->session->userdata('cart_items')){
					foreach($_SESSION["cart_items"] as $keys => $values){

						if($this->db->where(['domainName'=>$values['domainName'],'user_id'=>$cart_user_id])->get('cart_items')->num_rows() == 0){
							$this->Domain->add_domain_cart($cart_user_id, $_SESSION["cart_items"][$keys]);
						}else{
							
							$this->db->where(['domainName'=>$values['domainName'],'user_id'=>$cart_user_id])
										->update('cart_items', $_SESSION["cart_items"][$keys]);
							// echo "Username already exists";
							// $this->Loginmodel->add_domain_cart($user_id, $_SESSION["cart_items"][$keys]);
						}
					}
				}
				if($this->session->userdata('pre') == 'cart'){
					
					$this->session->unset_userdata('pre');
					return redirect('Checkout');
				}
				else{
					return redirect('account');
				}
			}
			else{

				$this->session->set_flashdata('Login_Failed','Invalid Username/Password');
				return redirect('login');

			}
		} 
		else{

            $this->load->view('account/login');
		}

    }
    


}
?>
