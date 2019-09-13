<link rel="stylesheet" href="http://ericjgagnon.github.io/wickedpicker/wickedpicker/wickedpicker.min.css">

    
<style>
.addform-block .cost-list {
   
    display: flex;
}
</style>
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
            <li class="breadcrumb-item"><a href="#:" >Add/Edit Services</a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h5 class="card-header-text">Add/Edit Services</h5><span>
              <!--<button class="btn btn-success fa fa-plus add_adds" data-name="<?php echo @$current_page; ?>" style="margin-left:65%">Add </button>--></span>
          </div>
          
          <div class="card-block addform-block">
			<form id="insert_adds" class="form-horizontal" role="form">
         <!-- Form Name -->
       	  <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
          <!-- Text input-->
         <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Service Type<span class="star">*</span></label>
            <div class="col-sm-9">
              <select name="data[room_type]" id="" class="form-control">
              <option value="Deluxe">Aircraft</option>
              <option value="AC">train</option>
         
              </select>
            </div>
          </div>
          
          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Supplier Code<span class="star">*</span></label>
            <div class="col-sm-9">
              <input type="text" placeholder=""  name="data[supplier_code]"  class="form-control">
            </div>
          </div>
          
          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Supplier Name<span class="star">*</span></label>
            <div class="col-sm-9">
              <input type="text" placeholder="" name="data[supplier_name]"  class="form-control">
            </div>
          </div>
          
		  <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Guest Name<span class="star">*</span></label>
            <div class="col-sm-9">
              <input type="text" placeholder="" name="data[guest_name]"  class="form-control">
            </div>
 			</div>
            <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Location<span class="star">*</span></label>
            <div class="col-sm-9">
              <input type="text" placeholder="" name="data[location]"  class="form-control">
            </div>
 			</div>
 		
          
		  <!-- Text input-->
        <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Status<span class="star">*</span></label>
            <div class="col-sm-9">
              <select name="data[room_type]" id="" class="form-control">
              <option value="Deluxe">Active</option>
              <option value="AC">In Active</option>
         
              </select>
            </div>
          </div>
          
         
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Service Description<span class="star">*</span></label>
            <div class="col-sm-9">
              <textarea name="data[room_desc]" id="" cols="30" rows="3" class="form-control"></textarea>
            </div>
          </div>
        
          </div> 
          <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
              
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">From<span class="star">*</span></label>
            <div class="col-sm-9">
            <input type="date" name="data[form]"  class="form-control">
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">To<span class="star">*</span></label>
            <div class="col-sm-9">
            <input type="date" name="data[to]"  class="form-control">
              </select>
            </div>
          </div>
       
         

          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">VAt</label>
            <div class="col-sm-3">
          <select name="data[room_type]" id="" class="form-control">
              <option value="Deluxe">Active</option>
              <option value="AC">In Active</option>
         
              </select>
            </div>
            <div class="col-md-1 commison">
            <span>%</span>
            </div>
            <div class="col-sm-3">
            <input type="text" name="data[vat_amnt]"  class=" form-control">
              </select>
            </div>            
             <label class="col-sm-2 control-label text-center" for="textinput">AMNT</label>
            </div>
          
            </div>
          </div>
       
          
          
          
          <ul class="list-unstyled cost-list">
          <li>Net Cost</li>
          <li>Sale Cost</li>
          </ul>
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">Markup</label>
            <div class="col-sm-4">
            <input type="text" name="data[markup_net_cost]" class="form-control">
             </div>
            
            <div class="col-sm-4">
            <input type="text" name="data[markup_net_sale]" class="form-control" >
            </div>            
             
            </div>
          
            </div>
          </div>
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">Cost In Sar</label>
            <div class="col-sm-4">
            <input type="text" name="data[cost_in_sar_net_cost]" class="form-control" >
             </div>
            
            <div class="col-sm-4">
            <input type="text" name="data[cost_in_sar_net_csale]" class="form-control" >
            </div>            
             
            </div>
          
            </div>
          </div>
             <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Urgency Level<span class="star">*</span></label>
            <div class="col-sm-9">
              <select name="data[room_type]" id="" class="form-control">
              <option value="Deluxe">Emergency</option>
              <option value="AC">urgent</option>
              <option value="AC">Normal</option>
         
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Note<span class="star">*</span></label>
            <div class="col-sm-9">
              <textarea name="data[note]" id="" cols="30" rows="5" class="form-control"></textarea>
            </div>
          </div>
          <div class="form-group text-center">
          <!--<button class="add-save btn btn-md">Save</button>-->
           <button  class="add-save btn btn-primary waves-effect waves-light insert_adds">Save</button>
          </div>
          </div>  
          <div class="clearfix"></div>
          <div class="col-md-6"></div>    
          <div class="col-md-6 cost_box">
          </div>  
          
            <input type="hidden" name="data[id]" value="<?=@$adds['id']?>">    
            <input type="hidden" name="data[pname]" value="<?php echo $this->uri->segment(2); ?>">   
          
      </form>
          </div>
        </div>
      </div>
    </div>

  </div>
        <!-- Container-fluid ends -->
        
     </div>
     
 <!-- CONTENT-WRAPPER-->
  <!--<section>
    <div class = "modal fade" data-backdrop="static" data-keyboard="false" id = "add_adds" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true"></div>
    </section>-->
   <script>     
        $(document).ready(function(){
           
        });
        
        
       /* var $modal = $('#add_adds');
        $('.add_adds').on('click',function(event){ 
          
            var id = $(this).data('id');
            var pname = $(this).data('name');
            console.log(id);
            console.log(pname);
            event.stopPropagation();
            $modal.load('<?php echo site_url('admin/add_Category');?>', {id: id,pname:pname},
            function(){
            /*$('.modal').replaceWith('');*/
            //$modal.modal('show');

           // });
       // });*/
        
        $('.insert_adds').click(function(){ 
        //alert('hi');
        //var validator = $("#insert_adds").validate();
            //validator.form();
            //if(validator.form() == true){
                 $('.insert_adds').html("<img src='<?php echo base_url()?>assets/images/ajax-loaderr.gif' style='width:20px; height:15px;'>"); 
                  var data = new FormData($('#insert_adds')[0]);   
                  
                 // console.log(data);
                  
                $.ajax({                
                    url: "<?php echo base_url();?>admin/save_crms",
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
                        console.log(result);
                        var obj = jQuery.parseJSON(result);
                        if (obj.status == "success") 
                        {
                            window.location = '<?php echo base_url('admin/hotel');?>';
                            //location.reload();
                            //return false;
                        } 
                    }
                  
                });
            //}
             return false;
            
        });
        
        
        //delete 
        $('.delete_team_mem').on('click',function(event){ 
          
            var id = $(this).data('id');
              $.ajax({                
                    url: "<?php echo base_url();?>admin/delete_data/event_team",
                    type: "POST",
                    data: {id:id},
                    error:function(request,response){
                        console.log(request);
                    },                  
                    success: function(result){
                        var res = jQuery.parseJSON(result);
                        if(res.status='success'){
                            $("#hide"+id).hide();
                        }
                        
                    }
              });
        });               
    </script>
 <script src="http://volive.in/joher/assets/admin/js/wickedpicker.js"></script>
 <script>
	$('.timepicker,.timepicker2').wickedpicker();
	</script>