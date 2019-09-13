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
              <!--<button class="btn btn-success fa fa-plus add_adds" data-name="<?php echo @$current_page; ?>" style="margin-left:65%">Add </button> --> </span>
          </div>
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
                    <th>S NO</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    
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
                    
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                   <?php 
                        //echo "<pre>";
                        //print_r($adds);
                        $counter = 1;
                        foreach($adds as $key){
                            
                            if($key['state'] == 'active')
                            {
                                 $status = '<button type="button" class="btn btn-primary waves-effect waves-light active_inactive" data-name="'.$current_page.'" data-target = "#add_vehicle" data-id="'.$key["user_id"].'"  style="float: none;margin: 5px;"> 
                                                <span class="icofont icofont-ui-active">active</span>
                                        </button>';    
                            }
                            else
                            {
                                $status = '<button type="button" class="btn btn-primary waves-effect waves-light active_inactive" data-name="'.$current_page.'" data-target = "#add_vehicle" data-id="'.$key["user_id"].'"  style="float: none;margin: 5px;"> 
                                                <span class="icofont icofont-ui-active">in-active</span>
                                        </button>';    
                            }
                            
                             
                            
                           echo '
                              <tr id="hide'.$key["user_id"].'">
                                    <td>'.$counter.'</td> 
                                    <td style="width: 10%;"> <img src="'.base_url().$key["image"].'"  style="width:30%;background-color:gray;"</td>
                                    <td>'.ucwords($key["user_name"]).'</td>
                                    <td>'.ucwords($key["email"]).'</td>
                                    <td>'.$key["mobile"].'</td>
                                    
                                    <td>
                                        '.$status.'                                
                                    </td>
                                    <td style="white-space: nowrap; width: 1%;">
                                    <div class=" user-toolbar btn-toolbar" style="text-align: left;">
                                        <div class="btn-group btn-group-sm" style="float: none;">
                                            
                                            <a href = "'.base_url('Admin/user_info/').$key["user_id"].'" class="btn btn-info waves-effect waves-light" data-id="'.$key["user_id"].'" style="float: none;margin: 5px; background-color: #2196F3;border-color: #2196F3;color: #fff !important;"> 
                                                <i class="icofont icofont-eye m-r-5"></i>
                                            </a>
                                            <button type="button" class="btn btn-primary waves-effect waves-light delete_team_mem" data-id="'.$key["user_id"].'" style="float: none;margin: 5px;"> 
                                                <span class="icofont icofont-ui-delete"></span>
                                            </button>
                                            
                                        </div>                                                       
                                    </div>
                                </td>
                              </tr>
                          ';
                          $counter++;
                      }
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
 