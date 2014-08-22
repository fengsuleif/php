<div class="span12">
<div class="footer hero-unit">
<ul class="nav nav-pills">
<h3>推荐网站</h3>    
  <?php
$view=get_weblink();
for ($i=0;$i<count($view); $i++){
	echo '<li ><a href="'.$view[$i][1].'">'.$view[$i][0].'</a></li>';
}
unset($view);
?>  
</ul></div>
</div>

 <!--about-->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">关于我们</h3>
  </div>
  <div class="modal-body">
   <p>选举是善治和良政的基础，确保施政目标符合民意，约束权力不被滥用。但只有公正的选举才能达到这些目的。</p>
   <p>选举观察是一种对选举本身进行监督和评估的机制，以确保选举的公正和依法进行。</p>
   <p>在国际社会中，选举观察已经形成一套完整的规范，并得到了长期的实践运用，在中国，选举观察还处于起步阶段。</p>
   <p>中国选举观察（www.chinaelect.org）旨在倡导国际先进的选举规范和技术，促进国内选举环境的改善，推动选举法律的改革和完善。</p>
   <p>目前，中国基层人大代表和村民（居民）委员会的选举是选民能够直接参与的，若您愿意成为选举观察员，或对更广泛的选举议题、选举实践有自己的见解，欢迎联系我们。</p>
   <p>联系方式：election.china@gmail.com</p>
   
   <h3>About Us</h3>
   <p>Election is the basis of democracy and good governance. It ensures the public policy objectives compliant with popular will, and limits political powers not to be abused. However, only free and fair elections can achieve these goals.</p>
   <p>Election observation is a kind of mechanism for monitoring and evaluating elections, to ensure fare and legitimate elections.</p>
   <p>Internationally, election observation has formed a complete set of norms and get a long-term practical application. But in China, election observation is still in its infancy.</p>
   <p>China Election Obersavation (www.chinaelect.org) aims to initiate the internationally advanced election norms and technology, to promote the improvement of the domestic election environment , and to push forward the reform of electoral laws in China.</p>
  <p>We recruit and train election observers in the elections of China’s local People’s Congresses and villagers (residents) committees.</p>
  <p>We welcome other related organizations to contact us and cooperate.</p>
  <p>Contact us：election.china@gmail.com</p>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
   
  </div>
</div> 
 <!--about-->