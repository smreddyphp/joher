<style>
    #insert_adds label.error {
        color:red; 
    }
    #insert_adds input.error,textarea.error,select.error {
        border:1px solid red;
        color:red; 
    }
    .popover {
    z-index: 2000;
    position:relative;
    }
    
</style>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(document).ready(function(){
      //Chosen
      $(".limitedNumbChosen").chosen({       
        placeholder_text_multiple: "Select Category here"
    })
}); 
</script>
<div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
        <div class="modal-header" style="border-bottom-color: #ccc;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" align="center">Add / Edit Users</h4>
        </div>
        <div class="modal-body">
            <form id="insert_adds">                  
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Image</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="file" name="addimage" >
                    </div>
                </div>

                <?php 
              // print_r($user); exit;
                if(@$value['user_id']!=''){ ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label form-control-label"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url().$value['image']?>" width="100px" height="100px" style="background-color:gray;" >
                    </div>
                </div>
                <?php } ?>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="data[user_name]" value="<?php echo @$value['user_name']?>" placeholder="Enter Name" >
                    </div>
                </div>
                
                <?php if(@$user['user_id']!=''){ ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label form-control-label">Email</label>
                    <div class="col-sm-9">
                         <input class="form-control" type="text" value="<?php echo @$value["email"];?>" placeholder="Enter Mobile" disabled>
                    </div>
                </div>
                <?php }else{ ?>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Email</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="data[email]" value="<?php echo @$value['email']?>" placeholder="Enter Email" >
                        <span class ="email_error" style = "color:red"></span>
                    </div>
                </div>
                <?php }?>
                
                <?php if(@$user['user_id']!=''){ ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label form-control-label">Mobile</label>
                    <div class="col-sm-9">
                         <input class="form-control" type="text" value="<?php echo @$value["mobile"];?>" placeholder="Enter Mobile" disabled>
                    </div>
                </div>
                <?php }else{ ?>
               
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Mobile</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="data[mobile]" value="<?php echo @$value['mobile']?>" placeholder="Enter Mobile" >
                        <span class ="mobile_error" style = "color:red"></span>
                    </div>
                </div>
                
                <?php } ?>
               
                <?php if(@$value['user_id']!=''){ ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label form-control-label">PassWord</label>
                    <div class="col-sm-9">
                         <input class="form-control" type="text" name="data[password]" value="<?php echo base64_decode(@$value["password"]);?>" placeholder="Enter Mobile" >
                    </div>
                </div>
                <?php } ?>               
                
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Status</label>
                    <div class="col-sm-9">
                        <!--<input class="form-control" type="text" name="data[mobile]" value="<?php echo @$value['mobile']?>" placeholder="Enter Mobile" >-->
                        <select class="form-control" name="data[status]">
                            <option value = "active" <?php if(@$value["status"] == 'active'){ echo "selected"; } ?>>active</option>
                            <option value = "in-active" <?php if(@$value["status"] == 'in-active'){ echo "selected"; } ?> >in-active</option>
                        </select>
                    </div>
                </div>

              <div class="form-group row">
                <?php
                    $permissions_list='';
                    //echo @$value['user_id'];
                    @$permissions = $this->db->get_where('permissions',array('user_id'=>$value['user_id']))->result_array();
                    //echo $this->db->last_query();
                    //echo "<pre>";//permissions

                
                    //print_r($permissions);
                    $permissions_list = array();
                    if(@$permissions)
                    {
                        foreach($permissions as $row)
                        {
                            $permissions_list[] = $row['type'];
                        }
                    }
                    //print_r($permissions_list); 
                ?>
                
                <div class="row clearfix">
                    <div class="col-md-12">
                      <div class="checkbox">
                        <input id="terms" type="checkbox" checked>
                        <label for="terms">Services </label>
                    </div>
                </div>
                <div class="col-md-12 check-options"> <?php 
                       //if(@$permission[0]['type'] == 1){echo 'checked';}else{echo '';}

                      //echo (@$permissions[0]['type'])?((in_array(1, $permissions_list))?'checked':''):'checked' ?>
                  <div class="col-lg-3 col-md-6 col-6 pull-left">
                    <label class="i-checks">
                      <input type="checkbox" name="type[]" id="checkbox[]"   value="1"  <?php  if(in_array(1, $permissions_list)){ echo "checked"; }else{ echo '';} ?> >
                      <i></i> Category Management</label>
                  </div>
                  <div class="col-lg-3 col-md-6 col-6 pull-left">
                    <label class="i-checks">
                      <input type="checkbox" name="type[]" id="checkbox[]"   value="2"  <?php  if(in_array(2, $permissions_list)){ echo "checked"; }else{ echo '';} ?> >
                      <i></i>Client Management</label>
                  </div>
                  <div class="col-lg-3 col-md-6 col-6 pull-left">
                    <label class="i-checks">
                      <input type="checkbox" name="type[]" id="checkbox[]"   value="3" <?php  if(in_array(3, $permissions_list)){ echo "checked"; }else{ echo '';} ?> >
                      <i></i>Event Management</label>
                  </div>
                  <div class="col-lg-3 col-md-6 col-6 pull-left">
                    <label class="i-checks">
                      <?php echo @$permission[3]['type']?>
                      <input type="checkbox" name="type[]" id="checkbox[]"   value="4" <?php  if(in_array(4, $permissions_list)){ echo "checked"; }else{ echo '';} ?> >
                      <i></i> Wallet Management</label>
                  </div>
                  <div class="col-lg-3 col-md-6 col-6 pull-left">
                    <label class="i-checks">
                      <input type="checkbox" name="type[]" id="checkbox[]"   value="5" <?php  if(in_array(5, $permissions_list)){ echo "checked"; }else{ echo '';} ?> >
                      <i></i> Order management </label>
                  </div>
                  <div class="col-lg-3 col-md-6 col-6 pull-left">
                    <label class="i-checks">
                      <input type="checkbox" name="type[]" id="checkbox[]"   value="6" <?php  if(in_array(6, $permissions_list)){ echo "checked"; }else{ echo '';} ?> >
                      <i></i> Agent Management</label>
                  </div>
              <div class="col-lg-3 col-md-6 col-6 pull-left">
                <label class="i-checks">
                  <input type="checkbox" name="type[]" id="checkbox[]"   value="7"      <?php  if(in_array(7, $permissions_list)){ echo "checked"; }else{ echo '';} ?> >
                  <i></i> Request Call </label>
              </div>
              <div class="col-lg-3 col-md-6 col-6 pull-left">
                <label class="i-checks">
                  <input type="checkbox" name="type[]" id="checkbox[]"   value="8"      <?php  if(in_array(8, $permissions_list)){ echo "checked"; }else{ echo '';} ?> >
                  <i></i> Term and Condition </label>
              </div>
              <div class="col-lg-3 col-md-6 col-6 pull-left">
                <label class="i-checks">
                  <input type="checkbox" name="type[]" id="checkbox[]"   value="9"      <?php  if(in_array(9, $permissions_list)){ echo "checked"; }else{ echo '';} ?> >
                  <i></i> About Us </label>
              </div>
              <div class="col-lg-3 col-md-6 col-6 pull-left">
                <label class="i-checks">
                  <input type="checkbox" name="type[]" id="checkbox[]"   value="10"     <?php  if(in_array(10, $permissions_list)){ echo "checked"; }else{ echo '';} ?> >
                  <i></i> Contact Us </label>
                </div>
                <div class="col-lg-3 col-md-6 col-6 pull-left">
                <label class="i-checks">
                  <input type="checkbox" name="type[]" id="checkbox[]"   value="11"     <?php  if(in_array(11, $permissions_list)){ echo "checked"; }else{ echo '';} ?>  >
                  <i></i> Privacy Policy </label>
                </div>
                <div class="col-lg-3 col-md-6 col-6 pull-left">
                <label class="i-checks">
                  <input type="checkbox" name="type[]" id="checkbox[]"   value="12"     <?php  if(in_array(12, $permissions_list)){ echo "checked"; }else{ echo '';} ?>  >
                  <i></i> User Management</label>
                </div>
                <div class="col-lg-3 col-md-6 col-6 pull-left">
                <label class="i-checks">
                  <input type="checkbox" name="type[]" id="checkbox[]"   value="13"     <?php  if(in_array(13, $permissions_list)){ echo "checked"; }else{ echo '';} ?>  >
                  <i></i><strong>CRMS</strong></label>
                </div>
                
                
              </div>
          </div>
        </div>



                <input type="hidden" name="old_image" value="<?php echo @$value['image']; ?>">
                <input type="hidden" name="data[user_id]" value="<?php echo @$value["user_id"]; ?>">    
                <input type="hidden" name="data[pname]" value="<?php echo @$pname; ?>">    
            </form> 
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary waves-effect waves-light insert_adds">Save changes</button>
        </div>
    </div>
</div>

<script>
function myFunction(val) 
{
  if(val == 'all')
  {
      $('#category').hide();
  }
  else
  {
      $('#category').show();
  }
}
</script>
<script src="<?php echo base_url();?>assets/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script>

$("#insert_adds").validate({       
           rules: {
                <?php if($id=='') { ?>
                "addimage"           : "required",
                <?php } ?>
                "data[user_name]"   : "required",
                "data[email]"       : "required",
                "data[mobile]"      : "required"
               
            },
            messages : {
                <?php //if($id=='') { ?>
               // "addimage"        : "Upload Image",
                <?php //} ?>
                //"data[heading_en]"   : "",
                //"data[heading_ar]"   : "",
                //"data[text_en]"      : "",
                //"data[text_ar]"      : ""
            },      
    });
    
    $('.insert_adds').click(function(){ 
    
        var validator = $("#insert_adds").validate();
            validator.form();
            if(validator.form() == true){
                 $('.insert_adds').html("<img src='<?php echo base_url()?>assets/images/ajax-loaderr.gif' style='width:20px; height:15px;'>"); 
                  var data = new FormData($('#insert_adds')[0]);   
                $.ajax({                
                    url: "<?php echo base_url();?>admin/save_users",
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
                      //console.log(result);
                        var obj = jQuery.parseJSON(result);
                        if (obj.status == "success") 
                        {
                            location.reload();
                        }
                        else if(obj.status == "error") 
                        {
                            if(obj.mobile == "mobile")
                            {
                                 $('.mobile_error').html(obj.message);
                                 $('.insert_adds').html('Save changes');
                            }
                            else
                            {
                                $('.mobile_error').html('');
                            }
                            
                            if(obj.email == "email")
                            {
                                $('.email_error').html(obj.message);
                                 $('.insert_adds').html('Save changes');
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
 <script src="<?php echo base_url();?>assets/admin/js/wickedpicker.js"></script>
 <script>
    $('.timepicker,.timepicker2').wickedpicker();
    </script>
