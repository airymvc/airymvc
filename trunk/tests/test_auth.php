<?php

require_once dirname(__FILE__) . '/../zframework/app/library/acl/Authentication.php';
require_once dirname(__FILE__) . '/../zframework/core/AclUtility.php';
require_once dirname(__FILE__) . '/../zframework/core/PathService.php';
require_once dirname(__FILE__) . '/../zframework/core/AclXmlConstant.php';
require_once dirname(__FILE__) . '/../zframework/core/RouterHelper.php';

    echo "=====test 0=====\n";
    $auth = new Authentication();
    $v = $auth->getAllAllows("demo");
    var_dump($v);
    
    echo "=====test 1=====\n";
    $v1 = $auth->getOtherExclusiveActions("demo");
    var_dump($v1);    

    echo "=====test 2=====\n";
    $v2 = $auth->getLoginExcludeActions("demo");
    var_dump($v1);    
    
    echo "=====test 3=====\n";
    $v3 = $auth->getLoginErrorAction("demo");
    var_dump($v3);
    
    echo "=====test 4=====\n";
    $v4 = $auth->getLoginController("demo");
    var_dump($v4);
?>
