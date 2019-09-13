<link rel="stylesheet" href="http://ericjgagnon.github.io/wickedpicker/wickedpicker/wickedpicker.min.css">

<style>
    #insert_trip label.error {
        color:red; 
    }
    #insert_trip input.error,textarea.error,select.error {
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
            <li class="breadcrumb-item"><a href="#:" >Edit Fees </a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h5 class="card-header-text">Edit Fees</h5><span>
              <!--<button class="btn btn-success fa fa-plus add_adds" data-name="<?php //echo @$current_page; ?>" style="margin-left:65%">Add </button>--></span>
          </div>
          
          <div class="card-block addform-block">
              <?php //print_r($value); ?>
      <form id="" method="post">
         <!-- Form Name -->
         <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">        
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="textinput">Banking Fee<span class="star">*</span></label>
                        <div class="col-sm-9">
                            <input type ="text" class ="form-control" name ="data[bank_fee]" value ="<?=$value['bank_fee']?>">
                        </div>
                    </div>
         
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="textinput">Management Fee:<span class="star">*</span></label>
                        <div class="col-sm-9">                
                                 <input type ="text" class ="form-control" name ="data[management_fee]" value ="<?=$value['management_fee']?>">
                        </div>
                    </div>
          
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="textinput">VAT %:<span class="star">*</span></label>
                        <div class="col-sm-9">                
                                 <input type ="text" class ="form-control" name ="data[vat_per]" value ="<?=$value['vat_per']?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="textinput">VAT % Amount:<span class="star">*</span></label>
                        <div class="col-sm-9">                
                                 <input type ="text" class ="form-control" name ="data[per_amount]" value ="<?=$value['per_amount']?>">
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


