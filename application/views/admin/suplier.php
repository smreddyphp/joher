
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
          <div class="card-header"><h5 class="card-header-text">Add/Edit Supplier Management Lists</h5>
            <span>
              <a  href="<?php echo base_url();?>admin/add_suplier" class="btn btn-success fa fa-plus" data-name="<?php echo @$current_page; ?>" style="float:right;">Add Suplier </a></span>
          </div>
          <div class="card-block table-responsive">
            <table id="advanced-table" class="table  table-striped table-bordered nowrap">
              <thead>
              <tr>
               <th>S NO</th>
                <!-- <th>Image</th> -->
                <th>Supplier Code</th>
                <th>Supplier Name</th>
                <th>Supplier Group</th>
                <th>Service Type</th>
                <th>City</th>
                <th>Country</th>
                <th>Status</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tfoot>
                 <tr>
                <th>S NO</th>
               <!--  <th>Image</th> -->
                <th>Supplier Code</th>
                <th>Supplier Name</th>
                <th>Supplier Group</th>
                <th>Service Type</th>
                <th>City</th>
                <th>Country</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
              </tfoot>
              <tbody>
              <?php $count = 1; 
                foreach($suplier as $row){ 
                if ($row["status"] == "1") {

                              $status = "tag tag-success" ;
                              $status1='Active';

                          } else {

                              $status = "tag tag-default" ;
                               $status1='InActive';
                    }

               ?>
              <tr id="hide<?=$row["id"]?>">
              <td><?=$count++?></td>
             <!--  <td style="width: 10%;"> <img src="http://volive.in/joher_new/assets/uploads/user_profiles/default1.png"  style="width:30%;background-color:gray;"></td> -->
                <td><?=$row['supplier_code']?></td>
                <td ><?=$row['supplier_name']?></td>
                <td><?=$row['supplier_group']?></td>
                <td><?=$row['service_type']?></td>
                <td><?=$row['city']?></td>
                <td><?=$row['country']?></td>
                <td><span class="<?php echo $status;?>"><?php echo ucfirst($status1);?></span></td>
               
                  <!-- <td>
                  <a href="<?php //echo base_url();?>admin/client_trip/<?=$row['user_id']?>" class="btn btn-primary waves-effect waves-light active_inactive" style="float: none;margin: 5px;"> 
                           <span> View Trips</span>
                      </a>                                
                  </td>  -->
                  <!-- <td>
                  <a href="<?php //echo base_url();?>admin/add_trip/<?=$row['user_id']?>" class="btn btn-primary waves-effect waves-light active_inactive" style="float: none;margin: 5px;"> 
                           <span> Add Trips</span>
                      </a>                                
                  </td> -->  

                  <td id="hide<?=$row["id"]?>" style="white-space: nowrap; width: 1%;">
   
            <!-- <a href = "<?php //echo base_url('Admin/user_info/').$row["user_id"]; ?>" class="btn btn-info waves-effect waves-light" data-id="'.$row["user_id"].'" style="float: none;margin: 5px; background-color: #2196F3;border-color: #2196F3;color: #fff !important;"> 
            <i class="icofont icofont-eye m-r-5"></i></a> -->

            <a href = "<?php echo base_url();?>admin/add_suplier/<?=$row["id"]?>" class="btn btn-primary waves-effect waves-light add_suplier"  data-id="<?=$row["id"]?>"  style="float: none;margin: 5px;"> 
                <span class="icofont icofont-ui-edit"></span>
            </a>
            <button type="button" class="btn btn-danger delete_suplier"  onclick = "delete_suplier(<?=$row["id"]?>)"data-id="<?=$row["id"]?>"> 
                <span class="icofont icofont-ui-delete"></span>
            </button>
                            
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
 <!-- CONTENT-WRAPPER-->
 
   <script>    
        function delete_suplier(id)
        {
            alertify.confirm("Do you want to Delete Supplier ?.",
           function(){
            $.ajax({                
                    url: "<?php echo base_url();?>admin/delete_data/suppliers",
                    type: "POST",
                    data: {id:id},
                    error:function(request,response){
                        console.log(request);
                    },                  
                    success: function(result){
                       // var res = jQuery.parseJSON(result);
                        //if(res.status='success'){
                           // $("#hide"+id).hide();
                        window.location.href="<?php echo base_url();?>admin/suplier";
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
    

 