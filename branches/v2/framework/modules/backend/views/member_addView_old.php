
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Main.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员管理</title>
<link rel="stylesheet" type="text/css" href="/webroot/css/Style.css">
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
                <div class="Index"><a href="">會員管理</a>_查看</div>
                <div class="Content">
                   <form at="http://<?php echo $server_host?>/index.php?cl=member&at=add" method ="post">    
                    <table class="TableA">
                        <tbody>
						    <tr>
                                <td class="TableTitle" >帳號</td>
                                <td><input name="account_id" type="text" value="" size="30"/></td>
                            </tr>
							<tr>
                                <td class="TableTitle" >密碼</td>
                                <td><input name="pwd" type="password" value="" size="30" /></td>
                            </tr>
                            <tr>
                                <td class="TableTitle" >姓名</td>
                                <td><input name="name" type="text" value="" size="30" /></td>
                            </tr>
							<tr>
                                <td class="TableTitle" >暱稱</td>
                                <td><input name="nickname" type="text" value="" size="30" /></td>
                            </tr>
							<tr>
                                <td class="TableTitle" >電話</td>
                                <td><input name="tel" type="text" value="" size="10" /></td>
                            </tr>
							<tr>
                                <td class="TableTitle" >手機</td>
                                <td><input name="mobil" type="text" value="" size="10" /></td>
                            </tr>
							<tr>
                                <td class="TableTitle" >地址</td>
                                <td><input name="address" type="text" value="" size="50" /></td>
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