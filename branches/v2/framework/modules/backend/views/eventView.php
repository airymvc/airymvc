<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>歷史事件管理</title>
        <link rel="stylesheet" type="text/css" href="webroot/css/Style.css">
    </head>
    <body>
        <div class="Wrapper">
            <div class="Header"></div>
            <div class="Container">
                <!--管理選單-->
                <?php include 'left_menu.php' ?>
                <!--右方內容區塊-->
                <div class="SidebarRight">
                    <div class="Index">歷史事件管理</div>
                    <div class="Content">

                        <div class="PaddingTop">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><form action="<?php echo $httpServerHost; ?>/index.php?md=backend&cl=event&at=queryByName&page=<?php echo $page ?>&number_page=<?php echo $number_page ?>" method="post">
                                            審核狀態&nbsp;<select name='status' id='status'><option value='-1'>---</option><option value='0'>待審核</option><option value='1'>通過</option><option value='2'>未通過</option></select>&nbsp;標題&nbsp;<input name="query" type="text" value=""/>&nbsp;<input type="submit" value="搜尋" /></form></td>
                                    <td width="100" align="right">&nbsp;</td>
                                </tr>
                            </table>
                        </div>
                        <table class="TableA" border="0" cellpadding="0" cellspacing="0">
                            <tr>            
                                <td width="80" class="TableTitle">ID</td>
                                <td width="80" class="TableTitle">標題</td>
                                <td width="80" class="TableTitle">建立日期</td> 
                                <td width="80" class="TableTitle">上下架</td>
                                <td width="80" class="TableTitle">處理</td> 

                            </tr>
                            <?php
                            $n = 0;
                            //fetch the rows from raw (orginal) mysql results
                            while ($rows = mysql_fetch_array($mysql_results, MYSQL_BOTH)) {
                                $n++;
                                ?>                          
                                <tr>
                                    <td width="90" class="TableTitle" ><?php echo $rows['id']; ?></td>
                                    <td width="90" class="TableTitle" ><?php echo $rows['title']; ?></td>
                                    <td width="90" class="TableTitle" ><?php echo $rows['createdate']; ?></td>
                                    <td class="TableTitle" width="80"><?php if ($rows['isonline'] == 0) {
                                echo "上線";
                            } else {
                                echo "下線";
                            } ?></td>
                                    <td width="300" class="TableTitle" >
                                        <input name="input" value="編輯" onclick="window.location.href='index.php?md=backend&cl=event&at=showChange&id=<?php echo $rows[0]; ?>&page=<?php echo $page; ?>&number_page=<?php echo $number_page; ?>'" type="button">
                                            <input name="input" value="<?php if ($rows['isonline'] == 0) {
                                echo "下架";
                            } else {
                                echo "上架";
                            } ?>"onclick="window.location.href='index.php?md=backend&cl=event&at=update&id=<?php echo $rows['id']; ?>&isonline=<?php if ($rows['isonline'] == 1) {
                                echo 0;
                            } else {
                                echo 1;
                            } ?>&page=<?php echo $page; ?>&number_page=<?php echo $number_page; ?>'" type="button">							
                                                <input name="input" value= "刪除" 
                                                       onclick="window.location.href='index.php?md=backend&cl=event&at=update&id=<?php echo $rows['id']; ?>&isdelete=1&page=<?php echo $page; ?>&number_page=<?php echo $number_page; ?>'" type="button">
                                                    </td>
                                                    </tr>
                            <?php } ?>
                                                </table>
                                                </div>
                                                </div>
                                                </div>
                                                <div class="Footer"><?php echo $paginator; ?></div>
                                                </div>
                                                </body>
                                                </html>