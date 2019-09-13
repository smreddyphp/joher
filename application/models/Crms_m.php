<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Crms_m extends CI_Model 
	{
		
		public function get_category_names($id='')
		{
			if($id){
				return $this->db->select('*')->from('category_adds')->where('id',$id)->get()->row_array();
			}else{
				return $this->db->select('*')->from('category_adds')->get()->result_array();
			}
		}
		public function get_user_data($id='')
		{
			if($id){
				return $this->db->select('*')->from('users')->where('user_id',$id)->order_by('user_id','desc')->get()->row_array();
			}else{
				return $this->db->select('*')->from('users')->where('auth_level','1')->order_by('user_id','desc')->get()->result_array();
			}
		}
		
		public function get_client_data($id='')
		{
			if($id){
				return $this->db->select('*')->from('user_info')->where('user_id',$id)->order_by('user_id','desc')->get()->row_array();
			}else{
				return $this->db->select('*')->from('user_info')->where('auth_level','1')->order_by('user_id','desc')->get()->result_array();
			}
		}

		public function get_suplier_data($id='')
		{
			if($id)
			{
				return $this->db->select('*')->from('suppliers')->get()->result_array();
				//echo $this->db->last_query(); exit;
			}else{
				return $this->db->select('*')->from('suppliers')->get()->result_array();
			}
		}
		
		
/*
		public function get_suplier_data($id='')
		{
			if($id){
				return $this->db->select('*')->from('users')->where('user_id',$id)->order_by('user_id','desc')->get()->row_array();
			}else{
				return $this->db->select('*')->from('users')->where('auth_level','3')->order_by("user_id", "desc")->get()->result_array();
			}
		}*/
        public function get_cities_details($uid=""){
			if($uid){
				return $this->db->select('*')->from('cities')->where('name',$uid)->get()->row();
			}else{
				return $this->db->select('*')->from('cities')->where('name',$this->session->userdata('id'))->get()->row();
			}
		}

		public function get_user_details($uid=""){
			if($uid){
				return $this->db->select('*')->from('users')->where('user_id',$uid)->get()->row();
			}else{
				return $this->db->select('*')->from('users')->where('user_id',$this->session->userdata('user_id'))->get()->row();
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
		
		public function get_hotel_data($id=''){
			if($id)
			{
				/*$this->db->select('h.*,u.email');
				$this->db->join('users as u','u.user_id=h.user_id');
			   return $this->db->get_where('hotel_vila_apartment as h')->row_array();*/
			    return $this->db->select('*')->from('hotel_vila_apartment')->where('id',$id)->get()->row_array();
			}
			else
			{
				return $this->db->select('*')->from('hotel_vila_apartment')->order_by('id','desc')->get()->result_array();
			}
		}
		
		public function get_air_train_data($id=''){
			if($id){
				return $this->db->select('*')->from('air_train')->where('id',$id)->order_by('id','desc')->get()->row_array();
			}else{
			 return $this->db->select('*')->from('air_train')->order_by('id','desc')->get()->result_array();
			 //echo $this->db->last_query();exit;
			 
			}
		}

		public function get_air_craft_data($id=''){
			if($id){
				return $this->db->select('*')->from('air_craft')->where('id',$id)->order_by('id','desc')->get()->row_array();
			}else{
				return $this->db->select('*')->from('air_craft')->order_by('id','desc')->get()->result_array();
			}
		}

		public function get_driver_security_data($id=''){
			if($id){
				return $this->db->select('*')->from('driver_security')->where('id',$id)->order_by('id','desc')->get()->row_array();
			}else{
				return $this->db->select('*')->from('driver_security')->order_by('id','desc')->get()->result_array();
			}
		}

		public function get_boat_data($id=''){
			if($id){
				return $this->db->select('*')->from('boat')->where('id',$id)->order_by('id','desc')->get()->row_array();
			}else{
				return $this->db->select('*')->from('boat')->order_by('id','desc')->get()->result_array();
			}
		}
		
		public function get_company_data($id=''){
			if($id){
				return $this->db->select('*')->from('company_fees')->where('id',$id)->order_by('id','desc')->get()->row_array();
			}else{
				return $this->db->select('*')->from('company_fees')->order_by('id','desc')->get()->result_array();
			}
		}

		public function get_cruise_data($id=''){
			if($id){
				return $this->db->select('*')->from('cruise')->where('id',$id)->order_by('id','desc')->get()->row_array();
			}else{
				return $this->db->select('*')->from('cruise')->order_by('id','desc')->get()->result_array();
			}
		}

		public function get_cargo_data($id=''){
			if($id){
				return $this->db->select('*')->from('cargo')->where('id',$id)->order_by('id','desc')->get()->row_array();
			}else{
				return $this->db->select('*')->from('cargo')->order_by('id','desc')->get()->result_array();
			}
		}

		public function get_crm_event_data($id=''){
			if($id){
				return $this->db->select('*')->from('crm_event')->where('id',$id)->order_by('id','desc')->get()->row_array();
			}else{
				return $this->db->select('*')->from('crm_event')->order_by('id','desc')->get()->result_array();
			}
		}

		public function get_miscellaneous_data($id=''){
			if($id){
				return $this->db->select('*')->from('miscellaneous')->where('id',$id)->order_by('id','desc')->get()->row_array();
			}else{
				return $this->db->select('*')->from('miscellaneous')->order_by('id','desc')->get()->result_array();
			}
		}

		public function get_trip_user_data($id=''){
			if($id){
				return $this->db->select('*')->from('trip')->where('user_id',$id)->order_by('id','desc')->get()->result_array();
			}else{
				return $this->db->select('*')->from('trip')->order_by('id','desc')->get()->result_array();
			}
		}
		public function get_trip_data($value = '',$id=''){
			if($id)
			{
				return $this->db->select('*')->from('trip')->where(array('id'=>$id))->order_by('id','desc')->get()->row_array();
			}else if($value)
			{
				return $this->db->select('*')->from('trip')->where('id',$id)->order_by('id','desc')->get()->result_array();
			}
			else
			{
				return $this->db->select('*')->from('trip')->get()->result_array();
			}
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
		public function get_alljobs(){
        	return $this->db->select('jobs.*,users.user_name as vendor_name')->join('users','users.user_id = jobs.vendor_id','LEFT')->order_by('job_id', 'desc')->get('jobs')->result_array();
        }
        public function get_job_services($services){
    		return $this->db->select('GROUP_CONCAT(service_name_en) as services')->where_in('id',$services,FALSE)->get('services')->row_array();
    	}
		public function get_allbids(){
        	return $this->db->select('bids.*,users.user_name')->join('users','users.user_id = bids.user_id','LEFT')->order_by('b_id','desc')->get('bids')->result_array();
        }
        public function job_details($job_id){
          return $this->db->select('jobs.*,DATE_FORMAT(jobs.booked_date,"%D %M %Y  %h:%i %p") as booked_date,users.user_name,users.shop_name,users.shop_image')->from('jobs')->join('users','jobs.vendor_id=users.user_id','LEFT')->where('jobs.job_id',$job_id)->get()->row_array();
        }
        public function bid_details($bid_id){
            return $this->db->select('bids.*,users.user_name')->join('users','users.user_id = bids.user_id','LEFT')->where('b_id',$bid_id)->get('bids')->row_array();
        }
        public function bid_images($bid_id){
            return $this->db->where('b_id',$bid_id)->get('bid_images')->result_array();
        }
        public function get_vendorjobs($vendor_id){
           return $this->db->select('jobs.*,users.user_name')->from('jobs')->join('users','jobs.vendor_id=users.user_id','LEFT')->where('jobs.vendor_id',$vendor_id)->get()->result_array();
        }
        public function get_vendorbids($vendor_id){
           return $this->db->where('vendor_id',$vendor_id)->get('bid_auctions')->result_array();
        }
		public function get($table,$id=""){
			if($id){
				return $this->db->select('*')->from($table)->where('id',$id)->get()->row_array();
			}else{
				return $this->db->get($table)->result_array();
			}
			
		}
		
		//10 tables fetch coding
		
		public function get_air_train_user_data($id='',$trip='',$t='')
		{
		    if($t == 'trip')
		    {
		        return $this->db->select('*')->from('air_train')->where('trip_id',$trip)->get()->result_array();
		    }
		    else if($id && $trip)
		    {
		        return $this->db->select('*')->from('air_train')->where('user_id',$id)->where('urgency_level !=',0)->where('trip_id',$trip)->get()->result_array();
		    }
			else if($id)
			{
				return $this->db->select('*')->from('air_train')->where('user_id',$id)->get()->result_array();
			}else{
				return $this->db->select('*')->from('air_train')->get()->result_array();
			}
		}

		
		public function get_hotel_user_data($id='',$trip='',$t='')
		{
		    if($t == 'trip')
		    {
		        return $this->db->select('*')->from('hotel_vila_apartment')->where('trip_id',$trip)->get()->result_array();
		    }
		    else if($id && $trip)
		    {
		        return $this->db->select('*')->from('hotel_vila_apartment')->where('user_id',$id)->where('trip_id',$trip)->where('urgency_level !=',0)->get()->result_array();
		    }
			else if($id)
			{
				return $this->db->select('*')->from('hotel_vila_apartment')->where('user_id',$id)->get()->result_array();
			}
			else 
			{
				return $this->db->select('*')->from('hotel_vila_apartment')->order_by('id','desc')->get()->result_array();
			}
		}
		
		

		public function get_air_craft_user_data($id='',$trip='',$t='')
		{
		    if($t == 'trip')
		    {
		        return $this->db->select('*')->from('air_craft')->where('trip_id',$trip)->get()->result_array();
		    }
		    else if($id && $trip)
		    {
		        return $this->db->select('*')->from('air_craft')->where('user_id',$id)->where('urgency_level !=',0)->where('trip_id',$trip)->get()->result_array();
		    }
			else if($id){
				return $this->db->select('*')->from('air_craft')->where('user_id',$id)->get()->result_array();
			}else{
				return $this->db->select('*')->from('air_craft')->get()->result_array();
			}
		}

		public function get_boat_user_data($id='',$trip='',$t='')
		{
		    if($t == 'trip')
		    {
		        return $this->db->select('*')->from('boat')->where('trip_id',$trip)->get()->result_array();
		    }
		    else if($id && $trip)
		    {
		        return $this->db->select('*')->from('boat')->where('user_id',$id)->where('urgency_level !=',0)->where('trip_id',$trip)->get()->result_array();
		    }else if($id){
				return $this->db->select('*')->from('boat')->where('user_id',$id)->get()->result_array();
			}else{
				return $this->db->select('*')->from('boat')->get()->result_array();
			}
		} 
        
		public function get_cargo_user_data($id='',$trip='',$t='')
		{
		    if($t == 'trip')
		    {
		        return $this->db->select('*')->from('cargo')->where('trip_id',$trip)->get()->result_array();
		    }
		    else if($id && $trip)
		    {
		        return $this->db->select('*')->from('cargo')->where('user_id',$id)->where('urgency_level !=',0)->where('trip_id',$trip)->get()->result_array();
		    }else if($id){
				return $this->db->select('*')->from('cargo')->where('user_id',$id)->get()->result_array();
			}else{
				return $this->db->select('*')->from('cargo')->get()->result_array();
			}
		}
		
		
		public function get_cruise_user_data($id='',$trip='',$t='')
		{
		    if($t == 'trip')
		    {
		        return $this->db->select('*')->from('cruise')->where('trip_id',$trip)->get()->result_array();
		    }
		    else if($id && $trip)
		    {
		        	return $this->db->select('*')->from('cruise')->where('user_id',$id)->where('urgency_level !=',0)->where('trip_id',$trip)->get()->result_array();
		    }
			else if($id){
				return $this->db->select('*')->from('cruise')->where('user_id',$id)->get()->result_array();
			}else{
				return $this->db->select('*')->from('cruise')->get()->result_array();
			}
		}
		
		public function get_driver_user_data($id='',$trip='',$t='')
		{
		    if($t == 'trip')
		    {
		        return $this->db->select('*')->from('driver_security')->where('trip_id',$trip)->get()->result_array();
		    }
		    else if($id && $trip)
		    {
		        	return $this->db->select('*')->from('driver_security')->where('user_id',$id)->where('urgency_level !=',0)->where('trip_id',$trip)->get()->result_array();
		    }
			else if($id){
				return $this->db->select('*')->from('driver_security')->where('user_id',$id)->get()->result_array();
			}else{
				return $this->db->select('*')->from('driver_security')->get()->result_array();
			}
		}
		
		
		public function get_event_user_data($id='',$trip='',$t='')
		{
		    if($t == 'trip')
		    {
		        return $this->db->select('*')->from('crm_event')->where('trip_id',$trip)->get()->result_array();
		    }
		    else if($id && $trip)
		    {
		        	return $this->db->select('*')->from('crm_event')->where('user_id',$id)->where('urgency_level !=',0)->where('trip_id',$trip)->get()->result_array();
		    }
			else if($id){
				return $this->db->select('*')->from('crm_event')->where('user_id',$id)->get()->result_array();
			}else{
				return $this->db->select('*')->from('crm_event')->get()->result_array();
			}
		}
		
        public function get_miscellaneous_user_data($id='',$trip='',$t='')
		{
		    if($t == 'trip')
		    {
		        return $this->db->select('*')->from('miscellaneous')->where('trip_id',$trip)->get()->result_array();
		    }
		    else if($id && $trip)
		    {
		        	return $this->db->select('*')->from('miscellaneous')->where('user_id',$id)->where('urgency_level !=',0)->where('trip_id',$trip)->get()->result_array();
		    }
		    else if($id)
		    {
				return $this->db->select('*')->from('miscellaneous')->where('user_id',$id)->get()->result_array();
			}else
			{
				return $this->db->select('*')->from('miscellaneous')->get()->result_array();
			}
		}
		
		public function get_company_user_data($id='',$trip='',$t='')
		{
		    if($t == 'trip')
		    {
		        return $this->db->select('*')->from('company_fees')->where('trip_id',$trip)->get()->result_array();
		    }
		    else if($id && $trip)
		    {
		        return $this->db->select('*')->from('company_fees')->where('user_id',$id)->where('urgency_level !=',0)->where('trip_id',$trip)->get()->result_array();
		    }else if($id){
				return $this->db->select('*')->from('company_fees')->where('user_id',$id)->get()->result_array();
			}else{
				return $this->db->select('*')->from('company_fees')->get()->result_array();
			}
		}

	public function insert_csv($data) {
        $this->db->insert('users', $data);

    }
    public function get_class_type($id=''){
			if($id){
				return $this->db->select('*')->from('class_type')->where('id',$id)->order_by('id','desc')->get()->row_array();
				//echo $this->db->last_query(); exit;
			}else{
				return $this->db->select('*')->from('class_type')->order_by("id", "desc")->get()->result_array();
			}
			
		}


	public function get_airlines_choice($id=''){
			if($id){
				return $this->db->select('*')->from('airline_choice')->where('id',$id)->order_by('id','desc')->get()->row_array();
				//echo $this->db->last_query(); exit;
			}else{
				return $this->db->select('*')->from('airline_choice')->order_by("id", "desc")->get()->result_array();
			}
			
		}	
		public function get_hotel_chain_choice($id=''){
			if($id){
				return $this->db->select('*')->from('hotel_chain')->where('id',$id)->order_by('id','desc')->get()->row_array();
				//echo $this->db->last_query(); exit;
			}else{
				return $this->db->select('*')->from('hotel_chain')->order_by("id", "desc")->get()->result_array();
			}
			
		}

		public function get_city($id=''){
			if($id){
				return $this->db->select('*')->from('city')->where('id',$id)->order_by('id','desc')->get()->row_array();
				//echo $this->db->last_query(); exit;
			}else{
				return $this->db->select('*')->from('city')->order_by("id", "desc")->get()->result_array();
			}
			
		}
		public function get_local_city($id=''){
			if($id){
				return $this->db->select('*')->from('local_city')->where('id',$id)->order_by('id','desc')->get()->row_array();
				//echo $this->db->last_query(); exit;
			}else{
				return $this->db->select('*')->from('local_city')->order_by("id", "desc")->get()->result_array();
			}
			
		}
		public function get_car_choice($id=''){
			if($id){
				return $this->db->select('*')->from('car_choice')->where('id',$id)->order_by('id','desc')->get()->row_array();
				//echo $this->db->last_query(); exit;
			}else{
				return $this->db->select('*')->from('car_choice')->order_by("id", "desc")->get()->result_array();
			}
			
		}

		public function get_invoice_data($id=''){
			if($id){
				return $this->db->select('*')->from('invoice')->where('id',$id)->get()->row_array();
				//echo $this->db->last_query(); exit;
			}else{
				return $this->db->select('*')->from('invoice')->order_by("id", "desc")->get()->result_array();
			}
			
		}
	public function get_documents($id='',$doc=''){
			if($id){
				return $this->db->select('*')->from('documents')->where('user_id',$id)->where('type',$doc)->order_by('id','desc')->get()->result_array();
				//echo $this->db->last_query(); exit;
			}else{
				return $this->db->select('*')->from('documents')->order_by("id", "desc")->get()->result_array();
			}
			
		}
		
		public function get_documents_using_id($id='')
		{
			if($id){
				return $this->db->select('*')->from('documents')->where('id',$id)->get()->row_array();
				//echo $this->db->last_query(); exit;
			}else{
				return $this->db->select('*')->from('documents')->order_by("id", "desc")->get()->result_array();
			}
			
		}
		
		public function get_fcr($id='')
		{
			if($id)
			{
				return $this->db->select('*')->from('FCR')->where('id',$id)->get()->row_array();
				//echo $this->db->last_query(); exit;
			}
			else
			{
				return $this->db->select('*')->from('FCR')->order_by("id", "desc")->get()->result_array();
			}
			
		}
		
}