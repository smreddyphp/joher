  <script type="text/javascript">

 $('#msg_val').keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    //alert('You pressed a "enter" key in textbox'); 
                myFunction();                
}             
                event.stopPropagation();
            });

function myFunction(id)
{
//alert('oye');
var sender_id   = '<?php echo $sender_id; ?>';
var receiver_id = id; 
//var msg = document.getElementById("msg_val").value;

    //alert(msg);
   /* alert(sender_id);
    alert(receiver_id);*/
    $('.media_show').html('<a class="btn btn-success btn-sm" style="background-color: #67626df0;" target = "_blank" href = "<?php echo base_url();?>admin/media/'+id+'">Media</a>');
    
    $.ajax({ url:'<?php echo base_url();?>/admin/list_chat_message',
	type:'POST',
	data: {sid:sender_id,rid:receiver_id},
	success: function(data)
	{
    	//alert(data);
    	console.log(data);
        if(data)
        {
           //document.getElementById("msg_val").value='';
           $('#msg_val').val('');
           
    		$("#chatmsg").html(data);
    
             var objDiv = $(".panel-body");
        	 var h = objDiv.get(0).scrollHeight;
        	 objDiv.animate({scrollTop: h});
    
        }      
    	//location.reload();
	}
      });

}

</script>

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
             <!-- <a  href="<?php echo base_url();?>admin/add_hotel" class="btn btn-success fa fa-plus" data-name="<?php echo @$current_page; ?>" style="margin-left:65%"></a></span>-->
          </div>
          <div class="card-block">

        <!-- Container-fluid starts -->
        <div class="container-fluid">
                   <!-- <div class="row">
                        <div class="col-sm-12 p-0">
                            <div class="main-header">
                                <h4>Messages</h4>
                            </div>
                        </div>
                    </div>-->


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card col-lg-12">
                                <div class="card-header">
                                    <h5 class="card-header-text">Client List</h5>
                                </div>
                                <div class="table">
                                   <?php 
                                        $query = "select receiver_id from chats where sender_id=".$this->session->userdata('user_id')." group by receiver_id";
                                        $list = $this->db->query($query)->result_array();
                                        //print_r($list);
                                    ?>
                                    
                                    <ul class="sidebar-menu" style="overflow: inherit;">
                                        <?php if($list){ foreach($list as $row){ 
                                            //print_r($list);
                                         ?>
                                            <li class="">
                                                <a class="" onclick="myFunction('<?=$row['receiver_id']?>')" >
                                                    <?php 
                                                        $res = $this->db->where('user_id',$row['receiver_id'])->get('users')->row(); //->image;
                                                    ?>
                                                    <img src="<?php  if($res){echo base_url().$res->image; }else{ echo base_url().'assets/uploads/user_profiles/default1.png'; }?>" alt="User Avatar" class="img-circle" style = "width: 30px;height: 30px">
                                                    <span> <?php   if($res){echo $res->user_name; }else{ echo ''; }?></span></a>
                                                
                                            </li>
                                            
                                        <?php } } ?>
                                    </ul> 
                                </div>
                            </div>    
                    
     
                        </div>
                        <div class="col-xl-6">
                            <div class="card col-lg-12">
                                <div class="card-header">
                                    <h5 class="card-header-text">Conversion</h5>
                                </div>
     <div class="table">
                                    <div class="table-content">
                                        <div class="project-table p-20">
                                            <table id="product-list-dasbord" class="table dt-responsive nowrap" width="100%" cellspacing="0">
                                                <tbody>
                <div class="panel-body">                 
		<ul class="chat" id="chatmsg">			
												
			
									
		</ul>
		</div>	
		        <!--<form id="insert_adds"  role="form">
		            
                  <div class="panel-footer" style="width:448px;">
                      
                    <input type = "hidden" name = "data[receiver_id]" id = "receiver_id" >
                    <input type = "hidden" name = "data[sender_id]" id = "sender_id" value = "<?=$sender_id?>">
                      
                    <div class="input-group" style = "margin-bottom: 5px;">
                     
                        <div class="col-lg-3">
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm"  style="margin-right: 295px;" id="btn-chat-end" onclick="myFunction()">End</button>
                            </span>        
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <input id="msg_val" type="text"  name = "data['message']" class="form-control input-sm" placeholder="Type your message here... "style="width: 352px;" />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm insert_adds"  style="margin-right: 295px;" id="btn-chat"  >Send</button>
                        </span>
                    </div>
		        </div>
		        
		        </form>-->
		        
		            <div class="input-group" style = "margin-bottom: 5px;">
                        <div class="col-lg-2">
                        </div>
                        <div class="col-lg-7">
                        </div>
                        <div class="col-lg-3">
                            <span class="input-group-btn media_show"></span>        
                        </div>
                    </div>
		        
					
		</tbody>
                </table>
                </div>
                  </div>

                                </div>
                            </div>
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
        var $modal = $('#add_adds');
        $('.add_adds').on('click',function(event){ 
          
            var id = $(this).data('id');
            var pname = $(this).data('name');
            console.log(id);
            console.log(pname);
            event.stopPropagation();
            $modal.load('<?php echo site_url('admin/add_Category');?>', {id: id,pname:pname},
            function(){
            /*$('.modal').replaceWith('');*/
            $modal.modal('show');

            });
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
    
    
    <script type="text/javascript">

 $('#msg_val').keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    //alert('You pressed a "enter" key in textbox'); 
                submitdata();                
}             
                event.stopPropagation();
            });

function submitdata()
{
    alert('oye');
    
    /*var sender_id   = '<?php echo $sender_id; ?>';
    var receiver_id = $('#receiver_id').val(); 
    var transaction_number = '<?php echo $transaction_number;?>';
    var msg = document.getElementById("msg_val").value;*/
    
    /*if(msg =='')
    {
        document.getElementById("msg_val").focus();
        //alert(msg);
    }
    else
    { */

    //alert(msg);
    //alert(sender_id);
    //alert(receiver_id);

   /* $.ajax({ url:'<?php echo base_url();?>/admin/chat_message',
	type:'POST',
	data: {sid:sender_id,rid:receiver_id, message:msg,transaction_number:transaction_number},
	success: function(data)
	{
    	//alert(data);
    	console.log(data);
    	document.getElementById("msg_val").value='';
        if(data)
        {
           //document.getElementById("msg_val").value='';
           $('#msg_val').val('');
           
    		$("#chatmsg").html(data);
    
             var objDiv = $(".panel-body");
        	 var h = objDiv.get(0).scrollHeight;
        	 objDiv.animate({scrollTop: h});
    
        }      
    	//location.reload();
	}
      });*/
      
      
       var data = new FormData($('#insert_adds')[0]);
       alert(data);
        $.ajax({                
                    url: "<?php echo base_url();?>admin/chat_message",
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
                        /*var obj = jQuery.parseJSON(result);
                        if (obj.status == "success") 
                        {
                    window.location = '<?php echo base_url('admin/hotel');?>';
                      //location.reload();
                  //return false;
                        } */
                    }
                  
                });
                
                return false;


//}

}

    $('.insert_adds').click(function(){ 
        alert('hi');
         var data = new FormData($('#insert_adds')[0]);
         $.ajax({                
                    url: "<?php echo base_url();?>admin/chat_message",
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
                        /*var obj = jQuery.parseJSON(result);
                        if (obj.status == "success") 
                        {
                    window.location = '<?php //echo base_url('admin/hotel');?>';
                      //location.reload();
                  //return false;
                        } */
                    }
                  
                });
        
       return false;
    });
    
</script>

<script type="text/javascript">

function get_chat_details(receiver_id,sender_id,chat_start_end)
{
    //alert(receiver_id);
    /*alert(sender_id);
    alert(chat_start_end);
    return false;*/
    
    $('#receiver_id').val(receiver_id);
    //alert(sender_id +''+ receiver_id);
    $.ajax({ url:'<?php echo base_url();?>admin/agent_chat_view',
	    type:'POST',
	    data: {sid:sender_id,rid:receiver_id,chat_start_end:chat_start_end},
	    success: function(data)
	    {
	        console.log(data);
            $("#chatmsg").html(data);
	        //location.reload();
	    }
    });

}
</script>
 