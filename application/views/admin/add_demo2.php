<link rel="stylesheet" href="http://ericjgagnon.github.io/wickedpicker/wickedpicker/wickedpicker.min.css">
    
<style>
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
            <li class="breadcrumb-item"><a href="#:" >Add/Edit <?php echo @$page_name; ?></a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h5 class="card-header-text">Add/Edit <?php echo @$page_name; ?></h5><span>
              <!--<button class="btn btn-success fa fa-plus add_adds" data-name="<?php echo @$current_page; ?>" style="margin-left:65%">Add </button>--></span>
          </div>
          
          <div class="card-block addform-block">
			<form id="insert_adds" class="form-horizontal" role="form">
         <!-- Form Name -->
       	  <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Service Type <span class="star">*</span></label>
            <div class="col-sm-9">
                
              <select name="data[service_type]" id="" class="form-control">
                  <?php 
                    if(@$adds['service_type'])
                    { ?>
                     <option value = "<?php echo @$adds['service_type']?>"><?=@$adds['service_type']?></option>      
                <?php }
                  ?>
              <option value="Hotel">Hotel</option>
              <option value="Resturant">Resturant</option>
              <option value="">Service Three</option>
              </select>
            </div>
          </div>
          
          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Supplier Code<span class="star">*</span></label>
            <div class="col-sm-9">
              <input type="text" placeholder=""  name="data[supplier_code]" value="<?=@$adds['supplier_code']?>" class="form-control">
            </div>
          </div>
          
          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Supplier Name<span class="star">*</span></label>
            <div class="col-sm-9">
              <input type="text" placeholder="" name="data[supplier_name]" value="<?=@$adds['supplier_name']?>" class="form-control">
            </div>
          </div>
          
		  <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Guest Name<span class="star">*</span></label>
            <div class="col-sm-9">
              <input type="text" placeholder="" name="data[guest_name]" value="<?=@$adds['guest_name']?>" class="form-control">
            </div>
 			</div>
            <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Location<span class="star">*</span></label>
            <div class="col-sm-9">
              <input type="text" placeholder="" name="data[location]" value="<?=@$adds['location']?>" class="form-control">
            </div>
 			</div>
 			<div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Confirmation No<span class="star">*</span></label>
            <div class="col-sm-9">
              <input type="text" placeholder="" name="data[confirmation_no]" value="<?=@$adds['confirmation_no']?>" class="form-control">
            </div>
          </div>
          
		  <!-- Text input-->
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Payment Method<span class="star">*</span></label>
            <div class="col-sm-9">
              <select  name="data[payment_method]" id=""  class="form-control">
                <?php 
                    if(@$adds['payment_method'])
                    { ?>
                     <option value = "<?php echo @$adds['payment_method']?>"><?=@$adds['payment_method']?></option>      
                <?php }
                  ?>
              <option value="">Online</option>
              <option value="">Credit Card</option>
              <option value="">Debit Card</option>
              </select>
            </div>
          </div> 
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Room Type<span class="star">*</span></label>
            <div class="col-sm-9">
              <select name="data[room_type]" id="" class="form-control">
              <option value="Deluxe">Deluxe</option>
              <option value="AC">AC</option>
              <option value="Non Ac">Non Ac</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Room Description<span class="star">*</span></label>
            <div class="col-sm-9">
              <textarea name="data[room_desc]" id="" cols="30" rows="3" class="form-control"><?=@$adds['room_desc']?></textarea>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Quantity<span class="star">*</span></label>
            <div class="col-sm-9">
              <select name="data[quantity]" id="" class="form-control">
                   <?php if(@$adds['quantity']){ ?>
                     <option value = "<?php echo @$adds['quantity']?>"><?=@$adds['quantity']?></option>      
                    <?php }?>
              <option value="3">3</option>
              <option value="2">2</option>
              <option value="1">1</option>
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">From<span class="star">*</span></label>
            <div class="col-sm-9">
            <input type="date" name="data[form]" value="<?php if(@$adds['form']){ echo date('Y-m-d',strtotime(@$adds['form'])); } ?>" class="form-control">
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">To<span class="star">*</span></label>
            <div class="col-sm-9">
            <input type="date" name="data[to]" value="<?php if(@$adds['to']){ echo date('Y-m-d',strtotime(@$adds['to'])); }?>" class="form-control">
              </select>
            </div>
          </div>
          </div> 
          <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Days/Nights</label>
            <div class="col-sm-9">
            <input type="text" name="data[day_night]" value="<?=@$adds['day_night']?>" class="form-control">
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Check-In<span class="star">*</span></label>
            <div class="col-sm-9">
            <input type="text" name="data[check_in]" value="<?=@$adds['check_in']?>" id = "timepicker1" class="form-control basicExample timepicker">
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Check-Out<span class="star">*</span></label>
            <div class="col-sm-9">
            <input type="text" name="data[check_out]" value="<?=@$adds['check_out']?>" id = "timepicker1" class="form-control basicExample timepicker2">
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Proform No</label>
            <div class="col-sm-9">
            <input type="text" name="data[proform_no]" value="<?=@$adds['proform_no']?>" class="form-control">
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Final Invoice No</label>
            <div class="col-sm-9">
            <input type="text" name="data[final_invoice_no]" value="<?=@$adds['final_invoice_no']?>" class="form-control">
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Invoice No</label>
            <div class="col-sm-9">
            <input type="text" name="data[invoice_no]" value="<?=@$adds['invoice_no']?>" class="form-control">
              </select>
            </div>
          </div>
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">FCR</label>
            <div class="col-sm-3">
            <select name="data[frc]" id="" class="form-control">
                <?php if(@$adds['frc']){ ?>
                     <option value = "<?php echo @$adds['frc']?>"><?=@$adds['frc']?></option>      
                    <?php }?>
                <option value="USD">USD</option>
            </select>
              </select>
            </div>
             <label class="col-sm-3 control-label text-center" for="textinput">X-Rate</label>
            <div class="col-sm-3">
            <select  name="data[x_rate]" id="" class="form-control">
                <?php if(@$adds['x_rate']){ ?>
                     <option value = "<?php echo @$adds['x_rate']?>"><?=@$adds['x_rate']?></option>      
                    <?php }?>
            <option value="3.75">3.75</option>
            </select>
              </select>
            </div>
            </div>
          
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Unit Rate</label>
            <div class="col-sm-9">
            <input type="text" name="data[unit_rate]" value="<?=@$adds['unit_rate']?>" class="form-control">
              </select>
            </div>
          </div>
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">VAt</label>
            <div class="col-sm-3">
            <select name="data[vat]" id="" class="form-control">
                <?php if(@$adds['vat']){ ?>
                     <option value = "<?php echo @$adds['vat']?>"><?=@$adds['vat']?></option>      
                    <?php }?>
            <option value="5.00">5.00</option>
            <option value="6.00">6.00</option>
            <option value="7.00">7.00</option>
            </select>
              </select>
            </div>
            <div class="col-md-1 commison">
            <span>%</span>
            </div>
            <div class="col-sm-3">
            <input type="text" name="data[vat_amnt]" value="<?=@$adds['vat_amnt']?>" class=" form-control">
              </select>
            </div>            
             <label class="col-sm-2 control-label text-center" for="textinput">AMNT</label>
            </div>
          
            </div>
          </div>
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">Commission</label>
            <div class="col-sm-3">
            <select name="data[commission]" id="" class="form-control">
                <?php if(@$adds['commission']){ ?>
                     <option value = "<?php echo @$adds['commission']?>"><?=@$adds['commission']?></option>      
                    <?php }?>
            <option value="10.00">10.00</option>
            <option value="20.00">20.00</option>
            <option value="30.00">30.00</option>
            </select>
              </select>
            </div>
            <div class="col-md-1 commison">
            <span>%</span>
            </div>
            <div class="col-sm-3">
            <input type="text" name="data[commission_amnt]" value="<?=@$adds['commission_amnt']?>" class=" form-control">
              </select>
            </div>            
             <label class="col-sm-2 control-label text-center" for="textinput">AMNT</label>
            </div>
          
            </div>
          </div>
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">Markup</label>
            <div class="col-sm-3">
            <select name="data[markup]" id="" class="form-control">
                <?php if(@$adds['markup']){ ?>
                     <option value = "<?php echo @$adds['markup']?>"><?=@$adds['markup']?></option>      
                    <?php }?>
            <option value="">10.00</option>
            <option value="">20.00</option>
            <option value="">30.00</option>
            </select>
              </select>
            </div>
            <div class="col-md-1 commison">
            <span>%</span>
            </div>
            <div class="col-sm-3">
            <input type="text" name="data[markup_amnt]" value="<?=@$adds['markup_amnt']?>" class=" form-control">
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
            <input type="text" name="data[markup_net_cost]" value="<?=@$adds['markup_net_cost']?>" class="form-control">
             </div>
            
            <div class="col-sm-4">
            <input type="text" name="data[markup_net_sale]" class="form-control" value="<?=@$adds['markup_net_sale']?>">
            </div>            
             
            </div>
          
            </div>
          </div>
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">Cost In Sar</label>
            <div class="col-sm-4">
            <input type="text" name="data[cost_in_sar_net_cost]" class="form-control" value="<?=@$adds['cost_in_sar_net_cost']?>">
             </div>
            
            <div class="col-sm-4">
            <input type="text" name="data[cost_in_sar_net_csale]" class="form-control" value="<?=@$adds['cost_in_sar_net_csale']?>">
            </div>            
             
            </div>
          
            </div>
          </div>
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">Urgency Level</label>
            <div class="col-sm-3">
             <div class="radio">
            <input type="radio" name="data[urgent_level]"  <?php if(@$adds['urgent_level'] == 0){ echo 'checked';} ?> id="radio1" value = "0">
            <label for="radio1">
                0
            </label>
        </div>
        <div class="radio">
            <input type="radio" name="data[urgent_level]" id="radio2" value = "1" <?php if(@$adds['urgent_level'] == 1){ echo 'checked';} ?>>
            <label for="radio2">
                1
            </label>
        </div>
        <div class="radio">
            <input type="radio" name="data[urgent_level]" id="radio3" value = "2" <?php if(@$adds['urgent_level'] == 2){ echo 'checked';} ?> >
            <label for="radio3">
                2
            </label>
        </div>
        <div class="radio">
            <input type="radio" name="data[urgent_level]" id="radio4" value = "3" <?php if(@$adds['urgent_level'] == 3){ echo 'checked';} ?> >
            <label for="radio4">
               3
            </label>
        </div>
              
            </div>
             <label class="col-sm-3 control-label text-center" for="textinput">Status</label>
            <div class="col-sm-3">
            <select name="data[status_b]" id="" class="form-control">
                <?php if(@$adds['status_b']){ ?>
                     <option value = "<?php echo @$adds['status_b']?>"><?=@$adds['status_b']?></option>      
                    <?php }?>
            <option value="Billing">Billing</option>
            </select>
              
            </div>
            </div>
          
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Note<span class="star">*</span></label>
            <div class="col-sm-9">
              <textarea name="data[note]" id="" cols="30" rows="5" class="form-control"><?=@$adds['note']?></textarea>
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