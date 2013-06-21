<?php

class options
{     
	public static $ver=array(1=>'星星版', 2=>'月亮版', 3=>'太陽版');
	//public static $redirect=array(0=>'index.php?cl=index&at=index',1=>'index.php?cl=member&at=freeaskform', 2=>'index.php?cl=member&at=fixinfo', 3=>'index.php?cl=member&at=changecode');
	public static $minutes = 30;
	public function curPageURL() {
 		$pageURL = 'http';
 		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 				$pageURL .= "://";
 		if ($_SERVER["SERVER_PORT"] != "80") {
 				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 		} else {
  				$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 		}
 		return $pageURL;
	}
	
	public function getPages($goto, $item, $currp, $totalPage, $flag=true){
         $currp=$currp <1? 1: $currp;
		 //$goto=substr($goto, (strpos($goto, 'admin')), strlen($goto));
		 //if (strpos($goto, '&page')>0)$goto=substr($goto, 0, strpos($goto, '&page'));
		 $link_pageprev=$goto.'&page='. ( ($currp==1) ? (1) :($currp-1)  ) .' ';
		 $link_pagenext=$goto.'&page='. ( ($currp==$totalPage) ? ($totalPage) :($currp+1)  ) .' ';
		 
		 $link_pagehead=$goto.'&page=1  ';
		 $link_pagelast=$goto.'&page='.  $totalPage  .' ';
		
		 $prev= $currp % $item ==0 ? ((floor($currp/$item)-1)*$item )+1 : (floor($currp/$item)*$item )+1;
		 $next= $currp % $item ==0 ? floor($currp/$item)*$item  : ((floor($currp/$item)+1)*$item ) ;
		 $next = $next > $totalPage ? $totalPage : $next;
		 $link_pagelist='';
		 for ($i=$prev; $i<=$next; $i++){
			$link_pagelist.= $currp ==$i ? '<li class="current">'.$i.'</li>' : '<li><a href="?'.$goto.'&page='.$i.'">'.$i.'</a> </li>';
		 }
		 $link_pageprev10=$goto.'&page='. ( $prev-1  ) .' ';
		 $link_pagenext10=$goto.'&page='. ( $next+1  ) .' ';
	     
		$data='
          <div class="pagination scott">
            <ul>    
  	      ';		
		
		$data.=($currp >$item ) ? '<li class="disabled"><a href="?'.$link_pagehead.'">第一頁</a></li>':"";
		$data.=($prev > $item ) ?'<li class="disabled"><a href="?'.$link_pageprev10.'">上10頁</a></li>' : '';
		$data.= $link_pagelist;
   	    $data.=($totalPage > $next ) ?'<li><a href="?'.$link_pagenext10.'">下10頁</a></li>':"";
   	    $data.=($totalPage > $next ) ?'<li><a href="?'.$link_pagelast.'">最後一頁</a></li>' : '';
        $data.=' 
             </ul>
           </div>
	     ';
          $data=$totalPage>1 ?$data :'';
          $data.=' <input type="hidden" id="page" name="page" /> <input type="hidden" id="func" name="func" /><input type="hidden" id="status" name="status" /><input type="hidden" id="id" name="id" />';
		return $data;
	}
	
	public function getPages2($goto, $item, $currp, $totalPage){
         $currp=$currp <1? 1: $currp;
		 $goto=substr($goto, (strpos($goto, 'admin')), strlen($goto));
		 if (strpos($goto, '&page')>0)$goto=substr($goto, 0, strpos($goto, '&page'));
		
		 $link_pageprev='javascript:setPageSubmit('. ( ($currp==1) ? (1) :($currp-1)  ) .') ';
		 $link_pagenext='javascript:setPageSubmit('. ( ($currp==$totalPage) ? ($totalPage) :($currp+1)  ) .') ';
		 $link_pagehead='javascript:setPageSubmit(1)  ';
		 $link_pagelast='javascript:setPageSubmit('.  $totalPage  .') ';
				 
		 $prev= $currp % $item ==0 ? ((floor($currp/$item)-1)*$item )+1 : (floor($currp/$item)*$item )+1;
		 $next= $currp % $item ==0 ? floor($currp/$item)*$item  : ((floor($currp/$item)+1)*$item ) ;
		 $pageprev10='javascript:setPageSubmit( '.($prev-1).' )  ';
		 $pagepnext10='javascript:setPageSubmit( '.($next+1 ).' )  ';
		 $next = $next > $totalPage ? $totalPage : $next;
		
		for ($i=$prev; $i<=$next; $i++){
			$link_pagelist.= $currp ==$i ? '<li class="current">'.$i.'</li>' : '<li><a href="javascript:setPageSubmit('.$i.')">'.$i.'</a> </li>';
		 }

		$data='
          <div class="pagination scott">
            <ul>
  	      ';		
		
		$data.=($currp >$item ) ? '<li class="disabled"><a href="'.$link_pagehead.'">第一頁</a></li>' : '';
		$data.=($prev > $item ) ? '<li class="disabled"><a href="'.$pageprev10.'">上10頁</a></li>' : '';
		$data.= $link_pagelist;
		$data.=($totalPage > $next ) ? '<li><a href="'.$pagepnext10.'">下10頁</a></li>' : '';
        $data.=($totalPage > $next ) ?'<li><a href="'.$link_pagelast.'">最後一頁</a></li>' : '';
    	$data.=' 
             </ul>
           </div>
		   		
	     ';
       
	   $data = $totalPage >1 ? $data  : '' ;
	   $data.=' <input type="hidden" id="page" name="page" /> <input type="hidden" id="func" name="func" /><input type="hidden" id="status" name="status" /><input type="hidden" id="id" name="id" />';
	   return $data;
	   
	}
	
	public static function AlertTxt($url='',$txt=''){

	      echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		  <script type="text/javascript">';
		if ($txt)	echo 'alert("'.$txt.'");';
		if ($url)	echo 'document.location.href="'.$url.'";';
	      echo '</script>';
	
    }
    public static  function Alert($txt=''){
	    if($txt){
	     echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		       <script type="text/javascript">';
			     echo 'alert("'.$txt.'");';
	     echo '</script>';
	  } 
	}
	
	 public static  function goPrevPage($txt=''){
	     $refer=$_SERVER["HTTP_REFERER"];
	     $server_name=$_SERVER['SERVER_NAME'];
	     $result=strrpos($refer, $server_name);
	     $host=$_SERVER["HTTP_HOST"].substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/'));
	     echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		       <script type="text/javascript">';
		if($txt){	     echo 'alert("'.$txt.'");';} 
		if($result>0){ echo 'history.back();';} else {echo "window.location.href='http://".$host."'";}
	     echo '</script>';
	}
	
	public static function selectOptions($id, $opArr, $op0, $isTextValue){
		$select=!empty($op0)?'<option value="0">'.$op0.'</option>':'';
		for($i=0;$i<count($opArr);$i++){
	  		$select .= '<option value="'.($isTextValue?$opArr[$i]:($i+1)).'">'.$opArr[$i].'</option>';
		}
		return '<select name="'.$id.'" id="'.$id.'">'.$select.'</select>';
	}
	
// file upload
 var  $maxsize = 160000000; 
 var  $extname = 'jpg,gif,png'; 
 var  $uploaddir; 
public function setUploaddir($path, $file_dir){
    $serverFilePath=$_SERVER["SCRIPT_FILENAME"];
	$doc_dir = strpos($serverFilePath, $path);
	$doc_dir =substr($serverFilePath, 0, $doc_dir);   //project root
	$this->mkdir_r($doc_dir.$file_dir);
	$this->uploaddir=$doc_dir;
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

public function uploadSingle($name, $item, $dirpath){ 
    $result=array();
    $fname = $_FILES[$name]['name']; 
	//echo 'this filename:'.$this->filename.',fname:'.$fname.'.......'.$this->checkFileExt($fname).'<br/>'; 
	$ext = substr(strrchr($fname, "."), 1);
    if ($this->checkFileExt($ext)) { 
        $fsize = $_FILES[$name]['size']; 
		 //echo 'single fsize:'.$fsize.'...max:'.$this->maxsize.', temp_name:'.$_FILES[$name]['tmp_name'].'<br/>'; 
        if ($fsize <$this->maxsize) { 
           $uploadfile = $this->uploaddir; 
		   $tmpfile = $_FILES[$name]['tmp_name'];
		   if(empty($dirpath)){$newFileName=$item.'.'.$ext;}
		   else{$newFileName=$dirpath.$fname;}
		   
           //echo "uploadfile: $uploadfile =tmpfile:$tmpfile ".$fsize.",  <br/>".$uploadfile.'/'.$newFileName; 
          if (is_uploaded_file($tmpfile)) { 
		    if(move_uploaded_file($tmpfile, $uploadfile.'/'.$newFileName)){   //iconv("utf-8", "big5", $uploadfile.'/'.$newFileName))){ 
				//  copy($tmpfile, $uploadfile.'/'.$newFileName);   
				//  unlink($tmpfile);  //�芷��系emp���獢�              return $newFileName;
			 }
		  }else{
		     return 'fileupload'; //file upload erroe
		  }
        }//size end 
        else { 
           $fsize=1024*1024;  
            return 'filesize'; //file size too big;
        } 
     }//fname 
      else {
	       return 'fileext';  //file ext error
	   }
	 return $newFileName;
}//end func uploadSingle 

public function uploadMulit($name, $item, $dirpath){ 
    $result=array(); $file_result='';
    $i=0;
    foreach($_FILES[$name] as $value){
    $fname = $_FILES[$name]['name'][$i]; 
	//echo 'this filename:'.$this->filename.',fname:'.$fname.'.......'.$this->checkFileExt($fname).'<br/>'; 
	$ext = substr(strrchr($fname, "."), 1);
    if ($this->checkFileExt($ext)) { 
        $fsize = $_FILES[$name]['size'][$i]; 
		// echo 'single fsize:'.$fsize.'...max:'.$this->maxsize.', temp_name:'.$_FILES[$name]['tmp_name'][$i].'<br/>'; 
        if ($fsize <$this->maxsize) { 
           $uploadfile = $this->uploaddir; 
		   $tmpfile = $_FILES[$name]['tmp_name'][$i];
		   if(empty($dirpath)){$newFileName=$item.$i.'.'.$ext;}
		   else{$newFileName=$dirpath.$fname;}
		   
          // echo "newFileName: $newFileName, dirpath: $dirpath, uploadfile: $uploadfile , tmpfile:$tmpfile ".$fsize." <hr/>";
          if (is_uploaded_file($tmpfile)) { 
		    if(move_uploaded_file($tmpfile, iconv("utf-8", "big5", $uploadfile.'/'.$newFileName))){
				//  copy($tmpfile, $uploadfile.'/'.$newFileName);    //�臭誑�系ime()靘��瑼����� 
				//  unlink($tmpfile);  //�芷��系emp���獢�              $file_result= $newFileName;
			 }
		  }else{
		     $file_result= 'fileupload'; //file upload erroe
		  }
        }//size end 
        else { 
           $fsize=1024*1024;  
            $file_result= 'filesize'; //file size too big;
        } 
     }//fname 
      else {
	       $file_result= 'fileext';  //file ext error
	   }
	   $result[$i]=$file_result;
	   $i++;
    }
	 return $result;
}//end func uploadMulit 

//end file upload
  public function hasFile($file){ 
  	$serverFilePath=$_SERVER["SCRIPT_FILENAME"];
	$doc_dir = strpos($serverFilePath, 'index.php');
	$doc_dir =substr($serverFilePath, 0, $doc_dir);   //project root

     if (strlen($file)>0 && file_exists($doc_dir.$file)){
			 return true;
	 }
	 return false;
  }

   public function in_object($type, $value, $array){

      foreach($array as $item) { 
        if(!is_array($item)) { 
            if ($item == $value) return true; 
            else continue; 
        } 
        if(in_array($value, $item)){
        	if(in_array($type, $item))return true; 
        }else continue;
       // else if(in_object($value, $item)) return true; 
     } 
    return false; 
   }
   
   public function in_object2($type, $value, $array){

      foreach($array as $key=>$item) { 
        if(!is_array($item)) { 
            if ($item == $value) return $key; 
            else continue; 
        } 

        if(in_array($value, $item)){
        	if(in_array($type, $item)) return $key; ;
        }else continue;
 
     } 
    return -1; 
   }
  
   public function delCartItem($type, $value, $array){

      foreach($array as $key=>$item) { 
        if(!is_array($item)) { 
            if ($item == $value) {unset($aray[$key]);} 
            else continue; 
        } 

        if(in_array($value, $item)){
        	if(in_array($type, $item)) {unset($aray[$key]);}
        }else continue;
      } 
    return $array; 
   }
  
   public function std_class_object_to_array($stdclassobject)
   {
       $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;
      foreach ($_array as $key => $value) {
          $value = (is_array($value) || is_object($value)) ? std_class_object_to_array($value) : $value;
          $array[$key] = $value;
      }

      return $array;
   }
   
}
?>