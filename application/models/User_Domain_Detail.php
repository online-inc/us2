<?php
if(!defined('BASEPATH')) exit('NO Direct script access allowed');

        class User_Domain_Detail extends CI_model {

            public function check_user_domain($user_id,$domain){
                $q = $this->db->select()
                    // ->order_by('domainName', 'ASC')
                    ->from('users_domain')
                    ->where(['user_id'=>$user_id,'domainName'=>$domain])
                    ->get();
                $q = $q->result();
                //     print_r($q);
                    return $q;
            }

        }


?>