<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Service extends REST_Controller {

    function __construct()
    {
        //Construct the parent class
        parent::__construct();
        $this->load->model('Mobile_services');
    }
    
    public function getCountryCode_get()
    {
        $this->db->select('phonecode,name');
        $record = $this->db->get('countries')->result();
        $result=["status"=>TRUE, "countriesCode" =>$record];    
        $this->response($result, REST_Controller::HTTP_OK); 
    }
    
    public function registar_post()
    {
        if($this->post('mobile') && $this->post('email') && $this->post('name') && $this->post('password'))
        {
        
        $data2['mobile']        = $this->post('mobile');
        $data1['email']         = $this->post('email');
        
        $data['user_name']      = $this->post('name');
        $data['email']          = $this->post('email');
        $data['mobile']         = $this->post('mobile');
        $data['password']       = base64_encode($this->post('password'));
        $data['device_type']    = $this->post('device_type');
        $data['device_token']   = $this->post('device_token');
		$data['auth_level']     = 1;
		$data['role']           = 'user';
		$data['image']          = 'assets/uploads/user_profiles/default1.png';
		$data['created_at']     = date('Y-m-d h:i:s');
		$auth_data = $this->db->select("*")->from('users')->where($data1)->get()->num_rows();
		$auth_data1 = $this->db->select("*")->from('users')->where($data2)->get()->num_rows();
		if($auth_data == 0)
		{
		    if($auth_data1 ==  0)
		    {
		            //print_r($data);
		            //////////MessageIntigration//////////
		            $data['otp'] = '1234';
		            //////////MessageIntigration//////////
        		    //print_r($data);
        		    $reg = $this->Mobile_services->registarUser($data);
        		    $data['user_id'] = $this->db->insert_id();
                    if($reg)
                    {
                        if($this->post('lang') == 'en')
                        {
                            $result=["status"=>TRUE, "path" => base_url(),"userDetails" => $data,"message"=>"Thank You For Using Joher, Your Registration Successfully Completed"];    
                        }
                        else
                        {
                            $result=["status"=>TRUE, "path" => base_url(),"userDetails" => $data,"message"=>"شكرا لاستخدامكم جوهر .. تم اكمال عملية التسجيل بنجاح"];    
                        }                
                        
                        // print_r($result);exit;
                        $this->response($result, REST_Controller::HTTP_OK); 
                    }
                    else
        			{
        			    
        			    if($this->post('lang') == 'en')
                        {
                             $this->response([
                                'status' => FALSE,
                                'message' => 'Error while saving data',
                             ], REST_Controller::HTTP_OK); 
                        }
                        else
                        {
                             $this->response([
                                'status' => FALSE,
                                'message' => 'يوجدخلل وقت حفظ المعلومات'
                            ], REST_Controller::HTTP_OK); 
                        }
                        
                        
                    }
		            
		    }
		    else
		    {
		        if($this->post('lang') == 'en')
                {
                    $this->response([
                        'status' => FALSE,
                        'message' => 'This Mobile Number already Exists',
                    ], REST_Controller::HTTP_OK);     
                }
                else
                {
                    $this->response([
                        'status' => FALSE,
                        'message' => 'رقم الجوال مسجل',
                    ], REST_Controller::HTTP_OK); 
                }
		    }
		    
		}
		else
		{
		    if($this->post('lang') == 'en')
            {
                 $this->response([
                        'status' => FALSE,
                        'message' => 'This Email already Exists',
                ], REST_Controller::HTTP_OK);    
            }
            else
            {
                $this->response([
                        'status' => FALSE,
                        'message' => 'البريد الالكتروني مسجل',
                ], REST_Controller::HTTP_OK); 
            }
		}
		
        }
        else
        {
            
            if($this->post('lang') == 'en')
            {
                $this->response([
                        'status' => FALSE,
                        'message' => 'Please Enter All Fields!',
                ], REST_Controller::HTTP_OK);        
            }
            else
            {
                $this->response([
                        'status' => FALSE,
                        'message' => 'الرجاء ادخال جميع الخانات',
                ], REST_Controller::HTTP_OK);  
            }
            
        }
	}
		
        
    public function login_post()
    {
        $lang                    = $this->post('lang');
        $data1['email']          = $this->post('email');
        $data1['password']       = base64_encode($this->post('password'));
        $auth_data = $this->db->select("*")->from('users')->where($data1)->get()->row_array();
        if(sizeof($auth_data) > 0)
        {
            $data['device_type'] =  $this->post('device_type');
            $data['device_token'] = $this->post('device_token');
            
            $this->db->where('user_id',$auth_data['user_id']);
            $this->db->update('users',$data);
            
            $this->db->where('user_id',$auth_data['user_id']);
            $this->db->order_by("wid", "desc");
            $query = $this->db->get('add_user_wallet')->row_array();
            if(sizeof($query) > 0)
            {
                $query['amount'] = $query['amount'];
            }
            else
            {
                $query['amount'] = '0';
            }
            
            $msg = ($lang == 'en')? 'Logged in successfully' : 'تم تسجيل الدخول بنجاح';
            $this->response([
                        'status' => TRUE,
                        'message' => $msg,
                        'base_url' => base_url(),
                         'wallet_balance' => $query['amount'],
                        'data' => $auth_data
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $msg = ($lang == 'en')? 'Invalid Email or password' : 'البريد الالكتروني او الرقم السري غير صحيح';
            $this->response([
                        'status' => FALSE,
                        'message' => $msg,
            ], REST_Controller::HTTP_OK);  
        }
    }
    
    public function otpVarification_post()
    {
        if (!$this->post('mobile') || !$this->post('otp')) 
		{
            $msg = ($this->post('lang') == 'en')? 'Please enter the data correctly' : 'الرجاء ادخال معلومات صحيحة';
            $this->response(['status' => FALSE,'message' => $msg], REST_Controller::HTTP_OK);
        } 
		else 
		{
		    $q = array("mobile" => $this->post('mobile'), "otp" => $this->post('otp'));
            $res = $this->Mobile_services->check('users', $q);
            if($res->num_rows()==1)
            {
                $q = array("mobile" => $this->post('mobile'));
                $otp_data = array("otp_status" => 1);
                $this->Mobile_services->update('users', $q, $otp_data);
                $msg = ($this->post('lang') == 'en')? 'Otp has been verified successfully' : 'تم التحقق من الرمز بنجاح';
                $this->response(['status' => TRUE,'message' => $msg], REST_Controller::HTTP_OK);
            }
            else
            {
                $msg = ($this->post('lang') == 'en')? 'Incorrect OTP' : 'رمز التحقق خاطئ';
                $this->response(['status' => FALSE,'message' => $msg], REST_Controller::HTTP_OK);
            }
		}
    }
    
    //code for sms
    public function  otpGeneration_post() 
    {
        if (!$this->post('mobile')) 
        {
            $msg = ($this->post('lang') == 'en')? 'Please enter the data correctly' : 'الرجاء ادخال معلومات صحيحة';
            $this->response(['status' => FALSE,'message' => $msg], REST_Controller::HTTP_OK);
        } 
        else 
        {
            $vmobile = $this->post('mobile');
            $code = $this->post("country_code");
            //$otp = mt_rand(1000, 9999);
            $otp = '1234';
            $msg = $otp . " is your verification code to verify your mobile # on Yummy. This is safety of your account and must be done before you proceed.";
            
            /*$mobile = "966565912333";		//Mobile number (or username) of your Mobily.ws account
			$password = "Yummy.2017";		//Password of your Mobily.ws account
			$sender = "NEW SMS";			//The sender name that will be shown when the message is delivered , it will be
			*/
			
			//$numbers = $code . $vmobile;
			$numbers = $vmobile;
			$MsgID = rand(1,99999);	
			$timeSend = 0;
			$dateSend = 0;
			$deleteKey = 152485;
			$resultType = 1;
			
			$q = array("mobile" => $vmobile);
            $otp_data = array("otp" => $otp);
            $this->Mobile_services->update('users', $q, $otp_data);
			
			/*$sms_reg = sendSMS($mobile, $password, $numbers, $sender, $msg, $MsgID, $timeSend, $dateSend, $deleteKey, $resultType);
            $data["message"] = $sms_reg;*/
            
            $msg1 = ($this->post('lang') == 'en') ? 'Otp Send Successfully' : 'تم ارسال رمز التحقق';
			
			$this->response(['status' => TRUE,'message' => $msg1], REST_Controller::HTTP_OK);
        }
    }
    
    //Get Category
    public function get_categoryDetails_get()
    {
        if($this->get('lang') == 'en')
        {
            if($this->get('id'))
            {
                $this->db->select('id,image,category_name,heading_en as heading,text_en as text');
                $this->db->where('id',$this->get('id'));
                $record = $this->db->get('category_adds')->row();
            }
            else
            {
                $this->db->select('id,category_name,image,heading_en as heading,text_en as text');
                //$this->db->order_by('rand()');
                $this->db->order_by("orderType", "asc");
                $record = $this->db->get('category_adds')->result();
                $count =0;
                foreach($record as $row)
                {
                    $record[$count]->text = ucwords(substr($row->text,0,100));
                    $count++;
                }
            }
        }
        else
        {
            if($this->get('id'))
            {
                $this->db->select('id,category_name_ar as category_name,image,heading_ar as heading,text_ar as text');
                $this->db->where('id',$this->get('id'));
                $record = $this->db->get('category_adds')->row();
            }
            else
            {
                $this->db->select('id,category_name_ar as category_name,image,heading_ar as heading,text_ar as text');
                $record = $this->db->get('category_adds')->result();
                $count =0;
                foreach($record as $row)
                {
                    $record[$count]->text = ucwords(substr($row->text,0,100));
                    $count++;
                }
            }
        }
        
        $result=["status"=>TRUE, "base_url"=>base_url() , "category" =>$record];    
        $this->response($result, REST_Controller::HTTP_OK);
    }
    
    
    //Get Event Details
    public function get_eventDetails_get()
    {
        $lang = $this->get('lang');
        
        if($this->get('lang') == 'ar')
        {   
            if($this->get('day'))
            {
                $this->db->select('id,image,color_code,title_ar as title,form_date,to_date,form_time,to_time,mobile,cost,url,address,description_ar as description');
                $this->db->where('DAY(form_date)',$this->get('day'));
                $record = $this->db->get('event')->result();
            }
            else if($this->get('months'))
            {
                $this->db->select('id,image,color_code,title_ar as title,form_date,to_date,form_time,to_time,mobile,cost,url,address,description_ar as description');
                $this->db->where('MONTH(form_date)',$this->get('months'));
                $record = $this->db->get('event')->result();
            }
            elseif($this->get('id'))
            {
                $this->db->select('id,image,color_code,title_ar as title,form_date,to_date,form_time,to_time,mobile,cost,url,address,description_ar as description');
                $this->db->where('id',$this->get('id'));
                $record = $this->db->get('event')->row();
                $record->description = ($record->description)?$record->description:'';
            }
            else
            {
                $this->db->select('id,image,color_code,title_ar as title,form_date,to_date,form_time,to_time,mobile,cost,url,address,description_ar as description');
                $this->db->where('form_date >=',date('Y-m-d'));
                $record = $this->db->get('event')->result();
                $count =0;
                foreach($record as $row)
                {
                    $record[$count]->description = ucwords(substr($row->description,0,100));
                    $count++;
                }
            }
            
        }
        else
        { 
            if($this->get('day'))
            {
                $this->db->select('id,image,color_code,title_en as title,form_date,to_date,form_time,to_time,mobile,cost,url,address,description_en as description');
                $this->db->where('DAY(form_date)',$this->get('day'));
                $record = $this->db->get('event')->result();
            }
            else if($this->get('months'))
            {
                $this->db->select('id,image,color_code,title_en as title,form_date,to_date,form_time,to_time,mobile,cost,url,address,description_en as description');
                $this->db->where('MONTH(form_date)',$this->get('months'));
                $record = $this->db->get('event')->result();
            }
            else if($this->get('id'))
            {
                $this->db->select('id,image,color_code,title_en as title,form_date,to_date,form_time,to_time,mobile,cost,url,address,description_en as description');
                $this->db->where('id',$this->get('id'));
                $record = $this->db->get('event')->row();
                $record->description = ($record->description)?$record->description:'';
            }
            else
            {
                $this->db->select('id,image,color_code,title_en as title,form_date,to_date,form_time,to_time,mobile,cost,url,address,description_en as description');
                $this->db->where('form_date >=',date('Y-m-d'));
                $record = $this->db->get('event')->result();
                $count =0;
                foreach($record as $row)
                {
                    $record[$count]->description = ucwords(substr($row->description,0,100));
                    $count++;
                }
            }
            
        }
        
        $lang = ($lang=='en')?'No Events':'لا أحداث';
        if($record){
        $result=["status"=>TRUE, "base_url"=>base_url() , "event" =>$record];    
        $this->response($result, REST_Controller::HTTP_OK);
        }
        else
        {
            $result=["status"=>FALSE, "message" => $lang];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }
    
    
    //Get Wallet Amount
    public function get_walletDetails_get()
    {
        $this->db->select('amount');
        $record = $this->db->where('status',1)->get('add_wallet_amount')->result();
        $result=["status"=>TRUE,"wallet_amount" =>$record];    
        $this->response($result, REST_Controller::HTTP_OK);
    }
    
    //Add Amount In User Side
    public function add_user_wallet_amount_post()
    {
        $lang = $this->post('lang');
        
        mt_srand((double)microtime()*10000);
        $charid = md5(uniqid(rand(), true));
        $c = unpack("C*",$charid);
        $c = implode("",$c);
        $c = substr($c,0,10);
       
        $userid = $this->post('userid');
        $record = $this->db->select('*')->where('user_id',$userid)->order_by("wid", "desc")->get('add_user_wallet')->row();
        
        if(sizeof($record) > 0)
        {
            //print_r($record);
            $amount = $record->amount;
            $addamount = $this->post('amount');
            $data['user_id'] = $userid;
            $data['order_no'] = $c;
            $data['amount'] = $amount + $addamount;
            $data['add_amount'] = $this->post('amount');
            $data['payment_status'] = 1;
            $data['pay_add_id'] = 1;
            $data['insert_date'] = date('Y-m-d H:i:s');
            $res = $this->db->insert('add_user_wallet',$data);
            if($res)
            {
                $data['wallet_id'] = $this->db->insert_id();
                $result=["status"=>TRUE,"message" =>"success","wallet" =>$data];    
                $this->response($result, REST_Controller::HTTP_OK);
            }
            else
            {
                $result=["status"=>FALSE,"message" =>"some error Please Try agian!"];    
                $this->response($result, REST_Controller::HTTP_OK);
            }
        }
        else
        {   
            $data['user_id'] = $userid;
            $data['order_no'] = $c;
            $data['amount'] = $this->post('amount');
            $data['add_amount'] = $this->post('amount');	
            $data['payment_status'] = 1;
            $data['pay_add_id'] = 1;
            $data['insert_date'] = date('Y-m-d H:i:s');
            $res = $this->db->insert('add_user_wallet',$data);
            if($res)
            {
                $data['wallet_id'] = $this->db->insert_id();
                $result=["status"=>TRUE,"message" =>"success","wallet" =>$data];    
                $this->response($result, REST_Controller::HTTP_OK);
            }
            else
            {
                $message = ($lang=='en')?'some error Please Try agian':'الرجاء المحاوله مرة أخرى';
                $result=["status"=>FALSE,"message" =>$message];    
                $this->response($result, REST_Controller::HTTP_OK);
            }
        }
        
    }
    
    //Get All Details Wallet Information
    public function user_walletDetails_get()
    {   
        $this->get('user_id');
        $amount = $this->db->select('amount')->where('user_id',$this->get('user_id'))->order_by("wid", "desc")->get('add_user_wallet')->row();
        $amount1 = ($amount)?$amount->amount:'0';
        $added_wallet = $this->db->select('wid,order_no,add_amount,payment_status,insert_date')->where('pay_add_id',1)->where('user_id',$this->get('user_id'))->order_by("wid", "desc")->get('add_user_wallet')->result();
        $paid_wallet = $this->db->select('wid,order_no,paid_amount,payment_status,insert_date')->where('pay_add_id',2)->where('user_id',$this->get('user_id'))->order_by("wid", "desc")->get('add_user_wallet')->result();
        
        $result=["status"=>TRUE,"message" =>"success", "total_wallet_amount"=>$amount1, "added_wallet" => $added_wallet , "paid_wallet" => $paid_wallet];    
        $this->response($result, REST_Controller::HTTP_OK);
    }
    
    //Add New Place
    public function add_place_post()
    {   
        $lang = $this->post('lang');
        $data['user_id']        = $this->post('user_id');
        $data['title']          = $this->post('title');
        $data['note']           = $this->post('note');
        $data['location']       = $this->post('location');
        $data['latitude']       = $this->post('latitude');
        $data['longitude']      = $this->post('longitude');
        $data['status']         = 1;
        $data['insert_date']    = date('Y-m-d h:i:s');
        
        if(!empty($_FILES['place_image']['name']))
        {
               $imageFileType = strtolower(pathinfo($_FILES['place_image']['name'],PATHINFO_EXTENSION));
            
               $config['upload_path'] = 'assets/uploads/place_image/';
               $config['allowed_types'] = 'jpg|jpeg|png|gif';
               $config['file_name'] = date('Y-m-d').'-'.time().'.'.$imageFileType;
                      
               $this->load->library('upload',$config);
               $this->upload->initialize($config);
                 
               if($this->upload->do_upload('place_image')){ 
               $uploadData = $this->upload->data();
               $data['image'] = $config['upload_path'].$uploadData['file_name'];
               }else{
               $data['image'] = '';
               }
        }
        else
        {
            $data['image'] = 'assets/uploads/place_image/default.jpg';
        }
        
        $res = $this->db->insert('add_place',$data);
        if($res)
        {
            $message = ($lang=='en')?'Place Inserted Successfully':'تم إضافة الموقع بنجاح';
            $result=["status"=>TRUE,"message" => $message];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
        else
        {
            $message = ($lang=='en')?'some error Please Try agian':'الرجاء المحاوله مرة أخرى';
            $result=["status"=>FALSE,"message" =>"some error Please Try agian!"];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }
    
    //Get Place Details 
    public function get_palceDetails_get()
    {   
        $lang = $this->get('lang');
        $userid = $this->get('user_id');
        $data['user_id'] = $userid;
        $data['status'] = 1;
        $table = 'add_place';
        $record = $this->Mobile_services->check($table,$data)->result();
        if(sizeof($record) > 0)
        {
            $message = ($lang=='en')?'Record':'سجل';
            $result=["status"=>TRUE,"message" =>$message, "placeRecord"=>$record,"path"=>base_url()];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
        else
        {
            $message = ($lang=='en')?'No Record':'لايوجد بيانات';
            $result=["status"=>FALSE,"message" =>$message];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }
    
    //Get Invoice Details
    public function invoice_get()
    {
        
        $lang = $this->get('lang');
        $userid = $this->get('user_id');
        $data['user_id'] = $userid;
        $data['status'] = 1;
        $data['payment_status'] = 0;
        $table = 'invoice';
        $record = $this->Mobile_services->check($table,$data)->result();
        
        $data1['id'] = $this->get('id');
        $data1['status'] = 1;
        $record1 = $this->Mobile_services->check($table,$data1)->result();
        
        if($this->get('id'))
        {
            if(sizeof($record1) > 0)
            {
                if($this->get('lang') == 'en')
                {
                    $record1 = $this->db->select('*,description_en as description')->where('id',$data1['id'])->where('status',1)->where('payment_status',0)->get('invoice')->row();
                }
                else
                {
                    $record1 = $this->db->select('*,description_ar as description')->where('id',$data1['id'])->where('status',1)->where('payment_status',0)->get('invoice')->row();   
                }
            
                if($lang=='en')
                {
                    $record1->category_name = $this->db->where('id',$record1->category_id)->get('category_adds')->row()->category_name;
                }
                else
                {
                    $record1->category_name = $this->db->where('id',$record1->category_id)->get('category_adds')->row()->category_name_ar;
                }
                
                $resh = $record1->agent_name = $this->db->where('user_id',$record1->agent_id)->get('users')->row();
                if(sizeof($resh) > 0){
                $record1->agent_name = $this->db->where('user_id',$record1->agent_id)->get('users')->row()->user_name;
                }
                else
                {
                    $record1->agent_name = '';
                }
                
                $message = ($lang=='en')?'Record':'سجل';
                $result=["status"=>TRUE,"message" =>$message, "invoice"=>$record1];    
                $this->response($result, REST_Controller::HTTP_OK);
            }
            else
            {
                $message = ($lang=='en')?'No Record':'لا سجلات';
                $result=["status"=>FALSE,"message" =>$message];    
                $this->response($result, REST_Controller::HTTP_OK);
            }
                
        }
        else if(sizeof($record) > 0)
        {
            
                if($this->get('lang') == 'en')
                {
                    $record = $this->db->select('*,description_en as description')->where('user_id',$data['user_id'])->where('status',1)->where('payment_status',0)->get('invoice')->result();
                }
                else
                {
                    $record = $this->db->select('*,description_ar as description')->where('user_id',$data['user_id'])->where('status',1)->where('payment_status',0)->get('invoice')->result();   
                }
                
                $count=0;
                foreach($record as $row)
                {
                    if($lang=='en')
                    {
                        $record[$count]->category_name = $this->db->where('id',$row->category_id)->get('category_adds')->row()->category_name;
                    }
                    else
                    {
                        $record[$count]->category_name = $this->db->where('id',$row->category_id)->get('category_adds')->row()->category_name_ar;
                    }
                    
                    $resh = $record[$count]->agent_name = $this->db->where('user_id',$row->agent_id)->get('users')->row();
                    if(sizeof($resh) > 0){
                    $record[$count]->agent_name = $this->db->where('user_id',$row->agent_id)->get('users')->row()->user_name;
                    }else{ $record[$count]->agent_name = '';}
                    
                    $count++;
                }
            
             
            $message = ($lang=='en')?'Record':'سجل';
            $result=["status"=>TRUE,"message" =>$message, "invoice"=>$record];    
            $this->response($result, REST_Controller::HTTP_OK);
                
        }
        else
        {
                $message = ($lang=='en')?'No Record':'لايوجد بيانات';
                $result=["status"=>FALSE,"message" =>$message];    
                $this->response($result, REST_Controller::HTTP_OK);
        }
    }
    
    //Get Orders Details
    public function ordersdetails_get()
    {
        
        $lang = $this->get('lang');
        $userid = $this->get('user_id');
        $data['user_id'] = $userid;
        $data['status'] = 1;
        $data['payment_status'] = 1;
        $table = 'invoice';
        $record = $this->Mobile_services->check($table,$data)->result();
        
        $data1['id'] = $this->get('id');
        $data1['status'] = 1;
        $record1 = $this->Mobile_services->check($table,$data1)->result();
        
        if($this->get('id'))
        {
            if(sizeof($record1) > 0)
            {
                if($this->get('lang') == 'en')
                {
                    $record1 = $this->db->select('*,description_en as description')->where('id',$data1['id'])->where('status',1)->where('payment_status',1)->get('invoice')->row();
                }
                else
                {
                    $record1 = $this->db->select('*,description_ar as description')->where('id',$data1['id'])->where('status',1)->where('payment_status',1)->get('invoice')->row();   
                }
            
                if($lang=='en')
                {
                    $record1->category_name = $this->db->where('id',$record1->category_id)->get('category_adds')->row()->category_name;
                }
                else
                {
                    $record1->category_name = $this->db->where('id',$record1->category_id)->get('category_adds')->row()->category_name_ar;
                }
                
                $record1->payment_by =  $this->db->where('invoice_id',$this->get('id'))->get('add_user_wallet')->row()->method_pay;
                
                $resh = $record1->agent_name = $this->db->where('user_id',$record1->agent_id)->get('users')->row();
                if(sizeof($resh) > 0){
                $record1->agent_name = $this->db->where('user_id',$record1->agent_id)->get('users')->row()->user_name;
                }
                else
                {
                    $record1->agent_name = '';
                }
                
                $message = ($lang=='en')?'Record':'سجل';
                $result=["status"=>TRUE,"message" =>$message, "invoice"=>$record1];    
                $this->response($result, REST_Controller::HTTP_OK);
            }
            else
            {
                $message = ($lang=='en')?'No Record':'لايوجد بيانات';
                $result=["status"=>FALSE,"message" =>$message];    
                $this->response($result, REST_Controller::HTTP_OK);
            }
                
        }
        else if(sizeof($record) > 0)
        {
            
                if($this->get('lang') == 'en')
                {
                    $record = $this->db->select('*,description_en as description')->where('user_id',$data['user_id'])->where('status',1)->where('payment_status',1)->get('invoice')->result();
                }
                else
                {
                    $record = $this->db->select('*,description_ar as description')->where('user_id',$data['user_id'])->where('status',1)->where('payment_status',1)->get('invoice')->result();   
                }
                
                $count=0;
                foreach($record as $row)
                {
                    if($lang=='en')
                    {
                        $record[$count]->category_name = $this->db->where('id',$row->category_id)->get('category_adds')->row()->category_name;
                    }
                    else
                    {
                        $record[$count]->category_name = $this->db->where('id',$row->category_id)->get('category_adds')->row()->category_name_ar;
                    }
                    
                    $resh = $record[$count]->agent_name = $this->db->where('user_id',$row->agent_id)->get('users')->row();
                    if(sizeof($resh) > 0){
                    $record[$count]->agent_name = $this->db->where('user_id',$row->agent_id)->get('users')->row()->user_name;
                    }else{ $record[$count]->agent_name = '';}
                    
                    $count++;
                }
            
             
            $message = ($lang=='en')?'Record':'سجل';
            $result=["status"=>TRUE,"message" =>$message, "invoice"=>$record];    
            $this->response($result, REST_Controller::HTTP_OK);
                
        }
        else
        {
                $message = ($lang=='en')?'No Record':'لايوجد بيانات';
                $result=["status"=>FALSE,"message" =>$message];    
                $this->response($result, REST_Controller::HTTP_OK);
        }
    }
    
    //Delete invoice 
    public function deleteInvoice_get()
    {
        $lang   = $this->get('lang');
        $id     = $this->get('id');
        $data   = array('status'=>2);
    
        $res = $this->db->where('id',$id)->update('invoice',$data);
        if($res)
        {
            $message = ($lang=='en')?'Deleted Successfully':'تم المسح بنجاح';
            $result=["status"=>TRUE,"message" =>$message];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
        else
        {
            $message = ($lang=='en')?'some error Please Try agian':'الرجاء المحاوله مرة أخرى';
            $result=["status"=>FALSE,"message" =>$message];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }
    
    //Delete Place 
    public function deletePlace_get()
    {
        $lang   = $this->get('lang');
        $id     = $this->get('id');
        $data   = array('status'=>2);
        $res = $this->db->where('id',$id)->update('add_place',$data);
        if($res)
        {
            $message = ($lang=='en')?'Place Deleted Successfully':'تم المسح بنجاح';
            $result=["status"=>TRUE,"message" =>$message];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
        else
        {
            $message = ($lang=='en')?'some error Please Try agian':'الرجاء المحاوله مرة أخرى';
            $result=["status"=>FALSE,"message" =>$message];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }
    
    //Request call Service
    public function request_call_get()
    {
        $lang = $this->get('lang');
        $res = $this->db->get('request_call')->row();
        if($res)
        {
            $message = ($lang=='en')?'Record':'سجل';
            $result=["status"=>TRUE,"message" =>$message, "requset_call"=>$res];    
            $this->response($result, REST_Controller::HTTP_OK);
                
        }
        else
        {
                $message = ($lang=='en')?'No Request Service':'لا سجلات';
                $result=["status"=>FALSE,"message" =>$message];    
                $this->response($result, REST_Controller::HTTP_OK);
        }
    }
    
    //Wallet Make Payment
    public function makepayment_post()
    {
        $lang = $this->post('lang');
        
        $user_id            = $this->post('user_id');
        $payamount          = $this->post('payamount');
        $walletAmount1      = $this->post('walletamount');
        
        if($payamount > 0 && $walletAmount1 > 0)
        {
            $walletamount =  $walletAmount1 - $payamount;
            
            if($walletamount >= 0)
            {
                //echo "paid"; 
                $invoice_id         = $this->post('i_id');
                $payment_status     = array('payment_status'=>1);
                
                $category_id    = $this->db->where('id',$invoice_id)->get('invoice')->row()->category_id;
                if($lang == 'en')
                {
                    $category_name  = $this->db->where('id',$category_id)->get('category_adds')->row()->category_name;
                }
                else
                {
                    $category_name  = $this->db->where('id',$category_id)->get('category_adds')->row()->category_name_ar;
                }
                
               /* mt_srand((double)microtime()*10000);
                $charid = md5(uniqid(rand(), true));
                $c = unpack("C*",$charid);
                $c = implode("",$c);
                $c = substr($c,0,10);*///
                
                $data['user_id']        = $user_id;
                $data['order_no']       = $this->post('invoice_id');
                $data['invoice_id']     = $this->post('i_id');
                $data['amount']         = $walletamount;
                $data['paid_amount']    = $payamount;
                $data['payment_status'] = 1;
                $data['pay_add_id']     = 2;
                $data['method_pay']     = 'wallet';
                $data['insert_date']    = date('Y-m-d H:i:s');
                $res = $this->db->insert('add_user_wallet',$data);
                if($res)
                {
                    $data['wallet_id'] = $this->db->insert_id();
                    
                    //Paid amount Invoice
                    $this->db->where('id',$invoice_id);
                    $this->db->update('invoice',$payment_status);
                    
                   
                    $data['category_name'] = $category_name;
                    $result=["status"=>TRUE,"message" =>"success","wallet" =>$data];    
                    $this->response($result, REST_Controller::HTTP_OK);
                }
                else
                {
                    $message = ($lang == 'en')?'some error Please Try agian!':'الرجاء المحاوله مرة أخرى';
                    $result=["status"=>FALSE,"message" =>$message];    
                    $this->response($result, REST_Controller::HTTP_OK);
                }
                
                    
            }
            else
            {   
                //echo "In-sufficient amount in your wallet. Please add amount in Wallet";
                $message = ($lang == 'en')?'In-sufficient amount in your wallet. Please add amount in Wallet!':'المبلغ المتوفر لايكفي الرجاء إضافة المزيد';
                $result=["status"=>FALSE,"message" =>$message];    
                $this->response($result, REST_Controller::HTTP_OK);
            }
        }
        else
        {
            //echo "Please Insert Amount.";
            $message = ($lang == 'en')?'Please Insert Amount.':'الرجاء ادخال المبلغ';
            $result=["status"=>FALSE,"message" =>$message];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
        
    }
    
    //add chat Message
    public function chat_post()
    {
        $this->post('message');//category_id
        
        $lang                   = $this->post('lang');
        $data['sender_id']      = $this->post('user_id');
        $data['message_type']   = $this->post('message_type');
        $data['insert_date']    = date('Y-m-d h:i:s');
        $data['category_id']    = $this->post('category_id');
        
        if( $this->post('user_id') && $this->post('message_type'))
        {
            //echo "insretd";
            if($this->post('message_type') == 1)
            {
                $data['message']  =  $this->post('message');
            }
            else if($this->post('message_type') == 2)
            {
                
                if(!empty($_FILES['image']['name']))
                {
                    $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]),PATHINFO_EXTENSION));
                	$imgname = date('Y-m-d').'-'.time().'.'.$imageFileType;
                		       
                    $config['upload_path']      = 'assets/uploads/chat';
                    $config['allowed_types']    = 'jpg|jpeg|png|gif';
                    $config['file_name']        = $imgname;
                              
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                         
                    if($this->upload->do_upload('image'))
                    {
                        $uploadData = $this->upload->data();
                        $data['message'] = $config['upload_path'].'/'.$uploadData['file_name'];
                    }
                    else
                    {
                        $data['message'] = '';
                    }
                    
                }
                
            }
            else if($this->post('message_type') == 3)
            {
                if(!empty($_FILES['audio']['name']))
                {
                    $imageFileType = strtolower(pathinfo(basename($_FILES["audio"]["name"]),PATHINFO_EXTENSION));
                	$imgname = date('Y-m-d').'-'.time().'.mp3';
                		       
                    $config['upload_path']      = 'assets/uploads/chat';
                    $config['allowed_types']    = '*';
                    $config['file_name']        = $imgname;
                              
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                         
                    if($this->upload->do_upload('audio'))
                    {
                        $uploadData = $this->upload->data();
                        $data['message'] = $config['upload_path'].'/'.$uploadData['file_name'];
                    }
                    else
                    {
                        $data['message'] = '';
                    }
                    
                }
            }
            else if($this->post('message_type') == 4)
            {
                if(!empty($_FILES['video']['name']))
                {
                    $imageFileType = strtolower(pathinfo(basename($_FILES["video"]["name"]),PATHINFO_EXTENSION));
                	$imgname = date('Y-m-d').'-'.time().'.mp4';
                		       
                    $config['upload_path']      = 'assets/uploads/chat';
                    $config['allowed_types']    = '*';
                    $config['file_name']        = $imgname;
                              
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                         
                    if($this->upload->do_upload('video'))
                    {
                        $uploadData = $this->upload->data();
                        $data['message'] = $config['upload_path'].'/'.$uploadData['file_name'];
                    }
                    else
                    {
                        $data['message'] = '';
                    }
                    
                }
            }
            else if($this->post('message_type') == 5)
            {
                if(!empty($_FILES['camera']['name']))
                {
                    $imageFileType = strtolower(pathinfo(basename($_FILES["camera"]["name"]),PATHINFO_EXTENSION));
                	$imgname = date('Y-m-d').'-'.time().'.png';
                		       
                    $config['upload_path']      = 'assets/uploads/chat';
                    $config['allowed_types']    = 'jpg|jpeg|png|gif';
                    $config['file_name']        = $imgname;
                              
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                         
                    if($this->upload->do_upload('camera'))
                    {
                        $uploadData = $this->upload->data();
                        $data['message'] = $config['upload_path'].'/'.$uploadData['file_name'];
                    }
                    else
                    {
                        $data['message'] = '';
                    }
                    
                }
            }
            else if($this->post('message_type') == 6)
            {
                if(!empty($_FILES['file']['name']))
                {
                    $imageFileType = strtolower(pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION));
                	$imgname = date('Y-m-d').'-'.time().'.'.$imageFileType;
                		    
                    $config['upload_path']      = 'assets/uploads/chat';
                    $config['allowed_types']    = '*';
                    $config['file_name']        =  $imgname;
                              
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                         
                    if($this->upload->do_upload('file'))
                    {
                        $uploadData = $this->upload->data();
                        $data['message'] = $config['upload_path'].'/'.$uploadData['file_name'];
                    }
                    else
                    {
                        $data['message'] = '';
                    }
                    
                }
            }
            
            if($data['message'])
            {
                //$user = $this->db->where('off_on_line',1)->get('users')->row_array();
                $query = "SELECT * FROM `users` where off_on_line = 1 ORDER BY RAND()";
                $user = $this->db->query($query)->row_array();
                //print_r($user);
                   
                if(sizeof($user) > 0)
                {
                    $res = $this->db->where('agent_id',$this->post('receiver_id'))->get('chat_count')->result();
                    $res1 = $this->db->where('client_id',$this->post('user_id'))->get('chat_count')->result();
                    //print_r(sizeof($res1));exit;
                    //echo sizeof($res);
                    
                    $client  = $this->db->where('client_id',$this->post('user_id'))->get('chat_count')->row_array();
                    
                    
                    if(sizeof($res) > 0)
                    {
                        //echo sizeof($res);exit;
                        //echo "insert";
                        
                         $rescord = $this->db->where('agent_id',$this->post('receiver_id'))->where('client_id',$this->post('user_id'))->get('chat_count')->row_array();
                      
                        if(sizeof($rescord) > 0)
                        {       
                                //echo "chat continue ";
                                //echo print_r($rescord);exit;
                           
                                //echo "insert";     
                                if($this->post('transaction_number'))
                                {
                                    $data['transaction_number'] = $this->post('transaction_number');
                                }
                                else
                                {
                                    $data['transaction_number'] = $c;
                                }
                                
                                
                                if($this->post('receiver_id'))
                                {
                                    $data['receiver_id'] = $this->post('receiver_id');
                                }
                                else
                                {
                                     $data['receiver_id']    = $user['user_id'];
                                }
                                
                                $category_id = ($data['category_id']=='other')?0:$data['category_id'];
                                $this->db->where('client_id',$data['sender_id']);
                                $this->db->update('chat_count',array('category_id'=>$category_id));
                                
                                //$res =  ($data['message']!=0123456789)?$this->db->insert('chats',$data):1;
                                
                                $data['notification_count'] = 1;
                                
                                $res = $this->db->insert('chats',$data);
                                if($res)
                                {
                                    $data['id']             = $this->db->insert_id();
                                    
                                    $data1['user_name'] = $this->db->where('user_id',$data['receiver_id'])->get('users')->row()->user_name;
                                    $data1['image'] = base_url().''.$this->db->where('user_id',$data['receiver_id'])->get('users')->row()->image;
                                    $data1['category_name'] = ($data['category_id']=='other')?'other':$this->db->where('id',$data['category_id'])->get('category_adds')->row()->category_name;
                                    
                                    $result=["status"=>TRUE,"message" =>"success","data"=>$data,"receiver_info"=>$data1];    
                                    $this->response($result, REST_Controller::HTTP_OK);
                                }
                                else
                                {
                                    $message = ($lang == 'en')?'some error Please Try agian!':'بعض الخطأ يرجى المحاولة مرة أخرى!';
                                    $result=["status"=>FALSE,"message" =>$message];    
                                    $this->response($result, REST_Controller::HTTP_OK);
                                }
                                
                            
                            
                        }
                        else if(sizeof($res) < 4)
                        {
                            $c=unserialize($user['category_id']);
                            
                                    if(in_array($data['category_id'], $c))
                                    {
                                        //echo "Match found";
                                        //print_r($user);exit;
                                        
                                        mt_srand((double)microtime()*10000);
                                        $charid = md5(uniqid(rand(), true));
                                        $c = unpack("C*",$charid);
                                        $c = implode("",$c);
                                        $c = substr($c,0,15);
                                        
                                        if($this->post('transaction_number'))
                                        {
                                            $data['transaction_number'] = $this->post('transaction_number');
                                        }
                                        else
                                        {
                                            $data['transaction_number'] = $c;
                                        }
                                        
                                        
                                        if($this->post('receiver_id'))
                                        {
                                            $data['receiver_id'] = $this->post('receiver_id');
                                        }
                                        else
                                        {
                                             $data['receiver_id']    = $user['user_id'];
                                        }
                                        
                                        $category_id = ($data['category_id']=='other')?0:$data['category_id'];
                                        $this->db->where('client_id',$data['sender_id']);
                                        $this->db->update('chat_count',array('category_id'=>$category_id));
                                        
                                        //$res =  ($data['message']!=0123456789)?$this->db->insert('chats',$data):1;
                                        
                                        $data['notification_count'] = 1;
                                        
                                        $res = $this->db->insert('chats',$data);
                                        if($res)
                                        {
                                            
                                            $data['id']             = $this->db->insert_id();
                                            $data1['user_name'] = $this->db->where('user_id',$data['receiver_id'])->get('users')->row()->user_name;
                                            $data1['image'] = base_url().''.$this->db->where('user_id',$data['receiver_id'])->get('users')->row()->image;
                                            $data1['category_name'] = $this->db->where('id',$data['category_id'])->get('category_adds')->row()->category_name;
                                            
                                            
                                            $data2['agent_id']      = $data['receiver_id'];
                                            $data2['client_id']     = $this->post('user_id');
                                            $data2['free_busy']     = 1;
                                            $this->db->insert('chat_count',$data2);
                                           
                                            
                                            $result=["status"=>TRUE,"message" =>"success","data"=>$data,"receiver_info"=>$data1,"base_url"=>base_url()];    
                                            $this->response($result, REST_Controller::HTTP_OK);
                                        }
                                        else
                                        {
                                            $message = ($lang == 'en')?'some error Please Try agian!':'بعض الخطأ يرجى المحاولة مرة أخرى!';
                                            $result=["status"=>FALSE,"message" =>$message];    
                                            $this->response($result, REST_Controller::HTTP_OK);
                                        }
                                        
                                        
                                    }
                                    else
                                    {
                                            $message = ($lang == 'en')?'All Agents are busy Please try agian later!':'جميع الموظفين مشغولين الرجاء المحاوله لاحقا';
                                            $result=["status"=>FALSE,"message" =>$message];    
                                            $this->response($result, REST_Controller::HTTP_OK);
                                    }
                        }
                        else
                        {
                            $message = ($lang == 'en')?'All Agents are busy Please try agian later!':'جميع الموظفين مشغولين الرجاء المحاوله لاحقا';
                            $result=["status"=>FALSE,"message" =>$message];    
                            $this->response($result, REST_Controller::HTTP_OK);
                        }
                        
                    }
                    else if(sizeof($res1) == 0)
                    {
                        //echo "insert";
                        //print_r($user);
                        $c=unserialize($user['category_id']);
                            
                        if(in_array($data['category_id'], $c))
                        {
                            //echo "Match found";
                            //print_r($user);exit;
                            
                            mt_srand((double)microtime()*10000);
                            $charid = md5(uniqid(rand(), true));
                            $c = unpack("C*",$charid);
                            $c = implode("",$c);
                            $c = substr($c,0,15);
                            
                            if($this->post('transaction_number'))
                            {
                                $data['transaction_number'] = $this->post('transaction_number');
                            }
                            else
                            {
                                $data['transaction_number'] = $c;
                            }
                            
                            
                            if($this->post('receiver_id'))
                            {
                                $data['receiver_id'] = $this->post('receiver_id');
                            }
                            else
                            {
                                 $data['receiver_id']    = $user['user_id'];
                            }
                            
                            
                            
                            //$res =  ($data['message']!=0123456789)?$this->db->insert('chats',$data):1;
                            $res = $this->db->insert('chats',$data);
                            if($res)
                            {
                                $data['id']             = $this->db->insert_id();
                                $data1['user_name'] = $this->db->where('user_id',$data['receiver_id'])->get('users')->row()->user_name;
                                $data1['image'] = base_url().''.$this->db->where('user_id',$data['receiver_id'])->get('users')->row()->image;
                                $data1['category_name'] = $this->db->where('id',$data['category_id'])->get('category_adds')->row()->category_name;
                                
                                
                                $data2['agent_id']      = $data['receiver_id'];
                                $data2['client_id']     = $this->post('user_id');
                                $data2['free_busy']     = 1;
                                $data2['category_id']   = $data['category_id'];
                                $this->db->insert('chat_count',$data2);
                               
                                
                                $result=["status"=>TRUE,"message" =>"success","data"=>$data,"receiver_info"=>$data1,"base_url"=>base_url()];    
                                $this->response($result, REST_Controller::HTTP_OK);
                            }
                            else
                            {
                                $message = ($lang == 'en')?'some error Please Try agian!':'بعض الخطأ يرجى المحاولة مرة أخرى!';
                                $result=["status"=>FALSE,"message" =>$message];    
                                $this->response($result, REST_Controller::HTTP_OK);
                            }
                            
                        }
                        else if($data['category_id'] == 'other')
                        {
                            mt_srand((double)microtime()*10000);
                            $charid = md5(uniqid(rand(), true));
                            $c = unpack("C*",$charid);
                            $c = implode("",$c);
                            $c = substr($c,0,15);
                            
                            if($this->post('transaction_number'))
                            {
                                $data['transaction_number'] = $this->post('transaction_number');
                            }
                            else
                            {
                                $data['transaction_number'] = $c;
                            }
                            
                            
                            if($this->post('receiver_id'))
                            {
                                $data['receiver_id'] = $this->post('receiver_id');
                            }
                            else
                            {
                                 $data['receiver_id']    = $user['user_id'];
                            }
                            
                            //$res =  ($data['message']!=0123456789)?$this->db->insert('chats',$data):1;
                            $res = $this->db->insert('chats',$data);
                            if($res)
                            {
                                
                                $data['id']             = $this->db->insert_id();
                                $data1['user_name']     = $this->db->where('user_id',$data['receiver_id'])->get('users')->row()->user_name;
                                $data1['image']         = base_url().''.$this->db->where('user_id',$data['receiver_id'])->get('users')->row()->image;
                                $data1['category_name'] = ($data['category_id'] == 'other')?'other':$this->db->where('id',$data['category_id'])->get('category_adds')->row()->category_name;
                                
                                $data2['agent_id']      = $data['receiver_id'];
                                $data2['client_id']     = $this->post('user_id');
                                $data2['free_busy']     = 1;
                                $data2['category_id']   = $data['category_id'];
                                $this->db->insert('chat_count',$data2);
                               
                                $result=["status"=>TRUE,"message" =>"success","base_url"=>base_url(),"data"=>$data,"receiver_info"=>$data1];    
                                $this->response($result, REST_Controller::HTTP_OK);
                            }
                            else
                            {
                                $message = ($lang == 'en')?'some error Please Try agian!':'بعض الخطأ يرجى المحاولة مرة أخرى!';
                                $result=["status"=>FALSE,"message" =>$message];    
                                $this->response($result, REST_Controller::HTTP_OK);
                            }
                        }
                        else
                        {
                                $message = ($lang == 'en')?'All Agents are busy Please try agian later!':'جميع الموظفين مشغولين الرجاء المحاوله لاحقا';
                                $result=["status"=>FALSE,"message" =>$message];    
                                $this->response($result, REST_Controller::HTTP_OK);
                        }
                        
                       
                    }
                    else if(sizeof($client) > 0 && $data['message'] == '0123456789')
                    {
                            $c=unserialize($user['category_id']);
                            
                            if(in_array($data['category_id'], $c))
                            {
                                //echo "Match found";
                                //print_r($user);exit;
                                
                                mt_srand((double)microtime()*10000);
                                $charid = md5(uniqid(rand(), true));
                                $c = unpack("C*",$charid);
                                $c = implode("",$c);
                                $c = substr($c,0,15);
                                
                                if($this->post('transaction_number'))
                                {
                                    $data['transaction_number'] = $this->post('transaction_number');
                                }
                                else
                                {
                                    $data['transaction_number'] = $c;
                                }
                                
                                
                                if($this->post('receiver_id'))
                                {
                                    $data['receiver_id'] = $this->post('receiver_id');
                                }
                                else
                                {
                                     $data['receiver_id']    = $client['agent_id'];
                                }
                                
                                //$res =  ($data['message']!=0123456789)?$this->db->insert('chats',$data):1;
                                $res = $this->db->insert('chats',$data);
                                if($res)
                                {
                                    $data['id']             = $this->db->insert_id();
                                    $data1['user_name'] = $this->db->where('user_id',$data['receiver_id'])->get('users')->row()->user_name;
                                    $data1['image'] = base_url().''.$this->db->where('user_id',$data['receiver_id'])->get('users')->row()->image;
                                    $data1['category_name'] = ($data['category_id'] == 'other')?'other':$this->db->where('id',$data['category_id'])->get('category_adds')->row()->category_name;
                                   
                                    
                                    $result=["status"=>TRUE,"message" =>"success","data"=>$data,"receiver_info"=>$data1,"base_url"=>base_url()];    
                                    $this->response($result, REST_Controller::HTTP_OK);
                                }
                                else
                                {
                                    $message = ($lang == 'en')?'some error Please Try agian!':'بعض الخطأ يرجى المحاولة مرة أخرى!';
                                    $result=["status"=>FALSE,"message" =>$message];    
                                    $this->response($result, REST_Controller::HTTP_OK);
                                }
                                
                                
                            }
                            else if($data['category_id'] == 'other')
                            {
                                mt_srand((double)microtime()*10000);
                                $charid = md5(uniqid(rand(), true));
                                $c = unpack("C*",$charid);
                                $c = implode("",$c);
                                $c = substr($c,0,15);
                                
                                if($this->post('transaction_number'))
                                {
                                    $data['transaction_number'] = $this->post('transaction_number');
                                }
                                else
                                {
                                    $data['transaction_number'] = $c;
                                }
                                
                                if($this->post('receiver_id'))
                                {
                                    $data['receiver_id'] = $this->post('receiver_id');
                                }
                                else
                                {
                                     $data['receiver_id']    = $client['agent_id'];
                                }
                                
                                //$res =  ($data['message']!=0123456789)?$this->db->insert('chats',$data):1;
                                $res = $this->db->insert('chats',$data);
                                if($res)
                                {
                                    $data['id']             = $this->db->insert_id();
                                    $data1['user_name']     = $this->db->where('user_id',$data['receiver_id'])->get('users')->row()->user_name;
                                    $data1['image']         = base_url().''.$this->db->where('user_id',$data['receiver_id'])->get('users')->row()->image;
                                    $data1['category_name'] = 'other';
                                   
                                    
                                    $result=["status"=>TRUE,"message" =>"success","base_url"=>base_url(),"data"=>$data,"receiver_info"=>$data1];    
                                    $this->response($result, REST_Controller::HTTP_OK);
                                }
                                else
                                {
                                    $message = ($lang == 'en')?'some error Please Try agian!':'بعض الخطأ يرجى المحاولة مرة أخرى!';
                                    $result=["status"=>FALSE,"message" =>$message];    
                                    $this->response($result, REST_Controller::HTTP_OK);
                                }
                            }
                            else
                            {
                                    $message = ($lang == 'en')?'All Agents are busy Please try agian later!':'جميع الموظفين مشغولين الرجاء المحاوله لاحقا';
                                    $result=["status"=>FALSE,"message" =>$message];    
                                    $this->response($result, REST_Controller::HTTP_OK);
                            }
                    
                    }
                    else
                    {
                        $message = ($lang == 'en')?'All Agents are busy Please try agian later!':'جميع الموظفين مشغولين الرجاء المحاوله لاحقا';
                        $result=["status"=>FALSE,"message" =>$message];    
                        $this->response($result, REST_Controller::HTTP_OK);
                    }
                    
                }
                else
                {
                    $message = ($lang == 'en')?'All Agents are busy Please try agian later!':'جميع الموظفين مشغولين الرجاء المحاوله لاحقا';
                    $result=["status"=>FALSE,"message" =>$message];    
                    $this->response($result, REST_Controller::HTTP_OK);
                }
                     
            
                
                
                die;
                if(sizeof($user) > 0)
                {
                    $c=unserialize($user['category_id']);
                    //print_r($c);
                    //print_r($user);exit;
                        
                    if(in_array($data['category_id'], $c))
                    {
                        //echo "Match found";
                        //print_r($user);exit;
                        
                        mt_srand((double)microtime()*10000);
                        $charid = md5(uniqid(rand(), true));
                        $c = unpack("C*",$charid);
                        $c = implode("",$c);
                        $c = substr($c,0,15);
                        
                        if($this->post('transaction_number'))
                        {
                            $data['transaction_number'] = $this->post('transaction_number');
                        }
                        else
                        {
                            $data['transaction_number'] = $c;
                        }
                        
                        
                        if($this->post('receiver_id'))
                        {
                            $data['receiver_id'] = $this->post('receiver_id');
                        }
                        else
                        {
                             $data['receiver_id']    = $user['user_id'];
                        }
                        
                        //$res =  ($data['message']!=0123456789)?$this->db->insert('chats',$data):1;
                        $res = $this->db->insert('chats',$data);
                        if($res)
                        {
                           
                            $data['id']             = $this->db->insert_id();
                            
                            $data1['user_name'] = $this->db->where('user_id',$data['receiver_id'])->get('users')->row()->user_name;
                            $data1['image'] = base_url().''.$this->db->where('user_id',$data['receiver_id'])->get('users')->row()->image;
                            $data1['category_name'] = $this->db->where('id',$data['category_id'])->get('category_adds')->row()->category_name;
                            
                            $result=["status"=>TRUE,"message" =>"success","data"=>$data,"receiver_info"=>$data1,"base_url"=>base_url()];    
                            $this->response($result, REST_Controller::HTTP_OK);
                        }
                        else
                        {
                            $message = ($lang == 'en')?'some error Please Try agian!':'بعض الخطأ يرجى المحاولة مرة أخرى!';
                            $result=["status"=>FALSE,"message" =>$message];    
                            $this->response($result, REST_Controller::HTTP_OK);
                        }
                        
                        
                    }
                    else
                    {
                            $message = ($lang == 'en')?'All Agents are busy Please try agian later!':'جميع الوكلاء مشغولون يرجى المحاولة مرة أخرى في وقت لاحق';
                            $result=["status"=>FALSE,"message" =>$message];    
                            $this->response($result, REST_Controller::HTTP_OK);
                    }
                }
                else if(sizeof($user1) > 0 && $this->post('receiver_id'))
                {
                        
                        if($this->post('transaction_number'))
                        {
                            $data['transaction_number'] = $this->post('transaction_number');
                        }
                        else
                        {
                            $data['transaction_number'] = $c;
                        }
                        
                        
                        if($this->post('receiver_id'))
                        {
                            $data['receiver_id'] = $this->post('receiver_id');
                        }
                        else
                        {
                             $data['receiver_id']    = $user['user_id'];
                        }
                        
                        //$res =  ($data['message']!=0123456789)?$this->db->insert('chats',$data):1;
                        $res = $this->db->insert('chats',$data);
                        if($res)
                        {
                            $data['id']             = $this->db->insert_id();
                            
                            $data1['user_name'] = $this->db->where('user_id',$data['receiver_id'])->get('users')->row()->user_name;
                            $data1['image'] = base_url().''.$this->db->where('user_id',$data['receiver_id'])->get('users')->row()->image;
                            $data1['category_name'] = $this->db->where('id',$data['category_id'])->get('category_adds')->row()->category_name;
                            
                            $result=["status"=>TRUE,"message" =>"success","data"=>$data,"receiver_info"=>$data1];    
                            $this->response($result, REST_Controller::HTTP_OK);
                        }
                        else
                        {
                            $message = ($lang == 'en')?'some error Please Try agian!':'بعض الخطأ يرجى المحاولة مرة أخرى!';
                            $result=["status"=>FALSE,"message" =>$message];    
                            $this->response($result, REST_Controller::HTTP_OK);
                        }
                }
                else if(sizeof($user2) > 0 && $this->post('receiver_id') =='')
                {
                   /*$query = "select receiver_id  from chats where status=1 and chat_start_end = 1 group by receiver_id";
                    $record = $this->db->query($query)->result();
                    foreach($record as $row)
                    {
                        $auth_level = $this->db->where('user_id',$row->receiver_id)->get('users')->row()->auth_level;
                        if($auth_level == 6)
                        {
                            echo $row->receiver_id.'client<br/>';
                            echo $query1 = "select free_busy, count(receiver_id) as count  from chats where receiver_id = ".$row->receiver_id." group by receiver_id";
                            $record1 = $this->db->query($query1)->result();
                            
                            //echo "<pre>";
                            print_r($record1);
                            
                        }
                    }
                    //print_r($record);
                    */
                    
                    $c1=unserialize($user2['category_id']);
                    //print_r($c1);
                    //print_r($user2);exit;
                        
                    if(in_array($data['category_id'], $c1))
                    {
                        //echo "Match found";
                        //print_r($user);exit;
                        
                        mt_srand((double)microtime()*10000);
                        $charid = md5(uniqid(rand(), true));
                        $c = unpack("C*",$charid);
                        $c = implode("",$c);
                        $c = substr($c,0,15);
                        
                        if($this->post('transaction_number'))
                        {
                            $data['transaction_number'] = $this->post('transaction_number');
                        }
                        else
                        {
                            $data['transaction_number'] = $c;
                        }
                        
                        
                        if($this->post('receiver_id'))
                        {
                            $data['receiver_id'] = $this->post('receiver_id');
                        }
                        else
                        {
                             $data['receiver_id']    = $user2['user_id'];
                        }
                        
                        //$res =  ($data['message']!=0123456789)?$this->db->insert('chats',$data):1;
                        $res = $this->db->insert('chats',$data);
                        if($res)
                        {
                           
                            $data['id']             = $this->db->insert_id();
                            
                            $data1['user_name'] = $this->db->where('user_id',$data['receiver_id'])->get('users')->row()->user_name;
                            $data1['image'] = base_url().''.$this->db->where('user_id',$data['receiver_id'])->get('users')->row()->image;
                            $data1['category_name'] = $this->db->where('id',$data['category_id'])->get('category_adds')->row()->category_name;
                            
                            $result=["status"=>TRUE,"message" =>"success","data"=>$data,"receiver_info"=>$data1,"base_url"=>base_url()];    
                            $this->response($result, REST_Controller::HTTP_OK);
                        }
                        else
                        {
                            $message = ($lang == 'en')?'some error Please Try agian!':'بعض الخطأ يرجى المحاولة مرة أخرى!';
                            $result=["status"=>FALSE,"message" =>$message];    
                            $this->response($result, REST_Controller::HTTP_OK);
                        }
                        
                        
                    }
                    else
                    {
                            $message = ($lang == 'en')?'All Agents are busy Please try agian later!':'جميع الوكلاء مشغولون يرجى المحاولة مرة أخرى في وقت لاحق';
                            $result=["status"=>FALSE,"message" =>$message];    
                            $this->response($result, REST_Controller::HTTP_OK);
                    }
                    
                    
                }
                else
                {
                    $message = ($lang == 'en')?'All Agents are busy Please try agian later!':'جميع الوكلاء مشغولون يرجى المحاولة مرة أخرى في وقت لاحق';
                    $result=["status"=>FALSE,"message" =>$message];    
                    $this->response($result, REST_Controller::HTTP_OK);
                }
              
                
            }
            else
            {
                $message = ($lang == 'en')?'Message Type incorrect.':'نوع الرسالة غير صحيح.';
                $result=["status"=>FALSE,"message" =>$message];    
                $this->response($result, REST_Controller::HTTP_OK);
            }
        }
        else
        {
            $message = ($lang == 'en')?'Please Insert Filed.':'الرجاء إدخال حقل.';
            $result=["status"=>FALSE,"message" =>$message];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
        
    }
    
    //Get Chat History
    public function chat_history_get()
    {
        $lang               =   $this->get('lang'); 
        $sender_id          =   $this->get('user_id');
        $receiver_id        =   $this->get('receiver_id');
        $transaction_number =   $this->get('transaction_number');
        $categoryId         =   ($this->get('category_id')=='other')?0:$this->get('category_id');
        
        $querry = "SELECT * FROM `chats` where sender_id IN(".$sender_id.",".$receiver_id.") and receiver_id IN(".$sender_id.",".$receiver_id.")  and category_id = ".$categoryId." and chat_start_end = 1 and status = 1 and message != 0123456789 ORDER BY `id` ASC";
		$record = $this->db->query($querry)->result();   

		if(sizeof($record)>0)
        {
            $result=["status"=>TRUE,"message" =>"Record","base_url"=>base_url(),"data"=>$record];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
        else
        {
            $message = ($lang == 'en')?'NO Record Found!':'لا يوجد سجلات';
            $result=["status"=>FALSE,"message" =>$message];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
		
    }
    
    //Profile 
    public function profile_post()
    {
        $data1['user_id'] = $this->post('user_id');
        $lang = $this->post('lang');
        
        $data['user_name']      =  $this->post('name');
        $data['password']       =  base64_encode($this->post('password'));
        
        if(!empty($_FILES['profile_image']['name']))
        {
            $image = $this->db->where('user_id',$data1['user_id'])->get('users')->row()->image;
            if($image != 'assets/uploads/user_profiles/default1.png')
            {
                unlink($image);
            }
            
            $imageFileType = strtolower(pathinfo($_FILES['profile_image']['name'],PATHINFO_EXTENSION));
            
            $config['upload_path'] = 'assets/uploads/user_profiles/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = date('Y-m-d').'-'.time().'.'.$imageFileType;
                  
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
             
            if($this->upload->do_upload('profile_image')){
            $uploadData = $this->upload->data();
            $data['image'] = $config['upload_path'].$uploadData['file_name'];
            }else{
            $data['image'] = '';
            }
        }
        else
        {
            $data['image'] = $this->db->where('user_id',$data1['user_id'])->get('users')->row()->image;
        }
        
        //print_r($data);
        $this->db->where('user_id',$data1['user_id']);
        $res = $this->db->update('users',$data);
        //echo $this->db->last_query();
        if($res)
        {
            $message = ($lang == 'en')?'Profile Updated Successfully!':'تم تحديث الحساب بنجاح';
            $result=["status"=>TRUE,"message" =>$message,"data" =>$data,"base_url"=>base_url()];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
        else
        {
            $message = ($lang == 'en')?'some error Please Try agian!':'بعض الخطأ يرجى المحاولة مرة أخرى';
            $result=["status"=>FALSE,"message" =>$message];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
        
    }
    
    //contact Us
    public function contactus_post()
    {
        $lang                   = $this->post('lang');
        //$data['name']         = $this->post('name');
        $data['email']          = $this->post('email');
        $data['phone']          = $this->post('phone');
        $data['comment']        = $this->post('comment');
        $data['insert_date']    = date('Y-m-d h:i:s');
        
        $res = $this->db->insert('contacts',$data);
        if($res)
        {
            $message = ($lang == 'en')?'Comments Inserted Successfully!':'تم تحديث الحساب بنجاح';
            $result=["status"=>TRUE,"message" =>$message,"data" =>$data];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
        else
        {
            $message = ($lang == 'en')?'some error Please Try agian!':'بعض الخطأ يرجى المحاولة مرة أخرى';
            $result=["status"=>FALSE,"message" =>$message];    
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }
    
    
}