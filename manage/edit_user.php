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
$query="select id,name,mail,power from sxk_admin where id=?";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("i",$vid);//【i 数值 ，s字符，d浮点型，b blobs型 】
$vid=intval($_GET["vid"]);
$stmt->execute();
$stmt->bind_result($col1,$col2,$col3,$col4);
while($stmt->fetch()){

?>	
			<h2>用户管理</h2>

		<form action="edit_user.php?action=update&vid=<?php  echo $col1;?>" class="ch-form myForm" method="POST">
			<fieldset>
				
				<div class="ch-form-row">
					<label for="input_ico">
						用户名：
					</label>
					<input class="ch-form-ico-input" type="text" id="input_name" name="SXK_name" size="30" placeholder="" value=<?php  echo $col2;?> >
					
				</div>
				<div class="ch-form-row">
					<label for="input_ico_inside">
						密码：
					</label>
					<input class="ch-form-ico-input" type="password" id="input_pw" name="SXK_pw1" size="30" placeholder=""  value="" >
					
				</div>
				<div class="ch-form-row">
					<label for="input_button">
						密码确认：
					</label>					
					<input class="ch-form-ico-input" type="password" id="input_rpw" name="SXK_pw2" size="30" placeholder=""  value="" >
										
				</div>
				
				<div class="ch-form-row">
					<label for="input_ico">
						邮箱：
					</label>
					<input class="ch-form-ico-input" type="text" id="input_mail" name="SXK_mail" size="30" placeholder="" value=<?php  echo $col3;?> >
					
				</div>
				<?php
				function echo_select($n){

						switch ($n)
						{
							
							case 11:
								echo       "<option value=\"11\">联系人管理</option>";						
								break;
							case 111:
								//echo       "<option value=\"11\">联系人管理</option>";
								echo       "<option value=\"111\">后台编辑</option>";
								break;
							case 1111:
								 echo       "<option value=\"11\">联系人管理</option>";
								 echo       "<option value=\"111\">后台编辑</option>";
								 echo       "<option value=\"1111\">管理员</option>";
								break;
							default:
								echo "";
					}
				}
				?>
				<div class="ch-form-row">
					<label for="select1">
						用户权限:
					</label>
					<select id="select1" name="SXK_power">
						<option value="0">请选择...</option>
						<option value="1">基本权限</option>
								<?php echo_select($_COOKIE['SXK2015']); ?>			
					</select>
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
<?php
function get_index($n){
	switch ($n)
	{
		case 1:
			echo "1";
			break;
		case 11:
			echo "2";
			break;
		case 111:
			echo "3";
			break;
	    case 1111:
			echo "4";
			break;
		default:
			echo "1";
    }
}
?>
<script type="text/javascript">
	       $(document).ready(function () {
            $("#select1").get(0).selectedIndex=(<?php get_index($col4); }
									$stmt->close(); $link->close();  ?>);//设置修改内容时选取正确的分类           
            })
</script>
</html>
<?php	
if($_GET["action"]=='update'){
$name=$_POST["SXK_name"];
$pw1=$_POST["SXK_pw1"];
$pw2=$_POST["SXK_pw2"];
$mail=$_POST["SXK_mail"];
$power=$_POST["SXK_power"];
$vid=intval($_GET["vid"]);

if($_POST["SXK_name"]!="" and $pw1==$pw2  and $vid>0){
$mpw=md5($pw1);
			update_user($name,$mpw,$mail,$power,$vid);
			$url='http://'.$_SERVER["SERVER_NAME"].'/manage/list_user.php';
			gourl($url);
		}else{
		echo "2修改失败，用户名为空或两次密码不匹配";
		}	
}
?>