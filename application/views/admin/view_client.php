<link rel="stylesheet" href="http://ericjgagnon.github.io/wickedpicker/wickedpicker/wickedpicker.min.css">
 <link rel="stylesheet" type="text/css" href="http://volive.in/joher/assets/css/demo_print.css"  media="print">
<style>
    #insert_client label.error {
        color:red; 
    }
    #insert_client input.error,textarea.error,select.error {
        border:1px solid red;
        color:red; 
    }    
   
	.mvc-select {
    display: inline-block !important;
    width: auto !important;
	}
    
    .popover {
    z-index: 2000;
    position:relative;
    }
    .reset-btn { margin-top: 21px;     background-color: #585858;
    border-color: #585858; margin-right: 5px; }
    .reset-btn:hover , .reset-btn:focus , .reset-btn:active { background-color: #585858 !important;
    border-color: #585858 !important; }
    button.add-save.btn.btn-primary.waves-effect.waves-light.insert_client , button.add-save.btn.btn-primary.waves-effect.waves-light.insert_client:hover , button.add-save.btn.btn-primary.waves-effect.waves-light.insert_client:focus { background: #c62928 !important; border-color: #c62928 !important; }
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
            <li class="breadcrumb-item"><a href="#:" >Add/Edit User</a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h5 class="card-header-text">View user</h5><span>
              <button class="btn btn-success fa fa-print" data-name="<?php echo @$current_page; ?>" style="margin-left:65%" onclick="PrintMe('divid')">Print</button></span>
          </div>
          
         
               <!-- <table width="100%">
                    <tr  style="color: #fff;background-color: #337ab7;border-color:#337ab7;">
                        <td colspan="10">PERSONAL DETAILS</td>    
                    </tr>
                    
                    <tr>
                        <td colspan="1"><b>TITLE:*</b></td>
                        <td colspan="1"> <input type="radio"  name="data[title]" id="title" onkeyup="return fullname()" value="Mr" <?php if(@$client['title']=='Mr'){ echo 'checked';}?> > Mr.</td>
                        <td colspan="1">  <input type="radio" name="data[title]" id="title" onkeyup="return fullname()" value="Mrs" <?php if(@$client['title']=='Mrs'){ echo 'checked';}?> >Mrs.</td>
                        <td colspan="1"><input type="radio" name="data[title]" id="title" onkeyup="return fullname()" value="Ms" <?php if(@$client['title']=='Ms'){ echo 'checked';}?>>Ms.</td>
                        
                    </tr>
                   
                    <tr>
                        <td colspan="1"></td>
                        <td colspan="1">  <input type="radio" name="data[title1]" value="HRH-Prince" <?php if(@$client['title1']=='HRH-Prince'){ echo 'checked';}?> >HRH-Prince </td>
                        <td colspan="1"> <input type="radio" name="data[title1]" value="HRH-Princess" <?php if(@$client['title1']=='HRH-Princess'){ echo 'checked';}?> >HRH-Princess </td>
                        <td colspan="1"> <input type="radio"  name="data[title1]" value="HH-Prince" <?php if(@$client['title1']=='HH-Prince'){ echo 'checked';}?> >HH-Prince </td>
                        <td> <input type="radio" name="data[title1]" value="HH-Princess" <?php if(@$client['title1']=='HH-Princess'){ echo 'checked';}?> >HH-Princess </br></td>
                    </tr>
                    
                    <tr>
                         <td colspan="1"><b>CLIENT CODE:</b></td>
                         <td colspan="2"><input class="form-control" type="text" name="data[client_code]" value="<?php echo @$client['client_code']?>" placeholder="Enter client code" ></td> 
                         <td colspan="1"><b>CITY:</b></td>
                         <td colspan="2">
                             <select class="form-control" name="data[city]">
                                     <option>Select Name</option>
                                <?php 
                                    $res = $this->db->get_where('city')->result();
                                    if($res){ 
                                        foreach($res as $row)
                                        { ?>
                                         <option value ="<?=$row->city_name?>" <?php if($row->city_name == @$client['city']){ echo 'selected';}?>><?=$row->city_name?></option>   
                                    <?php  }
                                    }
                                ?>
                            </select>
                        </td> 
                    </tr>
                   
                    <tr>
                       <td colspan="1"><b>NATIONALITY:*</b></td>
                       <td colspan="2">
                            <?php //echo $adds['user_id'];?>
                                 <select class="form-control" name="data[nationality]" id="get_nationality"
                                  >
                                     <option>Select Nationality</option>
                                <?php 
                                   $res = $this->db->get_where('countries')->result();
                                    if($res){ 
                                        foreach($res as $row)
                                        { ?>
                                         <option value = "<?=$row->name?>"  <?php if($row->name == @$client['nationality']){ echo 'selected';}?> ><?=$row->name?></option>   
                                    <?php  }
                                    }
                                ?>
                            </select>
                       </td> 
                       <td colspan="1"><b> CURRENT ADDRESS:</b></td>
                       <td colspan="2">
                           <textarea class="form-control" type="text" name="data[current_address]" placeholder="Enter Address" ><?php echo @$client['current_address']?></textarea>
                       </td>
                       
                    </tr>
                    
                    <tr>
                       <td colspan="1"><b>FIRST NAME:*</b></td>
                       <td colspan="2"> <input class="form-control" type="text" name="data[first_name]" id="first_name" value="<?php echo @$client['first_name']?>" placeholder="Enter First Name" onkeyup="return fullname()"></td>
                       <td colspan="1"></td>
                       <td colspan="2"></td>
                    </tr>
                    
                    <tr>
                       <td colspan="1"><b>SECOND NAME:</b></td>
                       <td colspan="2"><b>SECOND NAME:</b></td>
                    </tr>
                    
                     <tr>
                       <td colspan="1"><b>MIDDLE NAME:</b></td>
                    </tr>
                    
                    <tr>
                       <td colspan="1"><b>LAST NAME:*</b></td>
                    </tr>
                    
                    <tr>
                       <td colspan="1"><b>FULL NAME:*</b></td>
                    </tr>
                    
                    <tr>
                       <td colspan="1"><b>DATE OF BIRTH:*</b></td>
                    </tr>
                    
                    <tr>
                       <td colspan="1"><b>GENDER:*</b></td>
                    </tr> 
                    
                    <tr>
                       <td colspan="1"><b>MARITAL STATUS:*</b></td>
                    </tr>
                    
                     <tr>
                       <td colspan="1"><b>P.O. BOX:</b></td>
                    </tr> 
                    
                    <tr>
                       <td colspan="1"><b>POSTAL CODE:</b></td>
                    </tr>
                    
                </table>
           -->
          
          
   <div class="card-block addform-block" id="divid">
      <form id="insert_client" method="post" >

        <div class="panel panel-primary" style="border-color: #337ab7;">
            <div class="panel-heading" style="color: #fff; background-color: #337ab7 !important; border-color:#337ab7;   -webkit-print-color-adjust: exact; ">PERSONAL DETAILS</div>
            <!-- <div class="panel-heading" style="text-align: right; color: #fff;background-color: #337ab7;border-color:#337ab7;">AGENT CODE</div> -->
            <div class="panel-body" style="padding: 15px;">
              <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="textinput">Title:<span class="star">*</span></label>
               
                <div class="col-sm-6">
              <label class="radio-inline">
              <input type="radio"  name="data[title]" id="title" onkeyup="return fullname()" value="Mr" <?php if(@$client['title']=='Mr'){ echo 'checked';}?> >Mr.
            </label>
            <label class="radio-inline">
              <input type="radio" name="data[title]" id="title" onkeyup="return fullname()" value="Mrs" <?php if(@$client['title']=='Mrs'){ echo 'checked';}?> >Mrs.
            </label>
            <label class="radio-inline">
              <input type="radio" name="data[title]" id="title" onkeyup="return fullname()" value="Ms" <?php if(@$client['title']=='Ms'){ echo 'checked';}?>>Ms.
            </label>
          </div>
        </div>
         <div class="clearfix"></div>
         <div class="form-group">          
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-8">
              <label class="radio-inline">
              <input type="radio" name="data[title1]" value="HRH-Prince" <?php if(@$client['title1']=='HRH-Prince'){ echo 'checked';}?> >HRH-Prince </label>
            <label class="radio-inline">
              <input type="radio" name="data[title1]" value="HRH-Princess" <?php if(@$client['title1']=='HRH-Princess'){ echo 'checked';}?> >HRH-Princess</label>
            <label class="radio-inline">
              <input type="radio"  name="data[title1]" value="HH-Prince" <?php if(@$client['title1']=='HH-Prince'){ echo 'checked';}?> >HH-Prince</label>
              <label class="radio-inline">
              <input type="radio" name="data[title1]" value="HH-Princess" <?php if(@$client['title1']=='HH-Princess'){ echo 'checked';}?> >HH-Princess</label>
        </div> 
        </div>       
      </div>
         
        <div class="clearfix"></div>


        <!-- Form Name -->
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">          
              <!-- Text input-->
              <div class="form-group">
                <label class="col-sm-3 control-label" for="textinput">Client Code:</label>
                <div class="col-sm-9">
                  <input style="margin-bottom:10px;" class="form-control" type="text" name="data[client_code]" value="<?php echo @$client['client_code']?>" placeholder="Enter client code" >
                </div>
              </div>

      
          <!--  <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Nationality:</label>
            <div class="col-sm-9">
              <input class="form-control" type="text" name="data[nationality]" value="<?php echo @$client['nationality']?>" placeholder="Enter Nationality" >
            </div>
          </div> -->

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Nationality:<span class="star">*</span></label>
            <div class="col-sm-9">
                <?php //echo $adds['user_id'];?>
                 <select style="margin-bottom:10px;" class="form-control" name="data[nationality]" id="get_nationality"
                  >
                     <option>Select Nationality</option>
                <?php 
                   $res = $this->db->get_where('countries')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value = "<?=$row->name?>"  <?php if($row->name == @$client['nationality']){ echo 'selected';}?> ><?=$row->name?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">First Name:<span class="star">*</span></label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[first_name]" id="first_name" value="<?php echo @$client['first_name']?>" placeholder="Enter First Name" onkeyup="return fullname()">
            </div>
          </div>
          
          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Sec Name</label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[second_name]"  id="second_name" value="<?php echo @$client['second_name']?>" placeholder="Enter Second Name" onkeyup="return fullname()">
            </div>
          </div>
          
      <!-- Text input-->
       <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Mid Name</label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[middle_name]" id="middle_name" value="<?php echo @$client['middle_name']?>" placeholder="Enter Middle Name" onkeyup="return fullname()">
            </div>
          </div>
      <!-- Text input-->
        
       <!-- Text input-->
       <div class="form-group">
           
            <label class="col-sm-3 control-label" for="textinput">Last Name:<span class="star">*</span></label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[last_name]" id="last_name" value="<?php echo @$client['last_name']?>" placeholder="Enter UserName" onkeyup="return fullname()">
            </div>
          </div>
      <!-- Text input-->

       <!-- Text input-->
       <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Full Name:<span class="star">*</span></label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[full_name]" id="full_name" value="<?php echo @$client['full_name']?>" placeholder="Enter Full Name" readonly>
            </div>
          </div>
      
       <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">DOB:<span class="star">*</span></label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="date" name="data[dob]" value="<?php echo @$client['dob']?>" placeholder="Enter DOB" >
            </div>
          </div>
      <!-- Text input-->

        <!-- Text input-->
       <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Gender:<span class="star">*</span></label>
            <div class="col-sm-9">
               <div class="">
            <input type="radio" name="data[gender]"  <?php if(@$client['gender'] == 'male'){ echo 'checked';} ?> id="radio1" value ="male">
            <label for="radio1">
                Male
            </label>
            <input type="radio" name="data[gender]" id="radio2" value = "female" <?php if(@$client['gender'] == 'female'){ echo 'checked';} ?>>
            <label for="radio2">
                Female
            </label>
        </div>
        
            </div>
          </div>
    <!-- Text input--> 
        

           <!-- Text input-->
       <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">P.O. Box:</label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="number" name="data[po_box]" value="<?php echo @$client['po_box']?>">
            </div>
          </div>
      <!-- Text input-->

      <!-- Text input-->
       <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Postal Code:</label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="number" name="data[postal_code]" value="<?php echo @$client['postal_code']?>" placeholder="Enter postal code" >
            </div>
          </div>
      <!-- Text input-->

      
          </div> 
          <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">

            <!-- Text input-->
       <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">City:</label>
            <div class="col-sm-9">
              <!-- <input class="form-control" type="text" name="data[city]" value="<?php //echo @$client['city']?>" placeholder="Enter City" > -->
               <select style="margin-bottom:10px;" class="form-control" name="data[city]">
                     <option>Select Name</option>
                <?php 
                    $res = $this->db->get_where('city')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->city_name?>" <?php if($row->city_name == @$client['city']){ echo 'selected';}?>><?=$row->city_name?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div>
      <!-- Text input-->

          <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Address</label>
            <div class="col-sm-9">
             <!--<textarea class="form-control" type="text" name="data[current_address]" placeholder="Enter Address" ><?php echo @$client['current_address']?></textarea>-->
             <input style="margin-bottom:10px;" class="form-control" type="text" name="data[current_address]" value="<?php echo @$client['current_address']?>" placeholder="Enter Address" >
            </div>
          </div>
        
        <div class="form-group ">
            <label class="col-sm-3 control-label" for="textinput">Address:</label>
            <div class="col-sm-9">
            <!-- <textarea class="form-control" type="text" name="data[permanent_address]" placeholder="Enter Address" ><?php echo @$client['permanent_address']?></textarea>-->
             <input style="margin-bottom:10px;" class="form-control" type="text" name="data[permanent_address]" value="<?php echo @$client['permanent_address']?>" placeholder="Enter Address" >
            </div>
          </div>


           <!-- Text input-->
       <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Number:</label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="number" name="data[landline]" value="<?php echo @$client['landline']?>" placeholder="Enter landline" >
            </div>
          </div>
      <!-- Text input-->
       <!-- Text input-->
       <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Fax Number</label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[fax_number]" value="<?php echo @$client['fax_number']?>" placeholder="Enter fax number" >
            </div>
          </div>
      <!-- Text input-->
        <!-- Text input-->
       <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Mo.Number1<span class="star">*</span></label>
            <div class="col-sm-9">
              <input  style="margin-bottom:10px;" class="form-control" type="number" name="data[mobile]" value="<?php echo @$client['mobile']?>" placeholder="Enter mobile" >
              <span id="mobile_error" style="color: red;"></span>
            </div>
          </div>
      <!-- Text input-->
       <!-- Text input-->
       <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Mo.Number2:</label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="number" name="data[mobile_2]" value="<?php echo @$client['mobile_2']?>" placeholder="Enter Mobile" >
            </div>
          </div>
      <!-- Text input-->

      <!-- Text input-->
       <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Email:<span class="star">*</span></label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[email]" value="<?php echo @$client['email']?>" placeholder="Enter email" >
              <span id="email_error" style="color: red;"></span>
            </div>
          </div>
      <!-- Text input-->
       <!-- Text input-->
       
        <div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">Marital Status:<span class="star">*</span></label>
            <div class="col-sm-8">
                <div class="">
                <input type="radio" name="data[marital_status]" value = "single" <?php if(@$client['marital_status'] == 'single'){ echo 'checked';} ?> id="radio1" >
                <label for="radio1">
                    Single
                </label>
                <input type="radio" name="data[marital_status]" id="radio2" value = "married" <?php if(@$client['marital_status'] == 'married'){ echo 'checked';} ?>>
                <label for="radio2">
                    Married
                </label>
                </div>
            </div>
        </div>
       
        <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Alternate Email:</label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[email_2]" value="<?php echo @$client['email_2']?>" placeholder="Enter email " >
            </div>
        </div>
          
      <!-- Text input--> 
          </div>
          <div class="clearfix"></div>  

          <div class="panel panel-primary" >
          <div class="panel-heading" style="color: #fff;background-color: #337ab7;border-color:#337ab7;  -webkit-print-color-adjust: exact; " >OTHER INFORMATION</div>
          <div class="panel-body" style="padding: 15px;">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
            <label class="col-sm-6 control-label" for="textinput">PASSPORT Number:</label>
            <div class="col-sm-6">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[passport_number]" value="<?php echo @$client['passport_number']?>" placeholder="Enter passport number" >
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-6 control-label" for="textinput">National ID Number:</label>
            <div class="col-sm-6">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[national_id]" value="<?php echo @$client['national_id']?>" placeholder="Enter national id" >
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-6 control-label" for="textinput">Professional Licenses:</label>
            <div class="col-sm-6">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[professional_licenses]" value="<?php echo @$client['professional_licenses']?>" placeholder="Enter professional licenses" >
            </div>
          </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
            <label class="col-sm-6 control-label" for="textinput">Date Issued:</label>
            <div class="col-sm-6">
              <input style="margin-bottom:10px;" class="form-control" type="date" name="data[date_issued]" value="<?php echo @$client['date_issued']?>" placeholder="Enter date issued" >
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-6 control-label" for="textinput">Expiration Date:</label>
            <div class="col-sm-6">
              <input style="margin-bottom:10px;" class="form-control" type="date" name="data[expire_date]" value="<?php echo @$client['expire_date']?>" placeholder="Enter expire date" >
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-6 control-label" for="textinput">Driver’s Licenses:</label>
            <div class="col-sm-6">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[driver_licenses]" value="<?php echo @$client['driver_licenses']?>">
            </div>
          </div> 

          <div class="form-group">
            <label class="col-sm-6 control-label" for="textinput">Other Licenses:</label>
            <div class="col-sm-6">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[other_licenses]" value="<?php echo @$client['other_licenses']?>" >
            </div>
          </div> 
            </div>            
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="panel panel-primary" >
          <div class="panel-heading" style="color: #fff;background-color: #337ab7;border-color:#337ab7  -webkit-print-color-adjust: exact; ;">EDUCATION BACKGROUND</div>
          <div class="panel-body" style="padding: 15px;">
            <div class="col-sm-8 ">
            <div class="form-group">
            <label class="col-sm-5 control-label" for="textinput">Degree:</label>
            <div class="col-sm-7">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[degree]" value="<?php echo @$client['degree']?>" placeholder="Enter Degree" >
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-5 control-label" for="textinput">Institution:(university,colleges,academy):</label>
            <div class="col-sm-7">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[institution]" value="<?php echo @$client['institution']?>" placeholder="Enter Institution Name" >
            </div>
          </div>
            </div>                       
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="panel panel-primary" >
          <div class="panel-heading" style="color: #fff;background-color: #337ab7;border-color:#337ab7  -webkit-print-color-adjust: exact; ;">EMPLOYMENT BACKGROUND</div>
          <div class="panel-body" style="padding: 15px;">
            <div class="col-sm-8 ">
            <div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">Name of Company:</label>
            <div class="col-sm-8">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[company_name]" value="<?php echo @$client['company_name']?>" placeholder="Enter Company Name" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">Position:</label>
            <div class="col-sm-8">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[position]" value="<?php echo @$client['position']?>" placeholder="Enter position" >
            </div>
          </div>
            </div>                       
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="panel panel-primary" >
          <div class="panel-heading" style="color: #fff;background-color: #337ab7;border-color:#337ab7  -webkit-print-color-adjust: exact; ;">CLIENT’S INTERESTS / HOBBIES</div>
          <div class="panel-body" style="padding: 15px;">
           
          <!-- Text input-->
       <div class="form-group">
           <?php
           $sports = [];
           if(@$client['sports']){
            $sports = unserialize(@$client['sports']);
            $sport_len = sizeof($sports)-1;
            //print_r($sports);
           }
           ?>
           <label class="col-sm-3 control-label" for="textinput">SPORTS:</label>
             <div class="col-sm-9">
              <label class="checkbox-inline">
                <input type="checkbox"  id="checkbox1" class="sports_list" name="data[sports][]" value = "Football" <?php  if(@$sports){
                if(in_array("Football", @$sports)){ echo "checked";}} ?>>Football
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox2" class="sports_list" name="data[sports][]" value = "Golf" <?php 
                if(@$sports){ if(in_array("Golf", @$sports)){ echo "checked";} } ?> >Golf
              </label>
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox3" class="sports_list" name="data[sports][]" value = "Tennis" <?php 
                if(@$sports){ if(in_array("Tennis", @$sports)){ echo "checked";} } ?>>Tennis
              </label>
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox4" class="sports_list" name="data[sports][]" value = "Rugby" <?php if(@$sports){ if(in_array("Rugby", @$sports)){ echo "checked";} }?>>Rugby
              </label>
              <label class="checkbox-inline">
                <input type="checkbox"  id="checkbox5" class="sports_list" name="data[sports][]" value = "Diving" <?php if(@$sports){ if(in_array("Diving", @$sports)){ echo "checked";} }?> > Diving
              </label>
              <label class="checkbox-inline">
                <input type="checkbox"  id="checkbox6" class="sports_list" name="data[sports][]" value = "Motor_Sports" <?php if(@$sports){ if(in_array("Motor_Sports", @$sports)){ echo "checked";} } ?> >Motor Sports
              </label>
            </div>
          </div>
    <!-- Text input-->  
    <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox7" class="sports_list" name="data[sports][]" value = "Riding" <?php if(@$sports){ if(in_array("Riding", @$sports)){ echo "checked";} } ?> >Riding
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox8" class="sports_list" name="data[sports][]" value = "Sailing" <?php if(@$sports){ if(in_array("Sailing", @$sports)){ echo "checked";} }?> >Sailing
              </label>
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox9" class="sports_list" name="data[sports][]" value = "Trekking_Climbing" <?php if(@$sports){ if(in_array("Trekking_Climbing", @$sports)){ echo "checked";} } ?> >Trekking/Climbing
              </label>
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox10" class="sports_list" name="data[sports][]" value = "Horse_Racing" <?php if(@$sports){ if(in_array("Horse_Racing", @$sports)){ echo "checked";} } ?> >Horse Racing
              </label>
              <label class="checkbox-inline">
                <input type="checkbox"  id="checkbox11" class="sports_list" name="data[sports][]" value = "Basketball" <?php if(@$sports){ if(in_array("Basketball", @$sports)){ echo "checked";} }?> >Basketball
              </label>             
            </div>
          </div> 

          <!-- Text input-->  
    <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox12" class="sports_list" name="data[sports][]" value = "Cricket" <?php if(@$sports){ if(in_array("Cricket", @$sports)){ echo "checked";} }?> >Cricket
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox13" class="sports_list" name="data[sports][]" value = "Swimming" <?php if(@$sports){ if(in_array("Swimming", @$sports)){ echo "checked";} }?> >Swimming
              </label>
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox14" class="sports_list" name="data[sports][]" value = "Extreme_Sports" <?php if(@$sports){ if(in_array("Extreme_Sports", @$sports)){ echo "checked";} } ?> >Extreme Sports
              </label>
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox15" class="sports_list" name="data[sports][]" value = "Others" <?php if(@$sports){ if(in_array("Others", @$sports)){ echo "checked";} }?> >Others
                <input type="text" name="data[sports][]" id="sport_other" value="<?php if(@$sports){ if(in_array("Others", @$sports)){ echo @$sports[$sport_len]; } } ?>">              
              </label>                           
            </div>
          </div> 

        <div class="clearfix"></div>
       
        <div class="clearfix"></div>
       
        <div class="form-group">
          <?php
           $entertainment = [];
           if(@$client['entertainment']){
            $entertainment = unserialize(@$client['entertainment']);
             $entertainment_len = sizeof( $entertainment)-1;
            //print_r(@$client['entertainment']);
           }
           ?>          
            <label class="col-sm-3 control-label" for="textinput">ENTERTAINMENT:</label>
            <div class="col-sm-9">
              <label class="checkbox-inline">
                <input type="checkbox" name="data[entertainment][]" class="entertainment_list" value = "Concert" <?php if(is_array(@$entertainment)){ if(in_array("Concert", $entertainment)){ echo "checked";} } ?>>Concert
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="data[entertainment][]" class="entertainment_list" value = "Theatre" <?php if(is_array(@$entertainment)){ if(in_array("Theatre", $entertainment)){ echo "checked";} } ?> >Theatre
              </label>
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox3" name="data[entertainment][]" class="entertainment_list" value = "Cinema" <?php if(is_array(@$entertainment)){ if(in_array("Cinema", $entertainment)){ echo "checked";} } ?>>Cinema
              </label>
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox4" name="data[entertainment][]" class="entertainment_list" value = "Casino" <?php if(is_array(@$entertainment)){ if(in_array("Casino", $entertainment)){ echo "checked";}} ?>>Casino
              </label>
              <label class="checkbox-inline">
                <input type="checkbox"  id="checkbox5" name="data[entertainment][]" class="entertainment_list" value = "Others" <?php if(is_array(@$entertainment)){ if(in_array("Others", $entertainment)){ echo "checked";}} ?> > Others
                <input type="text" name="data[entertainment][]" id="entertainment_other" value= "<?php if(is_array(@$entertainment)){ if(in_array("Others", @$entertainment)){ echo @$entertainment[$entertainment_len];}} ?>">
              </label>             
            </div>           
          </div>
     
          <div class="clearfix"></div>
       
        <div class="form-group">
            <?php
           $parties = [];
           if(@$client['parties']){
            $parties = unserialize(@$client['parties']);
            //print_r($parties);
           }
           ?>
            
            <label class="col-sm-3 control-label" for="textinput">PARTIES / SOCIAL GATHERINGS:</label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox"   name="data[parties][]" value = "Business" <?php if(@$parties){ if(in_array("Business", $parties)){ echo "checked";}} ?> >Business
              </label>
              <label class="radio-inline">
                <input type="checkbox"  name="data[parties][]" value = "Personal"  <?php if(@$parties){ if(in_array("Personal", $parties)){ echo "checked";}} ?> >Personal
              </label>
            </div>           
          </div> 

          <div class="clearfix"></div>
       
        <div class="form-group">
           <?php
           $arts_crafts = [];
           if(@$client['arts_crafts']){
            $arts_crafts = unserialize(@$client['arts_crafts']);
            //print_r($sports);
           }
           ?>
            <label class="col-sm-3 control-label" for="textinput">ARTS &CRAFTS, ACADEMIC:</label>
             <div class="col-sm-9">
              <label class="checkbox-inline">
                <input type="checkbox"  id="checkbox1" name="data[arts_crafts][]" value = "Sculpture" <?php if(@$arts_crafts){ if(in_array("Sculpture", $arts_crafts)){ echo "checked";}} ?> >Sculpture
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox2" name="data[arts_crafts][]" value = "Painting" <?php  if(@$arts_crafts){ if(in_array("Painting", $arts_crafts)){ echo "checked";} }?>>Painting
              </label>
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox3" name="data[arts_crafts][]" value = "Music" <?php if(@$arts_crafts){ if(in_array("Music", $arts_crafts)){ echo "checked";}} ?>>Music
              </label>
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox4" name="data[arts_crafts][]" value = "Molding" <?php if(@$arts_crafts){ if(in_array("Molding", $arts_crafts)){ echo "checked";}} ?>>Molding
              </label>
              <label class="checkbox-inline">
                <input type="checkbox"  id="checkbox5" name="data[arts_crafts][]" value = "Origami" <?php if(@$arts_crafts){ if(in_array("Origami", $arts_crafts)){ echo "checked";}} ?> > Origami
              </label>             
            </div>          
          </div>

          <!-- Text input-->  
    <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox6" name="data[arts_crafts][]" value = "Weaving_Stitching" <?php if(@$arts_crafts){ if(in_array("Weaving_Stitching", $arts_crafts)){ echo "checked";}} ?> >Weaving/Stitching
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox7" name="data[arts_crafts][]" value = "Coocking" <?php if(@$arts_crafts){ if(in_array("Coocking", $arts_crafts)){ echo "checked";}} ?> >Cooking
              </label>
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox8" name="data[arts_crafts][]" value = "Theatre_Arts" <?php  if(@$arts_crafts){ if(in_array("Theatre_Arts", $arts_crafts)){ echo "checked";} }?> >Theatre Arts
              </label>                          
            </div>
          </div> 

          <!-- Text input-->  
      <div class="form-group">
           
            <label class="col-sm-3 control-label" for="textinput">Travel:</label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <!--<input type="radio" id="radio1" name="data[travel]" class="travel_list" value = "International" <?php if(@$client['travel']=='International'){ echo 'checked';}?> >--><strong>INTERNATIONAL</strong>
              </label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline">
                <!--<input type="radio" id="radio2" name="data[travel]" class="travel_list" value = "Local"  <?php if(@$client['travel']=='Local'){ echo 'checked';}?> >--> <strong>LOCAL</strong>
              </label>  
                                                  
            </div>
          </div> 
          
          <?php
                $travel_details = [];
                if(@$client['travel_details'])
                {
                    @$travel_details = unserialize(@$client['travel_details']);
                    $travel_len = sizeof( $travel_details)-1;
                    //print_r($travel_details);
                }
           ?>
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="row">
            <div class="col-sm-4">
              <label class="radio-inline">
                <input type="checkbox" name="data[travel_details][]" class="travel_list" value = "Middle_East" <?php if(@$travel_details){ if(in_array("Middle_East", $travel_details)){ echo "checked";}} ?> >Middle East                
              </label>                                      
            </div>
   
            <?php
                $local_city_details = [];
                if(@$client['local_city_details'])
                {
                    @$local_city_details = unserialize(@$client['local_city_details']);
                    $travel_len = sizeof( $local_city_details)-1;
                    //print_r($local_city_details);
                    //echo $local_city_details[1];
                }
              ?>        
              <?php 
                    $res = $this->db->get_where('local_city')->result();
                   // print_r($res);
                    $z =0;
                    if($res){  foreach($res as $row)
                      {  ?>
                     <label class="checkbox-inline">    
                    <input type="checkbox" name="data[local_city_details][]" class="local_list" value ="<?php echo $row->city_name;?>"<?php if(in_array(@$row->city_name, @$local_city_details)){   echo "checked";} ?> ><?php echo $row->city_name;?> 
                   </label> 
                   <?php  $z++; }    }  ?>                       
            
	        </div>
	          </div>        

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox"  name="data[travel_details][]" class="travel_list" value = "Europe" <?php if(@$travel_details){ if(in_array("Europe", $travel_details)){ echo "checked";}} ?>  >Europe 
              </label>                                        
            </div>
          </div>

           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox" name="data[travel_details][]" class="travel_list" value = "Asia"  <?php if(@$travel_details){ if(in_array("Asia", $travel_details)){ echo "checked";}} ?>  >Asia 
              </label>                                        
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox"  name="data[travel_details][]" class="travel_list" value = "Latin_America"  <?php if(@$travel_details){ if(in_array("Latin_America", $travel_details)){ echo "checked";}} ?> >Latin America 
              </label>                                        
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox"  name="data[travel_details][]" class="travel_list" value = "Africa"  <?php if(@$travel_details){ if(in_array("Africa", $travel_details)){ echo "checked";}} ?> >Africa 
              </label>                                        
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-6">
              <label class="radio-inline">
                <input type="checkbox"  name="data[travel_details][]" class="travel_list" value = "Australia" <?php if(@$travel_details){ if(in_array("Australia", $travel_details)){ echo "checked";}} ?> >Australia 
              </label>                                        
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-6">
              <label class="radio-inline">
                <input type="checkbox" id="radio9" name="data[travel_details][]" class="travel_list" value = "Canada" <?php if(@$travel_details){ if(in_array("Canada", $travel_details)){ echo "checked";}} ?> >Canada 
              </label>                                        
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-6">
              <label class="checkbox-inline">
               <!--  <input type="checkbox" id="radio10" name="data[travel_details][]"  class="travel_list" value = "Others" <?php if(@$travel_details){ if(in_array("Others", $travel_details)){ echo "checked";}} ?> >  Others  -->
                <label class="checkbox-inline">
                <input type="checkbox" class="travel_list" name="data[travel_details][]" value = "Others" <?php if(@$travel_details){ if(in_array("Others", @$travel_details)){ echo "checked";} }?> >Others
                <input type="" name="data[travel_details][]" id="travel_other" value="<?php if(@$travel_details){ if(in_array("Others", @$travel_details)){ echo @$travel_details[$travel_len]; } } ?>">              
              </label>
              </label>                                        
            </div>
          </div>

       <div class="form-group">
           
           <?php
                $restaurants = [];
                if(@$client['restaurants'])
                {
                    @$restaurants = unserialize(@$client['restaurants']);
                    //print_r($restaurants);
                }
           ?>
          
            <label class="col-sm-3 control-label" for="textinput">RESTAURANTS:</label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox"  name="data[restaurants][]" value = "French_Cuisine" <?php  if(@$restaurants){ if(in_array("French_Cuisine", $restaurants)){ echo "checked";}} ?>  >French Cuisine
              </label>
              <label class="radio-inline">
                <input type="checkbox"  name="data[restaurants][]" value = "Italian_Cuisine"<?php if(@$restaurants){ if(in_array("Italian_Cuisine", $restaurants)){ echo "checked";}} ?> >Italian Cuisine
              </label>
               <label class="radio-inline">
                <input type="checkbox" name="data[restaurants][]" value = "Chinese_Cuisine" <?php if(@$restaurants){ if(in_array("Chinese_Cuisine", $restaurants)){ echo "checked";}} ?>>Chinese Cuisine
              </label>
               <label class="radio-inline">
                <input type="checkbox" name="data[restaurants][]" value = "Indian_Cuisine" <?php if(@$restaurants){ if(in_array("Indian_Cuisine", $restaurants)){ echo "checked";}} ?>>Indian Cuisine
              </label>              
            </div>
          </div>
    <!-- Text input-->  
    <div class="form-group">
      
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox"   name="data[restaurants][]" value = "Arabic_Cuisine" <?php if(@$restaurants){ if(in_array("Arabic_Cuisine", $restaurants)){ echo "checked";}} ?>> Arabic Cuisine
              </label>
              <label class="radio-inline">
                <input type="checkbox"   name="data[restaurants][]" value = "Thai_Cuisine" <?php if(@$restaurants){ if(in_array("Thai_Cuisine", $restaurants)){ echo "checked";}} ?> > Thai Cuisine
              </label>
              <label class="radio-inline">
                <input type="checkbox"  name="data[restaurants][]" value = "Mexican_Cuisine"<?php if(@$restaurants){ if(in_array("Mexican_Cuisine", $restaurants)){ echo "checked";}} ?> >Mexican Cuisine
              </label>
              <label class="radio-inline">
                <input type="checkbox"  name="data[restaurants][]" value = "Japanese_Cuisine" <?php if(@$restaurants){ if(in_array("Japanese_Cuisine", $restaurants)){ echo "checked";}} ?> >Japanese Cuisine
              </label>                           
            </div>
          </div> 

          <!-- Text input-->  
    <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox"  name="data[restaurants][]" value = "Spanish_Cuisine" <?php if(@$restaurants){ if(in_array("Spanish_Cuisine", $restaurants)){ echo "checked";}} ?> >Spanish Cuisine
              </label>
               <label class="radio-inline">
                <input type="checkbox"  name="data[restaurants][]" value = "Greek_Cuisine" <?php if(@$restaurants){ if(in_array("Greek_Cuisine", $restaurants)){ echo "checked";}} ?> >Greek Cuisine
              </label>
              <label class="radio-inline">
                <input type="checkbox" name="data[restaurants][]" value = "Lebanese_Cuisine"<?php if(@$restaurants){ if(in_array("Lebanese_Cuisine", $restaurants)){ echo "checked";}} ?> >Lebanese Cuisine
              </label>                          
            </div>
          </div> 

        <div class="clearfix"></div>

         <div class="form-group">
          
          <?php
                $shopping = [];
                if(@$client['restaurants'])
                {
                    @$shopping = unserialize(@$client['shopping']);
                    //print_r($shopping);
                }
           ?>
            <label class="col-sm-3 control-label" for="textinput">SHOPPING:</label>
             <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox"   name="data[shopping][]" value = "Accesories_Jewelries" <?php if(@$shopping){ if(in_array("Accesories_Jewelries", $shopping)){ echo "checked";}} ?>>Accesories & Jewelries
              </label>
              <label class="radio-inline">
                <input type="checkbox"  name="data[shopping][]" value = "Clothing"  <?php if(@$shopping){ if(in_array("Clothing", $shopping)){ echo "checked";}} ?> >Clothing
              </label>
               <label class="radio-inline">
                <input type="checkbox" name="data[shopping][]" value = "Gadgets"  <?php if(@$shopping){ if(in_array("Gadgets", $shopping)){ echo "checked";}} ?>>Gadgets
              </label>
               <label class="radio-inline">
                <input type="checkbox"  name="data[shopping][]" value = "Cars" <?php if(@$shopping){ if(in_array("Cars", $shopping)){ echo "checked";}} ?>>Cars
              </label>                          
            </div>          
          </div>

            <div class="clearfix"></div>
       
         <div class="form-group">
          <?php
          $health=[];
            if(@$client['health'])
            {
              $health = unserialize($client['health']);
              $health_len = sizeof($health)-1;
            }
          ?>
            <label class="col-sm-3 control-label" for="textinput">HEALTH & WELLNESS:</label>
             <div class="col-sm-9">
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox1" name="data[health][]" class="h_w_list" value = "Skin_Treatment" <?php if(@$health){ if(in_array("Skin_Treatment", $health)){ echo "checked";}} ?>>Skin Treatment
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox2" name="data[health][]" class="h_w_list" value = "Hair_Treatment" <?php if(@$health){ if(in_array("Hair_Treatment", $health)){ echo "checked";} }?> >Hair Tratment
              </label>
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox3" name="data[health][]" class="h_w_list" value = "Body_Treatment" <?php if(@$health){ if(in_array("Body_Treatment", $health)){ echo "checked";}} ?>>Body Treatment
              </label>                           
            </div>          
          </div>

          <!-- Text input-->  
    <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
               <label class="checkbox-inline">
                <input type="checkbox" id="checkbox4" name="data[health][]" class="h_w_list" value = "Spa_Massage" <?php if(@$health){ if(in_array("Spa_Massage", $health)){ echo "checked";}} ?>>Spa Massage
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox5"  name="data[health][]" class="h_w_list" value = "Yoga" <?php if(@$health){ if(in_array("Yoga", $health)){ echo "checked";}} ?> > Yoga
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox6" name="data[health][]" class="h_w_list" value = "Body_Building" <?php if(@$health){ if(in_array("Body_Building", $health)){ echo "checked";} } ?> >Body Building
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox7"  name="data[health][]" class="h_w_list" value = "Belly_Dancing" <?php  if(@$health){ if(in_array("Belly_Dancing", $health)){ echo "checked";}} ?> >Belly Dancing
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="checkbox8" name="data[health][]" class="h_w_list" value = "Others" <?php if(@$health){ if(in_array("Others", $health)){ echo "checked";} } ?> >Others 
                <input type="text" name="data[health][]" id="health_other" value="<?php if(@$health){ if(in_array("Others", @$health)){ echo @$health[$health_len];} } ?>">
              </label>                                                    
            </div>
          </div> 
        

        <div class="clearfix"></div>
       
        <div class="form-group">           
            <label class="col-sm-3 control-label" for="textinput">BUSINESS TRAVEL FREQUENCY:</label>
             <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio"  name="data[business_travel]" value = "Weekly" <?php if(@$client['business_travel']=='Weekly'){ echo 'checked';} ?>>Weekly
              </label>
              <label class="radio-inline">
                <input type="radio"  name="data[business_travel]" value = "Monthly" <?php if(@$client['business_travel']=='Monthly'){ echo 'checked';} ?> >Monthly
              </label>
               <label class="radio-inline">
                <input type="radio"  name="data[business_travel]" value = "Every_3_months"<?php if(@$client['business_travel']=='Every_3_months'){ echo 'checked';} ?>>Every 3 Months
              </label>
               <label class="radio-inline">
                <input type="radio"  name="data[business_travel]" value = "Semi_Annual" <?php if(@$client['business_travel']=='Semi_Annual'){ echo 'checked';} ?>>Semi-Annual
              </label>
               <label class="radio-inline">
                <input type="radio"  name="data[business_travel]" value = "Occasional" <?php if(@$client['business_travel']=='Occasional'){ echo 'checked';} ?>>Occasional
              </label>                            
            </div>          
          </div>
          <div class="clearfix"></div>
       
        <div class="form-group">
           
            <label class="col-sm-3 control-label" for="textinput">LEISURE TRAVEL FREQUENCY:</label>
             <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio"   name="data[leisure_travel]" value = "Weekly" <?php if(@$client['leisure_travel']=='Weekly'){ echo 'checked';}?>>Weekly
              </label>
              <label class="radio-inline">
                <input type="radio"  name="data[leisure_travel]" value = "Monthly" <?php if(@$client['leisure_travel']=='Monthly'){ echo 'checked';}?> >Monthly
              </label>
               <label class="radio-inline">
                <input type="radio"  name="data[leisure_travel]" value = "Every_3_months"<?php if(@$client['leisure_travel']=='Every_3_months'){ echo 'checked';}?>>Every 3 Months
              </label>
               <label class="radio-inline">
                <input type="radio" name="data[leisure_travel]" value = "Semi_Annual" <?php if(@$client['leisure_travel']=='Semi_Annual'){ echo 'checked';}?>>Semi-Annual
              </label>
               <label class="radio-inline">
                <input type="radio" name="data[leisure_travel]" value = "Occasional" <?php if(@$client['leisure_travel']=='Occasional'){ echo 'checked';}?>>Occasional
              </label>                            
            </div>        
          </div>    

         <div class="form-group">

            <label class="col-sm-3 control-label" for="textinput">MOST VISITED CITIES:</label>
             <div class="col-sm-9 ">
              <label >
                <!-- <input type="radio"  name="data[mostvisited_cities]" value = "Business"<?php //if(@$client['mostvisited_cities']=='Business'){ echo 'checked';}?>> -->
                BUSINESS
              </label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline">

                <?php 
                  $mostvisit =unserialize(@$client['mostvisited_cities']);
                  $cityvisit =unserialize(@$client['cities_details']);
                ?>
                <!-- <input type="radio" name="data[mostvisited_cities]" value = "Leisure" <?php //if(@$client['mostvisited_cities']=='LEISURE'){ echo 'checked';}?>> -->
                LEISURE
              </label>                                   
            </div>          
          </div> 
          <?php $cities = explode(',',@$client['cities_details']);?>
          <div class="form-group">          
            <label class="col-sm-3 control-label" for="textinput"></label>
             <div class="col-sm-9 mvc">
              <label class="">1.
               <!--  <input  type="text"  name="data[mostvisited_cities][]" value = "<?php //echo @$mostvisit[0]?>" > --> 
               <select style="margin-bottom:10px;" class="form-control mvc-select" name="data[mostvisited_cities][]">
                     <option>Select City</option>
                <?php 
                    $res = $this->db->get_where('city')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->city_name?>" <?php if($row->city_name == @$mostvisit[0]){ echo 'selected';}?>><?=$row->city_name?></option>   
                    <?php  }
                    }
                ?>
            </select>               
              </label>

              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
               <label class="">1.
                <!-- <input type="text"  name="data[cities_details][]" value="<?php //echo @$cityvisit[0]?>" > -->
                <select style="margin-bottom:10px;" class="form-control mvc-select" name="data[cities_details][]">
                     <option>Select City</option>
                <?php 
                    $res = $this->db->get_where('city')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->city_name?>" <?php if($row->city_name == @$cityvisit[0]){ echo 'selected';}?>><?=$row->city_name?></option>   
                    <?php  }
                    }
                ?>
            </select>
              </label>                                  
            </div>          
          </div>

          <div class="form-group">          
            <label class="col-sm-3 control-label" for="textinput"></label>
             <div class="col-sm-9">
              <label class="">2.
                <!-- <input type="text"  name="data[mostvisited_cities][]" value="<?php //echo @$mostvisit[1]?>" > -->
                 <select style="margin-bottom:10px;" class="form-control mvc-select" name="data[mostvisited_cities][]">
                     <option>Select City</option>
                <?php 
                    $res = $this->db->get_where('city')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->city_name?>" <?php if($row->city_name == @$mostvisit[1]){ echo 'selected';}?>><?=$row->city_name?></option>   
                    <?php  }
                    }
                ?>
            </select> 
              </label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
               <label class="">2.
                <!-- <input type="text"  name="data[cities_details][]" value="<?php //echo @$cityvisit[1]?>" > -->
                 <select class="form-control mvc-select" name="data[cities_details][]">
                     <option>Select City</option>
                <?php 
                    $res = $this->db->get_where('city')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->city_name?>" <?php if($row->city_name == @$cityvisit[1]){ echo 'selected';}?>><?=$row->city_name?></option>   
                    <?php  }
                    }
                ?>
            </select>
              </label>                                  
            </div>          
          </div>

            <div class="form-group">          
            <label class="col-sm-3 control-label" for="textinput"></label>
             <div class="col-sm-9">
              <label class="">3.
                <!-- <input type="text"  name="data[mostvisited_cities][]" value="<?php //echo @$mostvisit[2]?>" > -->
                  <select style="margin-bottom:10px;" class="form-control mvc-select" name="data[mostvisited_cities][]">
                     <option>Select City</option>
                <?php 
                    $res = $this->db->get_where('city')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->city_name?>" <?php if($row->city_name == @$mostvisit[2]){ echo 'selected';}?>><?=$row->city_name?></option>   
                    <?php  }
                    }
                ?>
            </select>
              </label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
              <label class="radio-inline"></label>
               <label class="">3.
                <!-- <input type="text"  name="data[cities_details][]" value="<?php //echo @$cityvisit[2]?>" > -->
                 <select style="margin-bottom:10px;" class="form-control mvc-select" name="data[cities_details][]">
                     <option>Select City</option>
                <?php 
                    $res = $this->db->get_where('city')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->city_name?>" <?php if($row->city_name == @$cityvisit[2]){ echo 'selected';}?>><?=$row->city_name?></option>   
                    <?php  }
                    }
                ?>
            </select>
              </label>                                  
            </div>          
          </div>
        <div class="row">
            <div class="col-md-12">
        
        <?php
                $prefered_booking = [];
                if(@$client['prefered_booking'])
                {
                    @$prefered_booking = unserialize(@$client['prefered_booking']);
                    //print_r($prefered_booking);
                    @$prefered_len = sizeof($prefered_booking)-1;
                }
           ?>
        
        <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">PREFERRED BOOKING ASSISTANCE:</label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox" name="data[prefered_booking][]" class="book_list" value = "Hotel" <?php if(@$prefered_booking){ if(in_array("Hotel", $prefered_booking)){ echo "checked";}} ?> >Hotel
              </label>                                      
            </div>
          </div> 
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox" name="data[prefered_booking][]" class="book_list" value = "Restaurents" <?php if(@$prefered_booking){ if(in_array("Restaurents", $prefered_booking)){ echo "checked";}} ?> >Restaurents
              </label>                                        
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox" name="data[prefered_booking][]" class="book_list" value = "Tickets" <?php if(@$prefered_booking){ if(in_array("Tickets", $prefered_booking)){ echo "checked";}} ?> >Tickets 
              </label>                                        
            </div>
          </div>

           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="checkbox" name="data[prefered_booking][]" class="book_list" value = "Private_Clubs" <?php if(@$prefered_booking){ if(in_array("Private_Clubs", $prefered_booking)){ echo "checked";}} ?> >Private Clubs 
              </label>                                        
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="checkbox-inline">
                 <!-- <input type="checkbox" name="data[prefered_booking][]" class="book_list1" id = "book_list1" value = "Others" <?php if(@$prefered_booking){ if(in_array("Others", $prefered_booking)){ echo "checked";}} ?> >Others  -->

                  <input type="checkbox"  class="book_list" name="data[prefered_booking][]" value = "Others" <?php if(@$prefered_booking){ if(in_array("Others", @$prefered_booking)){ echo "checked";} }?> >Others
                <input type="text" name="data[prefered_booking][]" id="book_other" value="<?php if(@$prefered_booking){ if(in_array("Others", @$prefered_booking)){ echo @$prefered_booking[$prefered_len]; } } ?>">

              </label>                                        
            </div>
          </div>         

          </div>
        </div>
        
          </div>
        </div>
            
        <div class="panel panel-primary">
          <div class="panel-heading" style="color: #fff;background-color: #337ab7;border-color:#337ab7  -webkit-print-color-adjust: exact; ;">AIRLINE PREFERENCES </div>
          <div class="panel-body" style="padding: 15px;">
              
         <div class="row">
            <div class="col-md-12">
        <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">1st CHOICE AIRLINE:</label>
            <div class="col-sm-9">
             <!-- <input class="form-control" type="text" name="data[1st_airline]" value="<?php //echo @$client['1st_airline']?>" placeholder="Please Enter">-->
               <select style="margin-bottom:10px;" class="form-control" name="data[1st_airline]">
                    <option value="">Select Name</option>
                <?php 
                    $res = $this->db->get_where('airline_choice')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->airlines_name?>" <?php if($row->airlines_name == @$client['1st_airline']){ echo 'selected';}?>><?=$row->airlines_name?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Frequent Flyer Number:</label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[1st_flyer_no]" value="<?php echo @$client['1st_flyer_no']?>" placeholder="Please Enter">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">2nd CHOICE AIRLINE:</label>
            <div class="col-sm-9">
             <!-- <input class="form-control" type="text" name="data[2nd_airline]" value="<?php //echo @$client['2nd_airline']?>" placeholder="Please Enter">-->
              <select style="margin-bottom:10px;" class="form-control" name="data[2nd_airline]">
                    <option value="">Select Name</option>
                <?php 
                    $res = $this->db->get_where('airline_choice')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->airlines_name?>" <?php if($row->airlines_name == @$client['2nd_airline']){ echo 'selected';}?>><?=$row->airlines_name?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Frequent Flyer Number:</label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[2nd_flyer_no]" value="<?php echo @$client['2nd_flyer_no']?>" placeholder="Please Enter">
              
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">3rd CHOICE AIRLINE:</label>
            <div class="col-sm-9">
              <!--<input class="form-control" type="text" name="data[3rd_airline]" value="<?php //echo @$client['3rd_airline']?>" placeholder="Please Enter">-->
               <select style="margin-bottom:10px;" class="form-control" name="data[3rd_airline]">
                    <option value="">Select Name</option>
                <?php 
                    $res = $this->db->get_where('airline_choice')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->airlines_name?>" <?php if($row->airlines_name == @$client['3rd_airline']){ echo 'selected';}?>><?=$row->airlines_name?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Frequent Flyer Number:</label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[3rd_flyer_no]" value="<?php echo @$client['3rd_flyer_no']?>" placeholder="Please Enter">
            </div>
          </div>

          </div>
        </div>
        
        <!-- 
         <div class="row">
            <div class="col-md-12">
        
        <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">LISTING OF AIRLINES:</label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" name="data[listing_airlines]" value = "Saudi_Arabia" <?php //if(@$client['listing_airlines']=='Saudi_Arabia'){ echo 'checked';}?> >Saudi Arabia
              </label>                                      
            </div>
          </div> 
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" name="data[listing_airlines]" value = "British_Airways" <?php //if(@$client['listing_airlines']=='British_Airways'){ echo 'checked';}?> >British Airways
              </label>                                        
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" name="data[listing_airlines]" value = "Qatar_Airways"<?php //if(@$client['listing_airlines']=='Qatar_Airways'){ echo 'checked';}?> >Qatar Airways 
              </label>                                        
            </div>
          </div>

           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" name="data[listing_airlines]" value = "Emirates"<?php //if(@$client['listing_airlines']=='Emirates'){ echo 'checked';}?> >Emirates 
              </label>                                        
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" name="data[listing_airlines]" 
                value = "Singapore_Airlines"<?php //if(@$client['listing_airlines']=='Singapore_Airlines'){ echo 'checked';}?> >Singapore Airlines 
              </label>                                        
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" name="data[listing_airlines]" value = "Qantas"<?php //if(@$client['listing_airlines']=='Qantas'){ echo 'checked';}?> >Qantas 
              </label>                                        
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" name="data[listing_airlines]" value = "US_Airways"<?php //if(@$client['listing_airlines']=='Us_Airways'){ echo 'checked';}?> >US Airways 
              </label>                                        
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" name="data[listing_airlines]" value = "Lufthansa"<?php //if(@$client['listing_airlines']=='Lufthansa'){ echo 'checked';}?> >Lufthansa 
              </label>                                        
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" name="data[listing_airlines]" value = "KLM"<?php //if(@$client['listing_airlines']=='KLM'){ echo 'checked';}?> >KLM 
              </label>                                        
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" name="data[listing_airlines]" value = "Etihad" <?php //if(@$client['listing_airlines']=='Etihad'){ echo 'checked';}?> >Etihad 
              </label>                                        
            </div>
          </div>

          </div>
        </div> -->
        
           </div>
            
        </div>
        
        <div class="panel panel-primary">
          <div class="panel-heading" style="color: #fff;background-color: #337ab7;border-color:#337ab7  -webkit-print-color-adjust: exact; ;">SERVICE CLASS PREFERENCES  </div>
          <div class="panel-body" style="padding: 15px;">
              
        
        
         <div class="row">
            <div class="col-md-12">
        
        <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Middle East FLIGHTS:</label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[east_flights]" value = "First_Class" <?php if(@$client['east_flights']=='First_Class'){ echo 'checked';}?> >First Class
              </label>                                      
            </div>
          </div> 
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[east_flights]" value = "Business_Class" <?php if(@$client['east_flights']=='Business_Class'){ echo 'checked';}?> >Business Class
              </label>                                        
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[east_flights]" value = "Economy" <?php if(@$client['east_flights']=='Economy'){ echo 'checked';}?> >Economy 
              </label>                                        
            </div>
          </div>

           

          </div>
        </div>
        
        
        <div class="row">
            <div class="col-md-12">
        
        <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">International FLIGHTS:</label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[international_flights]" value = "First_Class" <?php if(@$client['east_flights']=='First_Class'){ echo 'checked';}?> >First Class
              </label>                                      
            </div>
          </div> 
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[international_flights]" value = "Business_Class" <?php if(@$client['east_flights']=='Business_Class'){ echo 'checked';}?> >Business Class
              </label>                                        
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
               <input type="radio" id="radio1" name="data[international_flights]" value = "Economy" <?php if(@$client['east_flights']=='Economy'){ echo 'checked';}?> >Economy  
              </label>                                        
            </div>
          </div>

           

          </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
        
        <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">SEATING PREFERENCES:</label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[seating_preference]" class="seating_list" value = "No_Preference" <?php if(@$client['seating_preference']=='No_Preference'){ echo 'checked';}?> >No Preference
              </label>                                      
            </div>
          </div> 
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[seating_preference]" class="seating_list" value = "Alsle" <?php if(@$client['seating_preference']=='Alsle'){ echo 'checked';}?> >Alsle
              </label>                                        
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
               <input type="radio" id="radio1" name="data[seating_preference]" class="seating_list" value = "Window" <?php if(@$client['seating_preference']=='Window'){ echo 'checked';}?> >Window 
              </label>                                        
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[seating_preference]" class="seating_list" value = "Emergency" <?php if(@$client['seating_preference']=='Emergency'){ echo 'checked';}?> >Emergency Exit 
              </label>                                        
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <!-- <input type="radio" id="seating1" name="data[seating_preference]" class="seating_list" value = "Others" <?php if(@$client['seating_preference']=='Others'){ echo 'checked';}?> >Others -->
<?php //echo $client['seating_preference'];?>
                 <input type="radio" class="seating_list" name="data[seating_preference]" value = "Others" <?php if(@$client['seating_preference'] == 'Others'){  echo "checked";} ?> >
                 Others
                <input type="" name="data['seat_other']" id="seat_other" value="<?php echo @$client['seat_other'];  ?>">
              </label>                                        
            </div>
          </div>           
          

          </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
        
        <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">MEAL PREFERENCE:</label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[meal_preference]" class = "meal_other" value = "No_Preference" <?php if(@$client['meal_preference']=='No_Preference'){ echo 'checked';}?> >No Preference
              </label>                                      
            </div>
          </div> 
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[meal_preference]" class = "meal_other" value = "Vegetarian" <?php if(@$client['meal_preference']=='Vegetarian'){ echo 'checked';}?> >Vegetarian
              </label>                                        
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[meal_preference]" class = "meal_other" value = "Vegan" <?php if(@$client['meal_preference']=='Vegan'){ echo 'checked';}?>  >Vegan 
              </label>                                        
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[meal_preference]" class = "meal_other" value = "Low_Cholesterol" <?php if(@$client['meal_preference']=='Low_Cholesterol'){ echo 'checked';}?> >Low Cholesterol 
              </label>                                        
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
              <!--   <input type="radio" id="checkbox15" class="meal_other" name="data[meal_preference]" value = "Others" <?php if(@$client['meal_preference']){ if(in_array("Others", @$client['meal_preference'])){ echo "selected";} }?> >Others
                <input type="" name="data['meal_preference']" id="meal_other" value="<?php if(@$client['meal_preference']){ if(in_array("Others", @$client['meal_preference'])){ echo @$client['meal_preference'][$meal_len]; } } ?>"> -->

                <input type="radio" class="meal_other" name="data[meal_preference]" value = "Others" <?php if(@$client['meal_preference'] == 'Others'){  echo "checked";} ?> >
                 Others
                <input type="" name="data['meal_other']" id="meal_other" value="<?php echo @$client['meal_other'];  ?>">

              </label>                                        
            </div>
          </div> 
          </div>
        </div>
        
           </div>
            
        </div>
        
        <div class="panel panel-primary">
          <div class="panel-heading" style="color: #fff;background-color: #337ab7;border-color:#337ab7  -webkit-print-color-adjust: exact; ;">HOTEL PREFERENCES  </div>
          <div class="panel-body" style="padding: 15px;">
              
         <div class="row">
            <div class="col-md-12">
        <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">1st CHOICE HOTEL CHAIN:</label>
            <div class="col-sm-9">
             <!-- <input class="form-control" type="text" name="data[1st_hotel_chain]" value="<?php //echo @$client['1st_hotel_chain']?>" placeholder="Please Enter">-->
               <select style="margin-bottom:10px;" class="form-control" name="data[1st_hotel_chain]">
                    <option value="">Select Name</option>
                <?php 
                    $res = $this->db->get_where('hotel_chain')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->hotel_chain?>" <?php if($row->hotel_chain == @$client['1st_hotel_chain']){ echo 'selected';}?>><?=$row->hotel_chain?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Loyalty Card Number:</label>
            <div class="col-sm-9">
              <input style="margin-bottom:10px;" class="form-control" type="text" name="data[1stcard_num]" value="<?php echo @$client['1stcard_num']?>" placeholder="Please Enter">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">2nd CHOICE HOTEL CHAIN:</label>
            <div class="col-sm-9">
              <!--<input class="form-control" type="text" name="data[2nd_hotel_chain]" value="<?php //echo @$client['2nd_hotel_chain']?>" placeholder="Please Enter">-->
              <select style="margin-bottom:10px;" class="form-control" name="data[2nd_hotel_chain]">
                    <option value"">Select Name</option>
                <?php 
                    $res = $this->db->get_where('hotel_chain')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->hotel_chain?>" <?php if($row->hotel_chain == @$client['2nd_hotel_chain']){ echo 'selected';}?>><?=$row->hotel_chain?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">Loyalty Card Number:</label>
            <div class="col-sm-9">
               <input style="margin-bottom:10px;" class="form-control" type="text" name="data[2ndcard_num]" value="<?php echo @$client['2ndcard_num']?>" placeholder="Please Enter">
            </div>
          </div>

          </div>
        </div>
        
        
         <div class="row">
            <div class="col-md-12">
        
        <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput">SPECIAL ROOM REQUEST:</label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[special_room]" class = "special_list" value = "Smoking" <?php if(@$client['special_room']=='Smoking'){ echo 'checked';}?> >Smoking
              </label>                                      
            </div>
          </div> 
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <input type="radio" id="radio1" name="data[special_room]" class = "special_list" value = "Non_Smoking" <?php if(@$client['special_room']=='Non_Smoking'){ echo 'checked';}?> >Non Smoking
              </label>                                        
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput"></label>
            <div class="col-sm-9">           
              <label class="radio-inline">
                <input type="radio" class="special_list" name="data[special_room]" value = "Others" <?php if(@$client['special_room'] == 'Others'){  echo "checked";} ?> >
                 Others
                <input type="" name="data['special_other']" id="special_other" value="<?php echo @$client['special_other'];  ?>"> 

              </label>                                     
            </div>
          </div>

          </div>
        </div>
        
           </div>
            
        </div>
        
        <div class="panel panel-primary">
          <div class="panel-heading" style="color: #fff;background-color: #337ab7;border-color:#337ab7;  -webkit-print-color-adjust: exact; ">CAR PREFERENCES   </div>
          <div class="panel-body" style="padding: 15px;">
              <h6 class="text-right"><strong>Car Type: </strong> Mercedes S-Class </h6>
         <div class="row">
            <div class="col-md-12">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">1st CHOICE Car Hire Company:</label>
            <div class="col-sm-8">
              <!--<input class="form-control" type="text" name="data[1st_car_company]" value="<?php //echo @$client['1st_car_company']?>" placeholder="Please Enter">-->
               <select style="margin-bottom:10px;" class="form-control" name="data[1st_car_company]">
                    <option value="">Select Name</option>
                <?php 
                    $res = $this->db->get_where('car_choice')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->car_choice?>" <?php if($row->car_choice == @$client['1st_car_company']){ echo 'selected';}?>><?=$row->car_choice?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">Loyalty Card Number:</label>
            <div class="col-sm-8">
              <input  style="margin-bottom:10px;" class="form-control" type="text" name="data[1st_car_num]" value="<?php echo @$client['1st_car_num']?>" placeholder="Please Enter">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">2nd CHOICE  Car Hire Company:</label>
            <div class="col-sm-8">
             <!-- <input class="form-control" type="text" name="data[2nd_car_company]" value="<?php //echo @$client['2nd_car_company']?>" placeholder="Please Enter">-->
              <select style="margin-bottom:10px;" class="form-control" name="data[2nd_car_company]">
                    <option value="">Select Name</option>
                <?php 
                    $res = $this->db->get_where('car_choice')->result();
                    if($res){ 
                        foreach($res as $row)
                        { ?>
                         <option value ="<?=$row->car_choice?>" <?php if($row->car_choice == @$client['2nd_car_company']){ echo 'selected';}?>><?=$row->car_choice?></option>   
                    <?php  }
                    }
                ?>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">Loyalty Card Number:</label>
            <div class="col-sm-8">
             <input style="margin-bottom:10px;" class="form-control" type="text" name="data[2nd_car_num]" value="<?php echo @$client['2nd_car_num']?>" placeholder="Please Enter">
            </div>
          </div>

          </div>
        </div>
         <div class="row">
            <div class="col-md-12">
                
                <div class="form-group">
            <label class="col-sm-4 control-label" for="textinput">General Quotes:</label>
            <div class="col-sm-8">
              <!-- <textarea class="form-control" name="data[general_quote]" placeholder="Please Enter">
                <?php //echo @$client['general_quote']?> -->
                <textarea style="margin-bottom:10px;" class="form-control" type="text" name="data[general_quote]" placeholder="Enter Address" ><?php echo @$client['general_quote']?></textarea>
              </textarea>
            </div>
          </div>
                
                </div>
                
                </div>
           </div>
            
        </div>

           </div>
            
        </div>
        <!-- <div class="form-group text-center">
          <button class="btn btn-primary waves-effect waves-light reset-btn" type="reset" value="Reset">Reset</button>
           <button  class="add-save btn btn-primary waves-effect waves-light insert_client">Save</button>
          </div>-->

            <div class="clearfix"></div>
            <div class="col-md-6"></div>    
            <div class="col-md-6 cost_box"></div>

            <input type="hidden" name="data[user_id]" value="<?=@$client['user_id']?>">  
            <input type="hidden" name="data[pname]" value="add_client">  
            

              </div>
            </div>ed
          </div>  
      </form>

          </div>
        </div>
      </div>
    </div>

  </div>
        <!-- Container-fluid ends -->
     </div>

<script>
    function PrintMe(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

  