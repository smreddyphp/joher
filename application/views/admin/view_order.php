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
            <li class="breadcrumb-item"><a href="#:" > <?php echo @$page_name; ?></a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h5 class="card-header-text"> <?php echo @$page_name; ?></h5><span>
              <!--<a  href="<?php echo base_url();?>admin/add_hotel" class="btn btn-success fa fa-plus" data-name="<?php echo @$current_page; ?>" style="margin-left:65%">Add </a></span>-->
              <!-- <button class="btn btn-success fa fa-plus add_adds" data-name="<?php echo @$current_page; ?>" style="float: right;">Add </button></span>-->
          </div>
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
                <th>S NO</th>
                <th>Invoice Order</th>
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Category</th>
                <th>Service Price</th>
                <th>Discount</th>
                <th>Total</th>
                 <th>Actions</th>
               <!-- <th>Payment Status</th>-->
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>S NO</th>
                <th>Invoice Order</th>
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Category</th>
                <th>Service Price</th>
                <th>Discount</th>
                <th>Total</th>
                <th>Actions</th>
               <!-- <th>Payment Status</th>-->
              </tr>
              </tfoot>
              <tbody>
                  <?php 
                  //print_r($adds); 
                  $count=1; foreach($adds as $row){ ?>
                    <tr>
                        <th><?=$count++?></th>
                        <th><?=$row['invoice_id']?></th>
                        <th><?php echo $this->db->where('user_id',$row['user_id'])->get('users')->row()->user_name;?></th>
                        <th><?php $email = $this->db->where('user_id',$row['user_id'])->get('users')->row(); if($email){ echo $email->email; }?></th>
                        <th><?php echo $this->db->where('id',$row['category_id'])->get('category_adds')->row()->category_name;?></th>
                        <th><?=$row['service_price']?></th>
                        <th><?=$row['discount']?></th>
                        <th><?=$row['total']?></th>
                        <th>
                            <!--<div class="btn-group btn-group-sm" style="float: none;">
                                 <button type="button" class="btn btn-primary btn-sm waves-effect waves-light add_adds" data-toggle="modal" data-name="<?=$current_page?>" data-target="#add_vehicle" data-id="<?=$row['id']?>" style="float: none;margin: 5px;"> 
                                    <span class="icofont icofont-ui-edit"></span>
                                </button>
                                <button type="button" class="btn btn-primary waves-effect waves-light delete_team_mem" data-id="<?=$row['id']?>" style="float: none;margin: 5px;"> 
                                    <span class="icofont icofont-ui-delete"></span>
                                </button>
                            </div>-->
                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-id="<?=$row['id']?>" style="float: none;margin: 5px; background-color: #2196F3;border-color: #2196F3;color: #fff !important;"> 
                                <i class="icofont icofont-eye m-r-5"></i>
                            </button>
                            
                            <?php if($row['payment_status'] == '1'){ ?> <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-name="agent" data-target="#add_vehicle" data-id="170" style="float: none;margin: 5px;"> 
                                              paid
                                            </button> <?php }else{ ?><button type="button" class="btn btn-primary btn-sm waves-effect waves-light delete_team_mem" data-id="173" style="float: none;margin: 5px;"> 
                                                 Un-paid
                                            </button><?php } ?>
                            
                        </th>
                        
                        <!--<th><?php if($row['payment_status'] == '1'){ ?> <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-name="agent" data-target="#add_vehicle" data-id="170" style="float: none;margin: 5px;"> 
                                              paid
                                            </button> <?php }else{ ?><button type="button" class="btn btn-primary btn-sm waves-effect waves-light delete_team_mem" data-id="173" style="float: none;margin: 5px;"> 
                                                 Un-paid
                                            </button><?php } ?>
                        </th>-->
                    </tr>
                <?php } ?>
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
            $modal.load('<?php echo site_url('admin/agent_add_adds');?>', {id: id,pname:pname},
            function(){
            /*$('.modal').replaceWith('');*/
            $modal.modal('show');

            });
        });
        
        //delete 
        $('.delete_team_mem').on('click',function(event){ 
          
            var id = $(this).data('id');
              $.ajax({                
                    url: "<?php echo base_url();?>admin/delete_data/invoice",
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
        });               
    </script>
 