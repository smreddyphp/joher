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
              <button class="btn btn-success fa fa-plus add_adds" data-toggle="modal"  data-name="<?php echo @$current_page; ?>" style="float: right;">Add </button></span>
          </div>
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
                <th>S NO</th>
                <th>Airlines</th>
                <th>Insert Date</th>
                <th>Update Date</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>S NO</th>
                <th>Airlines</th>
                <th>Insert Date</th>
                <th>Update Date</th>
                <th>Actions</th>
              </tr>
              </tfoot>
              <tbody>
                   <?php 
                      $counter = 1;
           // $adds = [];
                      foreach($class as $key){
                           echo '
                              <tr id="hide'.$key["id"].'">
                                  <td>'.$counter.'</td> 
                                  <td>'.$key["airlines_name"].'</td>
                                  <td>'.$key["insert_date"].'</td>                                       
                                  <td>'.$key["update_date"].'</td>
                                   <td style="white-space: nowrap; width: 1%;">
                                    <div class=" user-toolbar btn-toolbar" style="text-align: left;">
                                        <div class="btn-group btn-group-sm" style="float: none;">
                                           <button class="btn btn-success  add_adds" data-toggle="modal"  data-name="'.$current_page.'" data-id="'.$key["id"].'"  style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span> </button>
                                            <button type="button" class="btn btn-primary waves-effect waves-light delete_team_mem" data-id="'.$key["id"].'" style="float: none;margin: 5px;"> 
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
             alertify.confirm("Do you want to Delete Airlines?.",
            function(){
              $.ajax({                
                    url: "<?php echo base_url();?>admin/delete_data/airline_choice",
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
 