<style>
.login-card {
	background-color: #e0dede;
}
</style>
<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
  <!-- Container-fluid starts -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="login-card card-block">
    <form class='std-form md-float-material' id="myform" onsubmit='return check_login()'>
          <div class="text-center"> <img src="<?php echo base_url();?>assets/images/logo-3.png"> </div>
          <h3 class="text-center txt-primary"> Sign In to your account </h3>
          <?php
				if( isset( $login_error_mesg ) )
				{
					echo "<div>
							<p style='color:red; text-align: center;'>	Oops! Invalid details	</p>
						</div>" ;
				}		
				if( $this->input->get('logout') )
				{
					echo "<div>
							<p style='color:green; text-align: center;'>	You have successfully logged out.</p>
						</div> ";
				}
		  ?>
          <div class="md-input-wrapper">
            <input type="email" name="login_string" id="login_string" class="md-form-control" autocomplete="off" maxlength="255" />
            <label>Email</label>
          </div>
          <span id="login_req_email" style="color:red;margin-top:5px;"> </span>
          <div class="md-input-wrapper">
            <input type="password" name="login_pass" id="login_pass" class="md-form-control password" <?php 
			if( config_item('max_chars_for_password') > 0 )
				echo 'maxlength="' . config_item('max_chars_for_password') . '"'; 
		?> autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" />
            <label>Password</label>
          </div>
          <span id="login_req_pass" style="color:red; margin-top:5px;"> </span>
          <div class="row">
            <div class="col-sm-6 col-xs-12">
              <div class="rkmd-checkbox checkbox-rotate checkbox-ripple m-b-25">
                <?php
					if( config_item('allow_remember_me') )
					{
				?>
                <br />
                <label for="remember_me"  class="input-checkbox checkbox-primary">Remember Me</label>
                <input type="checkbox" id="remember_me" name="remember_me" value="yes" />
                <?php   }   ?>
              </div>
            </div>
            <div class="col-sm-6 col-xs-12 forgot-phone text-right"> <a href="<?php echo base_url()?>reglog/recover" tppabs="http://ableproadmin.com/light/vertical/forgot-password.html" class="text-right f-w-600"> Forget Password?</a> </div>
          </div>
          <div class="row">
            <div class="col-xs-10 offset-xs-1">
              <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
            </div>
          </div>
          <!-- <div class="card-footer"> -->
          <div class="col-sm-12 col-xs-12 text-center"> <span class="text-muted">Don't have an account?</span> <a href="register2.html" tppabs="http://ableproadmin.com/light/vertical/register2.html" class="f-w-600 p-l-5">Sign up Now</a> </div>
          
          <!-- </div> -->
          </form>
          <!-- end of form -->
        
        </div>
        <!-- end of login-card --> 
      </div>
      <!-- end of col-sm-12 --> 
    </div>
    <!-- end of row --> 
  </div>
  <!-- end of container-fluid --> 
</section>

<!-- Required Jqurey -->
<script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/js/jquery-ui.min.js"></script>
<!-- tether.js -->
<script src="<?php echo base_url();?>assets/js/tether.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/js/tether.min.js"></script>
<!-- waves effects.js -->
<script src="<?php echo base_url();?>assets/plugins/waves/js/waves.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/plugins/waves/js/waves.min.js"></script>
<!-- Required Framework -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/js/bootstrap.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="<?php echo base_url();?>assets/pages/elements.js" tppabs="http://ableproadmin.com/light/vertical/assets/pages/elements.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/common-pages.js" tppabs="http://ableproadmin.com/light/vertical/assets/js/common-pages.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
function check_login()  
{ 
$ = jQuery;
err = 0;
if($('#login_string').val() == "")
{
	$('#login_req_email').html('Please enter Email Id');
	err=err+1;
}
else
{
	$('#login_req_email').html('');
}

if($('#login_pass').val() == "")
{
	$('#login_req_pass').html('Please enter Password');
	err=err+1;
}
else
{
	$('#login_req_pass').html('');
}

if(err!=0)
{ 
	return false;
}


}

</script>
</body>
</html>