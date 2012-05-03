<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>系统管理员后台管理</title>
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
                <div class="Index">系統管理者管理</div>
                <div class="Content">
                <div class="PaddingTop">
                    <table width="100%" border="0" cellpadding="0" 
cellspacing="0">
                        <tbody><tr>

         <td><form at="http://<?php echo $server_host?>/index.php?cl=admin&at=queryByName&page=<?php echo $rsp['page']?>&number_page=<?php echo $rsp['number_page']?>" method="post">
         帳號/姓名&nbsp;
         <input name="query" type="text">&nbsp;<input value="搜尋" type="submit"></form>
         </td>

        <td width="100" align="right"><input name="input" value="新增" 
onclick="window.location.href='index.php?cl=admin&at=add'" type="button"></td>
    </tr>
</tbody></table>
                </div>
                <table class="TableA" border="0" cellpadding="0" 
cellspacing="0">
					      <tbody><tr>
							    <td class="TableTitle" width="40">序</td>
                                <td class="TableTitle" width="120">帳號</td>
								<td class="TableTitle" width="120">姓名</td>
								<td class="TableTitle" width="90">建立日期</td>
								<td class="TableTitle" width="80">狀態</td>
								<td class="TableTitle" width="150">功能</td>
                          </tr>

						  <?php $n = 0;
						        //fetch the rows from raw (orginal) mysql results
						        while ($rows = mysql_fetch_array( $rsp['mysql_results'] , MYSQL_BOTH))
						        {
						             $n++;
						        ?>
						        <tr>
							    <td class="TableTitle" width="40"><?php echo $n?></td>
                                <td class="TableTitle" width="120"><?php echo $rows[1]?></td>
								<td class="TableTitle" width="120"><?php echo $rows[2]?></td>
								<td class="TableTitle" width="90"><?php echo $rows[4]?></td>
								<td class="TableTitle" width="80"><?php if ($rows[5] == 0){echo "上線";}else{echo "下線";}?></td>
								<td class="TableTitle" width="150">
								<input name="input" value="修改" onclick="window.location.href='index.php?cl=admin&at=showChange&id=<?php echo $rows[0]?>&page=<?php echo $rsp['page']?>&number_page=<?php echo $rsp['number_page']?>'" type="button">
								<input name="input" value="<?php if ($rows[5] == 1){echo "上線";}else{echo "下線";}?>" 
								onclick="window.location.href='index.php?cl=admin&at=update&id=<?php echo $rows[0]?>&isonline=<?php if ($rows[5] == 1){echo 0;}else{echo 1;}?>&page=<?php echo $rsp['page']?>&number_page=<?php echo $rsp['number_page']?>'" type="button">							
								<input name="input" value="刪除" 
								onclick="window.location.href='index.php?cl=admin&at=update&id=<?php echo $rows[0]?>&isdelete=1&page=<?php echo $rsp['page']?>&number_page=<?php echo $rsp['number_page']?>'" type="button">
								</td>
                          </tr>
                          <?php }?>
				</tbody></table>

              </div>
            </div>
</div>
<div class="Footer"></div>
</div>
</body></html>