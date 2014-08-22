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
	<title>用户管理</title>	
	<?php include_once("head.php");   ?>
</head>
<body>
<div class="ch-box-lite">
<form action="" enctype="multipart/form-data" method="post" name="uploadfile" class="ch-form">
上传文件：<input type="file" name="upfile" class="ch-btn "/> 
<input type="submit" value="上传" class="ch-btn " /></form> 
</div>
<?php 
if(is_uploaded_file($_FILES['upfile']['tmp_name'])){ 
$upfile=$_FILES["upfile"]; //获取数组里面的值 
$name=$upfile["name"];//上传文件的文件名 
$type=$upfile["type"];//上传文件的类型 
$size=$upfile["size"];//上传文件的大小 
$tmp_name=$upfile["tmp_name"];//上传文件的临时存放路径 
//判断是否为图片 
switch ($type){ 
case 'image/pjpeg':$okType=true; 
break; 
case 'image/jpeg':$okType=true; 
break; 
case 'image/gif':$okType=true; 
break; 
case 'image/png':$okType=true; 
break; 
} 

if($okType){ 
/** 
* 0:文件上传成功<br/> 
* 1：超过了文件大小，在php.ini文件中设置<br/> 
* 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/> 
* 3：文件只有部分被上传<br/> 
* 4：没有文件被上传<br/> 
* 5：上传文件大小为0 
*/ 
$error=$upfile["error"];//上传后系统返回的值 
echo "<div class=\"ch-box-lite\">"; 
echo "上传文件名称是：".$name."<br/>"; 
echo "上传文件类型是：".$type."<br/>"; 
echo "上传文件大小是：". ceil($size/1024). "KB<br/>"; 
echo "上传后系统返回的值是：".$error."<br/>"; 
echo "上传文件的临时存放路径是：".$tmp_name."</div>"; 

$newname=date("YmdHis" ,time()) ;//把上传的临时文件移动到上传目录下面 
$destination="editor/attached/image/".$newname.".".pathinfo($name ,PATHINFO_EXTENSION);
move_uploaded_file($tmp_name,$destination); 

echo "<div class=\"ch-box-information\"><h2>上传信息：</h2>"; 
if($error==0){ 
echo "<p>文件上传成功啦！</p></div>"; 
echo "<div class='ch-box-ok'>"; 
echo "<h2>图片地址:</h2><p>http://".$_SERVER['HTTP_HOST']."/manage/".$destination."<p></div>"; 
echo "<div class=\"ch-box-help\"><h2>图片预览:</h2><img src=".$destination." /></div>"; 
 
}elseif ($error==1){ 
echo "超过了文件大小，在php.ini文件中设置"; 
}elseif ($error==2){ 
echo "超过了文件的大小MAX_FILE_SIZE选项指定的值"; 
}elseif ($error==3){ 
echo "文件只有部分被上传"; 
}elseif ($error==4){ 
echo "没有文件被上传"; 
}else{ 
echo "上传文件大小为0"; 
} 
}else{ 
echo "请上传jpg,gif,png等格式的图片！"; 
} 
} 
?>
</body>
</html>