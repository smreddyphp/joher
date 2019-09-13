<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'helpers/notification_helper.php';

class Admin1 extends CI_Controller 
{
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page'] ="dashboard";
				$data['user_info'] = $this->common_m->get_user_details();
				$data['users_count'] = $this->common_m->users_count();
				$data['graph_users'] = $this->common_m->get_monthwise_reg('1');
				$data['graph_indi'] = $this->common_m->get_monthwise_reg('2');
				$data['graph_auto'] = $this->common_m->get_monthwise_reg('3');
				$data['graph_scrap'] = $this->common_m->get_monthwise_reg('4');
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/index');
			}
			else if($this->session->userdata('role') =='agent')
			{
			    $data['current_page'] ="dashboard";
				$data['user_info'] = $this->common_m->get_user_details();
				$data['users_count'] = $this->common_m->users_count();
				$data['graph_users'] = $this->common_m->get_monthwise_reg('1');
				$data['graph_indi'] = $this->common_m->get_monthwise_reg('2');
				$data['graph_auto'] = $this->common_m->get_monthwise_reg('3');
				$data['graph_scrap'] = $this->common_m->get_monthwise_reg('4');
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/index');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}
		else
		{
			redirect(base_url().'home/index');
		}
	}
	
	public function customer_adds()
	{
		if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page'] ="customer_adds";
				$data['page_name'] =" Customer Adds";
				$data['user_info'] = $this->common_m->get_user_details();
				$data['adds'] = $this->common_m->get_customer_adds();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/customer_adds');

			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}

	}
	
	//add adds model
	public function add_adds($value='') 
	{
		$data 			= array();
		$data['id'] 	= $this->input->post('id');
		$data['pname'] 	= $this->input->post('pname');
		if($data['pname']=='customer_adds') 
		{
			$data['value']  = ($data['id'] != "") ? $this->common_m->get_customer_adds($data['id']) : array();
		}
		
		if($data['pname']=='service_provider_adds')
		{
			$data['value']  = ($data['id'] != "") ? $this->common_m->get_service_provider_adds($data['id']) : array();
		}
		
		$this->load->view('admin/add_adds',$data);
	}
	
	
	
	//profile 
	public function profile(){
		if($this->session->userdata('auth_level')) { 
			$data['user_info'] = $this->common_m->get_user_details();
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/includes/footer');
			$this->load->view('admin/profile');	

		}
		else{
			redirect(base_url().'home/index');
		}
	}
	
	public function profile_update(){
		$data = $this->input->post('data');
		$data2 = $this->input->post('data2');
		if(!empty($_FILES['profile_image']['name'])){
           $config['upload_path'] = 'assets/uploads/user_profiles/';
           $config['allowed_types'] = 'jpg|jpeg|png|gif';
           $config['file_name'] = $_FILES['profile_image']['name'];
                  
           $this->load->library('upload',$config);
           $this->upload->initialize($config);
             
           if($this->upload->do_upload('profile_image')){
           $uploadData = $this->upload->data();
           $data['image'] = $config['upload_path'].$uploadData['file_name'];
           }else{
           $data['image'] = '';
           }
        }else{
        	$data['image'] =$data2['old_image']; 
        }
        //check mobile is exist or not
        if(!($this->check_user_mobile($data['mobile'],$data2['user_id']))){
        	echo json_encode(["status"=>"error","message"=>"Mobile number is already registgerd please use another"]);
        }else{
        	$this->db->where('user_id',$data2['user_id'])->update('users',$data);
        	$this->session->set_flashdata('success','Profile Updated successfully !');
			echo json_encode(["status"=>"success","message"=>"Profile Updated successfully"]);
        }
	}
	
	public function check_user_mobile($mobile,$user_id) {
        if (count($this->db->where("mobile",$mobile)->where_not_in('user_id',$user_id)->get('users')->row_array()) > 0) {
            return FALSE;
        }else{
            return TRUE;
        }          
    }
    
    //update password
    public function update_pwd()
    {
		$data = $this->input->post('data');
		if (!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9@$!%*#?&]{8,20}$/",$data['new_pass']) )
		{
				echo json_encode(["status"=>"error","message"=>"Please Ensure that you have at least one lower case letter, one upper case letter, one digit"]);
		} 
		else 
		{
			$res  = $this->common_m->change_password($data);
			if($res == 202)
			{
		     	echo json_encode(["status"=>"error","message"=>"Entered old password is wrong !"]);
			}
	        else if($res == 201)
	        {
	            $this->session->set_flashdata('success','Password Updated successfully !');
	            echo json_encode(["status"=>"success","message"=>"Password Updated successfully"]);
	            exit;
	        }
	        else
	        {
	             echo json_encode(["status"=>"error","message"=>"Unknown error !"]);
	        }
				
		}	
	}
	
	//Add Category 17/07/2018
	public function category_add()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page'] ="customer_adds";
				$data['page_name'] =" Category Management";
				$data['user_info'] = $this->common_m->get_user_details();
				$data['adds'] = $this->common_m->get_category_adds();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/category_adds');

			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//add Category model
	public function add_Category($value='') 
	{
		$data 			= array();
		$data['id'] 	= $this->input->post('id');
		$data['pname'] 	= $this->input->post('pname');
		
		if($data['pname']=='customer_adds') 
		{
			$data['value']  = ($data['id'] != "") ? $this->common_m->get_category_adds($data['id']) : array();
		}
		
		if($data['pname']=='service_provider_adds')
		{
			$data['value']  = ($data['id'] != "") ? $this->common_m->get_service_provider_adds($data['id']) : array();
		}
		
		if($data['pname']=='event')
		{
		    $data['value']  = ($data['id'] != "") ? $this->common_m->get_event_adds($data['id']) : array();
		}
		
		if($data['pname']=='wallet')
		{
		    $data['value']  = ($data['id'] != "") ? $this->common_m->get_wallet_adds($data['id']) : array();
		}
		
		if($data['pname']=='agent')
		{
		    $data['value']  = ($data['id'] != "") ? $this->common_m->get_agent_adds($data['id']) : array();
		}

		if($data['pname']=='users')
		{
		    $data['value']  = ($data['id'] != "") ? $this->common_m->get_user_adds($data['id']) : array();
		    if($data['id'])
		    {
		    	$data['permissions']  = $this->db->select('group_concat(type) as type')->where('user_id',$data['id'])->get('permissions')->row_array();
		    }

		}
		
		if($data['pname']=='request_call')
		{
		    $data['value']  = ($data['id'] != "") ? $this->common_m->get_request_call($data['id']) : array();
		}

		if($data['pname']=='class_type')
		{
		    $data['value']  = ($data['id'] != "") ? $this->crms_m->get_class_type($data['id']) : array();
		}

		if($data['pname']=='airlines')
		{
		    $data['value']  = ($data['id'] != "") ? $this->crms_m->get_airlines_choice($data['id']) : array();
		}
		if($data['pname']=='hotel_chain')
		{
		    $data['value']  = ($data['id'] != "") ? $this->crms_m->get_hotel_chain_choice($data['id']) : array();
		}
		if($data['pname']=='car_choice')
		{
		    $data['value']  = ($data['id'] != "") ? $this->crms_m->get_car_choice($data['id']) : array();
		}
		if($data['pname']=='city')
		{
		    $data['value']  = ($data['id'] != "") ? $this->crms_m->get_city($data['id']) : array();
		}
		
		if($data['pname']=='documents')
		{
		    $data['value']  = ($data['id'] != "") ? $this->crms_m->get_documents_using_id($data['id']) : array();
		    //echo $this->db->last_query();
		    $data['user_id'] = $this->input->post('user_id');
		    $data['doc'] = $this->input->post('doc');
		}
		
		
		
		if($data['pname']=='event')
		{
		    $this->load->view('admin/add_event',$data);
		}
		else if($data['pname']=='wallet')
		{
		    $this->load->view('admin/add_wallet',$data);
		}
		else if($data['pname']=='agent')
		{
		    $this->load->view('admin/add_agent',$data);
		}
		else if($data['pname']=='users')
		{
			if($data['id'])
		    {
		    	$data['permissions']  = $this->db->select('group_concat(type) as type')->where('user_id',$data['id'])->get('permissions')->row_array();
		    }
		    
		    $this->load->view('admin/add_users',$data);
		}
		else if($data['pname']=='request_call')
		{
		    $this->load->view('admin/add_request_call',$data);
		}
		else if($data['pname']=='class_type')
		{
		    $this->load->view('admin/add_class_type',$data);
		}
		else if($data['pname']=='airlines')
		{
		    $this->load->view('admin/add_airlines',$data);
		}
		else if($data['pname']=='hotel_chain')
		{
		    $this->load->view('admin/add_hotel_chain',$data);
		}
		else if($data['pname']=='car_choice')
		{
		    $this->load->view('admin/add_car_choice',$data);
		}
		else if($data['pname']=='city')
		{
		    $this->load->view('admin/add_city',$data);
		}
		else if($data['pname']=='documents')
		{
		    //print_r($data);
		    $this->load->view('admin/add_documents',$data);
		}			
		else
		{
		    $this->load->view('admin/add_category',$data);
		}
	}
	

	//Save Client Login 
	public function save_client()
		{
	    	$data = $this->input->post('data');
	        
	    	if(!empty($data['user_id']))
       			 {
	                if($data['pname'] == 'add_client')
                	{
            		    $table                  = 'users';
            		    
            		    $data1['email']      = $data['email'];
                		$data1['mobile']     = $data['mobile'];
                		$data1['user_name']  = $data['full_name'];
                		$data1['address']    = $data['current_address'];
            		    
            		    $data1['auth_level']     =1;
            			$data1['role']           ='client';
            			$data1['customer_type']  ='CRMS';
            			/*$data['form_hours']     = date('h:i A',strtotime($data['form_hours']));
            			$data['to_hours']       = date('h:i A',strtotime($data['to_hours']));*/
            		    
            		    if(empty($data['password']))
            		    {
            		        $data1['password']       =   base64_encode(mt_rand(99,99999999));
            		    }
            		    else
            		    {
            		        $data1['password']       =   base64_encode($data['password']);
            		    }
            		    
            		    $img_path                   = 'assets/uploads/user_profiles';
                	}

	                unset($data['pname']);
	                
            		//for member image
            		if(!empty($_FILES['addimage']['name']))
            		{       
            		       $imageFileType = strtolower(pathinfo(basename($_FILES["addimage"]["name"]),PATHINFO_EXTENSION));
            		       $imgname = date('Y-m-d').'-'.time().'.'.$imageFileType;
            		       
            			   $config['upload_path'] = ($img_path)?$img_path:'assets/uploads/category_adds';
            			   $config['allowed_types'] = 'jpg|jpeg|png|gif';
            			   $config['file_name'] = $imgname;     
            			   $this->load->library('upload',$config);
            			   $this->upload->initialize($config);
            			   if($this->upload->do_upload('addimage'))
            			   {
            			    $uploadData = $this->upload->data();
            			    $data1['image'] = $config['upload_path'].'/'.$uploadData['file_name'];
            			   }else{
            			   $data1['image'] = '';
            			   }
            		}
            		else 
            		{
            			$data1['image'] = $this->input->post('old_image');
            		}
            		if(@$data['sports'])
            		{
            			$data['sports']         = serialize($data['sports']);
            		}
            		else
            		{
            			$data['sports'] = '';
            		}
            		if(@$data['entertainment']){
            			$data['entertainment']         = serialize($data['entertainment']);
            		}
            		else
            		{
            			$data['entertainment'] = '';
            		}
            		if(@$data['arts_crafts']){
            			$data['arts_crafts']         = serialize($data['arts_crafts']);
            		}
            		else
            		{
            			$data['arts_crafts'] = '';
            		}
            		if(@$data['health']){
            			$data['health']         = serialize($data['health']);
            		}
            		else
            		{
            			$data['health'] = '';
            		}
            		
            		/*$data['sports']          = serialize($data['sports']);
            		$data['entertainment']   = serialize($data['entertainment']);
            		$data['arts_crafts']     = serialize($data['arts_crafts']);
            		$data['health']          = serialize($data['health']);*/
            	/*	if(@$data['mostvisited_cities']!='')
            		{
	            		if(@$data['mostvisited_cities']=='Business')
	            		{
	            			unset($data['cities_details'][1]);
	            			unset($data['cities_details'][3]);
	            			unset($data['cities_details'][5]);
	            			$data['cities_details']  =implode(',', $data['cities_details']);
	            		}
	            		else
	            		{
	            			unset($data['cities_details'][0]);
	            			unset($data['cities_details'][2]);
	            			unset($data['cities_details'][4]);
	            			$data['cities_details']  =implode(',', $data['cities_details']);
	            		}
            		}
            		else
            		{
            			$data['mostvisited_cities'] = '';
            			$data['cities_details'] = '';
            		}*/

            		$data['mostvisited_cities'] = serialize($data['mostvisited_cities']);
            		$data['cities_details'] = serialize($data['cities_details']);
            		
        			$this->db->where('user_id',$data['user_id']);
        			//unset($data['user_id']);
        			$update=$this->db->update($table,$data1);
        			
        			$this->db->where('user_id',$data['user_id']);
        			$update=$this->db->update('user_info',$data);
        			
        			
        			$this->session->set_flashdata('success','Data Updated successfully !');
        			echo json_encode(["status"=>"success","message"=>"Data Updated successfully"]);
        }
        else
        {
    	    $res = $this->db->where('email',$data['email'])->get('users')->row();
    	    $res1 = $this->db->where('mobile',$data['mobile'])->get('users')->row();
    	   
    	    if(sizeof($res) == 0)
    	    {
    	         if(sizeof($res1) == 0)
    	         {
    	                
    	                if($data['pname'] == 'add_client')
                    	{
                		    $table               = 'users';
                		    $data1['email']      = $data['email'];
                		    $data1['mobile']     = $data['mobile'];
                		    $data1['user_name']  = $data['full_name'];
                		    $data1['address']    = $data['current_address'];
                		    
                		    $data1['auth_level']     =1;
                			$data1['role']           ='client';
                			$data1['customer_type']  ='CRMS';
                			/*$data['form_hours']   = date('h:i A',strtotime($data['form_hours']));
            			    $data['to_hours']       = date('h:i A',strtotime($data['to_hours']));*/
                		    $data1['created_at']     = date('Y-m-d h:i:s');
                		    
                		    if(empty($data['password']))
                		    {
                		        $data1['password']       =   base64_encode(mt_rand(99,99999999));
                		    }
                		    else
                		    {
                		        $data1['password']       =   base64_encode($data['password']);
                		    }
                		    
                		    $img_path                   = 'assets/uploads/user_profiles';
                		    
                    	}
    	                
    	                unset($data['pname']);
    	                
                		//for member image
                		if(!empty($_FILES['addimage']['name']))
                		{       
                		       $imageFileType = strtolower(pathinfo(basename($_FILES["addimage"]["name"]),PATHINFO_EXTENSION));
                		       $imgname = date('Y-m-d').'-'.time().'.'.$imageFileType;
                		       
                			   $config['upload_path'] = ($img_path)?$img_path:'assets/uploads/user_profiles';
                			   $config['allowed_types'] = 'jpg|jpeg|png|gif';
                			   $config['file_name'] = $imgname;     
                			   $this->load->library('upload',$config);
                			   $this->upload->initialize($config);
                			   if($this->upload->do_upload('addimage')){
                			   $uploadData = $this->upload->data();
                			   $data['image'] = $config['upload_path'].'/'.$uploadData['file_name'];
                			   }else{
                			   $data['image'] = '';
                			   }
                		}
                		else if($this->input->post('old_image')) 
                		{
                			$data1['image'] = $this->input->post('old_image');
                		}
                		else
						{                		
							$data1['image'] ='assets/uploads/user_profiles/default1.png';
                		}
                		
                		if(!empty($data['user_id']))
                		{
                			$this->db->where('user_id',$data['user_id']);
                			unset($data['user_id']);
                			$update=$this->db->update($table,$data);
                			$this->session->set_flashdata('success','Data Updated successfully !');
                			echo json_encode(["status"=>"success","message"=>"Data Updated successfully"]);
                		}
                		else 
                		{
                			//print_r($data1); exit;
                			$this->db->insert('users',$data1);

                			$insertId = $this->db->insert_id();
                			if(@$data['sports']){
                				$data['sports']         = serialize($data['sports']);
                			}
                			else
                			{
                				$data['sports'] = '';
                			}
                			if(@$data['entertainment']){
                				$data['entertainment']         = serialize($data['entertainment']);
                			}
                			else
                			{
                				$data['entertainment'] = '';
                			}
                			if(@$data['arts_crafts']){
                				$data['arts_crafts']         = serialize($data['arts_crafts']);
                			}
                			else
                			{
                				$data['arts_crafts'] = '';
                			}
                			if(@$data['health']){
                				$data['health']         = serialize($data['health']);
                			}
                			else
                			{
                				$data['health'] = '';
                			}
                			/*$data['entertainment']  = serialize($data['entertainment']);
                			$data['arts_crafts']    = serialize($data['arts_crafts']);
                			$data['health']         = serialize($data['health']);*/
                			$data['user_id']        = $insertId;
                			$data['password']       = $data1['password'];
                			$data['created_at']     = date('Y-m-d h:i:s');
                			$data['auth_level']     =1;
                			$data['role']           ='client';
                			$data['customer_type']  ='CRMS';
                			/*if(@$data['mostvisited_cities']!='')
                			{
                				if(@$data['mostvisited_cities']=='Business'){
                					unset($data['cities_details'][1]);
                					unset($data['cities_details'][3]);
                					unset($data['cities_details'][5]);
                					$data['cities_details']  =implode(',', $data['cities_details']);
                				}
                				else{
                					unset($data['cities_details'][0]);
                					unset($data['cities_details'][2]);
                					unset($data['cities_details'][4]);
                					$data['cities_details']  =implode(',', $data['cities_details']);
                				}
                			}
                			else
                			{
                				$data['mostvisited_cities'] = '';
                				$data['cities_details'] = '';
                			}*/

                			$data['mostvisited_cities'] = serialize($data['mostvisited_cities']);
                			$data['cities_details'] = serialize($data['cities_details']);

                			//print_r($data); exit;

                			$this->db->insert('user_info',$data);
                			
                			$this->session->set_flashdata('success','Data Inserted successfully !');
                			echo json_encode(["status"=>"success","message"=>"Data Inserted successfully"]);
                		}
    	         }
    	         else
    	         {
    	             	echo json_encode(["status"=>"error", "mobile" => "mobile" ,"message"=>"Mobile Number Alredy Exiting Please Enter Another Number"]);
    	         }
    	         
    	    }
    	    else
    	    {
    	        	echo json_encode(["status"=>"error", "email" => "email","message"=>"Email Alredy Exiting Please Enter Another Email"]);
    	    }
	    
        }
		
	}
	
	//Save Agent Login 
	public function save_agent()
	{
	    $data = $this->input->post('data');
	    
	    if(!empty($data['user_id']))
        {
	                if($data['pname'] == 'agent')
                	{
            		    $table                  = 'users';
            		    $data['category_id']    = serialize($data['category_id']);
            		    $data['working_day']    = serialize($this->input->post('working_day'));
            			$data['auth_level']     =6;
            			$data['role']           ='agent';
            			$data['form_hours']     = date('h:i A',strtotime($data['form_hours']));
            			$data['to_hours']       = date('h:i A',strtotime($data['to_hours']));
            		    $data['created_at']     = date('Y-m-d h:i:s');
            		    if(empty($data['password']))
            		    {
            		        $data['password']       =   base64_encode(mt_rand(99,99999999));
            		    }
            		    else
            		    {
            		        $data['password']       =   base64_encode($data['password']);
            		    }
            		    
            		    $img_path                   = 'assets/uploads/user_profiles';
                	}

	                unset($data['pname']);
	                
            		//for member image
            		if(!empty($_FILES['addimage']['name']))
            		{       
            		       $imageFileType = strtolower(pathinfo(basename($_FILES["addimage"]["name"]),PATHINFO_EXTENSION));
            		       $imgname = date('Y-m-d').'-'.time().'.'.$imageFileType;
            		       
            			   $config['upload_path'] = ($img_path)?$img_path:'assets/uploads/category_adds';
            			   $config['allowed_types'] = 'jpg|jpeg|png|gif';
            			   $config['file_name'] = $imgname;     
            			   $this->load->library('upload',$config);
            			   $this->upload->initialize($config);
            			   if($this->upload->do_upload('addimage')){
            			   $uploadData = $this->upload->data();
            			   $data['image'] = $config['upload_path'].'/'.$uploadData['file_name'];
            			   }else{
            			   $data['image'] = '';
            			   }
            		}
            		else 
            		{
            			$data['image'] = $this->input->post('old_image');
            		}
            		
        			$this->db->where('user_id',$data['user_id']);
        			unset($data['user_id']);
        			$update=$this->db->update($table,$data);
        			$this->session->set_flashdata('success','Data Updated successfully !');
        			echo json_encode(["status"=>"success","message"=>"Data Updated successfully"]);
        }
        else
        {
    	    $res = $this->db->where('email',$data['email'])->get('users')->row();
    	    $res1 = $this->db->where('mobile',$data['mobile'])->get('users')->row();
    	    if(sizeof($res) == 0)
    	    {
    	         if(sizeof($res1) == 0)
    	         {
    	                
    	                if($data['pname'] == 'agent')
                    	{
                		    $table                  = 'users';
                		    $data['category_id']    = serialize($data['category_id']);
                		    $data['working_day']    = serialize($data['working_day']);
                			$data['auth_level']     =6;
                			$data['role']           ='agent';
                			$data['form_hours']     = date('h:i A',strtotime($data['form_hours']));
            			    $data['to_hours']       = date('h:i A',strtotime($data['to_hours']));
                		    $data['created_at']     = date('Y-m-d h:i:s');
                		    
                		    if(empty($data['password']))
                		    {
                		        $data['password']       =   base64_encode(mt_rand(99,99999999));
                		    }
                		    else
                		    {
                		        $data['password']       =   base64_encode($data['password']);
                		    }
                		    
                		    $img_path                   = 'assets/uploads/user_profiles';
                    	}
    	                
    	                unset($data['pname']);
    	                
                		//for member image
                		if(!empty($_FILES['addimage']['name']))
                		{       
                		       $imageFileType = strtolower(pathinfo(basename($_FILES["addimage"]["name"]),PATHINFO_EXTENSION));
                		       $imgname = date('Y-m-d').'-'.time().'.'.$imageFileType;
                		       
                			   $config['upload_path'] = ($img_path)?$img_path:'assets/uploads/category_adds';
                			   $config['allowed_types'] = 'jpg|jpeg|png|gif';
                			   $config['file_name'] = $imgname;     
                			   $this->load->library('upload',$config);
                			   $this->upload->initialize($config);
                			   if($this->upload->do_upload('addimage')){
                			   $uploadData = $this->upload->data();
                			   $data['image'] = $config['upload_path'].'/'.$uploadData['file_name'];
                			   }else{
                			   $data['image'] = '';
                			   }
                		}
                		else 
                		{
                			$data['image'] = $this->input->post('old_image');
                		}
                		
                		if(!empty($data['user_id']))
                		{
                			$this->db->where('user_id',$data['user_id']);
                			unset($data['user_id']);
                			$update=$this->db->update($table,$data);
                			$this->session->set_flashdata('success','Data Updated successfully !');
                			echo json_encode(["status"=>"success","message"=>"Data Updated successfully"]);
                		}
                		else 
                		{
                			$this->db->insert($table,$data);
                			$this->session->set_flashdata('success','Data Inserted successfully !');
                			echo json_encode(["status"=>"success","message"=>"Data Inserted successfully"]);
                		}
    	         }
    	         else
    	         {
    	             	echo json_encode(["status"=>"error", "mobile" => "mobile" ,"message"=>"Mobile Number Alredy Exiting Please Enter Another Number"]);
    	         }
    	         
    	    }
    	    else
    	    {
    	        	echo json_encode(["status"=>"error", "email" => "email","message"=>"Email Alredy Exiting Please Enter Another Email"]);
    	    }
	    
        }
		
	}
	
	//save adds
	public function save_adds($img_path='')
	{
	    
		$data = $this->input->post('data');
		
		if($data['pname']=='add_hotel')
		{
			$table = 'hotel_vila_apartment';
			$data['create_date'] = date('Y-m-d h:i:s');
		}
		
		if($data['pname']=='customer_adds')
		{
			$table = 'category_adds';
		}
		
		if($data['pname']=='service_provider_adds'){
			$table = 'service_provider_adds';
		}
		
		if($data['pname'] == 'event')
		{
		    $table = 'event';
		    $data['insert_date'] = date('Y-m-d h:i:s');
		    $img_path = 'assets/uploads/event';
		}
		
        if($data['pname']=='documents')
		{
			$table = 'documents';
			$data['insert_date'] = date('Y-m-d h:i:s');
			$img_path = 'assets/uploads/documents';
		}
        
		unset($data['pname']);
		//for member image
		if(!empty($_FILES['addimage']['name']))
		{       
		       $imageFileType = strtolower(pathinfo(basename($_FILES["addimage"]["name"]),PATHINFO_EXTENSION));
		       $imgname = date('Y-m-d').'-'.time().'.'.$imageFileType;
		       
			   $config['upload_path'] = ($img_path)?$img_path:'assets/uploads/category_adds';
			   $config['allowed_types'] = '*';
			   $config['file_name'] = $imgname;     
			   $this->load->library('upload',$config);
			   $this->upload->initialize($config);
			   if($this->upload->do_upload('addimage')){
			   $uploadData = $this->upload->data();
			   $data['image'] = $config['upload_path'].'/'.$uploadData['file_name'];
			   }else{
			   $data['image'] = '';
			   }
		}
		else 
		{
			$data['image'] = $this->input->post('old_image');
		}
		
		
		if(!empty($data['id']))
		{
			$this->db->where('id',$data['id']);
			unset($data['id']);
			$update=$this->db->update($table,$data);
			$this->session->set_flashdata('success','Data Updated successfully !');
			echo json_encode(["status"=>"success","message"=>"Data Updated successfully"]);
		}
		else 
		{
			$this->db->insert($table,$data);
			$this->session->set_flashdata('success','Data Inserted successfully !');
			echo json_encode(["status"=>"success","message"=>"Data Inserted successfully"]);
		}
		
	}
	
	
	
	//save adds
	public function save_crms()
	{
		$data = $this->input->post('data');
		$data['user_id']= $this->db->get_where('users',array('email'=>$data['client_email']))->row_array()['user_id'];
		//print_r($data);
		if($data['pname']=='add_hotel')//data[check_in]
		{
		   $table = 'hotel_vila_apartment';
			$data['create_date']    = date('Y-m-d h:i:s');
			//$data['check_in']     = date('y-m-d',strtotime($data['check_in']));
			//$data['check_out']    = date('y-m-d',strtotime($data['check_out']));
			$data['from']           = date('y-m-d',strtotime($data['from']));
			$data['to']             = date('y-m-d',strtotime($data['to']));
			
			if(@$data[user_id] =='')
			{
			    $userid = $this->db->get_where('user_info',array('client_code'=>@$data[client_code]))->row();
			    if($userid)
			    {
			       @$data[user_id] = $userid->user_id;
			    }
			}
		}
		
		if($data['pname']=='add_air_train')
		{
			$table = 'air_train';
			$data['create_date'] = date('Y-m-d h:i:s');
			$data['update_date'] = date('Y-m-d h:i:s');
			$data1 = $this->input->post('data1');      
			$add_cities="";
		    //print_r($data1['intermediate_cities']);exit;
	        foreach($data1['route'] as $value)
	        {
	       	    // echo $add_cities=$value;
	       	    $add_cities.=$value.',';
	        }
            // echo $add_cities;
            
	 		$data['route'] = rtrim($add_cities,',');
	 		
	 		if(@$data[user_id] =='')
			{
			    $userid = $this->db->get_where('user_info',array('client_code'=>@$data[client_code]))->row();
			    if($userid){
			        @$data[user_id] = $userid->user_id;
			    }
			}
		}
		
		if($data['pname']=='add_aircraft')
		{
			$table = 'air_craft';
			$data['create_date'] = date('Y-m-d h:i:s');
			$data['update_date'] = date('Y-m-d h:i:s');
			$data1 = $this->input->post('data1');      
			$add_cities="";
		    //print_r($data1['intermediate_cities']);exit;
	        foreach($data1['route'] as $value)
	        {
	       	    // echo $add_cities=$value;
	       	  $add_cities.=$value.',';
	        }
            // echo $add_cities;
	 		$data['route'] = rtrim($add_cities,',');
	 		
	 			if(@$data[user_id] =='')
    			{
    			    $userid = $this->db->get_where('user_info',array('client_code'=>@$data[client_code]))->row();
    			    if($userid){
    			        @$data[user_id] = $userid->user_id;
    			    }
    			}
	 		
		}

		if($data['pname']=='add_car_driver_security')
		{
			$table = 'driver_security';
			$data['create_date'] = date('Y-m-d h:i:s');
			$data['update_date'] = date('Y-m-d h:i:s');
			
			
			if(@$data[user_id] =='')
			{
			    $userid = $this->db->get_where('user_info',array('client_code'=>@$data[client_code]))->row();
			    if($userid){
			        @$data[user_id] = $userid->user_id;
			    }
			}
			
		}

		if($data['pname']=='add_trip')
		{
			$table ='trip'; 
			 
			//echo @$data[client_code]; 
			if(@$data[user_id] =='')
			{
			    //echo "hi am here";
			    $userid = $this->db->get_where('user_info',array('client_code'=>@$data[client_code]))->row()->user_id;
			    @$data[user_id] = $userid;
			}
			
			
			//$data['user_id'] 	 = $this->uri->segment(3);
			$data['create_date'] = date('Y-m-d h:i:s');
			$data['update_date'] = date('Y-m-d h:i:s');
			$data1 = $this->input->post('data1');  
			$add_cities="";
		    //print_r($data1['intermediate_cities']);exit;
	        foreach($data1['intermediate_cities'] as $value)
	        {
	        	//echo $add_cities=$value;
	       	    $add_cities.=$value.',';
	        }
	        
            //echo $add_cities;
		    $data['intermediate_cities'] = rtrim($add_cities,',');
		    
		    if(@$data[user_id] =='')
			{
			    $userid = $this->db->get_where('user_info',array('client_code'=>@$data[client_code]))->row();
			    if($userid){
			        @$data[user_id] = $userid->user_id;
			    }
			}
		    
		    
		}

		if($data['pname']=='add_boat')
		{
			$table = 'boat';
			$data['create_date'] = date('Y-m-d h:i:s');
			$data['update_date'] = date('Y-m-d h:i:s');
			$data1 = $this->input->post('data1');      
			$add_cities="";
		    //print_r($data1['intermediate_cities']);exit;
	       foreach($data1['route'] as $value)
	       {
	       	    //echo $add_cities=$value;
	       	    $add_cities.=$value.',';
	      }
            //echo $add_cities;
	 		$data['route'] = rtrim($add_cities,',');
	 		
	 		if(@$data[user_id] =='')
			{
			    $userid = $this->db->get_where('user_info',array('client_code'=>@$data[client_code]))->row();
			    if($userid){
			        @$data[user_id] = $userid->user_id;
			    }
			}
	 		
		}

		if($data['pname']=='add_company_fees')
		{
			$table = 'company_fees';
			$data['create_date'] = date('Y-m-d h:i:s');
			$data['update_date'] = date('Y-m-d h:i:s');
			
			if(@$data[user_id] =='')
			{
			    $userid = $this->db->get_where('user_info',array('client_code'=>@$data[client_code]))->row();
			    if($userid){
			        @$data[user_id] = $userid->user_id;
			    }
			}
			
		}

		if($data['pname']=='add_cruise')
		{
			$table = 'cruise';
			$data['create_date'] = date('Y-m-d h:i:s');
			$data['update_date'] = date('Y-m-d h:i:s');
			
			if(@$data[user_id] =='')
			{
			    $userid = $this->db->get_where('user_info',array('client_code'=>@$data[client_code]))->row();
			    if($userid){
			        @$data[user_id] = $userid->user_id;
			    }
			}
		}

		if($data['pname']=='add_cargo_package')
		{
			$table = 'cargo';
			$data['create_date'] = date('Y-m-d h:i:s');
			$data['update_date'] = date('Y-m-d h:i:s');
			
			if(@$data[user_id] =='')
			{
			    $userid = $this->db->get_where('user_info',array('client_code'=>@$data[client_code]))->row();
			    if($userid){
			        @$data[user_id] = $userid->user_id;
			    }
			}
		}


		if($data['pname']=='add_crm_event')
		{
			$table ='crm_event';
			$data['create_date'] = date('Y-m-d h:i:s');
			$data['update_date'] = date('Y-m-d h:i:s');
			
			if(@$data[user_id] =='')
			{
			    $userid = $this->db->get_where('user_info',array('client_code'=>@$data[client_code]))->row();
			    if($userid){
			        @$data[user_id] = $userid->user_id;
			    }
			}
			
		}

		if($data['pname']=='add_miscellaneous')
		{
			$table ='miscellaneous';
			$data['create_date'] = date('Y-m-d h:i:s');
			$data['update_date'] = date('Y-m-d h:i:s');
			if(@$data[user_id] =='')
			{
			    $userid = $this->db->get_where('user_info',array('client_code'=>@$data[client_code]))->row();
			    if($userid){
			        @$data[user_id] = $userid->user_id;
			    }
			}
			
		}
		
		if($data['pname']=='wallet')
		{
			$table = 'add_wallet_amount';
			$data['insert_date'] = date('Y-m-d h:i:s');
		}
		
		if($data['pname']=='request_call')
		{
			$table = 'request_call';
		}
		if($data['pname']=='class_type')
		{
			$table = 'class_type';
			$data['insert_date'] = date('Y-m-d h:i:s');
		}
		if($data['pname']=='airlines')
		{
			$table = 'airline_choice';
			$data['insert_date'] = date('Y-m-d h:i:s');
		}
		if($data['pname']=='hotel_chain')
		{
			$table = 'hotel_chain';
			$data['insert_date'] = date('Y-m-d h:i:s');
		}
		if($data['pname']=='car_choice')
		{
			$table = 'car_choice';
			$data['insert_date'] = date('Y-m-d h:i:s');
		}
		if($data['pname']=='city')
		{
			$table = 'city';
			$data['insert_date'] = date('Y-m-d h:i:s');
		}
		
		
		unset($data['pname']);
		//print_r($data); exit;
		
		if(!empty($data['id']))
		{
			$this->db->where('id',$data['id']);
			unset($data['id']);
			$update=$this->db->update($table,$data);
			$this->session->set_flashdata('success','Data Updated successfully !');
			echo json_encode(["status"=>"success","message"=>"Data Updated successfully"]);
		}
		else 
		{
			$this->db->insert($table,$data);
			$this->session->set_flashdata('success','Data Inserted successfully !');
			echo json_encode(["status"=>"success","message"=>"Data Inserted successfully"]);
		}
		
	}
	
	//Get User
	public function user()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="user";
				$data['page_name']      ="User Management";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']           = $this->common_m->get_user_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/user');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//profile 
	public function user_info($id='')
	{
		if($this->session->userdata('auth_level')) 
		{ 
		    $data['current_page']   ="user_info";
			$data['page_name']      ="User Management";
			$data['user_info']      = $this->common_m->get_user_details();
			$data['adds']           = $this->common_m->get_user_details($id);
			
			$data['agent_invoice']  = $this->common_m->get_agent_invoice_data($id,$invoice='invoice');
			$data['agent_order']    = $this->common_m->get_agent_order_data($id,$invoice='order');
			
			$data['invoice']        = $this->common_m->get_user_invoice_data($id,$invoice='invoice');
			$data['order']          = $this->common_m->get_user_order_data($id,$invoice='order');
			$data['sender_id']      = $id;
			
			$this->load->view('admin/includes/header',$data);
			$this->load->view('admin/includes/footer');
			$this->load->view('admin/user_info');	

		}
		else{
			redirect(base_url().'home/index');
		}
	}
	
	//Get Event Management
	public function event()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="event";
				$data['page_name']      ="Event Management";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['value']         = $this->common_m->get_event_adds();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/event');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	
	//Get Wallet Management
	public function wallet()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="wallet";
				$data['page_name']      ="Wallet Management";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']         = $this->common_m->get_wallet_adds();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/wallet');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Get Order Management
	public function order()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="order";
				$data['page_name']      ="Order Management";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']           = $this->common_m->get_invoice_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/order');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Get Agent Management
	public function agent()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="agent";
				$data['page_name']      ="Agent Management";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']         = $this->common_m->get_agent_adds();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/agent');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	
	//Request Call
	public function request_call()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="request_call";
				$data['page_name']      ="Request Call ";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']           = $this->common_m->get_request_call();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/request_call');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Terms And Condition 
	public function term_condition()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
			    if($_POST)
			    {
			        $data = $this->input->post('data');
			        $this->db->update('term_condition',$data);
			        $this->session->set_flashdata('success','Data Updated successfully !');
			        redirect(base_url().'admin/term_condition');
			    }
			    
				$data['current_page']       ="term_condition";
				$data['page_name']          ="Term & Condition";
				$data['user_info']          = $this->common_m->get_user_details();
				$data['term_condition']     = $this->common_m->get_term_condition();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/term_condition');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//About Us
	public function aboutus()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
			    if($_POST)
			    {
			        $data = $this->input->post('data');
			        $this->db->update('about_us',$data);
			        $this->session->set_flashdata('success','Data Updated successfully !');
			        redirect(base_url().'admin/aboutus');
			    }
			    
				$data['current_page']       ="aboutus";
				$data['page_name']          ="About Us";
				$data['user_info']          = $this->common_m->get_user_details();
				$data['about_us']     = $this->common_m->get_about_us();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/aboutus');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Contact Us
	public function contactus()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
			    if($_POST)
			    {
			        $data = $this->input->post('data');
			        $this->db->update('about_us',$data);
			        $this->session->set_flashdata('success','Data Updated successfully !');
			        redirect(base_url().'admin/contactus');
			    }
			    
				$data['current_page']       ="contactus";
				$data['page_name']          ="Contact Us";
				$data['user_info']          = $this->common_m->get_user_details();
				$data['adds']     = $this->common_m->get_contact_us();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/contactus');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Privacy Policy
	public function privacy_policys()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
			    if($_POST)
			    {
			        $data = $this->input->post('data');
			        $this->db->update('privacy_policy',$data);
			        $this->session->set_flashdata('success','Data Updated successfully !');
			        redirect(base_url().'admin/privacy_policys');
			    }
			    
				$data['current_page']       ="privacy_policys";
				$data['page_name']          ="Privacy Policys";
				$data['user_info']          = $this->common_m->get_user_details();
				$data['adds']               = $this->common_m->get_privacy_policy_us();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/privacy_policys');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	public function term_conditions($value='')
	{
	    $this->load->view('admin/term_conditions');
	}
	
	public function about_us($value='')
	{
	    $this->load->view('admin/about_us');
	}
	
	public function privacy_policy($value='')
	{
	    $this->load->view('admin/privacy_policy');
	}
	
	/////////*****************Hotel********************////////////////////
	/////////////////DashBoard Index Start Hear ///////////////////////////
	public function dashboard_index()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="dashboard_index";
				$data['page_name']      ="Dashboard Management";
				$data['user_info']      = $this->common_m->get_user_details();
				//$data['adds']         = $this->common_m->get_user_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/dashboard_index');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}

	public function client()
	 {
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="client";
				$data['page_name']      ="client Management";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['client']         = $this->crms_m->get_user_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/client');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}

	public function add_client($value = '')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_client";
				$data['page_name']      ="Add Client";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['client']         = ($value != "") ? $this->crms_m->get_client_data($value): array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_client');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}


	public function trip($id='')
	 {
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="trip";
				$data['page_name']      ="Trip";
				$data['user_info']      = $this->common_m->get_user_details();
				//$data['adds']         = $this->common_m->get_hotel_data();
				$data['trip']         = $this->crms_m->get_trip_user_data($id);
				//print_r($data['trip']); exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/trip');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Add Trip
	public function add_trip($value = '',$id='')
	 {
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_trip";
				$data['page_name']      ="Add Trip";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['cities']      = $this->crms_m->get_cities_details();
				$data['trip']          = ($value != "") ? $this->crms_m->get_trip_data($value,$id): array();
				//print_r($data['cities']); exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_trip',$data);
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}

    //Cleint Trip View
    public function client_trip($id='')
	 {
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="client_trip";
				$data['page_name']      ="Client Trip";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']         = $this->common_m->get_hotel_data();
				$data['trip']         = $this->crms_m->get_trip_user_data($id);
				//print_r($data['trip']); exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/client_trip');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}

	//View Hotel Management
	public function hotel()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="hotel";
				$data['page_name']      ="hotel Management";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']         = $this->common_m->get_hotel_data();
				//print_r($data); exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/hotel',$data);
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	

	//Add Hotel
	public function add_hotel($value = '')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_hotel";
				$data['page_name']      ="Add Hotel";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']           = ($value != "") ? $this->crms_m->get_hotel_data($value): array();
				//print_r($data['adds']);exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_hotel');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//View  Air/Train
	public function air_train()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="air_train";
				$data['page_name']      ="Air Train Ticket";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['train']         = $this->crms_m->get_air_train_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/air_train');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Add  Air/Train
	public function add_air_train($value='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_air_train";
				$data['page_name']      ="Add Air Train";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['category']       = $this->crms_m->get_category_names();
				$data['train']          = ($value != "") ? $this->crms_m->get_air_train_data($value): array();
				$data['class_type'] = $this->crms_m->get_class_type();
				$data['suplier']  = $this->crms_m->get_suplier_data();
				
				//print_r($data['train']);exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_air_train');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	
	//View  Aircraft
	public function aircraft()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="aircraft";
				$data['page_name']      ="Aircraft";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['craft']         = $this->crms_m->get_air_craft_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/aircraft');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Add  Aircraft
	public function add_aircraft($value='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_aircraft";
				$data['page_name']      ="Add Aircraft";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['craft']          = ($value != "") ? $this->crms_m->get_air_craft_data($value): array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_aircraft');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//View  Car Driver Security
	public function car_driver_security()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="car_driver_security";
				$data['page_name']      ="Car-Driver-Security";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['driver']          = $this->crms_m->get_driver_security_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/car_driver_security');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//View  Car Driver Security
	public function add_car_driver_security($value='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_car_driver_security";
				$data['page_name']      ="Add Car Driver Security";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['driver']          = ($value != "") ? $this->crms_m->get_driver_security_data($value): array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_car_driver_security');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//View  Boat
	public function boat()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="boat";
				$data['page_name']      ="Boat";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['boat']         = $this->crms_m->get_boat_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/boat');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Add  Boat
	public function add_boat($value='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_boat";
				$data['page_name']      ="Add Boat";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['boat']          = ($value != "") ? $this->crms_m->get_boat_data($value): array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_boat');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//View Company Fees cruise
	public function company_fees()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="company_fees";
				$data['page_name']      ="Company Fees";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['company']         = $this->crms_m->get_company_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/company_fees');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Add Company Fees cruise
	public function add_company_fees($value='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_company_fees";
				$data['page_name']      ="Add Company Fees";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['company']          = ($value != "") ? $this->crms_m->get_company_data($value): array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_company_fees');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//View Cruise
	public function cruise()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="cruise";
				$data['page_name']      ="Cruise";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['cruise']         = $this->crms_m->get_cruise_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/cruise');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Add Cruise
	public function add_cruise($value='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_cruise";
				$data['page_name']      ="Add_Cruise";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['cruise']          = ($value != "") ? $this->crms_m->get_cruise_data($value): array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_cruise');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	
	//View Cargo Package
	public function cargo_package()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="cargo_package";
				$data['page_name']      ="Cargo Package";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['cargo']         = $this->crms_m->get_cargo_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/cargo_package');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Add Cargo Package
	public function add_cargo_package($value='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_cargo_package";
				$data['page_name']      ="Add Cargo Package";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['cargo']          = ($value != "") ? $this->crms_m->get_cargo_data($value): array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_cargo_package');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//View Events
	public function crm_event()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="events";
				$data['page_name']      ="Events";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['crm_event']         = $this->crms_m->get_crm_event_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/events');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Add Events
	public function add_crm_event($value='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_events";
				$data['page_name']      ="Add Events";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['crm_event']          = ($value != "") ? $this->crms_m->get_crm_event_data($value): array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_events');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//View Miscellaneous
	public function miscellaneous()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="miscellaneous";
				$data['page_name']      ="Miscellaneous";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['miscellaneous']         = $this->crms_m->get_miscellaneous_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/miscellaneous');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	} 
	
	//Add Miscellaneous
	public function add_miscellaneous($value='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_miscellaneous";
				$data['page_name']      ="Add Miscellaneous";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['miscellaneous']          = ($value != "") ? $this->crms_m->get_miscellaneous_data($value): array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_miscellaneous');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Delete Option
	public function delete_data($table)
	{
	    $id = $this->input->post('id');
	    if($table == 'users')
	    {
		    $this->db->where('user_id',$id)->delete($table);
		    $this->session->set_flashdata('success','Data Deleted successfully !');
		    echo json_encode(["status"=>"success","message"=>"Date Deleted successfully"]);
	    }
	    else
	    {
	        $this->db->where('id',$id)->delete($table);
	        $this->session->set_flashdata('success','Data Deleted successfully !');
	        echo json_encode(["status"=>"success","message"=>"Date Deleted successfully"]);
	    }
		
		
	}
	
	//////////////////////////AGENT START////////////////////////////////////
	//Add Agent Information 
	public function chat()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='agent')
			{
				$data['current_page']   ="chat";
				$data['page_name']      ="Chat";
				$data['user_info']      = $this->common_m->get_user_details();
				//$data['adds']         = $this->common_m->get_user_data();
				$data['sender_id']      = $this->session->userdata('user_id');
				$rec = $this->db->from('chats')->where('receiver_id',$data['sender_id'])->order_by("id", "desc")->get()->row();
				$data['receiver_id']    = ($rec)?$rec->sender_id:'';
				$data['transaction_number']    = ($rec)?$rec->transaction_number:'';
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/chat');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Get Category Id using chat
	public function category_id()
	{
	    $receiver_id = $this->input->post('receiver_id');
	    //$this->db->select('category_id')->where('client_id',$receiver_id);
	    $query = $this->db->query("SELECT * FROM `chats` where sender_id = $receiver_id ORDER BY id desc limit 1");
	    echo $query->row()->category_id;
	}
	
	//Media
	public function media($id='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='agent' || $this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="media";
				$data['page_name']      ="Media";
				$data['user_info']      = $this->common_m->get_user_details();
				//$data['sender_id']    = $this->session->userdata('user_id');
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/media');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}
		else
		{
			redirect(base_url().'home/index');
		}
	}
	
	// Get chat_history
	public function chat_history()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='agent')
			{
				$data['current_page']   ="chat";
				$data['page_name']      ="Chat";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['sender_id']      = $this->session->userdata('user_id');
				$rec = $this->db->from('chats')->where('receiver_id',$data['sender_id'])->order_by("id", "desc")->get()->row();
				$data['receiver_id']    = ($rec)?$rec->sender_id:'';
				$data['transaction_number']    = ($rec)?$rec->transaction_number:'';
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/chat_history');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}
		else
		{
			redirect(base_url().'home/index');
		}
	}
    
    //get User Message Details
    public function list_chat_message()
	{
	    //echo "hello";   
	  
	    //$this->$data['receiver_id']
	    
	    $sender_id = $this->input->post('sid');//
		$reciver_id = $this->input->post('rid'); 
		
	    $s = $this->db->where('user_id',$sender_id)->get('users')->row();
		$sender_name = ($s)?$s->user_name:'';
		$s = $this->db->where('user_id',$sender_id)->get('users')->row();
		$sender_image = ($s)?$s->image:'';
		$s1 = $this->db->where('user_id',$sender_id)->get('users')->row();
		$sender_type =  ($s1)?$s1->auth_level:'';
		
		$s2 = $this->db->where('user_id',$reciver_id)->get('users')->row();
		$reciver_image = ($s2)?$s2->image:'';
		$s3 = $this->db->where('user_id',$reciver_id)->get('users')->row();
		$reciver_name = ($s3)?$s3->user_name:'';
		
		$s4 = $this->db->from('chats')->where('receiver_id',$sender_id)->order_by("id", "desc")->get()->row();
		$transaction_number = ($s4)?$s4->transaction_number:'';
		
		$data = "SELECT * FROM `chats` where sender_id IN(".$sender_id.",".$reciver_id.") and receiver_id IN(".$sender_id.",".$reciver_id.") and message != 0123456789 ORDER BY `id` ASC";
		$messages = $this->db->query($data)->result_array();
		if($messages)
		{
	//	print_r($messages);exit;
		foreach($messages as $row)
		{
		    ////////////////////////////////
		    $fsender_id = $row['sender_id'];
			$freciver_id = $row['receiver_id'];
			$message = $row['message'];
			$message_type = $row['message_type'];
			$date = $row['insert_date'];
			$cur_date = date('Y-m-d H:i:s');

			//date calculate coding
			$start  = date_create($date);
			$end  = date_create($cur_date);
			$diff = date_diff($start,$end);
			$diff->y . ' years, ';
			$diff->m . ' months, ';
			$diff->d . ' days, ';
			$diff->h .' hours ';
			$diff->i . ' mins, ';
			$diff->s . ' seconds';

  if($diff->d == 0)
  {
   if($diff->h == 0)
   {
    $dt=  $diff->i . ' mins ago';
   }
   else
   {
	$dt= $diff->h .' hours '. $diff->i . ' mins ago';
   }
  }
  elseif($diff->m == 0)
  {
   $dt= $diff->d . ' days ago';
  }
  else
  {
   $dt= $diff->m . ' month  Ago';
  }
    
   //////////Date Show////////// 
        $dt = $date;
   //////////
   
if($fsender_id == $sender_id)
{   
      
       echo '<li class="right clearfix"><span class="chat-img pull-right">
                              <img src="'.base_url().'/'.$sender_image.'" alt="User Avatar" class="img-circle" />
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="pull-right primary-font">'.$sender_name.'</strong>
   <small class="text-muted"><span class="fa fa-clock-o"></span>'.$dt.'</small>
                                     
                                  </div>
                                  <p style="text-align:right">';
                                  ?>
                                  <?php
                                  if($message_type == 1)
                                  {
                                    ?>
                                    <?php 
										echo $message;
                                  }
                                  else if($message_type == 2)
                                  {
                                      ?>
                                        <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="image" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 3)
                                  {
                                      ?>
                                      <!--<audio controls>
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/ogg">
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                            </audio>-->
                                              <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/audio.jpg" alt="audio" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 4)
                                  {
                                      ?>
                                      <!--<video width="300" height="200" controls>
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/mp4">
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/ogg">
                                        Your browser does not support the video tag.
                                        </video>-->
                                        
                                         <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/video.jpg" alt="video" style="width:100px;height:20px;"></a>
                                         
                                      <?php
                                  }
                                  else if($message_type == 5)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="camera" style="width:100;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 6)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/file.png" alt="file" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  ?>
                                  </p>
                              </div>
                          <?php echo '</li>';    
       
       
       }
       else
       {
					echo ' <li class="left clearfix"><span class="chat-img pull-left">
                              <img src="'.base_url().'/'.$reciver_image.'" alt="User Avatar" class="img-circle" />
                             <i class="fa fa-circle on-active" aria-hidden="true"></i>
  
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="primary-font">'.$reciver_name.'</strong> <small class="pull-right text-muted">
                                          <span class=" fa fa-clock-o"></span>'.$dt.'</small>
                                  </div>
                                  <p>';
                                  ?>
                                  <?php
                                  if($message_type == 1)
                                  {
                                    ?>
                                    <?php 
										echo $message;
                                  }
                                  else if($message_type == 2)
                                  {
                                      ?>
                                        <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="image" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 3)
                                  {
                                      ?>
                                      <!--<audio controls>
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/ogg">
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                            </audio>-->
                                              <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/audio.jpg" alt="audio" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 4)
                                  {
                                      ?>
                                      <!--<video width="300" height="200" controls>
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/mp4">
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/ogg">
                                        Your browser does not support the video tag.
                                        </video>-->
                                        
                                         <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/video.jpg" alt="video" style="width:100px;height:20px;"></a>
                                         
                                      <?php
                                  }
                                  else if($message_type == 5)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="camera" style="width:100;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 6)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/file.png" alt="file" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  ?>
                                  </p>
                              </div>
                          <?php echo '</li>';       
       }
       
		}
		    ////////////////////////////////
		}
		else
		{
		    /*echo ' <li class="left clearfix"><span class="chat-img pull-left">
                              <img src="'.base_url().'/'.$reciver_image.'" alt="User Avatar" class="img-circle" />
                             <i class="fa fa-circle on-active" aria-hidden="true"></i>
  
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="primary-font">'.$reciver_name.'</strong> <small class="pull-right text-muted">
                                          <span class=" fa fa-clock-o"></span></small>
                                  </div>
                                  <p>No Message Found</p></div></li>';*/
                             
		}
	    
	}  
    
    
	//Add Chat message()
	//Get chat Message Details
	public function chat_message()
	{
	    $data = $this->input->post('data');
	    
	    if($this->input->post("data[message]"))
	    {
	        $data['message']            = $this->input->post("data[message]");
	        $data['message_type'] = 1;
	    }
	    else if($_FILES['chatFile']['name'])
	    {
	         echo $imageFileType = strtolower(pathinfo($_FILES['chatFile']['name'],PATHINFO_EXTENSION));
	         //$imageFileType
	         if($imageFileType == 'png' || $imageFileType == 'jpg' || $imageFileType == 'jpeg' || $imageFileType == 'gif')
	         {
	             $data['message_type'] = 2;
	             $imgname = date('Y-m-d').'-'.time().'.'.$imageFileType;
	         }
	         else if($imageFileType == 'mp3' || $imageFileType == 'wav' || $imageFileType =='m3u' || $imageFileType == 'm4a' || $imageFileType =='mpa')
	         {
	             $data['message_type'] = 3;
	             $imgname = date('Y-m-d').'-'.time().'.mp3';
	         }
	         else if($imageFileType == 'avi' || $imageFileType =='flv' || $imageFileType == 'wmv' || $imageFileType == 'mov' || $imageFileType =='mp4' || $imageFileType == '3gp')
	         {
	             $data['message_type'] = 4;
	             $imgname = date('Y-m-d').'-'.time().'.mp4';
	         }
	         else if($imageFileType == 'doc' || $imageFileType == 'docx' || $imageFileType == 'pdf' || $imageFileType == 'txt' || $imageFileType =='xlsx')
	         {
	              $data['message_type'] = 6;
	              $imgname = date('Y-m-d').'-'.time().'.'.$imageFileType;
	         }
	         
	         if($data['message_type'] != '')
	         {
                $config['upload_path']      = 'assets/uploads/chat';
                $config['allowed_types']    = '*';
                $config['file_name']        = $imgname;
                          
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                     
                if($this->upload->do_upload('chatFile'))
                {
                    $uploadData = $this->upload->data();
                    $data['message'] = $config['upload_path'].'/'.$uploadData['file_name'];
                }
	         }
	         
	    }
	   
	    //$data['transaction_number']   = $this->input->post('transaction_number');
	    $data['insert_date']            = date('Y-m-d h:i:s');
	    $res = $this->db->insert('chats',$data);
	    if($res)
	    {
	        $this->db->where('user_id',$data['sender_id']);
	        $this->db->update('users',array('free_busy'=>2));
	        
	        $this->db->where(array('sender_id'=>$data['sender_id'],'receiver_id'=>$data['receiver_id']));
		    $this->db->update('chats',array('notification_count'=>0));
	        
            //$data['message'] = 'hello world check';
            $recRecord = $this->db->where('user_id',$data['receiver_id'])->get('users')->row();//Android
            $data['image'] = base_url().''. $recRecord->image;
            $data['title']      = 'joher';
            if($recRecord->device_type =='Android')
            {
                send_notification_android($recRecord->device_token, $data);
            }
            else
            {
                send_notification_ios($recRecord->device_token, $data);
            }
		        
	    }
		        
	    //die;
	    //$this->$data['receiver_id']
	    
	    $sender_id  = $data['sender_id'];
		$reciver_id = $data['receiver_id']; 
		
	    $s = $this->db->where('user_id',$sender_id)->get('users')->row();
		$sender_name = ($s)?$s->user_name:'';
		$s = $this->db->where('user_id',$sender_id)->get('users')->row();
		$sender_image = ($s)?$s->image:'';
		$s1 = $this->db->where('user_id',$sender_id)->get('users')->row();
		$sender_type =  ($s1)?$s1->auth_level:'';
		
		$s2 = $this->db->where('user_id',$reciver_id)->get('users')->row();
		$reciver_image = ($s2)?$s2->image:'';
		$s3 = $this->db->where('user_id',$reciver_id)->get('users')->row();
		$reciver_name = ($s3)?$s3->user_name:'';
		
		$s4 = $this->db->from('chats')->where('receiver_id',$sender_id)->order_by("id", "desc")->get()->row();
		$transaction_number = ($s4)?$s4->transaction_number:'';
		
		$data = "SELECT * FROM `chats` where sender_id IN(".$sender_id.",".$reciver_id.") and receiver_id IN(".$sender_id.",".$reciver_id.")  and chat_start_end = 1 and status = 1  and message != 0123456789 ORDER BY `id` ASC";
		
		$messages = $this->db->query($data)->result_array();
		if($messages)
		{
	//	print_r($messages);exit;
		foreach($messages as $row)
		{
		    ////////////////////////////////
		    $fsender_id = $row['sender_id'];
			$freciver_id = $row['receiver_id'];
			$message = $row['message'];
			$message_type = $row['message_type'];
			$date = $row['insert_date'];
			$cur_date = date('Y-m-d H:i:s');

			//date calculate coding
			$start  = date_create($date);
			$end  = date_create($cur_date);
			$diff = date_diff($start,$end);
			$diff->y . ' years, ';
			$diff->m . ' months, ';
			$diff->d . ' days, ';
			$diff->h .' hours ';
			$diff->i . ' mins, ';
			$diff->s . ' seconds';

  if($diff->d == 0)
  {
   if($diff->h == 0)
   {
    $dt=  $diff->i . ' mins ago';
   }
   else
   {
	$dt= $diff->h .' hours '. $diff->i . ' mins ago';
   }
  }
  elseif($diff->m == 0)
  {
   $dt= $diff->d . ' days ago';
  }
  else
  {
   $dt= $diff->m . ' month  Ago';
  }

    //////////Date Show////////// 
        $dt = $date;
   //////////

if($fsender_id == $sender_id)
{   
      
       echo '<li class="right clearfix"><span class="chat-img pull-right">
                              <img src="'.base_url().'/'.$sender_image.'" alt="User Avatar" class="img-circle" />
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="pull-right primary-font">'.$sender_name.'</strong>
   <small class="text-muted"><span class="fa fa-clock-o"></span>'.$dt.'</small>
                                     
                                  </div>
                                  <p style="text-align:right">';
                                  ?>
                                  <?php
                                  if($message_type == 1)
                                  {
                                    ?>
                                    <?php 
										echo $message;
                                  }
                                  else if($message_type == 2)
                                  {
                                      ?>
                                        <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="image" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 3)
                                  {
                                      ?>
                                      <!--<audio controls>
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/ogg">
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                            </audio>-->
                                              <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/audio.jpg" alt="audio" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 4)
                                  {
                                      ?>
                                      <!--<video width="300" height="200" controls>
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/mp4">
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/ogg">
                                        Your browser does not support the video tag.
                                        </video>-->
                                        
                                         <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/video.jpg" alt="video" style="width:100px;height:20px;"></a>
                                         
                                      <?php
                                  }
                                  else if($message_type == 5)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="camera" style="width:100;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 6)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/file.png" alt="file" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  ?>
                                  </p>
                              </div>
                          <?php echo '</li>';    
       
       
       }
       else
       {
					echo ' <li class="left clearfix"><span class="chat-img pull-left">
                              <img src="'.base_url().'/'.$reciver_image.'" alt="User Avatar" class="img-circle" />
                             <i class="fa fa-circle on-active" aria-hidden="true"></i>
  
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="primary-font">'.$reciver_name.'</strong> <small class="pull-right text-muted">
                                          <span class=" fa fa-clock-o"></span>'.$dt.'</small>
                                  </div>
                                  <p>';
                                  ?>
                                   <?php
                                  if($message_type == 1)
                                  {
                                    ?>
                                    <?php 
										echo $message;
                                  }
                                  else if($message_type == 2)
                                  {
                                      ?>
                                        <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="image" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 3)
                                  {
                                      ?>
                                      <!--<audio controls>
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/ogg">
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                            </audio>-->
                                              <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/audio.jpg" alt="audio" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 4)
                                  {
                                      ?>
                                      <!--<video width="300" height="200" controls>
                                          <source src="<?php //echo base_url();?>/chat_files/'.$message.'" type="video/mp4">
                                          <source src="<?php //echo base_url();?>/chat_files/'.$message.'" type="video/ogg">
                                        Your browser does not support the video tag.
                                        </video>-->
                                        
                                         <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/video.jpg" alt="video" style="width:100px;height:20px;"></a>
                                         
                                      <?php
                                  }
                                  else if($message_type == 5)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="camera" style="width:100;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 6)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/file.png" alt="file" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  ?>
                                  </p>
                              </div>
                          <?php echo '</li>';       
       }
       
		}
		    ////////////////////////////////
		}
		else
		{
		    /*echo ' <li class="left clearfix"><span class="chat-img pull-left">
                              <img src="'.base_url().'/'.$reciver_image.'" alt="User Avatar" class="img-circle" />
                             <i class="fa fa-circle on-active" aria-hidden="true"></i>
  
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="primary-font">'.$reciver_name.'</strong> <small class="pull-right text-muted">
                                          <span class=" fa fa-clock-o"></span></small>
                                  </div>
                                  <p>No Message Found</p></div></li>';*/
                             
		}
	    
	}    
	
    //GET Chat List
	public function client_list()
	{
	        $query = "SELECT * FROM `chat_count` where agent_id = ".$this->session->userdata('user_id')." ";
            $list = $this->db->query($query)->result_array();
            ?>
                <ul class="sidebar-menu " style="overflow: inherit;" >
                        <?php  if($list){ $count=1; foreach($list as $row){
                        
                        $data = "SELECT count(*) as notification_c FROM `chats` where sender_id IN(".$row['client_id'].",".$this->session->userdata('user_id').") and receiver_id IN(".$row['client_id'].",".$this->session->userdata('user_id').")  and notification_count = 1 GROUP BY sender_id";
	                    $messages = $this->db->query($data)->row();
	                    $noti =0;
                        ?>
                            <li class="">
                                <a class="" onclick="myFunctionone('<?=$row['client_id']?>','<?=$this->session->userdata('user_id') ?>','<?=$row['category_id']?>')" >
                                    <img src="<?php echo base_url().$this->db->where('user_id',$row['client_id'])->get('users')->row()->image;?>" alt="User Avatar" class="img-circle" style = "width: 30px;height: 30px">
                                    <span> <?php echo $this->db->where('user_id',$row['client_id'])->get('users')->row()->user_name;?></span>
                                    <?php if($messages){ ?>
                            			<span class="dot">
                            					<?= $messages->notification_c;?>
                            			</span> 
                            		<?php } ?>
                                </a>
                            </li>
                            
                        <?php  $count++; }  } ?>
                    </ul> 
            <?php
	}
	
	//Get chat Message Details
	public function agent_chat_view1()
	{
	    //echo "hello";   
	    //echo $this->input->post('message');
	    
	    $sender_id = $this->input->post('sid');//
		$reciver_id = $this->input->post('rid'); 
		
		$this->db->where(array('sender_id'=>$reciver_id,'receiver_id'=>$sender_id));
		$this->db->update('chats',array('notification_count'=>0));
		//echo $this->db->last_query();
		
	    $s = $this->db->where('user_id',$sender_id)->get('users')->row();
		$sender_name = ($s)?$s->user_name:'';
		$s = $this->db->where('user_id',$sender_id)->get('users')->row();
		$sender_image = ($s)?$s->image:'';
		$s1 = $this->db->where('user_id',$sender_id)->get('users')->row();
		$sender_type =  ($s1)?$s1->auth_level:'';
		
		$s2 = $this->db->where('user_id',$reciver_id)->get('users')->row();
		$reciver_image = ($s2)?$s2->image:'';
		$s3 = $this->db->where('user_id',$reciver_id)->get('users')->row();
		$reciver_name = ($s3)?$s3->user_name:'';
		
		$s4 = $this->db->from('chats')->where('receiver_id',$sender_id)->order_by("id", "desc")->get()->row();
		$chat_start_end = ($s4)?$s4->chat_start_end:'';
		
		$data = "SELECT * FROM `chats` where sender_id IN(".$sender_id.",".$reciver_id.") and receiver_id IN(".$sender_id.",".$reciver_id.")  and chat_start_end = 1 and status = 1  and message != 0123456789 ORDER BY `id` ASC";
		
		$messages = $this->db->query($data)->result_array();
		if($messages)
		{
	    //print_r($messages);exit;
		foreach($messages as $row)
		{
		    ////////////////////////////////
		    $fsender_id = $row['sender_id'];
			$freciver_id = $row['receiver_id'];
			$message = $row['message'];
			$message_type = $row['message_type'];
			$date = $row['insert_date'];
			$cur_date = date('Y-m-d H:i:s');

			//date calculate coding
			$start  = date_create($date);
			$end  = date_create($cur_date);
			$diff = date_diff($start,$end);
			$diff->y . ' years, ';
			$diff->m . ' months, ';
			$diff->d . ' days, ';
			$diff->h .' hours ';
			$diff->i . ' mins, ';
			$diff->s . ' seconds';

  if($diff->d == 0)
  {
   if($diff->h == 0)
   {
    $dt=  $diff->i . ' mins ago';
   }
   else
   {
	$dt= $diff->h .' hours '. $diff->i . ' mins ago';
   }
  }
  elseif($diff->m == 0)
  {
   $dt= $diff->d . ' days ago';
  }
  else
  {
   $dt= $diff->m . ' month  Ago';
  }

    //////////Date Show////////// 
        $dt = $date;
   //////////

if($fsender_id == $sender_id)
{   
      
       echo '<li class="right clearfix"><span class="chat-img pull-right">
                              <img src="'.base_url().'/'.$sender_image.'" alt="User Avatar" class="img-circle" />
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="pull-right primary-font">'.$sender_name.'</strong>
   <small class="text-muted"><span class="fa fa-clock-o"></span>'.$dt.'</small>
                                     
                                  </div>
                                  <p style="text-align:right">';
                                  ?>
                                    <?php
                                  if($message_type == 1)
                                  {
                                    ?>
                                    <?php 
										echo $message;
                                  }
                                  else if($message_type == 2)
                                  {
                                      ?>
                                        <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="image" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 3)
                                  {
                                      ?>
                                      <!--<audio controls>
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/ogg">
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                            </audio>-->
                                              <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/audio.jpg" alt="audio" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 4)
                                  {
                                      ?>
                                      <!--<video width="300" height="200" controls>
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/mp4">
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/ogg">
                                        Your browser does not support the video tag.
                                        </video>-->
                                        
                                         <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/video.jpg" alt="video" style="width:100px;height:20px;"></a>
                                         
                                      <?php
                                  }
                                  else if($message_type == 5)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="camera" style="width:100;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 6)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/file.png" alt="file" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  ?>
                                  </p>
                              </div>
                          <?php echo '</li>';    
       
       
       }
       else
       {
					echo ' <li class="left clearfix"><span class="chat-img pull-left">
                              <img src="'.base_url().'/'.$reciver_image.'" alt="User Avatar" class="img-circle" />
                             <i class="fa fa-circle on-active" aria-hidden="true"></i>
  
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="primary-font">'.$reciver_name.'</strong> <small class="pull-right text-muted">
                                          <span class=" fa fa-clock-o"></span>'.$dt.'</small>
                                  </div>
                                  <p>';
                                  ?>
                                  <?php
                                  if($message_type == 1)
                                  {
                                    ?>
                                    <?php 
										echo $message;
                                  }
                                  else if($message_type == 2)
                                  {
                                      ?>
                                        <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="image" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 3)
                                  {
                                      ?>
                                      <!--<audio controls>
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/ogg">
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                            </audio>-->
                                              <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/audio.jpg" alt="audio" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 4)
                                  {
                                      ?>
                                      <!--<video width="300" height="200" controls>
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/mp4">
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/ogg">
                                        Your browser does not support the video tag.
                                        </video>-->
                                        
                                         <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/video.jpg" alt="video" style="width:100px;height:20px;"></a>
                                         
                                      <?php
                                  }
                                  else if($message_type == 5)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="camera" style="width:100;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 6)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/file.png" alt="file" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  ?>
                                  </p>
                              </div>
                          <?php echo '</li>';       
       }
       
		}
		    ////////////////////////////////
		}
		else
		{
		    /*echo ' <li class="left clearfix"><span class="chat-img pull-left">
                              <img src="'.base_url().'/'.$reciver_image.'" alt="User Avatar" class="img-circle" />
                             <i class="fa fa-circle on-active" aria-hidden="true"></i>
  
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="primary-font">'.$reciver_name.'</strong> <small class="pull-right text-muted">
                                          <span class=" fa fa-clock-o"></span></small>
                                  </div>
                                  <p>Order Request Please Start The Conversession</p></div></li>';*/
                             
		}
		
	}
	
	//Get chat Message Details
	public function agent_chat_view()
	{
	    //echo "hello";   
	    //echo $this->input->post('message');
	    
	    $sender_id = $this->input->post('sid');//
		$reciver_id = $this->input->post('rid'); 
		
		/*$this->db->where(array('sender_id'=>$reciver_id,'receiver_id'=>$sender_id));
		$this->db->update('chats',array('notification_count'=>0));*/
		//echo $this->db->last_query();
		
	    $s = $this->db->where('user_id',$sender_id)->get('users')->row();
		$sender_name = ($s)?$s->user_name:'';
		$s = $this->db->where('user_id',$sender_id)->get('users')->row();
		$sender_image = ($s)?$s->image:'';
		$s1 = $this->db->where('user_id',$sender_id)->get('users')->row();
		$sender_type =  ($s1)?$s1->auth_level:'';
		
		$s2 = $this->db->where('user_id',$reciver_id)->get('users')->row();
		$reciver_image = ($s2)?$s2->image:'';
		$s3 = $this->db->where('user_id',$reciver_id)->get('users')->row();
		$reciver_name = ($s3)?$s3->user_name:'';
		
		$s4 = $this->db->from('chats')->where('receiver_id',$sender_id)->order_by("id", "desc")->get()->row();
		$chat_start_end = ($s4)?$s4->chat_start_end:'';
		
		$data = "SELECT * FROM `chats` where sender_id IN(".$sender_id.",".$reciver_id.") and receiver_id IN(".$sender_id.",".$reciver_id.")  and chat_start_end = 1 and status = 1  and message != 0123456789 ORDER BY `id` ASC";
		
		$messages = $this->db->query($data)->result_array();
		if($messages)
		{
	    //print_r($messages);exit;
		foreach($messages as $row)
		{
		    ////////////////////////////////
		    $fsender_id = $row['sender_id'];
			$freciver_id = $row['receiver_id'];
			$message = $row['message'];
			$message_type = $row['message_type'];
			$date = $row['insert_date'];
			$cur_date = date('Y-m-d H:i:s');

			//date calculate coding
			$start  = date_create($date);
			$end  = date_create($cur_date);
			$diff = date_diff($start,$end);
			$diff->y . ' years, ';
			$diff->m . ' months, ';
			$diff->d . ' days, ';
			$diff->h .' hours ';
			$diff->i . ' mins, ';
			$diff->s . ' seconds';

  if($diff->d == 0)
  {
   if($diff->h == 0)
   {
    $dt=  $diff->i . ' mins ago';
   }
   else
   {
	$dt= $diff->h .' hours '. $diff->i . ' mins ago';
   }
  }
  elseif($diff->m == 0)
  {
   $dt= $diff->d . ' days ago';
  }
  else
  {
   $dt= $diff->m . ' month  Ago';
  }

    //////////Date Show////////// 
        $dt = $date;
   //////////

if($fsender_id == $sender_id)
{   
      
       echo '<li class="right clearfix"><span class="chat-img pull-right">
                              <img src="'.base_url().'/'.$sender_image.'" alt="User Avatar" class="img-circle" />
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="pull-right primary-font">'.$sender_name.'</strong>
   <small class="text-muted"><span class="fa fa-clock-o"></span>'.$dt.'</small>
                                     
                                  </div>
                                  <p style="text-align:right">';
                                  ?>
                                    <?php
                                  if($message_type == 1)
                                  {
                                    ?>
                                    <?php 
										echo $message;
                                  }
                                  else if($message_type == 2)
                                  {
                                      ?>
                                        <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="image" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 3)
                                  {
                                      ?>
                                      <!--<audio controls>
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/ogg">
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                            </audio>-->
                                              <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/audio.jpg" alt="audio" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 4)
                                  {
                                      ?>
                                      <!--<video width="300" height="200" controls>
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/mp4">
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/ogg">
                                        Your browser does not support the video tag.
                                        </video>-->
                                        
                                         <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/video.jpg" alt="video" style="width:100px;height:20px;"></a>
                                         
                                      <?php
                                  }
                                  else if($message_type == 5)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="camera" style="width:100;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 6)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/file.png" alt="file" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  ?>
                                  </p>
                              </div>
                          <?php echo '</li>';    
       
       
       }
       else
       {
					echo ' <li class="left clearfix"><span class="chat-img pull-left">
                              <img src="'.base_url().'/'.$reciver_image.'" alt="User Avatar" class="img-circle" />
                             <i class="fa fa-circle on-active" aria-hidden="true"></i>
  
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="primary-font">'.$reciver_name.'</strong> <small class="pull-right text-muted">
                                          <span class=" fa fa-clock-o"></span>'.$dt.'</small>
                                  </div>
                                  <p>';
                                  ?>
                                  <?php
                                  if($message_type == 1)
                                  {
                                    ?>
                                    <?php 
										echo $message;
                                  }
                                  else if($message_type == 2)
                                  {
                                      ?>
                                        <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="image" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 3)
                                  {
                                      ?>
                                      <!--<audio controls>
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/ogg">
                                              <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                            </audio>-->
                                              <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/audio.jpg" alt="audio" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 4)
                                  {
                                      ?>
                                      <!--<video width="300" height="200" controls>
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/mp4">
                                          <source src="<?php echo base_url();?>/chat_files/'.$message.'" type="video/ogg">
                                        Your browser does not support the video tag.
                                        </video>-->
                                        
                                         <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/video.jpg" alt="video" style="width:100px;height:20px;"></a>
                                         
                                      <?php
                                  }
                                  else if($message_type == 5)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?><?=$message?>" alt="camera" style="width:100;height:20px;"></a>
                                      <?php
                                  }
                                  else if($message_type == 6)
                                  {
                                       ?>
                                       <a href = "<?php echo base_url();?><?=$message?>" target = "_blank"><img src="<?php echo base_url();?>assets/uploads/chat/file.png" alt="file" style="width:100px;height:20px;"></a>
                                      <?php
                                  }
                                  ?>
                                  </p>
                              </div>
                          <?php echo '</li>';       
       }
       
		}
		    ////////////////////////////////
		}
		else
		{
		    /*echo ' <li class="left clearfix"><span class="chat-img pull-left">
                              <img src="'.base_url().'/'.$reciver_image.'" alt="User Avatar" class="img-circle" />
                             <i class="fa fa-circle on-active" aria-hidden="true"></i>
  
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="primary-font">'.$reciver_name.'</strong> <small class="pull-right text-muted">
                                          <span class=" fa fa-clock-o"></span></small>
                                  </div>
                                  <p>Order Request Please Start The Conversession</p></div></li>';*/
                             
		}
		
	}
	
	public function off_on_line($id='',$off_on='',$url='')
	{
	    if($this->input->post('offon') == 1)
	    {
	        $offon = 2;
	    }
	    else
	    {
	        $offon = 1;
	    }
	    
	    
	    //$offon = ($off_on==1)?2:1;
	    $this->db->where('user_id',$this->input->post('id'));
	    $this->db->update('users',array('off_on_line'=>$offon));
	    //redirect(base_url().'admin/'.$url, 'refresh');
	}
	
	public function end_chat()
	{//receiver_id
	    $data['sender_id']     = $this->input->post('id');//free_busy
	    $data['receiver_id']   = $this->input->post('receiver_id');
	    $query1 = 'delete FROM chat_count WHERE agent_id = '.$data['sender_id'].' and client_id = '.$data['receiver_id'].'';
	    $this->db->query($query1);
	    
	    $query = 'UPDATE `chats` SET `chat_start_end` = 2 WHERE sender_id IN('.$data['sender_id'].','.$data['receiver_id'].') and receiver_id IN('.$data['sender_id'].','.$data['receiver_id'].')';
	    $this->db->query($query);
	    
	    
	}
	
	public function add_order($invoice='invoice')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='agent')
			{
				$data['current_page']   ="add_order";
				$data['page_name']      ="Add Order";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']           = $this->common_m->get_invoice_data($invoice);
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_order');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	
	//add Agent model
	public function agent_add_adds($value='') 
	{
		$data 			= array();
		$data['id'] 	= $this->input->post('id');
		$data['pname'] 	= $this->input->post('pname');

		if($data['pname']=='add_order') 
		{
			$data['value']  = ($data['id'] != "") ? $this->common_m->get_invoice_data($data['id']) : array();
		}
		
		
		$this->load->view('admin/agent_add_order',$data);
	}
	
		//add Agent model
	public function agent_add_adds1($value='') 
	{
		$data 			= array();
		$data['value'] 	= array('user_id' => $this->input->post('id'));
		$data['pname'] 	= $this->input->post('pname');
		
		$this->load->view('admin/agent_add_order',$data);
	}
	
	//View Oders
	public function view_order($order='order')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='agent')
			{
				$data['current_page']   ="view_order";
				$data['page_name']      ="View Order";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']           = $this->common_m->get_invoice_data($order);
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/view_order');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//agent save data
	public function save_agent_data()
	{
		$data = $this->input->post('data');
		
		if($data['pname']=='add_order')
		{
			$table                  = 'invoice';
			$data['insert_date']    = date('Y-m-d h:i:s');
			$data['status']         = 1;
			$data['issue_date']     = date('y-m-d',strtotime($data['issue_date']));
			$data['due_date']       = date('y-m-d',strtotime($data['due_date']));
			
			mt_srand((double)microtime()*10000);
            $charid = md5(uniqid(rand(), true));
            $c = unpack("C*",$charid);
            $c = implode("",$c);
            $c = substr($c,0,10);
			
			$data['invoice_id'] = $c;
			$data['agent_id'] = $this->session->userdata('user_id');
		}
		
		if($data['pname']=='chat')
		{
			$table                  = 'invoice';
			$data['insert_date']    = date('Y-m-d h:i:s');
			$data['status']         = 1;
			$data['issue_date']     = date('y-m-d',strtotime($data['issue_date']));
			$data['due_date']       = date('y-m-d',strtotime($data['due_date']));
			
			mt_srand((double)microtime()*10000);
            $charid = md5(uniqid(rand(), true));
            $c = unpack("C*",$charid);
            $c = implode("",$c);
            $c = substr($c,0,10);
			
			$data['invoice_id'] = $c;
			$data['agent_id'] = $this->session->userdata('user_id');
		}

		unset($data['pname']);
		
		if(!empty($data['id']))
		{
			$this->db->where('id',$data['id']);
			unset($data['id']);
			$update=$this->db->update($table,$data);
			$this->session->set_flashdata('success','Data Updated successfully !');
			echo json_encode(["status"=>"success","message"=>"Data Updated successfully"]);
		}
		else 
		{
			$this->db->insert($table,$data);
			$this->session->set_flashdata('success','Data Inserted successfully !');
			echo json_encode(["status"=>"success","message"=>"Data Inserted successfully"]);
		}
		
	}
	
	//DEMO1
	public function services($id='')
	 {
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="demo1";
				$data['page_name']      ="Demo1";
				$data['user_info']      = $this->common_m->get_user_details();
				//get 10 tables
				$data['adds']          = $this->crms_m->get_hotel_user_data($id);
				$data['train']         = $this->crms_m->get_air_train_user_data($id);
 				$data['craft'] 		   = $this->crms_m->get_air_craft_user_data($id);
 				$data['boat'] 		   = $this->crms_m->get_boat_user_data($id);
				$data['cargo'] 		   = $this->crms_m->get_cargo_user_data($id);
				$data['driver'] 	   = $this->crms_m->get_driver_user_data($id);
				$data['cruise'] 	   = $this->crms_m->get_cruise_user_data($id);
				$data['event'] 		   = $this->crms_m->get_event_user_data($id);
				$data['company_fees'] 		   = $this->crms_m->get_company_user_data($id);
				$data['miscellaneous'] 		   = $this->crms_m->get_miscellaneous_user_data($id);
	

				foreach ($data['adds']  as $key => $value)
				 {
					$data['adds'][$key]['user_name'] = ($name = $this->crms_m->get_user_details($value['user_id']))?@$name->user_name:'';
					}
					//print_r($data); exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/demo1');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Add DEMO1
	public function add_demo1($value = '')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_demo1";
				$data['page_name']      ="Add demo1";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']           = ($value != "") ? $this->common_m->get_hotel_data($value): array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_demo1');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}

	//DEMO1
	public function demo2()
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="demo1";
				$data['page_name']      ="Demo1";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']         	= $this->common_m->get_hotel_data();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/demo2');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	//Add DEMO1
	public function add_demo2($value = '')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_demo2";
				$data['page_name']      ="Add demo2";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['adds']           = ($value != "") ? $this->common_m->get_hotel_data($value): array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_demo2');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}


	
	public function importcsv($user_id='')
	 {

			$user_id = $user_id;
		//	$data["user_count"] = $this->crms_m->get_company_user_count($user_id)['total'];
		//	$data["user_limit"] = $this->crms_m->get_company_user_limit($user_id)['total'];
		//	$remaining = $data["user_limit"] - $data["user_count"];
		  	//print_r($remaining);
		  	$data['user_info']      = $this->common_m->get_user_details();
			$this->load->library('csvimport');
			$config['upload_path'] = FCPATH.'assets/uploads/';
			$config['allowed_types'] = '*';
			$config['max_size'] = '10000';     
			$this->load->library('upload', $config);
		
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
          //print_r($data['error']);exit;
           
        } else {
            $file_data = $this->upload->data();

            $file_path =  FCPATH.'assets/uploads/'.$file_data['file_name'];
           
            if ($this->csvimport->get_array($file_path)) 
			{
                $csv_array = $this->csvimport->get_array($file_path);
				$lenth = count($csv_array);
			
				//$user_id    = $this->examples_model->get_unused_id();
				//$password     = $this->authentication->hash_passwd('users');
				$created_at =date('Y-m-d H:i:s');
				//print_r($csv_array); exit;
              
		
					foreach($csv_array as $row) 
					{
					     $check_email = $this->db->get_where('users',array('email'=>$row['email'], 'mobile'=>$row['mobile']))->num_rows();
					     
					     if($check_email > 0)
					     {
					          $this->session->set_flashdata('Not Success', 'Mobile Number Alredy Exiting Please Enter Another Number');
					     }
					     else
					     {
						//$user_id    = $this->examples_model->get_unused_id();
						  $insert_data = array(					    
							//'user_id'=>$user_id,
							'user_name'=>$row['name'],
							'mobile'=>$row['mobile'],
							'email'=>$row['email'],
							'customer_type'=>$row['customer_type'],
							'address'=>$row['address'],
							'image'=>'assets/uploads/user_profiles/default.png',
							'password'=>base64_encode(mt_rand(99,99999999)),
							'auth_level'=>1,
							'role'=>'user',
							'created_at' => $created_at,
							//'user_id' => $user_id,
							'status' => 'active'
						);
						//echo "<pre>"; print_r($insert_data);
					    	$this->crms_m->insert_csv($insert_data);
						   $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
               
					    }
					}
				
             	redirect($_SERVER['HTTP_REFERER'],'refresh');
                $this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/client',$data);
                //echo "<pre>"; print_r($insert_data);
				
            } else 
                $data['error'] = "Error occured";
              //  $this->load->view('company', $data);
              //	echo json_encode(["status"=>"error", "mobile" => "mobile" ,"message"=>"Mobile Number Alredy Exiting Please Enter Another Number"]);
            } 
            
    }
    

	public function save_suplier($value='')
       {
         	$data = $this->input->post('data');
         	if(!empty($data['id'])){
         		$res = $this->db->where('email',$data['email'])->where('id!=',$data['id'])->get('suppliers')->row();
    	    	$res1 = $this->db->where('mobile',$data['mobile'])->where('id!=',$data['id'])->get('suppliers')->row();
         	}else{
         		$res = $this->db->where('email',$data['email'])->get('suppliers')->row();
    	    	$res1 = $this->db->where('mobile',$data['mobile'])->get('suppliers')->row();
         	}
           
    	    if(sizeof($res) == 0)
    	     {
    	         if(sizeof($res1) == 0)
    	         {
    	                
    	                if($data['pname'] == 'add_suplier')
                    	{
                    	   // $rand = rand(0,9).rand(0,9).rand(0,9);
                		    $table                  = 'suppliers';
                		  //  $data['auth_level']     =3;
                			//$data['role']           ='suplier';
                			//$data['suplier_code']   ='SC'.$id;
                			//$data['customer_type']  ='CRMS';
                			/*$data['form_hours']     = date('h:i A',strtotime($data['form_hours']));
            			    $data['to_hours']       = date('h:i A',strtotime($data['to_hours']));*/
                		    $data['created_at']     = date('Y-m-d h:i:s');
                		    
                    	}
    	                
    	                unset($data['pname']);
    	                
                		
                		if(!empty($data['id']))
                		{
                			$this->db->where('id',$data['id']);
                			unset($data['id']);
                			$update=$this->db->update($table,$data);
                			$this->session->set_flashdata('success','Data Updated successfully !');
                			echo json_encode(["status"=>"success","message"=>"Data Updated successfully"]);
                		}
                		else 
                		{
                			$this->db->insert('suppliers',$data);
                			$this->session->set_flashdata('success','Data Inserted successfully !');
                			echo json_encode(["status"=>"success","message"=>"Data Inserted successfully"]);
                		}
    	         }
    	         else
    	         {
    	             	echo json_encode(["status"=>"error", "mobile" => "mobile" ,"message"=>"Mobile Number Alredy Exiting Please Enter Another Number"]);
    	         }
    	         
    	    }
    	    else
    	    {
    	        	echo json_encode(["status"=>"error", "email" => "email","message"=>"Email Alredy Exiting Please Enter Another Email"]);
    	    }
	    
     }

    public function suplier()
	  {
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="suplier";
				$data['page_name']      ="suplier Management";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['suplier']         = $this->crms_m->get_suplier_data();
				//print_r($data['client']); exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/suplier',$data);
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}

	public function add_suplier($value = '')
	 {
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="add_suplier";
				$data['page_name']      ="Add Suplier";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['suplier']         = ($value != "") ? $this->crms_m->get_suplier_data($value): array();
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/add_suplier');
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
  
   public function class_type($id='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="class_type";
				$data['page_name']      ="Class Type";
				$data['user_info']      = $this->crms_m->get_user_details();
				$data['class']         = $this->crms_m->get_class_type();
				//print_r($data['class']); exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/class_type',$data);
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}

	public function generate_invoice($id='',$value='')
	 {
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="generate_invoice";
				$data['page_name']      ="generate_invoice";
				$data['user_info']      = $this->common_m->get_user_details();
				//echo $id;
				//die;
				$data['trip']  = ($value != "") ? $this->crms_m->get_trip_data($value,$id): array();
				//print_r($data['trip']);exit;
				//$client_id = $data['trip']['user_id'];
				$client_id = $id;
				
				//get 10 tables
				$data['user']           = $this->db->get_where('users',array('user_id'=>$client_id))->row_array();
				$data['adds']           = $this->crms_m->get_hotel_user_data($client_id);
				$data['train']          = $this->crms_m->get_air_train_user_data($client_id);
 				$data['craft'] 		    = $this->crms_m->get_air_craft_user_data($client_id);
 				$data['boat'] 		    = $this->crms_m->get_boat_user_data($client_id);
				$data['cargo'] 		    = $this->crms_m->get_cargo_user_data($client_id);
				$data['driver'] 		= $this->crms_m->get_driver_user_data($client_id);
				$data['cruise'] 		= $this->crms_m->get_cruise_user_data($client_id);
				$data['event'] 		    = $this->crms_m->get_event_user_data($client_id);
				$data['company_fees'] 	= $this->crms_m->get_company_user_data($client_id);
				$data['miscellaneous'] 	= $this->crms_m->get_miscellaneous_user_data($client_id);
			
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/g1',$data);
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}


	public function copy_data($id='')
	 {
		$copy =$this->db->get_where('trip',array('id'=>$id))->row_array(); 
		unset($copy['id']);       
        $copy['create_date'] = date('Y-m-d h:i:s');
        $insert = $this->db->insert('trip',$copy);

        if($insert)
        {
        	$this->session->set_flashdata('success','Data Inserted successfully !');
			//echo json_encode(["status"=>"success","message"=>"Data Inserted successfully"]);

			redirect(base_url().'admin/trip');
        }
        else
        {
        	$this->session->set_flashdata('success','Data not Copied Succesfully !');
        	//echo json_encode(["status"=>"error","message"=>"Data not Copied Succesfully"]);

        	redirect(base_url().'admin/trip');
        }

	}
	
	
	public function generate_quotation($id='',$value='')
	 {
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="generate_quotation";
				$data['page_name']      ="generate_quotation";
				$data['user_info']      = $this->common_m->get_user_details();
				
				$data['trip']  = ($value != "") ? $this->crms_m->get_trip_data($value, $id): array();
				//print_r($data['trip']);exit;
				    $client_id = $data['trip'][0]['user_id'];
				//get 10 tables
				$data['user'] = $this->db->get_where('users',array('user_id'=>$client_id))->row_array();
				$data['adds']          = $this->crms_m->get_hotel_user_data($client_id);
				$data['train']         = $this->crms_m->get_air_train_user_data($client_id);
 				$data['craft'] 		   = $this->crms_m->get_air_craft_user_data($client_id);
 				$data['boat'] 		   = $this->crms_m->get_boat_user_data($client_id);
				$data['cargo'] 		   = $this->crms_m->get_cargo_user_data($client_id);
				$data['driver'] 		= $this->crms_m->get_driver_user_data($client_id);
				$data['cruise'] 		   = $this->crms_m->get_cruise_user_data($client_id);
				$data['event'] 		   = $this->crms_m->get_event_user_data($client_id);
				$data['company_fees'] 		   = $this->crms_m->get_company_user_data($client_id);
				$data['miscellaneous'] 		   = $this->crms_m->get_miscellaneous_user_data($client_id);
			
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/generate_quotation',$data);
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}


	public function invoice_pdf_reports($id='')
	{
	    
		require_once APPPATH . '/libraries/mpdf-development/src/Mpdf.php';
		$data = [];
		//load the view and saved it into $html variable
		//$data['trip']          = ($value != "") ? $this->crms_m->get_trip_data($value,$id): array();
		$data['trip']         = $this->crms_m->get_trip_user_data($id);
		//print_r($data['trip']); exit;
		$html  				 	= $this->load->view('admin/invoice_pdf_reports',$data,true);

        //this the the PDF filename that user will get to download
		$pdfFilePath = "invoice.pdf";

        //load mPDF library
		//$this->load->library('m_pdf');
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);

       //generate the PDF from the given html
		//$this->m_pdf->pdf->WriteHTML($html);

        //download it.
		$mpdf->Output($pdfFilePath, "D");
	}


		public function invoice_excel($client_id='')
	   {
	      
	            $adds           = $this->crms_m->get_hotel_user_data($client_id);
				$train          = $this->crms_m->get_air_train_user_data($client_id);
 				$craft 		    = $this->crms_m->get_air_craft_user_data($client_id);
 				$boat 		    = $this->crms_m->get_boat_user_data($client_id);
				$cargo 		    = $this->crms_m->get_cargo_user_data($client_id);
				$driver 		= $this->crms_m->get_driver_user_data($client_id);
				$cruise 		= $this->crms_m->get_cruise_user_data($client_id);
				$event 		    = $this->crms_m->get_event_user_data($client_id);
				$company_fees 	= $this->crms_m->get_company_user_data($client_id);
				$miscellaneous 	= $this->crms_m->get_miscellaneous_user_data($client_id);
	      
		include_once APPPATH."libraries/PHPExcel/Classes/PHPExcel.php";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=Invoice.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		flush();
		$objPHPExcel = new PHPExcel();
      // here fill data to your Excel sheet
		$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
		$objPHPExcel->setActiveSheetIndex(0);
      // Field names in the first row
		$col = 0;
		$fields = array("S.No","Description","Units","Nbr Nts/Days","Rate","Total");
		
		$styleArray = array(
            'font' => array(
            'bold' => true
            )
        );
		foreach ($fields as $field) 
		{
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
			$col++;
		} 
		$count=1;
	    $i=2;

	  if(!empty($adds))
      {
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$count);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $adds[0]['service_type']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'');
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,'');
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
                
                $total_adds = array();
                foreach($adds as $key=>$value)
                {
                    $i++;
                	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
                    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $adds[$key]['room_desc']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,$adds[$key]['unit_rate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,$adds[$key]['day_night']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,$adds[$key]['x_rate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,$adds[$key]['markup_net_cost']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
                    
                    array_push($total_adds, $adds[$key]['markup_net_cost']);
                   
                }
               
                $adds_amount = array_sum($total_adds);
            $i++;
            $count++;
       }
       else
       {
          $adds_amount = 0;
       }

        
      
      if(!empty($train))
      {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$count);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $train[0]['service_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');

            $total_train = array();
            foreach($train as $key=>$value)
            {
                $i++;
            	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,$train[$key]['route']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,$train[$key]['unit_rate']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,$train[$key]['x_rate']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,$train[$key]['markup_net_cost']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
                
                array_push($total_train, $train[$key]['markup_net_cost']);
                
            }
           
            $train_amount = array_sum($total_train);
            $i++;
            $count++;
      }
      else
      {
          $train_amount = 0;
      } 


	  if(!empty($craft))
      {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$count);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $craft[0]['service_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
                
            $total_craft = array();
            foreach($craft as $key=>$value)
            {
                $i++;
            	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $craft[$key]['route']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,$craft[$key]['unit_rate']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,$craft[$key]['x_rate']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,$craft[$key]['markup_net_cost']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
                
                array_push($total_craft, $craft[$key]['markup_net_cost']);
                   
            }
           
            $craft_amount = array_sum($total_craft);
            $count++;
            $i++;
	      }
	      else
	      {
	          $craft_amount = 0;
	      }
	      
	      
        if(!empty($boat))
        {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$count);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $boat[0]['service_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
            
            $total_boat = array();
            foreach($boat as $key=>$value)
            {
                $i++;
            	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $boat[$key]['boat_details']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $boat[$key]['unit_rate']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $boat[$key]['x_rate']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $boat[$key]['markup_net_cost']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
                
                array_push($total_boat, $boat[$key]['markup_net_cost']);
            }    
            
            $boat_amount = array_sum($total_boat);
            $count++;
            $i++;
        }
        else
        {
            $boat_amount = 0;
        }
        
        if(!empty($cargo))
        {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$count);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $cargo[0]['service_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
            
            $total_cargo = array();
            foreach($cargo as $key=>$value)
            {
                    $i++;
                	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
                    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $cargo[$key]['unit_rate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
                    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $cargo[$key]['x_rate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $cargo[$key]['cost_in_sar_net_cost']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
                    
             array_push($total_cargo, $cargo[$key]['cost_in_sar_net_cost']);
            }
            
            $cargo_amount = array_sum($total_cargo);
            $count++;
            $i++;
        }
        else
        {
             $cargo_amount = 0;
        }
        
        if(!empty($driver))
        {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$count);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $driver[0]['service_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
            
            $total_driver = array();
            foreach($driver as $key=>$value)
            {
                $i++;
            	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $driver[$key]['location']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $driver[$key]['unit_rate']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $driver[$key]['days']);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $driver[$key]['x_rate']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $driver[$key]['markup_net_cost']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
                     
                array_push($total_driver, $driver[$key]['markup_net_cost']);
            }
            
            $driver_amount = array_sum($total_driver);    
            $count++;
            $i++;
        }
        else
        {
            $driver_amount = 0;
        }
        
        
        if(!empty($cruise))
        {   
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$count);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $cruise[0]['service_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
            
             $total_cruise = array();
            foreach($cruise as $key=>$value)
            {
                    $i++;
                	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
                    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,'');
                    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $cruise[$key]['unit_rate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $cruise[$key]['x_rate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $cruise[$key]['cost_in_sar_net_cost']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
                    
                    array_push($total_cruise, $cruise[$key]['cost_in_sar_net_cost']);  
            }
            
            $cruise_amount = array_sum($total_cruise);
            $count++;
            $i++;
        }
        else 
        {
            $cruise_amount = 0;
        }
      
        
        if(!empty($event))
        {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$count);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $event[0]['service_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
            
            $total_event = array();
            foreach($event as $key=>$value)
            {
                    $i++;
                	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
                    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,'');
                    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $event[$key]['unit_rate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $event[$key]['x_rate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $event[$key]['cost_in_sar_net_cost']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
                    
                    array_push($total_event, $event[$key]['cost_in_sar_net_cost']);               
            }
            
            $event_amount = array_sum($total_event);
            $count++;
            $i++;
        }
        else 
        {     
            $event_amount = 0;
        }
        
        
        if(!empty($company_fees))
        {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$count);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $company_fees[0]['service_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
            
            $total_company = array();
            foreach($company_fees as $key=>$value)
            {
                    $i++;
                	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
                    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,'');
                    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $company_fees[$key]['unit_rate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $company_fees[$key]['x_rate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $company_fees[$key]['cost_in_sar_net_cost']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
                    
                    array_push($total_company, $company_fees[$key]['cost_in_sar_net_cost']);                
            }
            
            $company_amount = array_sum($total_company);
            $count++;
            $i++;
        }
        else 
        {
            $company_amount = 0;
        }
        
        
        if(!empty($miscellaneous))
        {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$count);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $miscellaneous[0]['service_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
            
            $total_miscellaneous = array();
            foreach($miscellaneous as $key=>$value)
            {
                    $i++;
                    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
                    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,'');
                    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $miscellaneous[$key]['unit_rate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $miscellaneous[$key]['x_rate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $miscellaneous[$key]['cost_in_sar_net_cost']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
                    
                    array_push($total_miscellaneous, $miscellaneous[$key]['cost_in_sar_net_cost']);                
            }
            $miscellaneous_amount = array_sum($total_miscellaneous);
            $count++;
            $i++;
        }
        else 
        {
            $miscellaneous_amount = 0;
        }
        
        $grand_total = $adds_amount + $train_amount + $craft_amount + $boat_amount  + $driver_amount + $cargo_amount + $cruise_amount +$miscellaneous_amount + $company_amount + $event_amount ;
  
        
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
        
        
        
        $i++;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'Grand Total');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $grand_total);
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, '');
        
        $i++;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'');
        
        $i++;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,'Total Amount To be Paid ');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $grand_total);
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, '');
        
  //$grand_total = $adds_amount + $train_amount + $craft_amount + $boat_amount  + $driver_amount ;
 	    $grand_total = 0;
  		$col = 0;		
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');		

  }  


    public function crms()
    {
        $this->session->set_userdata('crms','crms');
        redirect(base_url().'admin/dashboard_index');
    }
    
    public function Joher()
    {
        $this->session->set_userdata('crms','joher');
        redirect(base_url().'admin/index');
    }

    public function documents($id='',$doc='')
	 {
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="documents";
				$data['page_name']      ="documents";
				$data['user_info']      = $this->crms_m->get_user_details();
				$data['documents']      = $this->crms_m->get_documents($id,$doc);
				$data['client_document'] = $doc; 
				//print_r($data); exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/documents',$data);
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
		//get supplyser name 
	public function get_name()
	{
	   $id = $this->input->post('id');
	   $service_type = $this->input->post('service_type');
	   $name = $this->db->where('supplier_code',$id)->get('suppliers')->row();
	   //echo $this->db->last_query(); exit;
	   //print_r($name); exit;
	   $res = $this->db->get_where('suppliers',array('service_type'=>$service_type))->result();

	   foreach ($res as $key => $value) {
	   
	   if(@$name->supplier_name==$value->supplier_name)
	   {
	   	echo "<option value = '".$value->supplier_name."' selected >".$value->supplier_name."</option>";
	   }else
	   {
	   	echo "<option value = '".$value->supplier_name."'  >".$value->supplier_name."</option>";
	   }
	   }
	}
	//get supplyser name 
	public function get_supplier_id($value='')
	{
	   $supplier_name = $this->input->post('supplier_name');
	   $service_type = $this->input->post('service_type');
	  // print_r($user_name);
	   $id = $this->db->where('supplier_name',$supplier_name)->get('suppliers')->row(); 
	 // echo $this->db->last_query(); exit;
	   $res = $this->db->get_where('suppliers',array('service_type'=>$service_type))->result();
	   foreach ($res as $key => $value) {
	   
	   if(@$id->supplier_code==$value->supplier_code)
	   {
	   	echo "<option value ='".$value->supplier_code."' selected >".$value->supplier_code."</option>";
	   }else
	   {
	   	echo "<option value ='".$value->supplier_code."'  >".$value->supplier_code."</option>";
	   }
	   }
	}
	

	public function get_client_name()
	 {
	   $id = $this->input->post('id');
	   //$service_name = $this->input->post('service_name');
	   $name1 = $this->db->where('client_code',$id)->get('user_info')->row();

	   $name = $this->db->where('user_id',$name1->user_id)->get('users')->row();
	   //print_r($name); exit;
	   $res = $this->db->get_where('users',array('auth_level'=>1))->result();
	   foreach ($res as $key => $value) {
	   
	   if(@$name->user_name==$value->user_name)
	   {
	   	echo "<option value = '".$value->user_name."' selected >".$value->user_name."</option>";
	   }else
	   {
	   	echo "<option value = '".$value->user_name."'  >".$value->user_name."</option>";
	   }
	   }
	}

	public function get_client_email()
	{
	   $id = $this->input->post('id');
	   //$service_name = $this->input->post('service_name');
	   $name1 = $this->db->where('client_code',$id)->get('user_info')->row();

	   $name = $this->db->where('user_id',$name1->user_id)->get('users')->row();
	   //echo $name->email;
	   //print_r($name); exit;
	   $res = $this->db->get_where('users',array('auth_level'=>1))->result();
	   foreach ($res as $key => $value) 
	   {
	   

		   if(@$name->email==$value->email)
		   {

		   	echo "<option value = '".$value->email."' selected >".$value->email."</option>";
		   }else
		   {
		   	echo "<option value = '".$value->email."'  >".$value->email."</option>";
		   }
	   }
	}




	public function airlines_choice($id='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="airlines";
				$data['page_name']      ="airlines";
				$data['user_info']      = $this->crms_m->get_user_details();
				$data['class']         = $this->crms_m->get_airlines_choice();
				//print_r($data['class']); exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/airlines',$data);
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	public function hotel_chain($id='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="hotel_chain";
				$data['page_name']      ="hotel_chain";
				$data['user_info']      = $this->crms_m->get_user_details();
				$data['class']         = $this->crms_m->get_hotel_chain_choice();
				//print_r($data['class']); exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/hotel_chain',$data);
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	public function car_choice($id='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="car_choice";
				$data['page_name']      ="car_choice";
				$data['user_info']      = $this->crms_m->get_user_details();
				$data['class']         = $this->crms_m->get_car_choice();
				//print_r($data['class']); exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/car_choice',$data);
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	public function city($id='')
	{
	    if($this->session->userdata('auth_level')) 
		{ 
			if($this->session->userdata('role') =='admin')
			{
				$data['current_page']   ="city";
				$data['page_name']      ="city";
				$data['user_info']      = $this->crms_m->get_user_details();
				$data['class']         = $this->crms_m->get_city();
				//print_r($data['class']); exit;
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/city',$data);
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
	}
	
	public function get_city_id($value='')
	{
	   $user_id = $this->input->post('id');
	   $city = $this->input->post('place');
	    //print_r($this->input->post()); 
	   $data = $this->db->where('user_id',$user_id)->get('trip')->row();
	 
	   if($data)
	   {
	       $cities = explode(',',$data->intermediate_cities);
           if (($key = array_search($city, $cities)) !== false) 
           {
                unset($cities[$key]);
	       }
	       
	       $unset_data = implode(',',$cities);
	 
	       $this->db->where('user_id',$user_id);
	       $this->db->update('trip',array('intermediate_cities'=>$unset_data));
	       //echo $this->db->last_query();
	   
	   }
	  
	}

	//Save Agent Login 
	public function save_users()
	 {
	    $data = $this->input->post('data');
	    $data1 = $this->input->post('type');
	    
	    if(!empty($data['user_id']))
        {
	                if($data['pname'] == 'users')
                	{
            		    $table                    = 'users';
            		   // $data['category_id']    = serialize($data['category_id']);
            		   // $data['working_day']    = serialize($this->input->post('working_day'));
            			$data['auth_level']       =8;
            			$data['role']             ='sub_admin';
            			//$data['form_hours']     = date('h:i A',strtotime($data['form_hours']));
            			//$data['to_hours']       = date('h:i A',strtotime($data['to_hours']));
            		    $data['created_at']       = date('Y-m-d h:i:s');
            		    if(empty($data['password']))
            		    {
            		        $data['password']       =   base64_encode(mt_rand(99,99999999));
            		    }
            		    else
            		    {
            		        $data['password']       =   base64_encode($data['password']);
            		    }
            		    
            		    $img_path                   = 'assets/uploads/user_profiles';
                	}

	                unset($data['pname']);
	                
            		//for member image
            		if(!empty($_FILES['addimage']['name']))
            		{       
            		       $imageFileType = strtolower(pathinfo(basename($_FILES["addimage"]["name"]),PATHINFO_EXTENSION));
            		       $imgname = date('Y-m-d').'-'.time().'.'.$imageFileType;
            		       
            			   $config['upload_path'] = ($img_path)?$img_path:'assets/uploads/users';
            			   $config['allowed_types'] = 'jpg|jpeg|png|gif';
            			   $config['file_name'] = $imgname;     
            			   $this->load->library('upload',$config);
            			   $this->upload->initialize($config);
            			   if($this->upload->do_upload('addimage')){
            			   $uploadData = $this->upload->data();
            			   $data['image'] = $config['upload_path'].'/'.$uploadData['file_name'];
            			   }else{
            			   $data['image'] = '';
            			   }
            		}
            		else 
            		{
            			$data['image'] = $this->input->post('old_image');
            		}
            		if(@$data1)
            		{
            			$this->db->where('user_id',$data['user_id']);
            			$this->db->delete('permissions');
            			//$this->db->update('permissions',$data1['services']);
            			foreach ($data1 as $key => $value) {
        					$this->db->insert('permissions',array('user_id'=>$data['user_id'],'type'=>$value,'is_view'=>1));
        				}
        				
            			unset($data1['services']);
            		}
            		
            		
        			$this->db->where('user_id',$data['user_id']);
        			unset($data['user_id']);
        			$update=$this->db->update($table,$data);
        			$this->session->set_flashdata('success','Data Updated successfully !');
        			echo json_encode(["status"=>"success","message"=>"Data Updated successfully"]);
        }
        else
        {
    	    $res = $this->db->where('email',$data['email'])->get('users')->row();
    	    $res1 = $this->db->where('mobile',$data['mobile'])->get('users')->row();
    	    if(sizeof($res) == 0)
    	    {
    	         if(sizeof($res1) == 0)
    	         {
    	                
    	                if($data['pname'] == 'users')
                    	{
                		    $table                    = 'users';
                		   // $data['category_id']    = serialize($data['category_id']);
                		    //$data['working_day']    = serialize($data['working_day']);
                			$data['auth_level']       =8;
                			$data['role']             ='user';
                		//	$data['form_hours']       = date('h:i A',strtotime($data['form_hours']));
            			   // $data['to_hours']       = date('h:i A',strtotime($data['to_hours']));
                		    $data['created_at']       = date('Y-m-d h:i:s');
                		    
                		    if(empty($data['password']))
                		    {
                		        $data['password']       =   base64_encode(mt_rand(99,99999999));
                		    }
                		    else
                		    {
                		        $data['password']       =   base64_encode($data['password']);
                		    }
                		    
                		    $img_path                   = 'assets/uploads/user_profiles';
                    	}
    	                
    	                unset($data['pname']);
    	                
                		//for member image
                		if(!empty($_FILES['addimage']['name']))
                		{       
                		       $imageFileType = strtolower(pathinfo(basename($_FILES["addimage"]["name"]),PATHINFO_EXTENSION));
                		       $imgname = date('Y-m-d').'-'.time().'.'.$imageFileType;
                		       
                			   $config['upload_path'] = ($img_path)?$img_path:'assets/uploads/users';
                			   $config['allowed_types'] = 'jpg|jpeg|png|gif';
                			   $config['file_name'] = $imgname;     
                			   $this->load->library('upload',$config);
                			   $this->upload->initialize($config);
                			   if($this->upload->do_upload('addimage')){
                			   $uploadData = $this->upload->data();
                			   $data['image'] = $config['upload_path'].'/'.$uploadData['file_name'];
                			   }else{
                			   $data['image'] = '';
                			   }
                		}
                		else 
                		{
                			$data['image'] = $this->input->post('old_image');
                		}
                		
                		if(!empty($data['user_id']))
                		{
                			$this->db->where('user_id',$data['user_id']);
                			unset($data['user_id']);
                			$update=$this->db->update($table,$data);
                			$this->session->set_flashdata('success','Data Updated successfully !');
                			echo json_encode(["status"=>"success","message"=>"Data Updated successfully"]);
                		}
                		else 
                		{
                			$this->db->insert($table,$data);
                           // print_r($data);
                            //print_r($data1);
                			$id=$this->db->insert_id();

                			if(@$data1)
                			{
                				//$data1['type']         = serialize($data1['type']);
                				foreach ($data1 as $key => $value) {
                					$this->db->insert('permissions',array('user_id'=>$id,'type'=>$value,'is_view'=>1));
                				}
                				
                			}
                			else
                			{
                				$data['type'] = '';
                			}
                		
                		//	die;

                			$this->session->set_flashdata('success','Data Inserted successfully !');
                			echo json_encode(["status"=>"success","message"=>"Data Inserted successfully"]);
                		}
    	         }
    	         else
    	         {
    	             	echo json_encode(["status"=>"error", "mobile" => "mobile" ,"message"=>"Mobile Number Alredy Exiting Please Enter Another Number"]);
    	         }
    	         
    	    }
    	    else
    	    {
    	        	echo json_encode(["status"=>"error", "email" => "email","message"=>"Email Alredy Exiting Please Enter Another Email"]);
    	    }
	    
        }
		
	}

	public function users($user_id='')
	{
		 if($this->session->userdata('auth_level')) 
			{ 
			 if($this->session->userdata('role') =='admin')
			    {
				$data['current_page']   ="users";
				$data['page_name']      ="Users Management";
				$data['user_info']      = $this->common_m->get_user_details();
				$data['user']           = $this->common_m->get_user_adds();
				//print_r($data['user']); exit;
				$user_permissions = $this->common_m->user_permissions($user_id);
				//print_r($user_permissions); exit;
				$permissions = array();
				if($user_permissions)
				{
					foreach ($user_permissions as $ukey => $uvalue) {
						if($uvalue->is_view==1)
							$permissions[] = $uvalue->type;
					}
				}
				$data['user_permissions'] = $permissions;
				$data['userdata'] = $this->common_m->get_user_adds($user_id);
				$this->db->select('u.*');
				$this->db->where('u.auth_level',8);
				$data['users'] = $this->db->get('users as u')->result_array(); 
				if($data['users'])
				{
					foreach ($data['users'] as $key => $value) {
						$permissions = $this->common_m->user_permissions($value['user_id']);
						$perm_list = array();
						if($permissions)
						{
							foreach ($permissions as $pkey => $pvalue) {
								$perm_list[] = $pvalue->type;
							}
						}
						$data['users'][$key]['permissions'] = $perm_list;
					}
				}   
				$this->load->view('admin/includes/header',$data);
				$this->load->view('admin/includes/footer');
				$this->load->view('admin/users',$data);
			}
			else
			{
				redirect(base_url().'home/index');
			}

		}else{
			redirect(base_url().'home/index');
		}
		
	}


}
