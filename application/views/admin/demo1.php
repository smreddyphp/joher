<!-- CONTENT-WRAPPER-->
<style>
  .card-header.level-2 {
  background: orange;
  }
  .card-header.level-2 h5 {
   color:#fff;
}
 .card-header.level {
    background: red;
}
.card-header.level-2 {
    background: orange;
}
.card-header.level-3 {
    background: yellow;
}
.card-header.level h5,.card-header.level-2 h5 {
    color:#fff;
}
.main-header .breadcrumb-title {
    margin-top: 10px;
    margin-bottom: 15px;
}

.nav li{
	width:auto;
}

    
</style>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="main-header">
                    <div class="col-md-6">
                    <h4>View Services</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                    <li class="breadcrumb-item"><a href="javascript:"><i class="icofont icofont-home"></i></a>
                        </li>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:" ></a>
                        </li>
                    </ol>
                    </div>
                    <div class="col-md-6">
            
              <a  href="<?php echo base_url().'admin/view_services/'.$this->uri->segment(3).'/'.$this->uri->segment(4);?>" class="btn btn-success fa fa-print" style="margin-left: 208px;">Print Service</a>&nbsp;&nbsp;
              <a  href="<?php echo $this->uri->segment(4);?>" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#servicemodal" style="float:right;">Add Service</a>
                    </div>
        <!--view services-->

        <div class="modal" id="servicemodal">
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
                    <?php 
                        $id = $this->uri->segment(3);
                        $trip_id = $this->uri->segment(4);
                    ?>
                    <li><a href = "<?php echo base_url()?>/admin/add_hotel/<?=$id?>/<?=$id?>/<?=$trip_id?>">Hotel</a></li>  
                    <li><a href = "<?php echo base_url()?>/admin/add_air_train/<?=$id?>/<?=$id?>/<?=$trip_id?>">Air/Train</a></li>
                    <li><a href = "<?php echo base_url()?>/admin/add_aircraft/<?=$id?>/<?=$id?>/<?=$trip_id?>">Aircraft</a></li>
                    <li><a href = "<?php echo base_url()?>/admin/add_car_driver_security/<?=$id?>/<?=$id?>/<?=$trip_id?>">Car/Driver/Security</a></li>
                    <li><a href = "<?php echo base_url()?>/admin/add_boat/<?=$id?>/<?=$id?>/<?=$trip_id?>">Boat</a></li>
                    <li><a href = "<?php echo base_url()?>/admin/add_company_fees/<?=$id?>/<?=$id?>/<?=$trip_id?>">Company Fees</a></li>
                    <li><a href = "<?php echo base_url()?>/admin/add_cruise/<?=$id?>/<?=$id?>/<?=$trip_id?>">Cruise</a></li>
                    <li><a href = "<?php echo base_url()?>/admin/add_cargo_package/<?=$id?>/<?=$id?>/<?=$trip_id?>">Cargo Package</a></li>
                    <li><a href = "<?php echo base_url()?>/admin/add_crm_event/<?=$id?>/<?=$id?>/<?=$trip_id?>">Events</a></li>
                    <li><a href = "<?php echo base_url()?>/admin/add_miscellaneous/<?=$id?>/<?=$id?>/<?=$trip_id?>">Miscellaneous</a></li>
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

            <!-- Header end -->
              <div class="row">
              <!-- start col-lg-9 -->
              <div class="col-xl-12 col-lg-12">
                  <!-- Nav tabs -->
                  <div class="tab-header">
                      <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist"> 
<?php 
			$counter=0;
            $counter1=0;
             
             //print_r($adds);
             
             if(!empty($adds))
             {       
                    $acive = ($counter==0)?"active":'';
                    $counter1 = 1;
                        echo '<li class="nav-item">
                              <a  class="nav-link " data-toggle="tab" href="#tab1" role="tab"><i> Hotel/Villa/Apartment </i></a>
                              <div class="slide"></div>
                         </li>';
				    $counter++;
             }
             
             //print_r($train);
             
             if(!empty($train))
             {  $counter1 = 1;
                  $acive = ($counter==0)?"active":''; 
              echo '<li class="nav-item">
                    <a  class="nav-link " data-toggle="tab" href="#tab2" role="tab"><i> Air/ Train </i></a>
                    <div class="slide"></div>
                  </li>';
				  $counter++;
            }  
            if(!empty($craft))
            {    $counter1 = 1;
                $acive = ($counter==0)?"active":''; 
              echo '<li class="nav-item">
                  <a  class="nav-link " data-toggle="tab" href="#tab3" role="tab"><i> Air Craft </i></a>
                  <div class="slide"></div>
                  </li>';
				  $counter++;
             } 
			 if(!empty($boat))
            {   $acive = ($counter==0)?"active":''; 
              echo '<li class="nav-item">
                  <a  class="nav-link " data-toggle="tab" href="#tab4" role="tab"><i> Boat </i></a>
                  <div class="slide"></div>
                  </li>';
				  $counter++;
             } 
			 if(!empty($cargo))
            {   $acive = ($counter==0)?"active":''; 
              echo '<li class="nav-item">
                  <a  class="nav-link " data-toggle="tab" href="#tab5" role="tab"><i> Cargo Package</i></a>
                  <div class="slide"></div>
                  </li>';
				  $counter++;
             } 
             
            //print_r($driver);
             
			 if(!empty($driver))
            {  $acive = ($counter==0)?"active":''; 
              echo '<li class="nav-item">
                  <a  class="nav-link " data-toggle="tab" href="#tab6" role="tab"><i> Car/Driver/Security </i></a>
                  <div class="slide"></div>
                  </li>';
				  				  $counter++;
             } 
			 if(!empty($cruise))
            {  $acive = ($counter==0)?"active":''; 
              echo '<li class="nav-item">
                  <a  class="nav-link " data-toggle="tab" href="#tab7" role="tab"><i> Cruise </i></a>
                  <div class="slide"></div>
                  </li>';
				  				  $counter++;
             } 
			 if(!empty($event))
            {  $acive = ($counter==0)?"active":''; 
              echo '<li class="nav-item">
                  <a  class="nav-link " data-toggle="tab" href="#tab8" role="tab"><i> Event </i></a>
                  <div class="slide"></div>
                  </li>';
				  				  $counter++;
             } 
			 if(!empty($company_fees))
            {  $acive = ($counter==0)?"active":''; 
              echo '<li class="nav-item">
                  <a  class="nav-link " data-toggle="tab" href="#tab9" role="tab"><i> Company Fees </i></a>
                  <div class="slide"></div>
                  </li>';
				  				  $counter++;
             } 
			 if(!empty($miscellaneous))
            {  $acive = ($counter==0)?"active":''; 
              echo '<li class="nav-item">
                  <a  class="nav-link " data-toggle="tab" href="#tab10" role="tab"><i> Miscellaneous </i></a>
                  <div class="slide"></div>
                  </li>';
				  				  $counter++;
             } 
			
           
             ?>    
             
<?php //echo'<pre>';
//print_r($event);exit;?>

                  </ul>
                    </div>
                    <!-- end of tab-header -->

                    <div class="tab-content">
                            <!-- end of row -->
           <?php   $counter21=0; ?>
           
            <div class="tab-pane fade " id="tab1" role="tabpane">
                 
                    <div class="card">
                    <div class="card-block">
                                    <!-- end of view-info -->
                    <div class="edit-info">
                    <div class="row">
                    
                    <?php
                    $user_id = $this->uri->segment(3);
                    $adds_level3 = $this->db->get_where('hotel_vila_apartment',array('urgency_level'=>'3','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
                    
                    //print_r($adds_level3);
                    
						if($adds_level3 > 0)
						{
                      echo '
                    
                    <div class="col-sm-12">
                    <div class="card">
                    
                   <div class="card-header level"><h5 class="card-header-text"> level 3 </h5><span>
            <!--  <a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a>--></span>
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">              
              <thead>
              	<tr>
                <th>Req</th>
                <th>Status</th>               
                <th>Locations </th>
                <th>Type</th>
                <th>Details</th>
                <th>Qty</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>                
                <th>Urgency</th> 
                <th>Client Name</th>    
              </tr>
              </thead>
              <tfoot>
               <tr>
                 <th>Req</th>
                <th>Status</th>               
                <th>Locations </th>
                <th>Type</th>
                <th>Details</th>
                <th>Qty</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>                
                <th>Urgency</th> 
                <th>Client Name</th>    
                  
              </tr>
              </tfoot>
              <tbody>';
			  
			  
              $count=1;			
              foreach($adds as $key=>$row)
              {
				  
                if($adds[$key]['urgency_level'] == 3)
                {
                  echo '
                  <tr id="hide'.$adds[$key]["id"].'"><td>'.$count++.'</td>
                  <td>'.$adds[$key]['status_b'].'</td>
                  <td>'.$adds[$key]['location'].'</td>
                  <td>'.$adds[$key]['service_type'].'</td>
                  <td>'.$adds[$key]['room_type'].'</td>
                  <td>'.$adds[$key]['quantity'].'</td>
                  <td>'.$adds[$key]['from'].'</td>
                  <td>'.$adds[$key]['to'].'</td>
				  <td>'.$adds[$key]['supplier_name'].'</td>
				   <td>'.$row['urgency_level'].'</td>
                  <td>'.@$res=$this->db->get_where('users',array('user_id'=>$adds[$key]['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
           
         echo '</tbody>
            </table>
          </div>
        </div>
      </div>';
      }    
      
	  $adds_level2 = $this->db->get_where('hotel_vila_apartment',array('urgency_level'=>'2','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();
	 // print_r($adds_level2);exit;
	 //echo $this->db->last_query();exit;
	if($adds_level2 > 0)
	{
    echo '<div class="col-sm-12">
        <div class="card">

<div class="card-header level-2"><h5 class="card-header-text"> level 2</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
                <thead>
              	<tr>
                <th>Req</th>
                <th>Status</th>               
                <th>Locations </th>
                <th>Type</th>
                <th>Details</th>
                <th>Qty</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>                
                <th>Urgency</th> 
                <th>Client Name</th>    
              </tr>
              </thead>
              <tfoot>
               <tr>
                 <th>Req</th>
                <th>Status</th>               
                <th>Locations </th>
                <th>Type</th>
                <th>Details</th>
                <th>Qty</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>                
                <th>Urgency</th> 
                <th>Client Name</th>    
                  
              </tr>
              </tfoot>
              <tbody>';
			  
			  
              $count=1;			
              foreach($adds as $key=>$row)
              {
				  
                if($adds[$key]['urgency_level'] == 2)
                {
                  echo '
                  <tr id="hide'.$adds[$key]["id"].'"><td>'.$count++.'</td>
                  <td>'.$adds[$key]['status_b'].'</td>
                  <td>'.$adds[$key]['location'].'</td>
                  <td>'.$adds[$key]['service_type'].'</td>
                  <td>'.$adds[$key]['room_type'].'</td>
                  <td>'.$adds[$key]['quantity'].'</td>
                  <td>'.$adds[$key]['from'].'</td>
                  <td>'.$adds[$key]['to'].'</td>
				  <td>'.$adds[$key]['supplier_name'].'</td>
				   <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$adds[$key]['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
           
        echo ' </tbody>
            </table>
          </div>
        </div>
      </div>';
	}
	
	$adds_level1 = $this->db->get_where('hotel_vila_apartment',array('urgency_level'=>'1','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
	
						if($adds_level1 > 0)
						{
                      echo ' <div class="col-sm-12">
        <div class="card">
 <div class="card-header level-3"><h5 class="card-header-text"> level 1</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
                 <thead>
              	<tr>
                <th>Req</th>
                <th>Status</th>               
                <th>Locations </th>
                <th>Type</th>
                <th>Details</th>
                <th>Qty</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>                
                <th>Urgency</th> 
                <th>Client Name</th>    
              </tr>
              </thead>
              <tfoot>
               <tr>
                 <th>Req</th>
                <th>Status</th>               
                <th>Locations </th>
                <th>Type</th>
                <th>Details</th>
                <th>Qty</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>                
                <th>Urgency</th> 
                <th>Client Name</th>    
                  
              </tr>
              </tfoot>
              <tbody>';
			 		
              $count=1;			
              foreach($adds as $row)
              {
				  
                if($row['urgency_level'] == 1)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                  <td>'.$row['status_b'].'</td>
                  <td>'.$row['location'].'</td>
                  <td>'.$row['service_type'].'</td>
                  <td>'.$row['room_type'].'</td>
                  <td>'.$row['quantity'].'</td>
                  <td>'.$row['from'].'</td>
                  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
          
         echo '</tbody>
              </table>
            </div>
            </div>
            </div>';
						}
						?>
            </div>
<!-- end of row -->
          </div>
  <!-- end of view-info -->
          </div>
          </div>
          </div><!--tab 1 ending-->
          <?php
           if(!empty($train))
             {  
                 $acive1 = ($counter21==0)?"active in":''; ?>
            <div class="tab-pane fade  <?=$acive1?>" id="tab2" role="tabpane">
                    <?php $counter1++;?>
                    <div class="card">
                    <div class="card-block">
                                    <!-- end of view-info -->
                    <div class="edit-info">
                   <div class="row">
             <?php
                $train_level3 = $this->db->get_where('air_train',array('urgency_level'=>'3','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($train_level3 >0)
						{
                      echo '   
                   
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header level"><h5 class="card-header-text"> level 3 </h5><span>
            <!--  <a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a>--></span>
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
              <tr>
                 <th>Req</th>
                  <th>Status</th>
                  <th>Passenger Name </th>
                  <th>Type</th>
                  <th>Details</th>
                  <th>Route</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Passenger Name</th>
                <th>Type</th>
                <th>Details</th>
                <th>Route</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </tfoot>
              <tbody>';
			
			
			  $count =1;
              foreach($train as $row)
              {
                if($row['urgency_level']==3)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                 
				  <td>'.$row['status_b'].'</td>
				  <td>'.$row['passener_name'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['train'].'</td>
				  <td>'.$row['route'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
        
        echo '</tbody>
            </table>
          </div>
        </div>
      </div>';  
	}
	
      $train_level2 = $this->db->get_where('air_train',array('urgency_level'=>'2','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();	
	 // echo $this->db->last_query();exit;				
						if($train_level2 > 0)
						{
                      echo '
          
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-2"><h5 class="card-header-text"> level 2</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
              <tr>
                 <th>Req</th>
                  <th>Status</th>
                  <th>Passenger Name </th>
                  <th>Type</th>
                  <th>Details</th>
                  <th>Route</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Passenger Name</th>
                <th>Type</th>
                <th>Details</th>
                <th>Route</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </tfoot>    
              <tbody>';
              //print_r($train);exit;
              $count =1;
              foreach($train as $row)
              {
                if($row['urgency_level']==2)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                  
				  <td>'.$row['status_b'].'</td>
				  <td>'.$row['passener_name'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['train'].'</td>
				  <td>'.$row['route'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
			  
			  
              
            echo '   </tbody>
            </table>
          </div>
        </div>
      </div>';
		}
      $train_level1 = $this->db->get_where('air_train',array('urgency_level'=>'1','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($train_level1 >0)
						{
                      echo '
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-3"><h5 class="card-header-text"> level 1</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
              <tr>
                 <th>Req</th>
                  <th>Status</th>
                  <th>Passenger Name </th>
                  <th>Type</th>
                  <th>Details</th>
                  <th>Route</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Passenger Name</th>
                <th>Type</th>
                <th>Details</th>
                <th>Route</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </tfoot>
              <tbody>';
              
			  $count =1;
              foreach($train as $row)
              {
                if($row['urgency_level']==1)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                 
				  <td>'.$row['status_b'].'</td>
				  <td>'.$row['passener_name'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['train'].'</td>
				  <td>'.$row['route'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
          <td>'.@$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }              
			  
              echo'</tbody>
              </table>
            </div>
            </div>
            </div>';
            
            }
            ?>
            </div>
<!-- end of row -->
          </div>
  <!-- end of view-info -->
          </div>
          </div>
          </div>
            <?php    $counter21++; } ?> 
            
          
            <div class="tab-pane fade " id="tab3" role="tabpane">
               <?php $counter1++;?>
                    <div class="card">
                    <div class="card-block">
       <!-- end of view-info -->
                    <div class="edit-info">
                    <div class="row">
                <?php
				$craft_level3 = $this->db->get_where('air_craft',array('urgency_level'=>'3','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($craft_level3 >0)
						{
                      echo '
                
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header level"><h5 class="card-header-text"> level 3 </h5><span>
            <!--  <a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a>--></span>
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
              <tr>
              <th>Req</th>
              <th>Status</th>
              <th>Type </th>
              <th>Details</th>
              <th>Tail No</th>
              <th>Route</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
              <th>Req</th>
              <th>Status</th>
              <th>Type </th>
              <th>Details</th>
              <th>Tail No</th>
              <th>Route</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>

              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
             
              </tfoot>
              <tbody>';
              
			  $count=1;
              foreach($craft as $row)
              {
                if($row['urgency_level']==3)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                
				  <td>'.$row['status_b'].'</td>
				 
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['aircraft_type'].'</td>
				  <td>'.$row['aircraft_tail_no'].'</td>
				  <td>'.$row['route'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
         
         echo '</tbody>
            </table>
          </div>
        </div>
      </div>';
		}
		
		$craft_level2 = $this->db->get_where('air_craft',array('urgency_level'=>'2','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($craft_level2 >0)
						{
                      echo '
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-2"><h5 class="card-header-text"> level 2</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
              <th>Req</th>
              <th>Status</th>
              <th>Type </th>
              <th>Details</th>
              <th>Tail No</th>
              <th>Route</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
              <th>Req</th>
              <th>Status</th>
              <th>Type </th>
              <th>Details</th>
              <th>Tail No</th>
              <th>Route</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </tfoot>
              <tbody>';
              
			   $count=1;
              foreach($craft as $row)
              {
                if($row['urgency_level']==2)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
               
				  <td>'.$row['status_b'].'</td>
				  
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['aircraft_type'].'</td>
				  <td>'.$row['aircraft_tail_no'].'</td>
				  <td>'.$row['route'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
              
			  
              echo '</tbody>
            </table>
          </div>
        </div>
      </div>';
		}
		
		$craft_level1 = $this->db->get_where('air_craft',array('urgency_level'=>'1','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($craft_level1 >0)
						{
                      echo '
      
      
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-3"><h5 class="card-header-text"> level 1</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
              <th>Req</th>
              <th>Status</th>
              <th>Type </th>
              <th>Details</th>
              <th>Tail No</th>
              <th>Route</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
              <th>Req</th>
              <th>Status</th>
              <th>Type </th>
              <th>Details</th>
              <th>Tail No</th>
              <th>Route</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </tfoot>
              <tbody>';
              
			   $count=1;
              foreach($craft as $row)
              {
                if($row['urgency_level']==1)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                
				  <td>'.$row['status_b'].'</td>
				  
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['aircraft_type'].'</td>
				  <td>'.$row['aircraft_tail_no'].'</td>
				  <td>'.$row['route'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
              
			echo'
              </tbody>
              </table>
            </div>
            </div>
            </div>';
						}
						?>
            </div>
<!-- end of row -->
          </div>
  <!-- end of view-info -->
          </div>
          </div>
          </div>
          
          
          
            <div class="tab-pane fade " id="tab4" role="tabpane">
                    <div class="card">
                    <div class="card-block">
                                    <!-- end of view-info -->
                    <div class="edit-info">
                    <div class="row">
             <?php
			 $boat_level3 = $this->db->get_where('boat',array('urgency_level'=>'3','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($boat_level3 >0)
						{
                      echo '     
                    
                    
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header level"><h5 class="card-header-text"> level 3 </h5><span>
            <!--  <a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a>--></span>
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
              <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>Route</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
                
              </tr>
              </thead>
              <tfoot>
               <tr>
                 <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>Route</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>              
              </tfoot>
              <tbody>';
              
			  $count=1;
              foreach($boat as $row)
              {
                if($row['urgency_level']==3)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                   
                  <td>'.$row['status_b'].'</td>
                  <td>'.$row['service_type'].'</td>
                  <td>'.$row['boat_details'].'</td>
                  <td>'.$row['route'].'</td>
                  <td>'.$row['from'].'</td>
                  <td>'.$row['to'].'</td>
                  <td>'.$row['supplier_name'].'</td>                  
                  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
        echo
         '</tbody>
            </table>
          </div>
        </div>
      </div>';
	}
	
	 $boat_level2 = $this->db->get_where('boat',array('urgency_level'=>'2','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();	

						if($boat_level2 >0)
						{
                      echo '       
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-2"><h5 class="card-header-text"> level 2</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
              <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>Route</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
                
              </tr>
              </thead>
              <tfoot>
               <tr>
                 <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>Route</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </tfoot>  
              <tbody>';
              
			   $count=1;
              foreach($boat as $row)
              {
                if($row['urgency_level']==2)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                  
                  <td>'.$row['status_b'].'</td>
                  <td>'.$row['service_type'].'</td>
                  <td>'.$row['boat_details'].'</td>
                  <td>'.$row['route'].'</td>
                  <td>'.$row['from'].'</td>
                  <td>'.$row['to'].'</td>
                  <td>'.$row['supplier_name'].'</td>                  
                  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
			  
			  
              
              echo '</tbody>
            </table>
          </div>
        </div>
      </div>';
		}
      
       $boat_level1 = $this->db->get_where('boat',array('urgency_level'=>'1','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($boat_level1 >0)
						{
                      echo '       
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-3"><h5 class="card-header-text"> level 1</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>Route</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
                
              </tr>
              </thead>
              <tfoot>
               <tr>
                 <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>Route</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </tfoot>
              <tbody>';
			  
			   $count=1;
              foreach($boat as $row)
              {
                if($row['urgency_level']==1)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                   
                  <td>'.$row['status_b'].'</td>
                  <td>'.$row['service_type'].'</td>
                  <td>'.$row['boat_details'].'</td>
                  <td>'.$row['route'].'</td>
                  <td>'.$row['from'].'</td>
                  <td>'.$row['to'].'</td>
                  <td>'.$row['supplier_name'].'</td>                  
                  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
              
			  
              echo '</tbody>
              </table>
            </div>
            </div>
            </div>';
						}
						?>
            </div>
<!-- end of row -->
          </div>
  <!-- end of view-info -->
          </div>
          </div>
          </div>
          
          <?php 
            if(!empty($cargo))
            {   $acive1 = ($counter21==0)?"active in":'';
          ?>
            <div class="tab-pane fade <?=$acive1?>" id="tab5" role="tabpane">
                    <div class="card">
                    <div class="card-block">
                                    <!-- end of view-info -->
                    <div class="edit-info">
                    <div class="row">
              <?php
			    $cargo_level3 = $this->db->get_where('cargo',array('urgency_level'=>'3','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($cargo_level3 >0)
						{
                      echo '            
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header level"><h5 class="card-header-text"> level 3 </h5><span>
            <!--  <a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a>--></span>
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
              <tr>
               <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
                
              </tr>
              </tfoot>
              <tbody>';
              
			  $count=1;
              foreach($cargo as $row)
              {
                if($row['urgency_level']==3)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                  
				  <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td> 
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
         
         echo '</tbody>
            </table>
          </div>
        </div>
      </div> ';
						}
						 $cargo_level2 = $this->db->get_where('cargo',array('urgency_level'=>'2','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($cargo_level2>0)
						{
                      echo '       
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-2"><h5 class="card-header-text"> level 2</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
               <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
                
              </tr>
              </tfoot>  
              <tbody>';
              
			   $count=1;
              foreach($cargo as $row)
              {
                if($row['urgency_level']==2)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                  
				  <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td> 
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
              
			 echo '
              </tbody>
            </table>
          </div>
        </div>
      </div>';
						}
						
		 $cargo_level1 = $this->db->get_where('cargo',array('urgency_level'=>'1','trip_id'=>$trip_id))->num_rows();					
						if($cargo_level1 >0)
						{
                      echo '       				
      
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-3"><h5 class="card-header-text"> level 1</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
              <tr>
               <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
                
              </tr>
              </tfoot>
              <tbody>';
              
			   $count=1;
              foreach($cargo as $row)
              {
                if($row['urgency_level']==1)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                  
				  <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td> 
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
              
			 echo '
              </tbody>
              </table>
            </div>
            </div>
            </div>';
						}
						?>
            </div>
<!-- end of row -->
          </div>
  <!-- end of view-info -->
          </div>
          </div>
          </div>
          
         <?php    $counter21++; } ?> 
         
            <div class="tab-pane fade " id="tab6" role="tabpane">
                    <div class="card">
                    <div class="card-block">
                                    <!-- end of view-info -->
                    <div class="edit-info">
                    <div class="row">
                    
                <?php
				 $driver_level3 = $this->db->get_where('driver_security',array('urgency_level'=>'3','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($driver_level3 > 0)
						{
                      echo '    
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header level"><h5 class="card-header-text"> level 3 </h5><span>
            <!--  <a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a>--></span>
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
               <th>Req</th>
              <th>Status</th>
              <th>Location</th>
              <th>Type </th>
              <th>Details</th>
              <th>Qty</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </thead>

              <tfoot>
               <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Location</th>
                <th>Type </th>
                <th>Details</th>
                <th>Qty</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
               </tr>
              </tfoot>
              <tbody>';
              
			  $count=1;
              foreach($driver as $row)
              {
                if($row['urgency_level']==3)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                   
                  <td>'.$row['status_b'].'</td>
                  <td>'.$row['location'].'</td>
                  <td>'.$row['service_type'].'</td>
                  <td>'.$row['car_type'].'</td>
                  <td>'.$row['quantity'].'</td>
                  <td>'.$row['from'].'</td>
                  <td>'.$row['to'].'</td>
                  <td>'.$row['supplier_name'].'</td>
                  <td>'.$row['urgency_level'].'</td>
                  <td>'.@$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
        echo '
         </tbody>
            </table>
          </div>
        </div>
      </div> ';
						}
						
		$driver_level2 = $this->db->get_where('driver_security',array('urgency_level'=>'2','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($driver_level2 >0)
						{
                      echo '    				
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-2"><h5 class="card-header-text"> level 2</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
              <tr>
               <th>Req</th>
              <th>Status</th>
              <th>Location</th>
              <th>Type </th>
              <th>Details</th>
              <th>Qty</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Location</th>
                <th>Type </th>
                <th>Details</th>
                <th>Qty</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
               </tr>
              </tfoot>     
              <tbody>';
			  
			   $count=1;
              foreach($driver as $row)
              {
                if($row['urgency_level']==2)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                   
                  <td>'.$row['status_b'].'</td>
                  <td>'.$row['location'].'</td>
                  <td>'.$row['service_type'].'</td>
                  <td>'.$row['car_type'].'</td>
                  <td>'.$row['quantity'].'</td>
                  <td>'.$row['from'].'</td>
                  <td>'.$row['to'].'</td>
                  <td>'.$row['supplier_name'].'</td>
                  <td>'.$row['urgency_level'].'</td>
                  <td>'.@$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
			  
			 echo '           </tbody>
            </table>
          </div>
        </div>
      </div>';
						}
      
      $driver_level1 = $this->db->get_where('driver_security',array('urgency_level'=>'1','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($driver_level1 >0)
						{
                      echo '    
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-3"><h5 class="card-header-text"> level 1</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
              <tr>
               <th>Req</th>
              <th>Status</th>
              <th>Location</th>
              <th>Type </th>
              <th>Details</th>
              <th>Qty</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Location</th>
                <th>Type </th>
                <th>Details</th>
                <th>Qty</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
               </tr>
              </tfoot>
              <tbody>';
              			  
			   $count=1;
              foreach($driver as $row)
              {
                if($row['urgency_level']==1)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                  
                  <td>'.$row['status_b'].'</td>
                  <td>'.$row['location'].'</td>
                  <td>'.$row['service_type'].'</td>
                  <td>'.$row['car_type'].'</td>
                  <td>'.$row['quantity'].'</td>
                  <td>'.$row['from'].'</td>
                  <td>'.$row['to'].'</td>
                  <td>'.$row['supplier_name'].'</td>
                  <td>'.$row['urgency_level'].'</td>
                  <td>'.@$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
              
			  echo '
              </tbody>
              </table>
            </div>
            </div>
            </div>';
						}
						?>
            </div>
<!-- end of row -->
          </div>
  <!-- end of view-info -->
          </div>
          </div>
          </div>
          
           <div class="tab-pane fade " id="tab7" role="tabpane">
                    <div class="card">
                    <div class="card-block">
                                    <!-- end of view-info -->
                    <div class="edit-info">
                    <div class="row">
                <?php    
                 $cruise_level3 = $this->db->get_where('cruise',array('urgency_level'=>'3','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($cruise_level3 >0)
						{
                      echo '       
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header level"><h5 class="card-header-text"> level 3 </h5><span>
            <!--  <a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a>--></span>
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
               <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </tfoot>
              <tbody>';
              
			  $count=1;
              foreach($cruise as $row)
              {
                if($row['urgency_level']==3)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>                  
				  <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
       echo '
       </tbody>
            </table>
          </div>
        </div>
      </div>';
						}
	   $cruise_level2 = $this->db->get_where('cruise',array('urgency_level'=>'2','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($cruise_level2 >0)
						{
                      echo '           
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-2"><h5 class="card-header-text"> level 2</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
               <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </tfoot>    
              <tbody>';
              
			  
			   $count=1;
              foreach($cruise as $row)
              {
                if($row['urgency_level']==2)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>                  
				  <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
              
			  echo '
              </tbody>
            </table>
          </div>
        </div>
      </div>';
						}
      
	   $cruise_level1 = $this->db->get_where('cruise',array('urgency_level'=>'1','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($cruise_level1 >0)
						{
                      echo '     
      
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-3"><h5 class="card-header-text"> level 1</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
               <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                <th>Req</th>
                <th>Status</th>
                <th>Type </th>
                <th>Details</th>
                <th>From</th>
                <th>To</th>
                <th>Supplier Name</th>
                <th>Urgency</th>
                <th>Client Name</th>
              </tr>
              </tfoot>
              <tbody>';
              
			   $count=1;
              foreach($cruise as $row)
              {
                if($row['urgency_level']==1)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>                  
				  <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
              
			  echo '
              </tbody>
              </table>
            </div>
            </div>
            </div>';
						}
          ?>
            </div>
<!-- end of row -->
          </div>
  <!-- end of view-info -->
          </div>
          </div>
          </div>
          
           <div class="tab-pane fade " id="tab8" role="tabpane">
                    <div class="card">
                    <div class="card-block">
                                    <!-- end of view-info -->
                    <div class="edit-info">
                    <div class="row">
                    
                    <?php
					 $event_level3 = $this->db->get_where('crm_event',array('urgency_level'=>'3','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($event_level3 >0)
						{
                      echo '     
					
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header level"><h5 class="card-header-text"> level 3 </h5><span>
            <!--  <a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a>--></span>
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
               <tr>
                 <th>Req</th>
                  <th>Status</th>
                  <th>Event </th>
                  <th>Details</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                  <th>Req</th>
                  <th>Status</th>
                  <th>Event </th>
                  <th>Details</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
                 
              </tr>
              </tfoot>
              <tbody>';
              
			  $count=1;
              foreach($event as $row)
              {
                if($row['urgency_level']==3)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
				  <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
echo '
         </tbody>
            </table>
          </div>
        </div>
      </div>';
			}
			
 $event_level2 = $this->db->get_where('crm_event',array('urgency_level'=>'2','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($event_level2 >0)
						{
                      echo '     						
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-2"><h5 class="card-header-text"> level 2</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
               <tr>
                 <th>Req</th>
                  <th>Status</th>
                  <th>Event </th>
                  <th>Details</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                  <th>Req</th>
                  <th>Status</th>
                  <th>Event </th>
                  <th>Details</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
                 
              </tr>
              </tfoot>
              <tbody>';
              
			   $count=1;
              foreach($event as $row)
              {
                if($row['urgency_level']==2)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
				  <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
			  
			  echo '  </tbody>
            </table>
          </div>
        </div>
      </div>';
						}
						
						 $event_level1 = $this->db->get_where('crm_event',array('urgency_level'=>'1','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($event_level1 >0)
						{
                      echo '     
      
      
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-3"><h5 class="card-header-text"> level 1</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
               <tr>
                 <th>Req</th>
                  <th>Status</th>
                  <th>Event </th>
                  <th>Details</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                  <th>Req</th>
                  <th>Status</th>
                  <th>Event </th>
                  <th>Details</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
                 
              </tr>
              </tfoot>
              <tbody>';
              
			   $count=1;
              foreach($event as $row)
              {
                if($row['urgency_level']==1)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
				  <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
              
			  echo '
              </tbody>
              </table>
            </div>
            </div>
            </div>';
						}
						?>
            </div>
<!-- end of row -->
          </div>
  <!-- end of view-info -->
          </div>
          </div>
          </div>
          
           <div class="tab-pane fade " id="tab9" role="tabpane">
                    <div class="card">
                    <div class="card-block">
                                    <!-- end of view-info -->
                    <div class="edit-info">
                    <div class="row">
                    <?php
					 $company_level3 = $this->db->get_where('company_fees',array('urgency_level'=>'3','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($company_level3 >0)
						{
                      echo '     
					
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header level"><h5 class="card-header-text"> level 3 </h5><span>
            <!--  <a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a>--></span>
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             	<thead>
              <tr>
               <th>Req</th>
              <th>Status</th>
              <th>Type </th>
              <th>Details</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
              <th>Req</th>
              <th>Status</th>
              <th>Type </th>
              <th>Details</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </tfoot>
              <tbody>';
              
			  $count=1;
              foreach($company_fees as $row)
              {
                if($row['urgency_level']==3)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                  <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
         echo '
         </tbody>
            </table>
          </div>
        </div>
      </div>';
						}
						
	$company_level2 = $this->db->get_where('company_fees',array('urgency_level'=>'2','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($company_level2 >0)
						{
                      echo '     

      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-2"><h5 class="card-header-text"> level 2</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
              	<thead>
              <tr>
               <th>Req</th>
              <th>Status</th>
              <th>Type </th>
              <th>Details</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
              <th>Req</th>
              <th>Status</th>
              <th>Type </th>
              <th>Details</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </tfoot> 
              <tbody>';
              
			   $count=1;
              foreach($company_fees as $row)
              {
                if($row['urgency_level']==2)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                  <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
			  
			  echo '
               </tbody>
            </table>
          </div>
        </div>
      </div>';
						}
						
					$company_level1 = $this->db->get_where('company_fees',array('urgency_level'=>'1','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($company_level1 >0)
						{
                      echo '     

      
      
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-3"><h5 class="card-header-text"> level 1</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
              	<thead>
              <tr>
               <th>Req</th>
              <th>Status</th>
              <th>Type </th>
              <th>Details</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
              <th>Req</th>
              <th>Status</th>
              <th>Type </th>
              <th>Details</th>
              <th>From</th>
              <th>To</th>
              <th>Supplier Name</th>
              <th>Urgency</th>
              <th>Client Name</th>
              </tr>
              </tfoot>
              <tbody>';
              
			   $count=1;
              foreach($company_fees as $row)
              {
                if($row['urgency_level']==1)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                  <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
              
echo '
            </tbody>
              </table>
            </div>
            </div>
            </div>';
						}
						?>
            </div>
<!-- end of row -->
          </div>
  <!-- end of view-info -->
          </div>
          </div>
          </div>
          
           <div class="tab-pane fade " id="tab10" role="tabpane">
                    <div class="card">
                    <div class="card-block">
                                    <!-- end of view-info -->
                    <div class="edit-info">
                    <div class="row">
                    
              <?php
			  $miscellaneous_level3 = $this->db->get_where('miscellaneous',array('urgency_level'=>'3','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($miscellaneous_level3 >0)
						{
                      echo '  
			        
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header level"><h5 class="card-header-text"> level 3 </h5><span>
            <!--  <a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a>--></span>
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
              <tr>
                  <th>Req</th>
                  <th>Status</th>
                  <th>Type </th>
                  <th>Details</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                 <th>Req</th>
                  <th>Status</th>
                  <th>Type </th>
                  <th>Details</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
	              </tr>
	              </tfoot>
              <tbody>';
              
			  $count=1;
              foreach($miscellaneous as $row)
              {
                if($row['urgency_level']==3)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                 <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
echo '
        </tbody>
            </table>
          </div>
        </div>
      </div>';
						}
						
						$miscellaneous_level2 = $this->db->get_where('miscellaneous',array('urgency_level'=>'2','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($miscellaneous_level2 >0)
						{
                      echo '     

      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-2"><h5 class="card-header-text"> level 2</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
              <thead>
              <tr>
               <th>Req</th>
                  <th>Status</th>
                  <th>Type </th>
                  <th>Details</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                 <th>Req</th>
                  <th>Status</th>
                  <th>Type </th>
                  <th>Details</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
	              </tr>
	              </tfoot>       
              <tbody>';
              
              $count=1;
              foreach($miscellaneous as $row)
              {
                if($row['urgency_level']==2)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                 <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
			  echo '
              </tbody>
            </table>
          </div>
        </div>
      </div>';
						}
						$miscellaneous_level1 = $this->db->get_where('miscellaneous',array('urgency_level'=>'1','user_id'=>$user_id,'trip_id'=>$trip_id))->num_rows();					
						if($miscellaneous_level1 >0)
						{
                      echo '         
      
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-3"><h5 class="card-header-text"> level 1</h5>
             <!-- <span><a  href="http://volive.in/joher_new/admin/add_demo2" class="btn btn-success fa fa-plus" data-name="demo1" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table class="table dt-responsive table-striped table-bordered nowrap">
             <thead>
              <tr>
               <th>Req</th>
                  <th>Status</th>
                  <th>Type </th>
                  <th>Details</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
              </tr>
              </thead>
              <tfoot>
               <tr>
                 <th>Req</th>
                  <th>Status</th>
                  <th>Type </th>
                  <th>Details</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Supplier Name</th>
                  <th>Urgency</th>
                  <th>Client Name</th>
	              </tr>
	              </tfoot>
              <tbody>';
             
              $count=1;
              foreach($miscellaneous as $row)
              {
                if($row['urgency_level']==1)
                {
                  echo '
                  <tr id="hide'.$row["id"].'"><td>'.$count++.'</td>
                 <td>'.$row['status_b'].'</td>
				  <td>'.$row['service_type'].'</td>
				  <td>'.$row['fee_details'].'</td>
				  <td>'.$row['from'].'</td>
				  <td>'.$row['to'].'</td>
				  <td>'.$row['supplier_name'].'</td>
				  <td>'.$row['urgency_level'].'</td>
                  <td>'.$res=$this->db->get_where('users',array('user_id'=>$row['user_id']))->row()->user_name.'</td></tr>

                  ';
                }
              }
        
			  echo '
              </tbody>
              </table>
            </div>
            </div>
            </div>';
						}
						?>
            </div>
<!-- end of row -->
          </div>
  <!-- end of view-info -->
          </div>
          </div>
          </div>


         
  <!-- end of tab-pane -->
                        
    <!-- end of about us tab-pane -->


      
  </div>
  <!-- end of view-info -->
</div>

</div>

</div>
                     
                        <!-- end of tab-pane -->
         
                    </div>
                    <!-- end of main tab content -->
                </div>
            </div>

        </div>

        

        <!-- Container-fluid ends -->
<footer class="f-fix">
    <div class="footer-bg b-t-muted" style="text-align: center;"> Copyrights © 2018 Volivesolutions. All Rights Reserved.
        </div>
     </footer>
    </div>
 <!-- CONTENT-WRAPPER-->
 <script type="text/javascript">
  

    $("#profile_update").validate({       
            rules: {
              "data[first_name]"    : "required",
              "data[gender]"        : "required",
              "data[mobile]"        : "required",
              
            
              
            },
            messages : {
              "data[first_name]"    : "Please Enter your name",
              "data[gender]"        : "Please select gender",
              "data[mobile]"        : "Please Enter your phone number",
            
            },     
    });
    $('.update_profile').on("click",function(event){ 
        event.preventDefault();
        var validator = $("#profile_update").validate();
            validator.form();
            if(validator.form() == true){
                
                var data = new FormData($('#profile_update')[0]);     
                $.ajax({                
                    url: "<?php echo base_url();?>/admin/profile_update",
                    type: "POST",
                    data: data,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData:false,
                    error:function(request,response){
                        console.log(request);
                    },                  
                    success: function(result){
                    var obj = jQuery.parseJSON(result);
                          if (obj.status == 'success') {
                           //alert(obj.message);
                            location.reload();                  
                          } else if (obj.status =='error') {
                            $.notify({
                                    title: '<strong>Hello!</strong>',
                                    message: obj.message
                                  },{
                                    type: 'warning'
                                  });
                          } else {
                            
                          }
                    }
                });
            }
        });


 $(".change_password").click(function(){
      var validator = $("#change_password").validate();
      validator.form();
      if(validator.form() == true)
      {
        
        if($('#password_length').val().length >= 6){
           $('#min_char').css('display','none');
           var data = new FormData($('#change_password')[0]);
           $.ajax({
            url: "<?php echo base_url()?>/admin/update_pwd",
            type: "POST",
            dataType: "html",
            mimeType: "multipart/form-data",
            data: data,
            contentType: false,
            cache: false,
            processData:false,
              success: function(result){
                var obj = jQuery.parseJSON(result);
                  if (obj.status == 'success') {
                   //alert(obj.message);
                    location.reload();                  
                  } else if (obj.status =='error') {
                    $.notify({
                            title: '<strong>Hello!</strong>',
                            message: obj.message
                          },{
                            type: 'warning'
                          });
                  } else {
                    
                  }
            }
     
          });
       
        }else{
            $('#min_char').html('Minimum 6 characters required !');
        }
        
      }
      else{
        $('.show_alert').css('display','block');
        $("body,html").animate({scrollTop: 0}, 'slow');
      }
    });



$("#change_password").validate({
      rules: {
          "data[old_pass]"          : "required",
          "data[new_pass]"          : "required",
          "data[confirm_pass]"      : {required:true,equalTo:'[name="data[new_pass]"]'}
        },
        messages : {
          "data[old_pass]"          : "Please Enter Old Password",
          "data[new_pass]"          : "Please Enter New Password",
          "data[confirm_pass]"      : "<p style='color:red;text-align:center;margin-top:10px;'>New Password and Confirm Password should be same !</p>"
        }
    });



 </script>

 <style type="text/css">
     .nav-tabs .slide {
   
    width: calc(100% / <?php if($counter==1){ echo 0;}else{ echo $counter;} ?> );
}
.md-tabs .nav-item {
   
    width: calc(100% / <?php if($counter==1){ echo 0;}else{ echo $counter;} ?>);
}
 .error{
   color:red;
   font-size: 13px;
    }
    li.nav-item.active {
    border-bottom: 3px solid #76b0ae;
}
label.error {
        color: red;
    top: -5px;
}
 </style>}
