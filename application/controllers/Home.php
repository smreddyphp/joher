<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("Asia/Calcutta"); 
    }

	public function index()
	{
		if($this->session->userdata('auth_level'))
		{ 
			redirect('admin/index');
		}else{
		   $this->load->view('login1');
		}
		
	}
	//login function
	public function login()
	{
		$data = $this->input->post('data');
		$data1 = $this->input->post('data');
		$data2 = $this->input->post('data');
		
		if($data)
		{
		    $data['password'] = base64_encode($data['password']);
			$data['auth_level']=9;
			$auth_data = $this->db->select("*")->from('users')->where($data)->get()->row_array();
			
			$data1['password'] = base64_encode($data1['password']);
			$data1['auth_level']=6;
			$auth_data1 = $this->db->select("*")->from('users')->where($data1)->get()->row_array();
			
			$data2['password'] = base64_encode($data2['password']);
			$data2['auth_level']=8;
			$auth_data2 = $this->db->select("*")->from('users')->where($data2)->get()->row_array();
		    //echo $this->db->last_query();
			
			if($auth_data)
			{
				$this->session->set_userdata('username',$auth_data['user_name']);
				$this->session->set_userdata('email',$auth_data['email']);
				$this->session->set_userdata('auth_level',$auth_data['auth_level']);
				$this->session->set_userdata('role',$auth_data['role']);
				$this->session->set_userdata('user_id',$auth_data['user_id']);
				//if user is admin redirect to admin page
				if($auth_data['auth_level']==9)
				{
					redirect("admin/index");
				}
			}
			else if($auth_data2)
			{
			    $this->session->set_userdata('username',$auth_data2['user_name']);
				$this->session->set_userdata('email',$auth_data2['email']);
				$this->session->set_userdata('auth_level',$auth_data2['auth_level']);
				$this->session->set_userdata('role',$auth_data2['role']);
				$this->session->set_userdata('user_id',$auth_data2['user_id']);
				
				if($auth_data2['login_status'] == 0)
			    {
    				//if user is admin redirect to admin page
    				if($auth_data2['auth_level']==8)
    				{
    				    $date = date('Y-m-d h:i:s');
    				    
    				    $ip_address =  $this->input->ip_address();
    				    $this->db->where('user_id',$auth_data2['user_id']);
    				    $this->db->update('users',array('off_on_line'=>1,'free_busy'=>1,'login_status'=>1,'ip_address'=>$ip_address,'last_login'=>$date));
    				    
    				    $data = array('user_id'=>$auth_data2['user_id'],'last_login'=>$date,'ip_address'=>$ip_address);
    				    $this->db->insert('login_info',$data);
    				    
    					redirect("admin/index");
    				}
			    }           
			    else
			    {
	                    $e_data['error'] = "You Have Al-ready Login Another System";
		                $this->load->view('login1', $e_data);
			    }          
			    
			}
			else if($auth_data1)
			{
			    if($auth_data1['status'] == 'active')
			    {
			    
			    $flag ='';
			    @$working_day=unserialize(@$auth_data1['working_day']);
			    if(@$working_day)
			    {
			    
			    
			   
			    if(in_array(0, @$working_day))
			    {
			        $flag = (date("l")=='Monday')?1:0;
			        if($flag)
			        {
			            goto end;
			        }
			    }
			    
			    if(in_array(1, @$working_day))
			    {
			        $flag = (date("l")=='Tuesday')?1:0;
			        if($flag)
			        {
			            goto end;
			        }
			    }
			    
			    if(in_array(2, @$working_day))
			    {
			        $flag = (date("l")=='Wednesday')?1:0;
			        if($flag)
			        {
			            goto end;
			        }
			    }
			    
			    if(in_array(3, @$working_day))
			    {
			        $flag = (date("l")=='Thursday')?1:0; 
			        if($flag)
			        {
			            goto end;
			        }
			       
			    }
			    
			    if(in_array(4, @$working_day))
			    {
			       $flag = (date("l")=='Friday')?1:0;  
			       if($flag)
			        {
			            goto end;
			        }
			    }
			    
			    if(in_array(5, @$working_day))
			    {
			       $flag = (date("l")=='Saturday')?1:0;   
			       if($flag)
			        {
			            goto end;
			        }
			    }
			    
			    if(in_array(6, @$working_day))
			    {
			       $flag = (date("l")=='Sunday')?1:0;
			       if($flag)
			        {
			            goto end;
			        }
			    }
			    
			    }
			    else
			    {
			        $flag =0;
			        goto end;
			    }
			    
			    
		        end:
			    if($flag==1)
			    {
			        
			        if(strtotime(date('h:i A')) >= strtotime($auth_data1['form_hours']) && strtotime(date('h:i A')) <= strtotime($auth_data1['to_hours']))
			        {
			                //echo "login";
			                //echo '<br/>'.$form_hours.'or'.$to_hours; 
			                
			                if($auth_data1['login_status'] == 0)
			                {
                			    $this->session->set_userdata('username',$auth_data1['user_name']);
                				$this->session->set_userdata('email',$auth_data1['email']);
                				$this->session->set_userdata('auth_level',$auth_data1['auth_level']);
                				$this->session->set_userdata('role',$auth_data1['role']);
                				$this->session->set_userdata('user_id',$auth_data1['user_id']);
                				//if user is admin redirect to admin page
                				if($auth_data1['auth_level']==6)
                				{
                				    $date = date('Y-m-d h:i:s');
                				    
                				    $ip_address =  $this->input->ip_address();
                				    $this->db->where('user_id',$auth_data1['user_id']);
                				    $this->db->update('users',array('off_on_line'=>1,'free_busy'=>1,'login_status'=>1,'ip_address'=>$ip_address,'last_login'=>$date));
                				    
                				    $data = array('user_id'=>$auth_data1['user_id'],'last_login'=>$date,'ip_address'=>$ip_address);
                				    $this->db->insert('login_info',$data);
                				    
                					redirect("admin/index");
                				}
            				
			                }
			                else
			                {
			                    $e_data['error'] = "You Have Al-ready Login Another System";
				                $this->load->view('login1', $e_data);
			                }
			        }
			        else
			        {
			                $e_data['error'] = "Your Time is over";
				            $this->load->view('login1', $e_data);
			        }
			        
			    }
			    else
			    {
			        $e_data['error'] = "you are not eligible for login this day!";
				    $this->load->view('login1', $e_data);
			    }
			}  
			 else
			 {
			      $e_data['error'] = "Your status is In-active!";
				  $this->load->view('login1', $e_data);
			 }
			    
			  
			}
			else
			{
				$e_data['error'] = "Please check login credentials";
				$this->load->view('login1', $e_data);
			}
		}
		else
		{
				$this->load->view('login1');
		}
		
	}
	
	public function logout()
	{
	    
	    if($this->session->userdata('auth_level') == 6)
		{
		    $this->db->where('user_id',$this->session->userdata('user_id'));
            $this->db->update('users',array('off_on_line'=>2,'login_status'=>0));
		}
	    else if($this->session->userdata('auth_level') == 8)
		{
		    $this->db->where('user_id',$this->session->userdata('user_id'));
            $this->db->update('users',array('off_on_line'=>2,'login_status'=>0));
		}
	    
		$this->session->sess_destroy();
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('auth_level');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('user_id');
		
		
		redirect('home/index');
	}
	
	public function forgot_password(){
		$this->load->library('parser');
		if($this->input->post('email')){
			$email = $this->input->post('email');
			$user_data = $this->db->where('email',$email)->get('users')->row_array();
			if($user_data){
				if($user_data['status']=='active'){
					// Set the link protocol
					$link_protocol =  NULL;
					// Set URI of link
					$link_uri = 'home/recovery_verification/' .$user_data['user_id'];
					$view_data['special_link'] = anchor( 
						site_url( $link_uri, $link_protocol ), 
						site_url( $link_uri, $link_protocol ), 
						'target ="_blank"' 
					);
					$template_data['special_link'] = isset($view_data['special_link']) ? $view_data['special_link'] : "";
					$template_data['user_name'] = isset($user_data['username']) ? $user_data['username'] : "";
			
					$message = $this->parser->parse("forgot_pwd_template.html", $template_data, TRUE);
					$mail = send_mail($this->input->post('email'),'Password Recovery',$message);
					$this->session->set_flashdata('success','Congratulations ! We have sent you an email with instructions on how to recover your account.');
					$this->load->view('forgot-password.php');

				}else{
					$this->session->set_flashdata('error','Your account is in-active please contact admin');
					$this->load->view('forgot-password.php');
				}
			}else{
				$this->session->set_flashdata('error','No records found for the given email');
				$this->load->view('forgot-password.php');
			}
		}else{
			$this->load->view('forgot-password.php');
		}
	}
	
	public function recovery_verification($uid=""){
		$data = $this->input->post();
		//for updating
		if($data){
			$u_data['data'] = $this->common_m->get_user_details($data['uid']);
			if($data['password']==$data['cnf_password']){
				if (!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9@$!%*#?&]{8,20}$/",$data['password'] )) {
					$this->session->set_flashdata('error','Please Ensure that you have at least one lower case letter, one upper case letter, one digit and minimum length 8 characters');
				}else{
					$uid = $data['uid'];
					$pwd = base64_encode($data['password']);
					$this->db->SET('password',$pwd)->where('user_id',$uid)->update('users');
					$this->session->set_flashdata('success',"Password changed successfully.Please login");
				}
			}else{
				$this->session->set_flashdata('error','Password and confirm password does not match');
			}
			$this->load->view('change_password.php',$u_data);

		}else{
			$u_data['data'] = $this->common_m->get_user_details($uid);
			if($u_data['data']){
				if($u_data['data']->status=="inactive"){
					$this->session->set_flashdata('error','Your status is inactive please contact admin');
				}
			}else {
				$this->session->set_flashdata('error','No records found for the user');
			}
			$this->load->view('change_password.php',$u_data);
		}	
	}
	
}
