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
	<title>文章管理</title>
	<script charset="utf-8" src="js/jquery.js"></script>
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
	//alert($(elem).attr("data"));
	var cid=$(elem).attr("data");
	$("#wzx  tr[data!="+cid+"]").not("#wzx thead tr").hide();	
    $("#wzx  tr[data="+cid+"]").show();
}

function get_a(elem,event){
    $("#wzx  tr").show();
}

function check_del(elem,event){	
	 if (!confirm("你确认要删除["+$(elem).attr("title")+"]吗？")){return false;};
  }
	</script>
	
	<?php include_once("head.php"); 
	if($_SESSION['power']<111){ 
	echo "权限不足";
	exit();
	}
    ?>
</head>
<body>

	<div class="ch-clearfix">			
		<div class="ch-g1-4">
			<?php
			include_once("left.php");
		?>
		</div>
		<div class="ch-g3-4">
		<div class="ch-box-lite">
			<table width="95%">				
					<tr>
						<td>
						<h3 style="display:inline;float:left;">筛选： </h3>
			<?php
			$g_hash=get_c_i();
			echo '<a class="ch-btn-skin ch-btn-small" onclick="get_a(this,event)" >全部</a>   ';
			foreach($g_hash as $key=>$value){
			
			echo '<a class="ch-btn-skin ch-btn-small" onclick="get_c(this,event)" data='.$key.'>'.$value.'</a>   ';
			}
			?></td><td width="40%">
			<form action="list_article.php?action=S" class="ch-form myForm" method="POST"  >
			
				<div class="ch-form-row">					
					<input class="ch-form-ico-input" type="text"  name="SXK_name" size="30" >
					<input type="submit" name="confirmation" value="搜索" class="ch-btn">					
				</div>
		</form>
			</td>
					</tr>
			</table>
			
		
	
			</div>
			<div class="ch-box-lite ch-rightcolumn">			
		<table class="ch-datagrid-controls" summary="Listado de cobros en MercadoPago" id="wzx">
				<caption>文章列表</caption>
				<thead>				
					<tr>
						<th scope="col"><input type="checkbox" name="mycheckall" id="ckall"/></th>
						<th scope="col">编号</th>
						<th scope="col">标题</th>
						<th scope="col">分类</th>
						<th scope="col">作者</th>
						<th scope="col">评论</th>
					    <th scope="col">时间</th>
						<th scope="col">编辑</th>
					</tr>
				</thead>
				<tbody>
				
				<?php
function show($array){
$link = MysqliDb::OpenDB();
$query="select id,title,author,dt ,cid from sxk_art where stat !=100 order by id desc";
$stmt=$link->prepare($query);//预处理
$stmt->execute();
$stmt->bind_result($col1,$col2,$col3,$col4,$cid);
while($stmt->fetch()){
	echo '<tr data="'.$cid.'"><td scope="row"><input type="checkbox" name="mycheck" class="ckeach" /></td>';
    echo "<td>".$col1."</td>";
    echo "<td style=\"width:240px;\"><a href='edit_article.php?vid=".$col1."'>".$col2."</a></td>";
	echo "<td ><a href='#' onclick='get_c(this,event)' data=".$cid." class='dc' >".$array[$cid]."</a></td>";
    echo "<td>".$col3."</td>";
    echo "<td><a href=list_comment.php?w=".$col1."><i class='ch-icon-comments'></i></a></td>";
	echo "<td>".$col4."</td>";
	echo "<td><a href=edit_article.php?vid=".$col1."  class=\"ch-btn ch-btn-small ch-icon-pencil\" > Edit</a>  <a href=list_article.php?action=de&do=" .$col1."  class=\"ch-btn ch-btn-small ch-icon-remove\"   title=".$col2." onclick=\"return check_del(this,event);\"> delete</a></td></tr>";
}
$stmt->close();
$link->close();
}

function shows($array){
$m=(intval($_GET["p"])-1)*20;
$n=20;
$query="select id,title,author,dt ,cid from sxk_art where stat !=100 order by id desc limit ?,?";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("ii",$m,$n);
$stmt->execute();
$stmt->bind_result($col1,$col2,$col3,$col4,$cid);
while($stmt->fetch()){
	echo '<tr data="'.$cid.'" ><td scope="row"><input type="checkbox" name="mycheck" class="ckeach"/></td>';
    echo "<td>".$col1."</td>";
    echo "<td style=\"width:240px;\"><a href='edit_article.php?vid=".$col1."'>".$col2."</a></td>";
	echo "<td ><a href='#' onclick='get_c(this,event)' data=".$cid." class='dc' >".$array[$cid]."</a></td>";
    echo "<td>".$col3."</td>";
	echo "<td><a href=list_comment.php?w=".$col1."><i class='ch-icon-comments'></i></a></td>";
	echo "<td>".$col4."</td>";
echo "<td><a href=edit_article.php?vid=".$col1."  class=\"ch-btn ch-btn-small ch-icon-pencil\" > Edit</a>  <a href=list_article.php?action=de&do=" .$col1."  class=\"ch-btn ch-btn-small ch-icon-remove\" title=".$col2." onclick=\"return check_del(this,event);\"> delete</a></td></tr>";
}
$stmt->close();
$link->close();
}

function search($array){
$L_name="%".$_POST["SXK_name"]."%";
$link = MysqliDb::OpenDB();
$query="select id,title,author,dt ,cid from sxk_art where stat !=100 and title like ?  order by id desc";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("s",$L_name);
$stmt->execute();
$stmt->bind_result($col1,$col2,$col3,$col4,$cid);
while($stmt->fetch()){
	echo '<tr data="'.$cid.'"><td scope="row"><input type="checkbox" name="mycheck" class="ckeach" /></td>';
    echo "<td>".$col1."</td>";
    echo "<td style=\"width:240px;\"><a href='edit_article.php?vid=".$col1."'>".$col2."</a></td>";
	echo "<td ><a href='#' onclick='get_c(this,event)' data=".$cid." class='dc' >".$array[$cid]."</a></td>";
    echo "<td>".$col3."</td>";
	echo "<td><a href=list_comment.php?w=".$col1."><i class='ch-icon-comments'></i></a></td>";
	echo "<td>".$col4."</td>";
	echo "<td><a href=edit_article.php?vid=".$col1."  class=\"ch-btn ch-btn-small ch-icon-pencil\" > Edit</a>  <a href=list_article.php?action=de&do=" .$col1."  class=\"ch-btn ch-btn-small ch-icon-remove\" title=".$col2." onclick=\"return check_del(this,event);\"> delete</a></td></tr>";
}
$stmt->close();
$link->close();
}
require_once("Pages.php");  
  $page_size=20;  //每页显示的条数  
  $nums=get_art_num();  //总条目数   
  $sub_pages=10;  //每次显示的页数  
  $pageCurrent=$_GET["p"];  //得到当前是第几页  
  if(!$pageCurrent) $pageCurrent=1;  
?>	
					<tr>
					<?php	
					if(empty($_SERVER["QUERY_STRING"])){show($g_hash);}	
					if(intval($_GET["p"])>=1){ shows($g_hash);}
					if ($_GET["action"]=="S"){search($g_hash); }
					 
					?>
					</tr>
					
				</tbody>
			</table>
			<?php $subPages=new SubPages($page_size,$nums,$pageCurrent,$sub_pages,"list_article.php?p=",2);  ?>
			</div>
		</div>
		
	</div>
	
<?php include_once("foot.php"); ?>
</body>
</html>
<?php
$vid=intval($_GET["do"]);
if($_GET["action"]=='de'){	
	if($vid>0){
	del_article($vid);			
	$url='http://'.$_SERVER["SERVER_NAME"].'/manage/list_article.php';
	gourl($url);
}else{		echo "删除内容失败";	}
}
?>
