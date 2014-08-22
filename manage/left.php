
<div class="ch-box-lite ch-leftcolumn">
<h2>导航</h2>
		<ul class="YOUR_SELECTOR_Menu">
		<li>
				<span>返回首页</span>
				<ul>
					<li><a href="../index.php"><i class="ch-icon-arrow-right"></i>返回首页</a></li>
                                  </ul></li>
<li>
			

		 <?php 	
include_once("config2.php");
include_once("fun.php");

if(!empty($_COOKIE['SXK2013']) and !empty($_SESSION['pw'])){
check_in($_COOKIE['SXK2013'],$_SESSION['pw']);
}

if($_SESSION['power']>=111){ 
$html=<<<doc
<li><span>管理员管理</span>
<ul>
<li><a href="list_user.php"><i class="ch-icon-reorder"></i>用户管理</a></li>
<li><a href="add_user.php"><i class="ch-icon-pencil"></i>添加用户</a></li>
</ul></li>
<li><span>生成管理</span>
<ul>
<li><a href="make.php"><i class="ch-icon-reorder"></i>静态页生成</a></li>

</ul></li>
<li><span>分类管理</span>
<ul aria-hidden="false" style="display:block">
<li><a href="list_class.php"><i class="ch-icon-reorder"></i>分类管理</a></li>
<li><a href="add_class.php"><i class="ch-icon-pencil"></i>分类添加</a></li>
</ul>
</li>


<li><span>文章管理</span>
<ul aria-hidden="false" style="display:block">
<li><a href="list_article.php"><i class="ch-icon-reorder"></i>文章管理</a></li>
<li><a href="add_article.php"><i class="ch-icon-pencil"></i>文章添加</a></li>
</ul>
</li>

<li><span>链接管理</span>
<ul>
<li><a href="list_site.php"><i class="ch-icon-reorder"></i>链接管理</a></li>
<li><a href="add_site.php"><i class="ch-icon-pencil"></i>链接添加</a></li>
</ul>
</li>
doc;
			echo $html;
			 } ?>
			<li>
				<span>安全退出</span>
				<ul>
					<li><a href="out.php">帐号注销</a></li>
					
				</ul>
			</li>
	</ul>
	
</div>
