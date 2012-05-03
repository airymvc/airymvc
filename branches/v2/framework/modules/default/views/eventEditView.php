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
<!-- main_nav end -->
<?php include "rightside.php"; ?>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="content">
<div class="editroom">

<h3 class="titlebar">新增事件</h3>
<form action="<?php echo $httpServerHost;?>/index.php" method="post">
    <input type="hidden" name="cl" value="eventEdit" />
    <input type="hidden" name="at" value="add" />
    <input type="hidden" name="id" value="<?php echo Base64UrlCode::encrypt($account_id);?>" />
    <input type="hidden" name="name" value="<?php echo Base64UrlCode::encrypt($name); ?>" />

<div class="editroom2">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td width="12%">事件日期：</td>
    <td>
        <input type="text" name="event_date" id="datepicker">
    </td>
  </tr>
   <tr>
    <td>事件標題：</td>
    <td><input name="event_title" type="text" size="20" /></td>
  </tr>
   <tr>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>TAG：</td>
    <td><input name="event_tag" type="text" size="50" /><span>（以半形逗號分隔）</span></td>
  </tr>
  <tr>
    <td valign="top">事件內容：</td>
    <td><textarea name="event_content" cols="65" rows="18"></textarea></td>
  </tr>
    </tr>
  <tr>
    <td colspan="2" align="center">
    <hr  class="hrclocr"/>
    <input type="submit" value="儲存" />
    </td>
  </tr>
</table>
</div>
</form>



</div>
<!-- mainbox end -->
<div><?php echo $message; ?></div>
</div>
<!-- InstanceEndEditable -->
<!-- content end -->
<br class="clear" />
</div>
<!-- container end -->
<?php include("footer.php"); ?>

