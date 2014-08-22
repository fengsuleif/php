<?php
session_start();
?>
<!doctype html>
<!--[if IE 7]>	<html class="no-js  lt-ie10 lt-ie9 lt-ie8 ie7" lang="en"> <![endif]-->
<!--[if IE 8]>	<html class="no-js lt-ie10 lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9]>	<html class="no-js lt-ie10 ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>分类管理</title>	
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
	function get_c(elem,event){	
	 if (!confirm("你确认要删除["+$(elem).attr("title")+"]吗？")){return false;};
  }

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
				<caption>分类列表</caption>
				<thead>
					<tr>
						<th scope="col"><input type="checkbox" name="mycheckall" id="ckall" /></th>
						<th scope="col">编号</th>
						<th scope="col">类名称</th>
						<th scope="col">父ID</th>
						<th scope="col">状态</th>
					    <th scope="col">时间</th>
						<?php if($_SESSION['power']==1111)  {echo "<th scope=\"col\">管理</th>";}  ?>
					</tr>
				</thead>
				<tbody>
				
				<?php
function show(){
$link = MysqliDb::OpenDB();
$query="select id,class,pid,stat,dt  from sxk_class where stat!=100  ";
$stmt=$link->prepare($query);//预处理
//$stmt->bind_param("ss",$username,md5($pass));//【i 数值 ，s字符，d浮点型，b blobs型 】
$stmt->execute();
$stmt->bind_result($col1,$col2,$col3,$col4,$col5);
while($stmt->fetch()){
	echo '<tr><td scope="row"><input type="checkbox" name="mycheck" class="ckeach"/></td>';
    echo "<td>".$col1."</td>";
    echo "<td><a href='edit_class.php?vid=".$col1."'>".$col2."</a></td>";
    echo "<td>".$col3."</td>";
	if($col4==1){
	echo "<td>启用</td>";
	}else{
	echo "<td>禁用</td>";}
	echo "<td>".$col5."</td>";
	if($_SESSION['power']==1111)  {echo "<td><a href='edit_class.php?vid=".$col1."' class=\"ch-btn ch-btn-small ch-icon-pencil\" >Edit</a> <a href=list_class.php?action=de&do=".$col1."  class=\"ch-btn ch-btn-small ch-icon-trash\" title=".$col2." onclick=\"return get_c(this,event);\" > delete</a></td></tr>";}else{echo "<tr>";}
}
$stmt->close();
$link->close();
}
?>
					<tr>
					<?php if ($_COOKIE['SXK2015']>111){show();}else{ echo "权限不足";} ?>
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
			if($_SESSION['power']==1111){
			del_class($vid);
			}			
			$url='http://'.$_SERVER["SERVER_NAME"].'/manage/list_class.php';	        
			gourl($url);			
		}
?>
