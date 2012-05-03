
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Main.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>歷史事件管理</title>
<link rel="stylesheet" type="text/css" href="webroot/css/Style.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="/webroot/js/jquery-1.6.1.js"><\/script>');</script>

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
                    <?php $rows = mysql_fetch_array($mysql_results, MYSQL_BOTH);?>
                    <form action="<?php echo $httpServerHost;?>/index.php?md=backend&cl=event&at=update&id=<?php echo $id ?>&page=<?php echo $page?>&number_page=<?php echo $number_page?>" method ="post">
                    <table class="TableA">
                        <tbody>
						<tr>
                                <td class="TableTitle" >年</td>
                                <td><input  name="year" type="text"  value="<?php echo $rows['year'];?>" size="30"/></td>
                            </tr>
							<tr>
                                <td class="TableTitle" >月</td>
                                <td><input  name="month" type="text"  value="<?php echo $rows['month'];?>" size="30"/></td>
                            </tr>
                           <tr>
                                <td class="TableTitle" >日</td>
                                <td><input  name="day" type="text"  value="<?php echo $rows['day'];?>" size="30"/></td>
                            </tr>
                           <tr>
                                <td class="TableTitle" >事件標題</td>
                                <td><input  name="title" type="text"  value="<?php echo $rows['title'];?>" size="100"/></td>
                            </tr>
                             <tr>
                                <td class="TableTitle" >事件內容</td>
                                <td><input  name="content" type="text"  value="<?php echo $rows['content'];?>" size="100"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center"><input type="submit" value="送出" /></td>
                            </tr>
                        </tbody>
                    </table>
					</form>
					
					<div></div>
                </div>
            </div>
</div>
<div class="Footer"></div>
</div>
</body>
</html>