<link rel="stylesheet" href="http://ericjgagnon.github.io/wickedpicker/wickedpicker/wickedpicker.min.css">
<style>
    #insert_suplier label.error {
        color:red; 
    }
    #insert_suplier input.error,textarea.error,select.error {
        border:1px solid red;
        color:red; 
    }
    .popover {
    z-index: 2000;
    position:relative;
    }    
</style>

<?php 
  if($this->uri->segment(3))
  {
     $value = $this->db->where('id',$this->uri->segment(3))->get('suppliers')->row_array();
    // print_r($value); exit;

  }

?>

<!-- CONTENT-WRAPPER-->
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
         <div class="container-fluid">
    <!-- Row Starts -->
    <div class="row">
      <div class="col-sm-12">
        <div class="main-header">
          <h4>Data table</h4>
          <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
            <li class="breadcrumb-item">
              <a href="#">
                <i class="icofont icofont-home"></i>
              </a>
            </li>
            <li class="breadcrumb-item"><a href="#:" >Add/Edit Supplier</a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h5 class="card-header-text">Add/Edit Supplier</h5><span>
              <!--<button class="btn btn-success fa fa-plus add_adds" data-name="<?php //echo @$current_page; ?>" style="margin-left:65%">Add </button>--></span>
          </div>
          
          <div class="card-block addform-block">
			<form id="insert_suplier" method="post" >
         <!-- Form Name -->
       	  <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
          

            <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Service Type:<span class="star">*</span></label>
            <div class="col-sm-9">
              <input class="form-control" type="text" name="data[service_type]" value="<?php echo @$value['service_type']?>" placeholder="Enter Service Type" >
              
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Supplier Code:<span class="star">*</span></label>
            <div class="col-sm-9">
               <input class="form-control" type="text" name="data[supplier_code]" value="<?php echo @$value['supplier_code']?>" placeholder="Enter Supplier code" >
            </div>
          </div> 

            <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Supplier Name:<span class="star">*</span></label>
             <div class="col-sm-9">
              <input class="form-control" type="text" name="data[supplier_name]" value="<?php echo @$value['supplier_name']?>" placeholder="Enter Supplier Name" >
            </div>
          </div>  


          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Supplier Group:<span class="star">*</span></label>
            <div class="col-sm-9">
              <input class="form-control" type="text" name="data[supplier_group]" value="<?php echo @$value['supplier_group']?>" placeholder="Enter Supplier Group " >
            </div>
          </div>          
          <!-- Text input-->
            <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">City:<span class="star">*</span></label>
            <div class="col-sm-9">
              <select class="form-control" name="data[city]">
                     <option>Select City</option>
                <?php 
                    $res = $this->db->get_where('city')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->city_name?>" <?php if($row->city_name == @$value['city']){ echo 'selected';}?>><?=$row->city_name?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
            </div>        
          
		  <!-- Text input-->

          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Country:<span class="star">*</span></label>
            <div class="col-sm-9">
               <select class="form-control" name="data[country]" >
                     <option>Select Country</option>
                <?php 
                   $res = $this->db->get_where('countries')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->name?>"  <?php if($row->name == @$value['country']){ echo 'selected';}?> ><?=$row->name?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
            </div>

            <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Contact Name:</label>
             <div class="col-sm-9">
              <input class="form-control" type="text" name="data[contact_name]" value="<?php echo @$value['contact_name']?>" placeholder="Enter Contact Name" >
            </div>
          </div> 

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Position:</label>
             <div class="col-sm-9">
              <input class="form-control" type="text" name="data[position]" value="<?php echo @$value['position']?>" placeholder="Enter Position" >
            </div>
          </div> 

		  <!-- Text input-->
         
          </div> 
          <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">

            <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Tele Phone:</label>
             <div class="col-sm-9">
              <input class="form-control" type="number" name="data[telephone]" value="<?php echo @$value['telephone']?>" placeholder="Enter Telephone" >
            </div>
          </div>              

           <?php if(@$suplier['id']!=''){ ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label form-control-label">Mobile:</label>
                    <div class="col-sm-9">
                         <input class="form-control" type="number" value="<?php echo @$value['mobile'];?>" placeholder="Enter Mobile">
                    </div>
                </div>
                <?php }else{ ?>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Mobile:</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="number" name="data[mobile]" value="<?php echo @$value['mobile']?>" placeholder="Enter Mobile" >
                        <span class ="mobile_error" style = "color:red"></span>
                    </div>
                </div>
                
                <?php } ?> 


                <?php if(@$suplier['id']!=''){ ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label form-control-label">Email:</label>
                    <div class="col-sm-9">
                         <input class="form-control" type="text"   value="<?php echo @$value['email'];?>" placeholder="Enter Email" disabled>
                    </div>
                </div>
                <?php }else{ ?>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Email:</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="data[email]" value="<?php echo @$value['email']?>" placeholder="Enter Email" >
                        <span class ="email_error" style = "color:red"></span>
                    </div>
                </div>
                <?php }?>

                <div class="form-group">
                  <label class="col-sm-3 control-label" for="textinput">Website:</label>
                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="data[website]" value="<?php echo @$value['website']?>" placeholder="Enter Website Address" >
                  </div>
                </div> 


               <!--  <?php //if(@$client['user_id']!=''){ ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label form-control-label">PassWord</label>
                    <div class="col-sm-9">
                         <input class="form-control" type="text" name="data[password]" value="<?php //echo base64_decode(@$client["password"]);?>" placeholder="Enter Mobile" >
                    </div>
                </div>
                <?php //} ?> -->

          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Address:</label>
            <div class="col-sm-9">
             <textarea class="form-control" type="text" name="data[address]" placeholder="Enter Address" ><?php echo @$value['address']?></textarea>              
            </div>
          </div>

           <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Remarks:</label>
            <div class="col-sm-9">
             <textarea class="form-control" type="text" name="data[remarks]" placeholder="Enter Remarks" ><?php echo @$value['remarks']?></textarea>              
            </div>
          </div>

          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Status:</label>
            <div class="col-sm-9">
             <select class="form-control" name="data[status]">
                <option value="1" <?php if(isset($value['status'])) { if($value['status'] == 1){ echo "selected";}} ?>>Active</option>
                <option value="0" <?php if(isset($value['status'])) { if($value['status'] == 0){ echo "selected";}} ?>>Inactive</option>
            </select>
            </div>
          </div>
        
        
          <div class="form-group text-center">
          <!--<button class="add-save btn btn-md">Save</button>-->
           <button  class="add-save btn btn-primary waves-effect waves-light insert_suplier">Save</button>
          </div>
          </div>  
          <div class="clearfix"></div>
          <div class="col-md-6"></div>    
          <div class="col-md-6 cost_box">
          </div>  
          
            <input type="hidden" name="data[id]" value="<?php echo $this->uri->segment(3);?>">    
            <input type="hidden" name="data[pname]" value="<?php echo $this->uri->segment(2); ?>">   
          
      </form>
          </div>
        </div>
      </div>
    </div>

  </div>
        <!-- Container-fluid ends -->
     </div>

   <script>     
      $("#insert_suplier").validate({       
            rules: {
               
                "data[service_type]"    : "required",
                "data[supplier_name]"   : "required",
                "data[supplier_code]"   : "required",
                "data[supplier_group]"  : "required",
                "data[city]"            : "required",
                "data[country]"         : "required"
                
            },
            messages : {
               //<?php //if($user_id=='') { ?>
                "addimage"                  : "",
                //<?php //} ?>

                //"data[user_name]"           : "required",
                //"data[email]"                : "required",
               // "data[mobile]"               : "required"              
            },      
    });
        $('.insert_suplier').click(function(){ 
          var validator = $("#insert_suplier").validate();
            validator.form();
            if(validator.form() == true){
            $('.insert_suplier').html("<img src='<?php echo base_url()?>assets/images/ajax-loaderr.gif' style='width:20px; height:15px;'>"); 
              var data = new FormData($('#insert_suplier')[0]);  
                $.ajax({                
                    url: "<?php echo base_url();?>admin/save_suplier",
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
                    success: function(result){
                        var obj = jQuery.parseJSON(result);
                        if (obj.status == "success") 
                        {
                       window.location.href="<?php echo base_url();?>admin/suplier";     
                      // console.log(odj.status);
                            //location.reload();
                        }
                        else if(obj.status == "error") 
                        {
                            if(obj.mobile == "mobile")
                            {
                                 $('.mobile_error').html(obj.message);
                                 $('.insert_suplier').html('Save');
                            }
                            else
                            {
                                $('.mobile_error').html('');
                            }
                            
                            if(obj.email == "email")
                            {
                                $('.email_error').html(obj.message);
                                 $('.insert_suplier').html('Save');
                            }
                            else
                            {
                                $('.email_error').html('');
                            }
                        }
                    }
                  
                });
            }
            return false;
        });
                      
    </script>  


    <script>
    function supplier_name(val)
    {
      //alert(val);
         $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url();?>admin/get_supplier_id',
                  data: {'supplier_name':val},
                  success: function (data) 
                  {
                        //alert(data);
                        $('#get_supplier_code').html(data);
                  }
        });
    }
</script>

<script>
    function supplier_code(val)
    {
         $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url();?>admin/get_name',
                  data: {'id':val},
                  success: function (data) 
                  {
                        //alert(data);
                        $('#get_supplier_name').html(data);
                  }
        });
    }
</script>
  
 <script src="http://volive.in/joher/assets/admin/js/wickedpicker.js"></script>
 <script>
	$('.timepicker,.timepicker2').wickedpicker();
	</script>