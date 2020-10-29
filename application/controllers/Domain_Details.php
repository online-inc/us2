<?php
if(!defined('BASEPATH')) exit('NO Direct script access allowed');

        /* Details: this class shows user Domain Details and Name servers */

class Domain_Details extends MY_Controller{

        public function  __construct(){

                parent:: __construct();
                if(!$this->session->userdata('id') && !$this->session->userdata('username') )
                return redirect('login');

                //calling User_Domain Model
                $this->load->model('User_Domain_Detail','domain_detail');
        }
                
        public function index(){
        
                return redirect('account');
        }
        // call Domain info or details
        public function info($domain){

                // getDomain($domain) calling User_Domain Model

                $domain_data = $this->domain_detail->check_user_domain($this->session->userdata('id'),$domain);

                //getDomain($domain) Get Domain Information from API
                $domainAPI_data = $this->getDomainAPI($domain);

                $this->load->model('AccountModel','userDetail');

                if($domain_data==true && $domainAPI_data['domainName']){
                        
                // $domainAPI_data = $this->getDomain($domain);
         
                //model('AccountModel','userDetails') Fetch User from Account Model

                $user_datafromDB = $this->userDetail->fetchUsers($this->session->userdata('id'));

                $this->load->view('domain_details',['domain_data'=>$domain_data,'domainAPI_data'=>$domainAPI_data,'user_datafromDB'=>$user_datafromDB]);

                }else{
                        
                      return redirect('account');
                }
        
        }

                // NameServer View nameservers($domain_name)

        public function nameservers($domain_name){
        
                // getDomain($domain) calling User_Domain Model

                $domain_data = $this->domain_detail->check_user_domain($this->session->userdata('id'),$domain_name);

                //getDomain($domain) Get Domain Information from API
                $domainAPI_data = $this->getDomainAPI($domain_name);

                // echo "<pre>";
                // print_r($domainAPI_data);
                // echo "</pre>";

                $this->load->model('AccountModel','userDetail');

                if($domain_data==true && $domainAPI_data['domainName']){
                        
                // $domainAPI_data = $this->getDomain($domain);
         
                //model('AccountModel','userDetails') Fetch Users domain Details from Account Model

		$user_domain_data = $this->userDetail->user_domain_data($domain_name);
                echo "<pre>";
                print_r($user_domain_data);
                echo "</pre>";
                
                //model('AccountModel','userDetails') Fetch User from Account Model
                $user_datafromDB = $this->userDetail->fetchUsers($this->session->userdata('id'));

                $this->load->view('nameservers',['domain_data'=>$domain_data,'domainAPI_data'=>$domainAPI_data,'user_datafromDB'=>$user_datafromDB,'user_domain_data'=>$user_domain_data]);

                }else{
                        
                      return redirect('account');
                }

        }
                // Update Nameserver from this below function updateNameserver($domain_name)
        public function updateNameserver(){
                
                $inputfields = $this->input->post();
                // echo "<pre>";
                // print_r($inputfields);
                // echo $inputfields['domainName'];
                // echo "</pre>";
                // exit;

                $domainName = $inputfields['domainName'];
                $nameservers = array_splice($inputfields, 1,5);

                //getDomain($domain) Update nameservers of the Domains from API
                $domainAPI_data = $this->updateNameserverAPI($domainName,$nameservers);

                // echo $domainAPI_data['domainName'];
                // echo "<pre>";
                // print_r($domainAPI_data);
                // echo "</pre>";
                // exit;

                if($domainAPI_data['domainName']){

                        // echo "successfully";
                        $this->session->set_flashdata('nameserver_msg','Nameservers successfully Updated');
                        $this->session->set_flashdata('nameserver_class','alert-success');
                }else if($domainAPI_data['message']){

                        $this->session->set_flashdata('nameserver_msg','Invalid Hostname. Plz Try Again!!');
                        $this->session->set_flashdata('nameserver_class','alert-danger');

                }
                else{

                        $this->session->set_flashdata('nameserver_msg','Nameservers Updation Failed. Plz Try Again!!');
                        $this->session->set_flashdata('nameserver_class','alert-danger');
                }
                
			return redirect('domain_details/nameservers/'.$domainName);

        }


        public function dns($domain_name){
                
        
                // getDomain($domain) calling User_Domain Model

                $domain_data = $this->domain_detail->check_user_domain($this->session->userdata('id'),$domain_name);

                //getDomain($domain) Get Domain Information from API
                $domainAPI_data = $this->getDomainAPI($domain_name);

                // echo "<pre>";
                // print_r($domainAPI_data);
                // echo "</pre>";

                $this->load->model('AccountModel','userDetail');

                        if($domain_data==true && $domainAPI_data['domainName']){
                                
                        // $domainAPI_data = $this->getDomain($domain);
                
                        //model('AccountModel','userDetails') Fetch User from Account Model

                        $user_datafromDB = $this->userDetail->fetchUsers($this->session->userdata('id'));

                        $this->load->view('dns',['domain_data'=>$domain_data,'domainAPI_data'=>$domainAPI_data,'user_datafromDB'=>$user_datafromDB]);
                
                        // $this->load->view('dns');
                }
        }       
        
}