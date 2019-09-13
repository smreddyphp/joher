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
            <h4 class="modal-title" align="center">Add / Edit Add Order</h4>
        </div>
        <div class="modal-body">
            <form id="insert_adds">                         
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Select Client</label>
                    <div class="col-sm-10">
                        <!--<input class="form-control" type="text" name="data[category_name]" value="<?php echo @$value['category_name']?>" placeholder="Enter Category" >-->
                        <select class="form-control" name="data[user_id]">
                            <option>Select Client Email</option>
                            <?php
                                $record1 = $this->db->where('auth_level',1)->get('users')->result_array();
                                foreach($record1 as $row)
                                { ?>
                                        <option value = "<?=$row['user_id']?>" <?php if($row['user_id']==@$value['user_id']){ echo 'selected';} ?>><?=$row['email']?></option>
                            <?php    }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Select Category</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="data[category_id]">
                            <option>Select Category</option>
                            <?php
                                $record = $this->db->where('user_id',$this->session->userdata('user_id'))->get('users')->row_array();
                                print_r($record['category_id']);
                                
                                @$c=unserialize(@$record['category_id']);
                                $count=0; 
                                foreach($c as $row)
                                {
                                    $category_name = $this->db->where('id',$c[$count])->get('category_adds')->row()->category_name;
                                    ?>
                                            <option value = "<?=$c[$count]?>" <?php if($c[$count]==@$value['category_id']){ echo 'selected';} ?> ><?=$category_name?></option>
                                    <?php 
                                    $count++;
                                }
                            ?>
                            
                        </select>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Service Price</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="data[service_price]" value="<?php echo @$value['service_price']?>" placeholder="Enter Service Price" >
                    </div>
                    
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Sub Total</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="data[sub_total]" value="<?php echo @$value['sub_total']?>" id = "subtotal" placeholder="Enter Sub Total">
                    </div>
                    
                </div>

               
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Discount</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="data[discount]" value="<?php echo @$value['discount']?>" placeholder="Enter Discount" onkeyup ="discount(this.value)">
                    </div>
                    
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Total</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="data[total]" value="<?php echo @$value['total']?>" placeholder="Enter Total" id = "total">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Issue Date</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="date" name="data[issue_date]" value="<?php echo @$value['issue_date']?>" placeholder="Enter Discount" >
                    </div>
                    
                    <label for="example-tel-input" class="col-xs-2 col-form-label form-control-label">Due Date</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="date" name="data[due_date]" value="<?php echo @$value['due_date']?>" placeholder="Enter Total" >
                    </div>
                </div>
            
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Description en</label>
                    <div class="col-sm-9">
                        <!--<input class="form-control" type="text" name="data[text_ar]" value="<?php echo @$value['text_ar']?>" placeholder="Enter Text in arabic" >-->
                        <textarea class="form-control" placeholder="Enter Text in english" name="data[description_en]" style="height: 100px;"><?php echo @$value['description_en']?></textarea>
                     </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Description ar</label>
                    <div class="col-sm-9">
                        <!--<input class="form-control" type="text" name="data[text_ar]" value="<?php echo @$value['text_ar']?>" placeholder="Enter Text in arabic" >-->
                        <textarea class="form-control" placeholder="Enter Text in arabic" name="data[description_ar]" style="height: 100px;"><?php echo @$value['description_ar']?></textarea>
                     </div>
                </div>
              
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
 
    function discount(value)
    {   
        var subtotal = $('#subtotal').val();
        console.log(subtotal);
        console.log(value);
        var discount = subtotal*value/100;
        var total = subtotal - discount;
        console.log(total);
        $('#total').val(total);
    }
 
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
                    url: "<?php echo base_url();?>admin/save_agent_data",
                    type: "POST",
                    data: data,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData:false,
                    error:function(request,response){
                        console.log(request);
                    },                  
                    success: function(result)
                    {
                        var obj = jQuery.parseJSON(result);
                        if (obj.status == "success") 
                        {
                            location.reload();
                        } 
                    }
                });
          //  }
          return false;
          
        });
   
    
</script>