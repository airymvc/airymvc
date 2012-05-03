
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Main.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>廣告管理</title>
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
                <div class="Index"><a href="">廣告管理</a>_</div>
                <div class="Content">
                    <?php $rows = mysql_fetch_array($mysql_results, MYSQL_BOTH) ?>
                    <form at="http://<?php echo $server_host?>/index.php?md=backend&cl=ad&at=update&id=<?php echo $rows[0];?>&page=<?php echo $page;?>&number_page=<?php echo $number_page;?>" method ="post">
                    <table class="TableA">
                        <tbody>
							<tr>
                                <td class="TableTitle" >廣告名稱</td>
                                <td><input  name="title" type="text"  value="<?php echo $rows['title'];?>" size="30"/></td>
                            </tr>
                           <tr>
                                <td class="TableTitle" >廣告內容</td>
                                <td><input  name="content" type="text"  value="<?php echo $rows['content'];?>" size="30"/></td>
                            </tr>
                           <tr>
                                <td class="TableTitle" >上架時間</td>
                                <td><input  name="start_date" type="text"  value="<?php echo $rows[4]?>" size="30"/></td>
                            </tr>							
                             <tr>
                                <td class="TableTitle" >下架時間</td>
                                <td><input  name="end_date" type="text"  value="<?php echo $rows[5]?>" size="30"/></td>
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