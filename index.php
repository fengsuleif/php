<!DOCTYPE html>
<html lang="en">
<head>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<title>中国选举观察</title>
<style>
.tuijin_li {height:420px;overflow: hidden;}
.tuijin_li li{border-bottom: #d4d5d5 dotted 1px;height: 30px;}
</style>
<?php  include_once("index_head.php");
//ini_set("display_errors",0); ?>
</head>
<body>

 <div class="container">
<div class="row">
<div class="span12">
<div class="page-header">
  <h1>中国选举观察 <small>China Election Observation</small></h1>
  
</div>
<div class="navbar">
  <div class="navbar-inner">
    <a class="brand" href="index.htm">首页</a>
    <ul class="nav">
<?php
$data=get_menu();
makemenu($data,"url");
?>	<li><a href="#myModal"  data-toggle="modal">关于我们</a></li>
    </ul>
  </div>
</div>

</div>


<div class="span8">

<div id="myCarousel" class="carousel slide" >
  
  <!-- Carousel items -->
  <div class="carousel-inner">
     <?php
$view=get_index_slide(1,6);
for ($i=0;$i<count($view); $i++){

if($i==0){
	echo '<div class="active item"><img src="'.$view[$i][6].'" width="620px" style="height:460px"/>';
	}else{	
	echo '<div class="item"><img src="'.$view[$i][6].'" width="620px" style="height:460px"/>';
	}
	
	echo '<div class="carousel-caption">';
               echo '<h4>'.$view[$i][1].'</h4>';
               echo ' <p>'.$view[$i][2].'</p>';
               echo '</div>';
	echo '</div>';

}
unset($view);
?>    
        
  </div>
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>

</div>
  <div class="span4">
  
  <ul class="unstyled well tuijin_li">
  <h3>推荐阅读</h3>
   <?php
$view=get_index_slide(2,12);
for ($i=0;$i<count($view); $i++){
	//echo '<li ><a href="show.php?s='.$view[$i][0].','.$view[$i][5].'">'.mb_substr($view[$i][1], 0, 17,"utf-8").'</a></li>';
	echo '<li ><a href="show_'.$view[$i][0].'_'.$view[$i][5].'.htm">'.mb_substr($view[$i][1], 0, 17,"utf-8").'</a></li>';
}
unset($view);
?>  
</ul>  
  
  </div>
  
  <div class="clearfix"></div>
  
  <div class="span6">
  
  <div class="hero-unit">
  <h3>倡导</h3>
  <ul class="unstyled li_hidden">
            <?php
$view=get_list(2);
for ($i=0;$i<count($view); $i++){
	//echo '<li ><a href="show.php?s='.$view[$i][0].','.$view[$i][5].'">'.mb_substr($view[$i][1], 0, 19,"utf-8").'</a></li>';
	echo '<li ><a href="show_'.$view[$i][0].'_'.$view[$i][5].'.htm">'.mb_substr($view[$i][1], 0, 19,"utf-8").'</a></li>';
}
unset($view);
?>
 
  
</ul>
</div>  
  
  </div>
  
   <div class="span6">  
  
  <div class="hero-unit">
   <h3>思潮</h3>
  <ul class="unstyled">
            <?php
$view=get_list(3);
for ($i=0;$i<count($view); $i++){
	//echo '<li ><a href="show.php?s='.$view[$i][0].','.$view[$i][5].'">'.mb_substr($view[$i][1], 0, 19,"utf-8").'</a></li>';
	echo '<li ><a href="show_'.$view[$i][0].'_'.$view[$i][5].'.htm">'.mb_substr($view[$i][1], 0, 19,"utf-8").'</a></li>';
}
unset($view);
?> 
</ul>
</div>    
  </div>
  
  <div class="span6">
  
  <div class="hero-unit">
   <h3>动态</h3>
  <ul class="unstyled">
            <?php
$view=get_list(1);
for ($i=0;$i<count($view); $i++){
	//echo '<li ><a href="show.php?s='.$view[$i][0].','.$view[$i][5].'">'.mb_substr($view[$i][1], 0, 19,"utf-8").'</a></li>';
	echo '<li ><a href="show_'.$view[$i][0].'_'.$view[$i][5].'.htm">'.mb_substr($view[$i][1], 0, 19,"utf-8").'</a></li>';
}
unset($view);
?>
  
</ul>
</div>  
  
  </div>
  <div class="span6">
  
  <div class="hero-unit">
   <h3>体制与改革</h3>
  <ul class="unstyled ">
          <?php
$view=get_list(4);
for ($i=0;$i<count($view); $i++){
	//echo '<li ><a href="show.php?s='.$view[$i][0].','.$view[$i][5].'">'.mb_substr($view[$i][1], 0, 19,"utf-8").'</a></li>';
	echo '<li ><a href="show_'.$view[$i][0].'_'.$view[$i][5].'.htm">'.mb_substr($view[$i][1], 0, 19,"utf-8").'</a></li>';
}
unset($view);
?> 
 
</ul>
</div>  
  
  </div>
 
<?php  include_once("foot.php"); ?>
 
<!--row--> </div>
<!--container--> </div>
</body>
</html>
