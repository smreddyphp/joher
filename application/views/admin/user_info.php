 
 <script type="text/javascript">

$(document).ready(function(){

 var objDiv = $(".panel-body");
 var h = objDiv.get(0).scrollHeight;
 objDiv.animate({scrollTop: h});

setInterval(function(){ 

var sender_id = '<?php echo $this->uri->segment(3); ?>';
var receiver_id = $('#receiver_id').val();
var chat_start_end = 1;

console.log(sender_id +''+ receiver_id);
console.log(receiver_id);

$.ajax({ url:'<?php echo base_url();?>admin/agent_chat_view',
	type:'POST',
	data: {sid:sender_id,rid:receiver_id,chat_start_end:chat_start_end},
	success: function(data)
	{
	    //alert(data);
        $("#chatmsg1").html(data);
	    //location.reload();
	}
      });
        var objDiv = $(".panel-body");
    	 var h = objDiv.get(0).scrollHeight;
    	 //objDiv.animate({scrollTop: h});

 }, 1000); 
 

});
</script>
 
 <script type="text/javascript">
    $(document).ready(function()
    {
        setInterval(function(){ 
                $.ajax({ url:'<?php echo base_url();?>admin/client_list1/<?php echo $this->uri->segment(3); ?>',
            	type:'POST',
            	data: {sid:'hi'},
            	success: function(data)
            	{
            	    //alert(data);
                    $(".client_list").html(data);
            	    //location.reload();
            	}
                  });
        }, 1000);   
    });        
</script>
 
  <script type="text/javascript">

 $('#msg_val').keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    //alert('You pressed a "enter" key in textbox'); 
                myFunction();                
}             
                event.stopPropagation();
            });

function myFunction(id)
{
//alert('oye');
var sender_id   = '<?php echo $sender_id; ?>';
var receiver_id = id; 
//var msg = document.getElementById("msg_val").value;

    //alert(msg);
   /* alert(sender_id);
    alert(receiver_id);*/
    $('.media_show').html('<a class="btn btn-success btn-sm" style="background-color: #67626df0;" target = "_blank" href = "<?php echo base_url();?>admin/media/'+id+'/'+sender_id+'">Media</a>');
    $.ajax({ url:'<?php echo base_url();?>/admin/list_chat_message',
	type:'POST',
	data: {sid:sender_id,rid:receiver_id},
	success: function(data)
	{
    	//alert(data);
    	console.log(data);
        if(data)
        {
           //document.getElementById("msg_val").value='';
           $('#msg_val').val('');
           
    		$("#chatmsg").html(data);
    
             var objDiv = $(".panel-body");
        	 var h = objDiv.get(0).scrollHeight;
        	 objDiv.animate({scrollTop: h});
    
        }      
    	//location.reload();
	}
      });

}

</script>


<!-- CONTENT-WRAPPER-->
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="main-header">
                    <h4>Profile</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="javascript:" ><i class="icofont icofont-home"></i></a>
                        </li>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:" ><?=$page_name?></a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- Header end -->
            <div class="row">
                

                <!-- start col-lg-9 -->
                <div class="col-xl-12 col-lg-12">
                    <!-- Nav tabs -->
                    <div class="tab-header">
                        <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link " data-toggle="tab" href="#personal" role="tab"><i>Personal Info</i></a>
                                <div class="slide"></div>
                            </li>
                            <?php  $userleval = $this->db->where('user_id',$this->uri->segment(3))->get('users')->row()->auth_level;?>
                            <?php if($userleval != 6){?>
                            <li class="nav-item">
                                <a  class="nav-link" data-toggle="tab" href="#tab2" role="tab"><i>Add Wallet Information</i></a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" data-toggle="tab" href="#tab3" role="tab"><i>Paid Wallet Information</i></a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" data-toggle="tab" href="#tab4" role="tab"><i>View Place</i></a>
                                <div class="slide"></div>
                            </li>
                            <?php } ?>
                            
                            <li class="nav-item">
                                <a  class="nav-link" data-toggle="tab" href="#tab5" role="tab"><i>View Invoice</i></a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" data-toggle="tab" href="#tab6" role="tab"><i>Paid Order</i></a>
                                <div class="slide"></div>
                            </li>
                            
                            
                           
                            
                            
                            <li class="nav-item">
                                <a  class="nav-link" data-toggle="tab" href="#tab7" role="tab"><i>Chat Information</i></a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" data-toggle="tab" href="#tab8" role="tab"><i>Online-Chat</i></a>
                                <div class="slide"></div>
                            </li>
                            
                        </ul>
                    </div>
                    <!-- end of tab-header -->

                    <div class="tab-content">
                        
                        <div class="tab-pane active" id="personal" role="tabpanel">
                            <div class="card">
                                <div class="card-header"><h5 class="card-header-text">About Me</h5>
                                    <?php 
                                    //print_r($users->username);
                                    /*foreach ($users as $key_users => $value_users) {
                                        $user_info]=$value_users;
                                       
                                    }
                                     print_r($users->username);*/
                                    ?>
                                </div>
                                <div class="card-block">
                                   
                                    <!-- end of view-info -->

    <div class="edit-info">
    <div class="row">
        <div class="col-lg-8">
            <div class="general-info">
                <div class="row">
                    <div class="col-lg-12">
                        <?php //print_r($adds);?>
                 <form id="profile_update" method="post">
                     <table class="table">
                        <tbody>
                    
                        <tr>
                            <td>
                                <div class="md-group-add-on">
                                 <span class="md-add-on">
                                     <i class="icofont icofont-ui-user"></i>
                                 </span>
                                    <div class="md-input-wrapper">
                                <input type="text" class="md-form-control" value="<?php echo $adds->user_name; ?>" placeholder="Please Enter Name" name="data[user_name]" readonly>

                                <input type="hidden" name="data2[user_id]" value="<?php echo $adds->user_id; ?>">
                                      
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td>

                                <div class="form-radio">
                                   
                                    <div class="md-group-add-on">
                                    <span class="md-add-on">
                                    <i class="icofont icofont-group-students"></i>
                                    </span>
                               
                             </div>
                         
                        </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="md-group-add-on">
                            <span class="md-add-on-file">
                            <!--<button class="btn btn-success waves-effect waves-light">File</button>-->
                            </span>
                            <div class="md-input-file">
                                <!--<input type="file" class="" name="profile_image">-->
                                <img class="img-fluid" src="<?php echo base_url((empty($adds->image)) ? "assets/uploads/user_profiles/profile.png": $adds->image); ?>" alt="" style="max-width: 5%">
                                <input type="text" class="md-form-control md-form-file" readonly>
                                <label class="md-label-file"></label>
                            <span class="md-line"></span></div>
                            <input type="hidden" name="data2[old_image]" value="<?php echo $user_info->image;?>">
                        </div>
                        </td>
                    </tr>

                     <tr>
                        <td>
                            <div class="md-group-add-on">
                             <span class="md-add-on">
                                 <i class="icofont icofont-email"></i>
                             </span>
                                <div class="md-input-wrapper">
                            <input type="email" class="md-form-control" value="<?php echo $adds->email; ?>" placeholder="Enater Your Email" name="data[email]" readonly>
                                    <!-- <label>Email</label> -->
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="md-group-add-on">
                             <span class="md-add-on">
                                 <i class="icofont icofont-address-book"></i>
                             </span>
                                <div class="md-input-wrapper">
                            <input type="text" class="md-form-control" value="<?php echo $adds->address; ?>" placeholder="Enater Your address" name="data[address]" readonly>
                                   
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="md-group-add-on">
                             <span class="md-add-on">
                                 <i class="icofont icofont-5-star-hotel"></i>
                             </span>
                                <div class="md-input-wrapper">
                            <input type="text" class="md-form-control" value="<?php echo $adds->country; ?>" placeholder="Enater Your country" name="data[country]" readonly>
                                   
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="md-group-add-on">
                             <span class="md-add-on">
                                 <i class="icofont icofont-mobile-phone"></i>
                             </span>
                                <div class="md-input-wrapper">
                                    <input type="text" class="md-form-control" placeholder="Enater Your Mobile Number" value="<?php echo $adds->mobile; ?>" name="data[mobile]" readonly>
                                   <!--  <label>Mobile Number</label> -->
                                </div>
                            </div>
                        </td>

                    </tr>

                    <!--<tr>
                        <td>
                            <button type="submit" class="btn btn-warning waves-effect waves-light m-r-30 update_profile" style="margin-left: 50%;">Submit</button>
                        </td>
                    </tr>-->
               
                    
                    </tbody>
                </table>
                 </form>
            </div>
            
            <!-- end of table col-lg-12 -->

            

                                                       
                                                    </div>
                                                    <!-- end of row -->
                                                    <!-- <div class="text-center">
                                                        <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                        <!-- <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a> -->
                                                    <!--</div> -->
                                                </div>
                                                <!-- end of edit info -->
                                            </div>
                                            <!-- end of col-lg-12 -->
                                        </div>
                                        <!-- end of row -->

                                    </div>
                                    <!-- end of view-info -->
                                </div>
                                <!-- end of card-block -->
                            </div>
                            <!-- end of card-->
                            
                            <!-- end of row of education and experience  -->
       </div>
                            
                            <!-- end of row -->
                          <div class="tab-pane fade " id="tab2" role="tabpane">
                            <div class="card">
                            <div class="card-header"><h5 class="card-header-text">  Total Wallet Amount is = 
                        <?php    
                           
                            $this->db->from('add_user_wallet');
                            $this->db->where('user_id',$adds->user_id);
                            $this->db->where('pay_add_id',1);
                            $this->db->order_by("wid", "desc");
                            $query1 = $this->db->get()->result();
                            
                            if(sizeof($query1) > 0)
                            {
                                $this->db->from('add_user_wallet');
                                $this->db->where('user_id',$adds->user_id);
                                $this->db->where('pay_add_id',1);
                                $this->db->order_by("wid", "desc");
                                echo $query = $this->db->get()->row()->amount; 
                            }
                            else
                            {
                                echo 0;
                            }
                            
                            //return $query->result();
                        ?>
                            </h5>
                                    
                                </div>

                             <div class="card-block">
                                   
                                    <!-- end of view-info -->

                                    <div class="edit-info">
                                        <div class="row">
                                            <div class="">
                                                <div class="general-info">
                                                    <div class="row">
                                                        <div class="">
                                                            <?php  //echo $adds->user_id;?>
                   
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
                <tr>
                    <th>S NO</th>
                    <th>Order No</th>
                    <th>Add Amount</th>
                    <th>Payment Status</th>
                    <th>Insert Date</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>S NO</th>
                    <th>Order No</th>
                    <th>Add Amount</th>
                    <th>Payment Status</th>
                    <th>Insert Date</th> 
                </tr>
              </tfoot>
              <tbody>
                   <?php 
                        //echo "<pre>";
                       // print_r($adds->user_id);
                        
                        $records = $this->db->where('user_id',$adds->user_id)->where('pay_add_id',1)->get('add_user_wallet')->result_array();
                        
                        //$records=[];
                        $counter = 1;
                        foreach($records as $key){
                            
                            if($key['payment_status'] == 1)
                            {
                                 $status = '<button type="button" class="btn btn-primary waves-effect waves-light active_inactive" data-name="'.$current_page.'" data-target = "#add_vehicle" data-id="'.$key["user_id"].'"  style="float: none;margin: 5px;"> 
                                                <span class="icofont icofont-ui-active">Successful</span>
                                        </button>';    
                            }
                            else
                            {
                                $status = '<button type="button" class="btn btn-primary waves-effect waves-light active_inactive" data-name="'.$current_page.'" data-target = "#add_vehicle" data-id="'.$key["user_id"].'"  style="float: none;margin: 5px;"> 
                                                <span class="icofont icofont-ui-active">Pending</span>
                                        </button>';    
                            }
                            
                           echo '
                                <tr id="hide'.$key["user_id"].'">
                                    <td>'.$counter.'</td> 
                                    <td>'.$key["order_no"].'</td>
                                    <td>'.$key["add_amount"].'</td>
                                    <td>'.$status.'</td>
                                    <td>'.$key["insert_date"].'</td>
                                </tr>
                          ';
                          $counter++;
                      }
                  ?> 
              
              
              </tbody>
            </table>
          </div>
       
                                                             
                                                        </div>
                                                        <!-- end of table col-lg-6 -->
                                                    </div>
                                                    <!-- end of row -->
                                                    <div class="text-center">
                                                       <!--  <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a> -->
                                                        <!-- <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a> -->

                                                    </div>
                                                </div>
                                                <!-- end of edit info -->
                                            </div>
                                            <!-- end of col-lg-12 -->
                                        </div>
                                        <!-- end of row -->

                                    </div>
                                    <!-- end of view-info -->
                                </div>

                                </div>
                           
                          </div>
                          
                          
                     
                        <!-- end of tab-pane -->
                        
                        <!-- end of about us tab-pane -->

                       <div class="tab-pane fade " id="tab3" role="tabpane">
                            <div class="card">
                            <div class="card-header"><h5 class="card-header-text">  Total Wallet Amount is = 
                        <?php    
                           
                            $this->db->from('add_user_wallet');
                            $this->db->where('user_id',$adds->user_id);
                            $this->db->where('pay_add_id',1);
                            $this->db->order_by("wid", "desc");
                            $query1 = $this->db->get()->result();
                            
                            if(sizeof($query1) > 0)
                            {
                                $this->db->from('add_user_wallet');
                                $this->db->where('user_id',$adds->user_id);
                                $this->db->where('pay_add_id',1);
                                $this->db->order_by("wid", "desc");
                                echo $query = $this->db->get()->row()->amount; 
                            }
                            else
                            {
                                echo 0;
                            }
                            
                            //return $query->result();
                        ?>
                            </h5>
                                    
                                </div>

                             <div class="card-block">
                                   
                                    <!-- end of view-info -->

                                    <div class="edit-info">
                                        <div class="row">
                                            <div class="">
                                                <div class="general-info">
                                                    <div class="row">
                                                        <div class="">
                                                            <?php  //echo $adds->user_id;?>
           
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
                <tr>
                    <th>S NO</th>
                    <th>Order No</th>
                    <th>Paid Amount</th>
                    <th>Payment Status</th>
                    <th>Insert Date</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>S NO</th>
                    <th>Order No</th>
                    <th>Paid Amount</th>
                    <th>Payment Status</th>
                    <th>Insert Date</th> 
                </tr>
              </tfoot>
              <tbody>
                   <?php 
                        //echo "<pre>";
                       // print_r($adds->user_id);
                        
                        $records = $this->db->where('user_id',$adds->user_id)->where('pay_add_id',2)->get('add_user_wallet')->result_array();
                        
                        //$records=[];
                        $counter = 1;
                        foreach($records as $key){
                            
                            if($key['payment_status'] == 1)
                            {
                                 $status = '<button type="button" class="btn btn-primary waves-effect waves-light active_inactive" data-name="'.$current_page.'" data-target = "#add_vehicle" data-id="'.$key["user_id"].'"  style="float: none;margin: 5px;"> 
                                                <span class="icofont icofont-ui-active">Successful</span>
                                        </button>';    
                            }
                            else
                            {
                                $status = '<button type="button" class="btn btn-primary waves-effect waves-light active_inactive" data-name="'.$current_page.'" data-target = "#add_vehicle" data-id="'.$key["user_id"].'"  style="float: none;margin: 5px;"> 
                                                <span class="icofont icofont-ui-active">Pending</span>
                                        </button>';    
                            }
                            
                           echo '
                                <tr id="hide'.$key["user_id"].'">
                                    <td>'.$counter.'</td> 
                                    <td>'.$key["order_no"].'</td>
                                    <td>'.$key["paid_amount"].'</td>
                                    <td>'.$status.'</td>
                                    <td>'.$key["insert_date"].'</td>
                                </tr>
                          ';
                          $counter++;
                      }
                  ?> 
              
              
              </tbody>
            </table>
          </div>
       
                                                             
                                                        </div>
                                                        <!-- end of table col-lg-6 -->
                                                    </div>
                                                    <!-- end of row -->
                                                    <div class="text-center">
                                                       <!--  <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a> -->
                                                        <!-- <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a> -->

                                                    </div>
                                                </div>
                                                <!-- end of edit info -->
                                            </div>
                                            <!-- end of col-lg-12 -->
                                        </div>
                                        <!-- end of row -->

                                    </div>
                                    <!-- end of view-info -->
                                </div>

                                </div>
                           
                          </div>
                          
                          
                     
                        <!-- end of tab-pane -->
                        
                        
                            <div class="tab-pane fade " id="tab4" role="tabpane">
                            <div class="card">
                            <div class="card-header"><h5 class="card-header-text">  View Place 
                       
                            </h5>
                                    
                                </div>

                             <div class="card-block">
                                   
                                    <!-- end of view-info -->

                                    <div class="edit-info">
                                        <div class="row">
                                            <div class="">
                                                <div class="general-info">
                                                    <div class="row">
                                                        <div class="">
                                                            <?php  //echo $adds->user_id;?>
           
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
                <tr>
                    <th>S NO</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Note</th>
                    <th>Location</th>
                    <th>Insert Date</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>S NO</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Note</th>
                    <th>location</th>
                    <th>Insert Date</th> 
                </tr>
              </tfoot>
              <tbody>
                   <?php 
                        //echo "<pre>";
                       // print_r($adds->user_id);
                        
                        $records = $this->db->where('user_id',$adds->user_id)->get('add_place')->result_array();
                        //print_r($records);
                        //$records=[];
                        $counter = 1;
                        foreach($records as $key){
                            
                           
                            
                           echo '
                                <tr id="hide'.$key["user_id"].'">
                                    <td>'.$counter.'</td> 
                                    <td> <img src="'.base_url().$key["image"].'"  style="width:30%;background-color:gray;"</td>
                                    <td>'.$key["title"].'</td>
                                    <td>'.$key["note"].'</td>
                                    <td>'.$key["location"].'</td>
                                    <td>'.$key["insert_date"].'</td>
                                </tr>
                          ';
                          $counter++;
                      }
                  ?> 
              
              
              </tbody>
            </table>
          </div>
       
                                                             
                                                        </div>
                                                        <!-- end of table col-lg-6 -->
                                                    </div>
                                                    <!-- end of row -->
                                                    <div class="text-center">
                                                       <!--  <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a> -->
                                                        <!-- <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a> -->

                                                    </div>
                                                </div>
                                                <!-- end of edit info -->
                                            </div>
                                            <!-- end of col-lg-12 -->
                                        </div>
                                        <!-- end of row -->

                                    </div>
                                    <!-- end of view-info -->
                                </div>

                                </div>
                           
                          </div>
                          
                        <!-- end of tab-pane -->
                       
                        <div class="tab-pane fade " id="tab5" role="tabpane">
                            <div class="card">
                            <div class="card-header"><h5 class="card-header-text">  View Invoice
                       
                            </h5>
                                    
                                </div>

                             <div class="card-block">
                                   
                                    <!-- end of view-info -->

                                     <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
                <th>S NO</th>
                <th>Invoice Order</th>
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Category</th>
                <th>Service Price</th>
                <th>Discount</th>
                <th>Total</th>
              
                <th>Payment Status</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>S NO</th>
                <th>Invoice Order</th>
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Category</th>
                <th>Service Price</th>
                <th>Discount</th>
                <th>Total</th>
               
                <th>Payment Status</th>
              </tr>
              </tfoot>
              <tbody>
                  <?php 
                    $invoice = ($invoice)?$invoice:$agent_invoice;
                  
                  //print_r($invoice); 
                  $count=1; foreach($invoice as $row){ ?>
                    <tr>
                        <th><?=$count++?></th>
                        <th><?=$row['invoice_id']?></th>
                        <th><?php echo $this->db->where('user_id',$row['user_id'])->get('users')->row()->user_name;?></th>
                        <th><?php $email = $this->db->where('user_id',$row['user_id'])->get('users')->row(); if($email){ echo $email->email; }?></th>
                        <th><?php echo $this->db->where('id',$row['category_id'])->get('category_adds')->row()->category_name;?></th>
                        <th><?=$row['service_price']?></th>
                        <th><?=$row['discount']?></th>
                        <th><?=$row['total']?></th>
                        <!--<th>
                            <div class="btn-group btn-group-sm" style="float: none;">
                                 <button type="button" class="btn btn-primary btn-sm waves-effect waves-light add_adds" data-toggle="modal" data-name="<?=$current_page?>" data-target="#add_vehicle" data-id="<?=$row['id']?>" style="float: none;margin: 5px;"> 
                                    <span class="icofont icofont-ui-edit"></span>
                                </button>
                                <button type="button" class="btn btn-primary waves-effect waves-light delete_team_mem" data-id="<?=$row['id']?>" style="float: none;margin: 5px;"> 
                                    <span class="icofont icofont-ui-delete"></span>
                                </button>
                            </div>
                        </th>-->
                        
                        <th><?php if($row['payment_status'] == '1'){ ?> <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-name="agent" data-target="#add_vehicle" data-id="170" style="float: none;margin: 5px;"> 
                                              paid
                                            </button> <?php }else{ ?><button type="button" class="btn btn-primary btn-sm waves-effect waves-light delete_team_mem" data-id="173" style="float: none;margin: 5px;"> 
                                                 Un-paid
                                            </button><?php } ?>
                        </th>
                    </tr>
                <?php } ?>
              </tbody>
            </table>
                                    <!-- end of view-info -->
                                </div>

                                </div>
                           
                          </div>
                          
                        <div class="tab-pane fade " id="tab6" role="tabpane">
                            <div class="card">
                            <div class="card-header"><h5 class="card-header-text">  Paid Order 
                       
                            </h5>
                                    
                                </div>

                             <div class="card-block">
                                   
                                    <!-- end of view-info -->

                                     <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
                <th>S NO</th>
                <th>Invoice Order</th>
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Category</th>
                <th>Service Price</th>
                <th>Discount</th>
                <th>Total</th>
                 <th>Actions</th>
               <!-- <th>Payment Status</th>-->
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>S NO</th>
                <th>Invoice Order</th>
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Category</th>
                <th>Service Price</th>
                <th>Discount</th>
                <th>Total</th>
                <th>Actions</th>
               <!-- <th>Payment Status</th>-->
              </tr>
              </tfoot>
              <tbody>
                  <?php //agent_order
                    $order = ($order)?$order:$agent_order;
                    //print_r($order); 
                    $count=1; foreach($order as $row){ ?>
                    <tr>
                        <th><?=$count++?></th>
                        <th><?=$row['invoice_id']?></th>
                        <th><?php echo $this->db->where('user_id',$row['user_id'])->get('users')->row()->user_name;?></th>
                        <th><?php $email = $this->db->where('user_id',$row['user_id'])->get('users')->row(); if($email){ echo $email->email; }?></th>
                        <th><?php echo $this->db->where('id',$row['category_id'])->get('category_adds')->row()->category_name;?></th>
                        <th><?=$row['service_price']?></th>
                        <th><?=$row['discount']?></th>
                        <th><?=$row['total']?></th>
                        <th>
                           
                            <!--<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-id="<?=$row['id']?>" style="float: none;margin: 5px; background-color: #2196F3;border-color: #2196F3;color: #fff !important;"> 
                                <i class="icofont icofont-eye m-r-5"></i>
                            </button>-->
                            
                            <?php if($row['payment_status'] == '1'){ ?> <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-name="agent" data-target="#add_vehicle" data-id="170" style="float: none;margin: 5px;"> 
                                              paid
                                            </button> <?php }else{ ?><button type="button" class="btn btn-primary btn-sm waves-effect waves-light delete_team_mem" data-id="173" style="float: none;margin: 5px;"> 
                                                 Un-paid
                                            </button><?php } ?>
                            
                        </th>
                        
                        <!--<th><?php if($row['payment_status'] == '1'){ ?> <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-name="agent" data-target="#add_vehicle" data-id="170" style="float: none;margin: 5px;"> 
                                              paid
                                            </button> <?php }else{ ?><button type="button" class="btn btn-primary btn-sm waves-effect waves-light delete_team_mem" data-id="173" style="float: none;margin: 5px;"> 
                                                 Un-paid
                                            </button><?php } ?>
                        </th>-->
                    </tr>
                <?php } ?>
              </tbody>
            </table>
                                    <!-- end of view-info -->
                                </div>

                                </div>
                           
                          </div>
                          
                            <div class="tab-pane fade " id="tab7" role="tabpane">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">  Chat Information </h5>
                                    </div>
    
                                    <div class="card-block">
                                        <!-- end of view-info -->
                                        <style>
    .chat-body {
        overflow-y: auto;
        height: auto;
    }
     .pull-right {
        float: right !important;
    }
    .pull-left {
        float: left!important;
    }
    .chat
    {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    
    .chat li
    {
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px dotted #B3A9A9;
    }
    
    .chat li.left .chat-body
    {
        margin-left: 60px;
     
        margin-bottom: 25px;
        margin-top: 15px;
    }
    
    .chat li.right .chat-body
    {
       margin-left: 60px;
     
        margin-bottom: 25px;
        margin-top: 15px;
    }
    
    
    .chat li .chat-body p
    {
        margin: 0;
        color: #777777;
    }
    
    .panel .slidedown .glyphicon, .chat .glyphicon
    {
        margin-right: 5px;
    }
    
    .panel-body
    {
        overflow-y: scroll;
        height: 400px;
    	    padding: 15px;
        width: 100%;
    }
    
    ::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }
    
    ::-webkit-scrollbar
    {
        width: 12px;
        background-color: #F5F5F5;
    }
    
    ::-webkit-scrollbar-thumb
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }
    .panel-body {
        padding: 15px;
    }
    .panel-footer .input-group .form-control {
        position: relative;
        z-index: 2;
        float: left;
        width: 100%;
        margin-bottom: 0;
        height: 60px;
    }
    .panel-footer {
    padding: 10px 0px 10px 15px;
        background-color: #fafafa;
        border-top: 1px solid #eeeeee;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
        width: 50%;
    }
    button#btn-chat {
        height: 60px;
        background: #6f106c;
        border: 1px solid #6f106c;
        font-size: 14px;
        letter-spacing: 0.5px;
        font-weight: 500;
    }
    
    span.chat-img img {
        width: 50px;
        height: 50px;
    }
    span.chat-img .on-active {
        position: relative;
        right: 15px;
        bottom: 15px;
    		 color:green;
    }
    
    
    .chat li.left .chat-body ,
    .chat li.right .chat-body{
    
    }
     
     .on-active{
    	 color:green;
     }
    </style>
                             
                                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card col-lg-12">
                                    <div class="card-header">
                                        <h5 class="card-header-text">
                                            
                                            <?php  $userleval1 = $this->db->where('user_id',$this->uri->segment(3))->get('users')->row()->auth_level;?>
                                            <?php if($userleval1 == 6){ echo "Client List";}else { echo "Agent List";}?>
                                        </h5>
                                    </div>
                                    <div class="table">
                                        <?php 
                                            $query = "select receiver_id from chats where sender_id=".$this->uri->segment(3)." group by receiver_id";
                                            $list = $this->db->query($query)->result_array();
                                            //print_r($list);
                                        ?>
                                        
                                        <ul class="sidebar-menu" style="overflow: inherit;">
                                            <?php if($list){ foreach($list as $row){ ?>
                                            
                                                    <?php 
                                                            $res = $this->db->where('user_id',$row['receiver_id'])->get('users')->row(); //->image;
                                                        ?>
                                                <li class="">
                                                    <a class="" onclick="myFunction('<?=$row['receiver_id']?>')" >
                                                        <img src="<?php  if($res){echo base_url().$res->image; }else{ echo base_url().'assets/uploads/user_profiles/default1.png';} ?>" alt="User Avatar" class="img-circle" style = "width: 30px;height: 30px">
                                                        <span> <?php if($res){echo $res->user_name; }else{ echo ''; } ?></span></a>
                                                    
                                                </li>
                                                
                                            <?php } } ?>
                                        </ul>    
                                        
                                    </div>
                                </div>    
                        
         
                            </div>
                     
                            <div class="col-xl-6">
                                <div class="card col-lg-12">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Conversion</h5>
                                    </div>
                                    <div class="table">
                                        <div class="table-content">
                                            <div class="project-table p-20">
                                                <table id="product-list-dasbord" class="table dt-responsive nowrap" width="100%" cellspacing="0">
                                                    <tbody>
                                                        <div class="panel-body">                 
                                                    		<ul class="chat" id="chatmsg">			
                                                    												
                                                    			
                                                    									
                                                    		</ul>
                                                		</div>
                                                		
                                                		<div class="input-group" style = "margin-bottom: 5px;">
                                                            <div class="col-lg-2">
                                                            </div>
                                                            <div class="col-lg-7">
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <span class="input-group-btn media_show"></span>        
                                                            </div>
                                                        </div>
                     
    					
    		                                        </tbody>
                                                </table>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
    <!-- Contact card start -->
                            
                    </div>
        
                                         <!-- end of view-info /////////////////////-->
                                    </div>
                                </div>
                            </div> 
                            
                            
                            <div class="tab-pane fade " id="tab8" role="tabpane">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">  Online User Chat </h5>
                                    </div>
    
                                    <div class="card-block">
                                        <!-- end of view-info -->
                                        <style>
    .chat-body {
        overflow-y: auto;
        height: auto;
    }
     .pull-right {
        float: right !important;
    }
    .pull-left {
        float: left!important;
    }
    .chat
    {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    
    .chat li
    {
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px dotted #B3A9A9;
    }
    
    .chat li.left .chat-body
    {
        margin-left: 60px;
     
        margin-bottom: 25px;
        margin-top: 15px;
    }
    
    .chat li.right .chat-body
    {
       margin-left: 60px;
     
        margin-bottom: 25px;
        margin-top: 15px;
    }
    
    
    .chat li .chat-body p
    {
        margin: 0;
        color: #777777;
    }
    
    .panel .slidedown .glyphicon, .chat .glyphicon
    {
        margin-right: 5px;
    }
    
    .panel-body
    {
        overflow-y: scroll;
        height: 400px;
    	    padding: 15px;
        width: 100%;
    }
    
    ::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }
    
    ::-webkit-scrollbar
    {
        width: 12px;
        background-color: #F5F5F5;
    }
    
    ::-webkit-scrollbar-thumb
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }
    .panel-body {
        padding: 15px;
    }
    .panel-footer .input-group .form-control {
        position: relative;
        z-index: 2;
        float: left;
        width: 100%;
        margin-bottom: 0;
        height: 60px;
    }
    .panel-footer {
    padding: 10px 0px 10px 15px;
        background-color: #fafafa;
        border-top: 1px solid #eeeeee;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
        width: 50%;
    }
    button#btn-chat {
        height: 60px;
        background: #6f106c;
        border: 1px solid #6f106c;
        font-size: 14px;
        letter-spacing: 0.5px;
        font-weight: 500;
    }
    
    span.chat-img img {
        width: 50px;
        height: 50px;
    }
    span.chat-img .on-active {
        position: relative;
        right: 15px;
        bottom: 15px;
    		 color:green;
    }
    
    
    .chat li.left .chat-body ,
    .chat li.right .chat-body{
    
    }
     
     .on-active{
    	 color:green;
     }
    </style>
                             
                                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card col-lg-12">
                                    <div class="card-header">
                                        <h5 class="card-header-text">
                                            
                                            <?php  $userleval1 = $this->db->where('user_id',$this->uri->segment(3))->get('users')->row()->auth_level;?>
                                            <?php if($userleval1 == 6){ echo "Client List";}else { echo "Agent List";}?>
                                        </h5>
                                    </div>
                                    <div class="table">
                                        <?php 
                                            //$query = "select receiver_id from chats where sender_id=".$this->uri->segment(3)." group by receiver_id";
                                            //$list = $this->db->query($query)->result_array();
                                            //print_r($list);
                                        ?>
                                        
                                        <span class = "client_list">
                                         </span> 
                                        
                                    </div>
                                </div>    
                        
         
                            </div>
                     
                            <div class="col-xl-6">
                                <div class="card col-lg-12">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Conversion</h5>
                                    </div>
                                    <div class="table">
                                          <div class="table-content">
                                        <div class="project-table p-20">
                                            <table id="product-list-dasbord" class="table dt-responsive nowrap" width="100%" cellspacing="0">
                                                <tbody>
                <div class="panel-body">                 
		<ul class="chat" id="chatmsg1">			
												
			
									
		</ul>
		</div>	
		        <form id="insert_adds1"  role="form">
		            
                  <div class="panel-footer" style="width:448px;">
                      
                    <input type = "hidden" name = "data[receiver_id]" id = "receiver_id" >
                    <input type = "hidden" name = "data[category_id]" id = "category_id" >
                    <input type = "hidden" name = "data[sender_id]" id = "sender_id" value = "<?=$sender_id?>">
                      
                    <div class="input-group" style = "margin-bottom: 5px;">
                        <div class="col-lg-2">
                            <strong>Upload</strong>
                        </div>
                        <div class="col-lg-7">
                            <span class="input-group-btn">
                                <input class="btn btn-info btn-sm" id = "file" type = "file" name = "chatFile">
                            </span>
                        </div>
                        <div class="col-lg-3">
                            <span class="input-group-btn media_show">
                               
                            </span>        
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <input id="msg_val" type="text"  name = "data[message]" class="form-control input-sm" placeholder="Type your message here... "style="width: 352px;" />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm insert_adds1"  style="margin-right: 295px;" id="btn-chat"  onclick = "return submitdata()">Send</button>
                        </span>
                    </div>
                    
                    </form>
                    
                    <div class="input-group" style = "margin-top: 5px;">
                        <div class="col-lg-2">
                            <span class="input-group-btn">
                           <!--     <button class="btn btn-success btn-sm fa fa-plus add_adds" data-name="<?php echo @$current_page; ?>" style="float: right;">Add Invoice</button></span>
                           --></span>
                        </div>
                        <div class="col-lg-7">
                        </div>
                        <div class="col-lg-3">
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm"  style="margin-right: 295px;"  id="btn-chat-end" onclick="return myFunction1()">End</button>
                            </span>        
                        </div>
                    </div>
                    
		        </div>
		        
		        
					
		</tbody>
                </table>
                </div>
                  </div>
    
                                    </div>
                                </div>
                            </div>
    <!-- Contact card start -->
                            
                    </div>
        
                                         <!-- end of view-info /////////////////////-->
                                    </div>
                                </div>
                            </div> 
                            
                    </div>
                    <!-- end of main tab content -->
                </div>
            </div>

        </div>

        <!-- Container-fluid ends -->
        <footer class="f-fix">
            <div class="footer-bg b-t-muted" style="text-align: center;"> Copyrights © 2018 Volivesolutions. All Rights Reserved.
            </div>
        </footer>
    </div>
 <!-- CONTENT-WRAPPER-->
 
 <script>
function myFunctionone(receiver_id,sender_id,category_id) 
{
    $('#receiver_id').val(receiver_id);
    $('#category_id').val(category_id);
    
    $('.media_show').html('<a class="btn btn-success btn-sm" style="background-color: #67626df0;" target = "_blank" href = "<?php echo base_url();?>admin/media/'+receiver_id+'">Media</a>');
    
    $.ajax({
        url:'<?php echo base_url();?>admin/agent_chat_view1',
        type:'POST',
        data: {sid:sender_id,rid:receiver_id},
        success: function(data)
        {
            //alert('hi');
            if(data != '')
            {
                $("#chatmsg1").html(data);
            }
            else
            {
                $("#chatmsg1").html('No Record Found');
            }
        }
    });
    
}
</script>
 
 
 <script type="text/javascript">
    $("#profile_update").validate({       
            rules: {
              "data[first_name]"    : "required",
              "data[gender]"        : "required",
              "data[mobile]"        : "required",
              
            
              
            },
            messages : {
              "data[first_name]"    : "Please Enter your name",
              "data[gender]"        : "Please select gender",
              "data[mobile]"        : "Please Enter your phone number",
            
            },     
    });
    $('.update_profile').on("click",function(event){ 
        event.preventDefault();
        var validator = $("#profile_update").validate();
            validator.form();
            if(validator.form() == true){
                
                var data = new FormData($('#profile_update')[0]);     
                $.ajax({                
                    url: "<?php echo base_url();?>/admin/profile_update",
                    type: "POST",
                    data: data,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData:false,
                    error:function(request,response){
                        console.log(request);
                    },                  
                    success: function(result){
                    var obj = jQuery.parseJSON(result);
                          if (obj.status == 'success') {
                           //alert(obj.message);
                            location.reload();                  
                          } else if (obj.status =='error') {
                            $.notify({
                                    title: '<strong>Hello!</strong>',
                                    message: obj.message
                                  },{
                                    type: 'warning'
                                  });
                          } else {
                            
                          }
                    }
                });
            }
        });


 $(".change_password").click(function(){
      var validator = $("#change_password").validate();
      validator.form();
      if(validator.form() == true)
      {
        
        if($('#password_length').val().length >= 6){
           $('#min_char').css('display','none');
           var data = new FormData($('#change_password')[0]);
           $.ajax({
            url: "<?php echo base_url()?>/admin/update_pwd",
            type: "POST",
            dataType: "html",
            mimeType: "multipart/form-data",
            data: data,
            contentType: false,
            cache: false,
            processData:false,
              success: function(result){
                var obj = jQuery.parseJSON(result);
                  if (obj.status == 'success') {
                   //alert(obj.message);
                    location.reload();                  
                  } else if (obj.status =='error') {
                    $.notify({
                            title: '<strong>Hello!</strong>',
                            message: obj.message
                          },{
                            type: 'warning'
                          });
                  } else {
                    
                  }
            }
     
          });
       
        }else{
            $('#min_char').html('Minimum 6 characters required !');
        }
        
      }
      else{
        $('.show_alert').css('display','block');
        $("body,html").animate({scrollTop: 0}, 'slow');
      }
    });



$("#change_password").validate({
      rules: {
          "data[old_pass]"          : "required",
          "data[new_pass]"          : "required",
          "data[confirm_pass]"      : {required:true,equalTo:'[name="data[new_pass]"]'}
        },
        messages : {
          "data[old_pass]"          : "Please Enter Old Password",
          "data[new_pass]"          : "Please Enter New Password",
          "data[confirm_pass]"      : "<p style='color:red;text-align:center;margin-top:10px;'>New Password and Confirm Password should be same !</p>"
        }
    });




$('.insert_adds1').click(function(){ 
       
        var receiver_id = $('#receiver_id').val(); 
        if(receiver_id)
        {
            if($('#msg_val').val() == '' && $('#file').val() == '')
            {
                alert('Please Insert Field ');
                return false; 
            }
            else if($('#msg_val').val() && $('#file').val())
            {
                alert('Please Insert only One input');
                return false; 
            }
            else
            {
                var data = new FormData($('#insert_adds1')[0]);
                $.ajax({                
                        url: "<?php echo base_url();?>admin/chat_message",
                        type: "POST",
                        data: data,
                        mimeType: "multipart/form-data",
                        contentType: false,
                        cache: false,
                        processData:false,
                        error:function(request,response){
                            console.log(request);
                            //return false;
                        },                  
                        success: function(data)
    					{
                        	//alert(data);
                        	console.log(data);
                        	document.getElementById("msg_val").value='';
                        	document.getElementById("file").value='';
                            if(data)
                            {
                               //document.getElementById("msg_val").value='';
                               $('#msg_val').val('');
                               
                        		$("#chatmsg").html(data);
                        
                                 var objDiv = $(".panel-body");
                            	 var h = objDiv.get(0).scrollHeight;
                            	 objDiv.animate({scrollTop: h});
                        
                            }      
                        	//location.reload();
                        	
                    	    return false;
                	   }
                      
                    });
            }
            
        }
        else
        {
            alert('Please Select Client');
        }
        
       return false;
    });

 </script>
<script>
        function myFunction1()
        {
            var id = '<?php echo $this->uri->segment(3); ?>';
            var receiver_id = $('#receiver_id').val();
            if(receiver_id){
                //return false;
                $("#chatmsg").html('');
            
                $.ajax({ 
                    url:'<?php echo base_url();?>/admin/end_chat',
            	    type:'POST',
            	    data: {id:id,receiver_id:receiver_id},
            	    success: function(data)
            	    {
                    	//alert(data);
                    	alert('Client Conversession End Successfully');
                    	console.log(data);
                	    location.reload();
            	    }
                  });
              
            }
            else
            {
                alert('Please Select Client');
            }
        }
    </script>



 <style type="text/css">
     .nav-tabs .slide {
   
    width: calc(100% / <?php  $userleval1 = $this->db->where('user_id',$this->uri->segment(3))->get('users')->row()->auth_level;?>
                            <?php if($userleval1 == 6){ echo 5;}else { echo 8;}?> );
}
.md-tabs .nav-item {
   
    width: calc(100% / <?php  $userleval1 = $this->db->where('user_id',$this->uri->segment(3))->get('users')->row()->auth_level;?>
                            <?php if($userleval1 == 6){ echo 5;}else { echo 8;}?>);
}
 .error{
   color:red;
   font-size: 13px;
    }
    li.nav-item.active {
    border-bottom: 3px solid #76b0ae;
}
label.error {
        color: red;
    top: -5px;
}
 </style>}
