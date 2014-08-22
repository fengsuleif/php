<?php
ini_set("display_errors",0);
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
			<form action="list_comment.php?action=S" class="ch-form myForm" method="POST"  >
			
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
						<th scope="col">邮箱</th>
						<th scope="col">分类</th>
						<th scope="col">评论</th>					    
						<th scope="col">编辑</th>
					</tr>
				</thead>
				<tbody>
				
				<?php

function show($array){
$link = MysqliDb::OpenDB();
$query="select id,cid,email,the_mesage,stat from sxk_comment  order by id desc";
$stmt=$link->prepare($query);//预处理
$stmt->execute();
$stmt->bind_result($id,$cid,$email,$the_mesage,$stat);
while($stmt->fetch()){
	echo '<tr data="'.$cid.'"><td scope="row"><input type="checkbox" name="mycheck" class="ckeach" /></td>';
    echo "<td>".$id."</td>";
    echo "<td><a href='#?vid=".$id."'>".$email."</a></td>";
	echo "<td ><a href='#' onclick='get_c(this,event)' data=".$cid." class='dc' >".$array[$cid]."</a></td>";
    echo "<td><div style='width:320px;height:auto;'>".$the_mesage."<div></td>";
	if($stat!=100){
	echo "<td style='width:140px;height:auto;'> <a href=list_comment.php?action=ok&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-ok\" > 通过</a>    <a href=list_comment.php?action=de&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
}else{
	echo "<td style='width:140px;height:auto;'>   <a href=list_comment.php?action=de&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
}
	}
$stmt->close();
$link->close();
}

function shows($array){
$m=(intval($_GET["p"])-1)*20;
$n=20;
$query="select id,cid,email,the_mesage,stat from sxk_comment  order by id desc limit ?,?";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("ii",$m,$n);
$stmt->execute();
$stmt->bind_result($id,$cid,$email,$the_mesage,$stat);
while($stmt->fetch()){
	echo '<tr data="'.$cid.'"><td scope="row"><input type="checkbox" name="mycheck" class="ckeach" /></td>';
    echo "<td>".$id."</td>";
    echo "<td><a href='#?vid=".$id."'>".$email."</a></td>";
	echo "<td ><a href='#' onclick='get_c(this,event)' data=".$cid." class='dc' >".$array[$cid]."</a></td>";
    echo "<td><div style='width:320px;height:auto;'>".$the_mesage."<div></td>";
	if($stat!=100){
	echo "<td style='width:140px;height:auto;'> <a href=list_comment.php?action=ok&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-ok\" > 通过</a>    <a href=list_comment.php?action=de&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
}else{
	echo "<td style='width:140px;height:auto;'>   <a href=list_comment.php?action=de&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
}
	}
$stmt->close();
$link->close();
}


function showWid($array,$wid){
$link = MysqliDb::OpenDB();
$query="select id,cid,email,the_mesage,stat from sxk_comment where aid=?  order by id desc";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("i",$wid);
$stmt->execute();
$stmt->bind_result($id,$cid,$email,$the_mesage,$stat);
while($stmt->fetch()){
	echo '<tr data="'.$cid.'"><td scope="row"><input type="checkbox" name="mycheck" class="ckeach" /></td>';
    echo "<td>".$id."</td>";
    echo "<td><a href='#?vid=".$id."'>".$email."</a></td>";
	echo "<td ><a href='#' onclick='get_c(this,event)' data=".$cid." class='dc' >".$array[$cid]."</a></td>";
    echo "<td><div style='width:320px;height:auto;'>".$the_mesage."<div></td>";
	if($stat!=100){
	echo "<td style='width:140px;height:auto;'> <a href=list_comment.php?action=ok&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-ok\" > 通过</a>    <a href=list_comment.php?action=de&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
}else{
	echo "<td style='width:140px;height:auto;'>   <a href=list_comment.php?action=de&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
}
	}
$stmt->close();
$link->close();
}


function showWids($array,$wid){
$m=(intval($_GET["p"])-1)*20;
$n=20;
$query="select id,cid,email,the_mesage,stat from sxk_comment  where aid=?  order by id desc limit ?,?";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("iii",$wid,$m,$n);
$stmt->execute();
$stmt->bind_result($id,$cid,$email,$the_mesage,$stat);
while($stmt->fetch()){
	echo '<tr data="'.$cid.'"><td scope="row"><input type="checkbox" name="mycheck" class="ckeach" /></td>';
    echo "<td>".$id."</td>";
    echo "<td><a href='#?vid=".$id."'>".$email."</a></td>";
	echo "<td ><a href='#' onclick='get_c(this,event)' data=".$cid." class='dc' >".$array[$cid]."</a></td>";
    echo "<td><div style='width:320px;height:auto;'>".$the_mesage."<div></td>";
	if($stat!=100){
	echo "<td style='width:140px;height:auto;'> <a href=list_comment.php?action=ok&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-ok\" > 通过</a>    <a href=list_comment.php?action=de&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
}else{
	echo "<td style='width:140px;height:auto;'>   <a href=list_comment.php?action=de&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
}
	}
$stmt->close();
$link->close();
}



function search($array){
$L_name="%".$_POST["SXK_name"]."%";
$link = MysqliDb::OpenDB();
$query="select id,cid,email,the_mesage,stat from sxk_comment where  email like ?  or the_mesage like ? order by id desc";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("ss",$L_name,$L_name);
$stmt->execute();
$stmt->bind_result($id,$cid,$email,$the_mesage,$stat);
while($stmt->fetch()){
	echo '<tr data="'.$cid.'"><td scope="row"><input type="checkbox" name="mycheck" class="ckeach" /></td>';
    echo "<td>".$id."</td>";
    echo "<td><a href='#?vid=".$id."'>".$email."</a></td>";
	echo "<td ><a href='#' onclick='get_c(this,event)' data=".$cid." class='dc' >".$array[$cid]."</a></td>";
    echo "<td><div style='width:320px;height:auto;'>".$the_mesage."<div></td>";
	if($stat!=100){
	echo "<td style='width:140px;height:auto;'> <a href=list_comment.php?action=ok&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-ok\" > 通过</a>    <a href=list_comment.php?action=de&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
}else{
	echo "<td style='width:140px;height:auto;'>   <a href=list_comment.php?action=de&do=" .$id."  class=\"ch-btn ch-btn-small ch-icon-remove\" > delete</a></td></tr>";
}
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
					
					<?php 	

					if ($_GET["action"]=="S"){search($g_hash); }
					if(intval($_GET["w"])>0 && !isset($_GET["p"])){showWid($g_hash,intval($_GET["w"]));}
					if(intval($_GET["w"])>0 && intval($_GET["p"])>=1){showWids($g_hash,intval($_GET["w"]));}
					if(intval($_GET["p"])>=1 &&  !isset($_GET["w"])){ shows($g_hash);}
					if(empty($_SERVER["QUERY_STRING"])){show($g_hash);}
					?>
					
					
				</tbody>
			</table>
			<?php 
			if ($_GET["action"]!="S" && !isset($_GET["w"])){$subPages=new SubPages($page_size,$nums,$pageCurrent,$sub_pages,"list_comment.php?p=",2);}  
			if (intval($_GET["w"])>0 ){$subPages=new SubPages($page_size,$nums,$pageCurrent,$sub_pages,"list_comment.php?w=".intval($_GET["w"])."&p=",2 );} 
			?>
			</div>
		</div>
		
	</div>
	
<?php include_once("foot.php"); ?>
</body>
</html>
<?php
if(isset($_GET["action"])){
exec_cmd($_GET["action"]);
}

function exec_cmd($action){
$msg="命令执行成功";
$vid=intval($_GET["do"]);	
if($vid>0){
if($action=="ok"){	ok_comment($vid);}
if($action=="de"){del_comment($vid);}	
	gourl(php_self());
}else{		echo $msg;	}

}
?>
