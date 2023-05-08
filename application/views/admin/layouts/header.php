<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $this->uri->segment(3) ? ucwords($this->uri->segment(3)) : ucwords($this->uri->segment(2)); ?> | <?php echo PROJECT_NAME; ?> Admin Panel</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url().'assets/'; ?>favicon.ico" type="image/x-icon" />

    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
	
	<!-- vector map CSS -->
    <link href="<?php echo base_url().'assets/'; ?>vendors/vectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" type="text/css" />
	
	<link href="<?php echo base_url().'assets/'; ?>vendors/apexcharts/dist/apexcharts.css" rel="stylesheet" type="text/css" />
	<!-- select2 CSS -->
    <link href="<?php echo base_url().'assets/'; ?>vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- Toggles CSS -->
    <link href="<?php echo base_url().'assets/'; ?>vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url().'assets/'; ?>vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
	
	<!-- Toastr CSS -->
    <link href="<?php echo base_url().'assets/'; ?>vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

    <!-- Data Table CSS -->
    <link href="<?php echo base_url().'assets/'; ?>vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/'; ?>vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="<?php echo base_url().'assets/'; ?>dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Preloader 
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    --><!-- /Preloader -->
	
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">