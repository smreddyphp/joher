<!--<link rel="stylesheet" href="http://ericjgagnon.github.io/wickedpicker/wickedpicker/wickedpicker.min.css">-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0-rc.6/css/datepicker.css">-->
<!--<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css" type="text/css" media="all">-->

<style>
    #insert_adds label.error {
        color:red; 
    }
    
    #insert_adds input.error,textarea.error,select.error {
        border:1px solid red;
        color:red; 
    }
    
    .popover{
        z-index: 2000;
        position:relative;
    }    
    
    .wi{
            margin-left: -18px;
            width: 84px !important;
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
              <!--<button class="btn btn-success fa fa-plus add_adds" data-name="<?php echo @$current_page; ?>" style="margin-left:65%">Add </button>--></span>
          </div>
          
          <div class="card-block addform-block">
<form id="insert_adds" class="form-horizontal" role="form">
         <!-- Form Name -->
       	  <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
          <!-- Text input-->

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Client Code:<span class="star">*</span></label>
            <div class="col-sm-9">
                <?php  
                //echo  $id = $this->uri->segment(3); 
                //echo $adds['user_id'];
                //print_r($adds);
                
              if($this->uri->segment(4) !='')
              {
                $id = $this->uri->segment(4);
                $client_code = $this->db->get_where('user_info',array('user_id'=>$id))->row_array();
                //print_r($client_code);
              ?>
                    <select class="form-control" name="data[client_code]" id="get_client_code" onchange = "client_code(this.value)">
                        <option value="">Select Code</option>
                        <?php $res = $this->db->get_where('user_info',array('user_id'=>$id))->result(); ?>
                        <?php 
                            if($res)
                            { 
                                foreach($res as $row)
                                { ?>
                                    <option value = "<?=$row->client_code?>"  <?php if($row->client_code == @$adds['client_code']){ echo 'selected';}else{ echo 'selected';}?> ><?=$row->client_code?></option>   
                        <?php   }
                            }
                        ?>
                    </select>
                <?php }
                else
                    {  ?>
                <select class="form-control" name="data[client_code]"  id="get_client_code" 
                 onchange = "client_code(this.value)">
                     <option value="">Select Code</option>
                <?php 
                    $res = $this->db->get_where('user_info')->result();
                        
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value = "<?=$row->client_code?>"  <?php if($row->client_code == @$adds['client_code']){ echo 'selected';}?> ><?=$row->client_code?></option>   
                    <?php  }
                    }
                ?>
            </select>
                <?php } ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Trip Code:<span class="star">*</span></label>
            <div class="col-sm-9">
                <select class="form-control" name="data[trip_id]"  id="get_trip_id">
                        <option value="">Select Trip Id</option>
                        <?php 
                            $id = $this->uri->segment(4);
                            $res = $this->db->order_by('id','DESC')->get_where('trip',array('user_id'=>$id))->result();
                            if($res)
                            { 
                                foreach($res as $row)
                                { ?>
                                    <option value = "<?=$row->id?>"  <?php if($row->id == @$adds['trip_id']){ echo 'selected';}else if($row->id == $this->uri->segment(5)){ echo 'selected'; } ?> ><?=$row->id?></option>   
                            <?php  }
                            } ?>
                </select>
            </div>
          </div>


            <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Client Name:</label>
            <div class="col-sm-9">                
            <select class="form-control" name="data[client_name]" id="get_client_name" >
                     <option value="">Select Name</option>
                <?php 
                    $res = $this->db->get_where('users',array('auth_level'=>1))->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->user_name?>" <?php if($row->user_id == @$adds['user_id']){ echo 'selected';}else if($row->user_id==@$client_code['user_id']){ echo 'selected';}?>><?=$row->user_name?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div>

        <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Client Email:</label>
            <div class="col-sm-9">
                <?php 
            if($this->uri->segment(4) !='')
              {
              
             $id = $this->uri->segment(4);
             $user = $this->db->get_where('users',array('user_id'=>$id,'auth_level'=>1))->row_array();
             
              ?>
               <select class="form-control" name="data[client_email]" id="get_client_email" >
                <option value="">Select Email</option>
                <?php
                    
                $res['email']=$this->db->get_where('users',array('auth_level'=>1))->result_array();
                foreach ($res['email'] as $key => $uvalue) { ?>
                            <option value="<?=$uvalue['email']?>" <?php  if($this->uri->segment(4) == $uvalue['user_id']){ echo 'selected';} ?> ><?=$uvalue['email']?></option>
                    <?php }
                ?>
            </select>
            <?php
             
              }
              else
              {   
                ?>
               <select class="form-control" name="data[client_email]" id="get_client_email">
                 <option value="">Select Email</option>
                <?php
                    
                $res['email']=$this->db->get_where('users',array('auth_level'=>1))->result_array();
                foreach ($res['email'] as $key => $uvalue) { ?>
                            <option value="<?=$uvalue['email']?>" <?php  if($this->uri->segment(4) == $uvalue['user_id']){ echo 'selected';} ?> ><?=$uvalue['email']?></option>
                    <?php }
                ?>
            </select>
            <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Service Type:<span class="star">*</span></label>
            <div class="col-sm-9">
              <select name="data[service_type]" id="" class="form-control">
              <option value="Hotel" <?php if(@$adds['service_type']=='Hotel'){ echo 'selected';} ?>>Hotel</option>
              <option value="Villa" <?php if(@$adds['service_type']=='Villa'){ echo 'selected';} ?>>Villa</option>
              <option value="Apartment" <?php if(@$adds['service_type']=='Apartment'){ echo 'selected';} ?>>Apartment</option>
              </select>
            </div>
          </div>
         
         <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Supplier Code<span class="star">*</span></label>
            <div class="col-sm-9">
                <?php //echo $adds['user_id'];?>
                 <select class="form-control" name="data[supplier_code]" id="get_supplier_code"
                  onchange = "supplier_code(this.value)">
                     <option>Select Code</option>
                <?php 
                    $res = $this->db->get_where('suppliers',array('service_type'=>'HOTEL'))->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value = "<?=$row->supplier_code?>"  <?php if($row->supplier_code == @$adds['supplier_code']){ echo 'selected';}?> ><?=$row->supplier_code?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div> 


             <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Supplier Name<span class="star">*</span></label>
            <div class="col-sm-9">
                
            <select class="form-control" name="data[supplier_name]" id="get_supplier_name" onchange = "supplier_name(this.value)" >
                     <option>Select Name</option>
                <?php 
                    $res = $this->db->get_where('suppliers',array('service_type'=>'HOTEL'))->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->supplier_name?>" <?php if($row->supplier_name == @$adds['supplier_name']){ echo 'selected';}?>><?=$row->supplier_name?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div>  


          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Guest Name:</label>
            <div class="col-sm-9">
              <input type="text" placeholder="" name="data[guest_name]" value="<?=@$adds['guest_name']?>" class="form-control">
            </div>
 			</div>
            <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Location:</label>
            <div class="col-sm-9">
              <input type="text" placeholder="" name="data[location]" value="<?=@$adds['location']?>" class="form-control">
            </div>
 			</div>
 			<div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Confirmation No:</label>
            <div class="col-sm-9">
              <input type="text" placeholder="" name="data[confirmation_no]" value="<?=@$adds['confirmation_no']?>" class="form-control">
            </div>
          </div>
          
		  <!-- Text input-->
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Payment Method:</label>
            <div class="col-sm-9">
               <select name="data[payment_method]" id="" class="form-control">
              <option value="">Select Payment Method</option>
              <option value="ONLINE" <?php if(@$adds['payment_method']=='ONLINE'){ echo 'selected';} ?>>ONLINE</option>
              <option value="CREDIT_CARD" <?php if(@$adds['payment_method']=='CREDIT_CARD'){ echo 'selected';} ?>>CREDIT CARD</option>
              <option value="DEBIT_CARD" <?php if(@$adds['payment_method']=='DEBIT_CARD'){ echo 'selected';} ?>>DEBIT CARD</option>
              <option value="CASH"<?php if(@$adds['payment_method']=='CASH'){echo 'selected';} ?>>CASH</option>
              <option value="TBA"<?php if(@$adds['payment_method']=='TBA'){echo 'selected';} ?>>TBA</option>
              </select>
            </div>
          </div> 
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Room Type:</label>
            <div class="col-sm-9">
              <!--<select name="data[room_type]" id="" class="form-control">
              <option value="Deluxe">Deluxe</option>
              <option value="AC">AC</option>
              <option value="Non Ac">Non Ac</option>
              </select>-->
              <input type ="text" class="form-control" name ="data[room_type]" value ="<?=@$adds['room_type']?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Room Description:</label>
            <div class="col-sm-9">
              <textarea name="data[room_desc]" id="" cols="30" rows="3" class="form-control"><?=@$adds['room_desc']?></textarea>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Quantity:</label>
            <div class="col-sm-9">             
              
              <input type ="number" name="data[quantity]" id="quantity" class="form-control" value = "<?php echo @$adds['quantity']?>">
              
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">From:</label>
            <div class="col-sm-9">
            <input type="date"  name="data[from]" value="<?php if(@$adds['from']){ echo date('Y-m-d',strtotime(@$adds['from'])); } ?>" class="form-control from_date" id = "from_date">
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">To:</label>
            <div class="col-sm-9">
            <input type="date" name="data[to]" value="<?php if(@$adds['to']){ echo date('Y-m-d',strtotime(@$adds['to'])); }?>" class="form-control to_date" id = "to_date" >
              </select>
            </div>
          </div>
          
           <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Days/Nights:</label>
            <div class="col-sm-9">
            <input type="number" name="data[day_night]" id = "day_night" value="<?=@$adds['day_night']?>" class="form-control">
              
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Check-In:</label>
            <div class="col-sm-9">
            <!-- <input type="time" name="data[check_in]" value="<?=@$adds['check_in']?>" id = "timepicker1" class="form-control basicExample timepicker2"> -->
            <input class="form-control" type="time" name="data[check_in]" value="<?php echo @$adds['check_in']?>" placeholder="Enter Check-In Time" >
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Check-Out:</label>
            <div class="col-sm-9">
            <!-- <input type="time" name="data[check_out]" value="<?=@$adds['check_out']?>" id = "timepicker1" class="form-control basicExample timepicker2"> -->
             <input class="form-control" type="time" name="data[check_out]" value="<?php echo @$adds['check_out']?>" placeholder="Enter Check-out Time" >
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Proform No:</label>
            <div class="col-sm-9">
            <input type="text" name="data[proform_no]" value="<?=@$adds['proform_no']?>" class="form-control">
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Final Invoice No:</label>
            <div class="col-sm-9">
            <input type="text" name="data[final_invoice_no]" value="<?=@$adds['final_invoice_no']?>" class="form-control">
              </select>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Invoice No:</label>
            <div class="col-sm-9">
            <input type="text" name="data[invoice_no]" value="<?=@$adds['invoice_no']?>" class="form-control">
              </select>
            </div>
          </div>
          
         
          
          </div> 
          <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 clk">
          
         
    
    <span onclick="myFunction()">    
    
       <!-- <div class="form-group "><div class="row"><hr/></div></div>-->
    
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput">Select FCR:</label>
                        <div class="col-sm-2">
                            <select name="data[frc]" name="data[frc]" id="fcrCode" class="form-control wi">
                                <option value = ''>Select</option>
                                <?php 
                                    $record = $this->db->get('FCR')->result_array();
                                    //print_r($record);
                                    foreach($record as $row2)
                                    { ?>
                                         <option value = "<?php echo @$row2['id']?>" <?php if($row2['id'] == @$adds['frc']){ echo "selected";} ?> ><?=@$row2['country_code']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label text-center" for="textinput">Buy FOREX:</label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[buy_forex]" id = "buy_forex" value = "<?php echo @$adds['buy_forex']?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput">Sell FOREX:</label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[sel_forex]" id = "sel_forex" value = "<?php echo @$adds['sel_forex']?>" class="form-control wi">  
                        </div>
                        
                    </div>          
                </div>
          </div>
        
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput">SUPPLIER BASE RATE:</label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[supplier_base_rate]" id = "supplier_base_rate" value = "<?php echo @$adds['supplier_base_rate']?>" class="form-control wi">
                        </div>
                         <label class="col-sm-2 control-label text-center" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[supplier_base_rate_buy]" id = "supplier_base_rate_buy" value = "<?php echo @$adds['supplier_base_rate_buy']?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[supplier_base_rate_sel]" id = "supplier_base_rate_sel" value = "<?php echo @$adds['supplier_base_rate_sel']?>" class="form-control wi">  
                        </div>
                    </div>          
                </div>
        </div> 
          
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput"><strong>TOTAL SUPPLIER BASE RATE:</strong></label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[total_supplier_base_rate]" id = "total_supplier_base_rate" value = "<?php echo @$adds['total_supplier_base_rate']?>" class="form-control wi">
                        </div>
                         <label class="col-sm-2 control-label text-center" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[total_supplier_base_rate_buy]" id = "total_supplier_base_rate_buy" value = "<?php echo @$adds['total_supplier_base_rate_buy']?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[total_supplier_base_rate_sel]" id = "total_supplier_base_rate_sel" value = "<?php echo @$adds['total_supplier_base_rate_sel']?>" class="form-control wi">  
                        </div>
                        
                    </div>          
                </div>
          </div>  
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput">SUPPLIER TAX:</label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[supplier_tax]" id = "supplier_tax" value = "<?php echo @$adds['supplier_tax']?>" class="form-control wi">
                        </div>
                         <label class="col-sm-2 control-label text-center" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[supplier_tax_buy]" id = "supplier_tax_buy" value = "<?php echo @$adds['supplier_tax_buy']?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[supplier_tax_sel]" id = "supplier_tax_sel" value = "<?php echo @$adds['supplier_tax_sel']?>" class="form-control wi">  
                        </div>
                        
                    </div>          
                </div>
          </div>  
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput">OTHER FEES:</label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[other_fees]" id = "other_fees" value = "<?php echo (@$adds['other_fees'])?@$adds['other_fees']:'0.00'?>" class="form-control wi">
                        </div>
                         <label class="col-sm-2 control-label text-center" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[other_fees_buy]" id = "other_fees_buy" value = "<?php echo (@$adds['other_fees_buy'])?@$adds['other_fees_buy']:'0.00'?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[other_fees_sel]" id = "other_fees_sel" value = "<?php echo (@$adds['other_fees_sel'])?@$adds['other_fees_sel']:'0.00'?>" class="form-control wi">  
                        </div>
                        
                    </div>          
                </div>
          </div>  
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput">SUPPLIER TOTAL:</label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[supplier_total]" id = "supplier_total" value = "<?php echo @$adds['supplier_total']?>" class="form-control wi">
                        </div>
                         <label class="col-sm-2 control-label text-center" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[supplier_total_buy]" id = "supplier_total_buy" value = "<?php echo @$adds['supplier_total_buy']?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[supplier_total_sel]" id = "supplier_total_sel" value = "<?php echo @$adds['supplier_total_sel']?>" class="form-control wi">  
                        </div>
                        
                    </div>          
                </div>
          </div>  
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput"><strong>ACTUAL SUPPLIER TOTAL:</strong></label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[actual_supplier_total]" id = "actual_supplier_total" value = "<?php echo @$adds['actual_supplier_total']?>" class="form-control wi">
                        </div>
                         <label class="col-sm-2 control-label text-center" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[actual_supplier_total_buy]" id = "actual_supplier_total_buy" value = "<?php echo @$adds['actual_supplier_total_buy']?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[actual_supplier_total_sel]" id = "actual_supplier_total_sel" value = "<?php echo @$adds['actual_supplier_total_sel']?>" class="form-control wi">  
                        </div>
                        
                    </div>          
                </div>
          </div>  
        
        <div class="form-group "><div class="row"><hr/></div></div>  
          
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput">COMMISSION:</label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[commission1]" id = "commission1" value = "<?php echo @$adds['commission1']?>" class="form-control wi">
                        </div>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[commission_per]" id = "commission_per" value = "<?php echo @$adds['commission_per']?>" class="form-control " placeholder="%">%  
                        </div>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[commission_buy]" id = "commission_buy" value = "<?php echo @$adds['commission_buy']?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[commission_sel]" id = "commission_sel" value = "<?php echo @$adds['commission_sel']?>" class="form-control wi">  
                        </div>
                    </div>          
                </div>
         </div>  
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput">MARKUP:</label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[markup1]" id = "markup1" value = "<?php echo @$adds['markup1']?>" class="form-control wi">
                        </div>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[markup_per]" id = "markup_per" value = "<?php echo @$adds['markup_per']?>" class="form-control" placeholder="%">%  
                        </div>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[markup_buy]" id = "markup_buy" value = "<?php echo @$adds['markup_buy']?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[markup_sel]" id = "markup_sel" value = "<?php echo @$adds['markup_sel']?>" class="form-control wi">  
                        </div>
                        
                    </div>          
                </div>
          </div>  
          
        <div class="form-group "><div class="row"><hr/></div></div>  
        
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput">TOTAL W/O VAT:</label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[total_wo_vat]" id = "total_wo_vat" value = "<?php echo @$adds['total_wo_vat']?>" class="form-control wi">
                        </div>
                         <label class="col-sm-2 control-label text-center" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[total_wo_vat_buy]" id = "total_wo_vat_buy" value = "<?php echo @$adds['total_wo_vat_buy']?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[total_wo_vat_sel]" id = "total_wo_vat_sel" value = "<?php echo @$adds['total_wo_vat_sel']?>" class="form-control wi">  
                        </div>
                    </div>          
                </div>
          </div>  
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput">VAT COMMISSION:</label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[vat_commission]" id = "vat_commission" value = "<?php echo @$adds['vat_commission']?>" class="form-control wi">
                        </div>
                         <label class="col-sm-2 control-label text-center" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[vat_commission_buy]" id = "vat_commission_buy" value = "<?php echo @$adds['vat_commission_buy']?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[vat_commission_sel]" id = "vat_commission_sel" value = "<?php echo @$adds['vat_commission_sel']?>" class="form-control wi">  
                        </div>
                        
                    </div>          
                </div>
          </div>  
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput">VAT MARKUP:</label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[vat_markup]" id = "vat_markup" value = "<?php echo @$adds['vat_markup']?>" class="form-control wi">
                        </div>
                         <label class="col-sm-2 control-label text-center" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[vat_markup_buy]" id = "vat_markup_buy" value = "<?php echo @$adds['vat_markup_buy']?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[vat_markup_sel]" id = "vat_markup_sel" value = "<?php echo @$adds['vat_markup_sel']?>" class="form-control wi">  
                        </div>
                        
                    </div>          
                </div>
          </div>  
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput">VAT FOREX:</label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[vat_forex]" id = "vat_forex" value = "<?php echo (@$adds['vat_forex'])?@$adds['vat_forex']:'0.00'?>" class="form-control wi">
                        </div>
                         <label class="col-sm-2 control-label text-center" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[vat_forex_buy]" id = "vat_forex_buy" value = "<?php echo (@$adds['vat_forex_buy'])?@$adds['vat_forex_buy']:'0.00'?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[vat_forex_sel]" id = "vat_forex_sel" value = "<?php echo (@$adds['vat_forex_sel'])?@$adds['vat_forex_sel']:'0.00'?>" class="form-control wi">  
                        </div>
                    </div>          
                </div>
          </div>  
        <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-2 control-label" for="textinput"><strong>TOTAL w/ VAT:</strong></label>
                        <div class="col-sm-2">
                            <input type = "text" name="data[total_w_vat]" id = "total_w_vat" value = "<?php echo @$adds['total_w_vat']?>" class="form-control wi">
                        </div>
                         <label class="col-sm-2 control-label text-center" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[total_w_vat_buy]" id = "total_w_vat_buy" value = "<?php echo @$adds['total_w_vat_buy']?>" class="form-control wi">  
                        </div>
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-2">            
                            <input type = "text" name="data[total_w_vat_sel]" id = "total_w_vat_sel" value = "<?php echo @$adds['total_w_vat_sel']?>" class="form-control wi">  
                        </div>
                     </div>          
                </div>
          </div>  
        
        <div class="form-group "><div class="row"><hr/></div></div>
        
    </span>
    
    
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">Urgency Level:</label>
            <div class="col-sm-3">
             <div class="radio">
            <input type="radio" name="data[urgency_level]"  <?php if(@$adds['urgency_level'] == 0){ echo 'checked';} ?> id="radio1" value = "1">
            <label for="radio1">
                0
            </label>
        </div>
        <div class="radio">
            <input type="radio" name="data[urgency_level]" id="radio2" value = "1" <?php if(@$adds['urgency_level'] == 1){ echo 'checked';} ?>>
            <label for="radio2">
                1
            </label>
        </div>
        <div class="radio">
            <input type="radio" name="data[urgency_level]" id="radio3" value = "2" <?php if(@$adds['urgency_level'] == 2){ echo 'checked';} ?> >
            <label for="radio3">
                2
            </label>
        </div>
        <div class="radio">
            <input type="radio" name="data[urgency_level]" id="radio4" value = "3" <?php if(@$adds['urgency_level'] == 3){ echo 'checked';} ?> >
            <label for="radio4">
               3
            </label>
        </div>
              
            </div>
             <label class="col-sm-3 control-label text-center" for="textinput">Status:</label>
            <div class="col-sm-3">
            <select name="data[status_b]" id="" class="form-control">
              <?php if(@$adds['status_b']){ ?>
                   <option value = "<?php echo @$adds['status_b']?>"><?=@$adds['status_b']?></option>      
                  <?php }?>
             <option value="Open" <?php if(@$adds['status_b']=='Open'){ echo 'selected';} ?>>Open</option>
                <option value="Closed" <?php if(@$adds['status_b']=='Closed'){ echo 'selected';} ?>>Closed
                </option>
                <option value="Billing" <?php if(@$adds['status_b']=='Billing'){ echo 'selected';}?>>Billing
                </option>
                <option value="Cancelled" <?php if(@$adds['status_b']=='Cancelled'){ echo 'selected';}?>>Cancelled</option>          
                <option value="Ongoing" <?php if(@$adds['status_b']=='Ongoing'){ echo 'selected';} ?>>Ongoing</option>         
                <option value="Personal" <?php if(@$adds['status_b']=='Personal'){ echo 'selected';} ?>>Personal</option>
            </select>
              
            </div>
            </div>
          
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Note:</label>
            <div class="col-sm-9">
              <textarea name="data[note]" id="" cols="30" rows="5" class="form-control"><?=@$adds['note']?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Description:</label>
            <div class="col-sm-9">
              <textarea name="data[description]" id="" cols="30" rows="5" class="form-control"><?=@$adds['description']?></textarea>
            </div>
          </div>
        
          
        <div class="form-group text-center">
            <!--<button class="add-save btn btn-md">Save</button>-->
            <button  class="add-save btn btn-primary waves-effect waves-light insert_adds">Save</button>
            <a  href ="<?=base_url()?>admin/hotel" class="add-save btn btn-primary waves-effect waves-light">Cancel</a> 
        </div>
        
        </div>  
          <div class="clearfix"></div>
          <div class="col-md-6"></div>    
          <div class="col-md-6 cost_box"></div>  
          
            <input type="hidden" name="data[id]" value="<?=@$adds['id']?>">    
            <input type="hidden" name="data[pname]" value="<?php echo $this->uri->segment(2); ?>">   
          
      </form>
          </div>
        </div>
      </div>
    </div>

  </div>
        <!-- Container-fluid ends -->
        
     </div>


   <script>  
    //alert(accounting.formatMoney(5318008));
    var tot_vat=0;
    var tot_commission=0;
    var tot_markup=0;
    var unit_rate=$('#unit_rate').val();
    //var total_cost=$('#tot_cost').val();
    var tot_markup=0;
    var tot_cal=0;
    //to_date markup_amnt vat_amnt
    
    
    $(document).on('change','#fcrCode',function(){
            var id = $(this).val();
                $.ajax({                
                    url: "<?php echo base_url();?>admin/getXrate",
                    type: "POST",
                    data: {id:id},
                    error:function(request,response){
                        console.log(request);
                    },                  
                    success: function(result)
                    {
                        //alert(result);
                        if(result != "")
                        {
                            var res = result.split(',');//buy_forex
                            
                            $("#buy_forex").val(res[0]);
                            $("#sel_forex").val(res[1]);
                            
            total_supplier_base_rate = fu_total_supplier_base_rate();
            $('#total_supplier_base_rate').val(total_supplier_base_rate);                
            //alert(total_supplier_base_rate);                
                            
            var supplier_base_rate      = ($('#supplier_base_rate').val().replace(/,/g,'') =='')?0:$('#supplier_base_rate').val().replace(/,/g,'');
            var supplier_tax            = ($('#supplier_tax').val().replace(/,/g,'') =='')?0:$('#supplier_tax').val().replace(/,/g,'');
            var other_fees              = $('#other_fees').val();
            var total = parseFloat(total_supplier_base_rate)+parseFloat(supplier_tax)+parseFloat(other_fees);
            
            $('#supplier_total').val(total.toFixed(2));//                
                            
            var commission1             = ($('#commission1').val().replace(/,/g,'')=='')?0:$('#commission1').val().replace(/,/g,'');                
            var markup1                 = ($('#markup1').val().replace(/,/g,'') == '')?0:$('#markup1').val().replace(/,/g,'');
            var actual_supplier_total   = parseFloat(total) - parseFloat(commission1);
            $('#actual_supplier_total').val(actual_supplier_total.toFixed(2));
            
            var amount1= parseFloat(actual_supplier_total) + parseFloat(commission1) + parseFloat(markup1);
            
            /*$('#total_wo_vat').val(amount1.toFixed(2));
            
            var amount = commission1;
            //alert(amount);
            
            var amount2 = amount * 0.05; //Vat Commission
            $('#vat_commission').val(amount2.toFixed(2));
            
            var amount3 = markup1 * 0.05; //Vat Markup 
            $('#vat_markup').val(amount3.toFixed(2));*/
            
            var fcrCode = $('#fcrCode').val();
            if(fcrCode == 6)
            {
                var total_supplier_base_rate = $('#total_supplier_base_rate').val().replace(/,/g,'');
                var markup1                  = $('#markup1').val().replace(/,/g,'');
                var A1 = parseFloat(total_supplier_base_rate) + parseFloat(markup1);
                $('#total_wo_vat').val(A1.toFixed(2)); //--
                amount1 = A1;
            }
            else
            {
                $('#total_wo_vat').val(amount1.toFixed(2)); //--
            }
            
            var amount = commission1;
            //alert(amount);
            
            var amount2 = amount * 0.05; //Vat Commission
            $('#vat_commission').val(amount2.toFixed(2));
            
            if(fcrCode == 6)
            {
                var amount3 = A1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));
            }
            else
            {
                var amount3 = markup1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));     
            }
            
            var total_w_vat = amount1 + amount2 + amount3;
            $('#total_w_vat').val(total_w_vat.toFixed(2));
                            
            var supplier_base_rate      = $('#supplier_base_rate').val().replace(/,/g,'');
            var supplier_tax            = $('#supplier_tax').val().replace(/,/g,'');
                            
            //Start Buy Forex**************************************
                var buy_forex = res[0]; 
                var supplier_base_rate_buy = supplier_base_rate * buy_forex;
                $('#supplier_base_rate_buy').val(supplier_base_rate_buy.toFixed(2));
                
                var supplier_tax_buy = supplier_tax * buy_forex;
                $('#supplier_tax_buy').val(supplier_tax_buy.toFixed(2));
                
                var other_fees_buy = other_fees * buy_forex;
                $('#other_fees_buy').val(other_fees_buy.toFixed(2));
                
                
                var commission_buy = commission1 * buy_forex;
                $('#commission_buy').val(commission_buy.toFixed(2));
                
                var markup_buy = markup1 * buy_forex;
                $('#markup_buy').val(markup_buy.toFixed(2));
                
                var total_supplier_base_rate_buy = total_supplier_base_rate * buy_forex;
                $('#total_supplier_base_rate_buy').val(total_supplier_base_rate_buy);
                
                //var supplier_base_rate_buy      = $('#supplier_base_rate_buy').val();
                //var supplier_tax_buy          = $('#supplier_tax_buy').val();
                //var other_fees_buy              = $('#other_fees_buy').val();
                var total_buy = parseFloat(total_supplier_base_rate_buy)+parseFloat(supplier_tax_buy)+parseFloat(other_fees_buy);
                $('#supplier_total_buy').val(total_buy.toFixed(2));//
                
                var commission_buy              = ($('#commission_buy').val().replace(/,/g,'') == '')?0:$('#commission_buy').val().replace(/,/g,'');
                var actual_supplier_total_buy   = parseFloat(total_buy) - parseFloat(commission_buy);
                $('#actual_supplier_total_buy').val(actual_supplier_total_buy.toFixed(2));
                
                var markup_buy                  = ($('#markup_buy').val().replace(/,/g,'') == '')?0:$('#markup_buy').val().replace(/,/g,'');
                var amount1_buy= parseFloat(actual_supplier_total_buy) + parseFloat(commission_buy) + parseFloat(markup_buy);
             
                if(fcrCode == 6)
                {
                    var total_supplier_base_rate_buy = $('#total_supplier_base_rate_buy').val().replace(/,/g,'');
                    var markup_buy                  = $('#markup_buy').val().replace(/,/g,'');
                    var A2 = parseFloat(total_supplier_base_rate_buy) + parseFloat(markup_buy);
                    $('#total_wo_vat_buy').val(A1.toFixed(2)); //-- total_wo_vat_buy
                    amount1_buy = A2; 
                    
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
                    
                    var amount3_buy = A2 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
                else
                {
                    $('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
                
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
            
                    var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
            
                
                var total_w_vat_buy = amount1_buy + amount2_buy + amount3_buy;
                $('#total_w_vat_buy').val(total_w_vat_buy.toFixed(2));
                
             //End Buy Forex*******************************************
             
             //Start sel Forex**************************************
                var sel_forex = res[1]; 
                var supplier_base_rate_sel = supplier_base_rate * sel_forex;
                $('#supplier_base_rate_sel').val(supplier_base_rate_sel.toFixed(2));
                
                var supplier_tax_sel = supplier_tax * sel_forex;
                $('#supplier_tax_sel').val(supplier_tax_sel.toFixed(2));
                
                var other_fees_sel = other_fees * sel_forex;
                $('#other_fees_sel').val(other_fees_sel.toFixed(2));
                
                var commission_sel = commission1 * sel_forex;
                $('#commission_sel').val(commission_sel.toFixed(2));
                
                var markup_sel = markup1 * sel_forex;
                $('#markup_sel').val(markup_sel.toFixed(2));
                
                var total_supplier_base_rate_sel = total_supplier_base_rate * sel_forex;
                $('#total_supplier_base_rate_sel').val(total_supplier_base_rate_sel);
                
                var total_sel = parseFloat(total_supplier_base_rate_sel)+parseFloat(supplier_tax_sel)+parseFloat(other_fees_sel);
                $('#supplier_total_sel').val(total_sel.toFixed(2));//
                
                var commission_sel              = ($('#commission_sel').val().replace(/,/g,'')=='')?0:$('#commission_sel').val().replace(/,/g,'');
                var actual_supplier_total_sel   = parseFloat(total_sel) - parseFloat(commission_sel);
                $('#actual_supplier_total_sel').val(actual_supplier_total_sel.toFixed(2));
                
                //var actual_supplier_total_sel      = $('#actual_supplier_total_sel').val();
                //var commission_sel                  = $('#commission_sel').val();
                var markup_sel                        = ($('#markup_sel').val().replace(/,/g,'') =='')?0:$('#markup_sel').val().replace(/,/g,'');
                var amount1_sel= parseFloat(actual_supplier_total_sel) + parseFloat(commission_sel) + parseFloat(markup_sel);
                
                if(fcrCode == 6)
                {
                    var total_supplier_base_rate_sel = $('#total_supplier_base_rate_sel').val().replace(/,/g,'');
                    var markup_sel                  = $('#markup_sel').val().replace(/,/g,'');
                    var A3 = parseFloat(total_supplier_base_rate_sel) + parseFloat(markup_sel);
                    $('#total_wo_vat_sel').val(A3.toFixed(2)); //-- total_wo_vat_buy
                    amount1_sel = A3; 
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                    
                    var amount3_sel = A3 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    vat_forex_sel =0;
                }
                else
                {
                    $('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                
                    var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    var supplier_total_buy = ($('#supplier_total_buy').val()=='')?0:$('#supplier_total_buy').val();
                    var vat_forex_sel = (supplier_total_buy-actual_supplier_total_sel) * 0.5;
                    
                    $('#vat_forex_sel').val(vat_forex_sel.toFixed(2));
                }
                
                var total_w_vat_sel = amount1_sel + amount2_sel + amount3_sel + vat_forex_sel;
                $('#total_w_vat_sel').val(total_w_vat_sel.toFixed(2));
            //End sel Forex  **************************************
                            
                            
                        }
                        else
                        {
                            $("#buy_forex").val("");
                            $("#sel_forex").val("");
                        }
                    }
              });
    });
    
    function fu_total_supplier_base_rate()
    {
        var supplier_base_rate1     = $('#supplier_base_rate').val().replace(/,/g,'');
        var quantity                = $('#quantity').val();
	    var day_night               = $('#day_night').val();
	    var total = supplier_base_rate1 * (quantity*day_night);
	    return total;
    }
    
    
    function myFunction()
    {
        //alert('hi');
        var supplier_base_rate = $('#supplier_base_rate').val().replace(/,/g,'');
        $('#supplier_base_rate').val(accounting.formatMoney(supplier_base_rate));
        var supplier_base_rate_buy = $('#supplier_base_rate_buy').val().replace(/,/g,'');
        $('#supplier_base_rate_buy').val(accounting.formatMoney(supplier_base_rate_buy));
        var supplier_base_rate_sel = $('#supplier_base_rate_sel').val().replace(/,/g,'');
        $('#supplier_base_rate_sel').val(accounting.formatMoney(supplier_base_rate_sel));
        
        var total_supplier_base_rate = $('#total_supplier_base_rate').val().replace(/,/g,'');
        $('#total_supplier_base_rate').val(accounting.formatMoney(total_supplier_base_rate));
        var total_supplier_base_rate_buy = $('#total_supplier_base_rate_buy').val().replace(/,/g,'');
        $('#total_supplier_base_rate_buy').val(accounting.formatMoney(total_supplier_base_rate_buy));
        var total_supplier_base_rate_sel = $('#total_supplier_base_rate_sel').val().replace(/,/g,'');
        $('#total_supplier_base_rate_sel').val(accounting.formatMoney(total_supplier_base_rate_sel));
        
        var supplier_tax = $('#supplier_tax').val().replace(/,/g,'');
        $('#supplier_tax').val(accounting.formatMoney(supplier_tax));
        var supplier_tax_buy = $('#supplier_tax_buy').val().replace(/,/g,'');
        $('#supplier_tax_buy').val(accounting.formatMoney(supplier_tax_buy));
        var supplier_tax_sel = $('#supplier_tax_sel').val().replace(/,/g,'');
        $('#supplier_tax_sel').val(accounting.formatMoney(supplier_tax_sel));
        
        var other_fees = $('#other_fees').val().replace(/,/g,'');
        $('#other_fees').val(accounting.formatMoney(other_fees));
        var other_fees_buy = $('#other_fees_buy').val().replace(/,/g,'');
        $('#other_fees_buy').val(accounting.formatMoney(other_fees_buy));
        var other_fees_sel = $('#other_fees_sel').val().replace(/,/g,'');
        $('#other_fees_sel').val(accounting.formatMoney(other_fees_sel));
        
        var supplier_total = $('#supplier_total').val().replace(/,/g,'');
        $('#supplier_total').val(accounting.formatMoney(supplier_total));
        var supplier_total_buy = $('#supplier_total_buy').val().replace(/,/g,'');
        $('#supplier_total_buy').val(accounting.formatMoney(supplier_total_buy));
        var supplier_total_sel = $('#supplier_total_sel').val().replace(/,/g,'');
        $('#supplier_total_sel').val(accounting.formatMoney(supplier_total_sel));
        
        var actual_supplier_total = $('#actual_supplier_total').val().replace(/,/g,'');
        $('#actual_supplier_total').val(accounting.formatMoney(actual_supplier_total));
        var actual_supplier_total_buy = $('#actual_supplier_total_buy').val().replace(/,/g,'');
        $('#actual_supplier_total_buy').val(accounting.formatMoney(actual_supplier_total_buy));
        var actual_supplier_total_sel = $('#actual_supplier_total_sel').val().replace(/,/g,'');
        $('#actual_supplier_total_sel').val(accounting.formatMoney(actual_supplier_total_sel));
        
        var commission1 = $('#commission1').val().replace(/,/g,'');
        $('#commission1').val(accounting.formatMoney(commission1));
        var commission_buy = $('#commission_buy').val().replace(/,/g,'');
        $('#commission_buy').val(accounting.formatMoney(commission_buy));
        var commission_sel = $('#commission_sel').val().replace(/,/g,'');
        $('#commission_sel').val(accounting.formatMoney(commission_sel));
        
        var markup1 = $('#markup1').val().replace(/,/g,'');
        $('#markup1').val(accounting.formatMoney(markup1));
        var markup_buy = $('#markup_buy').val().replace(/,/g,'');
        $('#markup_buy').val(accounting.formatMoney(markup_buy));
        var markup_sel = $('#markup_sel').val().replace(/,/g,'');
        $('#markup_sel').val(accounting.formatMoney(markup_sel));
        
        var total_wo_vat = $('#total_wo_vat').val().replace(/,/g,'');
        $('#total_wo_vat').val(accounting.formatMoney(total_wo_vat));
        var total_wo_vat_buy = $('#total_wo_vat_buy').val().replace(/,/g,'');
        $('#total_wo_vat_buy').val(accounting.formatMoney(total_wo_vat_buy));
        var total_wo_vat_sel = $('#total_wo_vat_sel').val().replace(/,/g,'');
        $('#total_wo_vat_sel').val(accounting.formatMoney(total_wo_vat_sel));
        
        var total_w_vat = $('#total_w_vat').val().replace(/,/g,'');
        $('#total_w_vat').val(accounting.formatMoney(total_w_vat));
        var total_w_vat_buy = $('#total_w_vat_buy').val().replace(/,/g,'');
        $('#total_w_vat_buy').val(accounting.formatMoney(total_w_vat_buy));
        var total_w_vat_sel = $('#total_w_vat_sel').val().replace(/,/g,'');
        $('#total_w_vat_sel').val(accounting.formatMoney(total_w_vat_sel));
        //alert('hi');
    }
    
    $(document).on('change keyup','#quantity',function(){
        var quntiye = $(this).val();
        //alert('HII');
        if(quntiye < 1)
        {
            alert('Please Enter Valid quantity');
            $(this).val('');
            return false;
        }
            
        call_calculation();
        //alert(quntiye);
    });
    
    
    
    
    $(document).on('change keyup','#supplier_base_rate',function()
    { 
            //call_calculation();
            total_supplier_base_rate = fu_total_supplier_base_rate();
            $('#total_supplier_base_rate').val(total_supplier_base_rate.toFixed(2));
            
            var markup_per              = $('#markup_per').val().replace(/,/g,'');
            var markup1 = (total_supplier_base_rate*markup_per)/100;
            $('#markup1').val(markup1.toFixed(2));//                           
            
            var supplier_tax            = ($('#supplier_tax').val() =='')?0:$('#supplier_tax').val();
            var other_fees              = $('#other_fees').val().replace(/,/g,'');
            var total = parseFloat(total_supplier_base_rate)+parseFloat(supplier_tax)+parseFloat(other_fees);
            
            $('#supplier_total').val(total.toFixed(2));//buy_forex
            
            var commission1             = ($('#commission1').val().replace(/,/g,'')=='')?0:$('#commission1').val().replace(/,/g,'');
            var actual_supplier_total   = parseFloat(total) - parseFloat(commission1);
            $('#actual_supplier_total').val(actual_supplier_total.toFixed(2));
            
            //var actual_supplier_total    = $('#actual_supplier_total').val();
           
            var markup1                     = ($('#markup1').val().replace(/,/g,'') == '')?0:$('#markup1').val().replace(/,/g,'');
            var amount1 = parseFloat(actual_supplier_total) + parseFloat(commission1) + parseFloat(markup1);
            
            var fcrCode = $('#fcrCode').val();
            if(fcrCode == 6)
            {
                var total_supplier_base_rate = $('#total_supplier_base_rate').val().replace(/,/g,'');
                var markup1                  = $('#markup1').val().replace(/,/g,'');
                var A1 = parseFloat(total_supplier_base_rate) + parseFloat(markup1);
                $('#total_wo_vat').val(A1.toFixed(2)); //--  
                 amount1 = A1;
            }
            else
            {
                $('#total_wo_vat').val(amount1.toFixed(2)); //--
            }
            
            var amount = commission1;
            //alert(amount);
            
            var amount2 = amount * 0.05; //Vat Commission
            $('#vat_commission').val(amount2.toFixed(2));
            
            if(fcrCode == 6)
            {
                var amount3 = A1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));
            }
            else
            {
                var amount3 = markup1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));     
            }
            
            var total_w_vat = amount1 + amount2 + amount3;
            $('#total_w_vat').val(total_w_vat.toFixed(2)); //
            
            //Start Buy Forex**************************************
                var buy_forex = $('#buy_forex').val();
                var supplier_base_rate = $('#supplier_base_rate').val().replace(/,/g,'');
                
                var supplier_base_rate_buy = supplier_base_rate * buy_forex;
                $('#supplier_base_rate_buy').val(supplier_base_rate_buy.toFixed(2));
                
                var supplier_tax_buy = supplier_tax * buy_forex;
                $('#supplier_tax_buy').val(supplier_tax_buy.toFixed(2));
                
                var other_fees_buy = other_fees * buy_forex;
                $('#other_fees_buy').val(other_fees_buy.toFixed(2));
                
                var total_supplier_base_rate_buy = total_supplier_base_rate * buy_forex;
                $('#total_supplier_base_rate_buy').val(total_supplier_base_rate_buy.toFixed(2));
                
                var supplier_base_rate_buy      = $('#supplier_base_rate_buy').val().replace(/,/g,'');
                //var supplier_tax_buy           = $('#supplier_tax_buy').val();
                //var other_fees_buy              = $('#other_fees_buy').val();
                var total_buy = parseFloat(total_supplier_base_rate_buy)+parseFloat(supplier_tax_buy)+parseFloat(other_fees_buy);
                $('#supplier_total_buy').val(total_buy.toFixed(2));//
                
                var commission_buy              = $('#commission_buy').val().replace(/,/g,'');
                var actual_supplier_total_buy   = parseFloat(total_buy) - parseFloat(commission_buy);
                $('#actual_supplier_total_buy').val(actual_supplier_total_buy.toFixed(2));
                
                var markup_buy                  = ($('#markup_buy').val().replace(/,/g,'') == '')?0:$('#markup_buy').val().replace(/,/g,'');
                var amount1_buy= parseFloat(actual_supplier_total_buy) + parseFloat(commission_buy) + parseFloat(markup_buy);
                 if(fcrCode == 6)
                {
                    var total_supplier_base_rate_buy = $('#total_supplier_base_rate_buy').val().replace(/,/g,'');
                    var markup_buy                  = $('#markup_buy').val().replace(/,/g,'');
                    var A2 = parseFloat(total_supplier_base_rate_buy) + parseFloat(markup_buy);
                    $('#total_wo_vat_buy').val(A1.toFixed(2)); //-- total_wo_vat_buy
                    amount1_buy = A2; 
                    
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
                    
                    var amount3_buy = A2 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
                else
                {
                    $('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
                
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
            
                    var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
            
            
                var total_w_vat_buy = amount1_buy + amount2_buy + amount3_buy;
                $('#total_w_vat_buy').val(total_w_vat_buy.toFixed(2));
                
             //End Buy Forex*******************************************
            
            
            //Start sel Forex**************************************
                var sel_forex = $('#sel_forex').val(); 
                var supplier_base_rate_sel = supplier_base_rate * sel_forex;
                $('#supplier_base_rate_sel').val(supplier_base_rate_sel.toFixed(2));
                
                var supplier_tax_sel = supplier_tax * sel_forex;
                $('#supplier_tax_sel').val(supplier_tax_sel.toFixed(2));
                
                var other_fees_sel = other_fees * sel_forex;
                $('#other_fees_sel').val(other_fees_sel.toFixed(2));
                
                var total_supplier_base_rate_sel = total_supplier_base_rate * sel_forex;
                $('#total_supplier_base_rate_sel').val(total_supplier_base_rate_sel.toFixed(2));
                
                //var supplier_base_rate_sel      = $('#supplier_base_rate_sel').val();//supplier_base_rate_sel
                //var supplier_tax_sel            = $('#supplier_tax_sel').val();
                //var other_fees_sel              = $('#other_fees_sel').val();
                var total_sel = parseFloat(total_supplier_base_rate_sel)+parseFloat(supplier_tax_sel)+parseFloat(other_fees_sel);
                $('#supplier_total_sel').val(total_sel.toFixed(2));//
                
                var commission_sel              = $('#commission_sel').val();
                var actual_supplier_total_sel   = parseFloat(total_sel) - parseFloat(commission_sel);
                $('#actual_supplier_total_sel').val(actual_supplier_total_sel.toFixed(2));
                
                 //var actual_supplier_total_sel       = $('#actual_supplier_total_sel').val();
                //var commission_sel                  = $('#commission_sel').val();
                var markup_sel                      = $('#markup_sel').val();
                var amount1_sel= parseFloat(actual_supplier_total_sel) + parseFloat(commission_sel) + parseFloat(markup_sel);
                /*$('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                
                var amount2_sel = sel_forex * amount2;
                $('#vat_commission_sel').val(amount2_sel.toFixed(2));
            
                var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                
                var supplier_total_buy = $('#supplier_total_buy').val().replace(/,/g,'');
                var vat_forex_sel = (supplier_total_buy-actual_supplier_total_sel) * 0.05;
                $('#vat_forex_sel').val(vat_forex_sel.toFixed(2)); */
                
                if(fcrCode == 6)
                {
                    var total_supplier_base_rate_sel = $('#total_supplier_base_rate_sel').val().replace(/,/g,'');
                    var markup_sel                  = $('#markup_sel').val().replace(/,/g,'');
                    var A3 = parseFloat(total_supplier_base_rate_sel) + parseFloat(markup_sel);
                    $('#total_wo_vat_sel').val(A3.toFixed(2)); //-- total_wo_vat_buy
                    amount1_sel = A3; 
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                    
                    var amount3_sel = A3 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    vat_forex_sel =0;
                }
                else
                {
                    $('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                
                    var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    var supplier_total_buy = ($('#supplier_total_buy').val()=='')?0:$('#supplier_total_buy').val();
                    var vat_forex_sel = (supplier_total_buy-actual_supplier_total_sel) * 0.5;
                    
                    $('#vat_forex_sel').val(vat_forex_sel.toFixed(2));
                }
                 
            
                var total_w_vat_sel = amount1_sel + amount2_sel + amount3_sel + vat_forex_sel;
                $('#total_w_vat_sel').val(total_w_vat_sel.toFixed(2));
            //End sel Forex  **************************************
            
    });
     
    $(document).on('change keyup','#supplier_tax',function(){
        
            total_supplier_base_rate = fu_total_supplier_base_rate();
            $('#total_supplier_base_rate').val(total_supplier_base_rate.toFixed(2));
        
            var supplier_base_rate      = $('#supplier_base_rate').val().replace(/,/g,'');
            var supplier_tax            = $('#supplier_tax').val().replace(/,/g,'');
            var other_fees              = $('#other_fees').val().replace(/,/g,'');
            var total                   = parseFloat(total_supplier_base_rate)+parseFloat(supplier_tax)+parseFloat(other_fees);
            $('#supplier_total').val(total.toFixed(2));//
            
            //actual_supplier_total Code
            //var commission1             = $('#commission1').val();
            var commission1             = ($('#commission1').val().replace(/,/g,'')=='')?0:$('#commission1').val().replace(/,/g,'');
            var actual_supplier_total   = parseFloat(total) - parseFloat(commission1);
            $('#actual_supplier_total').val(actual_supplier_total.toFixed(2));
            
            var markup1                     = ($('#markup1').val().replace(/,/g,'') == '')?0:$('#markup1').val().replace(/,/g,'');
            var amount1= parseFloat(actual_supplier_total) + parseFloat(commission1) + parseFloat(markup1);
            
            /*$('#total_wo_vat').val(amount1.toFixed(2));
            
            var amount = commission1;
            //alert(amount);
            var amount2 = amount * 0.05; //Vat Commission
            $('#vat_commission').val(amount2.toFixed(2));
            
            var amount3 = markup1 * 0.05; //Vat Markup 
            $('#vat_markup').val(amount3.toFixed(2));
            */
            
            var fcrCode = $('#fcrCode').val();
            if(fcrCode == 6)
            {
                var total_supplier_base_rate = $('#total_supplier_base_rate').val().replace(/,/g,'');
                var markup1                  = $('#markup1').val().replace(/,/g,'');
                var A1 = parseFloat(total_supplier_base_rate) + parseFloat(markup1);
                $('#total_wo_vat').val(A1.toFixed(2)); //--     
                amount1 = A1;
            }
            else
            {
                $('#total_wo_vat').val(amount1.toFixed(2)); //--
            }
            
            var amount = commission1;
            //alert(amount);
            
            var amount2 = amount * 0.05; //Vat Commission
            $('#vat_commission').val(amount2.toFixed(2));
            
            if(fcrCode == 6)
            {
                var amount3 = A1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));
            }
            else
            {
                var amount3 = markup1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));     
            }
            
            
            var total_w_vat = amount1 + amount2 + amount3;
            $('#total_w_vat').val(total_w_vat.toFixed(2));
            
            //Start Buy Forex**************************************
                //supplier_tax_buy forex Code
                var buy_forex = $('#buy_forex').val(); 
                var supplier_tax_buy = supplier_tax * buy_forex;
                $('#supplier_tax_buy').val(supplier_tax_buy.toFixed(2));
                
                
                var total_supplier_base_rate_buy = total_supplier_base_rate * buy_forex;
                $('#total_supplier_base_rate_buy').val(total_supplier_base_rate_buy.toFixed(2));
                
                var supplier_base_rate_buy      = $('#supplier_base_rate_buy').val().replace(/,/g,'');
                //var supplier_tax_buy            = $('#supplier_tax_buy').val();
                var other_fees_buy              = $('#other_fees_buy').val().replace(/,/g,'');
                var total_buy = parseFloat(total_supplier_base_rate_buy)+parseFloat(supplier_tax_buy)+parseFloat(other_fees_buy);
                $('#supplier_total_buy').val(total_buy.toFixed(2));//
                
                var commission_buy             = ($('#commission_buy').val().replace(/,/g,'') =='')?0:$('#commission_buy').val().replace(/,/g,'');
                var actual_supplier_total_buy   = parseFloat(total_buy) - parseFloat(commission_buy);
                $('#actual_supplier_total_buy').val(actual_supplier_total_buy.toFixed(2));
                
                //alert(actual_supplier_total_buy);
                
                var markup_buy                  = ($('#markup_buy').val().replace(/,/g,'') == '')?0:$('#markup_buy').val().replace(/,/g,'');
                var amount1_buy= parseFloat(actual_supplier_total_buy) + parseFloat(commission_buy) + parseFloat(markup_buy);
               /* $('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
                
                var amount2_buy = buy_forex * amount2;
                $('#vat_commission_buy').val(amount2_buy.toFixed(2));
            
                var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
                $('#vat_markup_buy').val(amount3_buy.toFixed(2)); */
                
                 if(fcrCode == 6)
                {
                    var total_supplier_base_rate_buy = $('#total_supplier_base_rate_buy').val().replace(/,/g,'');
                    var markup_buy                  = $('#markup_buy').val().replace(/,/g,'');
                    var A2 = parseFloat(total_supplier_base_rate_buy) + parseFloat(markup_buy);
                    $('#total_wo_vat_buy').val(A1.toFixed(2)); //-- total_wo_vat_buy
                    amount1_buy = A2; 
                    
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
                    
                    var amount3_buy = A2 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
                else
                {
                    $('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
                
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
            
                    var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
            
            
                var total_w_vat_buy = amount1_buy + amount2_buy + amount3_buy;
                $('#total_w_vat_buy').val(total_w_vat_buy.toFixed(2));
        //End Buy Forex****************************************
            
        //Start sel Forex**************************************
                var sel_forex = $('#sel_forex').val(); 
                var supplier_tax_sel = supplier_tax * sel_forex;
                $('#supplier_tax_sel').val(supplier_tax_sel.toFixed(2));
                
                var total_supplier_base_rate_buy = total_supplier_base_rate * buy_forex;
                $('#total_supplier_base_rate_buy').val(total_supplier_base_rate_buy.toFixed(2));
                
                var supplier_base_rate_sel      = $('#supplier_base_rate_sel').val().replace(/,/g,'');
                //var supplier_tax_sel            = $('#supplier_tax_sel').val();
                var other_fees_sel              = $('#other_fees_sel').val().replace(/,/g,'');
                var total_sel = parseFloat(total_supplier_base_rate_buy)+parseFloat(supplier_tax_sel)+parseFloat(other_fees_sel);
                $('#supplier_total_sel').val(total_sel.toFixed(2));//
                
                var commission_sel              = ($('#commission_sel').val().replace(/,/g,'') == '')?0:$('#commission_sel').val().replace(/,/g,'');
                var actual_supplier_total_sel   = parseFloat(total_sel) - parseFloat(commission_sel);
                $('#actual_supplier_total_sel').val(actual_supplier_total_sel.toFixed(2));
                
                //After Commision Code 
                var markup_sel                      = ($('#markup_sel').val().replace(/,/g,'') == '')?0:$('#markup_sel').val().replace(/,/g,'');
                var amount1_sel= parseFloat(actual_supplier_total_sel) + parseFloat(commission_sel) + parseFloat(markup_sel);
               /* $('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                
                var amount2_sel = sel_forex * amount2;
                $('#vat_commission_sel').val(amount2_sel.toFixed(2));
            
                var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                
                var supplier_total_buy = $('#supplier_total_buy').val().replace(/,/g,'');
                var vat_forex_sel = (supplier_total_buy-actual_supplier_total_sel) * 0.05;
                $('#vat_forex_sel').val(vat_forex_sel.toFixed(2)); */
                
                if(fcrCode == 6)
                {
                    var total_supplier_base_rate_sel = $('#total_supplier_base_rate_sel').val().replace(/,/g,'');
                    var markup_sel                  = $('#markup_sel').val().replace(/,/g,'');
                    var A3 = parseFloat(total_supplier_base_rate_sel) + parseFloat(markup_sel);
                    $('#total_wo_vat_sel').val(A3.toFixed(2)); //-- total_wo_vat_buy
                    amount1_sel = A3; 
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                    
                    var amount3_sel = A3 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    vat_forex_sel =0;
                }
                else
                {
                    $('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                
                    var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    var supplier_total_buy = ($('#supplier_total_buy').val()=='')?0:$('#supplier_total_buy').val();
                    var vat_forex_sel = (supplier_total_buy-actual_supplier_total_sel) * 0.5;
                    
                    $('#vat_forex_sel').val(vat_forex_sel.toFixed(2));
                }
                
            
                var total_w_vat_sel = amount1_sel + amount2_sel + amount3_sel + vat_forex_sel;
                $('#total_w_vat_sel').val(total_w_vat_sel.toFixed(2));
            //End sel Forex  **************************************
     });
     
    $(document).on('change keyup','#other_fees',function(){
         
            total_supplier_base_rate = fu_total_supplier_base_rate();
            $('#total_supplier_base_rate').val(total_supplier_base_rate.toFixed(2));
            
            var other_fees              = ($('#other_fees').val().replace(/,/g,'')=='')?0:$('#other_fees').val().replace(/,/g,''); 
            
            var supplier_base_rate      = $('#supplier_base_rate').val().replace(/,/g,'');
            var supplier_tax            = $('#supplier_tax').val().replace(/,/g,'');
            
            var total                   = parseFloat(total_supplier_base_rate)+parseFloat(supplier_tax)+parseFloat(other_fees);
            $('#supplier_total').val(total.toFixed(2));//
            
            //var commission1           = $('#commission1').val();
            var commission1             = ($('#commission1').val().replace(/,/g,'')=='')?0:$('#commission1').val().replace(/,/g,'');
            var actual_supplier_total   = parseFloat(total) - parseFloat(commission1);
            $('#actual_supplier_total').val(actual_supplier_total.toFixed(2));
            
            //Start Buy Forex**************************************
                //supplier_tax_buy forex Code
                var buy_forex = $('#buy_forex').val(); 
                var other_fees_buy = other_fees * buy_forex;
                $('#other_fees_buy').val(other_fees_buy.toFixed(2));
                
                var total_supplier_base_rate_buy = total_supplier_base_rate * buy_forex;
                $('#total_supplier_base_rate_buy').val(total_supplier_base_rate_buy);
                
                var supplier_base_rate_buy      = $('#supplier_base_rate_buy').val().replace(/,/g,'');
                var supplier_tax_buy            = $('#supplier_tax_buy').val().replace(/,/g,'');
                var other_fees_buy              = $('#other_fees_buy').val().replace(/,/g,'');
                var total_buy = parseFloat(total_supplier_base_rate_buy)+parseFloat(supplier_tax_buy)+parseFloat(other_fees_buy);
                $('#supplier_total_buy').val(total_buy.toFixed(2));//
                
                var commission_buy             = $('#commission_buy').val().replace(/,/g,'');
                var actual_supplier_total_buy   = parseFloat(total_buy) - parseFloat(commission_buy);
                $('#actual_supplier_total_buy').val(actual_supplier_total_buy.toFixed(2));
            //End Buy Forex*******************************************
            
            //Start sel Forex**************************************
                var sel_forex = $('#sel_forex').val(); 
                var other_fees_sel = other_fees * sel_forex;
                $('#other_fees_sel').val(other_fees_sel.toFixed(2));
                
                var total_supplier_base_rate_sel = total_supplier_base_rate * sel_forex;
                $('#total_supplier_base_rate_sel').val(total_supplier_base_rate_sel.toFixed(2));
                
                var supplier_base_rate_sel      = $('#supplier_base_rate_sel').val().replace(/,/g,'');
                var supplier_tax_sel            = $('#supplier_tax_sel').val().replace(/,/g,'');
                var other_fees_sel              = $('#other_fees_sel').val().replace(/,/g,'');
                var total_sel = parseFloat(total_supplier_base_rate_sel)+parseFloat(supplier_tax_sel)+parseFloat(other_fees_sel);
                $('#supplier_total_sel').val(total_sel.toFixed(2));//
                
                var commission_sel             = $('#commission_sel').val().replace(/,/g,'');
                var actual_supplier_total_sel   = parseFloat(total_sel) - parseFloat(commission_sel);
                $('#actual_supplier_total_sel').val(actual_supplier_total_sel.toFixed(2));
            //End sel Forex  **************************************
     });
     
    $(document).on('change keyup','#actual_supplier_total',function(){
            /*var supplier_base_rate      = $('#supplier_base_rate').val();
            var supplier_tax            = $('#supplier_tax').val();
            var other_fees              = $('#other_fees').val();
            var total                   = parseFloat(supplier_base_rate)+parseFloat(supplier_tax)+parseFloat(other_fees);
            $('#supplier_total').val(total.toFixed(2));
            
            var commission1             = $('#commission1').val();
            var actual_supplier_total   = parseFloat(total) - parseFloat(commission1);
            $('#actual_supplier_total').val(actual_supplier_total.toFixed(2));*/
     });
     
    $(document).on('change keyup','#commission1',function(){
           
            /*  var supplier_total         = $('#supplier_total').val();
                var actual_supplier_total   = parseFloat(supplier_total) - parseFloat(commission1);
                $('#actual_supplier_total').val(actual_supplier_total.toFixed(2));
            */
            
            //var supplier_base_rate          = $('#supplier_base_rate').val();
            var total_supplier_base_rate    = $('#total_supplier_base_rate').val().replace(/,/g,'');
            var totalSupp                   = (total_supplier_base_rate/100);
            var perc                        = commission1/totalSupp;
            $('#commission_per').val(perc.toFixed(2));
            
           
            var supplier_total          = $('#supplier_total').val().replace(/,/g,'');
            var actual_supplier_total   = supplier_total - commission1;
            $('#actual_supplier_total').val(actual_supplier_total.toFixed(2));
            
            //var actual_supplier_total     = $('#actual_supplier_total').val();
            var commission1                 = $('#commission1').val().replace(/,/g,'');
            var markup1                     = $('#markup1').val().replace(/,/g,'');
            var amount1= parseFloat(actual_supplier_total) + parseFloat(commission1) + parseFloat(markup1);
            /*  $('#total_wo_vat').val(amount1.toFixed(2));
                var amount = commission1;
                var amount2 = amount * 0.05; //Vat Commission
                $('#vat_commission').val(amount2.toFixed(2));
                var amount3 = markup1 * 0.05; //Vat Markup 
                $('#vat_markup').val(amount3.toFixed(2));
            */
            
            var fcrCode = $('#fcrCode').val();
            if(fcrCode == 6)
            {
                var total_supplier_base_rate = $('#total_supplier_base_rate').val().replace(/,/g,'');
                var markup1                  = $('#markup1').val().replace(/,/g,'');
                var A1 = parseFloat(total_supplier_base_rate) + parseFloat(markup1);
                $('#total_wo_vat').val(A1.toFixed(2)); //--     
                amount1 = A1;
            }
            else
            {
                $('#total_wo_vat').val(amount1.toFixed(2)); //--
            }
            
            var amount = commission1;
            //alert(amount);
            
            var amount2 = amount * 0.05; //Vat Commission
            $('#vat_commission').val(amount2.toFixed(2));
            
            if(fcrCode == 6)
            {
                var amount3 = A1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));
            }
            else
            {
                var amount3 = markup1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));     
            }
            
            var total_w_vat = amount1 + amount2 + amount3;
            $('#total_w_vat').val(total_w_vat.toFixed(2));
            
            
            //************Start Buy Forex Code ****************
                var buy_forex           = $('#buy_forex').val()
                var commission_buy      = buy_forex * amount;
                $('#commission_buy').val(commission_buy.toFixed(2));
                
                var supplier_total_buy          = $('#supplier_total_buy').val().replace(/,/g,'');
                var actual_supplier_total_buy = supplier_total_buy - commission_buy;
                $('#actual_supplier_total_buy').val(actual_supplier_total_buy.toFixed(2));
                
                //var actual_supplier_total_buy       = $('#actual_supplier_total_buy').val();
                //var commission_buy                  = $('#commission_buy').val();
                var markup_buy                      = $('#markup_buy').val().replace(/,/g,'');
                var amount1_buy= parseFloat(actual_supplier_total_buy) + parseFloat(commission_buy) + parseFloat(markup_buy);
                
                /*$('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
                
                var amount2_buy = buy_forex * amount2;
                $('#vat_commission_buy').val(amount2_buy.toFixed(2));
            
                var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
                $('#vat_markup_buy').val(amount3_buy.toFixed(2)); */
                
                 if(fcrCode == 6)
                {
                    var total_supplier_base_rate_buy = $('#total_supplier_base_rate_buy').val().replace(/,/g,'');
                    var markup_buy                  = $('#markup_buy').val().replace(/,/g,'');
                    var A2 = parseFloat(total_supplier_base_rate_buy) + parseFloat(markup_buy);
                    $('#total_wo_vat_buy').val(A1.toFixed(2)); //-- total_wo_vat_buy
                    amount1_buy = A2; 
                    
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
                    
                    var amount3_buy = A2 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
                else
                {
                    $('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
                
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
            
                    var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
            
            
                var total_w_vat_buy = amount1_buy + amount2_buy + amount3_buy;
                $('#total_w_vat_buy').val(total_w_vat_buy.toFixed(2));
           //End Buy Forex Code***********************
           
           //Start sel Forex**************************************
                var sel_forex           = $('#sel_forex').val()
                var commission_sel      = sel_forex * amount;
                $('#commission_sel').val(commission_sel.toFixed(2));
                
                var supplier_total_sel          = $('#supplier_total_sel').val().replace(/,/g,'');
                var actual_supplier_total_sel = supplier_total_sel - commission_sel;
                $('#actual_supplier_total_sel').val(actual_supplier_total_sel.toFixed(2));
                
                //var actual_supplier_total_sel       = $('#actual_supplier_total_sel').val();
                //var commission_sel                  = $('#commission_sel').val();
                var markup_sel                      = $('#markup_sel').val().replace(/,/g,'');
                var amount1_sel= parseFloat(actual_supplier_total_sel) + parseFloat(commission_sel) + parseFloat(markup_sel);
                /*$('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                
                var amount2_sel = sel_forex * amount2;
                $('#vat_commission_sel').val(amount2_sel.toFixed(2));
            
                var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                
                
                var vat_forex_sel = (supplier_total_buy-actual_supplier_total_sel) * 0.05;
                $('#vat_forex_sel').val(vat_forex_sel.toFixed(2)); */
                
                if(fcrCode == 6)
                {
                    var total_supplier_base_rate_sel = $('#total_supplier_base_rate_sel').val().replace(/,/g,'');
                    var markup_sel                  = $('#markup_sel').val().replace(/,/g,'');
                    var A3 = parseFloat(total_supplier_base_rate_sel) + parseFloat(markup_sel);
                    $('#total_wo_vat_sel').val(A3.toFixed(2)); //-- total_wo_vat_buy
                    amount1_sel = A3; 
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                    
                    var amount3_sel = A3 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    vat_forex_sel =0;
                }
                else
                {
                    $('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                
                    var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    var supplier_total_buy = ($('#supplier_total_buy').val()=='')?0:$('#supplier_total_buy').val();
                    var vat_forex_sel = (supplier_total_buy-actual_supplier_total_sel) * 0.5;
                    
                    $('#vat_forex_sel').val(vat_forex_sel.toFixed(2));
                }
            
                var total_w_vat_sel = amount1_sel + amount2_sel + amount3_sel + vat_forex_sel;
                $('#total_w_vat_sel').val(total_w_vat_sel.toFixed(2));
                
                
            //End sel Forex  **************************************
    });
     
    $(document).on('change keyup','#markup1',function(){
        var amount                  = ($('#markup1').val().replace(/,/g,'')=='')?0:$('#markup1').val().replace(/,/g,''); // G markup_per
        //alert(amount);
        var supplier_total        = $('#supplier_total').val().replace(/,/g,''); //D
        var percentage = ((parseFloat(amount)+parseFloat(supplier_total))*100-parseFloat(supplier_total)*100)/(+parseFloat(amount)+parseFloat(supplier_total));
        $('#markup_per').val(percentage.toFixed(2));
        
        var actual_supplier_total      = $('#actual_supplier_total').val().replace(/,/g,'');
        var commission1             = $('#commission1').val().replace(/,/g,'');
        var markup1                 = $('#markup1').val().replace(/,/g,'');
            
        var amount1= parseFloat(actual_supplier_total) + parseFloat(commission1) + parseFloat(markup1);
       
        /*
        $('#total_wo_vat').val(amount1.toFixed(2));
            
        var amount2 = commission1 * 0.05; //Vat Commission
        $('#vat_commission').val(amount2.toFixed(2));
            
        var amount3 = amount * 0.05; //Vat Markup 
        $('#vat_markup').val(amount3.toFixed(2));
        */
        
        var fcrCode = $('#fcrCode').val();
            if(fcrCode == 6)
            {
                var total_supplier_base_rate = $('#total_supplier_base_rate').val().replace(/,/g,'');
                var markup1                  = $('#markup1').val().replace(/,/g,'');
                var A1 = parseFloat(total_supplier_base_rate) + parseFloat(markup1);
                $('#total_wo_vat').val(A1.toFixed(2)); //--      
                amount1 = A1;
            }
            else
            {
                $('#total_wo_vat').val(amount1.toFixed(2)); //--
            }
            
            var amount = commission1;
            //alert(amount);
            
            var amount2 = amount * 0.05; //Vat Commission
            $('#vat_commission').val(amount2.toFixed(2));
            
            if(fcrCode == 6)
            {
                var amount3 = A1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));
            }
            else
            {
                var amount3 = markup1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));     
            }
            var total_w_vat = amount1 + amount2 + amount3;
            $('#total_w_vat').val(total_w_vat.toFixed(2));
            
            //************Start Buy Forex Code ****************
                var buy_forex       = $('#buy_forex').val().replace(/,/g,''); 
                var markup_buy      = buy_forex * markup1;
                
                $('#markup_buy').val(markup_buy.toFixed(2));
                
                var actual_supplier_total_buy       = $('#actual_supplier_total_buy').val().replace(/,/g,'');
                var commission_buy                  = $('#commission_buy').val().replace(/,/g,'');
                //var markup_buy                      = $('#markup_buy').val();
                var amount1_buy= parseFloat(actual_supplier_total_buy) + parseFloat(commission_buy) + parseFloat(markup_buy);
                
                /*$('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
                
                var amount2_buy = buy_forex * amount2;
                $('#vat_commission_buy').val(amount2_buy.toFixed(2));
            
                var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
                $('#vat_markup_buy').val(amount3_buy.toFixed(2)); */
                
                if(fcrCode == 6)
                {
                    var total_supplier_base_rate_buy = $('#total_supplier_base_rate_buy').val().replace(/,/g,'');
                    var markup_buy                  = $('#markup_buy').val().replace(/,/g,'');
                    var A2 = parseFloat(total_supplier_base_rate_buy) + parseFloat(markup_buy);
                    $('#total_wo_vat_buy').val(A2.toFixed(2)); //-- total_wo_vat_buy
                    amount1_buy = A2; 
                    
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
                    
                    var amount3_buy = A2 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
                else
                {
                    $('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
                
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
            
                    var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
            
                var total_w_vat_buy = amount1_buy + amount2_buy + amount3_buy;
                $('#total_w_vat_buy').val(total_w_vat_buy.toFixed(2));
                
            //End Buy Forex Code****************************
            
            //Start sel Forex**************************************
                var sel_forex       = $('#sel_forex').val().replace(/,/g,''); 
                var markup_sel      = sel_forex * markup1;
                $('#markup_sel').val(markup_sel.toFixed(2));
                
                var actual_supplier_total_sel       = $('#actual_supplier_total_sel').val().replace(/,/g,'');
                var commission_sel                  = $('#commission_sel').val().replace(/,/g,'');
                var markup_sel                      = $('#markup_sel').val().replace(/,/g,'');
                var amount1_sel= parseFloat(actual_supplier_total_sel) + parseFloat(commission_sel) + parseFloat(markup_sel);
               
               /* $('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                
                var amount2_sel = sel_forex * amount2;
                $('#vat_commission_sel').val(amount2_sel.toFixed(2));
            
                var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                
                var supplier_total_buy          = $('#supplier_total_buy').val().replace(/,/g,'');
                var vat_forex_sel = (supplier_total_buy-actual_supplier_total_sel) * 0.05;
                $('#vat_forex_sel').val(vat_forex_sel.toFixed(2)); */
                
                if(fcrCode == 6)
                {
                    var total_supplier_base_rate_sel = $('#total_supplier_base_rate_sel').val().replace(/,/g,'');
                    var markup_sel                  = $('#markup_sel').val().replace(/,/g,'');
                    var A3 = parseFloat(total_supplier_base_rate_sel) + parseFloat(markup_sel);
                    $('#total_wo_vat_sel').val(A3.toFixed(2)); //-- total_wo_vat_buy
                    amount1_sel = A3; 
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                    
                    var amount3_sel = A3 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    vat_forex_sel =0;
                }
                else
                {
                    $('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                
                    var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    var supplier_total_buy = ($('#supplier_total_buy').val()=='')?0:$('#supplier_total_buy').val();
                    var vat_forex_sel = (supplier_total_buy-actual_supplier_total_sel) * 0.5;
                    
                    $('#vat_forex_sel').val(vat_forex_sel.toFixed(2));
                }
                
                
                var total_w_vat_sel = amount1_sel + amount2_sel + amount3_sel + vat_forex_sel;
                $('#total_w_vat_sel').val(total_w_vat_sel.toFixed(2));
            //End sel Forex  **************************************
        
    });
     
    $(document).on('change keyup','#commission_per',function(){
        
        var commission_per          = $('#commission_per').val();
        alert(commission_per);
        //var supplier_base_rate      = $('#supplier_base_rate').val();
        var total_supplier_base_rate      = $('#total_supplier_base_rate').val().replace(/,/g,'');
        var amount                  = (total_supplier_base_rate*commission_per)/100;
        $('#commission1').val(amount.toFixed(2));
        
        var supplier_total          = $('#supplier_total').val().replace(/,/g,'');
        var actual_supplier_total   = supplier_total - amount;
        $('#actual_supplier_total').val(actual_supplier_total.toFixed(2));
        
        //var actual_supplier_total       = $('#actual_supplier_total').val();
        var commission1                 = $('#commission1').val().replace(/,/g,'');
        var markup1                     = $('#markup1').val().replace(/,/g,'');
        var amount1= parseFloat(actual_supplier_total) + parseFloat(commission1) + parseFloat(markup1);
        
        /*$('#total_wo_vat').val(amount1.toFixed(2));
        
        var amount2 = amount * 0.05; //Vat Commission
        $('#vat_commission').val(amount2.toFixed(2));
        
        var amount3 = markup1 * 0.05; //Vat Markup 
        $('#vat_markup').val(amount3.toFixed(2));
        */
            var fcrCode = $('#fcrCode').val();
            if(fcrCode == 6)
            {
                var total_supplier_base_rate = $('#total_supplier_base_rate').val().replace(/,/g,'');
                var markup1                  = $('#markup1').val().replace(/,/g,'');
                var A1 = parseFloat(total_supplier_base_rate) + parseFloat(markup1);
                $('#total_wo_vat').val(A1.toFixed(2)); //      
                amount1 = A1;
            }
            else
            {
                $('#total_wo_vat').val(amount1.toFixed(2)); //--
            }
            
            var amount = commission1;
            //alert(amount);
            
            var amount2 = amount * 0.05; //Vat Commission
            $('#vat_commission').val(amount2.toFixed(2));
            
            if(fcrCode == 6)
            {
                var amount3 = A1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));
            }
            else
            {
                var amount3 = markup1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));     
            }
        
        var total_w_vat = amount1 + amount2 + amount3;
        $('#total_w_vat').val(total_w_vat.toFixed(2));
        
        
        //************Start Buy Forex Code ****************
            var buy_forex           = $('#buy_forex').val()
            var commission_buy      = buy_forex * amount;
            $('#commission_buy').val(commission_buy.toFixed(2));
            
            var supplier_total_buy          = $('#supplier_total_buy').val().replace(/,/g,'');
            var actual_supplier_total_buy = supplier_total_buy - commission_buy;
            $('#actual_supplier_total_buy').val(actual_supplier_total_buy.toFixed(2));
            
            //var actual_supplier_total_buy       = $('#actual_supplier_total_buy').val();
            //var commission_buy                  = $('#commission_buy').val();
            var markup_buy                      = $('#markup_buy').val().replace(/,/g,'');
            var amount1_buy= parseFloat(actual_supplier_total_buy) + parseFloat(commission_buy) + parseFloat(markup_buy);
            /*$('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
            
            var amount2_buy = buy_forex * amount2;
            $('#vat_commission_buy').val(amount2_buy.toFixed(2));
        
            var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
            $('#vat_markup_buy').val(amount3_buy.toFixed(2)); */
            
                if(fcrCode == 6)
                {
                    var total_supplier_base_rate_buy = $('#total_supplier_base_rate_buy').val().replace(/,/g,'');
                    var markup_buy                  = $('#markup_buy').val().replace(/,/g,'');
                    var A2 = parseFloat(total_supplier_base_rate_buy) + parseFloat(markup_buy);
                    $('#total_wo_vat_buy').val(A1.toFixed(2)); //-- total_wo_vat_buy
                    amount1_buy = A2; 
                    
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
                    
                    var amount3_buy = A2 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
                else
                {
                    $('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
                
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
            
                    var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
            
            var total_w_vat_buy = amount1_buy + amount2_buy + amount3_buy;
            $('#total_w_vat_buy').val(total_w_vat_buy.toFixed(2));
       //End Buy Forex Code***********************
       
       
        //Start sel Forex**************************************
            var sel_forex           = $('#sel_forex').val().replace(/,/g,'');
            var commission_sel      = sel_forex * amount;
            $('#commission_sel').val(commission_sel.toFixed(2));
            
            var supplier_total_sel          = $('#supplier_total_sel').val().replace(/,/g,'');
            var actual_supplier_total_sel   = supplier_total_sel - commission_sel;
            $('#actual_supplier_total_sel').val(actual_supplier_total_sel.toFixed(2));
            
            //var actual_supplier_total_sel       = $('#actual_supplier_total_sel').val();
            //var commission_sel                  = $('#commission_sel').val();
            var markup_sel                      = $('#markup_sel').val().replace(/,/g,'');
            var amount1_sel= parseFloat(actual_supplier_total_sel) + parseFloat(commission_sel) + parseFloat(markup_sel);
            
            /*  $('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                var amount2_sel = sel_forex * amount2;
                $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                var vat_forex_sel = (supplier_total_buy-actual_supplier_total_sel) * 0.05;
                $('#vat_forex_sel').val(vat_forex_sel.toFixed(2)); */
                
            if(fcrCode == 6)
                {
                    var total_supplier_base_rate_sel = $('#total_supplier_base_rate_sel').val().replace(/,/g,'');
                    var markup_sel                  = $('#markup_sel').val().replace(/,/g,'');
                    var A3 = parseFloat(total_supplier_base_rate_sel) + parseFloat(markup_sel);
                    $('#total_wo_vat_sel').val(A3.toFixed(2)); //-- total_wo_vat_buy
                    amount1_sel = A3; 
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                    
                    var amount3_sel = A3 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    vat_forex_sel =0;
                }
                else
                {
                    $('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                    
                    var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    var supplier_total_buy = ($('#supplier_total_buy').val()=='')?0:$('#supplier_total_buy').val();
                    var vat_forex_sel = (parseFloat(supplier_total_buy)-parseFloat(actual_supplier_total_sel)) * 0.5;
                    $('#vat_forex_sel').val(vat_forex_sel.toFixed(2));
                }
            
            var total_w_vat_sel = amount1_sel + amount2_sel + amount3_sel + vat_forex_sel;
            $('#total_w_vat_sel').val(total_w_vat_sel.toFixed(2));
        //End sel Forex  **************************************
        
  });
  
    $(document).on('change keyup','#markup_per',function()
    {
            var supplier_total              = $('#supplier_total').val().replace(/,/g,'');
            var total_supplier_base_rate    = $('#total_supplier_base_rate').val().replace(/,/g,'');
            var markup_per                  =  $('#markup_per').val().replace(/,/g,'');
            //var amount                    = (supplier_total/((100-markup_per)/100))-supplier_total;
            var amount                      = ((total_supplier_base_rate*markup_per)/100);
            $('#markup1').val(amount.toFixed(2)); 
              
            var actual_supplier_total       = $('#actual_supplier_total').val().replace(/,/g,'');
            var commission1                 = $('#commission1').val().replace(/,/g,'');
            var markup1                     = $('#markup1').val().replace(/,/g,'');
            var amount1= parseFloat(actual_supplier_total) + parseFloat(commission1) + parseFloat(markup1);
           /* $('#total_wo_vat').val(amount1.toFixed(2));
            
            var amount2 = commission1 * 0.05; //Vat Commission
            $('#vat_commission').val(amount2.toFixed(2));
            
            var amount3 = amount * 0.05; //Vat Markup 
            $('#vat_markup').val(amount3.toFixed(2));
            */
            var fcrCode = $('#fcrCode').val();
            if(fcrCode == 6)
            {
                var total_supplier_base_rate = $('#total_supplier_base_rate').val().replace(/,/g,'');
                var markup1                  = $('#markup1').val().replace(/,/g,'');
                var A1 = parseFloat(total_supplier_base_rate) + parseFloat(markup1);
                $('#total_wo_vat').val(A1.toFixed(2)); // 
                amount1 = A1;
            }
            else
            {
                $('#total_wo_vat').val(amount1.toFixed(2)); //
            }
            
            var amount = commission1;
            //alert(amount);
            
            var amount2 = amount * 0.05; //Vat Commission
            $('#vat_commission').val(amount2.toFixed(2));
            
            if(fcrCode == 6)
            {
                var amount3 = A1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));
            }
            else
            {
                var amount3 = markup1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));     
            }
            
            var total_w_vat = amount1 + amount2 + amount3;
            $('#total_w_vat').val(total_w_vat.toFixed(2));
            
            //************Start Buy Forex Code ****************
                var buy_forex       = $('#buy_forex').val().replace(/,/g,''); 
                var markup_buy      = buy_forex * amount;
                $('#markup_buy').val(markup_buy.toFixed(2));
                
                var actual_supplier_total_buy       = $('#actual_supplier_total_buy').val().replace(/,/g,'');
                var commission_buy                  = $('#commission_buy').val().replace(/,/g,'');
                //var markup_buy                    = $('#markup_buy').val();
                var amount1_buy= parseFloat(actual_supplier_total_buy) + parseFloat(commission_buy) + parseFloat(markup_buy);
                
                /*$('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
                
                var amount2_buy = buy_forex * amount2;
                $('#vat_commission_buy').val(amount2_buy.toFixed(2));
            
                var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
                $('#vat_markup_buy').val(amount3_buy.toFixed(2)); */
                
                 if(fcrCode == 6)
                {
                    var total_supplier_base_rate_buy = $('#total_supplier_base_rate_buy').val().replace(/,/g,'');
                    var markup_buy                  = $('#markup_buy').val().replace(/,/g,'');
                    var A2 = parseFloat(total_supplier_base_rate_buy) + parseFloat(markup_buy);
                    $('#total_wo_vat_buy').val(A2.toFixed(2)); //-- total_wo_vat_buy
                    amount1_buy = A2; 
                    
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
                    
                    var amount3_buy = A2 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
                else
                {
                    $('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
                
                    var amount2_buy = buy_forex * amount2;
                    $('#vat_commission_buy').val(amount2_buy.toFixed(2));
            
                    var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_buy').val(amount3_buy.toFixed(2));
                }
            
            
                var total_w_vat_buy = amount1_buy + amount2_buy + amount3_buy;
                $('#total_w_vat_buy').val(total_w_vat_buy.toFixed(2));
                
            //End Buy Forex Code****************************
            
            //Start sel Forex**************************************
                var sel_forex       = $('#sel_forex').val().replace(/,/g,''); 
                var markup_sel      = sel_forex * amount;
                $('#markup_sel').val(markup_sel.toFixed(2));
                
                var actual_supplier_total_sel       = $('#actual_supplier_total_sel').val().replace(/,/g,'');
                var commission_sel                  = $('#commission_sel').val().replace(/,/g,'');
                var markup_sel                      = $('#markup_sel').val().replace(/,/g,'');
                var amount1_sel= parseFloat(actual_supplier_total_sel) + parseFloat(commission_sel) + parseFloat(markup_sel);
               
               /* $('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                
                var amount2_sel = sel_forex * amount2;
                $('#vat_commission_sel').val(amount2_sel.toFixed(2));
            
                var amount3_sel = sel_forex * amount3; //Vat Markup Buy vat_markup_sel
                $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                
                var supplier_total_buy          = $('#supplier_total_buy').val().replace(/,/g,'');
                var vat_forex_sel = (supplier_total_buy-actual_supplier_total_sel) * 0.05;
                $('#vat_forex_sel').val(vat_forex_sel.toFixed(2)); */
                
                if(fcrCode == 6)
                {
                    var total_supplier_base_rate_sel = $('#total_supplier_base_rate_sel').val().replace(/,/g,'');
                    var markup_sel                  = $('#markup_sel').val().replace(/,/g,'');
                    var A3 = parseFloat(total_supplier_base_rate_sel) + parseFloat(markup_sel);
                    $('#total_wo_vat_sel').val(A3.toFixed(2)); //-- total_wo_vat_buy
                    amount1_sel = A3; 
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                    
                    var amount3_sel = A3 * 0.05; //Vat Markup  ////---
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    vat_forex_sel =0;
                }
                else
                {
                    $('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                    
                    var amount2_sel = sel_forex * amount2;
                    $('#vat_commission_sel').val(amount2_sel.toFixed(2));
                
                    var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                    $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                    
                    var supplier_total_buy = ($('#supplier_total_buy').val()=='')?0:$('#supplier_total_buy').val();
                    var vat_forex_sel = (parseFloat(supplier_total_buy)-parseFloat(actual_supplier_total_sel)) * 0.5;
                    
                    $('#vat_forex_sel').val(vat_forex_sel.toFixed(2));
                }
                
                var total_w_vat_sel = amount1_sel + amount2_sel + amount3_sel + vat_forex_sel;
                $('#total_w_vat_sel').val(total_w_vat_sel.toFixed(2));
            //End sel Forex  **************************************
            
        });
     
     
        function CompareDate()
        {  
            //Note: 00 is month i.e. January  
            var dateOne = new Date(2010, 00, 15); //Year, Month, Date  
            var dateTwo = new Date(2011, 00, 15); //Year, Month, Date  
            if(dateOne > dateTwo) 
            {  
                alert("Date One is greater than Date Two.");  
            }
            else 
            {  
                alert("Date Two is greater than Date One.");  
            }  
        }  
    
    $(document).on('change','#to_date',function(){
        //alert($(this).val());
        
        // Here are the two dates to compare from_date
        var date1 = $('#from_date').val();
        var date2 = $(this).val();
        
        //CompareDate();  
        
        // First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
        date1 = date1.split('-');
        date2 = date2.split('-');
        
        var from = new Date(date1[0], date1[1], date1[2]); //Year, Month, Date  
        var Two  = new Date(date2[0], date2[1], date2[2]); //Year, Month, Date  
        if(from > Two) 
        {  
           alert("From Date should always be LESS THAN OR EQUAL to To Date.");  
           $('#to_date').val('')
           $('#day_night').val('');
           return false;
        }
        
        //alert(date1[0]);
        
        //Now we convert the array to a Date object, which has several helpful methods
        //date1 = new Date(date1[0], date1[1], date1[2]);
        //date2 = new Date(date2[0], date2[1], date2[2]);
        
        date1 = new Date(date1[0], date1[1], date1[2]);
        date2 = new Date(date2[0], date2[1], date2[2]);
        
        // We use the getTime() method and get the unixtime (in milliseconds, but we want seconds, therefore we divide it through 1000)
        date1_unixtime = parseInt(date1.getTime() / 1000);
        date2_unixtime = parseInt(date2.getTime() / 1000);
        
        // This is the calculated difference in seconds
        var timeDifference = date2_unixtime - date1_unixtime;
        
        //in Hours
        var timeDifferenceInHours = timeDifference / 60 / 60;
        
        // and finaly, in days :)
        var timeDifferenceInDays = timeDifferenceInHours  / 24;
        
        //alert(timeDifferenceInDays);
        $('#day_night').val(timeDifferenceInDays);
        
        call_calculation();
        
    });  
     
    $(document).on('change','#from_date',function(){
        //alert($(this).val());
        
        // Here are the two dates to compare from_date
        var date1 = $(this).val();
        var date2 = $('#to_date').val();
        
        // First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
        date1 = date1.split('-');
        date2 = date2.split('-');
        
        
        var from = new Date(date1[0], date1[1], date1[2]); //Year, Month, Date  
        var Two  = new Date(date2[0], date2[1], date2[2]); //Year, Month, Date  
        if(from > Two) 
        {  
           alert("From Date should always be LESS THAN OR EQUAL to To Date.");  
           $('#to_date').val('')
           $('#day_night').val('');
           return false;
        }
        
        // Now we convert the array to a Date object, which has several helpful methods
        date1 = new Date(date1[0], date1[1], date1[2]);
        date2 = new Date(date2[0], date2[1], date2[2]);
        
        // We use the getTime() method and get the unixtime (in milliseconds, but we want seconds, therefore we divide it through 1000)
        date1_unixtime = parseInt(date1.getTime() / 1000);
        date2_unixtime = parseInt(date2.getTime() / 1000);
        
        // This is the calculated difference in seconds
        var timeDifference = date2_unixtime - date1_unixtime;
        
        // in Hours
        var timeDifferenceInHours = timeDifference / 60 / 60;
        
        // and finaly, in days :)
        var timeDifferenceInDays = timeDifferenceInHours  / 24;
        
        //alert(timeDifferenceInDays);
        
        $('#day_night').val(timeDifferenceInDays);
        
        call_calculation();
        
    });
    
    
    function call_calculation()
    {
         var supplier_base_rate = $('#supplier_base_rate').val().replace(/,/g,'');
        //alert(supplier_base_rate);return false;
        if(supplier_base_rate !='')
        {
            //alert(supplier_base_rate);return false;
            total_supplier_base_rate = fu_total_supplier_base_rate();
            $('#total_supplier_base_rate').val(total_supplier_base_rate.toFixed(2));
            
            var markup_per              = $('#markup_per').val().replace(/,/g,'');
            var markup1 = (total_supplier_base_rate*markup_per)/100;
            $('#markup1').val(markup1.toFixed(2));//      
            
            
            var commission_per    = $('#commission_per').val().replace(/,/g,'');
            var commission1 = (total_supplier_base_rate*commission_per)/100;
            $('#commission1').val(commission1.toFixed(2));//  
            
            var supplier_tax            = ($('#supplier_tax').val() =='')?0:$('#supplier_tax').val();
            var other_fees              = $('#other_fees').val().replace(/,/g,'');
            var total = parseFloat(total_supplier_base_rate)+parseFloat(supplier_tax)+parseFloat(other_fees);
            
            $('#supplier_total').val(total.toFixed(2));//
            
            var commission1             = ($('#commission1').val().replace(/,/g,'')=='')?0:$('#commission1').val().replace(/,/g,'');
            var actual_supplier_total   = parseFloat(total) - parseFloat(commission1);
            $('#actual_supplier_total').val(actual_supplier_total.toFixed(2));
            
            //var actual_supplier_total    = $('#actual_supplier_total').val();
           
            var markup1                     = ($('#markup1').val().replace(/,/g,'') == '')?0:$('#markup1').val().replace(/,/g,'');
            var amount1 = parseFloat(actual_supplier_total) + parseFloat(commission1) + parseFloat(markup1);
            /*$('#total_wo_vat').val(amount1.toFixed(2));
            
            var amount = commission1;
            //alert(amount);
            var amount2 = amount * 0.05; //Vat Commission
            $('#vat_commission').val(amount2.toFixed(2));
            
            var amount3 = markup1 * 0.05; //Vat Markup 
            $('#vat_markup').val(amount3.toFixed(2));
            */
            
             var fcrCode = $('#fcrCode').val();
            if(fcrCode == 6)
            {
                var total_supplier_base_rate = $('#total_supplier_base_rate').val().replace(/,/g,'');
                var markup1                  = $('#markup1').val().replace(/,/g,'');
                var A1 = parseFloat(total_supplier_base_rate) + parseFloat(markup1);
                $('#total_wo_vat').val(A1.toFixed(2)); //--     
            }
            else
            {
                $('#total_wo_vat').val(amount1.toFixed(2)); //--
            }
            
            var amount = commission1;
            //alert(amount);
            
            var amount2 = amount * 0.05; //Vat Commission
            $('#vat_commission').val(amount2.toFixed(2));
            
            if(fcrCode == 6)
            {
                var amount3 = A1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));
            }
            else
            {
                var amount3 = markup1 * 0.05; //Vat Markup  ////---
                $('#vat_markup').val(amount3.toFixed(2));     
            }
            
            
            var total_w_vat = amount1 + amount2 + amount3;
            $('#total_w_vat').val(total_w_vat.toFixed(2));
            
            
            //Start Buy Forex**************************************
                var buy_forex = $('#buy_forex').val(); 
                
                var supplier_base_rate_buy = supplier_base_rate * buy_forex;
                $('#supplier_base_rate_buy').val(supplier_base_rate_buy.toFixed(2));
                
                var supplier_tax_buy = supplier_tax * buy_forex;
                $('#supplier_tax_buy').val(supplier_tax_buy.toFixed(2));
                
                var other_fees_buy = other_fees * buy_forex;
                $('#other_fees_buy').val(other_fees_buy.toFixed(2));
                
                var total_supplier_base_rate_buy = total_supplier_base_rate * buy_forex;
                $('#total_supplier_base_rate_buy').val(total_supplier_base_rate_buy.toFixed(2));
                
                var supplier_base_rate_buy      = $('#supplier_base_rate_buy').val().replace(/,/g,'');
                //var supplier_tax_buy           = $('#supplier_tax_buy').val();
                //var other_fees_buy              = $('#other_fees_buy').val();
                var total_buy = parseFloat(total_supplier_base_rate_buy)+parseFloat(supplier_tax_buy)+parseFloat(other_fees_buy);
                $('#supplier_total_buy').val(total_buy.toFixed(2));//
                
                var commission_buy              = $('#commission_buy').val().replace(/,/g,'');
                var actual_supplier_total_buy   = parseFloat(total_buy) - parseFloat(commission_buy);
                $('#actual_supplier_total_buy').val(actual_supplier_total_buy.toFixed(2));
                
                var markup_buy                  = ($('#markup_buy').val().replace(/,/g,'') == '')?0:$('#markup_buy').val().replace(/,/g,'');
                var amount1_buy= parseFloat(actual_supplier_total_buy) + parseFloat(commission_buy) + parseFloat(markup_buy);
                $('#total_wo_vat_buy').val(amount1_buy.toFixed(2));
                
                var amount2_buy = buy_forex * amount2;
                $('#vat_commission_buy').val(amount2_buy.toFixed(2));
            
                var amount3_buy = buy_forex * amount3; //Vat Markup Buy 
                $('#vat_markup_buy').val(amount3_buy.toFixed(2));
            
            
                var total_w_vat_buy = amount1_buy + amount2_buy + amount3_buy;
                $('#total_w_vat_buy').val(total_w_vat_buy.toFixed(2));
                
             //End Buy Forex*******************************************
            
            
            //Start sel Forex**************************************
                var sel_forex = $('#sel_forex').val(); 
                var supplier_base_rate_sel = supplier_base_rate * sel_forex;
                $('#supplier_base_rate_sel').val(supplier_base_rate_sel.toFixed(2));
                
                var supplier_tax_sel = supplier_tax * sel_forex;
                $('#supplier_tax_sel').val(supplier_tax_sel.toFixed(2));
                
                var other_fees_sel = other_fees * sel_forex;
                $('#other_fees_sel').val(other_fees_sel.toFixed(2));
                
                var total_supplier_base_rate_sel = total_supplier_base_rate * sel_forex;
                $('#total_supplier_base_rate_sel').val(total_supplier_base_rate_sel.toFixed(2));
                
                //var supplier_base_rate_sel      = $('#supplier_base_rate_sel').val();//supplier_base_rate_sel
                //var supplier_tax_sel            = $('#supplier_tax_sel').val();
                //var other_fees_sel              = $('#other_fees_sel').val();
                var total_sel = parseFloat(total_supplier_base_rate_sel)+parseFloat(supplier_tax_sel)+parseFloat(other_fees_sel);
                $('#supplier_total_sel').val(total_sel.toFixed(2));//
                
                var commission_sel              = $('#commission_sel').val();
                var actual_supplier_total_sel   = parseFloat(total_sel) - parseFloat(commission_sel);
                $('#actual_supplier_total_sel').val(actual_supplier_total_sel.toFixed(2));
                
                 //var actual_supplier_total_sel       = $('#actual_supplier_total_sel').val();
                //var commission_sel                  = $('#commission_sel').val();
                var markup_sel                      = $('#markup_sel').val();
                var amount1_sel= parseFloat(actual_supplier_total_sel) + parseFloat(commission_sel) + parseFloat(markup_sel);
                $('#total_wo_vat_sel').val(amount1_sel.toFixed(2));
                
                var amount2_sel = sel_forex * amount2;
                $('#vat_commission_sel').val(amount2_sel.toFixed(2));
            
                var amount3_sel = sel_forex * amount3; //Vat Markup Buy 
                $('#vat_markup_sel').val(amount3_sel.toFixed(2));
                
                var supplier_total_buy = $('#supplier_total_buy').val().replace(/,/g,'');
                var vat_forex_sel = (supplier_total_buy-actual_supplier_total_sel) * 0.05;
                $('#vat_forex_sel').val(vat_forex_sel.toFixed(2));
            
                var total_w_vat_sel = amount1_sel + amount2_sel + amount3_sel + vat_forex_sel;
                $('#total_w_vat_sel').val(total_w_vat_sel.toFixed(2));
            //End sel Forex  **************************************
        }
    }
   

      $("#insert_adds").validate({       
            rules: {
               
              "data[client_code]"          : "required",
              "data[trip_id]"              : "required",
              "data[service_type]"         : "required"
              /*"data[supplier_code]"        : "required",
              "data[supplier_name]"        : "required",
              "data[guest_name]"           : "required",
              "data[location]"             : "required",
              "data[confirmation_no]"      : "required",
              "data[payment_method]"       : "required",
              "data[room_type]"            : "required",
              "data[room_desc]"            : "required",
              "data[quantity]"             : "required",
              "data[form]"                 : "required",
              "data[to]"                   : "required",
              "data[day_night]"            : "required",
              "data[check_in]"             : "required",
              "data[check_out]"            : "required",
              "data[proform_no]"           : "required",
              "data[final_invoice_no]"     : "required",
              "data[invoice_no]"           : "required",
              "data[frc]"                  : "required",
              "data[x_rate]"               : "required",
              "data[unit_rate]"            : "required",
              "data[vat]"                  : "required",
              "data[vat_amnt]"             : "required",
              "data[commission]"           : "required",
              "data[commission_amnt]"      : "required",
              "data[markup]"               : "required",
              "data[markup_amnt]"          : "required",
              "data[markup_net_cost]"      : "required",
              "data[markup_net_sale]"      : "required",
              "data[cost_in_sar_net_cost]" : "required",
              "data[cost_in_sar_net_csale]": "required",
              "data[urgency_level]"        : "required",
              "data[note]"                 :"required"*/
            },
            messages : {
               //<?php //if($user_id=='') { ?>
                "addimage"                  : "",
                //<?php //} ?>

                //"data[user_name]"           : "required",
                //"data[email]"                : "required",
               // "data[mobile]"               : "required"              
            },      
    });
        
        $('.insert_adds').click(function(){ 
            //alert('hi');
            var validator = $("#insert_adds").validate();
            validator.form();
            if(validator.form() == true)
            {
                //alert('Hiii');return false;
                alertify.confirm("Do you want to Save ?.",
                function(){
                    $('.insert_adds').html("<img src='<?php echo base_url()?>assets/images/ajax-loaderr.gif' style='width:20px; height:15px;'>"); 
                      var data = new FormData($('#insert_adds')[0]);
                     // console.log(data);
                    $.ajax({                
                        url: "<?php echo base_url();?>admin/save_crms",
                        type: "POST",
                        data: data,
                        mimeType: "multipart/form-data",
                        contentType: false,
                        cache: false,
                        processData:false,
                        error:function(request,response){
                            console.log(request);
                            //return false;
                        },                  
                        success: function(result){
                            console.log(result);
                            var obj = jQuery.parseJSON(result);
                            if (obj.status == "success") 
                            {
                                window.location = '<?php echo base_url('admin/hotel');?>';
                                //location.reload();
                                //return false;
                            } 
                        }
                      
                    });
                },
                function(){
                    //alertify.error('Cancel');
                });
            }
            return false;
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
    
<script>
    function supplier_code(val)
    {
         $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url();?>admin/get_name',
                  data: {'id':val,service_type:'HOTEL'},
                  success: function (data) 
                  {
                        //alert(data);
                        $('#get_supplier_name').html(data);
                  }
        });
    }
</script>


<script>
    function supplier_name(val)
    {
      //alert(val);
         $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url();?>admin/get_supplier_id',
                  data: {'supplier_name':val,service_type:'HOTEL'},
                  success: function (data) 
                  {
                        //alert(data);
                        $('#get_supplier_code').html(data);
                  }
        });
    }
</script>
    
 <script src="http://volive.in/joher/assets/admin/js/wickedpicker.js"></script>
 <script>
	//$('.from_date,.to_date').wickedpicker();
	</script>
  <script>
    function client_code(val)
    {
         $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url();?>admin/get_client_name',
                  data: {'id':val},
                  success: function (data) 
                  {
                        //alert(data);
                        $('#get_client_name').html(data);
                        ///////////////////////// get_trip_id
                            $.ajax({
                              type: 'POST',
                              url: '<?php echo base_url();?>admin/get_trip_id',
                              data: {'id':val},
                              success: function (data) 
                              {
                                $('#get_trip_id').html(data);
                                //alert(data);
                              }
                            });
                        /////////////////////////
                        $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url();?>admin/get_client_email',
                          data: {'id':val},
                          success: function (data) 
                          {
                            $('#get_client_email').html(data);
                            //console.log(data);
                          }
                        });
                  }
        });
    }
</script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0-rc.6/js/bootstrap-datepicker.js"></script>-->
<script type="text/javascript" src="https://www.volivesolutions.com/adventure_dev/assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" ></script>

<script>
    function client_name(val)
    {
      //alert(val);
         $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url();?>admin/get_client_id',
                  data: {'user_name':val},
                  success: function (data) 
                  {
                        //alert(data);
                        $('#get_client_code').html(data);
                  }
        });
    }
    
    
$(document).ready(function(){
   
    /*$('#from_date').datepicker({ //from_date
        changeMonth: true,
        changeYear: true,
        //showButtonPanel:true,
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText) 
        {
            $('#to_date').datepicker('option', 'minDate', new Date(this.value));//to_date
        }
    });
    
    $('#to_date').datepicker({
        //alert('Hello');
        changeMonth: true,
        changeYear: true,
        //showButtonPanel: true,
        dateFormat: 'yy-mm-dd',
        onSelect: function (dateText)
        {
            $('#from_date').datepicker('option', 'maxDate', new Date(this.value));
        }
    });*/
    
       
        //alert('hi');
       /**/
       
        /*var d1 = new Date();
        var d2 = new Date(d1);

        console.log(d1 == d2);   // prints false (wrong!) 
        console.log(d1 === d2);  // prints false (wrong!)
        console.log(d1 != d2);   // prints true  (wrong!)
        console.log(d1 !== d2);  // prints true  (wrong!)
        console.log(d1.getTime() === d2.getTime()); // prints true (correct)*/
        
        
        /*var dateToday = new Date();
        var dates = $("#from_date, #to_date").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            minDate: dateToday,
            dateFormat: 'yy/mm/dd',
            onSelect: function(selectedDate) 
            {
                var option = this.id == "from_date" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
                //alert('hii');
            }
        });*/
       
    
    });   
     
       
     
</script>

  