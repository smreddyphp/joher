<link rel="stylesheet" href="http://ericjgagnon.github.io/wickedpicker/wickedpicker/wickedpicker.min.css">

<style>
    #insert_adds label.error {
        color:red; 
    }
    #insert_adds input.error,textarea.error,select.error {
        border:1px solid red;
        color:red; 
    }
    .popover {
    z-index: 2000;
    position:relative;
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
                <?php  //echo  $id = $this->uri->segment(3); 
                        //echo $adds['user_id'];
                       // print_r($adds);
                if($this->uri->segment(4) !='')
              {
              
                $id = $this->uri->segment(4);
                $client_code = $this->db->get_where('user_info',array('user_id'=>$id))->row_array();
               //print_r($client_code);
                ?>
                     <select class="form-control" name="data[client_code]" id="get_client_code" 
                     onchange = "client_code(this.value)">
                        <option>Select Code</option>
                        <?php 
                            $res = $this->db->get_where('user_info',array('user_id'=>$id))->result();
                        ?>
                
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
                     <option value=" ">Select Code</option>
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
            <label class="col-sm-3 control-label" for="textinput">Client Name:</label>
            <div class="col-sm-9">                
            <select class="form-control" name="data[client_name]" id="get_client_name" >
                     <option value=" ">Select Name</option>
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
              <select name="data[room_type]" id="" class="form-control">
              <option value="Deluxe">Deluxe</option>
              <option value="AC">AC</option>
              <option value="Non Ac">Non Ac</option>
              </select>
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
            <input type="date" name="data[from]" value="<?php if(@$adds['from']){ echo date('Y-m-d',strtotime(@$adds['from'])); } ?>" class="form-control" id = "from_date">
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
          </div> 
          <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
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

          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">FCR:</label>
            <div class="col-sm-3">
            <select name="data[frc]" id="" class="form-control">
                <?php if(@$adds['frc']){ ?>
                     <option value = "<?php echo @$adds['frc']?>"><?=@$adds['frc']?></option>      
                    <?php }?>
                <option value="USD">USD</option>
            </select>
             
            </div>
             <label class="col-sm-3 control-label text-center" for="textinput">X-Rate:</label>
            <div class="col-sm-3">            
            <input type = "text" name="data[x_rate]" id = "x_rate" value = "<?php echo @$adds['x_rate']?>" class="form-control">
            
            </div>
            </div>
          
            </div>
          </div>

           <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">Supplier Unit Rate:</label>
            <div class="col-sm-9">               
            <input type="number" name="data[markup_net_cost]" id="tot_cost" value="<?=@$adds['markup_net_cost']?>" class="form-control">
             </div>
            </div>          
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Supplier Unit Cost:</label>
            <div class="col-sm-9">
                <input type="number" name="data[supplier_unit_rate]" id="supplier_unit_rate" value="<?=@$adds['supplier_unit_rate']?>" class="form-control">
            </div>
          </div>
          
          
          
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">Commission:</label>
            <div class="col-sm-3">            
           
               <div class="input-group">
                  <input type="text" class="form-control" name="data[commission]" id="select_commission" value = "<?php echo @$adds['commission']?>">
                  <span class="input-group-btn">
                    <select class="form-control" id = "commission">
                        <option value = ''>Select</option>
                        <?php if(@$adds['commission']){ ?>
                            <option value = "<?php echo @$adds['commission']?>"><?=@$adds['commission']?></option>      
                        <?php }?>
                        <option value="10.00" <?php if(@$adds['commission']=='10.00'){ echo 'selected';} ?>>10.00</option>
                        <option value="20.00" <?php if(@$adds['commission']=='20.00'){ echo 'selected';} ?>>20.00</option>
                        <option value="30.00" <?php if(@$adds['commission']=='30.00'){ echo 'selected';} ?>>30.00</option>
                    </select>
                  </span>
                </div>
            </div>
            <div class="col-md-1 commison">
            <span>%</span>
            </div>
            <div class="col-sm-3">
            <input type="number" name="data[commission_amnt]" id="commission_amnt" value="<?=@$adds['commission_amnt']?>" class=" form-control">
              
            </div>            
             <label class="col-sm-2 control-label text-center" for="textinput">AMNT:</label>
            </div>          
            </div>
          </div>
          
          
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">Markup:</label>
            <div class="col-sm-3">
              
              <div class="input-group">
                  <input type="text" class="form-control" id="select_markup" value = "<?php echo @$adds['markup']?>">
                  <span class="input-group-btn">
                    <select class="form-control" name="data[markup]" id="markup">
                        <option value = ''>Select</option>
                        <?php if(@$adds['commission']){ ?>
                            <option value = "<?php echo @$adds['commission']?>"><?=@$adds['commission']?></option>      
                        <?php }?>
                        <option value="10.00" <?php if(@$adds['commission']=='10.00'){ echo 'selected';} ?>>10.00</option>
                        <option value="20.00" <?php if(@$adds['commission']=='20.00'){ echo 'selected';} ?>>20.00</option>
                        <option value="30.00" <?php if(@$adds['commission']=='30.00'){ echo 'selected';} ?>>30.00</option>
                    </select>
                  </span>
                </div>
            </div>
            <div class="col-md-1 commison">
            <span>%</span>
            </div>
            <div class="col-sm-3">
            <input type="number" name="data[markup_amnt]" id="markup_amnt" value="<?=@$adds['markup_amnt']?>" class=" form-control">
             
            </div>            
             <label class="col-sm-2 control-label text-center" for="textinput">AMNT:</label>
            </div>
          
            </div>
          </div>
          
          
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">VAT:</label>
            <div class="col-sm-3">
                    
                <div class="input-group">
                  <input type="text" class="form-control" name="data[vat]" id="select_vat" value = "<?php echo @$adds['vat']?>">
                  <span class="input-group-btn">
                    <select class="form-control"  id="vat">
                        <option value = ''>Select</option>
                        <?php if(@$adds['vat']){ ?>
                             <option value = "<?php echo @$adds['vat']?>"><?=@$adds['vat']?></option>      
                            <?php }?>
                        <option value="5.00" <?php if(@$adds['vat']=='5.00'){ echo 'selected';} ?>>5.00</option>
                        <option value="6.00" <?php if(@$adds['vat']=='6.00'){ echo 'selected';} ?>>6.00</option>
                        <option value="7.00" <?php if(@$adds['vat']=='7.00'){ echo 'selected';} ?>>7.00</option>
                    </select>
                  </span>
                </div>
            </div>
            <div class="col-md-1 commison">
            <span>%</span>
            </div>
            <div class="col-sm-3">
            <input type="number" name="data[vat_amnt]" id="vat_amnt" value="<?=@$adds['vat_amnt']?>" class=" form-control">             
            </div>            
             <label class="col-sm-2 control-label text-center" for="textinput">AMNT:</label>
            </div>          
            </div>
          </div>          
          
          <ul class="list-unstyled cost-list">
          <li>Net Cost</li>
          <li>Sale Cost</li>
          </ul>

         

          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">Total Cost:</label>
            <div class="col-sm-4">
            <input type="number" name="data[total_net_cost]" class="form-control" value="<?=@$adds['total_net_cost']?>" id="total_net_cost">
             </div>
            
            <div class="col-sm-4">
            <input type="number" name="data[tot_sale_cost]" class="form-control" value="<?=@$adds['tot_sale_cost']?>" id="tot_sale_cost">
            </div>            
             
            </div>
          
            </div>
          </div>
          
            <div class="form-group ">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-sm-3 control-label" for="textinput">Cost In Sar:</label>
                        <div class="col-sm-4">
                            <input type="number" name="data[cost_in_sar_net_cost]" class="form-control" value="<?=@$adds['cost_in_sar_net_cost']?>" id="net_cost_sar">
                        </div>
                        
                        <div class="col-sm-4">
                            <input type="number" name="data[cost_in_sar_net_csale]" class="form-control" value="<?=@$adds['cost_in_sar_net_csale']?>" id="tot_sale_cost_sar">
                        </div>            
                    </div>
                </div>
            </div>
          
          
          <div class="form-group ">
          <div class="row">
          <div class="col-md-12">
            <label class="col-sm-3 control-label" for="textinput">Urgency Level:</label>
            <div class="col-sm-3">
             <div class="radio">
            <input type="radio" name="data[urgency_level]"  <?php if(@$adds['urgency_level'] == 0){ echo 'checked';} ?> id="radio1" value = "0">
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
          <div class="form-group text-center">
          <!--<button class="add-save btn btn-md">Save</button>-->
           <button  class="add-save btn btn-primary waves-effect waves-light insert_adds">Save</button>
          </div>
          </div>  
          <div class="clearfix"></div>
          <div class="col-md-6"></div>    
          <div class="col-md-6 cost_box">
          </div>  
          
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

    var tot_vat=0;
    var tot_commission=0;
    var tot_markup=0;
    var unit_rate=$('#unit_rate').val();
    //var total_cost=$('#tot_cost').val();
    var tot_markup=0;
    var tot_cal=0;
    //to_date markup_amnt vat_amnt
     
    $(document).on('change keyup','#vat_amnt',function(){
            var vat_amnt = $('#vat_amnt').val();
            
            var commission_amnt     = $('#commission_amnt').val();
            var markup_amnt         = $('#markup_amnt').val();
            var supplier_unit_rate  = $('#supplier_unit_rate').val();
            
            var tot_cost = $('#tot_cost').val();
            
            var vat_amnt = $('#vat_amnt').val();

            var total = parseFloat(commission_amnt)+parseFloat(markup_amnt)+parseFloat(supplier_unit_rate);
            var vata = vat_amnt/(total);
            //alert(vata);
            vata = vata*100;
            $('#select_vat').val(vata.toFixed(2));
            
            quantity    = $('#quantity').val();
            day_night   = $('#day_night').val();
            
            totalCost = (parseFloat(tot_cost)+parseFloat(commission_amnt)+parseFloat(markup_amnt)+parseFloat(vat_amnt)) * (quantity*day_night);
            
            $('#tot_sale_cost').val(totalCost.toFixed(2));
            
            var x_rate = $('#x_rate').val();//
            totalCost = totalCost*x_rate;
            $('#tot_sale_cost_sar').val(totalCost.toFixed(2));//
            
    });
    
    $(document).on('change keyup','#markup_amnt',function(){
            var markup_amnt = $('#markup_amnt').val();
            var tot_cost    = $('#tot_cost').val();
            
            total = markup_amnt*100;
            total = total/tot_cost
            
            var commission_amnt     = $('#commission_amnt').val();
            var supplier_unit_rate  = $('#supplier_unit_rate').val();
            var select_vat          = $('#select_vat').val();
            
            $('#select_markup').val(total);
            
            totalAdd = parseFloat(commission_amnt) + parseFloat(markup_amnt) + parseFloat(supplier_unit_rate);
            var vatM = (select_vat*totalAdd)/100;
            $('#vat_amnt').val(vatM.toFixed(2));
            
            quantity    = $('#quantity').val();
            day_night   = $('#day_night').val();
            totalCost = (parseFloat(tot_cost)+parseFloat(commission_amnt)+parseFloat(markup_amnt)+parseFloat(vatM) ) * (quantity*day_night);
            $('#tot_sale_cost').val(totalCost.toFixed(2));
        
        var x_rate = $('#x_rate').val();//tot_sale_cost
        totalCost = totalCost*x_rate;
        $('#tot_sale_cost_sar').val(totalCost.toFixed(2));//
            
    });    
    
    $(document).on('change keyup','#commission_amnt',function(){   
        var commission_amnt = $('#commission_amnt').val();
        var tot_cost = $('#tot_cost').val();
        
        total = commission_amnt*100;
        total = total/tot_cost
        
        $('#select_commission').val(total);
        
        var markup_amnt         = $('#markup_amnt').val();
        var supplier_unit_rate  = $('#supplier_unit_rate').val();
        var select_vat          = $('#select_vat').val();
        
        totalAdd = parseFloat(commission_amnt) + parseFloat(markup_amnt) + parseFloat(supplier_unit_rate);
        var vatM = (select_vat*totalAdd)/100;
        $('#vat_amnt').val(vatM.toFixed(2));
        
        quantity    = $('#quantity').val();
        day_night   = $('#day_night').val();
        totalCost = (parseFloat(tot_cost)+parseFloat(commission_amnt)+parseFloat(markup_amnt)+parseFloat(vatM) ) * (quantity*day_night);
        $('#tot_sale_cost').val(totalCost);
        
        var x_rate = $('#x_rate').val();//
        totalCost = totalCost*x_rate;
        $('#tot_sale_cost_sar').val(totalCost.toFixed(2));//
    });
    
    
    $(document).on('change','#from_date',function(){
        //alert($(this).val());
        
        // Here are the two dates to compare from_date
        var date1 = $(this).val();
        var date2 = $('#to_date').val();
        
        // First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
        date1 = date1.split('-');
        date2 = date2.split('-');
        
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
        
        tot_cost                = $('#tot_cost').val();
        quantity                = $('#quantity').val();
        day_night               = $('#day_night').val();
        supplier_unit_rate      = $('#supplier_unit_rate').val();
        var x_rate              = $('#x_rate').val();
        
        var total = supplier_unit_rate * (quantity*day_night);
        
        $('#total_net_cost').val(total.toFixed(2));
        var v = total*x_rate;
        $('#net_cost_sar').val(v.toFixed(2));
        
        var commission_amnt    = parseFloat($('#commission_amnt').val());
        var markup_amnt        = parseFloat($('#markup_amnt').val());
        var vat_amnt           = parseFloat($('#vat_amnt').val());
        
        total1 = ( (parseFloat(tot_cost) + commission_amnt + markup_amnt + vat_amnt) * (quantity*day_night) );
        
        $('#tot_sale_cost').val(total1.toFixed(2));
        total11 = total1*x_rate;
        $('#tot_sale_cost_sar').val(total11.toFixed(2)); //cost_sar = cost_sar.toFixed(2);
        
        
    });    
    
    $(document).on('change','#to_date',function(){
        //alert($(this).val());
        
        // Here are the two dates to compare from_date
        var date1 = $('#from_date').val();
        var date2 = $(this).val();
        
        // First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
        date1 = date1.split('-');
        date2 = date2.split('-');
        
        // Now we convert the array to a Date object, which has several helpful methods
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
        
        tot_cost                = $('#tot_cost').val();
        quantity                = $('#quantity').val();
        day_night               = $('#day_night').val();
        supplier_unit_rate      = $('#supplier_unit_rate').val();
        var x_rate              = $('#x_rate').val();
        
        var total = supplier_unit_rate * (quantity*day_night);
        
        $('#total_net_cost').val(total.toFixed(2));
        var v1 = total*x_rate;
        $('#net_cost_sar').val(v1.toFixed(2));
        
        var commission_amnt    = parseFloat($('#commission_amnt').val());
        var markup_amnt        = parseFloat($('#markup_amnt').val());
        var vat_amnt           = parseFloat($('#vat_amnt').val());
        
        total1 = ( (parseFloat(tot_cost) + commission_amnt + markup_amnt + vat_amnt) * (quantity*day_night) );
        
        $('#tot_sale_cost').val(total1.toFixed(2));
        total11 = total1*x_rate;
        $('#tot_sale_cost_sar').val(total11.toFixed(2)); //cost_sar = cost_sar.toFixed(2);
        
    });    
    
    // $(document).on('change','#vat',function(){
    $(document).on('change keyup','#select_vat',function(){   
        var commission_amnt =0;markup_amnt =0;supplier_unit_rate =0;
        var commission_amnt    = $('#commission_amnt').val();
        var markup_amnt        = $('#markup_amnt').val();
        var supplier_unit_rate = $('#supplier_unit_rate').val();
        var vat_per            = $('#select_vat').val();
        
        var cal = 0; 
        
        var cal = (parseInt(commission_amnt)+parseInt(markup_amnt)+parseInt(supplier_unit_rate))*parseInt(vat_per)/100;
        $('#vat_amnt').val(cal.toFixed(2));
        
        
        var tot_cost = $('#tot_cost').val();
        tot_cost = parseFloat(tot_cost)+parseInt(commission_amnt)+parseInt(markup_amnt)+cal;
        var quantity =0;day_night=0;
        quantity    = $('#quantity').val();
        day_night   = $('#day_night').val();
        tot_cost    = tot_cost * (quantity*day_night);
        
        $('#tot_sale_cost').val(tot_cost);
        
        var x_rate = $('#x_rate').val();
        var cost_sar = x_rate*tot_cost;
        cost_sar = cost_sar.toFixed(2);
        $('#tot_sale_cost_sar').val(cost_sar);
       
    });
    
    
    $(document).on('change keyup','#select_commission',function(){//commission
    
            var vat_per = $('#select_commission').val();
      var unit_rate=$('#unit_rate').val();
      var cal = 0;
      var tot_cost=$('#tot_cost').val();
      if(tot_cost)
        cal = tot_cost*vat_per/100;
      tot_commission=cal;
      $('#commission_amnt').val(cal.toFixed(2));
      
      //tot_cal = (tot_cost*unit_rate)+tot_vat+tot_commission+tot_markup;
       var supplier_unit_rate   = $('#supplier_unit_rate').val();
       var markup_amnt          = $('#markup_amnt').val();
       var vat                  = $('#vat').val();
       
       var total = (cal+parseFloat(markup_amnt)+parseFloat(supplier_unit_rate))*parseFloat(vat)/100;
       $('#vat_amnt').val(total.toFixed(2));
      
        quantity = $('#quantity').val();
        day_night = $('#day_night').val();
        
        Total = parseFloat(tot_cost)+cal+parseFloat(markup_amnt)+total;
       
        $('#tot_sale_cost').val(Total*(quantity*day_night));
        total = Total*(quantity*day_night);
        var x_rate = $('#x_rate').val();
        total = total*parseFloat(x_rate);
        total = total.toFixed(2);
        $('#tot_sale_cost_sar').val(total);//cost_sar.toFixed(2)
        
        var comm = $(this).val();
        $('#select_commission').val(comm);
    });
    
    

    $(document).on('change keyup','#select_markup',function(){
      var vat_per = $('#select_markup').val();
      var unit_rate=$('#unit_rate').val();
      var cal = 0;
      var tot_cost=$('#tot_cost').val();
      if(tot_cost)
        cal = tot_cost*vat_per/100;
      tot_markup=cal;
      $('#markup_amnt').val(cal.toFixed(2));
      tot_cal = (tot_cost*unit_rate)+tot_vat+tot_commission+tot_markup;
       $('#tot_sale_cost').val(tot_cal);
       
       var supplier_unit_rate   = $('#supplier_unit_rate').val();
       var commission_amnt      = $('#commission_amnt').val();
       var vat                  = $('#vat').val();
       
       var total = (cal+parseFloat(commission_amnt)+parseFloat(supplier_unit_rate))*parseFloat(vat)/100;
       $('#vat_amnt').val(total.toFixed(2));
      
        quantity = $('#quantity').val();
        day_night = $('#day_night').val();
        
        Total = parseFloat(tot_cost)+cal+parseFloat(commission_amnt)+total;
       
        $('#tot_sale_cost').val(Total*(quantity*day_night));
        total = Total*(quantity*day_night);
        var x_rate = $('#x_rate').val();
        total = total*parseFloat(x_rate);
        total = total.toFixed(2);
        $('#tot_sale_cost_sar').val(total);
       
    });
    
    $(document).on('change keyup','#x_rate',function(){
        var x_rate              = $('#x_rate').val();
        var total_net_cost      = $('#total_net_cost').val();
        var tot_sale_cost       = $('#tot_sale_cost').val();
        var v2 = total_net_cost*x_rate;
        $('#net_cost_sar').val(v2.toFixed(2));
        $('#tot_sale_cost_sar').val(tot_sale_cost*x_rate);
    });
    
    
    $(document).on('change keyup','#supplier_unit_rate',function(){
        total_net_cost = 0;quantity=0;day_night=0;total=0;
        var supplier_unit_rate = $('#supplier_unit_rate').val();  
        //alert(supplier_unit_rate);
        //var total_net_cost = $('#total_net_cost').val();
        var quantity = $('#quantity').val();
        var day_night = $('#day_night').val();
        if(quantity != 0 && day_night != 0)
        {
            var total = (parseInt(quantity)*parseInt(day_night))*supplier_unit_rate;
        }
        else
        {
            total = supplier_unit_rate;
        }
        
        $('#total_net_cost').val(total.toFixed(2));
        
        var x_rate = $('#x_rate').val();
        
        total = total * x_rate;
        $('#net_cost_sar').val(total.toFixed(2));
        
    });    
    
    $(document).on('change keyup','#tot_cost',function(){
      
      $('#net_cost_sar').val($(this).val().toFixed(2));
      var unit_rate = $('#unit_rate').val();
      var vat_cal=0;
      var comm_cal=0;
      var markup_cal=0;
      var tot_cal=0;
      var vat_per = $('#vat option:selected').val();
      if(vat_per)
        vat_cal = tot_cost*vat_per/100;
      var commission_per = $('#commission option:selected').val();
      if(commission_per)
        comm_cal = tot_cost*commission_per/100;
      var markup_per = $('#markup option:selected').val();
      if(markup_per)
        markup_cal = tot_cost*markup_per/100;
      tot_cal = (tot_cost*unit_rate)+vat_cal+comm_cal+markup_cal;
      $('#tot_sale_cost').val(tot_cal);
      
        commission_amnt = $('#commission_amnt').val();
        markup_amnt = $('#markup_amnt').val();
        vat_amnt = $('#vat_amnt').val();      
        quantity = $('#quantity').val();
        day_night = $('#day_night').val();      
        var tot_cost1 = $(this).val();
      
        tot_cal1 = (parseFloat(tot_cost1)+parseFloat(commission_amnt)+parseFloat(markup_amnt)+parseFloat(vat_amnt))*(parseFloat(quantity)*parseFloat(day_night));
        $('#tot_sale_cost').val(tot_cal1);
        
        x_rate= $('#x_rate').val();
        $('#tot_sale_cost_sar').val(tot_cal1*x_rate);
      
    });
    
    
    $(document).on('change keyup','#unit_rate',function(){
      var tot_cost = $('#tot_cost').val();
      var unit_rate = $(this).val();
      var vat_cal=0;
      var comm_cal=0;
      var markup_cal=0;
      var tot_cal=0;
      var vat_per = $('#vat option:selected').val();
      if(vat_per)
        vat_cal = tot_cost*vat_per/100;
      var commission_per = $('#commission option:selected').val();
      if(commission_per)
        comm_cal = tot_cost*commission_per/100;
      var markup_per = $('#markup option:selected').val();
      if(markup_per)
        markup_cal = tot_cost*markup_per/100;
      tot_cal = (tot_cost*unit_rate)+vat_cal+comm_cal+markup_cal;
      $('#tot_sale_cost').val(tot_cal); 
    });
    
    $(document).on('change','#vat',function(){
        
        var commission_amnt =0;markup_amnt =0;supplier_unit_rate =0;
        var commission_amnt    = $('#commission_amnt').val();
        var markup_amnt        = $('#markup_amnt').val();
        var supplier_unit_rate = $('#supplier_unit_rate').val();
        var vat_per            = $('#vat option:selected').val();
        
        var cal = 0; 
        
        var cal = (parseInt(commission_amnt)+parseInt(markup_amnt)+parseInt(supplier_unit_rate))*parseInt(vat_per)/100;
        $('#vat_amnt').val(cal.toFixed(2));
        
        
        var tot_cost = $('#tot_cost').val();
        tot_cost = parseFloat(tot_cost)+parseInt(commission_amnt)+parseInt(markup_amnt)+cal;
        var quantity =0;day_night=0;
        quantity    = $('#quantity').val();
        day_night   = $('#day_night').val();
        tot_cost    = tot_cost * (quantity*day_night)//tot_sale_cost
        
        $('#tot_sale_cost').val(tot_cost.toFixed(2));
        
        var x_rate = $('#x_rate').val();
        var cost_sar = x_rate*tot_cost;
        cost_sar = cost_sar.toFixed(2);
        $('#tot_sale_cost_sar').val(cost_sar);
        
        
        var comm = $(this).val();
        $('#select_vat').val(comm);
       
    });
    
    $(document).on('change','#commission',function(){
      var vat_per = $('#commission option:selected').val();
      var unit_rate=$('#unit_rate').val();
      var cal = 0;
      var tot_cost=$('#tot_cost').val();
      if(tot_cost)
        cal = tot_cost*vat_per/100;
      tot_commission=cal;
      $('#commission_amnt').val(cal.toFixed(2));
      
      //tot_cal = (tot_cost*unit_rate)+tot_vat+tot_commission+tot_markup;
       var supplier_unit_rate   = $('#supplier_unit_rate').val();
       var markup_amnt          = $('#markup_amnt').val();
       var vat                  = $('#vat').val();
       
       var total = (cal+parseFloat(markup_amnt)+parseFloat(supplier_unit_rate))*parseFloat(vat)/100;
       $('#vat_amnt').val(total.toFixed(2));
      
        quantity = $('#quantity').val();
        day_night = $('#day_night').val();
        
        Total = parseFloat(tot_cost)+cal+parseFloat(markup_amnt)+total;
       
        $('#tot_sale_cost').val(Total*(quantity*day_night));
        total = Total*(quantity*day_night);
        var x_rate = $('#x_rate').val();
        total = total*parseFloat(x_rate);
        total = total.toFixed(2);
        $('#tot_sale_cost_sar').val(total);//cost_sar.toFixed(2)
        
        var comm = $(this).val();
        $('#select_commission').val(comm);
       
    });
    
    
    $(document).on('change','#markup',function(){
      var vat_per = $('#markup option:selected').val();
      var unit_rate=$('#unit_rate').val();
      var cal = 0;
      var tot_cost=$('#tot_cost').val();
      if(tot_cost)
        cal = tot_cost*vat_per/100;
      tot_markup=cal;
      $('#markup_amnt').val(cal.toFixed(2));
      tot_cal = (tot_cost*unit_rate)+tot_vat+tot_commission+tot_markup;
       $('#tot_sale_cost').val(tot_cal);
       
       var supplier_unit_rate   = $('#supplier_unit_rate').val();
       var commission_amnt      = $('#commission_amnt').val();
       var vat                  = $('#vat').val();
       
       var total = (cal+parseFloat(commission_amnt)+parseFloat(supplier_unit_rate))*parseFloat(vat)/100;
       $('#vat_amnt').val(total.toFixed(2));
      
        quantity = $('#quantity').val();
        day_night = $('#day_night').val();
        
        Total = parseFloat(tot_cost)+cal+parseFloat(commission_amnt)+total;
       
        $('#tot_sale_cost').val(Total*(quantity*day_night));
        total = Total*(quantity*day_night);
        var x_rate = $('#x_rate').val();
        total = total*parseFloat(x_rate);
        total = total.toFixed(2);
        $('#tot_sale_cost_sar').val(total);
        
        var comm = $(this).val();
        $('#select_markup').val(comm);
       
    });




      $("#insert_adds").validate({       
            rules: {
               
              "data[client_code]"          : "required",
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
            if(validator.form() == true){
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
	$('.timepicker,.timepicker2').wickedpicker();
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
</script>

  