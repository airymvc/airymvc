<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Main.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
    <title>历史上的今天後台管理</title>
    <!-- InstanceEndEditable -->
<link rel="stylesheet" type="text/css" href="/webroot/css/Style.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="/webroot/js/jquery-1.6.1.js"><\/script>');</script>
<!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>
<?php include_once ('webroot/plugin/server_info.php');?>
<div class="Wrapper">
<!--頁首 Start-->
<div class="Header">
</div>
<div class="Container">
<!--內容外框 Start-->
<div class="Login">
       <form action="http://<?php echo $server_host?>/index.php?cl=login&at=isLogin&page=1&number_page=10" method="post">
	  
            <table class="TableA" width="450" border="0" align="center" cellpadding="0" cellspacing="1" >
      <tr>
        <td width="100">帳號</td>
        <td width="300"><input name="uid"  type="text"  /></td>
      </tr>
      <tr>
        <td>密碼</td>
         <td><input  name="pwd"  type="password" /></td>
      </tr>

	  <tr>
	  <td colspan="2" style="text-align:center"> <input type="submit" value="登入" /></td></tr>
      </table>
      </form>
	 
      <p>&nbsp;</p><p>&nbsp;</p>	
</div>
</div>
<!--內容外框 End-->
<!--頁尾 Start-->
<div class="Footer"></div>
<!--頁尾 End-->
</div>
<!--頁首 End-->
</body>
<!-- InstanceEnd --></html>