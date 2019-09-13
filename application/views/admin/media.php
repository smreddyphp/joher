<!-- CONTENT-WRAPPER-->
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="main-header">
                    <h4>Profile</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="javascript:" ><i class="icofont icofont-home"></i></a>
                        </li>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:" ><?=$page_name?></a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- Header end -->
            <div class="row">
                

                <!-- start col-lg-9 -->
                <div class="col-xl-12 col-lg-12">
                    <!-- Nav tabs -->
                    <div class="tab-header">
                        <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist">
                            
                            <li class="nav-item active">
                                <a class="nav-link " data-toggle="tab" href="#personal" role="tab"><i>Image</i></a>
                                <div class="slide"></div>
                            </li>
                           
                            <li class="nav-item">
                                <a  class="nav-link" data-toggle="tab" href="#tab5" role="tab"><i>Audio</i></a>
                                <div class="slide"></div>
                            </li>
                            
                            <li class="nav-item">
                                <a  class="nav-link" data-toggle="tab" href="#tab6" role="tab"><i>video</i></a>
                                <div class="slide"></div>
                            </li>
                            
                            <li class="nav-item">
                                <a  class="nav-link" data-toggle="tab" href="#tab7" role="tab"><i>File</i></a>
                                <div class="slide"></div>
                            </li>
                           
                        </ul>
                    </div>
                    <!-- end of tab-header -->

                    <div class="tab-content">
                        
                        <div class="tab-pane active" id="personal" role="tabpanel">
                            <div class="card">
                                <div class="card-header"><h5 class="card-header-text">Image</h5>
                                    
                                </div>
                                <div class="card-block">
                                   
                                    <!-- end of view-info -->

    <div class="edit-info">
   
        
            <div class="general-info">
                <div class="row">
                    
                        <?php //print_r($adds);?>
                            <?php 
                                if($this->uri->segment(4))
                                {
                                    $user_id = $this->uri->segment(4);
                                }
                                else
                                {
                                    $user_id = $this->session->userdata('user_id');
                                }
                            
                                $data = "SELECT * FROM `chats` where sender_id IN(".$this->uri->segment(3).",".$user_id.") and receiver_id IN(".$this->uri->segment(3).",".$user_id.") and message != 0123456789 ORDER BY `id` ASC";
		                        $messages = $this->db->query($data)->result_array();
		                     /* echo "<pre>";  
                              print_r($messages);*/
                             
                             if($messages) {foreach($messages as $row){ 
                             if($row['message_type'] == 2 || $row['message_type'] == 5){
                            ?>
                           
                            <div class="col-sm-3" style="background-color: brown;">
                                <a href = "<?php echo base_url().$row['message'];?>" target = "_blank"><img id="myImg" class="img-responsive" src="<?php echo base_url().$row['message'];?>" alt="Snow" style="width: 100%;height:250px;margin-top: 15px;"></a><br/>
                             </div>
                            <?php } } } ?>
                   
            
            <!-- end of table col-lg-12 -->

            

                                                       
                                                    </div>
                                                    
                                                    <!--</div> -->
                                                </div>
                                                <!-- end of edit info -->
                                            
                                            <!-- end of col-lg-12 -->
                                       

                                    </div>
                                    <!-- end of view-info -->
                                </div>
                                <!-- end of card-block -->
                            </div>
                            <!-- end of card-->
                            
                            <!-- end of row of education and experience  -->
       </div>
                        
                        
                        <div class="tab-pane fade " id="tab5" role="tabpane">
                            <div class="card">
                            <div class="card-header"><h5 class="card-header-text">  Audio
                       
                            </h5>
                                    
                                </div>

                             <div class="card-block">
                                   
                                <?php  
                                    if($messages) {foreach($messages as $row){ 
                                    if($row['message_type'] == 4){
                                ?>
                                    <div class="col-sm-3">
                                        <audio style="width:200px" controls>
                                          <source src="<?php echo base_url().$row['message'];?>" type="audio/ogg">
                                          <source src="<?php echo base_url().$row['message'];?>" type="audio/mpeg">
                                          Your browser does not support the audio element.
                                        </audio>
                                        
                                     </div>
                                    <?php } } } ?>
                                </div>

                                </div>
                           
                          </div>
                          
                        <div class="tab-pane fade " id="tab6" role="tabpane">
                            <div class="card">
                            <div class="card-header"><h5 class="card-header-text">  Video
                       
                            </h5>
                                    
                                </div>

                             <div class="card-block">
                                   
                                    <?php  
                                        if($messages) {foreach($messages as $row){ 
                                        if($row['message_type'] == 4){
                                    ?>
                                        <div class="col-sm-4">
                                            <video width="320" height="240" controls>
                                              <source src="<?php echo base_url().$row['message'];?>" type="video/mp4">
                                              <source src="<?php echo base_url().$row['message'];?>" type="video/ogg">
                                              Your browser does not support the video tag.
                                            </video>
                                            
                                         </div>
                                    <?php } } } ?>
                                    
                                </div>

                                </div>
                           
                          </div>
                          
                        <div class="tab-pane fade " id="tab7" role="tabpane">
                            <div class="card">
                            <div class="card-header"><h5 class="card-header-text">  File
                       
                            </h5>
                                    
                                </div>

                             <div class="card-block">
                                   
                                     <?php  
                                        if($messages) {foreach($messages as $row)
                                        { 
                                            if($row['message_type'] == 6){
                                            ?>
                                                <div class="col-sm-4">
                                                    <a href = "<?php echo base_url().$row['message'];?>" target = "_blank"><?php echo base_url().$row['message'];?></a>    
                                                </div>
                                    <?php } } } ?>
                                </div>

                                </div>
                           
                          </div>

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


 <style type="text/css">
     .nav-tabs .slide {
   
    width: calc(100% / 4;
}
.md-tabs .nav-item {
   
    width: calc(100% / 4;
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
