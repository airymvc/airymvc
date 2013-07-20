<?php
require_once '../core/PathService.php';

$root = PathService::getInstance()->getRootDir();
$coreLib = $root . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "library";
 $r = Initializer::getDirectory($coreLib, TRUE);

  var_dump($r);
  echo "========xxxx======\n";
  
 
 $moduleLib = $root . DIRECTORY_SEPARATOR . "moduleLib";
 $r1 = Initializer::getDirectory($moduleLib, TRUE);

  var_dump($r1);

  
    echo "========xxxx=dddddddddd=====\n";
  $str = "/usr/local/zend/apache2/htdocs/test/history/app/library;/usr/local/zend/apache2/htdocs/test/history/app/library/acl;/usr/local/zend/apache2/htdocs/test/history/app/library/controller;/usr/local/zend/apache2/htdocs/test/history/app/library/db;/usr/local/zend/apache2/htdocs/test/history/app/library/ui;/usr/local/zend/apache2/htdocs/test/history/app/library/ui/form;/usr/local/zend/apache2/htdocs/test/history/app/library/ui/form/components";
  
 $x =explode (";", $str);
 
 var_dump($x);
 
// echo "===== \n\n\n";
// $array_items[] = preg_replace("/\/\//si", DIRECTORY_SEPARATOR, "/usr/local/zend/apache2/htdocs/test/history/app/library");
// 
// var_dump($array_items);

// Initializer::initialize();
// 
?>
