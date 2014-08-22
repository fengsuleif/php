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
	<title>文章添加</title>

	<!-- Mobile viewport optimization http://goo.gl/b9SaQ -->
	<?php include_once("head.php"); 
	if($_SESSION['power']<111){ 
	echo "权限不足";
	exit();
	}
    ?>
		<script charset="utf-8" src="editor/kindeditor-min.js"></script>
		<script charset="utf-8" src="editor/lang/zh_CN.js"></script>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="SXK_content"]', {
					allowFileManager : true
				});
				
			});			
			
function openwin() {
           window.open("up.php", "newwindow", "height=800,width=600,toolbar=no,menubar=no,scrollbars=no,resizable=no, location=no,status=no");
           //写成一行 
       } 
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
			
			<h2>添加文章</h2>

		<form action="add_article.php?action=add" class="ch-form myForm" method="POST">
			<fieldset>
				
				<div class="ch-form-row">
					<label for="input_ico">
						标题：
					</label>
					<input class="ch-form-ico-input" type="text"  name="SXK_title" size="30" placeholder="">
					
				</div>
				<div class="ch-form-row">
					<label for="input_ico_inside">
						作者：
					</label>
					<input class="ch-form-ico-input" type="text"  name="SXK_author" size="15" placeholder="">
					
				</div>
				<div class="ch-form-row">
					<label for="input_ico_inside">
						来源：
					</label>
					<input class="ch-form-ico-input" type="text"  name="SXK_origin" size="15" placeholder="">
					
				</div>
				<div class="ch-form-row">
					<label for="input_ico_inside">
						分类：
					</label>
					<select id="select1" name="SXK_cid">
						<option value="-1">选择分类...</option>
							<?php  $arr= get_select(1); child_class(0,$arr); ?>		
					</select>					
				</div>
				<div class="ch-form-row">
					<label for="input_ico">
						图片：
					</label>
					<input class="ch-form-ico-input" type="text"  name="SXK_img" size="30" placeholder="图片大小：620*460"><a  href="#" onclick="openwin()" class="ch-btn ch-btn-small" target="_blank"><span id="ke-upload-button">上传文件</span></a>
					
				</div>
				<div class="ch-form-row">
					<label for="input_button">
						辅助分类：
					</label>					
					<input type="radio" value="1" name="SXK_fz">
					<label for="radio1a">首页焦点图</label>
					<input type="radio" value="2"  name="SXK_fz">
					<label for="radio1a">首页推荐</label>					
				    <input type="radio" value="3"  name="SXK_fz">
					<label for="radio1a">栏目页推荐</label>	
					<input type="radio" value="4"  name="SXK_fz">
					<label for="radio1a">文章页推荐</label>	
				</div>
				<div class="ch-form-row">
					<label for="textarea1">
						摘要：
					</label>
					<textarea id="textarea1" cols="80" rows="5" name="SXK_summary"></textarea>
				</div>	
					
				<div class="ch-form-row">
					<label for="textarea1">
						内容：
					</label>
					<textarea id="textarea1" cols="80" rows="6" name="SXK_content" style="width:600px;height:400px;visibility:hidden;"></textarea>
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
$title=$_POST["SXK_title"];
$author=$_POST["SXK_author"];
$summary=$_POST["SXK_summary"];
$content=$_POST["SXK_content"];
$img=$_POST["SXK_img"];
$origin=$_POST["SXK_origin"];
$fz=$_POST["SXK_fz"];
$cid=$_POST["SXK_cid"];


$dt=date("Y-m-d" ,time()) ;
if($_GET["action"]=='add'){

	if($_POST["SXK_title"]!="" and $_POST["SXK_content"]!="" ){			
			add_article($title,$img,$author,$summary,$content,$origin,$cid,$fz,$dt);
			$url='http://'.$_SERVER["SERVER_NAME"].'/manage/list_article.php';
	        gourl($url);
		}else{
		echo "2添加失败，有内容为空";
		}
}
?>