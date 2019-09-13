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
            <h4 class="modal-title" align="center">Add / Edit Documents </h4>
        </div>
        <div class="modal-body">
            <form id="insert_adds" method="post">                         
                <?php //print_r($value);?>
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Image</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="file" name="addimage" >
                    </div>
                </div>
               
                <?php if(@$id){ ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label form-control-label"></label>
                    <div class="col-sm-9">
            <?php   @$imageFileType = strtolower(pathinfo(basename(@$value['image']),PATHINFO_EXTENSION));//
            $imageFileType = ($imageFileType =='pdf' || $imageFileType == 'xlsx' || $imageFileType == 'docx')?$value['image']:'<img src="'. base_url().@$value['image'].'" width="100px" height="100px" style="background-color:gray;" >';
            ?>
                        <?=$imageFileType?>
                    </div>
                </div>
                <?php } ?>

                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Add File Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="data[file_name]" value="<?php echo @$value['file_name']?>" placeholder="Enter Class" >
                    </div>
                </div>

                <input type="hidden" name="data[type]" value="<?php echo $doc; ?>">    
                <input type="hidden" name="data[user_id]" value="<?php echo $user_id; ?>">    
                <input type="hidden" name="data[id]" value="<?php echo @$id; ?>">    
                <input type="hidden" name="data[pname]" value="<?php echo @$pname; ?>">    
                <input type="hidden"  name="old_image" value="<?php echo @$value['image']; ?>">
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
          // validator.form();
            //if(validator.form() == true){
                 $('.insert_adds').html("<img src='<?php echo base_url()?>assets/images/ajax-loaderr.gif' style='width:20px; height:15px;'>"); 
                  var data = new FormData($('#insert_adds')[0]);   
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