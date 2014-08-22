
<!DOCTYPE html>
<html lang="en">
<head>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<title>中国选举观察</title>
<style>
.unstyled li{border-bottom: #d4d5d5 dotted 1px;height: 30px;overflow: hidden; }
</style>

</head>
<body>
<?php  include_once("index_head.php"); ?>
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
	 $Guid=explode(",",$_GET["s"]);
$data=get_menu();
$view=get_show(intval($Guid[0]));
$mode="url";
if($mode=="htm"){
for ($i=0;$i<count($data); $i++){
if($data[$i][0]==intval($Guid[1])){
    //echo '<li class="active"><a href="list.php?c='.$data[$i][0].'">'.$data[$i][1].'</a></li>'; 
	echo '<li class="active"><a href="list'.$data[$i][0].'.htm">'.$data[$i][1].'</a></li>'; }
	else{
	//echo '<li ><a href="list.php?c='.$data[$i][0].'">'.$data[$i][1].'</a></li>';
	echo '<li><a href="list'.$data[$i][0].'.htm">'.$data[$i][1].'</a></li>'; }

}
}

if($mode=="url"){
for ($i=0;$i<count($data); $i++){
if($data[$i][0]==intval($Guid[1])){
    //echo '<li class="active"><a href="list.php?c='.$data[$i][0].'">'.$data[$i][1].'</a></li>'; 
	echo '<li class="active"><a href="/'.$data[$i][0].'">'.$data[$i][1].'</a></li>'; }
	else{
	//echo '<li ><a href="list.php?c='.$data[$i][0].'">'.$data[$i][1].'</a></li>';
	echo '<li><a href="/'.$data[$i][0].'">'.$data[$i][1].'</a></li>'; }

}
}
?>
	  <li><a href="#myModal"  data-toggle="modal">关于我们</a></li>
    </ul>
  </div>
</div>

</div>


<div class="span12">
<h2 class="brand"><?php echo $view[0][1]; ?></h2>


</div>
<div class="span8">

 <ul class="breadcrumb well">
  <li><a href="#">作者:<?php echo $view[0][3]; ?></a> <span class="divider">|</span></li>
  <li><a href="#">来源:<?php echo $view[0][4]; ?></a> <span class="divider">|</span></li>
  <li class="active"><a href="#">时间:<?php echo $view[0][5]; ?></a></li>
</ul>

 <div class="hero-unit">
 
 

 <p>
 <?php echo $view[0][2]; ?>
 
 </p>
</div>  




</div>


  <div class="span4">
      <div class="hero-unit">
   <h3>推荐阅读</h3>
  <ul class="unstyled ">
  <?php
$view=get_index_slide(4,12);
for ($i=0;$i<count($view); $i++){
	//echo '<li ><i class="  icon-chevron-right"></i>  <a href="show.php?s='.$view[$i][0].','.intval($Guid[1]).'">'.$view[$i][1].'</a></li>';
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
<a id="scrollUp" href="#top" title="" style="position: fixed; z-index: 2147483647; display: block;"></a>
<script>
     var w = 120; 
var h = 59; 
var str = ""; 
var obj = document.getElementById("divStayTopLeft"); 
if (obj)str = obj.innerHTML;
 
if( typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat'){ 
document.writeln('<DIV  style="z-index:9;right:0;bottom:100px;height:'+h+'px;width:'+w+'px;overflow:hidden;POSITION:fixed;_position:absolute; _margin-top:expression(document.documentElement.clientHeight-this.style.pixelHeight+document.documentElement.scrollTop);">');
 }
 
else { 
document.writeln('<DIV  style="z-index:9;right:0;bottom:0;height:'+h+'px;width:'+w+'px;overflow:hidden;POSITION:fixed;*position:absolute; *top:expression(eval(document.body.scrollTop)+eval(document.body.clientHeight)-this.style.pixelHeight);">'); 
}
 
document.writeln('<div style="clear:both;margin:auto;height:59px;font-size:16px;overflow:hidden;font-weight:bold;text-align:left;"><a href="javascript:scroll(0,0)" hidefocus="true" title="回到顶部"><img src="http://www.chinaelect.org/bootstrap/img/top.png" alt="回到顶部" style="border: 0px;" /></a></div> ');
 
document.write('<div style="clear:both;margin:auto;overflow:hidden;text-align:left;">'+str+'</div>');
 
document.writeln('</DIV>'); 
    </script>

</body>
</html>