<?php
session_start();
?>
<!doctype html>
<!--[if IE 7]>	<html class="no-js  lt-ie10 lt-ie9 lt-ie8 ie7" lang="en"> <![endif]-->
<!--[if IE 8]>	<html class="no-js lt-ie10 lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9]>	<html class="no-js lt-ie10 ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
	<script></script>
	<meta charset="utf-8" />
	<title>链接管理</title>

	<!-- Mobile viewport optimization http://goo.gl/b9SaQ -->
	<?php include_once("head.php"); 
	if($_SESSION['power']<111){ 
	echo "权限不足";
	exit();
	}
    ?>
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
			<?php
			include_once("left.php");
		?>
		</div>
		<div class="ch-g3-4">
			<div class="ch-box-lite ch-rightcolumn">
			
			<table class="ch-datagrid-controls" summary="Listado de cobros en MercadoPago">
				<caption>网站列表</caption>
				<thead>
					<tr>
						<th scope="col"><input type="checkbox" name="mycheckall" id="ckall"/></th>
						<th scope="col">编号</th>
						<th scope="col">网站名</th>
						<th scope="col">网站链接</th>
					    <th scope="col">图片</th>
						<th scope="col">删除</th>
					</tr>
				</thead>
				<tbody>
				
				<?php	
function show(){
$query="select id,web,link,pic  from sxk_site where type!=100 limit 20";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->execute();
$stmt->bind_result($col1,$col2,$col3,$col4);
while($stmt->fetch()){
	echo '<tr><td scope="row"><input type="checkbox" name="mycheck" class="ckeach"/></td>';
    echo "<td>".$col1."</td>";
    echo "<td><a href='edit_site.php?vid=".$col1."'>".$col2."</a></td>";
    echo "<td>".$col3."</td>";
	echo "<td><img src=".$col4." width=93 height=140  /></td>";
	echo "<td><a href=list_site.php?action=de&do=" .$col1."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
}
$stmt->close();
$link->close();
}
function shows(){
$m=(intval($_GET["p"])-1)*20;
$n=20;
$query="select id,web,link,pic  from sxk_site where type!=100 limit ? ,?";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("ii",$m,$n);//【i 数值 ，s字符，d浮点型，b blobs型 】
$stmt->execute();
$stmt->bind_result($col1,$col2,$col3,$col4);
while($stmt->fetch()){
	echo '<tr><td scope="row"><input type="checkbox" name="mycheck" class="ckeach"/></td>';
    echo "<td>".$col1."</td>";
    echo "<td><a href='edit_site.php?vid=".$col1."'>".$col2."</a></td>";
    echo "<td>".$col3."</td>";
	echo "<td><img src=".$col4." width=93 height=140  /></td>";
	echo "<td><a href=list_site.php?action=de&do=" .$col1."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
}
$stmt->close();
$link->close();
}

require_once("Pages.php");  
  $page_size=20;  //每页显示的条数  
  $nums=get_site_num();  //总条目数   
  $sub_pages=10;  //每次显示的页数  
  $pageCurrent=$_GET["p"];  //得到当前是第几页  
  if(!$pageCurrent) $pageCurrent=1;
?>	
					<tr>
					<?php if(intval($_GET["p"])>1){shows();}else{show();} ?>
					</tr>
					
				</tbody>
			</table>
			<?php $subPages=new SubPages($page_size,$nums,$pageCurrent,$sub_pages,"list_site.php?p=",2);  ?>
			</div>
		</div>
		
	</div>	
	
<?php include_once("foot.php"); ?>
</body>
</html>
<?php

if($_GET["action"]=='de'){
$vid=intval($_GET["do"]);
	//修改
	if($vid>0){
	        del_site($vid);
			echo "1修改成功";
			$url='http://'.$_SERVER["SERVER_NAME"].'/manage/list_site.php';
	        gourl($url);
		}else{
		echo "删除内容失败";
		}
	}
?>