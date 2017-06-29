<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MyMaid | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo plugin_url('bootstrap/css/bootstrap.min.css');?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo plugin_url('dist/css/AdminLTE.min.css');?>">
    <?php if(!isset($login)){ ?>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo plugin_url('dist/css/skins/_all-skins.min.css');?>">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo plugin_url('plugins/iCheck/flat/blue.css');?>"> 
<!--        <link rel="stylesheet" href="<?php //echo plugin_url('plugins/iCheck/square/blue.css');?>">-->
        <!-- Morris chart -->
        <link rel="stylesheet" href="<?php echo plugin_url('plugins/morris/morris.css');?>">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?php echo plugin_url('plugins/jvectormap/jquery-jvectormap-1.2.2.css');?>">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?php echo plugin_url('plugins/datepicker/datepicker3.css');?>">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?php echo plugin_url('plugins/daterangepicker/daterangepicker.css');?>">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?php echo plugin_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">
          <!-- Pace style -->
        <link rel="stylesheet" href="<?php echo plugin_url('plugins/pace/pace.min.css');?>">
          <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo plugin_url('plugins/select2/select2.min.css'); ?>">
        <!-- Jquery-Confirm -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.1.1/jquery-confirm.min.css">
    <?php } else { ?>
        <!-- iCheck -->
<!--        <link rel="stylesheet" href="<?php //echo plugin_url('plugins/iCheck/square/blue.css');?>">-->
    <?php } ?>
        
                
        <!-- jQuery 2.2.3 -->
        <script src="<?php echo plugin_url('plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
        <!-- Datatable -->
<!--        <link rel="stylesheet" href="<?php //echo plugin_url('plugins/datatables/jquery.dataTables.min.css');?>">-->
        <link rel="stylesheet" href="<?php echo plugin_url('plugins/datatables/dataTables.bootstrap.css');?>">
        <script src="<?php echo plugin_url('plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo plugin_url('plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
        
        <!-- Jquery-Confirm -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.1.1/jquery-confirm.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
        
        <script src="<?php echo js_url('app_utils'); ?>"></script>
    </head>
<?php if(isset($login)){?>

    <body class="hold-transition login-page"> 
        
<?php } else { ?>
        
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
<?php } ?>
