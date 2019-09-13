
<style>
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
            <li class="breadcrumb-item"><a href="#:" >Need Immediate actions</a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level"><h5 class="card-header-text"> level 3</h5><span>
            <!--  <a  href="<?php echo base_url();?>admin/add_demo2" class="btn btn-success fa fa-plus" data-name="<?php echo @$current_page; ?>" style="float:right;">Add </a>--></span>
          </div>
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
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
<th>client Name</th>

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
<th>client Name</th>
              </tr>
              </tfoot>
          
              <tbody>
            <td>1</td>
            <td>processing</td>
            <td>aman</td>
               <td>Hotel</td>
                  <td>Need urgent action</td>
                     <td>3</td>
                        <td>02.05.2017</td>
                        <td>01.06.2017</td>
                        <td>Abdul malik</td>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-2"><h5 class="card-header-text"> level 2</h5>
             <!-- <span><a  href="<?php echo base_url();?>admin/add_demo2" class="btn btn-success fa fa-plus" data-name="<?php echo @$current_page; ?>" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
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
<th>client Name</th>

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
<th>client Name</th>
              </tr>
              </tfoot>
          
              <tbody>
            <td>1</td>
            <td>processing</td>
            <td>aman</td>
               <td>Hotel</td>
                  <td>Need urgent action</td>
                     <td>3</td>
                        <td>02.05.2017</td>
                        <td>01.06.2017</td>
                        <td>Abdul malik</td>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header level-3"><h5 class="card-header-text"> level 1</h5>
             <!-- <span><a  href="<?php echo base_url();?>admin/add_demo2" class="btn btn-success fa fa-plus" data-name="<?php echo @$current_page; ?>" style="float:right;">Add </a></span>-->
          </div>
          <div class="card-block">
            <table id="advanced-table" class="table dt-responsive table-striped table-bordered nowrap">
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
<th>client Name</th>

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
<th>client Name</th>
              </tr>
              </tfoot>
          
              <tbody>
            <td>1</td>
            <td>processing</td>
            <td>aman</td>
               <td>Hotel</td>
                  <td>Need urgent action</td>
                     <td>3</td>
                        <td>02.05.2017</td>
                        <td>01.06.2017</td>
                        <td>Abdul malik</td>

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
   
        /*var $modal = $('#add_adds');
        $('.add_adds').on('click',function(event){ 
          
            var id = $(this).data('id');
            var pname = $(this).data('name');
            console.log(id);
            console.log(pname);
            event.stopPropagation();
            $modal.load('<?php //echo site_url('admin/add_Category');?>', {id: id,pname:pname},
            function(){
            /*$('.modal').replaceWith('');*/
            //$modal.modal('show');

            //});
        //});*/
        
         //delete 
        $('.delete_hotel').on('click',function(event){ 
            var id = $(this).data('id');
            alert(id);
              /*$.ajax({                
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
                        }
                        
                    }
              });*/
        });               
    </script>
    

 