<?php

if($_GET["action"]=='de'){
$vid=intval($_GET["do"]);//$_GET["UserName"];
$rt=$_COOKIE['SXK2013'];
$stat=100;
	//修改
	if($vid>0 and !empty($rt)){
	         $mysqli=new mysqli($db_host,$db_user,$db_pass,$db_name);
             if (!mysqli_set_charset($mysqli, "utf8")) {
		         printf("Error loading character set utf8: %s\n", mysqli_error($mysqli));	
		                                               } 
													   
			//根据权限变更sql语句					   
			if($_SESSION['power']==11 or $_SESSION['power']==1111){
			$query="update sxk_person set stat=? where id=?";
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("ii",$stat,$vid);
			}else{
			$query="update sxk_person set stat=? where id=? and rt=? ";
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("iis",$stat,$vid,$rt);
			}
			
			
			$stmt->execute();
			$stmt->close();
			$mysqli->close();
			//echo "1修改成功";
			$url='http://'.$_SERVER["SERVER_NAME"].'/manage/list_person.php';
	        //header('Location:'.$url);
			gourl($url);
		}else{
		echo "删除内容失败";
		}
	}
	
     
 
?>