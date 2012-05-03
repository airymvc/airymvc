<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>系统管理员后台管理</title>
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
                <div class="Index">%{AdminManagement}%</div>
                <div class="Content">
                <div class="PaddingTop">
                    <table width="100%" border="0" cellpadding="0" 
cellspacing="0">
                        <tbody><tr>

         <td><form action="<?php echo $httpServerHost;?>/index.php?md=backend&cl=admin&at=queryByName&page=<?php echo $page?>&number_page=<?php echo $number_page ?>" method="post">
         %{AccountID}%/%{Name}%&nbsp;
         <input name="query" type="text">&nbsp;<input value="%{Search}%" type="submit"></form>
         </td>

        <td width="100" align="right"><input name="input" value="%{AddNew}%" 
onclick="window.location.href='index.php?md=backend&cl=admin&at=add'" type="button"></td>
    </tr>
</tbody></table>
                </div>
                <table class="TableA" border="0" cellpadding="0" 
cellspacing="0">
					      <tbody><tr>
							    <td class="TableTitle" width="40">%{Number}%</td>
                                <td class="TableTitle" width="120">%{AccountID}%</td>
								<td class="TableTitle" width="120">%{Name}%</td>
								<td class="TableTitle" width="90">%{CreateDate}%</td>
								<td class="TableTitle" width="80">%{Status}%</td>
								<td class="TableTitle" width="150">%{Operation}%</td>
                          </tr>

						  <?php $n = 0;
						        //fetch the rows from raw (orginal) mysql results
						        while ($rows = mysql_fetch_array( $mysql_results , MYSQL_BOTH))
						        {
						             $n++;
						        ?>
						        <tr>
							    <td class="TableTitle" width="40"><?php echo $n?></td>
                                <td class="TableTitle" width="120"><?php echo $rows[1]?></td>
								<td class="TableTitle" width="120"><?php echo $rows['name'];?></td>
								<td class="TableTitle" width="90"><?php echo $rows['createdate'];?></td>
								<td class="TableTitle" width="80"><?php if ($rows['isonline'] == 0){echo "上線";}else{echo "下線";}?></td>
								<td class="TableTitle" width="150">
								<input name="input" value="修改" onclick="window.location.href='index.php?md=backend&cl=admin&at=showChange&id=<?php echo $rows[0]?>&page=<?php echo $page?>&number_page=<?php echo $number_page ?>'" type="button">
								<input name="input" value="<?php if ($rows['isonline'] == 1){echo "上線";}else{echo "下線";}?>" 
								onclick="window.location.href='index.php?md=backend&cl=admin&at=update&id=<?php echo $rows['id']?>&isonline=<?php if ($rows['isonline'] == 1){echo 0;}else{echo 1;}?>&page=<?php echo $page ?>&number_page=<?php echo $number_page ?>'" type="button">							
								<input name="input" value="刪除" 
								onclick="window.location.href='index.php?md=backend&cl=admin&at=update&id=<?php echo $rows['id']?>&isdelete=1&page=<?php echo $page?>&number_page=<?php echo $number_page ?>'" type="button">
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