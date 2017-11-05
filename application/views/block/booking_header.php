<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>MyMaidz</title>
	<meta content="width=device-width,initial-scale=1" name="viewport">
	<link rel="icon" href="./favicon.ico" type="image/x-icon">
	<!--[if IE]>
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<![endif]-->
	<!-- GLOBAL STYLES -->
	<!-- PAGE LEVEL STYLES -->
	<link rel="stylesheet" href="<?php echo plugin_url("bootstrap/css/bootstrap.css") ?>">
	<?php if(isset($home) && $home == 1){ ?>
            <link rel="stylesheet" media="all" href="<?php echo css_url("app") ?>">
        <?php }else { ?>
        <link rel="stylesheet" media="all" href="<?php echo css_url("fonts") ?>">
        <link rel="stylesheet" href="<?php echo css_url('ct-main');?>" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo css_url('ct-common');?>" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo css_url('login-style');?>" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo css_url('ct-responsive');?>" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo css_url('ct-reset.min');?>" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo css_url('jquery-ui.min');?>" type="text/css" media="all">       
        <link rel="stylesheet" href="<?php echo css_url('jquery-ui.theme.min');?>" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo css_url('intlTelInput');?>" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo css_url('simple-line-icons');?>" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo css_url('booking');?>" type="text/css" media="all">
         <!-- **Google - Fonts** -->
        <link href="<?php echo css_url('css');?>" rel="stylesheet">
        <!-- Jquery-Confirm -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.1.1/jquery-confirm.min.css">
         <style>
            .error {
                color: red;
            }

        </style>
        <?php } ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
         <!-- Jquery-Confirm -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.1.1/jquery-confirm.min.js"></script>
<!--            <script src="<?php //echo js_url('utils');?>" type="text/javascript"></script>
<script src="<?php //echo js_url('intlTelInput');?>" type="text/javascript"></script>-->
	<!-- END PAGE LEVEL STYLES -->
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
<!--        <script src="<?php //echo js_url('app.min'); ?>"></script>-->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body style="overflow: auto;">
       