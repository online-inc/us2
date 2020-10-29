<?php
if(!defined('BASEPATH')) exit('NO Direct script access allowed');

        class AccountModel extends CI_model {

            public function fetchProduct($user_id){

                $q = $this->db->select()
                    ->order_by('domainName', 'ASC')
                    ->from('users_domain')
                    ->where('user_id',$user_id)
                    ->get();
                    
                    return $q->result();
            }
            public function user_domain_data($domain_name){

                $q = $this->db->select()
                    ->from('users_domain')
                    ->where('domainName',$domain_name)
                    ->get();
                    
                    return $q->result();
            }

            public function fetchUsers($user_id){

                $q = $this->db->select()
                    ->from('users')
                    ->where('id',$user_id)
                    ->get();
                    
                    return $q->result();
            }

        }


?>