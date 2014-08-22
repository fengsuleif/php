<?php
//字符串过滤
function new_addslashes($string){
	if(!is_array($string)) return addslashes($string);
	foreach($string as $key => $val) $string[$key] = new_addslashes($val);
	return $string;
}
//页面跳转
function gourl($url){
	echo "<script language='javascript' type='text/javascript'>";
	echo "window.location.href='$url'";
	echo "</script>";
//header('Location:'.$url);
}

//邮件格式判断
function is_email($email) {
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}
//获得分类字典
function get_c_i(){
$query="";
$query="select id, class  from sxk_class where stat=1";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->execute();
$arr=array();
$stmt->bind_result($id,$class);
while($stmt->fetch()){
	 $arr[$id]=$class; 	
 }
$stmt->close();
$link->close();
return $arr;
}
//检查邮箱是否已经注册过
function mail_in($mail){
$link = MysqliDb::OpenDB();
$query="select mail from sxk_admin where mail=?";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("s",$mail);
$stmt->store_result();
$row=$stmt->num_rows;
$stmt->close();
$link->close();
	if($row>0){
	return 0;
	}else{
	return 1;
	}
}

//无限极分类
function child_class($id,$arr){
	$class_legth=count($arr);
    for ($i=0;$i<$class_legth;$i++){	
	if($arr[$i][2]==$id){
	     echo '<option  value="'.$arr[$i][0].'">&nbsp;&nbsp;'.$arr[$i][1].'</option>';		 
			 get_ccc($arr[$i][0],$arr,1);
			 }	
	}
}
function get_ccc($id,$arr,$ccc){
	$class_legth=count($arr);
    for ($j=0;$j<$class_legth;$j++){	
	if($arr[$j][2]==$id){
	     echo '<option  value="'.$arr[$j][0].'">&nbsp;&nbsp;'.str_repeat("--", $ccc++).$arr[$j][1].'</option>';			
			 get_ccc($arr[$j][0],$arr,$ccc);
						}
				}
				
}
//获得分类列表
function get_select($stat){
$query="";
if($stat==1){$query="select id, class ,pid  from sxk_class where stat=1";}else{$query="select id, class ,pid  from sxk_class";}
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->execute();
$arr=array();
$stmt->bind_result($id,$class,$pid);
while($stmt->fetch()){
	 $arr[]=array($id,$class,$pid); 	
 }
$stmt->close();
$link->close();
return $arr;
}
function  edit_class_data($id){
$mysqli = MysqliDb::OpenDB();
$query="select id,class,pid,stat,page from sxk_class where id=?";
$stmt=$mysqli->prepare($query);//预处理
$stmt->bind_param("i",$id);//【i 数值 ，s字符，d浮点型，b blobs型 】
$stmt->execute();
$stmt->bind_result($col1,$col2,$col3,$col4,$col5);
$data= array(); 
while($stmt->fetch()){
$data[0]=$col1;
$data[1]=$col2;
$data[2]=$col3;
$data[3]=$col4;
$data[4]=$col5;
 }
$stmt->close();
$mysqli->close();
 return  $data;
}
//检查分类是否已经存在
function class_in($class){
$link = MysqliDb::OpenDB();
$query="select id from sxk_class where class=?";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("s",$class);
$stmt->execute();
$stmt->store_result();
$row=$stmt->num_rows;
$stmt->close();
$link->close();
if($row>0){	return 0;	}else{	return 1; }
}

//登陆检测
function check_in($username,$pass){
$query="select power from sxk_admin where name=? and pw=?";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("ss",$username,$pass);
$stmt->execute();
$stmt->bind_result($p);
while($stmt->fetch()){
$_SESSION['power']=$p;
setcookie("SXK2015",$p,time()+3600,"/");
}
$stmt->close();	
$link->close();
}
//登陆判断
function login_in($username,$pass){
$pw=md5($pass);
$link = MysqliDb::OpenDB();
$query="select * from sxk_admin where name=? and pw=?";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("ss",$username,$pw);//【i 数值 ，s字符，d浮点型，b blobs型 】
$stmt->execute();
$stmt->store_result();
$row=$stmt->num_rows;
$stmt->close();
$link->close();
	if($row>0){
	setcookie("SXK2013",$username,time()+3600,"/");
	$_SESSION['pw']=md5($pass);
	return 1;
	}else{
	return 0;
	}
}
//获取文章总数
function get_art_num(){
$link = MysqliDb::OpenDB();
$query="select count(*) from sxk_art where stat!=100 ";
$stmt=$link->prepare($query);//预处理
$stmt->execute();
$stmt->bind_result($col1);
$Tnum="";
while($stmt->fetch()){
	$Tnum=$col1;
}
$stmt->close();
$link->close();
return $Tnum;
}
//获取友情链接总数
function get_site_num(){
$link = MysqliDb::OpenDB();
$query="select count(*) from sxk_site where  type!=100  ";
$stmt=$link->prepare($query);//预处理
$stmt->execute();
$stmt->bind_result($col1);
$Tnum="";
while($stmt->fetch()){
	$Tnum=$col1;
}
$stmt->close();
$link->close();
return $Tnum;
}
//检查用户名是否已经注册过
function user_in($username){
$link = MysqliDb::OpenDB();
$query="select * from sxk_admin where name=?";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("s",$username);//【i 数值 ，s字符，d浮点型，b blobs型 】
$stmt->execute();
$stmt->store_result();
$row=$stmt->num_rows;
$stmt->close();
$link->close();
	if($row>0){
	return 0;
	}else{
	return 1;
	}
}

function add_user($name,$pw,$mail,$power,$date){
			$query="insert into sxk_admin(name,pw,mail,power,regdate) values(?,?,?,?,?)";
			$mysqli = MysqliDb::OpenDB();
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("sssis",$name,$pw,$mail,$power,$date);
			$stmt->execute();
			$stmt->close();
			$mysqli->close();
}
function  add_article($title,$img,$author,$summary,$content,$origin,$cid,$fzclass,$dt){
$query="insert into sxk_art(title,img,author,summary,content,origin,cid,fzclass,dt) values(?,?,?,?,?,?,?,?,?)";
			$mysqli = MysqliDb::OpenDB();
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("ssssssiis",$title,$img,$author,$summary,$content,$origin,$cid,$fzclass,$dt);
			$stmt->execute();
			$stmt->close();
			$mysqli->close();
}

function add_class($class,$pid,$dt,$page,$stat){
$query="insert into sxk_class(class,pid,page,stat,dt) values(?,?,?,?,?)";
			$mysqli = MysqliDb::OpenDB();
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("siiis",$class,$pid,$page,$stat,$dt);
			$stmt->execute();
			$stmt->close();
			$mysqli->close();
}

function add_site($web,$link,$pic,$summary,$type){
$query="insert into sxk_site(web,link,pic,summary,type) values(?,?,?,?,?)";
			$mysqli = MysqliDb::OpenDB();
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("ssssi",$web,$link,$pic,$summary,$type);
			$stmt->execute();
			$stmt->close();
			$mysqli->close();
}

function update_site($web,$link,$pic,$summary,$type,$vid){
$query="update sxk_site set web=?,link=?,pic=?,summary=?,type=? where id=?";
			$mysqli = MysqliDb::OpenDB();
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("ssssii",$web,$link,$pic,$summary,$type,$vid);
			$stmt->execute();
			$stmt->close();
            $mysqli->close();

}

function update_user($name,$mpw,$mail,$power,$vid){
$query="update sxk_admin set name=?,pw=?,mail=?,power=? where id=?";
			$mysqli = MysqliDb::OpenDB();
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("ssssi",$name,$mpw,$mail,$power,$vid);
			$stmt->execute();
			$stmt->close();
			$mysqli->close();

}

function update_class($class,$pid,$page,$stat,$vid){
$query="update sxk_class set class=?,pid=?,page=?,stat=? where id=?";
$mysqli = MysqliDb::OpenDB();
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("siiii",$class,$pid,$page,$stat,$vid);
			$stmt->execute();
			$stmt->close();
			$mysqli->close();

}
function  update_article($title,$img,$author,$summary,$content,$origin,$cid,$fzclass,$vid){
$query="update sxk_art set title=?,img=?,author=?,summary=?,content=?,origin=?,cid=?,fzclass=? where id=?";
			$mysqli = MysqliDb::OpenDB();
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("ssssssiii",$title,$img,$author,$summary,$content,$origin,$cid,$fzclass,$vid);
			$stmt->execute();
			$stmt->close();
			$mysqli->close();	

}
function  del_user($vid){
if($_SESSION['power']==1111){
			$mysqli= MysqliDb::OpenDB();	
			$query="delete from sxk_admin where id=?";
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("i",$vid);					
			$stmt->execute();
			$stmt->close();
			$mysqli->close();
			}		
}
function del_site($vid){
$mysqli= MysqliDb::OpenDB();	
			$query="update sxk_site set type=100 where id=?";
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("i",$vid);					
			$stmt->execute();
			$stmt->close();
			$mysqli->close();
}
function del_class($vid){
$mysqli= MysqliDb::OpenDB();	
			//$query="delete from sxk_class where id=?";
			$query="update sxk_class set stat=100 where id=?";
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("i",$vid);					
			$stmt->execute();
			$stmt->close();
			$mysqli->close();
}
function del_article($vid){
$mysqli= MysqliDb::OpenDB();	
			$query="update sxk_art set stat=100 where id=?";
			$stmt=$mysqli->prepare($query);//预处理
			$stmt->bind_param("i",$vid);					
			$stmt->execute();
			$stmt->close();
			$mysqli->close();
}

?>