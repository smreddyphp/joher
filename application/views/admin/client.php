
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
            <div class="row">
               
                 <div class="card-header">
                      <div class="col-sm-4"><h5 class="card-header-text">Add/Edit User Management Lists</h5>
                      </div>
                <div class="col-sm-5">
                    <div class="col-sm-12">
                      <form method="post" action="<?php echo base_url();?>admin/importcsv"
                       enctype="multipart/form-data">
                      <div class="col-sm-12 ">
                      <div class="col-sm-12  csvbtn-right">
                    <span class="btn btn-default btn-file col-sm-7">
                    Browse CSV File: <input type="file" name="userfile" required class="btn btn-success pull-right">
                    </span>
                    <input type="submit" name="submit" class="btn btn-primary col-sm-4 pull-right">
                    </div>
              </div>
            </form>
                    </div>
                </div>

                 <!-- <div class="col-sm-3">
                  
                     <span>
              <a  href="<?php //echo base_url();?>admin/download_csv" class="btn btn-success" data-name="<?php //echo @$current_page; ?>" style="float:right;">Download </a></span>
                    </div> -->

                  <div class="col-sm-3">
                     <span>
              <a  href="<?php echo base_url();?>admin/add_client" class="btn btn-success fa fa-plus" data-name="<?php echo @$current_page; ?>" style="float:right;">Add Client </a></span>
                    </div>
                  
                    </div>
                    
                </div>
          
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
               <th>S NO</th>
               <!-- <th>Image</th>-->
                <th>Name</th>
                <th>Client Code</th>
                <th>Email</th>
                <th>Mobile</th>
                 <th>Customer Type</th>
                 <th>View trips</th>
                 <!-- <th>Add trips</th> -->
                <th>Action</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>S NO</th>
              <!--  <th>Image</th>-->
                <th>Name</th>
                <th>Client Code</th>
                <th>Email</th>
                <th>Mobile</th>
                 <th>Customer Type</th>
                 <th>View trips</th>
                 <!-- <th>Add trips</th> -->
                <th>Status</th>
              </tr>
              </tfoot>
              <tbody>
              <?php $count = 1; foreach(@$client as $row){  ?>
              <tr id="hide<?=$row["user_id"]?>">
              <td><?=$count++?></td>
               <!-- <td style="width: 10%;"> <img src="http://volive.in/joher_new/assets/uploads/user_profiles/default1.png"  style="width:30%;background-color:gray;"></td>-->
                <td><?=$row['user_name']?></td>
                <td> <?php $res = $this->db->where('user_id',$row['user_id'])->get('user_info')->row_array()['client_code']; echo $res;?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['mobile']?></td>
                <td>
                <strong><?php if($row['customer_type'] == 'CRMS'){ echo 'CRMS';}else{ echo 'joher'; }?>  </strong>
                  </td>
                  <td>
                  <a href="<?php echo base_url();?>admin/client_trip/<?=$row['user_id']?>" class="btn btn-sm  btn-primary waves-effect waves-light active_inactive" style="float: none;margin: 5px;"> 
                           <span> View Trips</span>
                      </a>                                
                  </td> 
                  <!-- <td>
                  <a href="<?php //echo base_url();?>admin/add_trip/<?=$row['user_id']?>" class="btn btn-primary waves-effect waves-light active_inactive" style="float: none;margin: 5px;"> 
                           <span> Add Trips</span>
                      </a>                                
                  </td> -->  

              <td id="hide<?=$row["user_id"]?>" style="white-space: nowrap; width: 1%;">  
                <!-- <a href = "<?php //echo base_url('Admin/user_info/').$row["user_id"]; ?>" class="btn btn-sm btn-info waves-effect waves-light" data-id="'.$row["user_id"].'" style="float: none;margin: 5px; background-color: #2196F3;border-color: #2196F3;color: #fff !important;"><i class="icofont icofont-eye m-r-5"></i></a> -->
                
                <a href = "<?php echo base_url();?>admin/documents/<?=$row["user_id"]?>/client_doc" 
                  class="btn btn-primary btn-sm waves-effect waves-light">Documents</a>
                
                <a href = "<?php echo base_url();?>admin/view_client/<?=$row["user_id"]?>" class="btn btn-sm btn-primary waves-effect waves-light add_client"  data-id="<?=$row["user_id"]?>"  style="float: none;margin: 5px;"> 
                    View Client</span>
                </a>
                
                <a href = "<?php echo base_url();?>admin/add_client/<?=$row["user_id"]?>" class="btn btn-sm btn-primary waves-effect waves-light add_client"  data-id="<?=$row["user_id"]?>"  style="float: none;margin: 5px;"> 
                    <span class="icofont icofont-ui-edit"></span>
                </a>
                
                <button type="button" class="btn btn-sm btn-danger delete_client"  onclick = "delete_client(<?=$row["user_id"]?>)"data-id="<?=$row["user_id"]?>"> 
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
        function delete_client(id)
        {
           
           alertify.confirm("Do you want to Delete Client ?.",
          function(){
            //alertify.success('Ok');            
            $.ajax({                
                    url: "<?php echo base_url();?>admin/delete_data/users",
                    type: "POST",
                    data: {id:id},
                    error:function(request,response){
                        console.log(request);
                    },                  
                    success: function(result){
                       // var res = jQuery.parseJSON(result);
                        //if(res.status='success'){
                           // $("#hide"+id).hide();
                        window.location.href="<?php echo base_url();?>admin/client";
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
    

 