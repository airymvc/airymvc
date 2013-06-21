<?php
	
class upload{
// file upload
 var  $maxsize = 2048888; 
 var  $extname = 'jpg,gif,png'; 
 var  $uploaddir; 
public function setUploaddir($path, $file_dir){
    $serverFilePath=$_SERVER["SCRIPT_FILENAME"];
	$doc_dir = strpos($serverFilePath, $path);
	$doc_dir =substr($serverFilePath, 0, $doc_dir);   //project root
	
	$this->mkdir_r($doc_dir.$file_dir);
	$this->uploaddir=$doc_dir;
}
public function setExtname($extname){ 
     $this->extname=$extname;
}
public function checkFileExt($ext){ 
     $re = "/$ext/i"; 
     preg_match($re,$this->extname, $matches); 
	 return count($matches)>0;
}
 public function delfile($id, $table, $picpath_rowname){ 
	$mysql_results = $this->getItemById($id,  $table);
	$rows = mysql_fetch_array($mysql_results, MYSQL_BOTH) ;
	$file=$rows[$picpath_rowname];
     if (file_exists($this->uploaddir.$file)){
			 unlink($this->uploaddir.$file);
			 return true;
	 }
	 return false;
}
public function mkdir_r($dir, $rights=0777){
		 if (!is_dir($dir)){
			  $dirs = explode('/', $dir);
	          $dir2='';
              foreach ($dirs as $part) {
	             $dir2.=$part.'/';
	             if (!is_dir($dir2) && strlen($dir2)>0){
	                 mkdir($dir2, 0777);
			     }
	           }
			}
}
 
public function uploadSingle($name, $item, $flag=false){ 
    $result=array();
    $fname = empty($_FILES[$name]['name'])?'':$_FILES[$name]['name']; 
   
    //echo '<hr/>';
	//echo '<br/>this filename:'.$this->filename.',fname:'.$fname.'.......'.$this->checkFileExt($fname).'<br/>'; 
	$ext = substr(strrchr($fname, "."), 1);
    if ($this->checkFileExt($ext) || $flag) { 
        $fsize = empty($_FILES[$name]['size'])?'':$_FILES[$name]['size']; 
		 //echo 'single fsize:'.$fsize.'...max:'.$this->maxsize.', temp_name:'.$_FILES[$name]['tmp_name'].'<br/>'; 
        if ($fsize <$this->maxsize) { 
           $uploadfile = $this->uploaddir; 
		   $tmpfile = empty($_FILES[$name]['tmp_name'])?'':$_FILES[$name]['tmp_name']; 
		   $newFileName=$item.'.'.$ext;
          //echo "uploadfile: $uploadfile =tmpfile:$tmpfile ".$fsize.",  <br/>".$uploadfile.'/'.$newFileName; 
          if (is_uploaded_file($tmpfile)) { 
		    if(move_uploaded_file($tmpfile, $uploadfile.'/'.$newFileName)){
				  //copy($tmpfile, $uploadfile.'/'.$newFileName);    //可以用time()來改檔案名字 
				  //unlink($tmpfile);  //刪除在temp的檔案
              return $newFileName;
			 }
		  }else{
		     return 'fileupload'; //file upload erroe
		  }
        }//size end 
        else { 
           $fsize=1024*1024*1024*1024*1024;  
            return 'filesize'; //file size too big;
        } 
     }//fname 
      else {
	       return 'fileext';  //file ext error
	   }
	 return $newFileName;
}//end func uploadSingle 

}
?>