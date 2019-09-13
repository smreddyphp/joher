   <!-- CONTENT-END-->
   
</div>

<!-- FOOTER-START-->

<!-- FOOTER-END-->

<!-- Warning Section Ends -->
<!-- footer -->

<!-- Required Jqurey -->
<script src="<?php echo base_url();?>assets/admin/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/jquery-ui.min.js" ></script>
<script src="<?php echo base_url();?>assets/admin/js/tether.min.js" ></script>
   <script type="text/javascript" src="<?php echo base_url();?>assets/js/html2canvas.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-notify.min.js"></script>

 <script src="<?php echo base_url();?>assets/js/jquery.validate.js" type="text/javascript"></script>
<!-- Required Fremwork -->
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.min.js" ></script>

<!-- waves effects.js -->
<script src="<?php echo base_url();?>assets/admin/plugins/waves/js/waves.min.js" ></script>

<!-- Scrollbar JS-->
<script src="<?php echo base_url();?>assets/admin/plugins/slimscroll/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/slimscroll/js/jquery.nicescroll.min.js" ></script>

<!--classic JS-->
<script src="<?php echo base_url();?>assets/admin/plugins/search/js/classie.js" ></script>


<!-- data-table js -->
<script src="<?php echo base_url();?>assets/admin/plugins/data-table/js/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url();?>assets/admin/plugins/data-table/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/data-table/js/jszip.min.js" ></script>
<script src="<?php echo base_url();?>assets/admin/plugins/data-table/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/data-table/js/vfs_fonts.js" ></script>
<script src="<?php echo base_url();?>assets/admin/plugins/data-table/js/buttons.print.min.js" ></script>
<script src="<?php echo base_url();?>assets/admin/plugins/data-table/js/buttons.html5.min.js" ></script>
<script src="<?php echo base_url();?>assets/admin/plugins/data-table/js/dataTables.bootstrap4.min.js" ></script>
<script src="<?php echo base_url();?>assets/admin/plugins/data-table/js/dataTables.responsive.min.js" ></script>
<script src="<?php echo base_url();?>assets/admin/plugins/data-table/js/responsive.bootstrap4.min.js" ></script>

<!-- Sparkline charts -->
<script src="<?php echo base_url();?>assets/admin/plugins/charts/sparkline/js/jquery.sparkline.js" ></script>

<!-- Counter js  -->
<script src="<?php echo base_url();?>assets/admin/plugins/countdown/js/waypoints.min.js" ></script>
<script src="<?php echo base_url();?>assets/admin/plugins/countdown/js/jquery.counterup.js" ></script>

<!-- custom js -->
<script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/main.js" ></script>
<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/admin/pages/dashboard.js" ></script> -->
<script src="<?php echo base_url();?>assets/admin/pages/data-table.js" ></script>
<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/admin/pages/elements.js" ></script> -->
<script src="<?php echo base_url();?>assets/admin/js/menu.js" ></script>
<script src="<?php echo base_url();?>assets/admin/js/highcharts.js" ></script>
<script src="<?php echo base_url();?>assets/admin/js/exporting.js" ></script>
<!--<script src="<?php echo base_url();?>assets/admin/js/ckeditor.js" ></script>-->
<script src="<?php echo base_url();?>assets/admin/js/moment.min.js"></script>
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/alertify.min.js"></script>


</body>
</html>
<!-- success alert -->
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
<!-- error alert -->
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
<?php } ?>
<!-- error alert -->
<style>
[data-notify="container"][class*="alert-pastel-"] {
		   /*background-color: rgb(255, 255, 238);*/
			background:linear-gradient(65deg, #378482 0%, #378482 100%);
			border-width: 0px;
			border-left: 15px solid rgb(255, 240, 106);
			border-radius: 0px;
			box-shadow: 0px 0px 5px rgba(51, 51, 51, 0.3);
			font-family: 'Old Standard TT', serif;
			letter-spacing: 1px;
		}
		[data-notify="container"].alert-pastel-info {
			border-left-color: #68bfbd;
		}
		[data-notify="container"].alert-pastel-danger {
			border-left-color: #68bfbd;
		}
		[data-notify="container"][class*="alert-pastel-"] > [data-notify="title"] {
			color: #FFFFFF;
			font-weight: bold;
			font-size: 200%;
		}
		[data-notify="container"][class*="alert-pastel-"] > [data-notify="message"] {
			font-weight: 400;
		}
		[data-notify="message"] p{
			border: 2px solid #FFFFFF;
			padding : 2%;
			animation: blinker 1s linear infinite;
			font-size: 130%;
			color:#FFFFFF;
		}
		@keyframes blinker {  
			50% { border: 2px solid #fff; }
			100% { border: 2px solid #fff; }
		}
		[data-notify="icon"] {
			height: 80px;
			color:#FFFFFF;
		}
		.image-cross {
			height: 30px !important;
		}
</style>
