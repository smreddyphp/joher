<script type="text/javascript">

$(document).ready(function(){

 var objDiv = $(".panel-body");
 var h = objDiv.get(0).scrollHeight;
 objDiv.animate({scrollTop: h});

setInterval(function(){ 

var sender_id = '<?php echo $sender_id; ?>';
var receiver_id = $('#receiver_id').val();
var chat_start_end = 1;

console.log(sender_id +''+ receiver_id);
console.log(receiver_id);

$.ajax({ url:'<?php echo base_url();?>admin/agent_chat_view',
	type:'POST',
	data: {sid:sender_id,rid:receiver_id,chat_start_end:chat_start_end},
	success: function(data)
	{
	    //alert(data);
        $("#chatmsg").html(data);
	    //location.reload();
	}
      });
        var objDiv = $(".panel-body");
    	 var h = objDiv.get(0).scrollHeight;
    	 //objDiv.animate({scrollTop: h});

 }, 1000);
 

});
</script>

<script type="text/javascript">
    $(document).ready(function()
    {
        setInterval(function(){ 
                $.ajax({ url:'<?php echo base_url();?>admin/client_list',
            	type:'POST',
            	data: {sid:'hi'},
            	success: function(data)
            	{
            	    //alert(data);
                    $(".client_list").html(data);
            	    //location.reload();
            	}
                  });
        }, 1000);           
    });        
</script>

<script src="//cdn.ckeditor.com/4.9.0/standard/ckeditor.js"></script>

<style>
.chat-body {
    overflow-y: auto;
    height: auto;
}
 .pull-right {
    float: right !important;
}
.pull-left {
    float: left!important;
}
.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
 
    margin-bottom: 25px;
    margin-top: 15px;
}

.chat li.right .chat-body
{
   margin-left: 60px;
 
    margin-bottom: 25px;
    margin-top: 15px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    overflow-y: scroll;
    height: 400px;
	    padding: 15px;
    width: 100%;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}
.panel-body {
    padding: 15px;
}
.panel-footer .input-group .form-control {
    position: relative;
    z-index: 2;
    float: left;
    width: 100%;
    margin-bottom: 0;
    height: 60px;
}
.panel-footer {
padding: 10px 0px 10px 15px;
    background-color: #fafafa;
    border-top: 1px solid #eeeeee;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    width: 50%;
}
button#btn-chat {
    height: 60px;
    background: #6f106c;
    border: 1px solid #6f106c;
    font-size: 14px;
    letter-spacing: 0.5px;
    font-weight: 500;
}

span.chat-img img {
    width: 50px;
    height: 50px;
}
span.chat-img .on-active {
    position: relative;
    right: 15px;
    bottom: 15px;
		 color:green;
}


.chat li.left .chat-body ,
.chat li.right .chat-body{

}
 
 .on-active{
	 color:green;
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
            <li class="breadcrumb-item"><a href="#:" ><?php echo @$page_name; ?></a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Row end -->
    
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h5 class="card-header-text"> <?php echo @$page_name; ?></h5><span>
            <!--<a  href="<?php echo base_url();?>admin/add_hotel" class="btn btn-success fa fa-plus" data-name="<?php echo @$current_page; ?>" style="margin-left:65%"></a></span>-->
          </div>
          <div class="card-block">

        <!-- Container-fluid starts -->
        <div class="container-fluid">
                    <!--<div class="row">
                        <div class="col-sm-12 p-0">
                            <div class="main-header">
                                <h4>Messages</h4>
                            </div>
                        </div>
                    </div>-->


                    <div class="row">
                       
                        <div class="col-xl-12">
                            <!--<div class="input-group">
                                <input id="msg_val" type="text"  name = "data[message]" class="form-control input-sm" placeholder="Type your message here... "style="width: 352px;" />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm insert_adds"  style="margin-right: 295px;" id="btn-chat"  onclick = "return submitdata()">Send</button>
                                </span>
                            </div>-->
                        <form method = "POST">
                            <?php //print_r($adds);?>    
                            <div class="form-group row">
                                <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Privacy Policy (EN)</label>
                                <div class="col-sm-9">
                                    <!--<input class="form-control" type="text" name="data[category_name]" value="" placeholder="Terms & Condition">-->
                                    <textarea name="data[privacy_policy_en]" id="editor1" rows="10" cols="80"><?=$adds['privacy_policy_en']?></textarea>
                                    <span style = "color:red"></span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label">Privacy Policy (AR)</label>
                                <div class="col-sm-9">
                                   <!-- <input class="form-control" type="text" name="data[category_name]" value="" placeholder="Terms & Condition">-->
                                    <textarea name="data[privacy_policy_ar]" id="editor2" rows="10" cols="80"><?=$adds['privacy_policy_ar']?></textarea>
                                    <span style = "color:red"></span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="example-tel-input" class="col-xs-3 col-form-label form-control-label"></label>
                                <div class="col-sm-2">
                                    <input class="form-control btn-success" type="submit" value = "Save Changes" placeholder="Terms & Condition">
                                </div>
                            </div>
                            
                        </form>    
                       </div>
        <!-- Contact card start -->
                </div>
        <!-- Container-fluid ends -->
     </div>

           
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
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
</script> 