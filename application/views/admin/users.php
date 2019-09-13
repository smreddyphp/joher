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
              <button class="btn btn-success fa fa-plus add_adds" data-name="<?php echo @$current_page; ?>" style="float: right;">Add </button></span>
          </div>
          <div class="card-block">
            <table id="advanced-table" class="table table-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
                <th>S NO</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Password</th>
                <th>IP-Address</th>
                <th>Login Status</th>
                <th>Last Login</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>S NO</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Password</th>
                <th>IP-Address</th>
                <th>Login Status</th>
                <th>Last Login</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
              </tfoot>
              <tbody>
                <?php 
                      $counter = 1;

            //$adds = [];
                      foreach($user as $key){
                          
                          if($key["status"] =='active')
                          {
                              $tatus = '<button type="button" class="btn btn-primary btn-sm waves-effect waves-light add_adds" data-toggle="modal" data-name="'.$current_page.'" data-target = "#add_vehicle" data-id="'.$key["user_id"].'"  style="float: none;margin: 5px;"> 
                                               '.$key["status"].'
                                            </button>';
                          }
                          else
                          {
                              $tatus = '<button type="button" class="btn btn-primary btn-sm waves-effect waves-light delete_team_mem" data-id="'.$key["user_id"].'" style="float: none;margin: 5px;"> 
                                                 '.$key["status"].'
                                            </button>';
                          }
                          
                          if($key["login_status"] == 1)
                          {
                              $login_status = '<button type="button" class="btn btn-primary btn-sm waves-effect waves-light add_adds" data-toggle="modal" data-name="'.$current_page.'"   style="float: none;margin: 5px;"> 
                                              On-line
                                            </button>';
                          }
                          else
                          {
                              $login_status = '<button type="button" class="btn btn-primary btn-sm waves-effect waves-light delete_team_mem" style="float: none;margin: 5px;"> 
                                                 Off-line
                                            </button>';
                          }
                          
                          $dateL = $this->db->where('user_id',$key["user_id"])->order_by('id','desc')->get('login_info');//->last_login
                          $dateL = ($dateL->row())?$dateL->row()->last_login:'';
                           echo '
                              <tr id="hide'.$key["user_id"].'">
                                  <td>'.$counter.'</td> 
                                  <td> <img src="'.base_url().$key["image"].'"  style="width:30px;background-color:gray;"</td>
                                  <td>'.$key["user_name"].'</td>                                       
                                  <td>'.$key["email"].'</td>
                                  <td>'.$key["mobile"].'</td>
                                  <td>'.base64_decode($key["password"]).'</td>
                                  <td>'.$key["ip_address"].'</td>
                                  <td>'.$login_status.'</td>
                                  <td>'.$dateL.'</td>
                                  <td>'.$tatus.'</td>
                                  <td style="white-space: nowrap; width: 1%;">
                                    <div class=" user-toolbar btn-toolbar" style="text-align: left;">
                                        <div class="btn-group btn-group-sm" style="float: none;">
                                            
                                           
                                            <button type="button" class="btn btn-primary waves-effect waves-light add_adds" data-toggle="modal" data-name="'.$current_page.'" data-target = "#add_vehicle" data-id="'.$key["user_id"].'"  style="float: none;margin: 5px;"> 
                                                <span class="icofont icofont-ui-edit"></span>
                                            </button>
                                            <button type="button" class="btn btn-primary waves-effect waves-light delete_team_mem" data-toggle="modal" data-name="'.$current_page.'" data-id="'.$key["user_id"].'" style="float: none;margin: 5px;"> 
                                                <span class="icofont icofont-ui-delete"></span>
                                            </button>
                                             <a href = "'.base_url('Admin/logoutAgent/').$key["user_id"].'/'.$this->uri->segment(2).'"   data-toggle="tooltip" data-placement="top" title="Logout" class="btn btn-danger waves-effect waves-light" data-id="'.$key["user_id"].'" style="float: none;margin: 5px; background-color: #f3215b;border-color: #f32165;;color: #fff !important;"> 
                                                <i class="icon-logout"></i>
                                            </a>
                                            <a href = "'.base_url('Admin/log_info/').$key["user_id"].'" class="btn btn-info btn-sm waves-effect waves-light" data-id="'.$key["user_id"].'" style="float: none;margin: 5px; background-color: #e79e53;border-color: #e79418;color: #fff !important;"> 
                                                Login Info
                                            </a>
                                        </div>                                                       
                                    </div>
                                </td>
                              </tr>
                          ';
                          $counter++;
                      }
                      
                      
                       /*<a href = "'.base_url('Admin/user_info/').$key["user_id"].'" class="btn btn-info waves-effect waves-light" data-id="'.$key["user_id"].'" style="float: none;margin: 5px; background-color: #2196F3;border-color: #2196F3;color: #fff !important;"> 
                                                <i class="icofont icofont-eye m-r-5"></i>
                                            </a>*/
                      
                  ?> 
              
              
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
  <section>
    <div class = "modal fade" data-backdrop="static" data-keyboard="false" id = "add_adds" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true"></div>
    </section>
   <script>     
        var $modal = $('#add_adds');
        $('.add_adds').on('click',function(event){ 
          
            var id = $(this).data('id');
            var pname = $(this).data('name');

            console.log(id);
            console.log(pname);
            event.stopPropagation();
            $modal.load('<?php echo site_url('admin/add_Category');?>', {id: id,pname:pname},
            function(){
            /*$('.modal').replaceWith('');*/
            $modal.modal('show');

            });
        });
        
        //delete 
        $('.delete_team_mem').on('click',function(event){ 
          
            var id = $(this).data('id');
             alertify.confirm("Do you want to Delete User ?.",
             function(){
              $.ajax({                
                    url: "<?php echo base_url();?>admin/delete_data/users",
                    type: "POST",
                    data: {id:id},
                    error:function(request,response){
                        console.log(request);
                    },                  
                    success: function(result){
                        var res = jQuery.parseJSON(result);
                        if(res.status='success'){
                            $("#hide"+id).hide();
                            location.reload();
                        }
                        
                    }
              });
              },
          function(){
           // alertify.error('Cancel');
          });
        });               
    </script>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
 