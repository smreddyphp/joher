<!DOCTYPE html>
<html lang="en">
<head>
	<title>::ESSENCE::</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="description" content="joher">
	<meta name="keywords"
		  content=", Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
	<meta name="author" content="joher">

	<!-- Favicon icon -->
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/favicon.png" type="image/x-icon">
	<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico" tppabs="http://ableproadmin.com/light/vertical/assets/images/favicon.ico" type="image/x-icon">

	<!-- Google font
	<link href="fonts.googleapis.com/css-family=Open+Sans-300,400,600,700,800.css" tppabs="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">-->

	<!-- Font Awesome -->
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" tppabs="http://ableproadmin.com/light/vertical/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!--ico Fonts-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/icofont.css" tppabs="http://ableproadmin.com/light/vertical/assets/icon/icofont/css/icofont.css">

	<!-- Required Fremwork -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css" tppabs="http://ableproadmin.com/light/vertical/assets/css/bootstrap.min.css">

	<!-- waves css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/waves/css/waves.min.css" tppabs="http://ableproadmin.com/light/vertical/assets/plugins/waves/css/waves.min.css">

	<!-- Style.css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css" tppabs="http://ableproadmin.com/light/vertical/assets/css/main.css">

	<!-- Responsive.css-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/responsive.css" tppabs="http://ableproadmin.com/light/vertical/assets/css/responsive.css">

	

</head>
<body>

<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-12">
				<div class="login-card card-block">
					<form class="md-float-material" id="loginform" method="POST" action="<?php echo base_url();?>home/login">
						<div class="text-center">
							<img src="<?php echo base_url();?>assets/images/logo-3.png" style="width: 100px;" >
						</div>
						<h3 class="text-center txt-primary">
							Sign In to your account
						</h3>
				<div class="alert alert-danger" id="login_error_tab" style="display:none;">
					<a href="#" class="" data-dismiss="alert" style="float: right;margin-top: -20px;">&times;</a>
					<span id="login_error_msg"> </span>
				</div>
						
						<div class="md-input-wrapper">
							<input type="email" class="md-form-control" name="data[email]" style = "color: #0c0101;"/>
							<label>Email</label>
						</div>
						
						<div class="md-input-wrapper">
							<input type="password" class="md-form-control" name="data[password]" style = "color: #0c0101;"/>
							<label>Password</label>
						</div>
						
						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<div class="rkmd-checkbox checkbox-rotate checkbox-ripple m-b-25">
									<label class="input-checkbox checkbox-primary">
										<input type="checkbox" id="checkbox">
										<span class="checkbox"></span>
									</label>
									<div class="captions">Remember Me</div>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12 forgot-phone text-right">
								<a href="#" tppabs="http://ableproadmin.com/light/vertical/forgot-password.html" class="text-right f-w-600"> Forget Password?</a>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-10 offset-xs-1">
						<input type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" name="submit" value="LOGIN">
							</div>
						</div>
						<!-- <div class="card-footer"> 
						<div class="col-sm-12 col-xs-12 text-center">
							<span class="text-muted">Don't have an account?</span>
							<a href="register2.html" tppabs="http://ableproadmin.com/light/vertical/register2.html" class="f-w-600 p-l-5">Sign up Now</a>
						</div>-->
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


<!-- Warning Section Ends -->
<!-- Required Jqurey -->
<script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.js" ></script>
<!-- tether.js -->
<script src="<?php echo base_url();?>assets/js/tether.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/js/tether.min.js"></script>
<!-- waves effects.js -->
<script src="<?php echo base_url();?>assets/plugins/waves/js/waves.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/plugins/waves/js/waves.min.js"></script>
<!-- Required Framework -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/js/bootstrap.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="<?php echo base_url();?>assets/pages/elements.js" tppabs="http://ableproadmin.com/light/vertical/assets/pages/elements.js"></script>
</body>
</html>
<script>
	$("#loginform").validate({       
            rules: {
               
                "data[email]"              : "required",
                "data[password]"            : "required"
               
         
            },
            messages : {
                "data[email]"              : "Enter email id",
                "data[password]"            : "Enter password"
            },      
    });
 
    </script>
    <?php 
    	if(isset($error)){ ?>

    	<script>
    		$("#login_error_tab").css("display", "block");
			$('#login_error_tab').show().delay(2500).fadeOut('slow');
			$("#login_error_msg").html('<?php echo $error;?>');
    	</script>

	<?php   $error=""; }
    ?>