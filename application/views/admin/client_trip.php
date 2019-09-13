
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
          <div class="card-header"><h5 class="card-header-text">Add/Edit Trip</h5>
              <span>
          <?php if($this->uri->segment(3)){ ?>
              <a  href="<?php echo base_url();?>admin/add_trip/<?php echo $this->uri->segment(3)?>/<?php echo $this->uri->segment(3);?>" class="btn btn-success fa fa-plus" data-name="<?php echo @$current_page; ?>" style="float:right;">Add New Trip </a>
            </span>
          <?php }?>
          </div>
          
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
              <th>S.NO</th>
              <th>Trip No </th>
              <th>Client Name </th>
              <th>Trip Start</th>
              <th>Trip End</th>
              <th>note</th>
              <th>Trip Location</th>
              <th>Service details</th>
              <th>Actions</th>
              </tr>
              </thead>
              <tfoot>
              <tr>
              <th>S.NO</th>
              <th>Trip No</th>
              <th>Client Name</th>
              <th>Trip Start</th>
              <th>Trip End</th>
              <th>note</th>
              <th>Trip Location</th>
              <th>Service details</th>
              <th>Actions</th>
              </tr>
              </tfoot>
              <tbody>
              <?php $count = 1; foreach($trip as $row){  ?>
              <tr id="hide<?=$row["user_id"]?>">
              <td><?=$count++?></td>
              <td style="width: 10%;"><?=$row['id']?></td>
              <td ><?php $res= $this->db->get_where('users',array('user_id'=>$row['user_id']))->row_array()['user_name'];
                echo $res;?></td>
              <td><?=$row['trip_start']?></td>
              <td><?=$row['trip_end']?></td>
              <td><?=$row['note']?></td>
              <td>
                <a href="<?=$row['id']?>" class="btn btn-primary btn-sm waves-effect waves-light " data-toggle="modal" data-target="#locationmodal_<?=$row['id']?>">view</a>
                <a href="<?php echo base_url();?>admin/view_trip/<?=$row['user_id']?>/<?=$row['id']?>" class="btn btn-primary btn-sm waves-effect waves-light fa fa-print"> Print Trip</a>
              </td>
              <td>
              <a href="<?php echo base_url();?>admin/services/<?=$row['user_id']?>/<?=$row['id']?>" class="btn btn-primary btn-sm waves-effect waves-light ">view services</a>
              <!-- <a href="<?=$row["user_id"]?>"class="btn btn-primary waves-effect waves-light " data-toggle="modal"data-target="#servicemodal_<?=$row['user_id']?>">view services</a> -->
            </td>
              <td id="hide<?=$row['id']?>">
            <a href = "<?php echo base_url();?>admin/add_trip/<?=$row['user_id']?>/<?=$row['id']?>" class="btn btn-primary btn-sm waves-effect waves-light add_trip"  data-id="<?=$row['user_id']?>"  style="float: none;margin: 5px;"> 
                <span class="icofont icofont-ui-edit"></span>
            </a>
            <button type="button" class="btn btn-danger btn-sm delete_trip" onclick = "delete_trip(<?=$row["id"]?>)" data-id="<?=$row["user_id"]?>"><span class="icofont icofont-ui-delete"></span></button>

             <a href="<?php echo base_url();?>admin/generate_invoice/<?=$row["user_id"]?> "class="btn btn-primary btn-sm waves-effect waves-light">Generate Quotation</a>

            <a href="<?php echo base_url();?>admin/generate_invoice/<?=$row["user_id"]?>" class="btn btn-primary btn-sm waves-effect waves-light ">Generate Invoice</a>

              <a href="<?php echo base_url();?>admin/copy_data/<?=$row['user_id']?>" class="btn btn-primary btn-sm waves-effect waves-light ">Copy</a>



            
            </td>
             </tr>


        <div class="modal" id="locationmodal_<?=$row['id']?>">
        <div class="modal-dialog">
         <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">TRIP LOCATION</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
              <div class = "row">
              <div class = "col-sm-12">
                <div class="col-sm-1"> 
                 <strong>Req</strong>
                </div>
                <div class="col-sm-2"> 
                  <strong>City</strong>
                </div>
                <div class="col-sm-2"> 
                  <strong>From</strong>
                </div>
                <div class="col-sm-2"> 
                   <strong>To</strong>
                </div>
                 <div class="col-sm-3"> 
                  <strong>Intermediate</strong>
                </div>
                <div class="col-sm-2"> 
                 <strong>Status</strong>
                </div>
                </div>
                </div>
                <div class = "row">
                    <div class = "col-sm-12">
                      <div class="col-sm-1"> 
                      Req
                      </div>
                      <div class="col-sm-2"> 
                       <?=$row['from']?>
                      </div>
                      <div class="col-sm-2"> 
                        <?=$row['from']?>
                      </div>
                      <div class="col-sm-2"> 
                         <?=$row['to']?>
                      </div>
                       <div class="col-sm-3"> 
                       <?=$row['intermediate_cities']?>
                      </div>
                      <div class="col-sm-2"> 
                       <a href="" class="btn btn-primary btn-sm waves-effect waves-light ">In progress</a>
                      </div>

                    </div>
                </div>

           </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<!--view services-->

        <div class="modal" id="servicemodal_<?=$row['user_id']?>">
        <div class="modal-dialog">
         <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">View Services</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <div class = "row">
              <div class = "col-sm-12">
            
            <label class="col-sm-3 control-label" for="textinput">
              <strong>Select Service </strong> </label>
            <div class="col-sm-9">
               <ul>
                <?php  $id = $this->uri->segment(3); ?>
                <li><a href = "http://localhost/joher/admin/demo1/<?=$id?>/hotel">Hotel</a></li>
                <li><a href = "http://localhost/joher/admin/demo1/<?=$id?>/air_train">Air/Train</a></li>
                <li><a href = "http://localhost/joher/admin/demo1/<?=$id?>/aircraft">Aircraft</a></li>
                <li><a href = "http://localhost/joher/admin/demo1/<?=$id?>/car_driver_security">Car/Driver/Security</a></li>
                <li><a href = "http://localhost/joher/admin/demo1/<?=$id?>/boat">Boat</a></li>
                <li><a href = "http://localhost/joher/admin/demo1/<?=$id?>/company_fees">Company Fees</a></li>
                <li><a href = "http://localhost/joher/admin/demo1/<?=$id?>/cruise">Cruise</a></li>
                <li><a href = "http://localhost/joher/admin/demo1/<?=$id?>/cargo_package">Cargo Package</a></li>
                <li><a href = "http://localhost/joher/admin/demo1/<?=$id?>/crm_event">Events</a></li>
                <li><a href = "http://localhost/joher/admin/demo1/<?=$id?>/miscellaneous">Miscellaneous</a></li>
              </ul>
            </div>                     
            </div>
          </div>
           </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<!--end view services-->
    <?php }?>
      </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    </div>
        <!-- Container-fluid ends -->
        
     </div>
 <!-- CONTENT-WRAPPER-->
 
   <script>    
        function delete_trip(id)
        {
            alertify.confirm("Do you want to Delete Trip ?.",
            function(){
            $.ajax({                
                    url: "<?php echo base_url();?>admin/delete_data/trip",
                    type: "POST",
                    data: {id:id},
                    error:function(request,response){
                        console.log(request);
                    },                  
                    success: function(result){
                        //var res = jQuery.parseJSON(result);
                        //if(res.status='success'){
                            //$("#hide"+id).hide();
                        window.location.href="<?php echo base_url();?>admin/client_trip";
                            location.reload();
                       // }
                        
                    }
              });
            },
          function(){
           // alertify.error('Cancel');
          });
        }
   
               
    </script>
    

 