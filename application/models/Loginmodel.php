<?php
if(!defined('BASEPATH')) exit('NO Direct script access allowed');

        class Loginmodel extends CI_model {

            public function isvalidate($username,$password){

                $q = $this->db->where(['username'=>$username,'password'=>$password])
                                        ->get('users');
                
                            if($q->num_rows())
                            {
                                return ['id'=>$q->row()->id,'username'=>$q->row()->username];
                            }
                            else{
                                return false;
                            }
        
            } 

            public function add_user($array){
          		return $this->db->insert('users',$array);
            }

            // public function add_domain_cart($user_id, $cart_items){
            //     // echo"<pre>";
            //     // print_r($user_id);
            //     // print_r($cart_items);
            //     // exit;
            //     $user_id =['user_id'=>$user_id];
            //     $array_merge =  array_merge($user_id,$cart_items);
            //     return $this->db->insert('cart_items',$array_merge);
            //         // exit;

            // }
        }
        

?>
