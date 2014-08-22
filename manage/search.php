<?php  session_start();  ?>
<!doctype html>
<!--[if IE 7]>	<html class="no-js  lt-ie10 lt-ie9 lt-ie8 ie7" lang="en"> <![endif]-->
<!--[if IE 8]>	<html class="no-js lt-ie10 lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9]>	<html class="no-js lt-ie10 ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
	<script></script>
	<meta charset="utf-8" />
	<title>用户管理</title>
	<!-- Mobile viewport optimization http://goo.gl/b9SaQ -->
	<?php include_once("head.php");   ?>
</head>
<body>

	<div class="ch-clearfix">			
		<div class="ch-g1-4">
		<?php include_once("left.php"); ?>
		</div>
		<div class="ch-g3-4">
		<div class="ch-box-lite ch-rightcolumn">
		<form action="search.php?action=S" class="ch-form myForm" method="POST">
			
				<div class="ch-form-row">					
					<input class="ch-form-ico-input" type="text" id="input_ico_inside" name="SXK_name" size="30" value="" >
					<input type="submit" name="confirmation" value="搜索" class="ch-btn">
					<i class="ch-form-ico-inner ch-icon-question-sign"></i>
				</div>
		</form>
			</div>
		
			<div class="ch-box-lite ch-rightcolumn">
			
			<table class="ch-datagrid-controls" summary="Listado de cobros en MercadoPago">
				<caption>人员列表</caption>
				<thead>
					<tr>
						<th scope="col"><input type="checkbox" name="mycheckall"/></th>
						<th scope="col">编号</th>
						<th scope="col">姓名</th>
						<th scope="col">邮箱</th>
					    <th scope="col">电话</th>
						 <th scope="col">删除</th>
					</tr>
				</thead>
				<tbody>				
<?php	

include_once("config2.php");
function show(){
$link = MysqliDb::OpenDB();
$L_name="%".$_POST["word"]."%";

if($_SESSION['power']==1){

$query="select id,name,mail,phone from sxk_person where stat!=100 and info=1 and rt=? and name like ?";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("ss",$_COOKIE['SXK2013'],$L_name);//【i 数值 ，s字符，d浮点型，b blobs型 】
}else if($_SESSION['power']==11){

$query="select id,name,mail,phone from sxk_person where stat!=100 and info=1 and name like ?";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("s",$L_name);
}else if($_SESSION['power']==1111){
$query="select id,name,mail,phone from sxk_person where stat!=100  and name like ?";

$stmt=$link->prepare($query);//预处理
$stmt->bind_param("s",$L_name);//【i 数值 ，s字符，d浮点型，b blobs型 】
}
$stmt->execute();
$stmt->bind_result($col1,$col2,$col3,$col4);
while($stmt->fetch()){
	 echo '<tr><td scope="row"><input type="checkbox" name="mycheck"/></td>';
    echo "<td>".$col1."</td>";
    echo "<td><a href='edit_person.php?vid=".$col1."'>".$col2."</a></td>";
    echo "<td>".$col3."</td>";
	echo "<td>".$col4."</td>";
	echo "<td><a href=list_person.php?action=de&do=" .$col1."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
	}
$stmt->close();

}



function shows(){
$link = MysqliDb::OpenDB();
$L_name="%".$_POST["word"]."%";
$m=(intval($_GET["p"])-1)*20;
$n=20;

if($_SESSION['power']==1){

$query="select id,name,mail,phone from sxk_person where stat!=100 and info=1 and rt=? and name like ? limit ?,?";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("ssii",$_COOKIE['SXK2013'],$L_name,$m,$n);//【i 数值 ，s字符，d浮点型，b blobs型 】
}else if($_SESSION['power']==11){
$query="select id,name,mail,phone from sxk_person where stat!=100 and info=1 and name like ? limit ?,?";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("sii",$L_name,$m,$n);
}else if($_SESSION['power']==1111){
$query="select id,name,mail,phone from sxk_person where stat!=100 and info=1 and name like ? limit ?,?";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("sii",$L_name,$m,$n);//【i 数值 ，s字符，d浮点型，b blobs型 】
}

$stmt->execute();

$stmt->bind_result($col1,$col2,$col3,$col4);
while($stmt->fetch()){
	echo '<tr><td scope="row"><input type="checkbox" name="mycheck"/></td>';
    echo "<td>".$col1."</td>";
    echo "<td><a href='edit_person.php?vid=".$col1."'>".$col2."</a></td>";
    echo "<td>".$col3."</td>";
	echo "<td>".$col4."</td>";
	echo "<td><a href=list_person.php?action=de&do=" .$col1."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
	}
$stmt->close();

}


//分页获取总页数方法2 一般来说2比1快的多
function showx(){
$link = MysqliDb::OpenDB();
$L_name="%".$_POST["word"]."%";
$query="select count(*) from sxk_person where stat!=100 and info=1 and name like ?" ;
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("s",$L_name);//【i 数值 ，s字符，d浮点型，b blobs型 】
$stmt->execute();
$stmt->bind_result($col1);
while($stmt->fetch()){
	$ap=$col1;
}
$stmt->close();

return $ap;MysqliDb::CloseDB(null, $link);
}

  require_once("Pages.php");  
  $page_size=20;  //每页显示的条数  
  $nums=showx();  //总条目数   
  $sub_pages=10;  //每次显示的页数  
  $pageCurrent=$_GET["p"];  //得到当前是第几页  
  if(!$pageCurrent) $pageCurrent=1;  
?>	
					<tr>
					<?php if(intval($_GET["p"])>1){shows();}else{show();} ?>
					</tr>
					
				</tbody>
			</table>
			<?php $subPages=new SubPages($page_size,$nums,$pageCurrent,$sub_pages,"search.php?p=",2);  ?>
			</div>
		</div>
		
	</div>
	
	
	<?php include_once("foot.php"); ?>
	<?php include_once("del_person.php"); ?>
</body>
</html>
