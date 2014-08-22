<?php
if(empty($_COOKIE['SXK2013'])){ 
$url='http://'.$_SERVER["SERVER_NAME"].'/login.htm';
header('Location:'.$url); 
}
?>
   <meta charset="utf-8" />	
	<meta name="HandheldFriendly" content="True">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="cleartype" content="on">
    <script charset="utf-8" src="js/jquery.js"></script>
	<link rel="stylesheet" href="css/reset-min-0.13.1.css">
	<link rel="stylesheet" href="css/chico-min-0.13.1.css">
	<link rel="stylesheet" href="css/mesh-min-2.1.css">

	
	<style>
		/**
		 * Carousel demo
		 */
		.myCarousel .ch-carousel-item {
			width: 250px;
			height: 250px;
		}
		.myCarousel img {
			max-width: 100%;
			max-height: 100%;
		}
		/* Icons demo */
		.showroomIcons {
			overflow: hidden;
		}
		.showroomIcons li{
			float:left;
			width: 33%;
			line-height: 2em;
		}
		.autoComplete {
			width: 250px;
		}
		.autoComplete2 {
			width: 350px;
		}

		.autoComplete3 {
			width: 450px;
		}
		.ch-loading-small {
			display: block;
			margin:0 auto;
		}
		.YOUR_SELECTOR_Menu li span{
		font-size:1.2em;
		}
	</style>
	