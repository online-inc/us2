<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct(){

		parent:: __construct();
		$this->load->model('Admin_model');	
		// echo "string";
		// $this->load->library('PHPExcel');
		// $this->load->library('IOFactory');
		// Check session is available or not
		if(!$this->session->userdata('admin_id') && !$this->session->userdata('admin_username') )
		return redirect('admin_login');

    }
	
		// Load Admin Dashboard
	public function index()
	{
		$this->load->view('admin/dashboard');
	}

	    // Admin logout session
	public function logout(){
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_username');

		return redirect('admin_login');
	}

   		//Load Category List Page
	public function category_list()
	{
		$this->load->model('Admin_model','category');
		$categories = $this->category->select_category();
		
		$this->load->view('admin/category_list',['categories'=>$categories]);
	}
		// Add Categories
	public function add_category(){

		$this->form_validation->set_rules('category_name','Category Name','required|is_unique[domain_category.category_name]');
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");

		if($this->form_validation->run()){

			$post = $this->input->post();
	
			$this->load->model('Admin_model','add_category');
			if($this->add_category->add_category($post)){

				echo "successfully";
				$this->session->set_flashdata('user_msg','Insert Category successfully');
				$this->session->set_flashdata('user_class','alert-success');
			}else{

				$this->session->set_flashdata('user_msg','Insert Category Failed. Plz Try Again!!');
				$this->session->set_flashdata('user_class','alert-danger');
			}

			return redirect('admin/category_list');

		} 
		else{
			// call category_list Funtion
			$this->category_list();
		}
	}
	
		//Delete Category
	public function deleteCategory(){

		$id= $this->input->post('id');
	
		$this->load->model('Admin_model','delete_category');
			if($this->delete_category->deleteCategory($id)){

				$this->session->set_flashdata('user_msg','Category deleted successfully');
				$this->session->set_flashdata('user_class','alert-success');
			}
			else{

				$this->session->set_flashdata('user_msg','Category not deleted, Please Try Again!!');
				$this->session->set_flashdata('user_class','alert-danger');

			}

			return redirect('admin/category_list');
	}
		
		// Load Domain List Page
	public function domain_list(){
		
		$this->load->model('Admin_model','category');
		$categories = $this->category->select_category();
		$this->load->model('Admin_model','domainlist');
		$domain_list = $this->domainlist->fetch_domainList();
		$this->load->view('admin/domain_list',['categories'=>$categories,'domain_list'=>$domain_list]);
	}
		// Add Domains in the List
	public function add_domainList(){

		$this->form_validation->set_rules('category_id','Select Category','required');
		$this->form_validation->set_rules('domainName','Domain Name','required|is_unique[domain_list.domainName]');
		$this->form_validation->set_rules('buy_price','Buy Price','required|numeric');
		$this->form_validation->set_rules('lease_price','Lease Price','required|numeric');
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");

		if($this->form_validation->run()){

			$post = $this->input->post();
		
			$this->load->model('Admin_model','add_domainList');
			if($this->add_domainList->add_domainList($post)){

				echo "successfully";
				$this->session->set_flashdata('user_msg','Domain Listed successfully');
				$this->session->set_flashdata('user_class','alert-success');
			}else{

				$this->session->set_flashdata('user_msg','Domain listed Failed. Plz Try Again!!');
				$this->session->set_flashdata('user_class','alert-danger');
			}

			return redirect('admin/domain_list');

		} 
		else{
			// call domain_list Funtion
			$this->domain_list();
		}
	}
	//import excel sheet
	function import()
	{
		if(isset($_FILES["file"]["name"]))
		{
			//print_r($_FILES["file"]["name"]);echo 'hello amir';exit();
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$domainName = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$category_id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$buy_price = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$lease_price = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$status = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$data[] = array(
						'domainName'		=>	$domainName,
						'category_id'		=>	$category_id,
						'buy_price'			=>	$buy_price,
						'lease_price'		=>	$lease_price,
						'status'			=>	$status
					);
				}
			}
			//echo '<pre>';print_r($data);echo '</pre>';exit();
			$this->Admin_model->insert($data);
			echo 'Data Imported successfully';
			$this->session->set_flashdata('user_msg','Domain Imported successfully');
			$this->session->set_flashdata('user_class','alert-success');
			return redirect('admin/domain_list');
		}	
	}

	//export excel sheet
	public function export_domain()
	{
		// echo "string";
		// exit;
		$filename = 'domainlist'.date('Ymd').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");
	   // get data 
		$usersData = $this->Admin_model->export_domain_model();
		//echo "<pre>";print_r($usersData);exit();
		// file creation 
		$file = fopen('php://output','w');
		$header = array("S. No.","Domain Name","Category_id","Buy_price","Lease_price","Status"); 
		fputcsv($file, $header);
		$php_array = json_encode($usersData);
		$allData = json_decode($php_array,true);
		foreach ($allData as $key => $line){ 
			fputcsv($file,$line); 
		}
		fclose($file); 
		// exit; 
	}

	// Delete Domain
	public function deleteDomainList(){
		
		$domainList_id= $this->input->post('domainList_id');
	
		$this->load->model('Admin_model','delete_domainList');
			if($this->delete_domainList->deleteDomainList($domainList_id)){

				$this->session->set_flashdata('user_msg','Domain deleted from the Domain List successfully');
				$this->session->set_flashdata('user_class','alert-success');
			}
			else{

				$this->session->set_flashdata('user_msg','Domain not deleted, Please Try Again!!');
				$this->session->set_flashdata('user_class','alert-danger');

			}

			return redirect('admin/domain_list');
	}

	//edit domain list page
	public function edit_domainList($domainList_id){
		
		$this->load->model('Admin_model','category');
		$categories = $this->category->select_category();
		$this->load->model('Admin_model','fetch_domain');
		$domain = $this->fetch_domain->search_domain($domainList_id);
		// echo "<pre>";
		// echo $domainList_id;
		// print_r($domain);
		// exit;
		$this->load->view('admin/edit_domainList',['categories'=>$categories,'domain'=>$domain]);
	}
	
	//edit domain list page
	public function updateDomainList($domainList_id){
		
		$post = $this->input->post();
		
		$this->form_validation->set_rules('category_id','Select Category','required');
		$this->form_validation->set_rules('domainName','Domain Name','required');//|is_unique[domain_list.domainName]
		$this->form_validation->set_rules('buy_price','Buy Price','required|numeric');
		$this->form_validation->set_rules('lease_price','Lease Price','required|numeric');
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");

		if($this->form_validation->run()){
			
			// echo "<pre>".$domainList_id."<br>";
			// print_r($post);
			// exit;

			$this->load->model('Admin_model','update_domain');
			if($this->update_domain->update_domain($domainList_id, $post)){

				$this->session->set_flashdata('user_msg','Domain Update successfully');
				$this->session->set_flashdata('user_class','alert-success');
			}
			else{

				$this->session->set_flashdata('user_msg','Domain not Update Please Try Again!!');
				$this->session->set_flashdata('user_class','alert-danger');

			}

				return redirect('admin/domain_list');

		}
		else{
			
		$this->load->model('Admin_model','category');
		$categories = $this->category->select_category();
		$this->load->model('Admin_model','fetch_domain');
		$domain = $this->fetch_domain->search_domain($domainList_id);
			$this->load->view('admin/edit_domainList',['categories'=>$categories,'domain'=>$domain]);
		}
	}
}
?>