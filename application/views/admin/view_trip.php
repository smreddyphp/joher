<link rel="stylesheet" href="http://ericjgagnon.github.io/wickedpicker/wickedpicker/wickedpicker.min.css">


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
            <li class="breadcrumb-item"><a href="#:" >View Trip</a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h5 class="card-header-text">View Trip</h5><span>
              <button class="btn btn-success fa" onclick="myFunction('printPdf')" data-name="<?php echo @$current_page; ?>" style="margin-left:85%">Print </button>
            </span>
          </div>
 <span id = "printPdf">         
          <div class="card-block addform-block">     
         <div class="row">
          <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">        

           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Client Code :</label>
            <div class="col-sm-9">
              <?php echo @$view_trip['client_code'];?>
            </div>
          </div>         

            <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Client Name: </label>
            <div class="col-sm-9">                
            <?php echo @$view_trip['client_name'];?>
            </div>
          </div>
           </div>

      <!-- Text input-->
       <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">From :</label>
            <div class="col-sm-9">
              <?php echo @$view_trip['from'];?>
            </div>
            </div>            
            </div>
          </div>
          
          <div class="row">
          <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">  
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Status :</label>
            <div class="col-sm-9">
           <?php echo @$view_trip['status_b'];?>
            </div>
          </div>
       <!--  <h2>Trip location</h2>-->
        </div>
          
         <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group ">
                  <label class="col-sm-3 control-label" for="textinput">Intermdiate cities :</label> 
                <div class="col-sm-9">
                  <div class="col-sm-9">
                  <?php echo @$view_trip['intermediate_cities'];?>
               </div>
                </div>    
              </div>
              </div>

              </div>
       <div class ="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> 
            <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">To :</label>
            <div class="col-sm-9">
            <?php echo @$view_trip['to'];?>
            </div>
            </div>
          </div>
        </div>
     <div class ="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> 
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Trip start :</label>
            <div class="col-sm-9">
            <?php echo @$view_trip['trip_start'];?>
            </div>
            </div>
          </div>
        </div>
            <div class ="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> 
      <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Trip End :</label>
            <div class="col-sm-9">
            <?php echo @$view_trip['trip_end'];?>
            </div>
            </div>
            </div></div>
              <div class ="row">
             <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 "> 
            <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Note :</label>
            <div class="col-sm-9">
               <?php echo @$view_trip['note']?>
            </div>
          </div>
        </div>
      </div>
      
          
          </div>  
 </span> 
          <div class="form-group text-center">          
             <a href="<?php echo base_url();?>admin/trip/" class="btn btn-primary waves-effect waves-light btn--cancel"  aria-hidden="true">Close</a>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-6"></div>    
          <div class="col-md-6 cost_box">
          </div>
           
          </div>
        </div>
      </div>
    </div>

  </div>
      
<!-- <script>     
    function myFunction() 
    {
        window.print();
       }
</script> -->


<script type="text/javascript">
   function myFunction(divId) {
       //alert(divId)
       //return false;
       var printContents = document.getElementById(divId).innerHTML;
       var originalContents = document.body.innerHTML;
       document.body.innerHTML = "<html><head><title></title></head><body>" + printContents + "</body>";
       window.print();
       document.body.innerHTML = originalContents;
   }
</script>


