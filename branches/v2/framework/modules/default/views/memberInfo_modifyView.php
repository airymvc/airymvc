<?php include ("header.php")?>

<div  class="main_navbox">
<form action="<?php echo $httpServerHost;?>/index.php" method="get">
    <input type="hidden" name="at" value ="search" />
    <input name="query" type="text" />
    <input name="submit" type="submit" value="%{Search}%" />
</form>
</div>
<br class="clear" />
</div>
<?php $rows = mysql_fetch_array($mysql_results, MYSQL_BOTH); 
      $account_id = $rows['account_id'];
      $name = $rows['name'];
      $id = (!is_null($aid)) ? $aid : Base64UrlCode::encrypt($account_id);
      $cname = (!is_null($cname)) ? $cname : Base64UrlCode::encrypt($id);
?>
<!-- main_nav end -->
<?php include "rightside.php"; ?>

<!-- rightsider end -->
<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="content">
<div class="editroom">

<h3 class="titlebar">會員基本資料</h3>
<div class="editroom2">
    <form action="<?php echo $httpServerHost;?>/index.php" method="post">
    <input type="hidden" name="cl" value="memberInfo" />
    <input type="hidden" name="at" value="updateChange" />
    <input type="hidden" name="id" value="<?php echo $id;?>" />
    <input type="hidden" name="cname" value="<?php echo $cname; ?>" />
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >

 <tr>
    <td align="right" width="15%">%{AccountId}%<b class="small">(E-mail)</b>：</td>
    <td>
   	<input name="account_id" type="text" value="<?php echo $rows['account_id']; ?>" size="30" />
    </td>
  </tr>
   <tr>
    <td align="right">%{Name}%</td>
    <td><input name ="name" type="text" value="<?php echo $rows['name']; ?>" size="20" /></td>
  </tr>
   <tr>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">%{Pwd}%:</td>
    <td><input name="pwd" type="password" value="<?php echo $rows['pwd']; ?>" size="20" /></td>
  </tr>
    <tr>
    <td align="right">%{Confirm}%%{Pwd}%:</td>
    <td><input name="pwd2" type="password" size="20" /></td>
    </tr>
   <tr>
    <td align="right">%{Birthday}%:</td>
    <td><input name="birthday" type="text" value="<?php echo $rows['birthday']; ?>" size="20" /></td>
  </tr>
  <tr>
    <td align="right">%{Sex}%:</td>
    <td>
    
        <input type="radio" name="sex" <?php if ($rows['sex'] == 1){ ?>checked="checked" <?php } ?> />男　
        <input type="radio" name="sex" <?php if ($rows['sex'] == 0){ ?>checked="checked" <?php } ?> />女</td>
   
  </tr>

    
  <tr>
    <td colspan="2" align="center">
    <hr  class="hrclocr"/>
    <input type="submit" value="%{Save}%" />
    </td>
  </tr>
</table>
</div>
<div><?php echo $message; ?></div>
</div>
<!-- mainbox end -->
</div>
<!-- InstanceEndEditable -->
<!-- content end -->
<br class="clear" />
</div>
<!-- container end -->
<div class="footer">
<?php include("footer.php"); ?>
