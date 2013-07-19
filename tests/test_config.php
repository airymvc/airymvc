<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../zframework/core/PathService.php';
require_once dirname(__FILE__) . '/../zframework/config/lib/Config.php';

$v1 = Config::getInstance()->getScriptPlugin();
var_dump($v1);

$v2 = Config::getInstance()->getDBConfig();
var_dump($v2);

$v3 = Config::getInstance()->getDisplayError();
var_dump($v3);

$v4 = Config::getInstance()->getAuthenticationConfig();
var_dump($v4);

?>
