<link rel="stylesheet" href="http://ericjgagnon.github.io/wickedpicker/wickedpicker/wickedpicker.min.css">

<style>
    #insert_trip label.error {
        color:red; 
    }
    #insert_trip input.error,textarea.error,select.error {
        border:1px solid red;
        color:red; 
    }
    .popover {
    z-index: 2000;
    position:relative;
    }    
</style>
<script>
function myprint() {
    window.print();
}
</script>


<?php 
  if($this->uri->segment(3))
  {
     $value = $this->db->where('user_id',$this->uri->segment(3))->get('users')->row_array();
  }
?>

<?php //print_r($trip);exit; ?>


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
            <li class="breadcrumb-item"><a href="#:" >Generate Invoice</a></li>
          </ol>
          
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h5 class="card-header-text">Generate Invoice</h5><span>
              <button class="btn btn-success " data-name="<?php //echo @$current_page; ?>" style="margin-left:65%" onclick="myprint()">Print </button></span>
          </div>          
          <div class="card-block addform-block">
   
   <!--Start Generate invoice Design-->
   
   <div class="container">
  <div class="card">

<div class="card-body">
<div class="row mb-4">
<div class="col-sm-6">
<br/>
<div>
 <strong>Name  : Webz Poland</strong>
</div>
<div><strong>A/c : </strong></div>
<div><strong>City : 71-101 Szczecin, Poland</strong></div>
</div>

<div class="col-sm-6">
<br/>
<div>
<strong>Date : Bob Mart</strong>
</div>
<div><strong>Ref : Attn: Daniel Marek</strong></div>
<div><strong>Period : 43-190 Mikolow, Poland</strong></div>
</div>



</div>
<br/>
<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="center">Srno</th>
<th>Description</th>
<th>Units</th>
<th class="right">Nbr Nts/Days</th>
  <th class="center">Rate</th>
<th class="right">Total</th>
</tr>
</thead>
<tbody>
<tr>
<td class="center">1</td>
<td class="left strong">Origin License</td>
<td class="left">Extended License</td>

<td class="right">$999,00</td>
  <td class="center">1</td>
<td class="right">$999,00</td>
</tr>
<tr>
<td class="center">2</td>
<td class="left">Custom Services</td>
<td class="left">Instalation and Customization (cost per hour)</td>

<td class="right">$150,00</td>
  <td class="center">20</td>
<td class="right">$3.000,00</td>
</tr>
<tr>
<td class="center">3</td>
<td class="left">Hosting</td>
<td class="left">1 year subcription</td>

<td class="right">$499,00</td>
  <td class="center">1</td>
<td class="right">$499,00</td>
</tr>
<tr>
<td class="center">4</td>
<td class="left">Platinum Support</td>
<td class="left">1 year subcription 24/7</td>

<td class="right">$3.999,00</td>
  <td class="center">1</td>
<td class="right">$3.999,00</td>
</tr>
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>
<tr>
<td class="left">
<strong>Subtotal</strong>
</td>
<td class="right">$8.497,00</td>
</tr>
<tr>
<td class="left">
<strong>Discount (20%)</strong>
</td>
<td class="right">$1,699,40</td>
</tr>
<tr>
<td class="left">
 <strong>VAT (10%)</strong>
</td>
<td class="right">$679,76</td>
</tr>
<tr>
<td class="left">
<strong>Total</strong>
</td>
<td class="right">
<strong>$7.477,36</strong>
</td>
</tr>
</tbody>
</table>

<table>
        <tr>
            <td class="left">
                <strong>Total</strong>
            </td>
            <td class="right">
                <strong>$7.477,36</strong>
            </td>
        </tr>
        
        <tr>
            <td class="left">
                <strong>Total</strong>
            </td>
            <td class="right">
                <strong>$7.477,36</strong>
            </td>
        </tr>
        
        <tr>
            <td class="left">
                <strong>Total</strong>
            </td>
            <td class="right">
                <strong>$7.477,36</strong>
            </td>
        </tr>
</table>

</div>

</div>

</div>
</div>
</div>
   
   
   <!--End-->
   
   
   
          </div>
        </div>
      </div>
    </div>

  </div>
        <!-- Container-fluid ends -->
 </div>
