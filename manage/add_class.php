<?php
session_start();
?>
<!doctype html>
<!--[if IE 7]>	<html class="no-js  lt-ie10 lt-ie9 lt-ie8 ie7" lang="en"> <![endif]-->
<!--[if IE 8]>	<html class="no-js lt-ie10 lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9]>	<html class="no-js lt-ie10 ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
	
	<title>分类管理</title>
	<?php include_once("head.php");   ?>
	
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
	
			<h2>分类管理</h2>
		<form action="add_class.php?action=add" class="ch-form myForm" method="POST">
			<fieldset>				
				<div class="ch-form-row">
					<label for="input_ico">
						分类名称：
					</label>
					<input class="ch-form-ico-input" type="text" id="input_name" name="SXK_class" size="30" placeholder=""  >
				</div>
				<div class="ch-form-row">
					<label for="select1">
						父级分类:
					</label>
					<select id="select1" name="SXK_pid">
						<option value="0">根分类</option>						
								<?php  $arr= get_select(1);  child_class(0,$arr); ?>				
					</select>
					</div>	
				<div class="ch-form-row">
					<label for="input_button">
						是否单页面：
					</label>					
					<input type="radio" value="0" name="SXK_page">
					<label for="radio1a">单页面</label>
					<input type="radio" value="1"  name="SXK_page" checked>
					<label for="radio1a">分类页</label>					
				</div>
				
				<div class="ch-form-row">
					<label for="input_ico">
						状态：
					</label>
					<input type="radio" value="0"  name="SXK_stat">
					<label for="radio1a">禁用</label>		
					<input type="radio" value="1"  name="SXK_stat" checked>
				    <label for="radio1a">启用</label>	
					
				
				</div>												
			
				<div class="ch-form-actions">
					<input type="submit" name="confirmation" value="提交" class="ch-btn">					
				</div>
				</div>	
			
			</div>			
			</div>		
		
	</div>
<?php include_once("foot.php"); ?>
</body>

</html>
<?php	

$class=new_addslashes($_POST["SXK_class"]);
$pid=$_POST["SXK_pid"];
$page=$_POST["SXK_page"];
$stat=$_POST["SXK_stat"];
$dt=date("Y-m-d H:i:s" ,time()) ;
if($_GET["action"]=='add'){ 
	if(class_in($class)){   
			add_class($class,$pid,$dt,$page,$stat);
			$url='http://'.$_SERVER["SERVER_NAME"].'/manage/list_class.php';
	        gourl($url);
	}else{ echo "0添加分类失败，分类已存在。";}	

}

?>