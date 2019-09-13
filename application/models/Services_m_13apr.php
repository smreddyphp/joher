<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');


	class Services_m extends CI_Model {
		public function get_customer_adds($id=''){
			if($id){
				return $this->db->select('*')->from('customer_adds')->where('id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('customer_adds')->get()->result_array();
			}
			
		}
		public function get_service_provider_adds($id=''){
			if($id){
				return $this->db->select('*')->from('service_provider_adds')->where('id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('service_provider_adds')->get()->result_array();
			}
			
		}
		public function get_user_details($user_id){
			return $this->db->select('*')->from('users')->where('user_id',$user_id)->get()->row_array();
		}
		public function update_login_time($user_id){
			$this->db->set('last_login',date('Y-m-d H:i:s'))->where('user_id',$user_id)->update('users');
		}
		public function get_states(){
			return $this->db->where('country_id',191)->get('states')->result_array();
		}
		public function get_cities($state_id){
			return $cities = $this->db->where('state_id',$state_id)->get('cities')->result_array();
		}
		public function get_inner_adds($id=''){
			if($id){
				return $this->db->select('*')->from('adds')->where('id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('adds')->where('status','active')->get()->result_array();
			}
			
		}
		public function get_services($sid=''){
			if($sid){
				return $this->db->select('*')->from('services')->where('id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('services')->where('status','active')->get()->result_array();
			}
		}
		public function get_vendorslist($vendor_type,$latitude,$longitude){
			return $this->db->select("user_id,user_name,email,image,shop_name,shop_image,city,country,address,state,pincode,latitude,longitude,ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( '".$latitude."' ) ) + COS( RADIANS( `latitude` ) )
        * COS( RADIANS( '".$latitude."' )) * COS( RADIANS( `longitude` ) - RADIANS( '".$longitude."' )) ) * 6380 AS `distance`")->from('users')->where('auth_level',$vendor_type)->order_by('distance')->get()->result_array();
		}
		public function get_servicename($vendor_id){
			return $this->db->select('min(vs.price) as price, vs.service_id, s.service_name_en')->from('vendor_services as vs')->join('services as s','vs.service_id = s.id','LEFT')->where('vs.user_id',$vendor_id)->get()->row_array();
			
		}
		//if filter is there
		public function get_filter_vendors($filter,$vendor_type){
			$this->db->select('users.user_name,users.user_id,users.email,users.city,users.country,users.address,users.state,users.pincode,users.image,users.shop_name,users.shop_image,users.auth_level,vs.price, vs.service_id, s.service_name_en')->from('vendor_services as vs')->join('services as s','vs.service_id = s.id','LEFT')->join('users','vs.user_id=users.user_id','LEFT')->where('users.auth_level',$vendor_type);

			if(isset($filter['service_filter']) && isset($filter['price_starts']) && isset($filter['price_ends'])){
				$serv = rtrim($filter['service_filter'],','); 
				$price_starts = $filter['price_starts']; 
				$price_ends = $filter['price_ends'];
				return $this->db->where_in('vs.service_id',$serv,FALSE)->where('vs.price BETWEEN '.$price_starts.' AND '.$price_ends )->get()->result_array();
			}
			if(isset($filter['service_filter'])){
				$serv = rtrim($filter['service_filter'],','); 
				return $this->db->where_in('vs.service_id',$serv,FALSE)->get()->result_array();
			}
			if(isset($filter['price_starts']) && isset($filter['price_ends'])){
				$price_starts = $filter['price_starts']; 
				$price_ends = $filter['price_ends'];
				return $this->db->where('vs.price BETWEEN '.$price_starts.' AND '.$price_ends )->get()->result_array();
			}


		}
		//get venodr services
		public function get_vendor_services($vendor_id){
			return $this->db->select('vs.*, s.service_name_en,s.service_name_ar')->from('vendor_services as vs')->join('services as s','vs.service_id=s.id')->where('vs.user_id',$vendor_id)->get()->result_array();
		}
		//get venodr timings
		public function get_vendor_timings($vendor_id){
			return $this->db->where('user_id',$vendor_id)->get('vendor_timings')->result_array();
		}
		//get chat history
		public function get_chat_history($sender_id,$receiver_id){
			$ids = $sender_id.','.$receiver_id;
			$ids2 = $receiver_id.','.$sender_id;
			return $this->db->where_in('sender_id',$ids,FALSE)->where_in('receiver_id',$ids2,FALSE)->order_by('date','ASC')->get('chats')->result_array();
			 //return $this->db->last_query();
		}
		//vender chats list
		public function vender_chats($vendor_id){
			return $this->db->select('chats.*,users.user_id,user_name,image')->from('chats')->join('users','chats.sender_id=users.user_id','LEFT')->WHERE('chats.receiver_id',$vendor_id)->group_by('chats.sender_id')->order_by('chats.date DESC')->get()->result_array();
		}
		public function update_profile($data,$userid){
		$this->db->where('user_id',$userid)->update('users',$data);
		return TRUE;
	}
	//for change password
	public function change_password($data = ''){
        $oldpwd = base64_encode($data['old_pass']);
        $user_id=$data['user_id'];
       	$query = $this->db->get_where('users',array('user_id'=>$user_id))->row_array();
        if( $this->check_password($oldpwd,$query['password'])){
        	$this->db->set('password',$data['new_pass']);
            $this->db->where('user_id',$user_id);
            $update=$this->db->update('users');
            if($update){
                return 201;
            }
                    
        }else{
            return  202;    
        }
        
    }
    public function check_password($new, $password ){
        if( $new==$password){
            return TRUE;
        }else { 
            return FALSE;
        }
    }
    public function delete_gallery($g_id,$vendor_id){
    	$this->db->where('g_id',$g_id)->where('vendor_id',$vendor_id)->delete('vendor_gallery');
    }
    public function get_vendor_gallery($vendor_id){
    	return $this->db->where('vendor_id',$vendor_id)->get('vendor_gallery')->result_array();
    }
    public function add_job($data){
    	$data['price'] = $this->get_jobprice($data['services'],$data['vendor_id'])['price'];
    	if($data['price']){
    		$res = $this->db->insert('jobs',$data);
    		return $this->db->insert_id();
    	}else{
    		return FALSE;
    	}
    	
    }
    public function get_jobprice($services,$vendor_id){
    	return $this->db->select('SUM(price) as price')->where('user_id',$vendor_id)->where_in('service_id',$services,FALSE)->get('vendor_services')->row_array();
    }
    public function edit_job($job_id,$data){
    	$data['price'] = $this->get_jobprice($data['services'],$data['vendor_id'])['price'];
    	if($data['price']){
    		$this->db->set($data)->where('job_id',$job_id)->update('jobs');	
    		return $this->db->affected_rows();
    	}else{
    		return FALSE;
    	}
    	
    }
    public function update_device($data,$user_id){
    	$array = array('device_type'=>$data['device_type'],'device_token'=>$data['device_token'],'last_login'=>date('Y-m-d H:i:s'));
    	$this->db->set($array)->where('user_id',$user_id)->update('users');
    }
    public function job_details($job_id){
    	return $this->db->select('jobs.*,DATE_FORMAT(jobs.booked_date,"%D %M %Y  %h:%i %p") as booked_date,users.user_name,users.shop_name,users.shop_image')->from('jobs')->join('users','jobs.vendor_id=users.user_id','LEFT')->where('jobs.job_id',$job_id)->get()->row_array();
    	//return $this->db->where('job_id',$job_id)->get('jobs')->row_array();
    }
    public function job_sercies($services){
    	//return $this->db->select('vs.*, s.service_name_en,s.service_name_ar')->from('vendor_services as vs')->join('services as s','vs.service_id=s.id')->where_in('vs.service_id',$services)->get()->result_array();
    	return $this->db->where_in('id',$services,FALSE)->get('services')->result_array();
    }
    //common delete
    public function delete($column_name,$id,$table){
    	$this->db->where($column_name,$id)->delete($table);
    }
    public function bid_details($bid_id){
    	return $this->db->where('b_id',$bid_id)->get('bids')->row_array();
    }
    public function bid_images($bid_id){
    	return $this->db->where('b_id',$bid_id)->get('bid_images')->result_array();
    }
    public function get_user_jobs($user_id){
    	return $this->db->select('jobs.*,users.user_name as vendor_name, users.shop_name')->from('jobs')->join('users','jobs.vendor_id=users.user_id','LEFT')->where('jobs.user_id',$user_id)->order_by('job_id desc')->get()->result_array();
    }
    public function get_user_bids($user_id){
    	return $this->db->where('user_id',$user_id)->get('bids')->result_array();
    }
    public function get_minmaxprice(){
    	return $this->db->select("min(price) as minimum, max(price) as maximum")->get('vendor_services')->row_array();
    }
    public function get_vendor_jobs($data){
    	if($data['distance']=="" && $data['services']==""){
    		return $this->db->select('jobs.*,users.user_name')->from('jobs')->join('users','jobs.user_id=users.user_id','LEFT')->where('jobs.vendor_id',$data['user_id'])->get()->result_array();
    	} else if ($data['distance']!="" && $data['services']==""){
    		return $this->db->select("jobs.*, ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( '".$data['latitude']."' ) ) + COS( RADIANS( `latitude` ) )
        * COS( RADIANS( '".$data['latitude']."' )) * COS( RADIANS( `longitude` ) - RADIANS( '".$data['longitude']."' )) ) * 6380 AS distance")->from('jobs')->where('jobs.vendor_id',$data['user_id'])->where("ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( '".$data['latitude']."' ) ) + COS( RADIANS( `latitude` ) )
        * COS( RADIANS( '".$data['latitude']."' )) * COS( RADIANS( `longitude` ) - RADIANS( '".$data['longitude']."' )) ) * 6380 <",$data['distance'])->get()->result_array();
    	}
    	else  if( $data['distance']=="" && $data['services']!=""){
    		return $this->db->select('jobs.*,users.user_name')->from('jobs')->join('users','jobs.user_id=users.user_id','LEFT')->where('jobs.vendor_id',$data['user_id'])->where_in('jobs.services',$data['services'],FALSE)->get()->result_array();
    	}
    	else if($data['distance']!="" && $data['services']!=""){
    		return $this->db->select("jobs.*, ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( '".$data['latitude']."' ) ) + COS( RADIANS( `latitude` ) )
        * COS( RADIANS( '".$data['latitude']."' )) * COS( RADIANS( `longitude` ) - RADIANS( '".$data['longitude']."' )) ) * 6380 AS distance")->from('jobs')->where('jobs.vendor_id',$data['user_id'])->where_in('services',$data['services'],FALSE)->where("ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( '".$data['latitude']."' ) ) + COS( RADIANS( `latitude` ) )
        * COS( RADIANS( '".$data['latitude']."' )) * COS( RADIANS( `longitude` ) - RADIANS( '".$data['longitude']."' )) ) * 6380 <",$data['distance'])->get()->result_array();
    			return $this->db->last_query();
    	}
      	
    }

    //vendor job list
    public function vendor_joblist($vendor_id,$status){
    	return $this->db->select('jobs.*,DATE_FORMAT(jobs.booked_date,"%D %M %Y  %h:%i %p") as booked_date,users.user_name')->from('jobs')->join('users','jobs.user_id=users.user_id','LEFT')->where('jobs.vendor_id',$vendor_id)->where('jobs.status',$status)->order_by('job_id desc')->get()->result_array(); 
    }
    //get services names
    public function get_job_services($services){
    	return $this->db->select('GROUP_CONCAT(service_name_en) as services')->where_in('id',$services,FALSE)->get('services')->row_array();
    }
    // user and sender details by jobid
    public function userdetails_byjobid($job_id){
    	return $this->db->select('jobs.vendor_id,users.user_id,users.user_name,users.device_type,users.device_token')->from('jobs')->join('users','jobs.user_id=users.user_id','LEFT')->where('jobs.job_id',$job_id)->get()->row_array();
    }
    //complete the job
    public function complete_job($job_id){
    	$data = array('status'=>3,'completed_date'=>date('Y-m-d'));
    	$this->db->set($data)->where('job_id',$job_id)->where('status!=',4)->update('jobs');
    	return $this->db->affected_rows();
    }
    //review submit
    public function submit_rating($rating,$review,$review_heading,$job_id){
    	$data = array('rating'=>$rating,'review'=>$review,'review_heading'=>$review_heading);
    	$this->db->set($data)->where('job_id',$job_id)->where('rating',0)->update('jobs');
    }
    //get auctions for bid
    public function get_auctions_bybid($bid_id){
    	return $this->db->select('ba.*,u.user_name,u.shop_name,u.shop_image')->from('bid_auctions as ba')->join('users as u', 'u.user_id=ba.vendor_id','LEFT')->where('bid_id',$bid_id)->get()->result_array();
    }
    //save data
    public function save_data($table,$data){
        $this->db->insert($table,$data);
        return $this->db->last_query();
    }
    //get data
    public function get_data($table,$column_name,$id){
        return $this->db->where($column_name,$id)->get($table)->row_array();
    }
    //job details for vendor
    public function job_details_vendor($job_id){
        return $this->db->select('jobs.*,DATE_FORMAT(jobs.booked_date,"%D %M %Y  %h:%i %p") as booked_date,users.user_name,users.image')->from('jobs')->join('users','jobs.user_id=users.user_id','LEFT')->where('jobs.job_id',$job_id)->get()->row_array();
    }
    //vendor bids by status
    public function get_vendor_bids($vendor_id,$status){
        return $this->db->where('vendor_id',$vendor_id)->where_in('status',$status,FALSE)->get('bid_auctions')->result_array();
    }
    //get all bids
    public function get_allbids(){
        return $this->db->select("bids.*,users.user_name")->join('users','bids.user_id=users.user_id','LEFT')->where('bids.status',0)->get('bids')->result_array();
    }
    //for home screen change
    public function get_allserviceproviders($data){
        return $this->db->select("users.*,ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( '".$data['latitude']."' ) ) + COS( RADIANS( `latitude` ) )
        * COS( RADIANS( '".$data['latitude']."' )) * COS( RADIANS( `longitude` ) - RADIANS( '".$data['longitude']."' )) ) * 6380 AS `distance`")->from('users')->where_in('auth_level','2,3,4', FALSE)->order_by('distance')->get()->result_array();
    }
    // for bankd etails 
    public function edit_bank($bank_id,$data){
        $this->db->set($data)->where('id',$bank_id)->update('bank_details'); 
        return $this->db->affected_rows();
    }
    // for add banbk 
     public function add_bank($data){
        $res = $this->db->insert('bank_details',$data);
        return $this->db->insert_id(); 
    }




}