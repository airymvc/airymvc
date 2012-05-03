<?php //include_once ('webroot/plugin/ServerInfo.php');?>

<div class="SidebarLeft">
<div class="AdminMenu">
<div class="Title"><b>管理選單</b></div>
<div class="Context">
<ul>
<li><a href="<?php echo $httpServerHost?>/index.php?md=backend&cl=admin&at=getAdm&page=1&number_page=10">系統管理者管理</a></li>
<li><a href="<?php echo $httpServerHost?>/index.php?md=backend&cl=event&at=getTitle&page=1&number_page=10">事件管理</a></li>
<li><a href="<?php echo $httpServerHost?>/index.php?md=backend&cl=member&at=getAllMembers&page=1&number_page=10">會員管理</a></li>
<li><a href="<?php echo $httpServerHost?>/index.php?md=backend&cl=report&at=getRpt&page=1&number_page=10">檢舉管理</a></li>
<li><a href="<?php echo $httpServerHost?>/index.php?md=backend&cl=ad&at=getAd&page=1&number_page=10">廣告管理</a></li>
<li><a href="<?php echo $httpServerHost?>/index.php?md=backend&cl=bigEvent&at=getAllBigEvent&page=1&number_page=10">大事件管理</a></li>

</ul>
</div>
</div>
</div>
