<?php
if(!defined('BASEPATH')) exit('NO Direct script access allowed');

        class Register extends MY_Controller{

            public function index(){
                
            $uname = $this->input->post();
            // echo "<pre>";
            // print_r($uname);   
            // exit; 

                        
                    $this->form_validation->set_rules('username','User Name Registered,','required|alpha_numeric|is_unique[users.username]');
                    $this->form_validation->set_rules('password','Password','required|alpha_numeric|max_length[50]');
                    $this->form_validation->set_rules('firstname','First Name','required|alpha');
                    $this->form_validation->set_rules('lastname','Last Name','required|alpha');
                    $this->form_validation->set_rules('organization','Organization Name','max_length[50]');
                    $this->form_validation->set_rules('phone','Phone Number','required|numeric|max_length[10]');
                    $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
                    $this->form_validation->set_rules('address1','Address','required');
                    $this->form_validation->set_rules('city','City','required');
                    $this->form_validation->set_rules('state','State','required');
                    $this->form_validation->set_rules('zipcode','Postal code','required');
                    $this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");

                    if($this->form_validation->run())
                    {
                        date_default_timezone_set('Asia/Calcutta');
                        $now = date('Y-m-d H:i:s');
                        $post = $this->input->post();
                        $post['created'] = $now;
                        //echo "<pre>";print_r($post);exit();
                        $this->load->model('Loginmodel','useradd');
                        if($this->useradd->add_user($post)){

                            // echo "successfully"; 
                            $this->session->set_flashdata('user_msg','User Registered successfully! Please Login Now');
                            $this->session->set_flashdata('user_class','alert-success');
                            $this->session->set_flashdata('user_register_active','right-panel-active');
                        }else{

                            $this->session->set_flashdata('user_msg','User Registeration Failed. Plz Try Again!!');
                            $this->session->set_flashdata('user_class','alert-danger');
                            $this->session->set_flashdata('user_register_active','right-panel-active');
                        }

                        return redirect('login');

                        // $this->load->library('email');

                        // $this->email->from(set_value('email'),set_value('fname'));
                        // $this->email->to("shar07107@gmail.com");
                        // $this->email->subject("Registration Greeting...");

                        // $this->email->message("Thank You for Registration.");
                        // $this->email->set_newline("\r\n");
                        // $this->email->send();

                        // if(!$this->email->send()){

                        // 	show_error($this->email->print_debugger());
                        // }
                        // else{

                        // 	echo "Your e-mail has been sent!";
                        // }
                    }
                    else{

                        $this->session->set_flashdata('user_register_active','right-panel-active');
                        $this->load->view('account/login');
                    }
            }
        }

?>