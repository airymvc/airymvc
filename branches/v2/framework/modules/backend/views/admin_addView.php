
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Main.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统管理员後台管理</title>
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
                <div class="Index"><a href="">系統管理者管理</a>_新增</div>
                <div class="Content">
                    <form action="http://<?php echo $server_host?>/index.php?md=backend&cl=admin&at=add" method ="post">
                    <table class="TableA">
                        <tbody>
						<tr>
                                <td class="TableTitle" >帳號</td>
                                <td><input  name="account_id" type="text"  value="" size="30"/></td>
                            </tr>
							<tr>
                                <td class="TableTitle" >密碼</td>
                                <td><input  name="pwd" type="password"  value="" size="30"/></td>
                            </tr>
                           <tr>
                                <td class="TableTitle" >姓名</td>
                                <td><input  name="name" type="text"  value="" size="30"/></td>
                            </tr>
							
                            <tr>
                                <td colspan="2" style="text-align:center"><input type="submit" value="送出" /></td>
                            </tr>
                        </tbody>
                    </table>
					</form>
					<div><?php echo $rsp['response_msg']?></div>
                </div>
            </div>
</div>
<div class="Footer"></div>
</div>
</body>
</html>