<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>會員管理</title>
<link rel="stylesheet" type="text/css" href="webroot/css/Style.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="/webroot/js/jquery-1.6.1.js"><\/script>');</script>
</head><body>
<div class="Wrapper">
<div class="Header"></div>
<div class="Container">
<!--管理選單-->
<?php include 'left_menu.php' ?>
﻿
<!--右方內容區塊-->
            <div class="SidebarRight">
                <div class="Index">會員管理</div>
                <div class="Content">
                <div class="PaddingTop">
                    <table width="100%" border="0" cellpadding="0" 
cellspacing="0">
                        <tbody><tr>
         <td><form action="<?php echo $httpServerHost;?>/index.php?md=backend&cl=member&at=queryByName&page=<?php echo $page?>&number_page=<?php echo $number_page ?>" method="post">
         帳號/姓名&nbsp;
         <input name="query" type="text">&nbsp;<input value="搜尋" type="submit"></form>
         </td>
        <td width="100" align="right">&nbsp;</td>
           <td width="100" align="right"><input name="input" value="新增" 
        onclick="window.location.href='index.php?md=backend&cl=member&at=add'" type="button"></td>
    </tr>
</tbody></table>
                </div>
                <table class="TableA" border="0" cellpadding="0" cellspacing="0">
					      <tr>
							    <td width="40" class="TableTitle" >序</td>
                                <td width="120" class="TableTitle" >帳號</td>
								<td width="120" class="TableTitle" >姓名</td>
								<td width="90" class="TableTitle" >建立日期</td>
                                                                <td width="120" class="TableTitle">狀態</td>
								<td width="150" class="TableTitle" >功能</td>
                          </tr>
						  <?php $n = 0;
						        //fetch the rows from raw (orginal) mysql results
						        while ($rows = mysql_fetch_array($mysql_results, MYSQL_BOTH))
						        {
						             $n++;
						        ?>                             
						  <tr>
							    <td width="40" class="TableTitle" ><?php echo $n?></td>
                                <td width="120" class="TableTitle" ><?php echo $rows[1]?></td>
								<td width="120" class="TableTitle" ><?php echo $rows['name'];?></td>
								<td width="90" class="TableTitle" ><?php echo $rows['createdate']?></td>
                                                                <td class="TableTitle" width="80"><?php if ($rows['isonline'] == 0){echo "上線";}else{echo "下線";}?></td>
								<td width="150" class="TableTitle" >
								<input name="input" type="button" value="查看" 
                                                                onclick="window.location.href='index.php?md=backend&cl=member&at=showChange&id=<?php echo $rows['id'];?>&page=<?php echo $page;?>&number_page=<?php echo $number_page; ?>'" >
								<input name="input" value="<?php if ($rows['isonline'] == 1){echo "上線";}else{echo "下線";}?>" 
								onclick="window.location.href='index.php?md=backend&cl=member&at=update&id=<?php echo $rows['id']?>&isonline=<?php if ($rows['isonline'] == 1){echo 0;}else{echo 1;}?>&page=<?php echo $page ?>&number_page=<?php echo $number_page ?>'" type="button">
                                                                <input name="input" type="button" value="刪除" 
                                                                onclick="window.location.href='index.php?md=backend&cl=member&at=update&id=<?php echo $rows['id'];?>&isdelete=1&page=<?php echo $page; ?>&number_page=<?php echo $number_page; ?>'" type="button">
                                                                </td>
                          </tr>
                          <?php }?>
				</table>
				</form>
              </div>
            </div>
</div>
<div class="Footer"><?php echo $paginator; ?></div>
</div>
</body>
</html>