
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Main.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>內容管理</title>
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
                <div class="Index"><a href="event.php">历史事件管理</a>_審核</div>
                <div class="Content">
                    <table class="TableA">
                        <tbody>
							<tr>
                                <td class="TableTitle" >審核狀態</td>
                                <td>
                                    <input name="isonline" type="ratio" value="" size="30" />通過
				    <input name="isonline" type="ratio" value="" size="30" />未通過
                                </td>
                            </tr>
							<tr>
                                <td class="TableTitle" >事件</td>
                                <td>
                                    <input name="description" type="text" value="" />
                                </td>
                            </tr>
							<tr>
                                <td class="TableTitle" >年</td>
                                <td><input name="years" type="text" value="" size="30" /></td>
                                 <td class="TableTitle" >月</td>
                                <td><input name="months" type="text" value="" size="30" /></td>
                                 <td class="TableTitle" >日</td>
                                <td><input name="days" type="text" value="" size="30" /></td>
                            </tr>
							<tr>
                                <td class="TableTitle" >创建日期</td>
                                 <td><input name="creatdt" type="datetime" value="" size="30" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center"><input type="button" value="送出" onclick="" /></td>
                            </tr>
                        </tbody>
                    </table>
					</form>
                </div>
            </div>
</div>
<div class="Footer"></div>
</div>
</body>
</html>