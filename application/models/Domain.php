<?php
if(!defined('BASEPATH')) exit('NO Direct script access allowed');

        class Domain extends CI_model {

                /* 
                created public function exactMatch($query) 
                description: Fetch values for domain which is get by name.com API
                */
                public function exactMatch($query){

                        $this->db->select('*')
                                ->from('domain_list')
                                ->where(['domainName'=>$query,'status'=>1]);
                                $this->db->order_by('domainName', 'ASC');
                                $q = $this->db->get();

                                return $q->result();
                }
                
                public function searchDomain($query){//,$limit,$offset

                        $this->db->select('*')
                                ->from('domain_list')
                                // ->limit($limit,$offset)
                                ->where('status',1);

                        if($query != ''){
                                
                                $this->db->like('domainName',$query);
                                // $this->db->or_like('');

                        }
                        $this->db->order_by('domainName', 'ASC');
                        $q = $this->db->get();
                        // echo "<pre>";
                        // print_r($this->db->get());
                        // exit;
                        return $q->result();
                }
                        //Fetch and count Domain list for search bar
                // public function num_rows($query){

		// $q = $this->db->select('*')
                //                 ->from('domain_list')
                //                 ->where('status',1);

                //         if($query != ''){
                                
                //                 $this->db->like('domainName',$query);
                //                 // $this->db->or_like('');

                //         }
                //         $this->db->order_by('domainName', 'ASC');
                //         $q = $this->db->get();
                //         return $q->num_rows();
	        // }
                
                        // Fetch domain price for updation of cart
                public function fetchPrice($domainName){
                        $this->db->select('*')
                        ->from('domain_list')
                        ->where('domainName',$domainName); 
                        $q = $this->db->get();
                      
                        return $q->result();
                }


                public function add_domain_cart($user_id, $cart_items){
                        // echo"<pre>";
                        // print_r($user_id);
                        // print_r($cart_items);
                        // exit;
                        $user_id =['user_id'=>$user_id];
                        $array_merge =  array_merge($user_id,$cart_items);
                        return $this->db->insert('cart_items',$array_merge);
                            // exit;
        
                    } 

        }


?>
