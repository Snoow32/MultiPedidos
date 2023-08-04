<?php
  require_once('sess_auth.php');
  
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<title><?php echo $_settings->info('title') != false ? $_settings->info('title').' | ' : '' ?><?php echo $_settings->info('name') ?></title>
    <link rel="icon" href="<?php echo validate_image($_settings->info('logo')) ?>" />
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/adminlte.css">
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <style type="text/css">
      @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
    </style>

    <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>
    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>
    <script src="<?php echo base_url ?>dist/js/script.js"></script>
  </head>