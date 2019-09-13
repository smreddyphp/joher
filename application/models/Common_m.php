<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Common_m extends CI_Model 
	{
		public function get_category_adds($id='')
		{// $this->db->order_by("orderType", "asc");
			if($id){
				return $this->db->select('*')->from('category_adds')->where('id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('category_adds')->order_by("orderType", "asc")->get()->result_array();
			}
		}
		
		public function get_user_data($id='')
		{
			if($id){
				return $this->db->select('*')->from('users')->where('id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('users')->where('auth_level','1')->get()->result_array();
			}
		}
		
		public function get_user_details($uid=""){
			if($uid){
				return $this->db->select('*')->from('users')->where('user_id',$uid)->get()->row();
			}else{
				return $this->db->select('*')->from('users')->where('user_id',$this->session->userdata('user_id'))->get()->row();
			}
			
		}
		
		public function get_event_adds($id=""){
			if($id){
				return $this->db->select('*')->from('event')->where('id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('event')->where('status',1)->order_by("id", "desc")->get()->result_array();
			}
			
		}
		
		public function get_wallet_adds($id=""){
			if($id){
				return $this->db->select('*')->from('add_wallet_amount')->where('id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('add_wallet_amount')->where('status',1)->order_by("id", "desc")->get()->result_array();
			}
			
		}
		
		public function get_agent_adds($id=""){
			if($id){
				return $this->db->select('*')->from('users')->where('user_id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('users')->where('auth_level','6')->get()->result_array();
			}
			
		}

		public function get_user_adds($id=""){
			if($id){
				return $this->db->select('*')->from('users')->where('user_id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('users')->where('auth_level','8')->get()->result_array();
			}
			
		}

	public function user_permissions($user_id)
	 {
		return $this->db->get_where('permissions',array('user_id'=>$user_id))->result();
		//echo $this->db->last_query(); exit;
	}

		
		public function get_request_call($id=""){
			if($id){
				return $this->db->select('*')->from('request_call')->where('id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('request_call')->get()->result_array();
			}
			
		}
		
		public function get_user_invoice_data($id,$invoice)
		{
		    if($id && $invoice = 'invoice')
        	{
        	    return $this->db->select('*')->from('invoice')->where('user_id',$id)->where('payment_status',0)->get()->result_array();
        	}
        	else if($id && $invoice = 'order')
        	{
        	    return $this->db->select('*')->from('invoice')->where('user_id',$id)->where('payment_status',1)->get()->result_array();
        	}
        	
		}
		
		public function get_user_order_data($id,$invoice)
		{
             if($id && $invoice = 'order')
        	{
        	    return $this->db->select('*')->from('invoice')->where('user_id',$id)->where('payment_status',1)->get()->result_array();
        	}
        	
		}
		
		public function get_agent_invoice_data($id)
		{
		    return $this->db->select('*')->from('invoice')->where('agent_id',$id)->where('payment_status',0)->get()->result_array();	
		}
		
		public function get_agent_order_data($id)
		{
		    	return $this->db->select('*')->from('invoice')->where('agent_id',$id)->where('payment_status',1)->get()->result_array();
		}
		
	
		
		public function get_invoice_data($id='')
        {
        	if($id)
        	{
        	    if($id=='order')
        	    {
        	        return $this->db->select('*')->from('invoice')->where('agent_id',$this->session->userdata('user_id'))->where('payment_status',1)->get()->result_array();
        	    }
        	    else if($id=='invoice')
        	    {
        	        return $this->db->select('*')->from('invoice')->where('agent_id',$this->session->userdata('user_id'))->where('payment_status',0)->get()->result_array();
        	    }
        	    else
        	    {
        		    return $this->db->select('*')->from('invoice')->where('agent_id',$this->session->userdata('user_id'))->where('id',$id)->get()->row_array();
        	    }
        	}
        	else
        	{
        	    if($this->session->userdata('auth_level') == 9)
        	    {
        		    return $this->db->select('*')->from('invoice')->order_by("id", "desc")->get()->result_array();
        	    }
        	    else
        	    {
        	        return $this->db->select('*')->from('invoice')->where('agent_id',$this->session->userdata('user_id'))->get()->result_array();
        	    }
        	}
        }
		
		public function get_hotel_data($id='')
		{
			if($id)
			{
				return $this->db->select('*')->from('hotel_vila_apartment')->where('id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('hotel_vila_apartment')->order_by("id", "desc")->get()->result_array();
			}
		}
		
		public function get_term_condition()
		{
		     return $this->db->select('*')->from('term_condition')->get()->row_array(); 
		}
		
		public function get_about_us()
		{
		     return $this->db->select('*')->from('about_us')->get()->row_array(); 
		}
		
		public function get_contact_us()
		{
		     return $this->db->select('*')->from('contacts')->order_by("id", "desc")->get()->result_array(); 
		}
		
		public function get_privacy_policy_us()
		{
		    return $this->db->select('*')->from('privacy_policy')->get()->row_array(); 
		}
		
		public function get_services($id='',$type=""){
			if($id){
				return $this->db->select('*')->from('services')->where('id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('services')->where('type',$type)->get()->result_array();
			}
		}
		public function users_count(){
			return $this->db->select('( SELECT COUNT(*) FROM users WHERE auth_level=1 ) AS users , ( SELECT COUNT(*) FROM users WHERE auth_level=2 ) AS individual, ( SELECT COUNT(*) FROM users WHERE auth_level=3) AS autoshop, ( SELECT COUNT(*) FROM users WHERE auth_level=4 ) AS scrapshop')->get()->row_array();
		}
		public function get_monthwise_reg($level){
            $month_array =array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0);
            $d = date('Y');
            $data = $this->db->select('count(user_id) as users,MONTH(created_at) as monthnumber')->where('auth_level',$level)->where('YEAR(created_at)',$d)->GROUP_BY('MONTH(created_at)')->get('users')->result_array();
            foreach($data as $key){
                $month_array[$key['monthnumber']] = $key['users'];
            }
           return implode(" ,",$month_array);
        }
        public function get_users_list($auth_level){
        	return $this->db->where('auth_level',$auth_level)->order_by('user_id','desc')->get('users')->result_array();
        }
        
        public function change_password($data = ''){
            $oldpwd = $data['old_pass'];
            $user_id=$data['user_id'];
            $query = $this->db->get_where('users',array('user_id'=>$user_id))->row();
            $checked_pwd = base64_decode($query->password);
            if( $this->check_passwd($checked_pwd,$oldpwd)){
                $data2['password'] = base64_encode($data['new_pass']);
                $this->db->where('user_id',$user_id);
                $update=$this->db->update('users',$data2);
                if($update){
                    return 201;
                }
                        
            }else{
                return  202;    
            }
            
        }
        
        public function check_passwd($new, $password ){
            if( $new==$password){
                return TRUE;
            }else { 
                return FALSE;
            }
        }
        public function get_jobs($user_id=""){
        	return $this->db->select('jobs.*,users.user_name')->from('jobs')->join('users','jobs.vendor_id=users.user_id','LEFT')->where('jobs.user_id',$user_id)->get()->result_array();
        }
        public function get_bids($user_id=""){
        	return $this->db->where('user_id',$user_id)->get('bids')->result_array();
        }
		
    
        
		public function get($table,$id=""){
			if($id){
				return $this->db->select('*')->from($table)->where('id',$id)->get()->row_array();
			}else{
				return $this->db->get($table)->result_array();
			}
			
		}
		
		public function get_ip_details($table,$id){
		
				return $this->db->select('*')->from($table)->where('user_id',$id)->order_by('id','desc')->get()->result_array();
		}
     
     public function trip_count(){
            return $this->db->select('( SELECT COUNT(*) FROM trip) AS trip')->get()->result();
             //echo $this->db->last_query(); exit;
        }
		
		public function city_count(){
            return $this->db->select('( SELECT COUNT(*) FROM city) AS city')->get()->result();
             //echo $this->db->last_query(); exit;
        }
        public function client_count(){
			return $this->db->select('( SELECT COUNT(*) FROM users WHERE auth_level=1 ) AS client')->get()->result();
		}

		public function get_monthwise_reg1($level){
            $month_array =array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0);
            $d = date('Y');
            $data = $this->db->select('count(user_id) as trip,MONTH(create_date) as monthnumber')->where('YEAR(create_date)',$d)->GROUP_BY('MONTH(create_date)')->get('trip')->result_array();
           // print_r($data); exit;
            foreach($data as $key){
                $month_array[$key['monthnumber']] = $key['trip'];
            }
           return implode(" ,",$month_array);
        }

        public function get_monthwise_reg3($level){
            $month_array =array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0);
            $d = date('Y');
            $data = $this->db->select('count(id) as city,MONTH(insert_date) as monthnumber')->where('YEAR(insert_date)',$d)->GROUP_BY('MONTH(insert_date)')->get('city')->result_array();
           // print_r($data); exit;
            foreach($data as $key){
                $month_array[$key['monthnumber']] = $key['city'];
            }
           return implode(" ,",$month_array);
        }

        public function get_monthwise_reg4($level){
            $month_array =array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0);
            $d = date('Y');
            $data = $this->db->select('count(user_id) as users,MONTH(created_at) as monthnumber')->where('auth_level',1)->where('YEAR(created_at)',$d)->GROUP_BY('MONTH(created_at)')->get('users')->result_array();
            foreach($data as $key){
                $month_array[$key['monthnumber']] = $key['users'];
            }
           return implode(" ,",$month_array);
        }

         public function get_client_name(){
        	return $this->db->where('auth_level',1)->get('users')->result_array();
        }

         public function get_hotel_count(){
            return $this->db->select('( SELECT COUNT(*) FROM hotel_vila_apartment) AS hotel')->get()->result();
             //echo $this->db->last_query(); exit;
        }
        public function get_train_count(){
            return $this->db->select('( SELECT COUNT(*) FROM air_train) AS train')->get()->result();
             //echo $this->db->last_query(); exit;
        }
		public function get_craft_count(){
		            return $this->db->select('( SELECT COUNT(*) FROM air_craft) AS craft')->get()->result();
		             //echo $this->db->last_query(); exit;
		  }
   		public function get_driver_count(){
        return $this->db->select('( SELECT COUNT(*) FROM driver_security) AS driver')->get()->result();
         //echo $this->db->last_query(); exit;
    }
	    public function get_boat_count(){
	        return $this->db->select('( SELECT COUNT(*) FROM boat) AS boat')->get()->result();
	         //echo $this->db->last_query(); exit;
	    }
	    public function get_company_count(){
	        return $this->db->select('( SELECT COUNT(*) FROM company_fees) AS company')->get()->result();
	         //echo $this->db->last_query(); exit;
	    }
		public function get_cruise_count(){
		        return $this->db->select('( SELECT COUNT(*) FROM cruise) AS cruise')->get()->result();
		         //echo $this->db->last_query(); exit;
		 }
		public function get_cargo_count(){
			        return $this->db->select('( SELECT COUNT(*) FROM cargo) AS cargo')->get()->result();
			         //echo $this->db->last_query(); exit;
		 }
		public function get_event_count(){
				        return $this->db->select('( SELECT COUNT(*) FROM crm_event) AS event')->get()->result();
				         //echo $this->db->last_query(); exit;
		}
		public function get_miscellaneous_count(){
				        return $this->db->select('( SELECT COUNT(*) FROM miscellaneous) AS miscellaneous')->get()->result();
				         //echo $this->db->last_query(); exit;
		}

		public function get_hotel_status(){
		    return $this->db->select('status_b')->where("status_b='Cancelled' OR status_b='Closed'")->get('hotel_vila_apartment')->result();
	    }
	    public function get_train_status(){
		    return $this->db->select('status_b')->where("status_b='Cancelled' OR status_b='Closed'")->get('air_train')->result();
	    }
		public function get_craft_status(){
		   return $this->db->select('status_b')->where("status_b='Cancelled' OR status_b='Closed'")->get('air_craft')->result();
	   }
	    public function get_driver_status(){
		 return $this->db->select('status_b')->where("status_b='Cancelled' OR status_b='Closed'")->get('driver_security')->result();
		 }
		public function get_boat_status(){
		  return $this->db->select('status_b')->where("status_b='Cancelled' OR status_b='Closed'")->get('boat')->result();
		 }
	    public function get_company_status(){
		  return $this->db->select('status_b')->where("status_b='Cancelled' OR status_b='Closed'")->get('company_fees')->result();
		 } 
		public function get_cruise_status(){
			return $this->db->select('status_b')->where("status_b='Cancelled' OR status_b='Closed'")->get('cruise')->result();
		 } 
		public function get_cargo_status(){
			return $this->db->select('status_b')->where("status_b='Cancelled' OR status_b='Closed'")->get('cargo')->result();
		}
		public function get_event_status(){
			return $this->db->select('status_b')->where("status_b='Cancelled' OR status_b='Closed'")->get('crm_event')->result();
		} 
		public function get_miscellaneous_status(){
			return $this->db->select('status_b')->where("status_b='Cancelled' OR status_b='Closed'")->get('miscellaneous')->result();
		} 

		public function get_trip_names(){
        	return $this->db->query('SELECT `to`, COUNT(*) as total_trip FROM `trip` GROUP BY `to`')->result_array();

        }
        public function get_trip_status(){
			return $this->db->select('status_b')->get('trip')->result();
		}

}