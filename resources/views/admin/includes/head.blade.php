	<link rel="icon" href="{{asset('images/frontend/web/'.$fav_icon)}}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/font/font-family-roboto.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/font/family-material-icon.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/node-waves/waves.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('css/'.$view_path.'/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/'.$view_path.'/themes/all-themes.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/drop-zone/drop-zone.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/jquery-ui/css/jquery-ui.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/owlcarousel/owl.carousel.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/owlcarousel/owl.theme.default.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/font/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/'.$view_path.'/font-awesome/css/font-awesome.css')}}">
	<style>
		#sortable { list-style-type: none; margin: 0; padding: 0; width: 450px; }
	  	#sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 100px; height: 90px; font-size: 4em; text-align: center; }
		html>body #sortable li { height: 1.5em; line-height: 1.2em; }
	  	.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
	  	
		#file{
			background-color: #00ad2d;;
			color:#aaa;
		}
		textarea.height{
			height: 100px;
		}

		/*Owl Style*/

		#owl-demo .item{
		  margin: 3px;
		}

		.owl-nav , .owl-nav.disabled{
			display:block !important;
		}

		.owl-stage-outer{
			margin-left:28px;
			margin-right:26px;
		}
		.owl-prev {
		    position: absolute;
		    top: 32%;
		    display: block !important;
		    border:0px solid black;
		    background-color:transparent !important;
		}
		.owl-prev i, .owl-next i{
			font-size:20px !important;
		}

		.owl-next {

		    position: absolute;
		    top: 32%;
		    right:0%;
		    display: block !IMPORTANT;
		    border:0px solid black;
		    background-color:transparent !important;
		}

		.owl-prev i, .owl-next i { color: #212121;}

		.modal-detail {
		display: none; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 100; /* Sit on top */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
		-webkit-animation-name: fadeIn; /* Fade in the background */
		-webkit-animation-duration: 0.4s;
		animation-name: fadeIn;
		animation-duration: 0.4s
		}

		/* Modal Content */
		.modal-content-detail {
		    position: fixed;
		    background-color: #fefefe;
		    width: 100%;
		    top:0;
		    -webkit-animation-name: slideIn;
		    -webkit-animation-duration: 0.4s;
		    animation-name: slideIn;
		    animation-duration: 0.4s
		}

		/* The Close Button */
		.close-detail {
		    color: white;
		    float: right;
		    font-size: 28px;
		    font-weight: bold;
		}

		.close-detail:hover,
		.close-detail:focus {
		    color: #000;
		    text-decoration: none;
		    cursor: pointer;
		}

		.modal-header-detail {
		    padding: 2px 16px;
		    background-color: #E91E63;
		    color: white;
		}

		.modal-body-detail {padding: 2px 16px;}

		.modal-footer-detail {
		    padding: 2px 16px;
		    background-color: #E91E63;
		    color: white;
		}

		/* Add Animation */
		@-webkit-keyframes slideIn {
		    from {top: -300px; opacity: 0} 
		    to {top: 0; opacity: 1}
		}

		@keyframes slideIn {
		    from {top: -300px; opacity: 0}
		    to {top: 0; opacity: 1}
		}

		@-webkit-keyframes fadeIn {
		    from {opacity: 0} 
		    to {opacity: 1}
		}

		@keyframes fadeIn {
		    from {opacity: 0} 
		    to {opacity: 1}
		}

		.textarea{
			width: 80px;
		}
	</style>