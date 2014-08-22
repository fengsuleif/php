<!DOCTYPE html>
<html lang="en">
<head>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<title>中国选举观察</title>
<?php  include_once("index_head.php"); ?>
<style>
.unstyled li{border-bottom: #d4d5d5 dotted 1px;height: 30px;overflow: hidden; }
</style>
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
$mode="url";
if($mode=="htm"){
for ($i=0;$i<count($data); $i++){
if($data[$i][0]==intval($_GET["c"])){
    //echo '<li class="active"><a href="list.php?c='.$data[$i][0].'">'.$data[$i][1].'</a></li>'; 
	echo '<li class="active"><a href="list'.$data[$i][0].'.htm">'.$data[$i][1].'</a></li>'; }
else{
	//echo '<li ><a href="list.php?c='.$data[$i][0].'">'.$data[$i][1].'</a></li>';
	echo '<li><a href="list'.$data[$i][0].'.htm">'.$data[$i][1].'</a></li>'; 
}
}
}

if($mode=="url"){
for ($i=0;$i<count($data); $i++){
if($data[$i][0]==intval($_GET["c"])){
    //echo '<li class="active"><a href="list.php?c='.$data[$i][0].'">'.$data[$i][1].'</a></li>'; 
	echo '<li class="active"><a href="/'.$data[$i][0].'">'.$data[$i][1].'</a></li>'; }
else{
	//echo '<li ><a href="list.php?c='.$data[$i][0].'">'.$data[$i][1].'</a></li>';
	echo '<li><a href="/'.$data[$i][0].'">'.$data[$i][1].'</a></li>'; 
}
}
}
?>	
	  <li><a href="#myModal"  data-toggle="modal">关于我们</a></li>
    </ul>
  </div>
</div>

</div>


<div class="span8">

 <div class="hero-unit">
  
  <ul class="unstyled ">
        <?php
		if(isset($_GET["p"]) and ctype_digit(intval($_GET["p"]))){
		$view=get_list_page(intval($_GET["c"]),intval($_GET["p"]),15);
		
		}else{
		$view=get_list_page(intval($_GET["c"]),1,15);
		for ($i=0;$i<count($view); $i++){
	//echo '<li ><a href="show.php?s='.$view[$i][0].','.intval($_GET["c"]).'">'.$view[$i][1].'</a> <p><small>'.mb_substr($view[$i][2], 0, 56,"utf-8").'</small></p></li>';
	echo '<li ><a href="show_'.$view[$i][0].'_'.intval($_GET["c"]).'.htm">'.$view[$i][1].'</a> <p><small>'.mb_substr($view[$i][2], 0, 56,"utf-8").'</small></p></li>';

}}
?>	
</ul>


</div>  
<div class="pagination">
  <ul>
  <?php 
   $Total_p=get_art_num(intval($_GET["c"])); //多少篇文章
  $M_p=15;//每页多少篇文章
if($Total_p>0){
$B_p=($Total_p%$M_p)>0?($Total_p/$M_p+1):($Total_p/$M_p);//计算应该分成几页
show_page(intval($_GET["p"]),$B_p,intval($_GET["c"]));
  }  
?>
    
  </ul>
</div>



</div>


  <div class="span4">
      <div class="hero-unit">
   <h3>推荐阅读</h3>
  <ul class="unstyled ">
    <?php
$view=get_index_slide(3,12);
for ($i=0;$i<count($view); $i++){
	//echo '<li ><i class="  icon-chevron-right"></i>  <a href="show.php?s='.$view[$i][0].','.intval($_GET["c"]).'">'.$view[$i][1].'</a></li>';
	echo '<li ><i class="  icon-chevron-right"></i>  <a href="show_'.$view[$i][0].'_'.$view[$i][5].'.htm">'.$view[$i][1].'</a></li>';
	
}
unset($view);
?>
  
</ul>
   </div>
  
  </div>
  
  <div class="clearfix"></div> 
  
 
  
<?php  include_once("foot.php"); ?>
 
<!--row--> </div>
<!--container--> </div>
</body>
</html>