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
	<title>文章修改</title>
<?php 
	if($_SESSION['power']<111){ 
	echo "权限不足";
	exit();
	}
    ?>
	<!-- Mobile viewport optimization http://goo.gl/b9SaQ -->
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
			<?php
$query="select id,title,author,img, summary, content,origin,cid,fzclass from sxk_art where id=?";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("i",$vid);//【i 数值 ，s字符，d浮点型，b blobs型 】
$vid=intval($_GET["vid"]);
$stmt->execute();
$stmt->bind_result($id,$title,$author,$img,$summary,$content,$origin,$cid,$fzclass);
while($stmt->fetch()){

?>	
			<h2>文章修改</h2>

		<form action="edit_article.php?action=update&vid=<?php  echo $id;?>" class="ch-form myForm" method="POST">
			<fieldset>
				
				<div class="ch-form-row">
					<label for="input_ico">
						标题：
					</label>
					<input class="ch-form-ico-input" type="text" id="input_ico_inside" name="SXK_title" size="30" placeholder="" value=<?php  echo $title;?> >

				</div>
				<div class="ch-form-row">
					<label for="input_ico_inside">
						作者：
					</label>
					<input class="ch-form-ico-input" type="text"  name="SXK_author" size="15" placeholder=""  value=<?php echo $author;  ?> >
					
				</div>
				<div class="ch-form-row">
					<label for="input_ico_inside">
						来源：
					</label>
					<input class="ch-form-ico-input" type="text"  name="SXK_origin" size="15" value=<?php echo $origin;  ?>>
					
				</div>
				<div class="ch-form-row">
					<label for="input_ico_inside">
						分类：
					</label>
					<select id="select1" name="SXK_cid">
						<option value="-1">选择分类...</option>
							<?php  $arr= get_select(1);  child_class(0,$arr); ?>		
					</select>
					
				</div>
				<div class="ch-form-row">
					<label for="input_ico">
						图片：
					</label>
					<input class="ch-form-ico-input" type="text" name="SXK_img" size="30" placeholder="图片地址" value=<?php echo $img;  ?>><a  href="up.php" class="ch-btn ch-btn-small" target="_blank"><span id="ke-upload-button">上传文件</span></a>(图片大小：620*460)
					
				</div>
				<div class="ch-form-row">
					<label for="input_button">
						辅助分类：
					</label>					
					<input type="radio" value="1" name="SXK_fz" <?php if($fzclass==1) echo "checked"; ?>>
					<label for="radio1a">首页焦点图</label>
					<input type="radio" value="2"  name="SXK_fz" <?php if($fzclass==2) echo "checked"; ?>>
					<label for="radio1a">首页推荐</label>					
				    <input type="radio" value="3"  name="SXK_fz" <?php if($fzclass==3) echo "checked"; ?>>
					<label for="radio1a">栏目页推荐</label>	
					<input type="radio" value="4"  name="SXK_fz" <?php if($fzclass==4) echo "checked"; ?>>
					<label for="radio1a">文章页推荐</label>	
				</div>
				<div class="ch-form-row">
					<label for="textarea1">
						摘要：
					</label>
					<textarea id="textarea1" cols="80" rows="5" name="SXK_summary"  ><?php echo $summary;  ?></textarea>
				</div>
				
					
				<div class="ch-form-row">
					<label for="textarea1">
						内容：
					</label>
					<textarea id="textarea1" cols="80" rows="6" name="SXK_content"   style="width:600px;height:400px;visibility:hidden;"><?php echo $content;  ?></textarea>
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
            $("#select1 option[value='<?php echo $cid; ?>']").attr("selected",true)
			})
			   
</script>
</html>
<?php	
}
$stmt->close();
$link->close();

if($_GET["action"]=='update'){
$title=$_POST["SXK_title"];
$author=$_POST["SXK_author"];
$summary=$_POST["SXK_summary"];
$content=$_POST["SXK_content"];
$img=$_POST["SXK_img"];
$origin=$_POST["SXK_origin"];
$cid=$_POST["SXK_cid"];
$fz=$_POST["SXK_fz"];
$vid=$_GET["vid"];
	//修改
	if($_POST["SXK_title"]!="" and $_POST["SXK_content"]!=""  and $_GET["vid"]>0){
	        update_article($title,$img,$author,$summary,$content,$origin,$cid,$fz,$vid);		
			$url='http://'.$_SERVER["SERVER_NAME"].'/manage/list_article.php';
	        gourl($url);
		}else{
		echo "2修改内容失败，有内容为空";
		}
}
?>