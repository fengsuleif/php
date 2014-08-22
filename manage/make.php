<?php
session_start();
?>
<!doctype html>
<!--[if IE 7]>	<html class="no-js  lt-ie10 lt-ie9 lt-ie8 ie7" lang="en"> <![endif]-->
<!--[if IE 8]>	<html class="no-js lt-ie10 lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9]>	<html class="no-js lt-ie10 ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
	<title>后台管理</title>	
	<?php include_once("head.php");   ?>
</head>
<body>
	<div class="ch-clearfix">
		<div class="ch-g1-4">
			<?php include_once("left.php"); ?>
		</div>
		<div class="ch-g3-4">
			<div class="ch-box-lite ch-rightcolumn">
			
			<?php
function get_menu(){
$query="select id, class ,pid  from sxk_class where stat=1";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->execute();
$arr=array();
$stmt->bind_result($id,$class,$pid);
while($stmt->fetch()){
	 $arr[]=array($id,$class,$pid); 
 }
$stmt->close();
$link->close();
return $arr;
}

function get_show($num){
$query="";
if($num>0){
$query="select id, cid  from sxk_art where stat=0 order by id desc limit ".$num;
}else{
$query="select id, cid  from sxk_art where stat=0";
}
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->execute();
$arr=array();
$stmt->bind_result($id,$cid);
while($stmt->fetch()){
	 $arr[]=array($id,$cid); 
 }
$stmt->close();
$link->close();
return $arr;
}
if($_GET["a"]!=Null){
$exp=$_GET["a"];
	switch($exp){
	case 'index':
	 get_index();
	break;
	case 'lt':
	$data=get_menu();
	list_data($data);
	break;
	case 'st':
	$data=get_show(0);
    list_data_show($data);
	break;
	case 'st10':
	$data=get_show(10);
	list_data_show($data);
	break;
	default:
	echo "生成错误";
	break;
	}
}


function get_index(){
$url='http://chinaelect.org/index.php';
$page=file_get_contents($url);
$mkname="../index.htm";
file_put_contents($mkname,$page);
//file_put_contents($mkname,chr(0xEF).chr(0xBB).chr(0xBF).$page);
echo "<br>".$url."  生成成功<br>";
}

function list_data($data){
$len=count($data);
for($i=0;$i<$len; $i++)
  makehtm($data[$i][0]);	
}
function list_data_show($data){
$len=count($data);
for($i=0;$i<$len; $i++)
  makeshow($data[$i][0],$data[$i][1]);	
}
function  makehtm($id){
$url='http://chinaelect.org/list.php?c='.$id;
$page=file_get_contents($url);
$mkname="../list".$id.".htm";
file_put_contents($mkname,$page);
//file_put_contents($mkname,chr(0xEF).chr(0xBB).chr(0xBF).$page);
echo "<br>".$url."  生成成功<br>";
}

function  makeshow($id,$cid){
$url='http://chinaelect.org/show.php?s='.$id.','.$cid;
$page=file_get_contents($url);
$mkname="../show_".$id."_".$cid.".htm";
file_put_contents($mkname,$page);
//file_put_contents($mkname,chr(0xEF).chr(0xBB).chr(0xBF).$page);
echo "<br>".$url."  生成成功<br>";
}
?>
<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
  <li><a tabindex="-1" href="make.php?a=index">首页生成</a></li>  
  <li class="divider"></li>
  <li><a tabindex="-1" href="make.php?a=lt">列表页生成</a></li>
   <li class="divider"></li>
  <li><a tabindex="-1" href="make.php?a=st10">最新10条内容页生成</a></li>
   <li class="divider"></li>
  <li><a tabindex="-1" href="make.php?a=st">内容页生成</a></li>   
</ul>		
			</div>
		</div>		
	</div>	
	<?php include_once("foot.php"); ?>	
</body>
</html>

