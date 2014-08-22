<?php
ini_set("display_errors",0);
include_once("manage/config2.php");

function header_to_htm($name,$t){
if(file_exists($name))
 {
   $time = time();     
   if($time - filemtime($name) < ($t*60))
   {   header("Location: ".$name);   }
 }
}

function get_menu(){
$query="select id, class ,pid  from sxk_class where stat=1";
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
function makemenu($data,$mode){
if($mode=="htm"){
for ($i=0;$i<count($data); $i++){
if($i==0){
    echo '<li class="active"><a href="list'.$data[$i][0].'.htm">'.$data[$i][1].'</a></li>'; }
else{
	echo '<li ><a href="list'.$data[$i][0].'.htm">'.$data[$i][1].'</a></li>';
 }
 }
 }
if($mode=="php"){
for ($i=0;$i<count($data); $i++){
if($i==0){
    echo '<li class="active"><a href="list.php?c='.$data[$i][0].'">'.$data[$i][1].'</a></li>'; }
else{
	echo '<li ><a href="list.php?c='.$data[$i][0].'">'.$data[$i][1].'</a></li>';
 }
 }
}
if($mode=="url"){
for ($i=0;$i<count($data); $i++){
if($i==0){
    echo '<li class="active"><a href="/'.$data[$i][0].'">'.$data[$i][1].'</a></li>'; }
else{
	echo '<li ><a href="/'.$data[$i][0].'">'.$data[$i][1].'</a></li>';
 }
 }
}

}

function get_list($id){
$query="select id,title,summary,author,dt,cid  from sxk_art where stat !=100 and cid=? limit 8";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("i",$id);
$stmt->execute();
$arr=array();
$stmt->bind_result($id,$title,$summary,$author,$dt,$cid);
while($stmt->fetch()){
	 $arr[]=array($id,$title,$summary,$author,$dt,$cid); 
 }
$stmt->close();
$link->close();
return $arr;
}

function get_list_page($cid,$page,$pagesize){
if($page==1){
$query="select id,title,summary,author,dt,cid from sxk_art where stat !=100 and cid=? order by id desc limit ".$pagesize;
}else{
$query="select id,title,summary,author,dt,cid from sxk_art where stat !=100 and cid=".$cid." and id >(select id from sxk_art where stat !=100 and cid=? order by id desc limit ".($page-1)*$pagesize." , 1 )  order by id desc limit ".$pagesize;
}
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("i",$cid);
$stmt->execute();
$arr=array();
$stmt->bind_result($id,$title,$summary,$author,$dt,$cid);
while($stmt->fetch()){
	 $arr[]=array($id,$title,$summary,$author,$dt,$cid); 
 }
$stmt->close();
$link->close();
return $arr;
}

function get_index_slide($id,$lt){
$query="select id,title,summary,author,dt ,cid,img from sxk_art where stat !=100 and fzclass=? order by id limit ".$lt;
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("i",$id);
$stmt->execute();
$arr=array();
$stmt->bind_result($id,$title,$summary,$author,$dt,$cid,$img);
while($stmt->fetch()){
	 $arr[]=array($id,$title,$summary,$author,$dt,$cid,$img); 
 }
$stmt->close();
$link->close();
return $arr;
}

function get_list_slide($id){
$query="select id,title,summary,author,dt  from sxk_art where stat !=100 and cid=?";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("i",$id);
$stmt->execute();
$arr=array();
$stmt->bind_result($id,$title,$summary,$author,$dt);
while($stmt->fetch()){
	 $arr[]=array($id,$title,$summary,$author,$dt); 
 }
$stmt->close();
$link->close();
return $arr;
}

function get_weblink(){
$query="SELECT web,link FROM `sxk_site` where type!=100";
$mysqli = MysqliDb::OpenDB();
$stmt=$mysqli->prepare($query);//预处理
$stmt->execute();
$arr=array();
$stmt->bind_result($web,$link);
while($stmt->fetch()){
	 $arr[]=array($web,$link); 
 }
$stmt->close();
$mysqli->close();
return $arr;
}

function get_show($id){
$query="select id,title,content,author,origin ,dt  from sxk_art where stat !=100 and id=?";
$link = MysqliDb::OpenDB();
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("i",$id);
$stmt->execute();
$arr=array();
$stmt->bind_result($id,$title,$content,$author,$origin,$dt);
while($stmt->fetch()){
	 $arr[]=array($id,$title,$content,$author,$origin,$dt); 
 }
$stmt->close();
$link->close();
return $arr;
}			

//获取相关分类文章总数
function get_art_num($id){
$link = MysqliDb::OpenDB();
$query="select count(*) from sxk_art where stat!=100 and cid=?";
$stmt=$link->prepare($query);//预处理
$stmt->bind_param("i",$id);
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

//显示分页
function show_page($curent,$B_p,$cid){
//打印上一页
if($curent==1 || $curent==NULL){
 echo '<li class="disabled"><a href="#">Prev</a></li>';
 }else{
 
 echo '<li><a href="list.php?p='.($curent-1).'&c='.$cid.'">Prev</a></li>';
 }
 //循环输出分页

  for ($i=1;$i<$B_p;$i++){
  
  if($i==$curent){
  echo '<li class="active"><a href="list.php?p='.$i.'&c='.$cid.'">'.$i.'</a></li>'; 
  }else{
  echo   '<li><a href="list.php?p='.$i.'&c='.$cid.'">'.$i.'</a></li>'; 
  } 
  
  }
  
  //打印下一页
  if($curent==intval($B_p) || $curent==NULL){
      echo '<li class="disabled"><a href="#">Next</a></li>';                  
      }else{echo '<li><a href="list.php?p='.($curent+1).'&c='.$cid.'">next</a></li>';
    }
}		
?>