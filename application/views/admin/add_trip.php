<link rel="stylesheet" href="http://ericjgagnon.github.io/wickedpicker/wickedpicker/wickedpicker.min.css">

<style>
    #insert_trip label.error 
    {
        color:red; 
    }
    #insert_trip input.error,textarea.error,select.error 
    {
        border:1px solid red;
        color:red; 
    }
    .popover 
    {
        z-index: 2000;
        position:relative;
    }    
</style>

<?php 
    if($this->uri->segment(3))
    {
        $value = $this->db->where('user_id',$this->uri->segment(3))->get('users')->row_array();
    }
?>

<?php //print_r($trip);exit; ?>


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
            <li class="breadcrumb-item"><a href="#:" >Add/Edit Trip</a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h5 class="card-header-text">Add/Edit Trip</h5><span>
              <!--<button class="btn btn-success fa fa-plus add_adds" data-name="<?php //echo @$current_page; ?>" style="margin-left:65%">Add </button>--></span>
          </div>
          
          <div class="card-block addform-block">
      <form id="insert_trip" method="post">
         <!-- Form Name -->
         <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">        

           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Client Code<span class="star">*</span></label>
            <div class="col-sm-9">
                <?php  //echo  $id = $this->uri->segment(3); 
                        //echo $adds['user_id'];
                       // print_r($adds);
                if($this->uri->segment(3) !='')
              {
              
                $id = $this->uri->segment(3);
                $client_code = $this->db->get_where('user_info',array('user_id'=>$id))->row_array();
               // echo $this->db->last_query(); exit;
              // print_r($client_code); exit;
                ?>
                     <select class="form-control" name="data[client_code]" id="get_client_code" 
                     onchange = "client_code(this.value)">
                        <option>Select Code</option>
                        <?php 
                            $res = $this->db->get_where('user_info',array('user_id'=>$id))->result();
                        ?>
                
                        <?php 
                            
                            if($res)
                            { 
                                foreach($res as $row)
                                { ?>
                                 <option value = "<?=$row->client_code?>"  <?php if($row->client_code == @$trip['client_code']){  echo 'selected';}else{ echo 'selected';}?> ><?=$row->client_code?></option>   
                            <?php  }
                            }
                        ?>
                
                  </select>
                <?php }
                else
                    {  ?>
                <select class="form-control" name="data[client_code]"  id="get_client_code" 
                 onchange = "client_code(this.value)">
                     <option>Select Code</option>
                <?php 
                    $res = $this->db->get_where('user_info')->result();
                    if($res)
                    { 
                        foreach($res as $row)
                        {   ?>
                            <option value = "<?=$row->client_code?>"  <?php if($row->client_code == @$trip['client_code']){  echo 'selected';}?> ><?=$row->client_code?></option>   
                            <?php  
                        }
                    }
                ?>
            </select>
                <?php } ?>
            </div>
          </div>
          <!-- Text input-->
          <!-- <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Client Code<span class="star">*</span></label>
            <div class="col-sm-9">
              <input type="text" placeholder=""  name="data[client_code]" value="<?php //if(@$trip['client_code']) { echo @$trip['client_code'] ; }else if($this->uri->segment(3)){ echo $this->uri->segment(3);} ?>" class="form-control" >
            </div>
          </div> -->

            <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Client Name:<span class="star">*</span></label>
            <div class="col-sm-9">                
            <select class="form-control" name="data[client_name]" id="get_client_name" >
                     <option>Select Name</option>
                <?php 
                    $res = $this->db->get_where('users',array('auth_level'=>1))->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->user_name?>" <?php if($row->user_id == @$trip['user_id']){ echo 'selected';}else if($row->user_id==@$client_code['user_id']){ echo 'selected';}?>><?=$row->user_name?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div>

           </div>

              <!-- Text input-->
              <!-- Text input-->
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                    <div class="form-group ">
                    <label class="col-sm-3 control-label" for="textinput">From<span class="star">*</span></label>
                    <div class="col-sm-9">
                      <select class="form-control" name="data[from]">
                             <option>Select City</option>
                        <?php 
                            $res = $this->db->get_where('city')->result();
                            if($res){ 
                                foreach($res as $row)
                                { ?>
                                 <option value ="<?=$row->city_name?>" <?php if($row->city_name == @$trip['from']){ echo 'selected';}?>><?=$row->city_name?></option>   
                            <?php  }
                            }
                        ?>
                    </select>
                    </div>
                    </div>            
                    </div>  
          </div>
           
          
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">  
              <div class="form-group ">
                <label class="col-sm-3 control-label" for="textinput">Status<span class="star">*</span></label>
                <div class="col-sm-9">
                    <select name="data[status_b]" id="" class="form-control">
                    <option value="Open" <?php if(@$trip['status_b']=='Open'){ echo 'selected';} ?>>Open</option>
                    <option value="Billing" <?php if(@$trip['status_b']=='Billing'){ echo 'selected';} ?>>Billing</option>
                    <option value="Closed" <?php if(@$trip['status_b']=='Closed'){ echo 'selected';} ?> >Closed</option>
                    <option value="Ongoing" <?php if(@$trip['status_b']=='Ongoing'){ echo 'selected';} ?> >Ongoing</option>
                    <option value="Cancelled" <?php if(@$trip['status_b']=='Cancelled'){ echo 'selected';} ?> >Cancelled</option>
                    <option value="Personal" <?php if(@$trip['status_b']=='Personal'){ echo 'selected';} ?> >Personal</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                <div class="form-group ">
                  <label class="col-sm-3 control-label" for="textinput">Intermdiate cities<span class="star">*</span></label>
                <div class="col-sm-9">
                  <div class="col-sm-9">
                 <!--<input type="text" placeholder="" name="data1[intermediate_cities][]" value="<?php //echo @$trip['intermediate_cities']?>" class="form-control"> -->
                
                <select class="form-control" name="data1[intermediate_cities][]">
                     <option value = "">Select City</option>
                    <?php 
                        $res = $this->db->get_where('city')->result();
                        if($res){ 
                        foreach($res as $row)
                        { ?>
                            <option value ="<?=$row->city_name?>" ><?=$row->city_name?></option>
                            <?php  
                        }
                    }   ?>
                </select>
               </div>
               
               <div class="col-sm-2">
                 <button class="btn btn-sm btn-primary add_more_button" style="align-right: "><i class="fa fa-plus"></i></button>
                 </div>
                </div>    
              </div>
                <div class="col-md-12">
                   <div class="form-group col-md-3">
                       <label class="form-control-label"></label>  
                    </div>
                    <div class="form-group col-md-6">
               <?php 
                    $res = $this->db->get_where('city')->result();
                    
                    if(@$trip['intermediate_cities'])
                    {
                        $cities = explode(',',@$trip['intermediate_cities']);
                        if($cities[0] == '')
                        { 
                            unset($cities[0]);
                        }
                        
                         foreach($cities as $city)
                        { 
                            
                        ?>
                        <select class="form-control" name="data1[intermediate_cities][]">
                             <?php
                                foreach($res as $row)
                                { 
                                    
                                ?>
                                 <option value ="<?=$row->city_name?>" <?php if($row->city_name==@$city){ echo 'selected';}?>><?=$row->city_name?></option>   
                            <?php  } ?>
                    </select>
                    <div class="form-group col-md-8">
                        
                        <a href="#" class="place" data-text="<?php echo @$city;?>" style="margin-left:5px;">Remove</a>
                        </div>
                    <?php } }  ?>
                </div>
                </div>
                <div class="input_fields_container"></div>
                <!-- <input type="hidden" name="data[id]" value="<?=@$client_code['id']?>"> -->
            </div>
        </div>
        <div class ="row">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 ">
                <div class="form-group ">
                    <label class="col-sm-3 control-label" for="textinput">Date<span class="star">*</span></label>
                    <div class="col-sm-9">
                        <input class="form-control" type="date" name="data[trip_date]" value="<?php echo @$trip['trip_date']?>"  placeholder="Select Trip StartDate" >
                    </div>
                </div>    
             </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> 
                <div class="form-group ">
                    <label class="col-sm-3 control-label" for="textinput">To<span class="star">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="data[to]">
                             <option>Select Name</option>
                            <?php 
                                $res = $this->db->get_where('city')->result();
                                if($res){ 
                                    foreach($res as $row)
                                    { ?>
                                     <option value ="<?=$row->city_name?>" <?php if($row->city_name == @$trip['to']){ echo 'selected';}?>><?=$row->city_name?></option>   
                                <?php  }
                                }
                            ?>
                        </select>
                    </div>
                </div>
           </div>
        </div>
    <div class ="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> 
                        <div class="form-group ">
                            <label class="col-sm-3 control-label" for="textinput">Trip start<span class="star">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control" type="date" name="data[trip_start]" value="<?php echo @$trip['trip_start']?>"  placeholder="Select Trip StartDate" >
                            </div>
                        </div>
          </div>
    </div>
    <div class ="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> 
      <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Trip End<span class="star">*</span></label>
            <div class="col-sm-9">
            <input class="form-control" type="date" name="data[trip_end]" value="<?php echo @$trip['trip_end']?>"  placeholder="Select Trip EndDate" >
            </div>
            </div>
            </div></div>
              <div class ="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> 
            <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Note<span class="star">*</span></label>
            <div class="col-sm-9">
               <textarea class="form-control" type="text" name="data[note]" placeholder="Enter Description" ><?php echo @$trip['note']?></textarea>
            </div>
          </div>
        </div>
      </div>
        
          <div class="form-group text-center">
          <!--<button class="add-save btn btn-md">Save</button>-->
           <button  class="add-save btn btn-primary waves-effect waves-light insert_trip">Save</button>
          </div>
          </div>  
          <div class="clearfix"></div>
          <div class="col-md-6"></div>    
          <div class="col-md-6 cost_box">
          </div>
            <input type="hidden" name="data[id]" value="<?php echo $this->uri->segment(4); ?>">
            <input type="hidden" name="data[pname]" value="<?php echo $this->uri->segment(2); ?>">
            <input type="hidden" name="data[user_id]" value="<?php echo $this->uri->segment(3); ?>"> 
      </form>
          </div>
        </div>
      </div>
    </div>

  </div>
        <!-- Container-fluid ends -->
 </div>
<script>     
      $("#insert_trip").validate({       
            rules: {
               
              "data[client_code]"           : "required",
              "data[client_name]"           : "required",
              "data[from]"                  : "required",
              "data[to]"                    : "required",
              "data[intermediate_cities]"   : "required",
              "data[trip_start]"            : "required",
              "data[trip_end]"              : "required",
              "data[note]"                  :"required"
                
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
        $('.insert_trip').click(function(){ 
          var validator = $("#insert_trip").validate();
            validator.form();
            if(validator.form() == true){
            $('.insert_trip').html("<img src='<?php echo base_url()?>assets/images/ajax-loaderr.gif' style='width:20px; height:15px;'>"); 
              var data = new FormData($('#insert_trip')[0]);  

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
                     //console.log(result);
                         window.location.href = '<?php echo base_url('admin/trip');?>';
                       //location.reload();
                    }
                  
                });
            }
           return false;
        });
                      
    </script> 
 <script src="http://volive.in/joher/assets/admin/js/wickedpicker.js"></script>
 <script>
  $('.timepicker,.timepicker2').wickedpicker();
  </script>


  <script>
    $(document).ready(function() {
    var max_fields_limit      = 10; //set limit for maximum input fields
    var x = 1; //initialize counter for text box
    $('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
        e.preventDefault();
        if(x < max_fields_limit){ //check conditions
          x++; 
  //counter increment
    $('.input_fields_container').append('<div class="col-md-12"><div class="form-group col-md-3"><label class="form-control-label"></label>  </div> <div class="form-group col-md-6"> <select class="form-control"name="data1[intermediate_cities][]"><option>Select Name</option><?php $res = $this->db->get_where("city")->result(); if($res) { foreach($res as $row) { ?> <option value ="<?=$row->city_name?>" <?php if($row->city_name == @$trip["intermediate_cities"]){ echo "selected";}?>><?=$row->city_name?></option><?php  }    }   ?>  </select></div><div class="form-group col-md-3"><a href="#" class="remove_field" style="margin-left:10px;">Remove</a></div></div>'); 
        }

    }); 
     
    $('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
        e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
    })
     
});
    $(document).on("click",".place", function(e){ //user click on remove text links
      var place = ($(this).data('text'));
      //alert(place);
      $.ajax({                
          url: "<?php echo site_url('admin/get_city_id');?>",
          type: "POST",
          dataType: "html",          
          data: {id:"<?php echo @$id;?>",place:place},                  
          success: function(html)
          {
                //alert('Success');
                //console.log(html)
                location.reload();
           }
         });
        e.preventDefault(); $(this).parent('div').parent('div').remove(); 
    });
</script>

<script>
    function client_code(val)
    {
         $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url();?>admin/get_client_name',
                  data: {'id':val},
                  success: function (data) 
                  {
                        //alert(data);
                        $('#get_client_name').html(data);
                  }
        });
    }
</script>


<script>
    function client_name(val)
    {
      //alert(val);
         $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url();?>admin/get_client_id',
                  data: {'user_name':val},
                  success: function (data) 
                  {
                        //alert(data);
                        $('#get_client_code').html(data);
                  }
        });
    }
</script>


