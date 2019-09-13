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
          <div class="card-header"><h5 class="card-header-text">Add/Edit <?php echo @$page_name; ?></h5>
            <span>
               
                <!--<button type="btn btn-success fa fa-plus btn-lg" >Assign Category</button>-->
                <button class="btn btn-success fa fa-plus add_adds" data-name="<?php echo @$current_page; ?>"  style="float: right;">Add </button>
                <button class="btn btn-info fa fa-plus" data-toggle="modal" data-target="#myModal" style="margin-left: 775px;margin-top: -30px;">Category Sequence</button>
            </span>
          </div>
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
                <th>S NO</th>
                <th>Image</th>
                <th>Category Name</th>
                <th>Heading</th>
                <th>Text</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                 <th>S NO</th>
                <th>Image</th>
                <th>Category Name</th>
                <th>Heading</th>
                <th>Text</th>
                <th>Actions</th>
              </tr>
              </tfoot>
              <tbody>
                   <?php 
                      $counter = 1;
                      foreach($adds as $key){
                           echo '
                              <tr id="hide'.$key["id"].'">
                                  <td>'.$counter.'</td> 
                                  <td> <img src="'.base_url().$key["image"].'"  style="width:30%;background-color:gray;"</td>
                                  <td>'.ucwords($key["category_name"]).'</td>
                                  <td>'.ucwords($key["heading_en"]).'</td>                                       
                                  <td>'.ucwords(substr($key["text_en"],0,15)).'...</td>
                                   <td style="white-space: nowrap; width: 1%;">
                                    <div class=" user-toolbar btn-toolbar" style="text-align: left;">
                                        <div class="btn-group btn-group-sm" style="float: none;">
                                            <button type="button" class="btn btn-primary waves-effect waves-light add_adds" data-toggle="modal" data-name="'.$current_page.'" data-target = "#add_vehicle" data-id="'.$key["id"].'"  style="float: none;margin: 5px;"> 
                                                <span class="icofont icofont-ui-edit"></span>
                                            </button>
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
    
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" align="center">Assign Category</h4>
        </div>
        <div class="modal-body">
          <?php 
          //$this->db->order_by("orderType", "asc");
            $result = $this->db->order_by("orderType", "asc")->get('category_adds')->result_array();
            //print_r($result);
            
            
          ?>
            <form id="" novalidate="novalidate"> 
            <?php foreach($result as $row){ ?>
                <div class="form-group row">
                    <div class="col-sm-3"></div>
                    <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label"><?=@$row['category_name']?></label>
                    <div class="col-sm-3">
                        <input class="form-control getId" type="text" data-id = "<?=@$row['id']?>" id = "<?=@$row['id']?>" name="orderBy" value = "<?=@$row['orderType']?>">
                    </div>
                </div>
            <?php } ?>    
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary waves-effect waves-light saveChange">Save changes</button>
        </div>
      </div>
    </div>
  </div>
    
    
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
        
        //getId
        
        //delete 
        $('.delete_team_mem').on('click',function(event){ 
            var id = $(this).data('id');
              $.ajax({                
                    url: "<?php echo base_url();?>admin/delete_data/category_adds",
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
        
        
        //add Order wise 
        $('.saveChange').on('click',function(event){ 
            location.reload()
        }); 
        
        $(document).ready(function() {
          $(".getId").on("keyup",function() {
                    //alert("click bound directly to #test-element");
                    var id = $(this).data('id');
                    var getValue = $('#'+id).val();
                    $.ajax({                
                        url: "<?php echo base_url();?>admin/updateOrderCategory",
                        type: "POST",
                        data: {id:id,getValue:getValue},
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
        
        });
    </script>
 