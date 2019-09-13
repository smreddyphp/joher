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
              <a  href="<?php echo base_url();?>admin/add_aircraft" class="btn btn-success fa fa-plus" data-name="<?php echo @$current_page; ?>" style="float: right;">Add </a></span>
          </div>
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
              <th>Req</th>
              <th>Trip Code</th>
              <th>Status</th>
              <th>Client Email</th>
              <th>Type </th>
              <th>Details</th>
              <th>Tail No</th>
              <th>Route</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <!-- <th>Agent</th> -->
              <th>Urgency</th>
              <th>level</th>
              <th>Series</th>
              <th>Actions</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
              <th>Req</th>
              <th>Trip Code</th>
              <th>Status</th>
              <th>Client Email</th>
              <th>Type </th>
              <th>Details</th>
              <th>Tail No</th>
              <th>Route</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <!-- <th>Agent</th> -->
              <th>Urgency</th>
              <th>level</th>
              <th>Series</th>
              <th>Actions</th>
              </tr>
              </tfoot>
                <tbody>
               <?php $count = 1; foreach($craft as $row){  ?>                  
              <tr id="hide<?=$row["id"]?>">
              <td><?=$count++?></td>
              <td><?=$row['trip_id']?></td>
              <td><?=$row['status_b']?></td>
              <td> <?=$row['client_email']?></td>
              <td><?=$row['service_type']?></td>
              <td><?=$row['aircraft_type']?></td>
              <td><?=$row['aircraft_tail_no']?></td>
              <td><?=$row['route']?></td>
              <td><?=$row['from']?></td>
              <td><?=$row['to']?></td>
              <td><?=$row['supplier_name']?></td>
              <!-- <td></td> -->
              <td><?=$row['urgency_level']?></td>
              <td><?=$row['urgency_level']?></td>
              <td><?=$row['confirmation_no']?></td>
              <td id="hide<?=$row["id"]?>">
            <a href = "<?php echo base_url();?>admin/add_aircraft/<?=$row["id"]?>/<?=$row['user_id']?>" class="btn btn-primary waves-effect waves-light add_aircraft"  data-id="<?=$row["id"]?>"  style="float: none;margin: 5px;"> 
                <span class="icofont icofont-ui-edit"></span>
            </a>
            <button type="button" class="btn btn-danger delete_aircraft" onclick = "delete_aircraft(<?=$row["id"]?>)" data-id="<?=$row["id"]?>"><span class="icofont icofont-ui-delete"></span></button>
        </td>
    </tr>   
    <?php  } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
        <!-- Container-fluid ends -->
     </div>
 <script>
        
        //delete 
        function delete_aircraft(id)
        {
            alertify.confirm("Do you want to Delete AirCraft Service ?.",
          function(){
            //alertify.success('Ok');
            $.ajax({                
                    url: "<?php echo base_url();?>admin/delete_data/air_craft",
                    type: "POST",
                    data: {id:id},
                    error:function(request,response){
                        console.log(request);
                    },                  
                    success: function(result){
                        //var res = jQuery.parseJSON(result);
                       // if(res.status='success'){
                      window.location.href="<?php echo base_url();?>admin/aircraft";
                           // $("#hide"+id).hide();
                            location.reload();
                        //}
                        
                    }
              });
            },
          function(){
           // alertify.error('Cancel');
          });
        } 
                   
    </script>
 