<!DOCTYPE html>
<html lang="en">
<head>
	<title>Forgot Password</title>
	<!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="../../../oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" tppabs="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="../../../oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" tppabs="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="description" content="Phoenixcoded">
	<meta name="keywords"
		  content=", Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
	<meta name="author" content="Phoenixcoded">

	<!-- Favicon icon -->
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png" tppabs="http://ableproadmin.com/light/vertical/assets/images/favicon.png" type="image/x-icon">
	<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico" tppabs="http://ableproadmin.com/light/vertical/assets/images/favicon.ico" type="image/x-icon">

	

	<!-- iconfont -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/icofont.css" tppabs="http://ableproadmin.com/light/vertical/assets/icon/icofont/css/icofont.css">

	<!-- Required Fremwork -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css" tppabs="http://ableproadmin.com/light/vertical/assets/css/bootstrap.min.css">

	<!-- waves css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/waves/css/waves.min.css" tppabs="http://ableproadmin.com/light/vertical/assets/plugins/waves/css/waves.min.css">

	<!-- Style.css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css" tppabs="http://ableproadmin.com/light/vertical/assets/css/main.css">

	<!-- Responsive.css-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/responsive.css" tppabs="http://ableproadmin.com/light/vertical/assets/css/responsive.css">
	<!--color css-->
	

</head>
<body>
 
	<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
		<div class="container-fluid">
			<div class="row">
				   <div class="col-xs-12">
						<div class="login-card card-block">
							<form class="md-float-material" id="forgot_form" method="POST" action="<?php echo base_url();?>home/forgot_password">
								<div class="text-center">
									<img src="<?php echo base_url();?>assets/images/logo-3.png">
								</div>
								<h3 class="txt-primary text-center m-b-25">Recover your password</h3>


						<div class="md-group">
							<div class="md-input-wrapper">
								<input type="text" class="md-form-control" name="email" />
								<label>Email</label>
							</div>
						</div>
						<div class="btn-forgot">
							<button type="submit" class="btn btn-primary btn-md waves-effect waves-light text-center">SEND RESET LINK
							</button>
						</div>
								<div class="row">
									<div class="col-xs-12 text-center m-t-25">

										<a href="<?php echo base_url();?>home/login" tppabs="http://ableproadmin.com/light/vertical/login1.html" class="f-w-600 p-l-5"> Sign In Here</a>

									</div>
								</div>
						<!-- end of btn-forgot class-->
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
<script src="<?php echo base_url();?>assets/js/jquery.validate.js" ></script>
<!-- tether.js -->
<script src="<?php echo base_url();?>assets/js/tether.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/js/tether.min.js"></script>
<!-- waves effects.js -->
<script src="<?php echo base_url();?>assets/plugins/waves/js/waves.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/plugins/waves/js/waves.min.js"></script>
<!-- Required Framework -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js" tppabs="http://ableproadmin.com/light/vertical/assets/js/bootstrap.min.js"></script>

<!-- Custom js -->
<script type="text/javascript" src="<?php echo base_url();?>assets/pages/elements.js" tppabs="http://ableproadmin.com/light/vertical/assets/pages/elements.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap-notify.min.js"></script>

</body>
</html>
<style>

[data-notify="container"][class*="alert-pastel-"] {
			background-color: rgb(255, 255, 238);
			border-width: 0px;
			border-left: 15px solid rgb(255, 240, 106);
			border-radius: 0px;
			box-shadow: 0px 0px 5px rgba(51, 51, 51, 0.3);
			font-family: 'Old Standard TT', serif;
			letter-spacing: 1px;
		}
		[data-notify="container"].alert-pastel-info {
			border-left-color: #8ac7fc;
		}
		[data-notify="container"].alert-pastel-danger {
			border-left-color: rgb(255, 103, 76);
		}
		[data-notify="container"][class*="alert-pastel-"] > [data-notify="title"] {
			color: rgb(80, 80, 57);
			font-weight: bold;
			font-size: 200%;
		}
		[data-notify="container"][class*="alert-pastel-"] > [data-notify="message"] {
			font-weight: 400;
		}
		[data-notify="message"] p{
			border: 2px solid red;
			padding : 2%;
			animation: blinker 1s linear infinite;
			font-size: 130%;
		}
		@keyframes blinker {  
			50% { border: 2px solid red; }
			100% { border: 2px solid #fff; }
		}
		[data-notify="icon"] {
			height: 80px;
		}
		.image-cross {
			height: 30px !important;
		}
		section.login {
    left: 0px;
}

</style>
<script>
	$("#forgot_form").validate({       
            rules: {
               
                "email"              : "required"
            },
            messages : {
               "email"              : "Ener Email id"
            },      
    });
	</script>
	<?php if($this->session->flashdata('success')) { ?>
<script type="text/javascript">
$.notify({
	icon: '<?php echo base_url()?>assets/images/check.gif',
	title: ' Success',
	message: '<?php echo $this->session->flashdata('success')?>'
},{
	type: "pastel-info",
	allow_dismiss: true,
	newest_on_top: true,
	showProgressbar: false,
	placement: {
		from: "bottom",
		align: "right"
	},
	offset: 20,
	spacing: 10,
	z_index: 5000,
	delay: 5000,
	timer: 1000,
	url_target: '_blank',
	mouse_over: null,
	animate: {
		enter: 'animated bounceInDown',
		exit: 'animated zoomOutUp'
	},
	onShow: null,
	onShown: null,
	onClose: null,
	onClosed: null,
	icon_type: 'image',
	template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
		'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
		'<img data-notify="icon">' +
		'<span data-notify="title">{1}</span> ' +
		'<span data-notify="message"><p>{2}</p></span>' +
		'<div class="progress" data-notify="progressbar">' +
			'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
		'</div>' +
		'<a href="{3}" target="{4}" data-notify="url"></a>' +
	'</div>' 
});

</script>
<?php } ?>
<!-- success alert -->
<?php if($this->session->flashdata('error')) { ?>
<script type="text/javascript">
$.notify({
	icon: '<?php echo base_url()?>assets/images/cross.gif',
	title: ' Alert',
	message: "<?php echo $this->session->flashdata('error')?>"
},{
	type: "pastel-danger",
	allow_dismiss: true,
	newest_on_top: true,
	showProgressbar: false,
	placement: {
		from: "bottom",
		align: "right"
	},
	offset: 20,
	spacing: 10,
	z_index: 5000,
	delay: 5000,
	timer: 1000,
	url_target: '_blank',
	mouse_over: null,
	animate: {
		enter: 'animated bounceInDown',
		exit: 'animated zoomOutUp'
	},
	onShow: null,
	onShown: null,
	onClose: null,
	onClosed: null,
	icon_type: 'image',
	template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
		'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
		'<img data-notify="icon" class="image-cross">' +
		'<span data-notify="title">{1}</span> ' +
		'<span data-notify="message"><p>{2}</p></span>' +
		'<div class="progress" data-notify="progressbar">' +
			'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
		'</div>' +
		'<a href="{3}" target="{4}" data-notify="url"></a>' +
	'</div>' 
});

</script>
<?php  } ?>
