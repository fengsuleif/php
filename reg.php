<?php
session_start();
include_once("manage/config2.php");
include_once("manage/fun.php");


if($_GET["a"]=='reg'){
$name=new_addslashes($_POST["UserName"]);//$_GET["UserName"];
$pw=md5($_POST["Password"]);
$mail=$_POST["Email"];//$_GET["Email"];
$date=date("Y-m-d H:i:s" ,time()) ;
	//注册	
	if($_POST["Password"]==$_POST["ConfirmPassword"] and is_email($_POST["Email"]) and strlen($_POST["Password"])>5 and strlen($name)>4){

			if(user_in($name) and mail_in($mail)){	
				$power=1;
			$query="insert into sxk_admin(name,pw,mail,power,regdate) values(?,?,?,?,?)";
			$mysqli = MysqliDb::OpenDB();
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("sssis",$name,$pw,$mail,$power,$date);
			$stmt->execute();
			$stmt->close();
			$mysqli->close();
			echo "1注册成功";
			$url='http://'.$_SERVER["SERVER_NAME"].'/login.htm';
	        header('Location:'.$url);
			}else{
			echo "0注册失败，用户名已存在或邮箱已存在";
			}

		}else{
		echo "2注册失败，两次密码输入不一致或邮箱格式错误";
		}
}

if($_GET["a"]=='login'){
$name=$_POST["UserName"];//$_GET["UserName"];
$pw=$_POST["Password"];
	if(login_in($name,$pw)){
	//echo "登陆成功";
	$url='http://'.$_SERVER["SERVER_NAME"].'/manage/main.php';
	gourl($url);
	}else{echo "登陆失败";}

}
	



?>