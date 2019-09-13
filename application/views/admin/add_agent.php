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
            <h4 class="modal-title" align="center">Add / Edit Agent</h4>
        </div>
        <div class="modal-body">
            <form id="insert_adds">                         
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Select Category</label>
                    <div class="col-sm-9">
                        <select class="form-control chosen-select" name="data[category_id][]" multiple="true" style = "overflow: scroll;">
                                    <?php 
                                    $c='';
                                    @$c=unserialize(@$value['category_id']);
                                    $record = $this->db->select('id,category_name')->get('category_adds')->result_array();
                                    //print_r($record);
                                    if($record)
                                    {
                                        $count=0;
                                        foreach($record as $row)
                                        { 
                                            if($row['id'] == $c[$count])
                                    	   {
                                    		  echo '<option value="'.$row['id'].'" selected >'.$row['category_name'].'</option>';
                                    	   }
                                    	   else
                                    	   {
                                    		   echo '<option value="'.$row['id'].'">'.$row['category_name'].'</option>';
                                    	   }
                            $count++; }  } ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Image</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="file" name="addimage" >
                    </div>
                </div>

                <?php if(@$value['user_id']!=''){ ?>
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
                
                <?php if(@$value['user_id']!=''){ ?>
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
                
                <?php if(@$value['user_id']!=''){ ?>
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
                
                <?php 
                    @$working_day=unserialize(@$value['working_day']);
                   // print_r($working_day);
                   // echo $working_day[0];
     
                ?>
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Form Day</label>
                    <div class="col-sm-1">
                       <input class="form-control" type="checkbox" name="working_day[]" value="0" placeholder="Enter Mobile" style="margin-left: 18px;" <?php if(@$working_day){ if(in_array(0, @$working_day)){ echo "checked";} } ?>> 
                       <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Mon</label>
                    </div>
                    <div class="col-sm-1">
                       <input class="form-control" type="checkbox" name="working_day[]" value="1" placeholder="Enter Mobile" style="margin-left: 18px;" <?php if(@$working_day){ if(in_array(1, @$working_day)){ echo "checked";} }?>> 
                       <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Tue</label>
                    </div>
                    <div class="col-sm-1">
                       <input class="form-control" type="checkbox" name="working_day[]" value="2" placeholder="Enter Mobile" style="margin-left: 18px;" <?php if(@$working_day){ if(in_array(2, @$working_day)){ echo "checked";} }?>> 
                       <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Wed</label>
                    </div>
                    <div class="col-sm-1">
                       <input class="form-control" type="checkbox" name="working_day[]" value="3" placeholder="Enter Mobile" style="margin-left: 18px;" <?php if(@$working_day){ if(in_array(3, @$working_day)){ echo "checked";} } ?>> 
                       <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Thu</label>
                    </div>
                    <div class="col-sm-1">
                       <input class="form-control" type="checkbox" name="working_day[]" value="4" placeholder="Enter Mobile" style="margin-left: 18px;" <?php if(@$working_day){ if(in_array(4, @$working_day)){ echo "checked";} } ?>> 
                       <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Fri</label>
                    </div>
                    <div class="col-sm-1">
                       <input class="form-control" type="checkbox" name="working_day[]" value="5" placeholder="Enter Mobile" style="margin-left: 18px;" <?php if(@$working_day){ if(in_array(5, @$working_day)){ echo "checked";} } ?>> 
                       <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Sat</label>
                    </div>
                     <div class="col-sm-1">
                       <input class="form-control" type="checkbox" name="working_day[]" value="6" placeholder="Enter Mobile" style="margin-left: 18px;" <?php if(@$working_day){ if(in_array(6, @$working_day)){ echo "checked";} } ?>> 
                       <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Sun</label>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Working Hours</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="data[form_hours]" value="<?php echo @$value['form_hours']?>" placeholder="HH:MM AM" >
                    </div>
                    
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">To Time</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="data[to_hours]" value="<?php echo @$value['to_hours']?>" placeholder="HH:MM AM" >
                    </div>
                
                 </div>
                 <div class="form-group row"><div class = "col-sm-12"><span class ="mobile_error" style = "color:red" style="text-align:center">* PLease Enter 24 Hours Beetween Time</span></div></div>
                
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

<script>

$("#insert_adds").validate({       
            rules: {
                <?php if($id=='') { ?>
                "addimage"        : "required",
                <?php } ?>
                "data[heading_en]"   : "required",
                "data[heading_ar]"   : "required",
                "data[text_en]"      : "required",
                "data[text_ar]"      : "required"
            },
            messages : {
                <?php if($id=='') { ?>
                "addimage"        : "Upload Image",
                <?php } ?>
                "data[heading_en]"   : "",
                "data[heading_ar]"   : "",
                "data[text_en]"      : "",
                "data[text_ar]"      : ""
            },      
    });
    
    $('.insert_adds').click(function(){ 
    
        //var validator = $("#insert_adds").validate();
            //validator.form();
            //if(validator.form() == true){
                 $('.insert_adds').html("<img src='<?php echo base_url()?>assets/images/ajax-loaderr.gif' style='width:20px; height:15px;'>"); 
                  var data = new FormData($('#insert_adds')[0]);   
                $.ajax({                
                    url: "<?php echo base_url();?>admin/save_agent",
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
            //}
            return false;
        });
    
</script>
 <script src="<?php echo base_url();?>assets/admin/js/wickedpicker.js"></script>
 <script>
	$('.timepicker,.timepicker2').wickedpicker();
	</script>
