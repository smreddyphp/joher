
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

.icons-doc {
float: right;
margin: 5px 50px;
}

.icons-doc a {
margin-right: 10px;
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
             <li class="breadcrumb-item"><a href="#:" >Genarate Invoice</a></li> 
          </ol>
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    <div class="row">
      <div class="col-sm-12" >
        <div class="card">
          <div class="card-header">
             <h5 class="card-header-text">Genarate Invoice</h5>
            <div class="icons-doc">
            <!--<a href="<?php echo base_url();?>admin/invoice_pdf_reports" class="btn btn-md btn-warning" title="Download PDF">-->
            <a  onclick = "printDiv('printPdf')" class="btn btn-md btn-warning" title="Download PDF">
              <i class="fa fa-file-pdf-o"></i></a>
              
              <!--<a href="<?php echo base_url()?>admin/invoice_excel/<?=$this->uri->segment(3)?>" class="btn btn-md btn-success" title="Download Excel"><i class="fa fa-file-excel-o"></i></a>-->
              
              </div>             
          </div> 
<span id = "printPdf">          
          
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
        
        <?php 
            $records = $this->db->where('id',$this->uri->segment(4))->get('trip')->row_array();
            /*echo "<pre>";
            print_r($FCR);*/
        ?>
    <div style="display: flex;margin-top: 20px;">
        <div style="flex:0 0 70%">
        <p>Name: <?= @$user['user_name']?></p>
        <p>A/C:Noura Nya</p>
        <p>city: <?php $city = $this->db->where('user_id',$this->uri->segment(3))->get('user_info')->row();  print_r($city->city);?></p>  
        </div>
    
        <div style="flex:0 0 30%">
        <p>Date: <?= date('Y-m-d h:i:s');?></p>
        <p>Ref:#<?=$this->uri->segment(3)?>-<?=$this->uri->segment(4)?> final Invoice</p>
        <p>period:<?=date('d F ',strtotime($records['trip_start']))?> - <?=date('d F  Y',strtotime($records['trip_end']))?></p>
        </div>
    </div>
  
  <br/>
  <div>
  <table style="border:2px solid black; width:100%" border = "1">
  <tr style="background:#B6B2B2">
    <th>Srno</th>
    <th>Description</th>
    <th>Service Description</th>
    <th>Units</th>
    <th>Nbr Nts/Days</th>
    <th>Rate</th>
    <th>Total</th>
  </tr>
  <?php
  
    //print_r($user);
    //exit;
    $i=1;
    if(!empty($adds))
    {
        
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$adds[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
        $total_adds = array();
        $a = [];
        
        $country1 = $this->db->select('country_code,old_rate')->get('FCR')->result_array();
        foreach($country1 as $row)
        {
            $country[]  = $row['country_code'];
            $old_rate[] = $row['old_rate'];
        }
        
        //echo "<pre>";
        //print_r($country);
        foreach($adds as $key=>$value)
        {
            $country_code = $this->db->where('id',$adds[$key]['frc'])->get('FCR')->row()->country_code;
            //echo $adds[$key]['quantity'];
            $total_w_vat_sel = (str_replace(',', '', $adds[$key]['total_w_vat_sel'])/$adds[$key]['day_night'])/$adds[$key]['quantity'];
                        
               echo '<tr><td></td>
                    <td>'.$adds[$key]['room_desc'].'</td>
                    <td>'.$adds[$key]['description'].'</td>
                    <td>'.$adds[$key]['quantity'].'</td>
                    <td>'.$adds[$key]['day_night'].'</td>
                    <td>'.number_format($total_w_vat_sel,2).'</td>
                    <td>'. $country_code .' '.$adds[$key]['total_w_vat_sel'].'</td>
                    </tr>';    
                    
            if(in_array($country_code,$country))
            {
                 $a[$country_code][] = str_replace(',', '', $adds[$key]['total_w_vat_sel']);
            }
                    
            array_push($total_adds, str_replace(',', '', $adds[$key]['total_w_vat_sel']));// 
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
                $country_code = $this->db->where('id',$train[$key]['frc'])->get('FCR')->row()->country_code;
                $unit_rate = ($train[$key]['unit_rate'] > 1)?$train[$key]['unit_rate']:1;
               echo '<tr><td></td>
                   <td>'.$train[$key]['route'].'</td>
                   <td>'.$train[$key]['description'].'</td>
                    <td>'.$unit_rate.'</td>
                    <td></td>
                    <td>'.number_format(str_replace(',', '', $train[$key]['total_w_vat_sel'])/$unit_rate,2).'</td>
                    <td>'. $country_code .' '.$train[$key]['total_w_vat_sel'].'</td>
                    </tr>'; 
                    
                    if(in_array($country_code,$country))
                    {
                         $a[$country_code][] = str_replace(',', '', $train[$key]['total_w_vat_sel']);
                    }
                    
                   array_push($total_train, str_replace(',', '', $train[$key]['total_w_vat_sel']));    
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
                $country_code = $this->db->where('id',$craft[$key]['fcr'])->get('FCR')->row()->country_code;
                $unit_rate = ($craft[$key]['unit_rate'] > 1)?$craft[$key]['unit_rate']:1;
               echo '<tr><td></td>
                    <td>'.$craft[$key]['route'].'</td>
                    <td>'.$craft[$key]['description'].'</td>
                    <td>'.$unit_rate.'</td>
                    <td></td>
                    <td>'.number_format(str_replace(',', '', $craft[$key]['total_w_vat_sel'])/$unit_rate,2).'</td>
                    <td>'. $country_code .' '.$craft[$key]['total_w_vat_sel'].'</td>
                    </tr>';  
                    
                    array_push($total_craft, str_replace(',', '', $craft[$key]['total_w_vat_sel']));
                    
                    if(in_array($country_code,$country))
                    {
                         $a[$country_code][] = str_replace(',', '', $craft[$key]['total_w_vat_sel']);
                    }  
                    
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
                $country_code = $this->db->where('id',$boat[$key]['fcr'])->get('FCR')->row()->country_code;
                $unit_rate = ($boat[$key]['unit_rate'] > 1)?$boat[$key]['unit_rate']:1;
               echo '<tr><td></td>
                    <td>'.$boat[$key]['boat_details'].'</td>
                    <td>'.$boat[$key]['description'].'</td>
                    <td>'.$unit_rate.'</td>
                    <td></td>
                    <td>'.number_format(str_replace(',', '', $boat[$key]['total_w_vat_sel'])/$unit_rate,2).'</td>
                    <td>'. $country_code .' '.$boat[$key]['total_w_vat_sel'].'</td>
                    </tr>';
                    
                array_push($total_boat, str_replace(',', '', $boat[$key]['total_w_vat_sel']));
                
                    if(in_array($country_code,$country))
                    {
                         $a[$country_code][] = str_replace(',', '', $boat[$key]['total_w_vat_sel']);
                    }  
                    
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
       $total_cargo = array();
            foreach($cargo as $key=>$value)
            {
                $country_code = $this->db->where('id',$cargo[$key]['fcr'])->get('FCR')->row()->country_code;
                $unit_rate = ($cargo[$key]['unit_rate'] > 1)?$cargo[$key]['unit_rate']:1;
               echo '<tr><td></td>
                    <td></td>
                    <td>'.$cargo[$key]['description'].'</td>
                    <td>'.$unit_rate.'</td>
                    <td></td>
                    <td>'.number_format(str_replace(',', '', $cargo[$key]['total_w_vat_sel'])/$unit_rate,2).'</td>
                    <td>'. $country_code .' '.$cargo[$key]['total_w_vat_sel'].'</td>
                    </tr>';   
             array_push($total_cargo, str_replace(',', '', $cargo[$key]['total_w_vat_sel']));
             
                    if(in_array($country_code,$country))
                    {
                         $a[$country_code][] = str_replace(',', '', $cargo[$key]['total_w_vat_sel']);
                    }
            }
            
            $cargo_amount = array_sum($total_cargo);
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
                $country_code = $this->db->where('id',$driver[$key]['frc'])->get('FCR')->row()->country_code;
                
                $quantity = ($driver[$key]['quantity'] > 1)?$driver[$key]['quantity']:1;
                $days     = ($driver[$key]['days'] > 1)?$driver[$key]['days']:1;
                $total_w_vat_sel = (str_replace(',', '', $driver[$key]['total_w_vat_sel'])/$days)/$quantity;
                
               echo '<tr><td></td>
                    <td>'.$driver[$key]['location'].'</td>
                    <td>'.$driver[$key]['description'].'</td>
                    <td>'.$quantity.'</td>
                    <td>'.$driver[$key]['days'].'</td>
                    <td>'.number_format($total_w_vat_sel,2).'</td>
                    <td>'. $country_code .' '.$driver[$key]['total_w_vat_sel'].'</td>
                    </tr>';                
            
                    if(in_array($country_code,$country))
                    {
                         $a[$country_code][] = str_replace(',', '', $driver[$key]['total_w_vat_sel']);
                    }
            
                array_push($total_driver, str_replace(',', '', $driver[$key]['total_w_vat_sel']));
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
       $total_cruise = array();
            foreach($cruise as $key=>$value)
            {
                $country_code = $this->db->where('id',$cruise[$key]['fcr'])->get('FCR')->row()->country_code;
                $unit_rate = ($cruise[$key]['unit_rate'] > 1)?$cruise[$key]['unit_rate']:1;
               echo '<tr><td></td>
                    <td></td>
                    <td>'.$cruise[$key]['description'].'</td>
                    <td>'.$unit_rate.'</td>
                    <td></td>
                    <td>'.number_format(str_replace(',', '', $cruise[$key]['total_w_vat_sel'])/$unit_rate,2).'</td>
                     <td>'. $country_code .' '.$cruise[$key]['total_w_vat_sel'].'</td>
                    </tr>';  
                    array_push($total_cruise, str_replace(',', '', $cruise[$key]['total_w_vat_sel'])); 
                    
                    if(in_array($country_code,$country))
                    {
                         $a[$country_code][] = str_replace(',', '', $cruise[$key]['total_w_vat_sel']);
                    }
            }
            $cruise_amount = array_sum($total_cruise);
            
  }
  else 
  {
      $cruise_amount = 0;
  }
  
   if(!empty($event))
  {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$event[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
       $total_event = array();
            foreach($event as $key=>$value)
            {
                $country_code = $this->db->where('id',$event[$key]['fcr'])->get('FCR')->row()->country_code;
                $unit_rate = ($event[$key]['unit_rate'] > 1)?$event[$key]['unit_rate']:1;
               echo '<tr><td></td>
                    <td></td>
                    <td>'.$event[$key]['description'].'</td>
                    <td>'.$unit_rate.'</td>
                    <td></td>
                    <td>'.number_format(str_replace(',', '',  $event[$key]['total_w_vat_sel'])/$unit_rate,2).'</td>
                     <td>'. $country_code .' '.$event[$key]['total_w_vat_sel'].'</td>
                    </tr>'; 
                    array_push($total_event, str_replace(',', '', $event[$key]['total_w_vat_sel']));               
                    
                    if(in_array($country_code,$country))
                    {
                         $a[$country_code][] = str_replace(',', '', $event[$key]['total_w_vat_sel']);
                    }
            }
            $event_amount = array_sum($total_event);
  }
  else 
  {
      $event_amount = 0;
  }
   if(!empty($company_fees))
  {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$company_fees[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
       $total_company = array();
            foreach($company_fees as $key=>$value)
            {
                $country_code = $this->db->where('id',$company_fees[$key]['fcr'])->get('FCR')->row()->country_code;
                $unit_rate = ($company_fees[$key]['unit_rate'] > 1)?$company_fees[$key]['unit_rate']:1;
               echo '<tr><td></td>
                    <td></td>
                    <td>'.$company_fees[$key]['description'].'</td>
                    <td>'.$unit_rate.'</td>
                    <td></td>
                    <td>'.number_format(str_replace(',', '',  $company_fees[$key]['total_w_vat_sel'])/$unit_rate,2).'</td>
                     <td>'. $country_code .' '.$company_fees[$key]['total_w_vat_sel'].'</td>
                    </tr>'; 
                    array_push($total_company, str_replace(',', '', $company_fees[$key]['total_w_vat_sel']) );
                    
                    if(in_array($country_code,$country))
                    {
                         $a[$country_code][] = str_replace(',', '', $company_fees[$key]['total_w_vat_sel']);
                    }
            }
            $company_amount = array_sum($total_company);
  }
  else 
  {
      $company_amount = 0;
  }
  
    if(!empty($miscellaneous))
    {
      echo '
      <tr><td>'.$i++.'</td><td><strong>'.$miscellaneous[0]['service_type'].'</strong></td><td></td><td></td><td></td><td></td></tr>';
       $total_miscellaneous = array();
            foreach($miscellaneous as $key=>$value)
            {
                $country_code = $this->db->where('id',$miscellaneous[$key]['fcr'])->get('FCR')->row()->country_code;
                $unit_rate = ($miscellaneous[$key]['unit_rate'] > 1)?$miscellaneous[$key]['unit_rate']:1;
               echo '<tr><td></td>
                    <td></td>
                    <td>'.$miscellaneous[$key]['description'].'</td>
                    <td>'.$unit_rate.'</td>
                    <td></td>
                    <td>'.number_format(str_replace(',', '',  $miscellaneous[$key]['total_w_vat_sel'])/$unit_rate,2).'</td>
                    <td>'. $country_code .' '.$miscellaneous[$key]['total_w_vat_sel'].'</td>
                    </tr>';
                     array_push($total_miscellaneous, str_replace(',', '', $miscellaneous[$key]['total_w_vat_sel']));
                     
                    if(in_array($country_code,$country))
                    {
                         $a[$country_code][] = str_replace(',', '', $miscellaneous[$key]['total_w_vat_sel']);
                    }
            }
            $miscellaneous_amount = array_sum($total_miscellaneous);
    }
    else 
    {
        $miscellaneous_amount = 0;
    }
       
        if($fee_management['bank_fee'] > 0)
        {
            echo '<tr><td>'.$i++.'</td><td><strong> Banking Fee    </strong> </td> <td style="text-align:center;">-</td> <td style="text-align:center;">-</td> <td>USD '.number_format($fee_management['bank_fee'],2).'</td> <td><strong>USD '.number_format($fee_management['bank_fee'],2).'</strong></td> </tr>';
        
                    if(in_array('USD',$country))
                    {
                         $a[$country_code][] = $fee_management['bank_fee'];
                    }
        }
        
        if($fee_management['management_fee'] > 0)
        {
            echo '<tr><td>'.$i++.'</td><td><strong> Management Fee </strong> </td> <td style="text-align:center;">-</td> <td style="text-align:center;">-</td> <td>USD '.number_format($fee_management['management_fee'],2).'</td> <td><strong>USD '.number_format($fee_management['management_fee'],2).'</strong></td> </tr>';
        
            if(in_array('USD',$country))
            {
                 $a[$country_code][] = $fee_management['management_fee'];
            }
        }
    
        //echo "<pre>";
        //print_r($a); 
  
  $grand_total = $adds_amount + $train_amount + $craft_amount + $boat_amount  + $driver_amount + $cargo_amount + $cruise_amount + $miscellaneous_amount + $company_amount + $event_amount ;
  
  ?>
  
</table>
<table style="border:2px solid black">
    <tr style="background:#C3E2C5">
        <td style="width:800px;height:39px;border:2px solid black;text-align:right"> <strong style="margin-left: 753px;">Currency : </strong></td>
        <td style="width:200px;border:0px solid black">
           <table    style="border: 0px solid black;"> 
           
                <?php 
                    //print_r($country1);
                    $usd =0;
                    foreach($a as $key => $value)
                    { 
                        if($key!='USD')
                        {
                            $selrate = $this->db->where('country_code',$key)->get('FCR')->row()->old_rate;
                            $USD = $this->db->where('country_code','USD')->get('FCR')->row()->old_rate;
                            @$usd1 =  array_sum($value);
                            @$usd1 = $usd1 / $USD;
                            @$usd = @$usd + $usd1;
                        }
                        else
                        {
                            @$usd = @$usd + array_sum($value);
                        }
                ?>
                
                    <tr>
                        <td><?=  $key .' '. number_format(array_sum($value),2)?></td>
                    </tr>
                    
                <?php } 
                    $per_amount = ($fee_management['per_amount'] > 0)?$fee_management['per_amount']:0;
                    $usd = $usd + $per_amount;
                ?>
                
                <!--<tr>
                    <td> USD <?=number_format($fee_management['bank_fee'] + $fee_management['management_fee'],2)?></td>
                </tr>-->
            </table>
        </td>
    </tr>
    <?php 
        if($fee_management['vat_per'] > 0){    
            @$toatlPar = $fee_management['bank_fee'] + $fee_management['management_fee'];
            @$total = (@$toatlPar * $fee_management['vat_per'])/100;
        ?>
            <tr style="background:#c0d2e3;border:2px solid black">
                <td style="width:800px;border:2px solid black;text-align:right"><strong style="margin-left: 753px;">VAT % <?=$fee_management['vat_per']?> : </strong></td>
                <td style="width:200px;border:2px solid black"> USD <?= number_format($fee_management['per_amount'],2) ?></td>
            </tr>
    <?php } ?>
    
    <tr style="background:#C5E0FA;border:2px solid black">
        <td style="width:800px;border:2px solid black;"><strong style="margin-left: 753px;">Grand Total : </strong></td>
        <td style="width:200px;border:2px solid black"><?=  ' USD '.number_format($usd,2)?></td>
    </tr>
    <tr style="border:2px solid black"><td style="width:800px;"></td><td></td></tr>
    <tr style="background:#E2DF90;border:2px solid black">
        <td style="width:800px;"><strong strong style="margin-left: 636px;">Total Amount To be Paid SAR : </strong></td>
        <?php $USD = $this->db->where('country_code','USD')->get('FCR')->row()->new_rate; ?>
        <td style="width:200px;border:2px solid black"><?= number_format($usd * $USD,2)?></td>
    </tr>
</table>

<?php //print_r($fee_management); ?>
<table>
        
        <tr><td>In Words: <b>   <?php echo getIndianCurrency($usd * $USD); echo ' Saudi Riyals only'; ?> </b> </td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td>VAT Registration Number: 00000000000000000</td></tr>
        
        <tr style="background:#C3E2C5">
            <td>
                <tr>
                    <td style="width:500px;height:39px;border:2px solid black">
                        Bank details : <br/>
                        <strong>
                            <?=$bank_details['ADDRESS']?>
                        </strong>
                    </td>
                    <td style="width:500px;height:39px;border:2px solid black">
                        IBAN: <strong>  <?=$bank_details['IBAN']?> </strong>
                        <br/>
                        SWIFT: <strong> <?=$bank_details['SWIFT']?> </strong>
                        <br/>
                        Account No.: <strong> <?=$bank_details['ACCOUNT']?> </strong>
                    </td>
                </tr>
            </td>
        </tr>
</table>

</span>

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
    
<script type="text/javascript">
   function printDiv(divId) {
       //alert(divId)
       //return false;
       var printContents = document.getElementById(divId).innerHTML;
       var originalContents = document.body.innerHTML;
       document.body.innerHTML = "<html><head><title></title></head><body>" + printContents + "</body>";
       window.print();
       document.body.innerHTML = originalContents;
   }
</script>

<?php
        function getIndianCurrency($number)
        {
            $decimal = round($number - ($no = floor($number)), 2) * 100;
            $hundred = null;
            $digits_length = strlen($no);
            $i = 0;
            $str = array();
            $words = array(0 => '', 1 => 'one', 2 => 'two',
                3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
                7 => 'seven', 8 => 'eight', 9 => 'nine',
                10 => 'ten', 11 => 'eleven', 12 => 'twelve',
                13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
                16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
                19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
                40 => 'forty', 50 => 'fifty', 60 => 'sixty',
                70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
            $digits = array('', 'hundred','thousand','lakh', 'crore');
            while( $i < $digits_length ) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += $divider == 10 ? 1 : 2;
                if ($number) 
                {
                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                    $hundred = ($counter == 1 && $str[0]) ? '  ' : null;
                    $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
                } else $str[] = null;
            }
            $Rupees = implode('', array_reverse($str));
            $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' ' : '';
            return ($Rupees ? $Rupees . ' ' : '') . $paise;
        }

?>

 