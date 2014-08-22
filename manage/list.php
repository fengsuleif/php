<?php  include_once("index_head.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<title>中国选举观察</title>
</head>
<body>

 <div class="container">
<div class="row">
<div class="span12">
<div class="page-header">
  <h1>中国选举观察 <small>Subtext for header</small></h1>
  
</div>
<div class="navbar">
  <div class="navbar-inner">
    <a class="brand" href="index.php">首页</a>
    <ul class="nav">
      <?php
	  
$data=get_menu();
for ($i=0;$i<count($data); $i++){
if($data[$i][0]==(intval($_GET["c"])) ){
    echo '<li class="active"><a href="list.php?c='.$data[$i][0].'">'.$data[$i][1].'</a></li>'; }
else{
	echo '<li ><a href="list.php?c='.$data[$i][0].'">'.$data[$i][1].'</a></li>';
}
}?>	
	  <li><a href="#myModal"  data-toggle="modal">关于我们</a></li>
    </ul>
  </div>
</div>

</div>


<div class="span8">

 <div class="hero-unit">
  
  <ul class="unstyled ">
        <?php
$view=get_list(intval($_GET["c"]));
for ($i=0;$i<count($view); $i++){
	echo '<li ><a href="show.php?s='.$view[$i][0].','.intval($_GET["c"]).'">'.$view[$i][1].'</a></li>';

}?>	
</ul>


</div>  
<div class="pagination">
<?php echo get_art_num(intval($_GET["c"])); ?>
  <ul>
    <li><a href="#">Prev</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">Next</a></li>
  </ul>
</div>



</div>


  <div class="span4">
      <div class="hero-unit">
   <h3>推荐文章</h3>
  <ul class="unstyled ">
    <?php
$view=get_index_slide(3);
for ($i=0;$i<count($view); $i++){
	echo '<li ><a href="show.php?s='.$view[$i][0].','.intval($_GET["c"]).'">'.$view[$i][1].'</a></li>';
}
unset($view);
?>
  
</ul>
   </div>
  
  </div>
  
  <div class="clearfix"></div>
  
  
 
  
  
<div class="span12">
<div class="footer hero-unit"><ul class="nav nav-pills">
      
  <li ><a href="http://unhr.org/">联合国人权</a></li>
  <li ><a href="http://huji.zhuanxing.cn/">户籍观察</a></li>
  <li ><a href="http://unhr.org/">联合国人权</a></li>
  <li ><a href="http://huji.zhuanxing.cn/">户籍观察</a></li>
  <li ><a href="http://unhr.org/">联合国人权</a></li>
  <li ><a href="http://huji.zhuanxing.cn/">户籍观察</a></li>
</ul></div>
</div>

 <!--about-->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">关于我们</h3>
  </div>
  <div class="modal-body">
    <p>关于我们关于我们关于我们关于我们关于我们</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
   
  </div>
</div> 
 <!--about-->
 
<!--row--> </div>
<!--container--> </div>
</body>
</html>