<?php include "header.php"; ?>

<div  class="main_navbox">
<form action="<?php echo $httpServerHost;?>/index.php" method="get">
    <input type="hidden" name="at" value ="search" />
    <input name="query" type="text" />
    <input name="submit" type="submit" value="%{Search}%" />
</form>
</div>
<br class="clear" />
</div>
    
<?php $rows = mysql_fetch_array($memberInfo, MYSQL_BOTH); 
      $account_id = $rows['account_id'];
      $name = $rows['name'];
      $id = Base64UrlCode::encrypt($account_id);
      $cname = Base64UrlCode::encrypt($id);
?>
    
<!-- main_nav end -->
<?php include "rightside.php"; ?>
<!-- rightsider end -->
<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="content">
<!-- <div class="editroom"> -->

<h3 class="titlebar">會員基本資料</h3>
<div class="content">
    
     <form at="<?php echo $httpServerHost;?>index.php?cl=memberInfo&at=queryByName&id=<?php echo $id;?>&name=<?php echo $cname; ?>" method ="post">
        <table class="TableA"width="100%" border="0" cellspacing="0" cellpadding="0" >
            <tbody>
                <tr>
                    <td align="right" width="15%">%{AccountID}%<b class="small">(E-mail)</b>：</td>
                    <td class="TableTitle" width="120"><?php echo $rows['account_id'];?></td>
                </tr>
                <tr>
                    <td align="right">暱稱：</td>
                    <td class="TableTitle" width="120"><?php echo $rows['name'];?></td>
                </tr>
                <tr>
                    <td align="right">生日：</td>
                    <td class="TableTitle" width="120"><?php echo $rows['birthday'];?></td>
                </tr>
                <tr>
                    <td align="right">性別：</td>
                    <td class="TableTitle" width="120"><?php echo $rows['sex'];?></td>
                </tr>
            </tbody>

 
   
   <tr>
    <td></td>
    <td></td>
  </tr>
  
    
    

    <tr>
      <td colspan="2" align="center">
    <hr  class="hrclocr"/>
    <input value="%{Modify}%" name="input" onclick="window.location.href='<?php echo $httpServerHost;?>/index.php?cl=memberInfo&at=showChange&id=<?php echo $id;?>'"  type="button">
    </td>
  </tr>
</table>
</div>
</div>
<!-- mainbox end -->
</div>
<!-- InstanceEndEditable -->
<!-- content end -->
<br class="clear" />
</div>
<!-- container end -->
<div class="footer">
<p>%{Copyright}%</p>
</div>
<!-- footer end -->
</div>
<!-- wrapper end -->
</body>
<!-- InstanceEnd --></html>
