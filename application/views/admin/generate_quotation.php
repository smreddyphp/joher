
<style>
 {
   text-transform: capitalize;
    width: 80%;
    margin: 0 auto;
    padding: 30px 15px;
    border: 1px solid #ddd;
    }
  p {
    margin: 0;
    padding: 2px 10px;
}
  
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    border : 2px solid black;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

</style>



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
            <li class="breadcrumb-item"><a href="#:" >Generate Quotation</a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-header-text">Generate Quotation</h5><span>
              <!-- <a  href="<?php //echo base_url();?>admin/add_trip/<?php //echo $this->uri->segment(3);?>" class="btn btn-success fa fa-plus" data-name="<?php //echo @$current_page; ?>" style="float:right;">Add New Trip </a> --></span>
          </div>
          
          <div style="display: flex; align-items: center;">
  <img src="<?php echo base_url();?>assets/images/logo.png" alt="" style="width: auto;height: 100px;display: inline-block;">
  <div>
  <p>Kingdom of saudhi Arabia,Riyadh</p>
  <p>King Of abdul aziz road,ar rabi,riyadh,saudi arabia</p>
  <p>p.b.box 286128 | postal code:11323 </p>
  <p>Tel:+966 11 450 6022/+966 11 450 5066/+966 11 450 5552</p>
  <p>CR:1010401995</p>
  </div>
   
  </div>
  <div style="display: flex;margin-top: 20px;">
    <div style="flex:0 0 70%">
    <p>Name: <?= $user['user_name']?></p>
    <p>A/C:Noura Nya</p>
    <p>city:<?= $user['address']?></p>  
    </div>

    <div style="flex:0 0 30%">
    <p>Date: <?= date('Y-m-d h:i:s');?></p>
    <p>Ref:#493-1062 final Invoice</p>
    <p>period:17 march-05 april 2018</p>
    </div>
  </div>
  <br/>
  <div>
  <table>
  <tr style="background:#B6B2B2">
    <th>Srno</th>
    <th>Description</th>
    <th>Units</th>
  <th>Nbr Nts/Days</th>
  <th>Rate</th>
  <th>Total</th>
  </tr>
  <?php
// print_r($user);exit;
  $i=1;
  if(!empty($adds))
  {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$adds[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
       $total_adds = array();
            foreach($adds as $key=>$value)
            {
               echo '<tr><td></td>
                    <td>'.$adds[$key]['room_desc'].'</td>
                    <td>'.$adds[$key]['unit_rate'].'</td>
                    <td>'.$adds[$key]['day_night'].'</td>
                    <td>'.$adds[$key]['x_rate'].'</td>
                    <td>'.$adds[$key]['markup_net_cost'].'</td>
                    </tr>';    
                    
                array_push($total_adds, $adds[$key]['markup_net_cost']);
            }
            
            $adds_amount = array_sum($total_adds);
           
  }
  else
  {
       $adds_amount = 0;
  }
  
   if(!empty($train))
  {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$train[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
      $total_train=array();
            foreach($train as $key=>$value)
            {
               echo '<tr><td></td>
                   <td>'.$train[$key]['route'].'</td>
                    <td>'.$train[$key]['unit_rate'].'</td>
                    <td></td>
                    <td>'.$train[$key]['x_rate'].'</td>
                    <td>'.$train[$key]['markup_net_cost'].'</td>
                    </tr>'; 
                    
                   array_push($total_train, $train[$key]['markup_net_cost']);    
            }
              $train_amount = array_sum($total_train);
  }
  else
  {
      $train_amount = 0;
  }
  
   if(!empty($craft))
  {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$craft[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
      $total_craft = array();
            foreach($craft as $key=>$value)
            {
               echo '<tr><td></td>
                    <td>'.$craft[$key]['route'].'</td>
                    <td>'.$craft[$key]['unit_rate'].'</td>
                    <td></td>
                    <td>'.$craft[$key]['x_rate'].'</td>
                    <td>'.$craft[$key]['markup_net_cost'].'</td>
                    </tr>';  
                    
                    array_push($total_craft, $craft[$key]['markup_net_cost']);
            }
           
            $craft_amount = array_sum($total_craft);
  }
  else
  {
      $craft_amount = 0;
  }
  
   if(!empty($boat))
  {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$boat[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
      $total_boat = array();
            foreach($boat as $key=>$value)
            {
               echo '<tr><td></td>
                    <td>'.$boat[$key]['boat_details'].'</td>
                    <td>'.$boat[$key]['unit_rate'].'</td>
                    <td></td>
                    <td>'.$boat[$key]['x_rate'].'</td>
                    <td>'.$boat[$key]['markup_net_cost'].'</td>
                    </tr>';
                    
             array_push($total_boat, $boat[$key]['markup_net_cost']);
            }
            
            $boat_amount = array_sum($total_boat);
  }
  else
  {
      $boat_amount = 0;
  }
  
   if(!empty($cargo))
  {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$cargo[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
      // $total_cargo = array();
            foreach($cargo as $key=>$value)
            {
               echo '<tr><td></td>
                    <td></td>
                    <td>'.$cargo[$key]['unit_rate'].'</td>
                    <td></td>
                    <td>'.$cargo[$key]['x_rate'].'</td>
                    <td></td>
                    </tr>';                
                    
             //array_push($total_cargo, $cargo[$key]['markup_net_cost']);
            }
            
           // $cargo_amount = array_sum($total_cargo);
  }
  else
  {
      $cargo_amount = 0;
  }
  
   if(!empty($driver))
  {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$driver[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
       $total_driver = array();
            foreach($driver as $key=>$value)
            {
               echo '<tr><td></td>
                    <td>'.$driver[$key]['location'].'</td>
                    <td>'.$driver[$key]['unit_rate'].'</td>
                    <td>'.$driver[$key]['days'].'</td>
                    <td>'.$driver[$key]['x_rate'].'</td>
                    <td>'.$driver[$key]['markup_net_cost'].'</td>
                    </tr>';                
                     
             array_push($total_driver, $driver[$key]['markup_net_cost']);
            }
            
            $driver_amount = array_sum($total_driver);
  }
  else
  {
      $driver_amount = 0;
  }
  
   if(!empty($cruise))
  {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$cruise[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
       //$total_cruise = array();
            foreach($cruise as $key=>$value)
            {
               echo '<tr><td></td>
                    <td></td>
                    <td>'.$cruise[$key]['unit_rate'].'</td>
                    <td></td>
                    <td>'.$cruise[$key]['x_rate'].'</td>
                    <td></td>
                    </tr>';                
                     
            }
            
  }
   if(!empty($event))
  {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$event[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
       $total_ = array();
            foreach($event as $key=>$value)
            {
               echo '<tr><td></td>
                    <td></td>
                    <td>'.$event[$key]['unit_rate'].'</td>
                    <td></td>
                    <td>'.$event[$key]['x_rate'].'</td>
                    <td></td>
                    </tr>';                
            }
  }
  
   if(!empty($company_fees))
  {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$company_fees[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
       $total_boat = array();
            foreach($company_fees as $key=>$value)
            {
               echo '<tr><td></td>
                    <td></td>
                    <td>'.$company_fees[$key]['unit_rate'].'</td>
                    <td></td>
                    <td>'.$company_fees[$key]['x_rate'].'</td>
                    <td></td>
                    </tr>';                
            }
  }
  
   if(!empty($miscellaneous))
  {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$miscellaneous[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
       $total_boat = array();
            foreach($miscellaneous as $key=>$value)
            {
               echo '<tr><td></td>
                    <td></td>
                    <td>'.$miscellaneous[$key]['unit_rate'].'</td>
                    <td></td>
                    <td>'.$miscellaneous[$key]['x_rate'].'</td>
                    <td></td>
                    </tr>';                
            }
  }
  
  
  $grand_total = $adds_amount + $train_amount + $craft_amount + $boat_amount  + $driver_amount ;
  
  ?>
  
</table>

<table style="border:2px solid black">
    <tr style="background:#C3E2C5">
        <td style="width:940px;height:90px;border:2px solid black"></td>
        <td style="border:2px solid black">
           <tr></tr>
        </td>
    </tr>
    <tr style="background:#C5E0FA;border:2px solid black"><td style="border:2px solid black;"><strong style="margin-left: 835px;">Grand Total : </strong></td><td style="border:2px solid black"><?=$grand_total?></td></tr>
    <tr style="border:2px solid black"><td></td><td></td></tr>
    <tr style="background:#E2DF90;border:2px solid black"><td><strong strong style="margin-left: 750px;">Total Amount To be Paid : </strong></td><td style="border:2px solid black"><?=$grand_total?></td></tr>
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
        function delete_hotel(id)
        {
            $.ajax({                
                    url: "<?php echo base_url();?>admin/delete_data/hotel_vila_apartment",
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
        }
   
                    
    </script>
    

 