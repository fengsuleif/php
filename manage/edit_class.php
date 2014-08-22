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
			<?php
$data=edit_class_data(intval($_GET["vid"]));
?>	
			<h2>分类管理</h2>
		<form action="edit_class.php?action=update&vid=<?php  echo $data[0] ;?>" class="ch-form myForm" method="POST">
			<fieldset>				
				<div class="ch-form-row">
					<label for="input_ico">
						分类名称：
					</label>
					<input class="ch-form-ico-input" type="text" id="input_name" name="SXK_class" size="30" value="<?php echo $data[1] ;  ?>"  >
				</div>
			
				<div class="ch-form-row">
					<label for="select1">
						父级分类:
					</label>
					<select id="select1" name="SXK_pid">
						<option value="0">根分类</option>						
							<?php  $arr= get_select(0);  child_class(0,$arr); ?>		
					</select>
					</div>			
			<div class="ch-form-row">
					<label for="input_button">
						是否单页面：
					</label>					
					<input type="radio" value="0"  name="SXK_page" <?php if($data[4]==0) echo "checked"; ?>>
					<label for="radio1a">单页面</label>
					<input type="radio" value="1"  name="SXK_page" <?php if($data[4]==1) echo "checked"; ?>>
					<label for="radio1a">分类页</label>					
				</div>
				
				<div class="ch-form-row">
					<label for="input_ico">
						状态：
					</label>
					<input type="radio" value="0"  name="SXK_stat" <?php if($data[3]==0) echo "checked"; ?>>
					<label for="radio1a">禁用</label>		
					<input type="radio" value="1"  name="SXK_stat" <?php if($data[3]==1) echo "checked"; ?> >
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

<script type="text/javascript">
	       $(document).ready(function () {
            //$("#select1").get(0).selectedIndex=();//设置修改内容时选取正确的分类           
            $("#select1 option[value='<?php echo $data[2]; ?>']").attr("selected",true)
			})
			   
</script>
</html>
<?php	
if($_GET["action"]=='update'){
$class=$_POST["SXK_class"];//$_GET["UserName"];
$pid=$_POST["SXK_pid"];
$page=$_POST["SXK_page"];
$stat=$_POST["SXK_stat"];
$vid=intval($_GET["vid"]);
if($_POST["SXK_class"]!="" and $vid>0){
	if( $vid!=$_POST["SXK_pid"]){
			update_class($class,$pid,$page,$stat,$vid);
			$url='http://'.$_SERVER["SERVER_NAME"].'/manage/list_class.php';
			gourl($url);
			}else{echo "不能循环分类";}
		}else{
		echo "2修改失败，用户名为空或两次密码不匹配";
		}	
}
?>