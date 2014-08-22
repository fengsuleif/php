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
	<title>链接修改</title>
<?php 
	if($_SESSION['power']<111){ 
	echo "权限不足";
	exit();
	}
    ?>
	
	<meta name="HandheldFriendly" content="True">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="cleartype" content="on">
    <script charset="utf-8" src="js/jquery.js"></script>
	<link rel="stylesheet" href="css/reset-min-0.13.1.css">
	<link rel="stylesheet" href="css/chico-min-0.13.1.css">
	<link rel="stylesheet" href="css/mesh-min-2.1.css">
	<style>
		/**
		 * Carousel demo
		 */
		.myCarousel .ch-carousel-item {
			width: 250px;
			height: 250px;
		}

		.myCarousel img {
			max-width: 100%;
			max-height: 100%;
		}

		/* Icons demo */
		.showroomIcons {
			overflow: hidden;
		}

		.showroomIcons li{
			float:left;
			width: 33%;
			line-height: 2em;
		}

		.autoComplete {
			width: 250px;
		}

		.autoComplete2 {
			width: 350px;
		}

		.autoComplete3 {
			width: 450px;
		}

		.ch-loading-small {
			display: block;
			margin:0 auto;
		}
	</style>
	
	<link rel="stylesheet" href="editor/themes/default/default.css" />
		<script src="editor/kindeditor-min.js"></script>
		<script src="editor/lang/zh_CN.js"></script>
		<script>
			KindEditor.ready(function(K) {
				var editor = K.editor({
					allowFileManager : true
				});
				K('#image1').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							imageUrl : K('#url1').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#url1').val(url);
								editor.hideDialog();
							}
						});
					});
				});
			
				
			});
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
			<?php
$query="select id,web,link,pic, summary, type from sxk_site where id=?";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("i",$vid);//【i 数值 ，s字符，d浮点型，b blobs型 】
$vid=intval($_GET["vid"]);
$stmt->execute();
$stmt->bind_result($col1,$col2,$col3,$col4,$col5,$col6);
while($stmt->fetch()){

?>	
			<h2>修改网站链接</h2>

		<form action="edit_site.php?action=update&vid=<?php  echo $col1;?>" class="ch-form myForm" method="POST">
			<fieldset>
				
				<div class="ch-form-row">
					<label for="input_ico">
						网站名：
					</label>
					<input class="ch-form-ico-input" type="text" id="input_ico_inside" name="SXK_web" size="30" placeholder="" value=<?php  echo $col2;?> >
					
				</div>
				<div class="ch-form-row">
					<label for="input_ico_inside">
						网站链接：
					</label>
					<input class="ch-form-ico-input" type="text" id="input_ico_inside" name="SXK_link" size="30" placeholder=""  value=<?php echo $col3;  ?> >
					
				</div>
				<div class="ch-form-row">
					<label for="input_button">
						网站图片：
					</label>
					
					<input type="text" id="url1"  name="SXK_pic" value=<?php echo $col4; ?> /> <input type="button" id="image1" value="选择图片" />
					
				</div>
				
				
				<div class="ch-form-row">
					<label for="select1">
						网站类型:
					</label>
					<select id="select1" name="SXK_type">
						<option value="-1">请选择...</option>
						<option value="1">政治法律网站</option>
						<option value="2">社会经济网站</option>
						<option value="3">哲学历史网站</option>
						<option value="4">红色网站</option>
						<option value="5">人文综合网站</option>
						<option value="6">论坛搜索</option>
						<option value="7">推荐书籍</option>
					</select>
					</div>
					
				<div class="ch-form-row">
					<label for="textarea1">
						简介：
					</label>
					<textarea id="textarea1" cols="40" rows="4" name="SXK_summary"  ><?php echo $col5;  ?></textarea>
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
            $("#select1").get(0).selectedIndex=(<?php echo $col6; }?>);//设置修改内容时选取正确的分类           
            })
</script>
</html>
<?php	
$stmt->close();
$link->close();
if($_GET["action"]=='update'){
$web=$_POST["SXK_web"];
$link=$_POST["SXK_link"];
$pic=$_POST["SXK_pic"];
$summary=$_POST["SXK_summary"];
$type=$_POST["SXK_type"];
$vid=intval($_GET["vid"]);

if($_POST["SXK_web"]!="" and $_POST["SXK_link"]!="" and $_POST["SXK_pic"]!="" and $_POST["SXK_type"]!="" and $vid>0){
			update_site($web,$link,$pic,$summary,$type,$vid);
			$url='http://'.$_SERVER["SERVER_NAME"].'/manage/list_site.php';
			gourl($url);
		}else{
		echo "2修改内容失败，有内容为空";
		}
}
?>