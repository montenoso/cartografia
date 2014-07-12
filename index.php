<?php
session_start();
require_once("conf.php");
include("conecta.php");
?>

<!DOCTYPE HTML>
<html>
  <head>
      <title>Cartografía</title>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <meta name="description" content="" />
      <meta name="keywords" content="" />

      <script src="<?php echo $media_host;?>/js/vendor/jquery.min.js"></script>
      <script src="<?php echo $media_host;?>/js/skel_config.js"></script>
      <script src="<?php echo $media_host;?>/js/vendor/jquery.easing.1.3.js"></script> <!-- easing -->
      <script src="<?php echo $media_host;?>/js/vendor/skel.min.js"></script>

      <link rel="stylesheet" href="http://libs.cartocdn.com/cartodb.js/v3/themes/css/cartodb.css" />

      <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
      <!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
      <!--[if lte IE 7]><link rel="stylesheet" href="css/ie7.css" /><![endif]-->
      

      <script src="http://libs.cartocdn.com/cartodb.js/v3/cartodb.js"></script>
      <script src="<?php echo $media_host;?>/js/main.js"></script>

              
  </head>
  <!--
		Note: Set the body element's class to "left-sidebar" to position the sidebar on the left.
		Set it to "right-sidebar" to, you guessed it, position it on the right.
	-->
	<body  class="left-sidebar">

    <!-- Wrapper -->
    <div id="wrapper">

    <!-- Content -->
        <div id="content">
                <div id="map"></div> 
        </div>

        <!-- Sidebar -->
        <div id="sidebar">
       <!-- Logo -->

        <div id="logo" a href="#" onclick="window.location='<?php echo $media_host?>'" style="cursor:pointer;"> 

    </div>
          
	</body>
</html>