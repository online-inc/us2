<?php
if(!defined('BASEPATH')) exit('NO Direct script access allowed');

        class Admin_model extends CI_model {
                
                // validate admin
            public function isAdminValidate($username,$password){

                $q = $this->db->where(['username'=>$username,'password'=>$password])
                                        ->get('admin');
                
                            if($q->num_rows())
                            {
                                return ['admin_id'=>$q->row()->id,'admin_username'=>$q->row()->username];
                            }
                            else{
                                return false;
                            }
        
            }

            // insert excel sheet data
            public function insert($data)
            {
                $this->db->insert_batch('domain_list', $data);
            }

            //export excel sheet for domains
            public function export_domain_model()
            {
                $this->db->select(array('id', 'domainName', 'category_id', 'buy_price', 'lease_price', 'status'));
                $this->db->from('domain_list');
                $query = $this->db->get();
                return $query->result();
            }
            
                //Fetch Categories
            public function select_category(){

                $q = $this->db->select()
                    ->order_by('category_name', 'ASC')
					->from('domain_category')
                    ->get();

                    return $q->result();
            }
                // Add categories
            public function add_category($category_name){

                return $this->db->insert('domain_category',$category_name);
            }
                // Delete Categories
            public function deleteCategory($id){

                return $this->db->delete('domain_category',['id'=>$id]);
        
            }
                // Add Domain in the List
            public function add_domainList($domainList){

                return $this->db->insert('domain_list',$domainList);
            }
                // Fetch domain form the List
            public function fetch_domainList(){
                $q = $this->db->select(['*'])
                ->join('domain_list', 'domain_list.category_id = domain_category.id','right')
                ->order_by('domainName', 'ASC')
                ->from('domain_category')
                ->get();
                // echo "<pre>";
                // print_r($q->result());
                // exit;
                return $q->result();

            }

               // Delete DomainList
               public function deleteDomainList($domainList_id){

                return $this->db->delete('domain_list',['id'=>$domainList_id]);
        
            }
            // Select Domain from DB
            public function search_domain($domainList_id){
                $q = $this->db->select(['domain_list.id','domain_list.domainName','domain_list.buy_price','domain_list.lease_price','domain_category.category_name','domain_list.category_id','domain_list.status'])
                ->join('domain_category', 'domain_category.id = domain_list.category_id')
                ->from('domain_list')
                ->where('domain_list.id',$domainList_id)
                ->get();
           
                // echo "<pre>";
                // print_r($q->row());
                // exit;
                    return $q->row();
     
         }

         // Update Domain in Domain List
         public function update_domain($domainList_id, $post_data){
            
            // echo "<pre>";
            // print_r($post_data);
            // exit;
            return $this->db->where('id',$domainList_id)
            ->update('domain_list',$post_data);
           
  
      }

        }
        

?>