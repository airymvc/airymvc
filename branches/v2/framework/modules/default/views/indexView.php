<?php include "header.php"; ?>

<div  class="main_navbox">
<form action="<?php echo $httpServerHost;?>/index.php" method="get">
    <input type="hidden" name="at" value ="search" />
    <input name="query" type="text" />
    <input name="submit" type="submit" value="%{Search}%" />
</form>
</div>
<br class="clear" />
</div><!-- main_nav end -->
<div class="rightsider">
    <div class="rightlistbox">
        <h3 class="titlebar">會員登入</h3>
        <div class="loginbox">
<?php if (!isset($_SESSION['username'])) {
          echo $form; 
?>
          <br /><a href="<?php echo $httpServerHost;?>/index.php?cl=userLogin&at=register" title="註冊">註冊</a>
    <?php 
      } else {
          //$_SESSION['name'] should be set in the memberInfo
          echo $_SESSION['username'];
?>
          <br /><a href="<?php echo $httpServerHost;?>/index.php?cl=userLogin&at=logout" title="登出">登出</a>
<?php
      }
?>
        </div>

        <div class="adroom">
        	<a href="http://www.google.com" target="_blank" title=""><img src="images/2012-03-01_154537__199.jpg" width="250" height="250" alt="" /></a>
        </div>
        <div class="tagroom">
        	<div><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="4" color="#000">過敏體質</font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: #000; font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="3" color="#000">壓力</font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="3" color="#000"><strong>鼻竇炎</strong></font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="3" color="#000000">不孕症</font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="2" color="#000">牙齒美白</font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="5" color="#000">失眠</font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="3" color="#000"><strong>針灸</strong></font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="5" color="#000">光療</font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="3" color="#000"><strong>近視雷射</strong></font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="3" color="#000000">微整形</font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="5" color="#000"><strong>青春痘</strong></font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="3" color="#000">耳鳴</font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="4" color="#000"><strong>牙周病</strong></font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="3" color="#000">飛梭雷射</font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color:#000; font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://localhost/healthnews/index.php?controller=blog&amp;action=index#"><font size="3" color="#000"><strong>豐胸</strong></font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://health.chinatimes.com/blog"><font size="4" color="#000000">除毛</font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://health.chinatimes.com/blog"><font size="2" color="#000000">老花眼</font></a><font size="2" color="#000000" style="font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">、</font><span style="color: rgb(51, 51, 51); font-family: 'Times New Roman'; font-size: 13px; letter-spacing: 1px;">&nbsp;</span><a style="text-decoration: none; color: rgb(0, 102, 204); font-size: 13px; padding-right: 5px; line-height: 27px; font-family: 'Times New Roman'; letter-spacing: 1px;" href="http://health.chinatimes.com/blog/index_mdschkwd_kwd%e9%bb%91%e7%9c%bc%e5%9c%88.html"><font size="5" color="#000000"><strong>眼圈</strong></font></a></div>
        </div>
    </div>
<!-- rightlistbox end -->
</div>
<!-- rightsider end -->
<div class="content">

<div class="mainbox">
<h3 class="titlebar">%{HistoryInToday}%</h3>
<div class="mainlist">
<ul>
<?php while ($rows = mysql_fetch_array($todayEvents , MYSQL_BOTH)) { 
             $date = $rows['year'] . "-" . $rows['month'] . "-" .$rows['day']; 
?>
         <li><span class="datetxt"><?php echo $date; ?></span><a href="<?php echo $httpServerHost;?>/index.php?at=eventDetail&id=<?php echo $rows['id']?>"><?php echo $rows['title']; ?></a><br class="clear" /></li><div class="clear"></div>
<?php } ?>
<br class="clear" />
</ul>
</div>
<!-- mainlist end -->
<h3 class="titlebar">%{NewHistoryEvent}%</h3>
<div class="mainlist">
<ul>
<?php while ($rows = mysql_fetch_array($lastFiveEvents , MYSQL_BOTH)) { 
      $date = $rows['year'] . "-" . $rows['month'] . "-" .$rows['day'];    
?>
<li><span class="datetxt"><?php echo $date; ?></span><a href="<?php echo $httpServerHost;?>/index.php?at=eventDetail&id=<?php echo $rows['id']?>"><?php echo $rows['title']; ?></a><br class="clear" /></li><div class="clear"></div>
<?php } ?> 
</ul>
</div>
<!-- mainlist end -->


</div>
<!-- mainbox end -->
</div>
<!-- content end -->
<br class="clear" />
</div>
<?php echo $demo_tab; ?>
<!-- container end -->
<?php include "footer.php"; ?>