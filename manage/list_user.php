<?php
session_start();
?>
<!doctype html>
<!--[if IE 7]>	<html class="no-js  lt-ie10 lt-ie9 lt-ie8 ie7" lang="en"> <![endif]-->
<!--[if IE 8]>	<html class="no-js lt-ie10 lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9]>	<html class="no-js lt-ie10 ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
	<title>用户管理</title>	
	<?php include_once("head.php");   ?>
	<script type="text/javascript">
	 $(document).ready(function () {
            
           $("#ckall").click(function(){
		   if(this.checked){
		   $(".ckeach").attr("checked",true);}
		   else{
		   $(".ckeach").attr("checked",false);}
		   });
		   
			})
	</script>
</head>
<body>
	<div class="ch-clearfix">
		<div class="ch-g1-4">
			<?php include_once("left.php"); ?>
		</div>
		<div class="ch-g3-4">
			<div class="ch-box-lite ch-rightcolumn">
			
			<table class="ch-datagrid-controls" summary="Listado de cobros en MercadoPago">
				<caption>用户列表</caption>
				<thead>
					<tr>
						<th scope="col"><input type="checkbox" name="mycheckall" id="ckall"/></th>
						<th scope="col">编号</th>
						<th scope="col">用户名</th>
						<th scope="col">邮箱</th>
					    <th scope="col">时间</th>
						<?php if($_SESSION['power']==1111)  {echo "<th scope=\"col\">管理</th>";}  ?>
					</tr>
				</thead>
				<tbody>
				
				<?php
function show(){
$link = MysqliDb::OpenDB();
$query="select id,name,mail,regdate  from sxk_admin  ";
$stmt=$link->prepare($query);//预处理
//$stmt->bind_param("ss",$username,md5($pass));//【i 数值 ，s字符，d浮点型，b blobs型 】
$stmt->execute();
$stmt->bind_result($col1,$col2,$col3,$col4);
while($stmt->fetch()){
	echo '<tr><td scope="row"><input type="checkbox" name="mycheck" class="ckeach"/></td>';
    echo "<td>".$col1."</td>";
    echo "<td><a href='edit_user.php?vid=".$col1."'>".$col2."</a></td>";
    echo "<td>".$col3."</td>";
	echo "<td>".$col4."</td>";
	if($_SESSION['power']==1111)  {echo "<td><a href='edit_user.php?vid=".$col1."' class=\"ch-btn ch-btn-small ch-icon-pencil\" >Edit</a> <a href=list_user.php?action=de&do=".$col1."  class=\"ch-btn ch-btn-small ch-icon-trash\" > delete</a></td></tr>";}else{echo "<tr>";}
}
$stmt->close();
$link->close();
}

function showsingle(){
$link = MysqliDb::OpenDB();
$query="select id,name,mail,regdate  from sxk_admin where name=?";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("s",$_COOKIE['SXK2013']);
$stmt->execute();
$stmt->bind_result($col1,$col2,$col3,$col4);
while($stmt->fetch()){
	echo '<tr><td scope="row"><input type="checkbox" name="mycheck" class="ckeach"/></td>';
    echo "<td>".$col1."</td>";
    echo "<td><a href='edit_user.php?vid=".$col1."'>".$col2."</a></td>";
    echo "<td>".$col3."</td>";
	echo "<td>".$col4."</td>";
	if($_SESSION['power']==1111)  {echo "<td><a href='edit_user.php?vid=".$col1."' class=\"ch-btn ch-btn-small ch-icon-pencil\" >Edit</a> <a href=list_user.php?action=de&do=".$col1."  class=\"ch-btn ch-btn-small ch-icon-trash\" > delete</a></td></tr>";}else{echo "<tr>";}
}
$stmt->close();
$link->close();
}
?>
					<tr>
					<?php if ($_COOKIE['SXK2015']>111){show();}else{ showsingle();} ?>
					</tr>
					
				</tbody>
			</table>
			
			</div>
		</div>
		
	</div>	
	<?php include_once("foot.php"); ?>	
</body>
</html>
<?php
$vid=intval($_GET["do"]);
if($_GET["action"]=='de' and $vid>1){
del_user($vid);
$url='http://'.$_SERVER["SERVER_NAME"].'/manage/list_user.php';	        
gourl($url);			
}
?>
