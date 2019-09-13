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

<div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
        <div class="modal-header" style="border-bottom-color: #ccc;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" align="center">Add / Edit Event</h4>
        </div>
        <div class="modal-body">
            <form id="insert_adds">                         
                 <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Image</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="addimage" >
                    </div>
                </div>
                
                <?php if(@$value['id']!=''){ ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label form-control-label"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url().$value['image']?>" width="100px" height="100px" style="background-color:gray;" >
                    </div>
                </div>
                <?php } ?>

                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Title En</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="data[title_en]" value="<?php echo @$value['title_en']?>" placeholder="Enter Title in english" >
                    </div>
                    
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Title Ar</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="data[title_ar]" value="<?php echo @$value['title_ar']?>" placeholder="Enter Title in Arbic" >
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Form Date	</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="date" name="data[form_date]" value="<?php echo @$value['form_date']?>" placeholder="Enter Form Date" >
                    </div>
                    
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">To Date</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="date" name="data[to_date]" value="<?php echo @$value['to_date']?>" placeholder="Enter To Date" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Form Time</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="time" name="data[form_time]" value="<?php echo @$value['form_time']?>" placeholder="Enter Form Time" >
                    </div>
                    
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">To Time</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="time" name="data[to_time]" value="<?php echo @$value['to_time']?>" placeholder="Enter To Time" >
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Mobile</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="data[mobile]" value="<?php echo @$value['mobile']?>" placeholder="Enter Mobile" >
                    </div>
                    
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Cost</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="" name="data[cost]" value="<?php echo @$value['cost']?>" placeholder="Enter Cost" >
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">URL</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="data[url]" value="<?php echo @$value['url']?>" placeholder="Enter URL" >
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">App Background</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="color" name="data[color_code]" value="<?php echo @$value['color_code']?>" placeholder="Enter URL" style="height: 43px;">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Address</label>
                    <div class="col-sm-9">
                        <!--<input class="form-control" type="text" name="data[text_en]" value="<?php echo @$value['text_en']?>" placeholder="Enter Text" >-->
                        <textarea class="form-control" placeholder="Enter Text" name="data[address]"><?php echo @$value['address']?></textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Description En</label>
                    <div class="col-sm-9">
                        <!--<input class="form-control" type="text" name="data[text_en]" value="<?php echo @$value['text_en']?>" placeholder="Enter Text" >-->
                        <textarea class="form-control" placeholder="Enter Text" name="data[description_en]"><?php echo @$value['description_en']?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Description Ar</label>
                    <div class="col-sm-9">
                        <!--<input class="form-control" type="text" name="data[text_ar]" value="<?php echo @$value['text_ar']?>" placeholder="Enter Text in arabic" >-->
                        <textarea class="form-control" placeholder="Enter Text in arabic" name="data[description_ar]"><?php echo @$value['description_ar']?></textarea>
                        
                    </div>
                </div>

                <input type="hidden" name="old_image" value="<?php echo @$value['image']; ?>">
                <input type="hidden" name="data[id]" value="<?php echo @$id; ?>">    
                <input type="hidden" name="data[pname]" value="<?php echo @$pname; ?>">    
            </form> 
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary waves-effect waves-light insert_adds">Save changes</button>
        </div>
    </div>
</div>

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
                  console.log(data);
                $.ajax({                
                    url: "<?php echo base_url();?>admin/save_adds",
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
                        console.log(result);
                        var obj = jQuery.parseJSON(result);
                        if (obj.status == "success") 
                        {
                            location.reload();
                        } 
                    }
                });
           // }
           return false;
           
        });
   
    
</script>