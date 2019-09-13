<!DOCTYPE html>
<html lang="en">
<head>
    <title>:: ESSENCE  ::</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <!-- Favicon icon -->
   <!-- <link rel="shortcut icon" href="assets/images/favicon.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.ico" tppabs="http://ableproadmin.com/light/vertical/assets/images/favicon.ico" type="image/x-icon">
-->
  <!-- Google font
    <link href="http://volivesolutions.com/fonts.googleapis.com/css-family=Open+Sans-300,400,600,700,800.css" rel="stylesheet">-->
    <!-- iconfont -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/icon/icofont/css/icofont.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- simple line icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/icon/simple-line-icons/css/simple-line-icons.css" >
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" >
    
  <!-- Chartlist chart css -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/charts/chartlist/css/chartlist.css"  type="text/css" media="all">
    
     <!-- Chosen Select  -->
    <script src="<?php echo base_url();?>assets/select/bootstrap-select.js"></script>
    <script src="<?php echo base_url();?>assets/select/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/select/bootstrap-select.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/select/bootstrap-select.min.css">

    
    <!-- Echart js -->
    <script src="<?php echo base_url();?>assets/admin/plugins/charts/echarts/js/echarts-all.js"></script>
    
     <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/plugins/data-table/css/dataTables.bootstrap4.min.css" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/plugins/data-table/css/buttons.dataTables.min.css" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/plugins/data-table/css/responsive.bootstrap4.min.css" >
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/css/main.css" >
     <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/css/custom.css">
    <!-- Responsive.css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/css/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/bootstrap-datetimepicker.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/animate.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/alertify.css"/>
    <!--color css-->
    <style type="text/css">
        
        .sidebar-menu>li>a .inactive-arrow {
    float: right;
    position: relative;
    top: 5px;
}
.active-arrow{
display: none !important;
    float: right;
    position: relative;
    top: 5px;

}
li.dropdown.active .active-arrow  {
    display: block !important;

    transition: all ease-in-out .5s;
      -webkit-transition: display 2s; 
    transition: display 2s;
}
li.dropdown.active .inactive-arrow{
    display: none !important;
}

.dot {
    height: 25px;
    width: 25px;
    background-color: #0d0c0c;
    border-radius: 50%;
    display: inline-block;
    color: white;
    text-align: center;
    margin-left: 294px;
}

.doth {
    height: 25px;
    width: 25px;
    background-color: #0d0c0c;
    border-radius: 50%;
    display: inline-block;
    color: white;
    text-align: center;
    line-height: 27px;
}


    </style>
    
    <script type="text/javascript">
    (function(){
            //alert('hi');
         <?php if($user_info->role=='agent'){ ?>    
            setInterval(function(){
             
                    $.ajax({ url:'<?php echo base_url();?>admin/notification',
                    	type:'POST',
                    	data: {sid:'hi'},
                    	success: function(data)
                    	{
                    	    //alert(data);
                            $(".doth").html(data);
                    	    //location.reload();
                    	}
                      });
                      
            }, 1000); 
            
        <?php }?>    
            
        })();
</script>        
<script src="<?php echo base_url()?>assets/js/accounting.js"></script>
</head>
<body class="sidebar-mini fixed">
   <!-- <div class="loader-bg">
        <div class="loader-bar">
        </div>
    </div>-->
<div class="wrapper">
    <!--   <div class="loader-bg">
    <div class="loader-bar">
    </div>
  </div> -->
    <!-- Navbar-->
    <header class="main-header-top hidden-print">
        <a href="<?php echo base_url();?>admin/index"  class="logo">
        <img class="img-fluid able-logo" src="<?php echo base_url();?>assets/images/logo-3.png" alt="logo">
        </a>
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button--><a href="javascript:" data-toggle="offcanvas" class="sidebar-toggle"></a>
            <!-- Navbar Right Menu-->
            <div class="navbar-custom-menu">
                <ul class="top-nav">
                   
                    <!-- chat dropdown -->
                   
                    <!-- window screen -->
                    <li class="pc-rheader-submenu">
                        <a href="#!" class="drop icon-circle" onclick="javascript:toggleFullScreen()">
                            <i class="icon-size-fullscreen"></i>
                        </a>
                    </li>
                 <?php if($user_info->role=='agent'){ ?>
                    <li class="pc-rheader-submenu">
                        <a href="<?php echo base_url();?>admin/chat" class="drop icon-circle" onclick="">
                                    <?php 
                                        $data = "SELECT count(*) as notification_c FROM `chats` where receiver_id = ".$this->session->userdata('user_id')." and notification_count = 1 GROUP BY sender_id";
                                         $messages = $this->db->query($data)->row();
                                    ?>
    	                            <?php if($messages){ ?>
    	                                New Message
                            			<span class="doth">
                            			   
                            					<?= $messages->notification_c;?>
                            			</span> 
                            		<?php } ?>
    	                    
                    
                            
                          <!--  <span class="doth">1</span>-->
                        </a>
                    </li>
                <?php }?>    
                    <!-- User Menu-->
                    <li class="dropdown">
                        <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                            <span><?=$user_info->email?><img class="img-circle " src="<?php echo base_url((empty($user_info->image)) ? "assets/uploads/user_profiles/profile.png": $user_info->image); ?>" style="width:40px;" alt="User Image"></span>
                            <span><?php echo ucwords(@$user_info->first_name); ?> <i class=" icofont icofont-simple-down"></i></span>
                        </a>
                        <ul class="dropdown-menu settings-menu">
                            <!--<li><a href="javascript:void(0)"><i class="icon-settings"></i> Settings</a></li>-->
                            <li><a href="<?php echo base_url();?>admin/profile"><i class="icon-user"></i> Profile</a></li>
                            <li class="p-0">
                                <div class="dropdown-divider m-0"></div>
                            </li>
                            
                            <li><a href="<?php echo base_url();?>home/logout"><i class="icon-logout"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
          
            </div>
        </nav>
    </header>
    <!-- Side-Nav-->
    <aside class="main-sidebar hidden-print " >
        <section class="sidebar" id="sidebar-scroll">
            <div class="user-panel">
                <div class="f-left image"><img src="<?php echo base_url((empty($user_info->image)) ? "assets/uploads/user_profiles/profile.png": $user_info->image); ?>" alt="User Image" class="img-circle"></div>
                <div class="f-left info">
                    <p><?php echo ucwords(@$user_info->first_name); ?></p>
                    <p class="designation"><?php echo ucwords(@$user_info->email); ?><i class="icofont icofont-caret-down m-l-5"></i></p>
                </div>
            </div>
            <!-- sidebar profile Menu-->
            <ul class="nav sidebar-menu extra-profile-list">
                <li>
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/profile" >
                        <i class="icon-user"></i>
                        <span class="menu-text">View Profile</span>
                        <span class="selected"></span>
                    </a>
                </li>
               <!-- <li>
                    <a class="waves-effect waves-dark" href="javascript:void(0)">
                        <i class="icon-settings"></i>
                        <span class="menu-text">Settings</span>
                        <span class="selected"></span>
                    </a>
                </li>-->
                <li>
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>home/logout">
                        <i class="icon-logout"></i>
                        <span class="menu-text">Logout</span>
                        <span class="selected"></span>
                    </a>
                </li>
            </ul>
        

            <!-- Sidebar Menu-->
           
            <?php
                if($user_info->role=='admin')
                { 
                    //echo $this->session->userdata('user_id');
                    @$permissions = $this->db->get_where('permissions',array('user_id'=>$this->session->userdata('user_id')))->result_array();
                    $permissions_list = array();
                    if(@$permissions)
                    {
                        foreach($permissions as $row)
                        {
                            $permissions_list[] = $row['type'];
                        }
                    }
                    
                    //print_r($permissions_list);
                    //echo $this->session->userdata('auth_level');
            ?>
            
            <?php if($this->session->userdata('crms') == 'joher'){  ?>
            
            <ul class="sidebar-menu">
               
                <li class = "<?php if($this->uri->segment('2') =='index') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/index" >
                        <i class="icon-speedometer"></i><span> Dashboard <?php echo $this->session->userdata('crms'); ?></span></a>
                    
                </li>
                
			
               <?php if(($this->session->userdata('auth_level') == 8 && in_array('1',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>    
                <li class = "<?php if($this->uri->segment('2') =='category_add') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/category_add" >
                         <i class="fa fa-list"></i><span> Category Management</span></a>
                </li>
            
            <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('2',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>
                <li class = "<?php if($this->uri->segment('2') =='user') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/user" >
                         <i class="fa fa-user"></i><span> Client Management</span></a>
                </li>
            <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('3',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>
                <li class = "<?php if($this->uri->segment('2') =='event') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/event" >
                         <i class="fa fa-magic"></i><span> Event Management</span></a>
                </li>
            <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('4',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>   
                <li class = "<?php if($this->uri->segment('2') =='wallet') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/wallet">
                         <i class="fa fa-money"></i><span> Wallet Management</span></a>
                </li>
             <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('5',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>   
                <li class = "<?php if($this->uri->segment('2') =='order') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/order" >
                         <i class="fa fa-recycle"></i><span> Order Management</span></a>
                </li>
             <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('6',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>     
                <li class = "<?php if($this->uri->segment('2') =='agent') { echo 'active'; }  ?>">
                <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/agent">
                    <i class="fa fa-user"></i><span> Agent Management </span>
                </a>
                </li>
             <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('12',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>         
                <li class = "<?php if($this->uri->segment('2') =='users') { echo 'active'; }  ?>">
                <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/users">
                    <i class="fa fa-user"></i><span> Sub User Management </span>
                </a>
                </li>
            <?php }?>    
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('7',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>     
                <li class = "<?php if($this->uri->segment('2') =='request_call') { echo 'active'; }  ?>">
                <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/request_call">
                    <i class="fa fa-phone"></i><span> Request Call </span>
                </a>
                </li>
            <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('8',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>     
                <li class = "<?php if($this->uri->segment('2') =='term_condition') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/term_condition">
                        <i class="fa fa-key"></i><span> Term and Condition</span>
                    </a>
                </li>
            <?php }?>  
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('9',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>
                 <li class = "<?php if($this->uri->segment('2') =='aboutus') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/aboutus">
                        <i class="fa fa-user"></i><span>About-Us</span>
                    </a>
                </li>
            <?php }?>  
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('10',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>   
                <li class = "<?php if($this->uri->segment('2') =='contactus') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/contactus">
                        <i class="fa fa-phone"></i><span>Contact-us</span>
                    </a>
                </li>
            <?php }?>  
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('11',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>    
                <li class = "<?php if($this->uri->segment('2') =='privacy_policy') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/privacy_policys">
                        <i class="icon-speech"></i><span>Privacy Policy</span>
                    </a>
                </li>
             <?php }?>  
              <?php if(($this->session->userdata('auth_level') == 8 && in_array('13',$permissions_list)) || $this->session->userdata('auth_level') == 9){?> 
                <li class = "crms">
                    <a class="waves-effect waves-dark" href="<?php echo base_url()?>admin/crms">
                        <i class="fa fa-users"></i><span>CRMS</span>
                    </a>
                </li>
             <?php }?> 
                
                <!--<li class="">
                    <a class="waves-effect waves-dark" href="<?php //echo base_url();?>home/logout" >
                        <i class="icon-logout"></i><span> Logout</span></a>
                    
                </li>-->
            </ul>
            
            <?php }else if($this->session->userdata('crms') == 'crms'){ ?>
            
            <ul class="sidebar-menu" >
                        
                        <li class = "crms">
                            <a class="waves-effect waves-dark" href="<?php echo base_url()?>admin/Joher">
                                <i class="fa fa-users"></i><span>ESSENCE</span>
                            </a>
                        </li>
                        
                        <li class = "<?php if($this->uri->segment('2') =='dashboard_index') { echo 'active'; }  ?>" ><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/dashboard_index">
                            <i class="icon-speedometer"></i><span> Dashboard </span></a>
                        </li>

                         <li class = "<?php if($this->uri->segment('2') =='client') { echo 'active'; }  ?>" ><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/client">
                        <i class="fa fa-user"></i><span> Client Management </span></a>
                        </li>

                         <li class = "<?php if($this->uri->segment('2') =='trip') { echo 'active'; }  ?>" ><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/trip">
                        <i class="icon-speedometer"></i><span>Trip Management</span></a>
                        </li>

                        <li class = "<?php if($this->uri->segment('2') =='hotel') { echo 'active'; }  ?>"><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/hotel">
                        <i class="icofont icofont-hotel"></i><span> Hotel/Villa/Apartment </span></a>
                        </li>
                        <li class = "<?php if($this->uri->segment('2') =='air_train') { echo 'active'; }  ?>"><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/air_train">
                       <i class="fa fa-train"></i><span> Air/Train ticket </span></a>
                        </li>
                        
                        <li class = "<?php if($this->uri->segment('2') =='aircraft') { echo 'active'; }  ?>"><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/aircraft">
                            <i class="fa fa-plane"></i><span> Aircraft </span></a>
                        </li>
                        
                        <li class = "<?php if($this->uri->segment('2') =='car_driver_security') { echo 'active'; }  ?>"><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/car_driver_security">
                       <i class="fa fa-car"></i><span> Car/Driver/Security </span></a>
                        </li>
                        
                        <li class = "<?php if($this->uri->segment('2') =='boat') { echo 'active'; }  ?>"><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/boat">
                            <i class="fa fa-ship"></i><span> Boat </span></a>
                        </li>
                        
                        <li class = "<?php if($this->uri->segment('2') =='company_fees') { echo 'active'; }  ?>"><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/company_fees">
                       <i class="fa fa-money"></i><span> Company Fees </span></a>
                        </li>
                        <li class = "<?php if($this->uri->segment('2') =='cruise') { echo 'active'; }  ?>"><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/cruise">
                       <i class="icofont icofont-ship"></i><span> Cruise </span></a>
                        </li>
                        <li class = "<?php if($this->uri->segment('2') =='cargo_package') { echo 'active'; }  ?>"><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/cargo_package">
                       <i class="icofont icofont-package"></i><span> Cargo/package </span></a>
                        </li>
                        <li class = "<?php if($this->uri->segment('2') =='crm_event') { echo 'active'; }  ?>"><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/crm_event">
                       <i class="icofont icofont-magic"></i><span> Event </span></a>
                        </li>
                        <li class = "<?php if($this->uri->segment('2') =='miscellaneous') { echo 'active'; }  ?>"><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/miscellaneous">
                       <i class="icofont icofont-cube"></i><span> Miscellaneous </span></a>
                        </li>
                        
                        <li class = "<?php if($this->uri->segment('2') =='class_type') { echo 'active'; }  ?>" ><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/class_type">
                        <i class="fa fa-home"></i><span> Class Type </span></a>
                        </li>
                        
                        <li class = "<?php if($this->uri->segment('2') =='suplier') { echo 'active'; }  ?>" ><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/suplier">
                        <i class="fa fa-building-o"></i><span> Suplier Management </span></a>
                        </li>

                        <!-- <li class = "<?php //if($this->uri->segment('2') =='airlines') { echo 'active'; }  ?>" ><a class="waves-effect waves-dark" href="<?php //echo base_url();?>admin/airlines_choice">
                        <i class="fa fa-home"></i><span> Add Airlines Choice </span></a>
                        </li>

                        <li class = "<?php //if($this->uri->segment('2') =='hotel_chain') { echo 'active'; }  ?>" ><a class="waves-effect waves-dark" href="<?php //echo base_url();?>admin/hotel_chain">
                        <i class="fa fa-home"></i><span> Add Hotel Choice </span></a>
                        </li>

                        <li class = "<?php //if($this->uri->segment('2') =='car_choice') { echo 'active'; }  ?>" ><a class="waves-effect waves-dark" href="<?php //echo base_url();?>admin/car_choice">
                        <i class="fa fa-home"></i><span>Add Car Choice </span></a>
                        </li> -->

                       
                        <li class = "<?php if($this->uri->segment('2') =='city' || $this->uri->segment('2') =='local_city') { echo 'active'; }  ?>">
                            <a class="waves-effect waves-dark" href="javascript:" >
                                <i class="fa fa-home"></i><span>City Management </span><i class="icon-arrow-down"></i>
                            </a>  
                             <ul class="treeview-menu">
                                <li class = "<?php if($this->uri->segment('2') =='city') { echo 'active'; }  ?>" >
                                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/city">
                                <i class="fa fa-home"></i><span> Add City </span></a>
                                </li> 
                                
                                <li class = "<?php if($this->uri->segment('2') =='local_city') { echo 'active'; }  ?>" ><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/local_city">
                                <i class="fa fa-home"></i><span> Add local City </span></a>
                                </li> 
                             </ul>
                        </li>
                        
                        <li class = "<?php if($this->uri->segment('2') =='fcr') { echo 'active'; }  ?>" ><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/fcr">
                            <i class="fa fa-building-o"></i><span> FCR Management </span></a>
                        </li>
                        
                        <li class = "<?php if($this->uri->segment('2') =='fee_management') { echo 'active'; }  ?>" ><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/fee_management">
                            <i class="fa fa-university"></i><span> Banking/Management Fee </span></a>
                        </li>
                        
                         <li class = "<?php if($this->uri->segment('2') =='bank_details') { echo 'active'; }  ?>" ><a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/bank_details">
                            <i class="fa fa-credit-card"></i><span> Bank details </span></a>
                        </li>
                        
            </ul>
            
            <?php }
                  else
                  { 
                      
            ?>
            
            <ul class="sidebar-menu">
                
                <li class = "<?php if($this->uri->segment('2') =='index') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/index" >
                        <i class="icon-speedometer"></i><span> Dashboard <?php echo $this->session->userdata('crms'); ?></span></a>
                    
                </li>
                
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('1',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>    
                <li class = "<?php if($this->uri->segment('2') =='category_add') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/category_add" >
                         <i class="fa fa-list"></i><span> Category Management</span></a>
                </li>
            
            <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('2',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>
                <li class = "<?php if($this->uri->segment('2') =='user') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/user" >
                         <i class="fa fa-user"></i><span> Client Management</span></a>
                </li>
            <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('3',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>
                <li class = "<?php if($this->uri->segment('2') =='event') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/event" >
                         <i class="fa fa-magic"></i><span> Event Management</span></a>
                </li>
            <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('4',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>   
                <li class = "<?php if($this->uri->segment('2') =='wallet') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/wallet">
                         <i class="fa fa-money"></i><span> Wallet Management</span></a>
                </li>
             <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('5',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>   
                <li class = "<?php if($this->uri->segment('2') =='order') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/order" >
                         <i class="fa fa-recycle"></i><span> Order Management</span></a>
                </li>
             <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('6',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>     
                <li class = "<?php if($this->uri->segment('2') =='agent') { echo 'active'; }  ?>">
                <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/agent">
                    <i class="fa fa-user"></i><span> Agent Management </span>
                </a>
                </li>
             <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('12',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>         
                <li class = "<?php if($this->uri->segment('2') =='users') { echo 'active'; }  ?>">
                <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/users">
                    <i class="fa fa-user"></i><span> Sub User Management </span>
                </a>
                </li>
            <?php }?>    
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('7',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>     
                <li class = "<?php if($this->uri->segment('2') =='request_call') { echo 'active'; }  ?>">
                <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/request_call">
                    <i class="fa fa-phone"></i><span> Request Call </span>
                </a>
                </li>
            <?php }?>
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('8',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>     
                <li class = "<?php if($this->uri->segment('2') =='term_condition') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/term_condition">
                        <i class="fa fa-key"></i><span> Term and Condition</span>
                    </a>
                </li>
            <?php }?>  
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('9',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>
                 <li class = "<?php if($this->uri->segment('2') =='aboutus') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/aboutus">
                        <i class="fa fa-user"></i><span>About-Us</span>
                    </a>
                </li>
            <?php }?>  
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('10',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>   
                <li class = "<?php if($this->uri->segment('2') =='contactus') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/contactus">
                        <i class="fa fa-phone"></i><span>Contact-us</span>
                    </a>
                </li>
            <?php }?> 
            
            <?php if(($this->session->userdata('auth_level') == 8 && in_array('11',$permissions_list)) || $this->session->userdata('auth_level') == 9){?>    
                <li class = "<?php if($this->uri->segment('2') =='privacy_policy') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/privacy_policys">
                        <i class="icon-speech"></i><span>Privacy Policy</span>
                    </a>
                </li>
             <?php }?>  
              <?php if(($this->session->userdata('auth_level') == 8 && in_array('13',$permissions_list)) || $this->session->userdata('auth_level') == 9){?> 
                <li class = "crms">
                    <a class="waves-effect waves-dark" href="<?php echo base_url()?>admin/crms">
                        <i class="fa fa-users"></i><span>CRMS</span>
                    </a>
                </li>
             <?php }?>   
                <!--<li class="">
                    <a class="waves-effect waves-dark" href="<?php //echo base_url();?>home/logout" >
                        <i class="icon-logout"></i><span> Logout</span></a>
                    
                </li>-->
            </ul>
            
            <?php } ?>
            
            <?php } ?>
            
             <!-- Sidebar Menu-->
            <?php if($user_info->role=='agent'){ ?>
            <ul class="sidebar-menu">
                <li class = "<?php if($this->uri->segment('2') =='index') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/index" >
                        <i class="icon-speedometer"></i><span> Dashboard</span></a>
                    
                </li>
                
                <li class = "<?php if($this->uri->segment('2') =='chat') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/chat" >
                        <i class="icon-people"></i><span> Chat</span>
                    </a>
                </li>
                
                <li class = "<?php if($this->uri->segment('2') =='chat_history') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/chat_history" >
                        <i class="icon-people"></i><span> Chat History</span>
                    </a>
                </li>
                
                <li class = "<?php if($this->uri->segment('2') =='add_order') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/add_order" >
                        <i class="icon-bag"></i><span>Add Invoice</span>
                    </a>
                </li>
                
                <li class = "<?php if($this->uri->segment('2') =='view_order') { echo 'active'; }  ?>">
                    <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin/view_order" >
                        <i class="icon-check"></i><span>Paid Orders</span>
                    </a>
                </li>
                
                <li>
                        <div class="btn-group btn-group-sm" style="float: none;">
                            <?php if($user_info->off_on_line==1){ ?>
                             <a  id = "<?=$user_info->user_id?>" class="btn btn-primary btn-sm waves-effect waves-light"   onclick="myoffFunction('<?=$user_info->user_id?>','<?=$user_info->off_on_line?>')"  data-id="" style="float: none;margin: 5px;color: #fff;"> 
                                On-line
                            </a>
                             <?php }else{ ?>
                            <a onclick="myoffFunction('<?=$user_info->user_id?>','<?=$user_info->off_on_line?>')" class="btn btn-primary btn-sm waves-effect waves-light delete_team_mem" data-id="" style="float: none;margin: 5px;color: #fff;"> 
                                Off-line
                            </a>
                            
                             <?php }?>
                             
                        </div>
                </li>
            
             </ul>
            <?php } ?>
            
        </section>
    </aside>
    <!-- Side-Nav-end-->
    
<script>
    function myoffFunction(id,offon) 
    {
            $.ajax({ url:'<?php echo base_url();?>/admin/off_on_line',
    	    type:'POST',
    	    data: {id:id,offon:offon},
    	    success: function(data)
    	    {
    	        console.log(data);
    	        location.reload();
    	    }
          });
    
    }
</script>
<script>
    function mCrms()
    {
        alert('hi');
    }
</script>
