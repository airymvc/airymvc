<?php
$uploadForm = (isset($uploadForm))? $uploadForm : "";
$message = (isset($message))? $message : "";
$imagePath = (isset($imagePath))? $imagePath : "";
?>
<html>
<body>
    <div class="upload"><?php echo $uploadForm; ?></div>
    <div id ="msg" class="msg"><?php echo $message; ?></div>
    <div id ="upload_img" class="upload_img"><img src="<?php echo $imagePath?>" /></div>
</body>
</html>
   