<?php
session_start();
if(empty($_COOKIE['SXK2013']) ){ 
$url='http://'.$_SERVER["SERVER_NAME"].'/login.htm';
header('Location:'.$url); 
}else{
setcookie("SXK2013","",time()-3600,"/");
setcookie("SXK2015","",time()-3600,"/");
unset($_SESSION['power']);
unset($_SESSION['pw']);;
session_destroy();
$url='http://'.$_SERVER["SERVER_NAME"].'/login.htm';
header('Location:'.$url); 
}
?>