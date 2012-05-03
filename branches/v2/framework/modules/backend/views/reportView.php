<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>檢舉管理</title>
<link rel="stylesheet" type="text/css" href="webroot/css/Style.css">

</head><body>
<div class="Wrapper">
<div class="Header"></div>
<div class="Container">
<!--管理選單-->
<?php include 'left_menu.php' ?>
﻿
<!--右方內容區塊-->
            <div class="SidebarRight">
                <div class="Index">檢舉管理</div>
                <div class="Content">
                <div class="PaddingTop">
                    <table width="100%" border="0" cellpadding="0" 
cellspacing="0">
                        <tbody><tr>

         <td><form action="<?php echo $httpServerHost;?>/index.php?md=backend&cl=report&at=queryByName&page=<?php echo $page;?>&number_page=<?php echo $number_page;?>" method="post">
         被舉報事件&nbsp;
         <input name="query" type="text">&nbsp;<input value="搜尋" type="submit"></form>
         </td>

        <td width="100" align="right"></td>
    </tr>
</tbody></table>
                </div>
                <table class="TableA" border="0" cellpadding="0" 
cellspacing="0">
					      <tbody><tr>
								<td class="TableTitle" width="90">被舉報事件</td>
                                                                <td class="TableTitle" width="90">被舉報人帳號</td>
								<td class="TableTitle" width="90">舉報原因</td>
								<td class="TableTitle" width="90">舉報時間</td>
                                                                <td class="TableTitle" width="90">狀態</td>
                                                                <td class="TableTitle" width="90">操作</td>
                                                     </tr>

						  <?php $n = 0; 
						        //fetch the rows from raw (orginal) mysql results
						        while ($rows = mysql_fetch_array( $mysql_results , MYSQL_BOTH))
						        {
						             $n++;
						        ?>
						        <tr>
                                                               	<td class="TableTitle" width="90"><?php echo $rows['title']?></td>
								<td class="TableTitle" width="90"><?php echo $rows['account_id']?></td>
                                                                <td class="TableTitle" width="90"><?php echo $rows['reason']?></td>
                                                                <td class="TableTitle" width="90"><?php echo $rows['report_date']?></td>
                                                                <td class="TableTitle" width="90"><?php if ($rows['status'] == 0){echo "未審核";}elseif ($rows['status'] == 1) {echo "審核中";} else {echo "以通過";}?></td>
                                                                <td width="300" class="TableTitle" >
                                                                <input name="input" value="未審核" onclick="window.location.href='index.php?md=backend&cl=report&at=update&id=<?php echo $rows['event_id'];?>&page=<?php echo $page;?>&number_page=<?php echo $number_page;?>&status=0'" type="button">
                                                                <input name="input" value="審核中" onclick="window.location.href='index.php?md=backend&cl=report&at=update&id=<?php echo $rows['event_id'];?>&page=<?php echo $page;?>&number_page=<?php echo $number_page;?>&status=1'" type="button">
                                                                <input name="input" value="以審核" onclick="window.location.href='index.php?md=backend&cl=report&at=update&id=<?php echo $rows['event_id'];?>&page=<?php echo $page;?>&number_page=<?php echo $number_page;?>&status=2'" type="button">
                                                                </td>
                          </tr>
                          <?php }?>
				</tbody></table>

              </div>
            </div>
</div>
<div class="Footer"><?php echo $paginator; ?></div>
</div>
</body></html>