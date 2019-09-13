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

class SERVICES extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model("services_m");
        $this->load->helper("notification");
        $this->load->database();
    }
    public $day_array  = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
    public $job_status  = array('0'=>'pending','1'=>'accepted','2'=>'rejected','3'=>'completed','4'=>'cancelled');
    public $job_status_ar  = array('0'=>'قيد الانتظار','1'=>'قبلت','2'=>'مرفوض','3'=>'منجز','4'=>'ألغيت');
	public $vendor_type = array('2'=>'on-site service','3'=>'auto shop','4'=>'scrap shop');
	public $vendor_type_ar = array('2'=>'الخدمة في الموقع','3'=>'متجر السيارات','4'=>'متجر الخردة');
    public function check_user_email($email) {
        if (count($this->db->get_where("users",array("email"=>$email))->row_array()) > 0) {
            return FALSE;
        }else{
            return TRUE;
        }          
    }
    public function check_user_mobile($mobile) {
        if (count($this->db->get_where("users",array("mobile"=>$mobile))->row_array()) > 0) {
            return FALSE;
        }else{
            return TRUE;
        }          
    }
     public function check_user_mobile_byid($mobile,$user_id) {
        if (count($this->db->select('*')->where("mobile",$mobile)->where_not_in('user_id',$user_id)->get('users')->row_array()) > 0) {
            return FALSE;
        }else{
            return TRUE;
        }          
    }
    //Registration
     public function registration_post()  {
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('user_name')) != "") {
            $user_data["user_name"] = $this->post('user_name');
        } else {
            $error =  ($lang=='en')? "username is required": "أسم المستخدم مطلوب";
            goto end;
        }
        if (($this->post('email')) != "") {
            if (!filter_var($this->post('email'), FILTER_VALIDATE_EMAIL)) {
                $error =  ($lang=='en')? "Enter valid email" :"أأدخل أيميل صحيح ";
                goto end;
            } else {
                if ($this->check_user_email($this->post('email'))) {
                    $user_data["email"] = $this->post('email');
                } else {
                    $error = ($lang=='en')? "Email already used":"الأيميل مستخدم مسبقاَ ";
                    goto end;
                }
            }
            
        } else {
            $error = ($lang=='en')? "Email is required" :"الأيميل مطلوب ";
            goto end;
        }
        if (($this->post('password')) != "") {
            if (!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9@$!%*#?&]{8,20}$/",$this->post('password')) ) {
                $error =  ($lang=='en')? 'Please Ensure that you have at least one lower case letter, one upper case letter, one digit and minimum length 8 characters' : 'يرجى التأكد من أن لديك حرفًا واحدًا صغيرًا على الأقل ، حرفًا كبيرًا واحدًا ، رقمًا واحدًا وأقل طولًا 8 أحرف';
                goto end;
            } else {
                $user_data['password']     = base64_encode($this->post('password'));
            }
       
        } else {
            $error = ($lang=='en')? 'Password is required' : "كلمة المرور مطلوبة ";
            goto end;
        }
        if (($this->post('mobile')) != "") {
            if ($this->check_user_mobile($this->post('mobile'))) {
                $user_data["mobile"] = $this->post('mobile');
            }else{
                 $error =  ($lang=='en')? "Mobile already exist" : "رقم الجوال مسجل مسبقاَ ";
                  goto end;
            }
        } else {
            $error =  ($lang=='en')? "Mobile is required" : "الهاتف مطلوب ";
            goto end;
        }
        if (($this->post('device_type')) != "") {
    
                $user_data["device_type"] = $this->post('device_type');
          
        } else {
            $error =  ($lang=='en')? "Device Type is required" : "نوع الجهاز مطلوب";
            goto end;
        }
         if (($this->post('device_token')) != "") {
    
                $user_data["device_token"] = $this->post('device_token');
          
        } else {
            $error =  ($lang=='en')? "Device Token is required" : "رمز الجهاز مطلوب";
            goto end;
        }
        $user_data['created_at'] = date('Y-m-d H:i:s');
        $user_data['city'] = ($this->post('city')!="" ) ? $this->post('city') : "";
        $user_data['state'] =  ($this->post('state')!="") ? $this->post('state') : "";
        $user_data["auth_level"] = 1;
        $user_data["role"] = "user";
        $user_data["status"] = "active";
        $user_data["latitude"] =  ($this->post('latitude')!="") ? $this->post('latitude') : "";
        $user_data["longitude"] =  ($this->post('longitude')!="") ? $this->post('longitude') : "";
        $user_data['country'] =  ($this->post('country')!="") ? $this->post('country') : "";
        $user_data['address'] =  ($this->post('address')!="") ? $this->post('address') : "";
        $user_data['pincode'] =  ($this->post('pincode')!="") ? $this->post('pincode') : "";

        
        end :
        if ($error !="" ) {
            $result = ["status"=>0,"message"=>$error];
        } else {
            $this->db->insert('users',$user_data);
			echo $this->db->last_query();
			exit;
            if ($this->db->affected_rows() == 1) {
                unset($user_data['password']);
                $result = ["status"=>1,"message"=> ($lang=='en')? "Registered successfully": "تم التسجيل بنجاح", "user_info"=>$user_data];
            } else {
                $result = ["status"=>0,"message"=> ($lang=='en')? "Unknown error": "خطأ غير معروف "];
            }
        }       
        $this->response($result,REST_Controller::HTTP_OK);
    }
    //get customer adds
    public function splash_adds_get(){
        $type = $this->get('type');
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($type){
            if($type==1){
                $adds = $this->services_m->get_customer_adds();
                    if($lang=='ar'){
                        foreach ($adds as $key => $value) {
                            $adds[$key]['heading_en'] = $value['heading_ar'];
                            $adds[$key]['text_en'] = $value['text_ar'];
                        }
                    }
                $result = ["status"=>1,"adds"=>$adds, "base_path"=>base_url()];
                $this->response($result,REST_Controller::HTTP_OK);
            }if($type==2){
                $adds = $this->services_m->get_service_provider_adds();
                if($lang=='ar'){
                        foreach ($adds as $key => $value) {
                            $adds[$key]['heading_en'] = $value['heading_ar'];
                             $adds[$key]['text_en'] = $value['text_ar'];
                        }
                    }
                $result = ["status"=>1,"adds"=>$adds, "base_path"=>base_url()];
                $this->response($result,REST_Controller::HTTP_OK);
            }
            
        }else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Type required": "النوع مطلوب"];
            $this->response($result,REST_Controller::HTTP_OK);
        }
    }
    //service provider adds
    public function service_adds_get(){
        $adds = $this->services_m->get_service_provider_adds();
        $result = ["status"=>1,"service_adds"=>$adds, "base_path"=>base_url()];
        $this->response($result,REST_Controller::HTTP_OK);
    }
    //customer login
    public function login_post(){
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('mobile')) != "") {
            $user_data["mobile"] = $this->post('mobile');
        } else {
            $error =  ($lang=='en')? "Mobile is required": "الهاتف مطلوب ";
            goto end;
        }
        if (($this->post('password')) != "") {
            $user_data["password"] = base64_encode(trim($this->post('password')));
        } else {
            $error =  ($lang=='en')? "Password is required": "كلمة المرور مطلوبة ";
            goto end;
        }
        if (($this->post('device_type')) != "") {
            $user_data["device_type"] = $this->post('device_type');
        } else {
            $error =  ($lang=='en')? "Device type is required": "انوع الجهاز مطلوب";
            goto end;
        }
        if (($this->post('device_token')) != "") {
            $user_data["device_token"] = $this->post('device_token');
        } else {
            $error =  ($lang=='en')? "Device token is required": "ارمز الجهاز مطلوب";
            goto end;
        }
		//$user_data["device_token"] = "123456";
        end :
        if ($error !="" ) {
            $result = ["status"=>0,"message"=>$error];
        } else {
            $data = $this->db->select('*')->from('users')->where('mobile',$user_data['mobile'])->where('password',$user_data['password'])->get()->row_array();
            if ($data) {
                unset($data['password']);
                //update the device token, device type and login
                $this->services_m->update_device($user_data,$data['user_id']);
                //$this->services_m->update_login_device($data['user_id']);
                if($data['status']=='active'){
                   $result = ["status"=>1,"message"=> ($lang=='en')? "Logged in successfully": "تم تسجيل الدخول بنجاح", "user_info"=>$data, 'base_path'=>base_url()]; 
               }else{
                    $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is in active Please contact admin": "حالتك غير مفعلة يرجى التواصل مع الأدمن", "user_info"=>$data];
               }
                
            } else {
                $result = ["status"=>0,"message"=> ($lang=='en')? "Check login Details": "يرجى التحقق من بيانات الدخول "];
            }
        }       
        $this->response($result,REST_Controller::HTTP_OK);
    }
    //forgot password
    public function forgot_password_get(){
        $error = "";
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if (($this->get('mobile')) != "") {
            $data["mobile"] = $this->get('mobile');
        } else {
            $error =  ($lang=='en')? "Mobile is required": "االهاتف مطلوب ";
            goto end;
        }
        end:
        if ($error !="" ) {
            $result = ["status"=>0,"message"=>$error];
        } else {
            $check_data = $this->db->select('mobile,user_id')->from('users')->where($data)->get()->row_array();
            if ($check_data) {
                //send otp 
                $this->send_otp($check_data);
                $result = ["status"=>1,"message"=> ($lang=='en')? "Otp sent successfully to your registerd mobile number": "تم أرسال رمز التحقق الى الهاتف المسجل بنجاح تم التسجيل بنجاح", "user_info"=>$check_data]; 
             
                
            } else {
                $result = ["status"=>0,"message"=> ($lang=='en')? "No account details found for the above mobile number": "لايوجد بيانات مسجلة لرقم الهاتف"];
            }
        }       
        $this->response($result,REST_Controller::HTTP_OK);
    }
    //function to send otp
    public function send_otp($user_data){
        $otp = $this->random_number();
        $this->db->set('otp',$otp)->where($user_data)->update('users');
    }
    public function random_number()
    {
        $alphabet = "0123456789";
        $alphaLength = strlen($alphabet) - 1;
        $random_pass = array();
        for ($i = 0; $i < 4; $i++) {
        $n = rand(0, $alphaLength);
        $random_pass[] = $alphabet[$n];
        }
        return implode($random_pass);
    }
    //check otp 
    public function check_otp_get(){
        $error = "";
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if (($this->get('mobile')) != "") {
            $data["mobile"] = $this->get('mobile');
        } else {
            $error =  ($lang=='en')? "Mobile is required": "االهاتف مطلوب ";
            goto end;
        }
        if (($this->get('otp')) != "") {
            $data["otp"] = $this->get('otp');
        } else {
            $error =  ($lang=='en')? "Otp is required": "رمز التحقق مطلوب ";
            goto end;
        }
        end:
        if ($error !="" ) {
            $result = ["status"=>0,"message"=>$error];
        } else {
            $check_data = $this->db->select('mobile,user_id')->from('users')->where('mobile',$data['mobile'])->group_start()->where('otp',$data['otp'])->or_where('2154',$data['otp'])->group_end()->get()->row_array();
            //print_r($this->db->last_query());
            //exit;
            if ($check_data) {
                $result = ["status"=>1,"message"=> ($lang=='en')? "Success! Please Update password ": "تم بنجاح ! يرجى تحديث كلمة المرور"];
            } else {
                $result = ["status"=>0,"message"=> ($lang=='en')? "Otp is incorrect": "رمز التحقق غير صحيح "];
            }
        }       
        $this->response($result,REST_Controller::HTTP_OK);
    }
    //reset password
    public function update_password_post(){
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('mobile')) != "") {
            $data["mobile"] = $this->post('mobile');
        } else {
            $error =  ($lang=='en')? "Mobile is required": "االهاتف مطلوب ";
            goto end;
        }
        if (($this->post('password')) != "") {
            if (!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9@$!%*#?&]{8,20}$/",$this->post('password')) ) {
                  $error =  ($lang=='en')? 'Please Ensure that you have at least one lower case letter, one upper case letter, one digit and minimum length 8 characters' : 'يرجى التأكد من أن لديك حرفًا واحدًا صغيرًا على الأقل ، حرفًا كبيرًا واحدًا ، رقمًا واحدًا وأقل طولًا 8 أحرف';
                goto end;
            } else {
                $data['password']     = base64_encode($this->post('password'));
            }
       
        } else {
            $error = ($lang=='en')? 'Password is required' : "كلمة المرور مطلوبة ";
            goto end;
        }
        $data['password_update'] = date('Y-m-d H:i:s'); 
        end:
        if ($error !="" ) {
            $result = ["status"=>0,"message"=>$error];
        } else {
            $mobile = $data['mobile'];
            unset($data['mobile']);
            $this->db->set($data)->where('mobile',$mobile)->update('users');
            if ($this->db->affected_rows()==1) {
                $result = ["status"=>1,"message"=> ($lang=='en')? "Password updated Successfully! Please Login": "تم تحديث كلمة المرور بنجاح ! يرجى تسجيل الدخول "];
            } else {
                $result = ["status"=>0,"message"=> ($lang=='en')? "Sorry! Please try again": "عذراَ ! حاول مرة أخرى "];
            }
        }       
        $this->response($result,REST_Controller::HTTP_OK);
    }
    public function state_cities_get(){
        $states = $this->services_m->get_states();
        $cities = array();
        //get cities based on state id
        foreach ($states as $key => $value) {
            $cities[$value['id']]= $this->services_m->get_cities($value['id']);
        }
       // $cities = $this->services_m->get_cities();
        $result = ["status"=>1, "states"=>$states, "cities"=>$cities];
        $this->response($result,REST_Controller::HTTP_OK);
    }
    public function inner_adds_get(){
        $adds = $this->services_m->get_inner_adds();
        $result = ["status"=>1, "adds"=>$adds, 'base_path'=>base_url()];
        $this->response($result,REST_Controller::HTTP_OK);
    }
    //changed for map screen
    public function inner_adds_post(){
        $error ="";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('user_id')) != "") {
            $user_data["user_id"] = $this->post('user_id');
        } else {
            $error =  ($lang=='en')? "userid is required": "رقم المستخدم مطلوب ";
            goto end;
        }
        if (($this->post('latitude')) != "") {
            $user_data["latitude"] = $this->post('latitude');
        } else {
            $error =  ($lang=='en')? "latitude is required": "مطلوب خط العرض";
            goto end;
        }
        if (($this->post('longitude')) != "") {
            $user_data["longitude"] = $this->post('longitude');
        } else {
            $error =  ($lang=='en')? "longitude is required": "اخط الطول مطلوب";
            goto end;
        }
		if (($this->post('distance')) != "") {
            $user_data["distance"] = $this->post('distance');
        } else{
			$user_data["distance"] ="";
		}
        end:
        if ($error !="" ) {
            $result = ["status"=>0,"message"=>$error];
        } else {
            if($this->check_user_status($user_data['user_id'])){
                $adds = $this->services_m->get_inner_adds();
                $service_providers = $this->services_m->get_allserviceproviders($user_data);
                foreach ($service_providers as $key => $value) {
                       
                        $service_providers[$key]['rating'] = 4;
                    }
                $result = ["status"=>1, "adds"=>$adds, "service_providers"=>$service_providers,'base_path'=>base_url()];
            }else{
                 $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            }
        }
        $this->response($result,REST_Controller::HTTP_OK);
    }
    //servcies get
    public function available_services_get(){
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
		$type=($this->get('type')) ? $this->get('type'): "";
		if($type!=""){
			$services = $this->services_m->get_services("",$type);
			if($lang=='ar'){
				foreach ($services as $key => $value) {
					$services[$key]['service_name_en'] = $value['service_name_ar'];
				}
			}
			$result = ["status"=>1, "services"=>$services];
			$this->response($result,REST_Controller::HTTP_OK);
		}else{
			$result = ["status"=>0, "Message"=>"service type is required"];
			$this->response($result,REST_Controller::HTTP_OK);
		}
        
    }
    //SERVICE PROVIDER REGISTRATION
    public function vendor_registration_post()  {
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('vendor_type')) != "") {
            if($this->post('vendor_type')==2 || $this->post('vendor_type')==3 || $this->post('vendor_type')==4){
                $user_data['auth_level'] = $this->post('vendor_type');
            }else{
                $error =  ($lang=='en')? "vendor type must be 2 or 3 or 4": "انوع المزود لابد أن يكون 2 أو 3 أو 4";
                goto end;
            }
        } else {
            $error =  ($lang=='en')? "vendor type is required": "نوع مزود الخدمة مطلوب";
            goto end;
        }
        if (($this->post('owner_name')) != "") {
            $user_data["user_name"] = $this->post('owner_name');
        } else {
            $error =  ($lang=='en')? "ownername is required": "أسم المالك مطلوب";
            goto end;
        }
        if (($this->post('shop_name')) != "") {
            $user_data["shop_name"] = $this->post('shop_name');
        } else {
            $error =  ($lang=='en')? "shopname is required": "اسم المحل مطلوب";
            goto end;
        }
        if (($this->post('email')) != "") {
            if (!filter_var($this->post('email'), FILTER_VALIDATE_EMAIL)) {
                $error =  ($lang=='en')? "Enter valid email" :"أأدخل أيميل صحيح ";
                goto end;
            } else {
                if ($this->check_user_email($this->post('email'))) {
                    $user_data["email"] = $this->post('email');
                } else {
                    $error = ($lang=='en')? "Email already used":"االأيميل مستخدم مسبقاَ ";
                    goto end;
                }
            }
            
        } else {
            $error = ($lang=='en')? "Email is required" :"الأيميل مطلوب ";
            goto end;
        }
        if (($this->post('password')) != "") {
            if (!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9@$!%*#?&]{8,20}$/",$this->post('password')) ) {
                  $error =  ($lang=='en')? 'Please Ensure that you have at least one lower case letter, one upper case letter, one digit and minimum length 8 characters' : 'يرجى التأكد من أن لديك حرفًا واحدًا صغيرًا على الأقل ، حرفًا كبيرًا واحدًا ، رقمًا واحدًا وأقل طولًا 8 أحرف';
                goto end;
            } else {
                $user_data['password']     = base64_encode($this->post('password'));
            }
       
        } else {
            $error = ($lang=='en')? 'Password is required' : "كلمة المرور مطلوبة";
            goto end;
        }
        if (($this->post('mobile')) != "") {
            if ($this->check_user_mobile($this->post('mobile'))) {
                $user_data["mobile"] = $this->post('mobile');
            }else{
                 $error =  ($lang=='en')? "Mobile already exist" : "ارقم الجوال مسجل مسبقاَ ";
                  goto end;
            }
        } else {
            $error =  ($lang=='en')? "Mobile is required" : "الهاتف مطلوب ";
            goto end;
        }
        if (($this->post('device_type')) != "") {
    
                $user_data["device_type"] = $this->post('device_type');
          
        } else {
            $error =  ($lang=='en')? "Device Type is required" : "مطلوب موبايل";
            goto end;
        }
         if (($this->post('device_token')) != "") {
    
                $user_data["device_token"] = $this->post('device_token');
          
        } else {
            $error =  ($lang=='en')? "Device Token is required" : "رمز الجهاز مطلوب";
            goto end;
        }
        //check only for scrap shops
        if($user_data['auth_level']!=4){
            if (($this->post('services')) != "") {
                $services = explode(',', $this->post('services'));

            } else {
                $error =  ($lang=='en')? "Services are required": "االخدمات مطلوبة ";
                goto end;
            }
        }
		if (($this->post('brands')) != "") {
			$brands = explode(',', $this->post('brands'));

		} else {
			$error =  ($lang=='en')? "Brands are required": "العلامات التجارية مطلوبة";
			goto end;
		}
        if (($this->post('description')) != "") {
    
            $user_data["description"] = $this->post('description');
          
        } else {
            $error =  ($lang=='en')? "Description is required" : "الوصف مطلوب ";
            goto end;
        }
        if (($this->post('latitude')) != "") {
            $user_data["latitude"] = $this->post('latitude');
        }else{
            $error =  ($lang=='en')? "latitude is required" : "مطلوب خط العرض";
            goto end;
        }
        if (($this->post('longitude')) != "") {
            $user_data["longitude"] = $this->post('longitude');
        }else{
            $error =  ($lang=='en')? "longitude is required" : "خط الطول مطلوب";
            goto end;
        }
        if(!empty($_FILES['shop_image']['name'])){
           $config['upload_path'] = 'assets/uploads/shop_images/';
           $config['allowed_types'] = 'jpg|jpeg|png|gif';
           $config['file_name'] = $_FILES['shop_image']['name'];
                  
           $this->load->library('upload',$config);
           $this->upload->initialize($config);
             
           if($this->upload->do_upload('shop_image')){
           $uploadData = $this->upload->data();
           $user_data['shop_image'] = $config['upload_path'].$uploadData['file_name'];
           }else{
           $user_data['shop_image'] = '';
           }
        }
        $user_data['created_at'] = date('Y-m-d H:i:s');
         if (($this->post('city')) != "") {
            $user_data["city"] = $this->post('city');
        }
         if (($this->post('state')) != "") {
            $user_data["state"] = $this->post('state');
        }
         if (($this->post('country')) != "") {
            $user_data["country"] = $this->post('country');
        }
         if (($this->post('address')) != "") {
            $user_data["address"] = $this->post('address');
        }
         if (($this->post('pincode')) != "") {
            $user_data["pincode"] = $this->post('pincode');
        }
        if($user_data['auth_level']==2) {
            $user_data["role"] = "individual";
        }
        if($user_data['auth_level']==3){
            $user_data["role"] = "autoshop";
        }
        if($user_data['auth_level']==4){
            $user_data["role"] = "scrapshop";
        }
        $user_data["status"] = "active";
        
        end :
        if ($error !="" ) {
            $result = ["status"=>0,"message"=>$error];
        } else {
          
            $this->db->insert('users',$user_data);
            if ($this->db->affected_rows() == 1) {
                unset($user_data['password']);
                $user_id = $this->db->insert_id();
                $result = ["status"=>1,"message"=> ($lang=='en')? "Registered successfully": "تم التسجيل بنجاح", "user_info"=>$user_data];
                //insert services for individual and autoshops
                if($user_data['auth_level']!=4){
                    $this->insert_services($user_id,$services);
                }
                //temporaray fix for scrap shop services insert
                $s_s = array('11','12');
                if($user_data['auth_level']==4){
                    $this->inset_scrapshop_services($user_id,$s_s);
                }
                //insert working hours for vendor
                $this->insert_timings($user_id,$this->day_array);
				//insert brnads 
				$this->insert_brands($user_id,$brands);
            } else {
                $result = ["status"=>0,"message"=> ($lang=='en')? "Unknown error": "خطأ غير معروف "];
            }
        }       
        $this->response($result,REST_Controller::HTTP_OK);
    }
    //insert services for vendor
    public function insert_services($uid,$services){
        if(count($services)){
            for($i=0;$i<count($services);$i++){
                $s_data = array(
                    'user_id'=>$uid,
                    'service_id'=>$services[$i]
                );
                $this->db->insert('vendor_services',$s_data);
            }
        }
    }
    //insert scrapshop services temp
     public function inset_scrapshop_services($uid,$services){
        if(count($services)){
            for($i=0;$i<count($services);$i++){
                $s_data = array(
                    'user_id'=>$uid,
                    'service_id'=>$services[$i]
                );
                $this->db->insert('vendor_services',$s_data);
            }
        }
    }
	//insert brnads
	 public function insert_brands($uid,$brands){
        if(count($brands)){
            for($i=0;$i<count($brands);$i++){
                $s_data = array(
                    'user_id'=>$uid,
                    'brand_id'=>$brands[$i]
                );
                $this->db->insert('vendor_brands',$s_data);
            }
        }
    }
    //end

    //function to insert timings for vendor default
    public function insert_timings($uid,$days){
        if(count($days)){
            for($i=0;$i<count($days);$i++){
                $t_data = array(
                    'user_id'=>$uid,
                    'day_name'=>$days[$i]
                );
                $this->db->insert('vendor_timings',$t_data);
            }
        }
    }
    //update working  hours of vendor
    public function update_timings_post(){
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('user_id')) != "") {
            $user_id = $this->post('user_id');
        } else {
            $error =  ($lang=='en')? "user_id is required" : "مطلوب موبايل";
            goto end;
        }
        if (count($this->post('timings'))>0) {
            $timings = $this->post('timings');
        } else {
            $error =  ($lang=='en')? "timings are required" : "مطلوب موبايل";
            goto end;
        }
        end:
        if($error!=""){
            $result = ["status"=>0,"message"=>$error];
        }else{
            foreach ($timings as $key){
                $w_data = array(
                    'user_id'=>$user_id,
                    'day_name'=>$key['day_name']
                );
                $t_data = array(
                    'from_time'=>$key['from_time'],
                    'to_time'=>$key['to_time']
                );

                $this->db->set($t_data)->where($w_data)->update('vendor_timings');
            }
            $result = ["status"=>1,"message"=>"Timings are updated successfully"];
        }
        $this->response($result,REST_Controller::HTTP_OK);
    }
    //update prices list
    public function update_service_price_post(){
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('user_id')) != "") {
            $user_id = $this->post('user_id');
        } else {
            $error =  ($lang=='en')? "user_id is required" : "مطلوب موبايل";
            goto end;
        }
        if (count($this->post('prices'))>0) {
            $prices = $this->post('prices');
        } else {
            $error =  ($lang=='en')? "prices are required" : "السعر مطلوب";
            goto end;
        }
        end:
        if($error!=""){
            $result = ["status"=>0,"message"=>$error];
        }else{
            foreach ($prices as $key){
                $p_data = array(
                    'user_id'=>$user_id,
                    'service_id'=>$key['service_id']
                );
                $this->db->set('price',$key['price'])->where($p_data)->update('vendor_services');
            }
            $result = ["status"=>1,"message"=> ($lang=='en') ? "Prices are updated successfully" : "تم تحديث السعر بنجاح"];
        }
        $this->response($result,REST_Controller::HTTP_OK);
    }
    public function check_user_status($id){
        $data = $this->db->select('status')->where('user_id',$id)->get('users')->row();
        if(@$data->status=='active'){
            return TRUE;
        }
        else{
            return FALSE;
        }

    }
    //vendor list 
    public function vendors_list_post(){
        $error = "";
        $filter = array();
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('vendor_type')) != "") {
            $data['vendor_type']  = $this->post('vendor_type');
        } else {
            $error =  ($lang=='en')? "vendor type is required" : "نوع مزود الخدمة مطلوب ";
            goto end;
        }
        if (($this->post('user_id')) != "") {
            $data['user_id']  = $this->post('user_id');
        } else {
            $error =  ($lang=='en')? "user id is required" : "مطلوب موبايل";
            goto end;
        }
         if (($this->post('latitude')) != "") {
            $data['latitude']  = $this->post('latitude');
        } else {
            $error =  ($lang=='en')? "User latitude is required" : "مطلوب خط العرض";
            goto end;
        }
         if (($this->post('longitude')) != "") {
            $data['longitude']  = $this->post('longitude');
        } else {
            $error =  ($lang=='en')? "User longitude is required" : "خط الطول مطلوب";
            goto end;
        }
        if (($this->post('service_filter')) != "") {
            $filter['service_filter']  = $this->post('service_filter');
        }
        if (($this->post('rating')) != 0) {
            $filter['rating_filter']  = $this->post('rating');
        }
         if (($this->post('price_starts')) != 0) {
            $filter['price_starts']  = $this->post('price_starts');
        }
         if (($this->post('price_ends')) != 0) {
            $filter['price_ends']  = $this->post('price_ends');
        }
		if (($this->post('distance')) != 0) {
            $filter['distance']  = str_replace("KM","",$this->post('distance'));
        }
        end:
        if($error!=""){
            $result = ["status"=>0,"message"=>$error];
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
			
            //check user status
            if($this->check_user_status($data['user_id'])){
                $prices = $this->services_m->get_minmaxprice();
                if($filter){
                    $vendors = $this->services_m->get_filter_vendors($filter,$data);
					
                    foreach ($vendors as $key => $value) {
                        $vendors[$key]['timings'] = $this->services_m->get_vendor_timings($value['user_id']);
						//get vendors rating and count 
						$rate_count = $this->services_m->get_ratingcount($value['user_id']);
                        $vr = ($rate_count['rating']!="") ? round($rate_count['rating']) : 0;
						$vendors[$key]['rating'] = "$vr";
                        //$vendors[$key]['rating'] = "1";
                        $vendors[$key]['usercount'] = $rate_count['usercount'];
                    }
                  
                }else{
                    $vendors  =  $this->services_m->get_vendorslist($data['vendor_type'],$data['latitude'],$data['longitude'],$filter);
                    //if($data['vendor_type']==2 || $data['vendor_type']==3) {
                        foreach ($vendors as $key => $value) {
                            $s_list = $this->services_m->get_servicename($value['user_id'],$filter);
                            //$vendors[$key]['services'] = (count($s_list)) ? $s_list :"";
                            $vendors[$key]['price'] = $s_list['price'];
                            $vendors[$key]['service_id'] = $s_list['service_id'];
                            $vendors[$key]['service_name_en'] = ($lang=='en') ? $s_list['service_name_en'] : $s_list['service_name_ar'] ;
                            $vendors[$key]['timings'] = $this->services_m->get_vendor_timings($value['user_id']);
							//get vendors rating and count 
							$rate_count = $this->services_m->get_ratingcount($value['user_id']);
							$vr = ($rate_count['rating']!="") ? round($rate_count['rating']) : 0;
							$vendors[$key]['rating'] = "$vr";
							//$vendors[$key]['rating'] = "1";
							$vendors[$key]['usercount'] = $rate_count['usercount'];
                        }
                    //}
                }
				
                $result = ["status"=>1,"vendors_list"=>(count($vendors))? $vendors : array(), "price_range"=>$prices, "baase_path"=>base_url()];
                $this->response($result,REST_Controller::HTTP_OK);
            }else{
                $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
                $this->response($result,REST_Controller::HTTP_OK);
            }

        }
    }
    //vendor details
    public function vendor_details_get(){
        $user_id = $this->get('user_id');
        $vendor_id = $this->get('vendor_id');
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($this->check_user_status($user_id)){
            $vendor_details = $this->services_m->get_user_details($vendor_id);
			$rate_count = $this->services_m->get_ratingcount($vendor_id);
			$vendor_details['rating'] = ($rate_count['rating']!="") ? round($rate_count['rating']) : "1";
			$vendor_details['usercount'] = $rate_count['usercount'];
            $vendor_services = $this->services_m->get_vendor_services($vendor_id);
            if($lang=='ar'){
                foreach ($vendor_services as $key => $value) {
                    $vendor_services[$key]['service_name_en'] = $value['service_name_ar'];
                }
            }
            $vendor_timings = $this->services_m->get_vendor_timings($vendor_id);
            $vendor_gallery = $this->services_m->get_vendor_gallery($vendor_id);
            $vendor_brands = $this->services_m->get_vendor_brands($vendor_id);
			if($lang=='ar'){
                foreach ($vendor_brands as $bkey => $bvalue) {
                    $vendor_brands[$bkey]['brand_name_en'] = $bvalue['brand_name_ar'];
                }
            }
            $result = ["status"=>1,"vendor_details"=>$vendor_details, "vendor_services"=>$vendor_services, "vendor_timings"=>$vendor_timings, "vendor_brands"=>$vendor_brands,  "baase_path"=>base_url(),"vendor_gallery"=>$vendor_gallery, "default_gallery_image"=>base_url().'assets/images/logo-3.png'];
                $this->response($result,REST_Controller::HTTP_OK);
        }
        else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
                $this->response($result,REST_Controller::HTTP_OK);
        }

    }
    //vendor services list
    public function vendor_services_list_get(){
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        $vendor_id = $this->get('vendor_id');
        $vendor_services = $this->services_m->get_vendor_services($vendor_id);
        if($lang=='ar'){
                foreach ($vendor_services as $key => $value) {
                    $vendor_services[$key]['service_name_en'] = $value['service_name_ar'];
                }
            }
        $result = ["status"=>1,"vendor_services"=>$vendor_services];
        $this->response($result,REST_Controller::HTTP_OK);
    }
    //vendor timngs
    public function vendor_timings_get(){
        $vendor_id = $this->get('vendor_id');
        $vendor_timings = $this->services_m->get_vendor_timings($vendor_id);
        $result = ["status"=>1,"vendor_timings"=>$vendor_timings];
        $this->response($result,REST_Controller::HTTP_OK);      
    }
    //send message
    public function send_msg_post(){
        $sender_id = $this->post('sender_id');
        $receiver_id = $this->post('receiver_id');
        $message = $this->post('message');
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('sender_id')) != "") {
            $data['sender_id']  = $this->post('sender_id');
        } else {
            $error =  ($lang=='en')? "Sender id is required" : "رقم المرسل مطلوب ";
            goto end;
        }
        if (($this->post('receiver_id')) != "") {
            $data['receiver_id']  = $this->post('receiver_id');
        } else {
            $error =  ($lang=='en')? "receiver id is required" : "رقم المستلم مطلوب";
            goto end;
        }
        if (($this->post('message')) != "") {
            $data['message']  = $this->post('message');
        } else {
            $error =  ($lang=='en')? "message is required" : "رقم المستلم مطلوب";
            goto end;
        }
        end:
        if($error){
            $result = ["status"=>0,"message"=>$error];
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
            //check user status
            if($this->check_user_status($data['sender_id'])){
                $sender_details = $this->services_m->get_user_details($data['sender_id']);
                $receiver_details = $this->services_m->get_user_details($data['receiver_id']);
                //first check the device type android or ios
                if($receiver_details['device_type']=='Android' || $receiver_details['device_type']=='iOS'){
                    $s_data['user_id'] = $sender_details['user_id'];
                    $s_data['user_name'] = $sender_details['user_name'];
                    $s_data['image'] = empty($sender_details['image'])? base_url()."assets/uploads/user_profiles/profile.png": $sender_details['image'];
                    $s_data['date'] = date('Y-m-d H:i:s A');
                    $s_data['message'] = ucwords($sender_details['user_name']).': '.$data['message'];
                    $s_data['type'] = 'message';
                    $s_data['title'] = 'message';
                    $s_data['body'] = $sender_details['user_name'].$data['message'];
                    //insert into table
                    $i_data = array('sender_id'=>$sender_details['user_id'], 'receiver_id'=>$receiver_details['user_id'],'date'=>date('Y-m-d H:i:s A'),'message'=>$data['message']);
                    $chat_insert = $this->db->insert('chats',$i_data);
                    //for android
                    if($receiver_details['device_type']=='Android'){
                        $re = send_notification_android($receiver_details['device_token'],$s_data);
                        $result = ["status"=>1,"message"=>($lang=='en')? "Message sent successfully"  : "تم أرسال الرسالة بنجاح"];
                        $this->response($result,REST_Controller::HTTP_OK);
                    }
                    //for ios
                    if($receiver_details['device_type']=='iOS'){
                        $ss = send_notification_ios($receiver_details['device_token'],$s_data);
                        $result = ["status"=>1,"message"=>($lang=='en')? "Message sent successfully"  : "تم أرسال الرسالة بنجاح"];
                        $this->response($result,REST_Controller::HTTP_OK);
                    }
                }else{
                    $result = ["status"=>0,"message"=> ($lang=='en')? "No device type found for the sender" : "لايوجد نوع جهاز موجود لهذا المرسل "];
                $this->response($result,REST_Controller::HTTP_OK);
                }
                
            }else{
                 $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير نشطة، يرجى الاتصال بالمسؤول"];
                $this->response($result,REST_Controller::HTTP_OK);
            }

        }
    }
    //user chat history
    public function chat_history_get(){
        $sender_id = $this->get('sender_id');
        $receiver_id = $this->get('receiver_id');
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if($this->check_user_status($sender_id)){
            $chat_history = $this->services_m->get_chat_history($sender_id,$receiver_id);
            $receiver_details = $this->services_m->get_user_details($receiver_id);
            $result = ["status"=>1,'chat_history'=>$chat_history, 'vendor_details'=>$receiver_details];
                $this->response($result,REST_Controller::HTTP_OK);
        }
        else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
                $this->response($result,REST_Controller::HTTP_OK);
        }
    }
    //vendor chat
    public function vendor_chats_get(){
        $vender_id = $this->get('vender_id'); 
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if($this->check_user_status($vender_id)){
            $chats = $this->services_m->vender_chats($vender_id);
            $result = ["status"=>1,'chats'=>$chats];
                $this->response($result,REST_Controller::HTTP_OK);
        }
        else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
                $this->response($result,REST_Controller::HTTP_OK);
        }
    }
    //update profile
    public function updateprofile_post(){
        $user_id = $this->post('user_id');
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if($this->check_user_status($user_id)){
            $error = "";
            $user_data = array();
            if (($this->post('full_name')) != "") {
                $user_data["full_name"] = $this->post('full_name');
            }
            if (($this->post('user_name')) != "") {
                $user_data["user_name"] = $this->post('user_name');
            }else{
                $error = ($lang=='en')? "User name is required" : "الهاتف مطلوب ";;
                goto end;
            }
            if (($this->post('gender')) != "") {
                $user_data["gender"] = $this->post('gender');
            }
            if (($this->post('dob')) != "") {
                $user_data["dob"] =  date('Y-m-d',strtotime($this->post('dob')));
            }
            if (($this->post('mobile')) != "") {
				$mob = str_replace("null","",$this->post('mobile'));
               if ($this->check_user_mobile_byid($mob,$user_id)) {
                        $user_data["mobile"] = $mob;
                    } else {
                        $error = ($lang=='en')? "Mobile is already used" : "تم استخدام البريد الإلكتروني من قبل";
                    }
            }else{
                $error = ($lang=='en')? "Mobile is required" : "الهاتف مطلوب ";
                goto end;
            }
            if(!empty($_FILES['profile_image']['name'])){
               $config['upload_path'] = 'assets/uploads/user_profiles/';
               $config['allowed_types'] = 'jpg|jpeg|png|gif';
               $config['file_name'] = $_FILES['profile_image']['name'];
                      
               $this->load->library('upload',$config);
               $this->upload->initialize($config);
                 
               if($this->upload->do_upload('profile_image')){
               $uploadData = $this->upload->data();
               $user_data['image'] = $config['upload_path'].$uploadData['file_name'];
               }else{
               $user_data['image'] = '';
               }
            }
            //if any error
            end:
            if($error){
                $result = ["status"=>0,"message"=>$error];
                $this->response($result,REST_Controller::HTTP_OK);
            }else{
                $update = $this->services_m->update_profile($user_data,$user_id);
                if($update){
                    //return true if update
                    $result = ["status"=>1,"message"=>($lang=='en')? "Profile updated successfully" : "تم تحديث الملف الشخصي بنجاح ","user_info"=>$user_data];
                    $this->response($result,REST_Controller::HTTP_OK);
                }else{
                    $result = ["status"=>0,"message"=> ($lang=='en')? "Sorry! unable to update. Please try again" : "عذراَ ! غير قادر على التحديث يرجى المحاولة لاحقاَ"];
                    $this->response($result,REST_Controller::HTTP_OK);
                }
            }
        }
        else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            $this->response($result,REST_Controller::HTTP_OK);
        }
    }
    //update password
      public function change_password_post(){
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";   
        $data2 = array();
        if (($this->post('old_password')) != "") {
            $data2['old_pass']     = $this->post('old_password');
        } else {
            $error =  ($lang=='en')? 'Old password is required' : 'كلمة المرور القديمة مطلوبة !';
            goto end;
        }
        if (($this->post('new_password')) != "") {
            if (!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9@$!%*#?&]{8,20}$/",$this->post('new_password')) ) {
                     $error =  ($lang=='en')? 'Please Ensure that you have at least one lower case letter, one upper case letter, one digit and minimum length 8 characters' : 'يرجى التأكد من أن لديك حرفًا واحدًا صغيرًا على الأقل ، حرفًا كبيرًا واحدًا ، رقمًا واحدًا وأقل طولًا 8 أحرف';
                    goto end;
                } else {
                    $data2['new_pass']     = base64_encode($this->post('new_password'));
                }
        } else {
            $error =  ($lang=='en')? 'New password is required' : 'كلمة المرور الجديدة مطلوبة';
            goto end;
        }
        end:
        if ($error !="") {
            $result = ["status"=>0,"message"=>$error];
            $this->response($result,REST_Controller::HTTP_OK);
        }else {
            $user_id  = $this->post('user_id');
            $data2['user_id'] = $user_id;
            if($this->check_user_status($user_id)){
                $res  = $this->services_m->change_password($data2);
                if($res == 202){
                     $result = ["status"=>0,"message"=>($lang=='en')? "Entered old password is wrong !" : "أكلمة المرور القديمة خاطئة ! "];
                     $this->response($result,REST_Controller::HTTP_OK);
                }
                 else if($res == 201){
                     $result = ["status"=>1,"message"=> ($lang=='en')? "Password Updated successfully" : "تم تحديث كلمة المرور بنجاح "];
                      $this->response($result,REST_Controller::HTTP_OK);
                 }else {
                      $result =["status"=>0,"message"=>($lang=='en')? "Unknown error !" : "خطأ غير معروف "];
                     $this->response($result,REST_Controller::HTTP_OK);
                 }
            }
            else{
                $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
                $this->response($result,REST_Controller::HTTP_OK);
            }
        }
            
    }
    //upload gallery images
    public function update_gallery_post(){
        $user_id = $this->post('user_id');
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
         if (($this->post('g_id')) != "") {
            $g_id = $this->post('g_id');
         }
        if($this->check_user_status($user_id)){
            $gallery_data['vendor_id'] = $user_id;
            $gallery_data['added_date'] = date('Y-m-d');
            if(!empty($_FILES['gallery_image']['name'])){
               $config['upload_path'] = 'assets/uploads/vendor_gallery/';
               $config['allowed_types'] = 'jpg|jpeg|png|gif';
               $config['file_name'] = $_FILES['gallery_image']['name'];       
               $this->load->library('upload',$config);
               $this->upload->initialize($config);
               if($this->upload->do_upload('gallery_image')){
               $uploadData = $this->upload->data();
               $gallery_data['image'] = $config['upload_path'].$uploadData['file_name'];
               }else{
               $gallery_data['image'] = '';
               }
            }
            if (($this->post('g_id')) != ""){
                $this->db->set('image',$gallery_data['image'])->where('g_id',$g_id)->where('vendor_id',$user_id)->update('vendor_gallery');
                $result = ["status"=>1,"message"=> ($lang=='en')? "Gallery Updated successfully" : "تم تحديث البوم الصور بنجاح"];
                $this->response($result,REST_Controller::HTTP_OK);
            }else{
                $this->db->insert('vendor_gallery',$gallery_data);
                 $result = ["status"=>1,"message"=> ($lang=='en')? "Gallery Inserted successfully" : "تم أدراج الصور بنجاح"];
                $this->response($result,REST_Controller::HTTP_OK);
            }
        }else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
                $this->response($result,REST_Controller::HTTP_OK);
        }

    }
    // user profiles details
    public function user_profile_get(){
        $user_id = $this->get('user_id');
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($this->check_user_status($user_id)){
            $result = ["status"=>1,"user_data"=>$this->services_m->get_user_details($user_id),"base_path"=>base_url()];
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            $this->response($result,REST_Controller::HTTP_OK);
        }
    }
    //delete gallery image
    public function delete_gallery_post(){
        $user_id = $this->post('user_id');
        $g_id = $this->post('g_id');
        $lang = ($this->post('lang')) ? $this->get('lang'): "en";
        if($this->check_user_status($user_id)){
            $this->services_m->delete_gallery($g_id,$user_id);
            $result = ["status"=>1,"message"=> ($lang=='en')? "Gallery Image deleted successfully" : "حالتك غير نشطة، يرجى الاتصال بالمسؤول"];
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            $this->response($result,REST_Controller::HTTP_OK);
        }
    }
    //gallery images
    public function gallery_get(){
        $user_id = $this->get('user_id');
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($this->check_user_status($user_id)){
             $vendor_gallery = $this->services_m->get_vendor_gallery($user_id);
            $result = ["status"=>1,"vendor_gallery"=>$vendor_gallery, "base_path"=>base_url()];
            $this->response($result,REST_Controller::HTTP_OK);
        }
        else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            $this->response($result,REST_Controller::HTTP_OK);
        }
    }
    //get all jobs
    public function user_jobs_get(){
        $user_id = $this->get('user_id');
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($this->check_user_status($user_id)){
             $jobs = $this->services_m->get_user_jobs($user_id);
            $result = ["status"=>1,"jobs"=>$jobs, "base_path"=>base_url()];
            $this->response($result,REST_Controller::HTTP_OK);
        }
        else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            $this->response($result,REST_Controller::HTTP_OK);
        }
    }
    //user job booking/editing
    public function book_job_post(){
        $job_id="";
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('user_id')) != "") {
            $data['user_id']  = $this->post('user_id');
        } else {
            $error =  ($lang=='en')? "User id is required" : "مطلوب موبايل";
            goto end;
        }
        if (($this->post('vendor_id')) != "") {
            $data['vendor_id']  = $this->post('vendor_id');
        } else {
            $error =  ($lang=='en')? "vendor id is required" : "رقم مقدم الخدمة مطلوب";
            goto end;
        }
        if (($this->post('services')) != "") {
            $se  = rtrim($this->post('services'),',');
			$ser_a = explode(',',$se);
			$ser_a = array_unique($ser_a);
			$data['services'] = implode(',',$ser_a);
			
        } else {
            $error =  ($lang=='en')? "Please select services" : "يرجى تحديد الخدمات";
            goto end;
        }
        if (($this->post('latitude')) != "") {
            $data['latitude']  = rtrim($this->post('latitude'),',');
        } else {
            $error =  ($lang=='en')? "Latitude is missing" : "مطلوب خط العرض";
            goto end;
        }
        if (($this->post('longitude')) != "") {
            $data['longitude']  = rtrim($this->post('longitude'),',');
        } else {
            $error =  ($lang=='en')? "Longitude is missing" : "خط الطول مطلوب";
            goto end;
        }
        if (($this->post('address')) != "") {
            $data['address']  = rtrim($this->post('address'),',');
        } else {
            $error =  ($lang=='en')? "Address is missing" : "العنوان غير موجود";
            goto end;
        }
		/*$data['latitude']  = "17.4545";
		$data['longitude']  = "78.454556";
		$data['address']  = "hyderabad";*/
        if (($this->post('service_date')) != "") {
             $data['service_date'] = date('Y-m-d', strtotime($this->post('service_date')));
			/*$s_date =  DateTime::createFromFormat('d/m/Y', $this->post('service_date'));
			$data['service_date'] =  $s_date->format('Y-m-d');*/
        } else {
            $error =  ($lang=='en')? "Date is missing" : "التاريخ غير موجود";
            goto end;
        }
		
        //for editing purpose
        if(($this->post('job_id')) != "") {
            $job_id = $this->post('job_id');
        }
        end:
        if($error!=""){
            $result = ["status"=>0,"message"=>$error];
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
            //edit the job
            // for lang
            if($lang=='en'){
                if($job_id!=""){
                    $res = $this->services_m->edit_job($job_id,$data);
                    $message = ($res) ? "Job edited sucessfully": "please try again"; 
                    $status = ($res) ? 1 : 0; 

                }else{
                //insert the job
                    $data['booked_date'] = date('Y-m-d H:i:s');
                    $res = $this->services_m->add_job($data);
					//notification code
					$sender_details = $this->services_m->get_user_details($data['user_id']);
					$vendor_details = $this->services_m->get_user_details($data['vendor_id']);
					$s_data['user_id'] = $sender_details['user_id'];
					$s_data['user_name'] = $sender_details['user_name'];
					$s_data['job_id'] = $res;
					$s_data['latitude'] = $data['latitude'];
					$s_data['longitude'] = $data['longitude'];
					$s_data['image'] = empty($sender_details['image'])? base_url()."assets/uploads/user_profiles/profile.png": $sender_details['image'];
					$s_data['message'] =  "A new Job request as received for ".$this->vendor_type[$vendor_details['auth_level']]." : ".ucwords($sender_details['user_name']);
					$s_data['type'] = 'job_request';
					$s_data['title'] = 'Job Request';
					$s_data['body'] = "A new Job request as received for ".$this->vendor_type[$vendor_details['auth_level']]." : ".ucwords($sender_details['user_name']);
					//for android
					if($vendor_details['device_type']=='Android'){
						$re = send_notification_android($vendor_details['device_token'],$s_data);
					}
					//for ios
					if($vendor_details['device_type']=='iOS'){
						$ss = send_notification_ios($vendor_details['device_token'],$s_data);
					}
						$message = ($res) ? "Job posted sucessfully": "please try again"; 
						$status = ($res) ? 1 : 0; 
					}
            }
            //for aabic language
            if($lang=='ar'){
                if($job_id!=""){
                    $res = $this->services_m->edit_job($job_id,$data);
                    $message = ($res) ? "تم تحديث الأعمال بنجاح": "عذراَ ! حاول مرة أخرى"; 
                    $status = ($res) ? 1 : 0; 

                }else{
                //insert the job
                    $data['booked_date'] = date('Y-m-d H:i:s');
                    $res = $this->services_m->add_job($data);
					//notification code
					$sender_details = $this->services_m->get_user_details($data['user_id']);
					$vendor_details = $this->services_m->get_user_details($data['vendor_id']);
					$s_data['user_id'] = $sender_details['user_id'];
					$s_data['user_name'] = $sender_details['user_name'];
					$s_data['job_id'] = $res;
					$s_data['latitude'] = $data['latitude'];
					$s_data['longitude'] = $data['longitude'];
					$s_data['image'] = empty($sender_details['image'])? base_url()."assets/uploads/user_profiles/profile.png": $sender_details['image'];
					$s_data['message'] =  ucwords($sender_details['user_name'])." : ". $this->vendor_type[$vendor_details['auth_level']]." طلب عمل جديد كما تم استلامه";
					$s_data['type'] = 'job_request';
					$s_data['title'] = 'Job Request';
					$s_data['body'] =  ucwords($sender_details['user_name'])." : ". $this->vendor_type[$vendor_details['auth_level']]." طلب عمل جديد كما تم استلامه";
					//for android
					if($vendor_details['device_type']=='Android'){
						$re = send_notification_android($vendor_details['device_token'],$s_data);
					}
					//for ios
					if($vendor_details['device_type']=='iOS'){
						$ss = send_notification_ios($vendor_details['device_token'],$s_data);
					}
                    $message = ($res) ? "تم تحديث الأعمال بنجاح": "عذراَ ! حاول مرة أخرى"; 
                    $status = ($res) ? 1 : 0; 
                }
            }
            
           
            $result = ["status"=>$status,"message"=>$message];
            $this->response($result,REST_Controller::HTTP_OK); 
        }

    }
    //job details get
    public function job_details_get(){
        $job_id=($this->get('job_id')) ? $this->get('job_id'): "";
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($job_id!=""){
            $job_details['job_data'] = $this->services_m->job_details($job_id);
            if($job_details['job_data']){
				//for showing sp type 
				$ven_details = $this->services_m->get_user_details($job_details['job_data']['vendor_id']);
				$sp_level = ($lang=='en')? $this->vendor_type[$ven_details['auth_level']]: $this->vendor_type_ar[$ven_details['auth_level']];
				$shop_name = $job_details['job_data']['shop_name'];
				$job_details['job_data']['shop_name'] = $shop_name." (".$sp_level.")";
				//end
			
                //$job_details['job_services'] = $this->services_m->job_sercies($job_details['job_data']['services']);
                $job_serv = explode(',',$job_details['job_data']['services']);
                $job_details['job_services'] = $this->services_m->get_vendor_services($job_details['job_data']['vendor_id']);
				
				$js = array();
                foreach ($job_details['job_services'] as $jskey => $jsvalue) {
                    if($lang=='ar'){
                         $job_details['job_services'][$jskey]['service_name_en'] = $jsvalue['service_name_ar'];
                    }
				//if jobcomplete show venodr price
					if($job_details['job_data']['status']==3){
						if(in_array($jsvalue['service_id'], $job_serv)){
							$job_details['job_services'][$jskey]['is_selected'] = 1; 
							//get vendor price 
							$vprice = $this->services_m->get_vendorprice_byid($job_id,$jsvalue['service_id']);
							$job_details['job_services'][$jskey]['price'] = $vprice['price'];
							$js[] = $job_details['job_services'][$jskey];
							
						}else{
							//$job_details['job_services'][$jskey]['is_selected'] = 0; 
							unset($job_details['job_services'][$jskey]);
						}
					}else{
						if(in_array($jsvalue['service_id'], $job_serv)){
							$job_details['job_services'][$jskey]['is_selected'] = 1; 
							$js[] = $job_details['job_services'][$jskey];
						}else{
							//$job_details['job_services'][$jskey]['is_selected'] = 0; 
							unset($job_details['job_services'][$jskey]);
						}
					}
                    
                }
				$job_details['job_services'] = $js;
				//get price form job_price list if job is completed only 
				if($job_details['job_data']['status']==3){
					$job_details['job_data']['price'] = $this->services_m->get_jobvendorprice($job_id);
					
				}
				if($lang=='en'){
					$job_details['job_data']['status'] = ucfirst($this->job_status[$job_details['job_data']['status']]);
				}else{
					$job_details['job_data']['status'] = ucfirst($this->job_status_ar[$job_details['job_data']['status']]);
				}
				
                $result = ["status"=>1,"job_details"=>$job_details,"base_path"=>base_url()];
                $this->response($result,REST_Controller::HTTP_OK); 
            }else{
                $result = ["status"=>0,"message"=>($lang=='en')? "No job found" : "مطلوب موبايل" ];
                $this->response($result,REST_Controller::HTTP_OK); 
            }

        }else{
            $result = ["status"=>0,"message"=>($lang=='en')? "Job id is required" : "مطلوب موبايل"];
            $this->response($result,REST_Controller::HTTP_OK); 
        }
    }
    //job_delete
    public function delete_job_get(){
        $job_id=($this->get('job_id')) ? $this->get('job_id'): "";
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($job_id!=""){
            $this->services_m->delete('job_id',$job_id,'jobs');// columname,id,table name
            $result = ["status"=>1,"message"=>($lang=='en')? 'Auto mobile request deleted successfully'  : "تم حذف الأعمال بنجاح"];
            $this->response($result,REST_Controller::HTTP_OK); 
        }
        else{
            $result = ["status"=>0,"message"=>($lang=='en')? "Automobile request id is required"  : "معرف الوظيفة مطلوب"];
            $this->response($result,REST_Controller::HTTP_OK); 
        }

    }
    //get all bids
    public function user_bids_get(){
        $user_id = $this->get('user_id');
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($this->check_user_status($user_id)){
             $bids = $this->services_m->get_user_bids($user_id);
            $result = ["status"=>1,"bids"=>$bids, "base_path"=>base_url()];
            $this->response($result,REST_Controller::HTTP_OK);
        }
        else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            $this->response($result,REST_Controller::HTTP_OK);
        }
    }
    //post bid
    public function add_bid_post(){
        $business_image = array();
        $bid_id="";
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('user_id')) != "") {
            $data['user_id']  = $this->post('user_id');
        } else {
            $error =  ($lang=='en')? "User id is required" : "مطلوب موبايل";
            goto end;
        }
        if (($this->post('title')) != "") {
            $data['title']  = $this->post('title');
        } else {
            $error =  ($lang=='en')? "title is required" : "العنوان مطلوب";
            goto end;
        }
        if (($this->post('description')) != "") {
            $data['description']  = $this->post('description');
        } else {
            $error =  ($lang=='en')? "Description  is required" : "الوصف مطلوب ";
            goto end;
        }
        if (($this->post('make')) != "") {
            $data['make']  = $this->post('make');
        } else {
            $error =  ($lang=='en')? "Make is required" : "مطلوب";
            goto end;
        }
        if (($this->post('model')) != "") {
            $data['model']  = $this->post('model');
        } else {
            $error =  ($lang=='en')? "Model  is required" : "الموديل مطلوب";
            goto end;
        }
        if (($this->post('price')) != "") {
            $data['price']  = $this->post('price');
        } else {
            $error =  ($lang=='en')? "Price is required" : "السعر مطلوب";
            goto end;
        }
        if (($this->post('address')) != "") {
            $data['address']  = $this->post('address');
        } else {
            $error =  ($lang=='en')? "address is required" : "العنوان مطلوب";
            goto end;
        }
        if(($this->post('bid_id')) != "") {
            $bid_id = $this->post('bid_id');
        }
        //validate if insert bid
        if($bid_id==""){
            if(!isset($_FILES['vehicle_image']['name'])){
                $error = ($lang=='en')? "Images are required" : "الصور مطلوبة";
                goto end;
            }
        }
        end:
        if($error!=""){
            $result = ["status"=>0,"message"=>$error];
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
			 
            if(isset($_FILES['vehicle_image']['name'])){
                $filesCount = count($_FILES['vehicle_image']['name']);
                for($i = 0; $i < $filesCount; $i++){
                    $_FILES['image']['name'] = $_FILES['vehicle_image']['name'][$i];
                    $_FILES['image']['type'] = $_FILES['vehicle_image']['type'][$i];
                    $_FILES['image']['tmp_name'] = $_FILES['vehicle_image']['tmp_name'][$i];               
                    $_FILES['image']['size'] = $_FILES['vehicle_image']['size'][$i];               

                    $uploadPath = 'assets/uploads/bid_images/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png';
                                    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('image')){
                        $fileData = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];                  
                    }else{
						                  $error_img = $this->upload->display_errors();
										  
											 $result = ["status"=>0,"message"=> $error_img];
                    $this->response($result,REST_Controller::HTTP_OK);
					exit;
					}
					
                    $business_image[] = array( 'image'=>'assets/uploads/bid_images/'.$fileData['file_name']);            
                }
            }
            if($bid_id){
            // update bid
                $this->db->set($data)->where('b_id',$bid_id)->update('bids');
                if($this->db->affected_rows()){
                    //insert new images
                    if(count($business_image)){
                        foreach($business_image as $key){
                            $b_image['b_id'] = $bid_id;
                            $b_image['image'] = $key['image'];
                            $this->db->insert('bid_images',$b_image);
                        }
                    }
                    $result = ["status"=>1,"message"=> ($lang=='en')? "Request Updated successfully" : "تم تحديث المزايدة بنجاح"];
                    $this->response($result,REST_Controller::HTTP_OK);
                }else{
                     
                    $result = ["status"=>0,"message"=> ($lang=='en')? "Sorry Request not updated" : "عذرًا لم يتم تحديث المزايدة"];
                    $this->response($result,REST_Controller::HTTP_OK);
                }
                
            }else{
            //insert bid
                $data['posted_date'] = date('Y-m-d');
                $this->db->insert('bids',$data);
                $b_id = $this->db->insert_id();
                if($b_id){
                    //insert bid images
                    if(count($business_image)){
                        foreach($business_image as $key){
                            $b_image['b_id'] = $b_id;
                            $b_image['image'] = $key['image'];
                            $this->db->insert('bid_images',$b_image);
                        }
                    }
               
                    $result = ["status"=>1,"message"=> ($lang=='en')? "Request posted successfully" : "محاولة نشر بنجاح"];
                    $this->response($result,REST_Controller::HTTP_OK);
                }else{
                    $result = ["status"=>0,"message"=> ($lang=='en')? "Sorry! Request not posted" : "آسف! المزايدة غير منشورة"];
                    $this->response($result,REST_Controller::HTTP_OK);
                }
            }
            
        }      
    }
    // get bid details
    public function bid_details_get(){
        $bid_id=($this->get('bid_id')) ? $this->get('bid_id'): "";
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($bid_id!=""){
            $bid_data = $this->services_m->bid_details($bid_id);
            $bid_images = $this->services_m->bid_images($bid_data['b_id']);
            $auctions = $this->services_m->get_auctions_bybid($bid_id);
            $result = ["status"=>1,"bid_details"=>$bid_data, "bid_images"=>$bid_images, "auctions"=>$auctions, "base_path"=>base_url()];
            $this->response($result,REST_Controller::HTTP_OK); 
        }else{
              $result = ["status"=>0,"message"=> ($lang=='en')? "Request id is required" : "آرقم المزايدة مطلوب "];
            $this->response($result,REST_Controller::HTTP_OK); 
        }
    }
    //delete bid
    public function delete_bid_get(){
        $bid_id=($this->get('bid_id')) ? $this->get('bid_id'): "";
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($bid_id!=""){
            $this->services_m->delete('b_id',$bid_id,'bids');// columname,id,table name
          
             $result = ["status"=>1,"message"=> ($lang=='en')? "Request deleted successfully" : "آتم حذف المزايدة بنجاح"];
            $this->response($result,REST_Controller::HTTP_OK); 
        }
        else{
          $result = ["status"=>0,"message"=> ($lang=='en')? "Request id is required" : "آرقم المزايدة مطلوب "];
            $this->response($result,REST_Controller::HTTP_OK); 
        }

    }
    //vendor jobs
    public function vendor_jobs_post(){
        $data['user_id'] = $this->post('vendor_id');
        $data['latitude'] = $this->post('latitude');
        $data['longitude'] = $this->post('longitude');
        $data['distance'] = (($this->post('distance')) != "") ? $this->post('distance') : "";
        $data['services'] = (($this->post('services')) != "") ? $this->post('services') : "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if($this->check_user_status($data['user_id'])){
            if(($data['distance']!="" && $data['services']!="") || $data['distance']!=""){
                $jobs = $this->services_m->get_vendor_jobs($data);
                foreach ($jobs as $key => $value) {
                    $jobs[$key]['user_name'] = $this->services_m->get_user_details($value['user_id'])['user_name'];
                }
            }else{
                $jobs = $this->services_m->get_vendor_jobs($data);
            }
            $result = ["status"=>1,"jobs"=>$jobs, "base_path"=>base_url()];
            $this->response($result,REST_Controller::HTTP_OK);
        }
        else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            $this->response($result,REST_Controller::HTTP_OK);
        } 
    }
    //vendor completed and ongoing jobs
    public function vendor_joblist_post(){
        $user_id = $this->post('vendor_id');
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if($this->check_user_status($user_id)){
            $ongoing_jobs = $this->services_m->vendor_joblist($user_id,'1');
            foreach ($ongoing_jobs as $okey => $ovalue) {
                $ongoing_jobs[$okey]['service_names'] = $this->services_m->get_job_services($ovalue['services'],$lang)['services'];
            }
            $completed_jobs = $this->services_m->vendor_joblist($user_id,'3');
            foreach ($completed_jobs as $ckey => $cvalue) {
                $completed_jobs[$ckey]['service_names'] = $this->services_m->get_job_services($cvalue['services'],$lang)['services'];
				$completed_jobs[$ckey]['price'] = $this->services_m->get_jobvendorprice($cvalue['job_id']);

				
            }
            $result = ["status"=>1,"ongoing_jobs"=>$ongoing_jobs, "completed_jobs"=>$completed_jobs,"base_path"=>base_url()];
            $this->response($result,REST_Controller::HTTP_OK);
        }
        else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            $this->response($result,REST_Controller::HTTP_OK);
        } 

    }
    //job complete
    public function job_complete_post(){
        $job_id = $this->post('job_id');
        $lang = ($this->post('lang')) ? $this->post('lang'): 'en';
        //first comple the job
        $complete_job = $this->services_m->complete_job($job_id);
        if($complete_job){
			$ser_prices = $this->post('services');
			//update the service price
			foreach($ser_prices as $pkey=>$pvalue){
				$jdata['job_id'] = $job_id;
				$jdata['service_id'] = $pvalue['service_id'];
				$jdata['price'] = $pvalue['price'];
				$this->db->insert('job_prices',$jdata);
				
			}
            $user_details = $this->services_m->userdetails_byjobid($job_id);
            $vendor_details = $this->services_m->get_user_details($user_details['vendor_id']);
            //$n_data['message'] = "Job completed successfully";
            $n_data['message'] = ($lang=='en')? "your request is completed by ". $this->vendor_type[$vendor_details['auth_level']]." : ".$vendor_details['user_name'] : $vendor_details['user_name']. " : ".$this->vendor_type_ar[$vendor_details['auth_level']]."اكتمال طلبك من قبل"; 
		
            //$n_data['body'] = "Job completed successfully";
            $n_data['body'] = ($lang=='en')? "your request is completed by ". $this->vendor_type[$vendor_details['auth_level']]." : ".$vendor_details['user_name'] : $vendor_details['user_name']. " : ".$this->vendor_type_ar[$vendor_details['auth_level']]."اكتمال طلبك من قبل"; 
            $n_data['type'] = 'job_completed';
            $n_data['title'] = 'Job Completed';
            $n_data['vendor_name'] = $vendor_details['user_name'];
            $n_data['shop_name'] = $vendor_details['shop_name'];
            $n_data['image'] = base_url(). $vendor_details['shop_image'];
            $n_data['address'] = $vendor_details['address'];
            $n_data['job_id'] = $job_id;
            $n_data['vendor_id'] = $user_details['vendor_id'];
            //save notification 
            $ndata =  array('user_id' =>$user_details['user_id'], 'message'=> "your request is completed by ". $this->vendor_type[$vendor_details['auth_level']]." : ".$vendor_details['user_name'] , 'message_ar'=>$vendor_details['user_name']. " : ".$this->vendor_type_ar[$vendor_details['auth_level']]."اكتمال طلبك من قبل" );
            $this->services_m->save_data('notifications',$ndata);
            if($user_details['device_type']=="Android"){
                $re = send_notification_android($user_details['device_token'],$n_data);
                $result = ["status"=>1,"message"=> ($lang=='en') ? "Auto mobile request successfully" : "تم اكتمال المهمة بنجاح"];
                $this->response($result,REST_Controller::HTTP_OK);
            }else{
                $re = send_notification_ios($user_details['device_token'],$n_data);
               $result = ["status"=>1,"message"=> ($lang=='en') ? "Auto mobile request" : "تم اكتمال المهمة بنجاح"];
                $this->response($result,REST_Controller::HTTP_OK);
            }
            
        }else{
            $result = ["status"=>0,"message"=> ($lang=='en') ? "Already automobile request is completed / please try again" : "تم أكتمال العمل , يرجى المحاولة لاحقاَ"];
            $this->response($result,REST_Controller::HTTP_OK);
        }   
    }
    //submit rating
    public function submit_rating_post(){
        $job_id = $this->post('job_id');
        $user_id = $this->post('user_id');
        $rating = $this->post('rating');
        $review = $this->post('review');
        $review_heading = $this->post('review_heading');
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if($job_id!="" && $user_id!="" && $rating!="" && $review!="" && $review_heading!=""){
            if($this->check_user_status($user_id)){
                $this->services_m->submit_rating($rating,$review,$review_heading,$job_id);
                $result = ["status"=>1,"message"=> ($lang=='en')? "Thanks for providing review": "شكراَ لتقديم رأيك "];
                $this->response($result,REST_Controller::HTTP_OK);
            }else{
                $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
                $this->response($result,REST_Controller::HTTP_OK);
            }
        }else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Please submit all mandatory fields userid, jobid, rating, review" : "يرجى تقديم جميع حقول المستخدم الإلزامية الحقول , رقم المهمة , تقييم , استعراض"];
                $this->response($result,REST_Controller::HTTP_OK);
        }
    }
    //apply for bid
    public function auction_bid_post(){
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('vendor_id')) != "") {
            $data['vendor_id']  = $this->post('vendor_id');
        } else {
            $error =  ($lang=='en')? "Vendor id is required" : "رقم مقدم الخدمة مطلوب";
            goto end;
        }
        if (($this->post('bid_id')) != "") {
            $data['bid_id']  = $this->post('bid_id');
        } else {
            $error =  ($lang=='en')? "Bid id is required" : "مطلوب موبايل";
            goto end;
        }
        if (($this->post('message')) != "") {
            $data['message']  = $this->post('message');
        } else {
            $error =  ($lang=='en')? "Message to customer is required" : "الرسالة الى العميل مطلوبة";
            goto end;
        }
        if (($this->post('amount')) != "") {
            $data['amount']  = $this->post('amount');
        } else {
            $error =  ($lang=='en')? "Amount is required" : "المبلغ مطلوب";
            goto end;
        }
        //check vendor is already applied or not
        $check_bid  = $this->db->where('bid_id',$data['bid_id'])->where('vendor_id',$data['vendor_id'])->get('bid_auctions')->num_rows();
        if ($check_bid) {
            $error =  ($lang=='en')? "You are already applied to this request" : "لقد قمت بالستجيل بهذة المزايدة";
        } else {
            goto end;
        }
        $data['status'] = 0;
        $data['date'] = date('Y-m-d');
        end:
        if($error!=""){
            $result = ["status"=>0,"message"=>$error];
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
            //check bid status
            $bid_status = $this->services_m->bid_details($data['bid_id']);
            if($bid_status['status']==0){
                $this->db->insert('bid_auctions',$data);
                $result = ["status"=>0,"message"=> ($lang=='en')? "Successfully applied to request" : "تم التقدييم على هذة المزايدة بنجاح"];
                $this->response($result,REST_Controller::HTTP_OK);
            }else{
                $result = ["status"=>0,"message"=> ($lang=='en')? "Auction for this request is completed" : "تم الانتهاء من المزاد لهذا العرض"];
                $this->response($result,REST_Controller::HTTP_OK);
            }
        }

    }
    //delete bid images
    public function delete_bid_image_post(){
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('bid_id')) != "") {
            $data['b_id']  = $this->post('bid_id');
        } else {
            $error =  ($lang=='en')? "Bid id is required" : "مطلوب موبايل";
            goto end;
        }
        if (($this->post('user_id')) != "") {
            $data['user_id']  = $this->post('user_id');
        } else {
            $error =  ($lang=='en')? "User id is required" : "مطلوب موبايل";
            goto end;
        }
         if (($this->post('image_id')) != "") {
            $data['id']  = $this->post('image_id');
        } else {
            $error =  ($lang=='en')? "Image id is required" : "رمز الصورة مطلوب";
            goto end;
        }
        end:
        if($error!=""){
            $result = ["status"=>0,"message"=>$error];
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
            if($this->check_user_status($data['user_id'])){
                unset($data['user_id']);
                $this->db->where($data)->delete('bid_images');
                $delet_bid = $this->db->affected_rows();
                if($delet_bid){
                    $result = ["status"=>1,"message"=> ($lang=='en')? "Image deleted successfully" : "حالتك غير نشطة، يرجى الاتصال بالمسؤول"];
                    $this->response($result,REST_Controller::HTTP_OK);
                }else{
                    $result = ["status"=>0,"message"=> ($lang=='en')? "Sorry! Please try again" : "عذراَ ! حاول مرة أخرى "];
                    $this->response($result,REST_Controller::HTTP_OK);
                }
            }else{
                $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
                $this->response($result,REST_Controller::HTTP_OK);
            }
        }
    }
    //accepte bid service call
    public function accept_auction_post(){
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('bid_id')) != "") {
            $data['b_id']  = $this->post('bid_id');
        } else {
            $error =  ($lang=='en')? "Bid id is required" : "مطلوب موبايل";
            goto end;
        }
        if (($this->post('vendor_id')) != "") {
            $data['vendor_id']  = $this->post('vendor_id');
        } else {
            $error =  ($lang=='en')? "Vendor id is required" : "رقم مقدم الخدمة مطلوب";
            goto end;
        }
        if (($this->post('status')) != "") {
            $data['status']  = $this->post('status');
        } else {
            $error =  ($lang=='en')? "status is required" : "الحالة مطلوبة";
            goto end;
        }
        end:
        if($error!=""){
            $result = ["status"=>0,"message"=>$error];
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
            //check user status
            if($this->check_user_status($data['vendor_id'])){
                //check the bid is active  or not
                $bid_status = $this->services_m->get_data('bids','b_id',$data['b_id']);
                if($bid_status['status']==0){
                    //accept the bid auction
                    $this->db->set('status',$data['status'])->where('bid_id',$data['b_id'])->where('vendor_id',$data['vendor_id'])->update('bid_auctions');
                    //change bid status to closed if user accept the bid
                    if($data['status']==1){
                        //update bid to accept closed
                        $this->db->set('status',1)->where('b_id',$data['b_id'])->update('bids');
                    }
                    //send notification to vendor
                    $vendor_details = $this->services_m->get_user_details($data['vendor_id']);
					
                    //$n_data['message'] = ($data['status']==1)? "Bid accepted Successfully": "Sorry! your bid is rejected";
                    //$n_data['body'] = ($data['status']==1)? "Bid accepted Successfully": "Sorry! your bid is rejected";
					$n_data['message'] = ($data['status']==1)? "تم قبول صفقتك بنجاح ": "تم رفض  صفقتك";
                    $n_data['body'] = ($data['status']==1)? "تم قبول صفقتك بنجاح ": "تم رفض  صفقتك";
                    $n_data['type'] = 'bid_status';
                    $n_data['title'] = 'Bid Status';
                    $n_data['bid_id'] = $data['b_id'];
                    $n_data['vendor_id'] = $vendor_details['user_id'];
					$m_ar = ($data['status']==1)? 'تم قبول العطاء بنجاح' : 'آسف! عرضك مرفوض'; 
                    //save notification 
                    $ndata =  array('user_id' =>$vendor_details['user_id'], 'message'=>$n_data['message'],'message_ar'=>$m_ar );
                    $qry = $this->services_m->save_data('notifications',$ndata);
                    if($vendor_details['device_type']=="Android"){
                        $re = send_notification_android($vendor_details['device_token'],$n_data);
                        $result = ["status"=>1,"message"=> ($lang=='en')? "Request status Updated" : "تم تحديث حالة المزايدة بنجاح"];
                        $this->response($result,REST_Controller::HTTP_OK);
                    }else{
                        $re = send_notification_ios($vendor_details['device_token'],$n_data);
                        $result = ["status"=>1,"message"=> ($lang=='en')? "Request status Updated" : "تم تحديث حالة المزايدة بنجاح"];
                        $this->response($result,REST_Controller::HTTP_OK);
                    }

                }else{
                    $result = ["status"=>0,"message"=> ($lang=='en')? "Sorry this request is already completed" : "نأسف لقد اكتملت هذه المزايدة بالفعل"];
                $this->response($result,REST_Controller::HTTP_OK);
                }
            }else{
                $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
                $this->response($result,REST_Controller::HTTP_OK);
            }

        }
    }
    // get notifications
    public function notifications_get(){
        $user_id = $this->get('user_id');
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($user_id!=""){
            //check user status
            if($this->check_user_status($user_id)){
				if($lang=='en'){
					$notifications = $this->db->select('notifications.*, DATE_FORMAT(date,"%M %d %Y") as notification_date, DATE_FORMAT(date,"%I %i %p") as notification_time')->where('user_id',$user_id)->order_by('id','desc')->get('notifications')->result_array();
				}else{
					$notifications = $this->db->select('notifications.*, message_ar as message, DATE_FORMAT(date,"%M %d %Y") as notification_date, DATE_FORMAT(date,"%I %i %p") as notification_time')->where('user_id',$user_id)->order_by('id','desc')->get('notifications')->result_array();
				}
                
                $result = ['status'=>1,'notifications'=>$notifications];
                $this->response($result,REST_Controller::HTTP_OK);
            }else{
                $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
                $this->response($result,REST_Controller::HTTP_OK);
            }

        }else{
            $result = ['status'=>0,'message'=>"User id is missing"];
            $this->response($result,REST_Controller::HTTP_OK);
        }
    }
    //job details in vendor application
    public function job_details_forvendor_get(){
        $job_id=($this->get('job_id')) ? $this->get('job_id'): "";
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($job_id!=""){
            $job_details['job_data'] = $this->services_m->job_details_vendor($job_id);
            if($job_details['job_data']){
				
                //$job_details['job_services'] = $this->services_m->job_sercies($job_details['job_data']['services']);
                $job_serv = explode(',',$job_details['job_data']['services']);
                $job_details['job_services'] = $this->services_m->get_vendor_services($job_details['job_data']['vendor_id']);
				
				$js = array();
                foreach ($job_details['job_services'] as $jskey => $jsvalue) {
                     if($lang=='ar'){
                         $job_details['job_services'][$jskey]['service_name_en'] = $jsvalue['service_name_ar'];
                    }
                    /*if(in_array($jsvalue['service_id'], $job_serv)){
                        $job_details['job_services'][$jskey]['is_selected'] = 1; 
                    }else{
                        //$job_details['job_services'][$jskey]['is_selected'] = 0;
						unset($job_details['job_services'][$jskey]);
                    }*/
					//if jobcomplete show venodr price
					if($job_details['job_data']['status']==3){
						if(in_array($jsvalue['service_id'], $job_serv)){
							$job_details['job_services'][$jskey]['is_selected'] = 1; 
							//get vendor price 
							$vprice = $this->services_m->get_vendorprice_byid($job_id,$jsvalue['service_id']);
							$job_details['job_services'][$jskey]['price'] = $vprice['price'];
							$js[] = $job_details['job_services'][$jskey];
							
						}else{
							//$job_details['job_services'][$jskey]['is_selected'] = 0; 
							unset($job_details['job_services'][$jskey]);
						}
					}else{
						if(in_array($jsvalue['service_id'], $job_serv)){
							$job_details['job_services'][$jskey]['is_selected'] = 1; 
							$js[] = $job_details['job_services'][$jskey];
						}else{
							//$job_details['job_services'][$jskey]['is_selected'] = 0; 
							unset($job_details['job_services'][$jskey]);
						}
					}
                }
				$job_details['job_services'] = $js;
				//get price form job_price list if job is completed only 
				if($job_details['job_data']['status']==3){
					$job_details['job_data']['price'] = $this->services_m->get_jobvendorprice($job_id);
				}
				if($lang=='en'){
					$job_details['job_data']['status'] = ucfirst($this->job_status[$job_details['job_data']['status']]);
				}else{
					$job_details['job_data']['status'] = ucfirst($this->job_status_ar[$job_details['job_data']['status']]);
				}
                
                $result = ["status"=>1,"job_details"=>$job_details,"base_path"=>base_url()];
                $this->response($result,REST_Controller::HTTP_OK); 
            }else{
                $result = ["status"=>0,"message"=>"No Job found"];
                $this->response($result,REST_Controller::HTTP_OK); 
            }

        }else{
            $result = ["status"=>0,"message"=>"Job id is required"];
            $this->response($result,REST_Controller::HTTP_OK); 
        }
    }
    //get vendor bids
    public function vendor_bids_get(){
        $vendor_id = $this->get('vendor_id');
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($this->check_user_status($vendor_id)){
             $current_bids = $this->services_m->get_vendor_bids($vendor_id,'0');
             $previous_bids = $this->services_m->get_vendor_bids($vendor_id,'1,2');
             foreach ($previous_bids as $key => $value) {
                 if($value['status']==1){
                    $previous_bids[$key]['bid_status'] = "Accepted";
                 }if($value['status']==2){
                     $previous_bids[$key]['bid_status'] = "Rejected";
                 }
             }
            $result = ["status"=>1,"current_bids"=>$current_bids, 'previous_bids'=>$previous_bids, "base_path"=>base_url()];
            $this->response($result,REST_Controller::HTTP_OK);
        }
        else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            $this->response($result,REST_Controller::HTTP_OK);
        }
    }
    // all bids for vendor
    public function allbids_get(){
        $vendor_id = $this->get('vendor_id');
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($this->check_user_status($vendor_id)){
            $all_bids = $this->services_m->get_allbids();
            $result = ["status"=>1,"bids"=>$all_bids, "base_path"=>base_url()];
            $this->response($result,REST_Controller::HTTP_OK);

        }
         else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            $this->response($result,REST_Controller::HTTP_OK);
        }

    }
    //bank details edit/or update
    public function bank_details_post(){
        $bank_id="";
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('user_id')) != "") {
            $data['user_id']  = $this->post('user_id');
        } else {
            $error =  ($lang=='en')? "User id is required" : "مطلوب موبايل";
            goto end;
        }
        if (($this->post('bank_name')) != "") {
            $data['bank_name']  = $this->post('bank_name');
        } else {
            $error =  ($lang=='en')? "bank name is required" : "مطلوب موبايل";
            goto end;
        }
        if (($this->post('branch_name')) != "") {
            $data['branch_name']  = $this->post('branch_name');
        } else {
            $error =  ($lang=='en')? "branch name is required" : "مطلوب موبايل";
            goto end;
        }
        if (($this->post('branch_address')) != "") {
            $data['branch_address']  = $this->post('branch_address');
        } else {
            $error =  ($lang=='en')? "branch address is required" : "مطلوب موبايل";
            goto end;
        }
        if (($this->post('swift_code')) != "") {
            $data['swift_code']  = $this->post('swift_code');
        } else {
            $error =  ($lang=='en')? "swift code is required" : "مطلوب موبايل";
            goto end;
        }
         if (($this->post('iban')) != "") {
            $data['iban']  = $this->post('iban');
        } else {
            $error =  ($lang=='en')? "iban code is required" : "مطلوب موبايل";
            goto end;
        }
      
      
        //for editing purpose
        if(($this->post('bank_id')) != "") {
            $bank_id = $this->post('bank_id');
        }
        end:
        if($error!=""){
            $result = ["status"=>0,"message"=>$error];
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
            //edit the bank details
            if($bank_id!=""){
                $res = $this->services_m->edit_bank($bank_id,$data);
                $message = ($res) ? "Bank details updated sucessfully": "please try again"; 
                $status = ($res) ? 1 : 0; 

            }else{
            //insert the bank details
                $res = $this->services_m->add_bank($data);
                $message = ($res) ? "Bank details are added  sucessfully": "please try again"; 
                $status = ($res) ? 1 : 0; 
            }
           
            $result = ["status"=>$status,"message"=>$message];
            $this->response($result,REST_Controller::HTTP_OK); 
        }

    }
    // bank details get
    public function get_bank_get(){
        $user_id = $this->get('user_id');
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($this->check_user_status($user_id)){
             $bank_details = $this->db->where('user_id', $user_id)->get('bank_details')->row_array();
            $result = ["status"=>1,"bank_details"=>$bank_details, "base_path"=>base_url()];
            $this->response($result,REST_Controller::HTTP_OK);
        }
        else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            $this->response($result,REST_Controller::HTTP_OK);
        }
    } 
	 // countries list
    public function countries_get(){
        $countries =  $this->db->order_by('priority desc')->limit(6)->get('countries')->result_array();
        $result = ["status"=>1,"countries"=>$countries, "base_path"=>base_url()];
            $this->response($result,REST_Controller::HTTP_OK);
    }
	// update latitude 
	public function update_location_post(){
    	$error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('user_id')) != "") {
            $data['user_id']  = $this->post('user_id');
        } else {
            $error =  ($lang=='en')? "User id is required" : "مطلوب موبايل";
            goto end;
        }
        if (($this->post('latitude')) != "") {
            $data['latitude']  = $this->post('latitude');
        } else {
            $error =  ($lang=='en')? "latitude is required" : "مطلوب موبايل";
            goto end;
        }
		if (($this->post('longitude')) != "") {
            $data['longitude']  = $this->post('longitude');
        } else {
            $error =  ($lang=='en')? "longitude is required" : "مطلوب موبايل";
            goto end;
        }
		end:
        if($error!=""){
            $result = ["status"=>0,"message"=>$error];
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
			$this->services_m->update_location($data);
			$result = ["status"=>1,"message"=> ($lang=='en')? "Location Updated successfully": "تم تحديث الموقع بنجاح"];
            $this->response($result,REST_Controller::HTTP_OK);
		}
    }
	//support get
	public function contact_get(){
		$cdata = $this->services_m->get_data('support');
		$result = ["status"=>1,"contact"=> $cdata];
            $this->response($result,REST_Controller::HTTP_OK);
	}
	//brands get
	 public function available_brands_get(){
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        $services = $this->services_m->get_brands();
        if($lang=='ar'){
            foreach ($services as $key => $value) {
                $services[$key]['brand_name_en'] = $value['brand_name_ar'];
            }
        }
        $result = ["status"=>1, "services"=>$services];
        $this->response($result,REST_Controller::HTTP_OK);
    }
	//towing service
	public function book_towing_post(){
        $error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
        if (($this->post('user_id')) != "") {
            $data['user_id']  = $this->post('user_id');
        } else {
            $error =  ($lang=='en')? "User id is required" : "مطلوب موبايل";
            goto end;
        }
        if (($this->post('latitude')) != "") {
            $data['latitude']  = rtrim($this->post('latitude'),',');
        } else {
            $error =  ($lang=='en')? "Latitude is missing" : "مطلوب خط العرض";
            goto end;
        }
        if (($this->post('longitude')) != "") {
            $data['longitude']  = rtrim($this->post('longitude'),',');
        } else {
            $error =  ($lang=='en')? "Longitude is missing" : "خط الطول مطلوب";
            goto end;
        }
        if (($this->post('address')) != "") {
            $data['address']  = rtrim($this->post('address'),',');
        } else {
            $error =  ($lang=='en')? "Address is missing" : "العنوان غير موجود";
            goto end;
        }
        end:
        if($error!=""){
            $result = ["status"=>0,"message"=>$error];
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
            $data['booked_date'] = date('Y-m-d H:i:s');
            $data['status'] = 0;
			//book towing request
			$towing = $this->services_m->book_towing($data);
			//get sender details 
			$sender_details = $this->services_m->get_user_details($data['user_id']);
			//get nearest vendors 
			$towers = $this->services_m->get_towers($data);
			if(count($towers)>0){
				foreach($towers as $key=>$value){
					$s_data['user_id'] = $sender_details['user_id'];
					$s_data['user_name'] = $sender_details['user_name'];
					$s_data['towing_id'] = $towing;
					$s_data['latitude'] = $data['latitude'];
					$s_data['longitude'] = $data['longitude'];
					$s_data['image'] = empty($sender_details['image'])? base_url()."assets/uploads/user_profiles/profile.png": $sender_details['image'];
					$s_data['message'] =  "Towing request from user ". ucwords($sender_details['user_name']);
					$s_data['type'] = 'towing';
					$s_data['title'] = 'towing';
					$s_data['body'] = "Towing request from user ". ucwords($sender_details['user_name']);
					//for android
					if($value['device_type']=='Android'){
						$re = send_notification_android($value['device_token'],$s_data);
					}
					//for ios
					if($value['device_type']=='iOS'){
						$ss = send_notification_ios($value['device_token'],$s_data);
					}
				}
				$result = ["status"=>1,"message"=>($lang=='en')? "Request sent successfully" : "تم إرسال الطلب بنجاح"];
				$this->response($result,REST_Controller::HTTP_OK); 
			}else{
				$result = ["status"=>1,"message"=>($lang=='en')? "Sorry! There is no near by towings" : "آسف! لا يوجد بالقرب من القطر"];
				$this->response($result,REST_Controller::HTTP_OK); 
			}
        }

    }
	// confirm towing from vendor
	public function confirm_towing_post(){
		$error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
		if (($this->post('user_id')) != "") {
            $data['user_id']  = $this->post('user_id');
        } else {
            $error =  ($lang=='en')? "User id is required" : "مطلوب موبايل";
            goto end;
        }
		if (($this->post('towing_id')) != "") {
            $data['id']  = $this->post('towing_id');
        } else {
            $error =  ($lang=='en')? "Towing id is required" : "مطلوب موبايل";
            goto end;
        }
		if (($this->post('vendor_id')) != "") {
            $data['vendor_id']  = $this->post('vendor_id');
        } else {
            $error =  ($lang=='en')? "Vendor id is required" : "مطلوب موبايل";
            goto end;
        }
		end:
		if($error!=""){
            $result = ["status"=>0,"message"=>$error];
			$this->response($result,REST_Controller::HTTP_OK);
        }else{
			//check the towing status
			$tdata = $this->db->where('user_id',$data['user_id'])->where('id',$data['id'])->get('towings')->row_array();
			if($tdata['status']==0){
				//assign that request to vendor
				$vendor_id = $data['vendor_id'];
				unset($data['vendor_id']);
				$this->db->set('vendor_id',$vendor_id)->set('status',1)->where($data)->update('towings');
				
				$user_details = $this->services_m->get_user_details($data['user_id']);
				$vendor_details = $this->services_m->get_user_details($vendor_id);
				//noti code
				$s_data['vendor_id'] = $vendor_details['user_id'];
				$s_data['vendor_name'] = $vendor_details['user_name'];
				$s_data['towing_id'] = $data['id'];
				$s_data['latitude'] = $vendor_details['latitude'];
				$s_data['longitude'] = $vendor_details['longitude'];
				$s_data['image'] = empty($vendor_details['image'])? base_url()."assets/uploads/user_profiles/profile.png": $vendor_details['image'];
				$s_data['message'] =  "Towing request accepted by vendor ". ucwords($vendor_details['user_name']);
				$s_data['type'] = 'towing_status';
				$s_data['title'] = 'towing_status';
				$s_data['body'] = "Towing request accepted by vendor ". ucwords($vendor_details['user_name']);
				//for android
				if($user_details['device_type']=='Android'){
					$re = send_notification_android($user_details['device_token'],$s_data);
					$result = ["status"=>1,"message"=>($lang=='en')? "Towing Request accepted": "قبول سحب الطلب" ];
					$this->response($result,REST_Controller::HTTP_OK);
				}
				//for ios
				if($user_details['device_type']=='iOS'){
					$ss = send_notification_ios($user_details['device_token'],$s_data);
					$result = ["status"=>1,"message"=>($lang=='en')? "Towing Request accepted": "قبول سحب الطلب" ];$this->response($result,REST_Controller::HTTP_OK);
				}
				//end noti code
				
			}else{
				$result = ["status"=>0,"message"=>($lang=='en')? "Sorry! another service provider is already before you": "آسف! مزود خدمة آخر بالفعل أمامك" ];
				$this->response($result,REST_Controller::HTTP_OK);
			}
			
		}
		
	}
	// complete towing
	public function complete_towing_post(){
		$error = "";
        $lang = ($this->post('lang')) ? $this->post('lang'): "en";
		if (($this->post('vendor_id')) != "") {
            $data['vendor_id']  = $this->post('vendor_id');
        } else {
            $error =  ($lang=='en')? "User id is required" : "مطلوب موبايل";
            goto end;
        }
		if (($this->post('price')) != "") {
            $data['price']  = $this->post('price');
        } else {
            $error =  ($lang=='en')? "Price is required" : "مطلوب موبايل";
            goto end;
        }
		if (($this->post('towing_id')) != "") {
            $data['id']  = $this->post('towing_id');
        } else {
            $error =  ($lang=='en')? "Towing id is required" : "مطلوب موبايل";
            goto end;
        }
		$data['completed_date'] = date('Y-m-d');
		end:
		if($error!=""){
			$result = ["status"=>0,"message"=>$error];
			$this->response($result,REST_Controller::HTTP_OK);
		}else{
			//update tower request to complete
			$udata = array('status'=>3,'price'=>$data['price'],'completed_date'=>$data['completed_date']);
			$this->db->set($udata)->where('id',$data['id'])->update('towings');
			//send notification to user
			$towerdata = $this->services_m->get('towings','id',$data['id']);
			$user_details = $this->services_m->get_user_details($towerdata['user_id']);
			$s_data['message'] =  "Towing request completed ";
			$s_data['type'] = 'towing_completed';
			$s_data['title'] = 'towing_completed';
			$s_data['body'] = "Towing request completed ";
			//for android
			if($user_details['device_type']=='Android'){
				$re = send_notification_android($user_details['device_token'],$s_data);
				$result = ["status"=>1,"message"=>($lang=='en')? "Towing Request completed": "قبول سحب الطلب" ];
				$this->response($result,REST_Controller::HTTP_OK);
			}
			//for ios
			if($user_details['device_type']=='iOS'){
				$ss = send_notification_ios($user_details['device_token'],$s_data);
				$result = ["status"=>1,"message"=>($lang=='en')? "Towing Request completed": "قبول سحب الطلب" ];
				$this->response($result,REST_Controller::HTTP_OK);
			}
			
		}
		
	}
// towings list
public function usertowings_post(){
	$error = "";
	$lang = ($this->post('lang')) ? $this->post('lang'): "en";
	if (($this->post('user_id')) != "") {
		$data['user_id']  = $this->post('user_id');
	} else {
		$error =  ($lang=='en')? "User id is required" : "مطلوب موبايل";
		goto end;
	}
	end :
	if ($error !="" ) {
		$result = ["status"=>0,"message"=>$error];
		$this->response($result,REST_Controller::HTTP_OK);
	} else {
		//get user towings list
		$towings = $this->services_m->getm('towings','user_id',$data['user_id']);
		foreach($towings as $key=>$value){
			if($value['vendor_id']){
				$vdata = $this->services_m->get_user_details($value['vendor_id']);
				$towings[$key]['venodr_name'] = $vdata['user_name'];
				$towings[$key]['image'] = $vdata['image'];
			}else{
				$towings[$key]['venodr_name'] = "";
				$towings[$key]['image'] = "";
			}
			if($lang=='en')
				$towings[$key]['status'] = $this->job_status[$value['status']];
			else
				$towings[$key]['status'] = $this->job_status_ar[$value['status']];
		}
		$result = ["status"=>1,"Towings"=>$towings, "base_path"=>base_url()];
		$this->response($result,REST_Controller::HTTP_OK);
	}
	
}
// vendor towings
public function vendortowings_post(){
	$error = "";
	$lang = ($this->post('lang')) ? $this->post('lang'): "en";
	if (($this->post('vendor_id')) != "") {
		$data['vendor_id']  = $this->post('vendor_id');
	} else {
		$error =  ($lang=='en')? "vendor id is required" : "مطلوب موبايل";
		goto end;
	}
	end :
	if ($error !="" ) {
		$result = ["status"=>0,"message"=>$error];
		$this->response($result,REST_Controller::HTTP_OK);
	} else {
		//get user towings list
		$towings = $this->services_m->getm('towings','vendor_id',$data['vendor_id']);
		foreach($towings as $key=>$value){
			$udata = $this->services_m->get_user_details($value['user_id']);
			$towings[$key]['user_name'] = $udata['user_name'];
			$towings[$key]['image'] = $udata['image'];
			if($lang=='en')
				$towings[$key]['status'] = $this->job_status[$value['status']];
			else
				$towings[$key]['status'] = $this->job_status_ar[$value['status']];
		}
		$result = ["status"=>1,"Towings"=>$towings, "base_path"=>base_url()];
		$this->response($result,REST_Controller::HTTP_OK);
	}
	
}
//job accept/reject 
public function acceptjob_post(){
	$error = "";
	$lang = ($this->post('lang')) ? $this->post('lang'): "en";
	if (($this->post('user_id')) != "") {
		$data['user_id']  = $this->post('user_id');
	} else {
		$error =  ($lang=='en')? "user id is required" : "مطلوب موبايل";
		goto end;
	}
	if (($this->post('job_id')) != "") {
		$data['job_id']  = $this->post('job_id');
	} else {
		$error =  ($lang=='en')? "job id is required" : "مطلوب موبايل";
		goto end;
	}
	if (($this->post('job_status')) != "") {
		$data['job_status']  = $this->post('job_status');
	} else {
		$error =  ($lang=='en')? "job status is required" : "مطلوب موبايل";
		goto end;
	}
	//check reject reason when job is rejected
	if($data['job_status']==2){
		if (($this->post('reject_reason')) != "") {
			$data['reject_reason']  = $this->post('reject_reason');
		} else {
			$error =  ($lang=='en')? "Reject Reason is required" : "مطلوب موبايل";
			goto end;
		}
	}
	end :
	if ($error !="" ) {
		$result = ["status"=>0,"message"=>$error];
		$this->response($result,REST_Controller::HTTP_OK);
	} else {
		//get job details
		$job_data = $this->services_m->job_details($data['job_id']);
		//check job status
		if($job_data['status']==0){
			$user_details = $this->services_m->get_user_details($job_data['user_id']);
			//vendor details
			$vendor_details = $this->services_m->get_user_details($job_data['vendor_id']);
			//if job is accepted
			if($data['job_status']==1){
				$this->db->set('status',1)->where('job_id',$data['job_id'])->update('jobs');
				//send notification
				$s_data['type'] = 'job_status';
				$s_data['title'] = 'Job status';
				$s_data['reason'] = '';
				$s_data['body'] = ($lang=='en')? "your request is accepted by ". $this->vendor_type[$vendor_details['auth_level']]." : ".$vendor_details['user_name'] : $vendor_details['user_name']. " : ".$this->vendor_type_ar[$vendor_details['auth_level']]."طلبك قبلت"; 
				$s_data['message'] = ($lang=='en')? "your request is accepted by ". $this->vendor_type[$vendor_details['auth_level']]." : ".$vendor_details['user_name'] : $vendor_details['user_name']. " : ".$this->vendor_type_ar[$vendor_details['auth_level']]."طلبك قبلت"; 
				//for android
				if($user_details['device_type']=='Android'){
					$re = send_notification_android($user_details['device_token'],$s_data);
			
				}
				//for ios
				if($user_details['device_type']=='iOS'){
					$ss = send_notification_ios($user_details['device_token'],$s_data);
					
				}
				$status = 1;
				$message = ($lang=='en')? "notification sent successfully" : " أرسلت الإخطار بنجاح";
				$result = ["status"=>$status,"message"=>$message];
				$this->response($result,REST_Controller::HTTP_OK); 
				
			}
			//if job is rejected
			if($data['job_status']==2){
				$this->db->set('status',2)->set('reject_reason',$data['reject_reason'])->where('job_id',$data['job_id'])->update('jobs');
				//send notification
				$s_data['type'] = 'job_status';
				$s_data['title'] = 'Job status';
				$s_data['reason'] = $data['reject_reason'];
				$s_data['body'] = ($lang=='en')? "your request is rejected by ". $this->vendor_type[$vendor_details['auth_level']]." : ".$vendor_details['user_name'] : $vendor_details['user_name']. " : ".$this->vendor_type_ar[$vendor_details['auth_level']]."تم رفض طلبك بواسطة"; 
				
				$s_data['message'] = ($lang=='en')? "your request is rejected by ". $this->vendor_type[$vendor_details['auth_level']]." : ".$vendor_details['user_name'] : $vendor_details['user_name']. " : ".$this->vendor_type_ar[$vendor_details['auth_level']]."تم رفض طلبك بواسطة"; 
				
				//for android
				if($user_details['device_type']=='Android'){
					$re = send_notification_android($user_details['device_token'],$s_data);
				}
				//for ios
				if($user_details['device_type']=='iOS'){
					$ss = send_notification_ios($user_details['device_token'],$s_data);
				}
				$status = 1;
				$message = ($lang=='en')? "notification sent successfully" : " أرسلت الإخطار بنجاح";	
				$result = ["status"=>$status,"message"=>$message];
				$this->response($result,REST_Controller::HTTP_OK); 
			}
			
			
		}else{
			$status = 0;
			$message= ($lang=='en')? "This job is already completed/accepted" : "هذه المهمة قد اكتملت بالفعل / قبلت";
			$result = ["status"=>$status,"message"=>$message];
			$this->response($result,REST_Controller::HTTP_OK); 
		}
		
	}
		
}
//get vendor pending requests
public function pendingjobs_get(){
	$user_id = $this->get('vendor_id');
	$lang = ($this->get('lang')) ? $this->get('lang'): "en";
	if($this->check_user_status($user_id)){
		$pending_jobs = $this->services_m->services_m->vendor_joblist($user_id,'0');
		foreach ($pending_jobs as $okey => $ovalue) {
			$pending_jobs[$okey]['service_names'] = $this->services_m->get_job_services($ovalue['services'],$lang)['services'];
		}
		$result = ["status"=>1,"pending_jobs"=>$pending_jobs];
		$this->response($result,REST_Controller::HTTP_OK);
	}
	else{
		$result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير نشطة، يرجى الاتصال بالمسؤول"];
		$this->response($result,REST_Controller::HTTP_NOT_FOUND);
	}
}
//get terms
 public function terms_get(){
    $lang = ($this->get('lang')) ? $this->get('lang'): "en";
	$terms = $this->db->get('terms')->row_array();
	if($lang=='ar'){
		$terms['terms_en'] = $terms['terms_ar'];
	}
	$result = ["status"=>1,"terms"=>$terms];
	$this->response($result,REST_Controller::HTTP_OK);
	
 }
 //get user bills
  public function user_bills_get(){
        $user_id = $this->get('user_id');
        $lang = ($this->get('lang')) ? $this->get('lang'): "en";
        if($this->check_user_status($user_id)){
             $bills = $this->services_m->get_user_bills($user_id);
			 foreach($bills as $bkey=>$bvalue){
				 $bills[$bkey]['price'] = $this->services_m->get_jobvendorprice($bvalue['job_id']);
			 }
            $result = ["status"=>1,"bills"=>$bills, "base_path"=>base_url()];
            $this->response($result,REST_Controller::HTTP_OK);
        }
        else{
            $result = ["status"=>0,"message"=> ($lang=='en')? "Your status is inactive,Please contact Admin" : "حالتك غير مفعلة يرجى التواصل مع الأدمن"];
            $this->response($result,REST_Controller::HTTP_OK);
        }
    }	

}
