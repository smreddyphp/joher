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

<script type="text/javascript">
    $(document).ready(function()
    {   
        
       
       
            setInterval(function(){ 
                
                receiver_id = $('#receiver_id').val();
                if(receiver_id){
                    $.ajax({ url:'<?php echo base_url();?>admin/category_id',
                	type:'POST',
                	data: {receiver_id:receiver_id},
                	success: function(data)
                	{
                	    //alert(data);
                        $("#category_id").val(data);
                	    //location.reload();
                	}
                      });
                }      
                      
            }, 1000);  
        
            
        
    });        
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
                                   <span class = "client_list">
                                       
                                    <?php                 
                                       
                                       /* $query = "SELECT * FROM `chat_count` where agent_id = ".$this->session->userdata('user_id')." ";
                                        $list = $this->db->query($query)->result_array();*/
                                        //print_r($list);
                                    ?>
                                       <!-- <ul class="sidebar-menu " style="overflow: inherit;" >
                                            <?php  
                                                
                                                if($list){ $count=1; foreach($list as $row)
                                                {
                                                   /* $auth_level = $this->db->where('user_id',$row['sender_id'])->get('users')->row()->auth_level;
                                                    if($auth_level != 6 && $auth_level != 9 && $count < 5){*/
                                            ?>
                                                <li class="">
                                                    <a class="" onclick="myFunctionone('<?=$row['client_id']?>','<?=$this->session->userdata('user_id') ?>','<?=$row['category_id']?>')" >
                                                        <img src="<?php echo @base_url().$this->db->where('user_id',$row['client_id'])->get('users')->row()->image;?>" alt="User Avatar" class="img-circle" style = "width: 30px;height: 30px">
                                                        <span> <?php echo @$this->db->where('user_id',$row['client_id'])->get('users')->row()->user_name;?></span>
                                                        
                                                    </a>
                                                    
                                                </li>
                                                
                                                
                                            <?php  $count++; } }  ?>
                                        </ul>-->
                                        
                                   </span>
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
		        <form id="insert_adds1"  role="form">
		            
                  <div class="panel-footer" style="width:448px;">
                      
                    <input type = "hidden" name = "data[receiver_id]" id = "receiver_id" >
                    <input type = "hidden" name = "data[category_id]" id = "category_id" >
                    <input type = "hidden" name = "data[sender_id]" id = "sender_id" value = "<?=$sender_id?>">
                      
                    <div class="input-group" style = "margin-bottom: 5px;">
                        <div class="col-lg-2">
                            <strong>Upload</strong>
                        </div>
                        <div class="col-lg-7">
                            <span class="input-group-btn">
                                <input class="btn btn-info btn-sm" id = "file" type = "file" name = "chatFile">
                            </span>
                        </div>
                        <div class="col-lg-3">
                            <span class="input-group-btn media_show">
                               
                            </span>        
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <input id="msg_val" type="text"  name = "data[message]" class="form-control input-sm" placeholder="Type your message here... "style="width: 352px;" />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm insert_adds1"  style="margin-right: 295px;" id="btn-chat"  onclick = "return submitdata()">Send</button>
                        </span>
                    </div>
                    
                    </form>
                    
                    <div class="input-group" style = "margin-top: 5px;">
                        <div class="col-lg-2">
                            <span class="input-group-btn">
                                <button class="btn btn-success btn-sm fa fa-plus add_adds" data-name="<?php echo @$current_page; ?>" style="float: right;">Add Invoice</button></span>
                           </span>
                        </div>
                        <div class="col-lg-7">
                        </div>
                        <div class="col-lg-3">
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm"  style="margin-right: 295px;"  id="btn-chat-end" onclick="return myFunction()">End</button>
                            </span>        
                        </div>
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
    <div class = "modal fade" data-backdrop="static" data-keyboard="false" id = "add_adds1" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true"></div>
    </section>
<script>
    var $modal = $('#add_adds1');
        $('.add_adds').on('click',function(event)
        { 
            var id = $('#receiver_id').val();
            if(id)
            {
                var pname = $(this).data('name');
                //alert(id);
                console.log(id);
                console.log(pname);
                event.stopPropagation();
                $modal.load('<?php echo site_url('admin/agent_add_adds1');?>', {id: id,pname:pname},
                function(){
                /*$('.modal').replaceWith('');*/
                $modal.modal('show');
                });
            }
            else
            {
                alert('Please Select Any One Client');
            }
        });
</script>    
    <script>
        function myFunction()
        {
            var id = '<?=$this->session->userdata('user_id')?>';
            var receiver_id = $('#receiver_id').val();
            if(receiver_id){
                //return false;
                $("#chatmsg").html('');
            
                $.ajax({ 
                    url:'<?php echo base_url();?>/admin/end_chat',
            	    type:'POST',
            	    data: {id:id,receiver_id:receiver_id},
            	    success: function(data)
            	    {
                    	//alert(data);
                    	alert('Client Conversession End Successfully');
                    	console.log(data);
                	    location.reload();
            	    }
                  });
              
            }
            else
            {
                alert('Please Select Client');
            }
        }
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


$('.insert_adds1').click(function(){ 
        
        var receiver_id = $('#receiver_id').val(); 
        if(receiver_id)
        {
            if($('#msg_val').val() == '' && $('#file').val() == '')
            {
                alert('Please Insert Field ');
                return false; 
            }
            else if($('#msg_val').val() && $('#file').val())
            {
                alert('Please Insert only One input');
                return false; 
            }
            else
            {
                var data = new FormData($('#insert_adds1')[0]);
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
                        success: function(data)
    					{
                        	//alert(data);
                        	console.log(data);
                        	document.getElementById("msg_val").value='';
                        	document.getElementById("file").value='';
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
                        	
                    	    return false;
                	   }
                      
                    });
            }
            
        }
        else
        {
            alert('Please Select Client');
        }
        
       return false;
    });

    
</script>



<script>
function myFunctionone(receiver_id,sender_id,category_id) 
{
    $('#receiver_id').val(receiver_id);
    $('#category_id').val(category_id);
    
    $('.media_show').html('<a class="btn btn-success btn-sm" style="background-color: #67626df0;" target = "_blank" href = "<?php echo base_url();?>admin/media/'+receiver_id+'">Media</a>');
    
    $.ajax({
        url:'<?php echo base_url();?>admin/agent_chat_view1',
        type:'POST',
        data: {sid:sender_id,rid:receiver_id},
        success: function(data)
        {
            //alert('hi');
            if(data != '')
            {
                $("#chatmsg").html(data);
            }
            else
            {
                $("#chatmsg").html('No Record Found');
            }
        }
    });
    
}
</script>

<script type="text/javascript">

/*function get_chat_details(receiver_id,sender_id)
{
    
    $('#receiver_id').val(receiver_id);
    alert(sender_id +''+ receiver_id);
    $.ajax({ url:'<?php echo base_url();?>admin/agent_chat_view',
	    type:'POST',
	    data: {sid:sender_id,rid:receiver_id,chat_start_end='1'},
	    success: function(data)
	    {
	        console.log(data);
            $("#chatmsg").html(data);
	        //location.reload();
	    }
    });

}*/
</script>
 