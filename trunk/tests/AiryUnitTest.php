<?php

require_once dirname(dirname(__FILE__)) . '/zframework/core/PathService.php';
require_once dirname(dirname(__FILE__)) . '/zframework/core/AclXmlConstant.php';
require_once dirname(dirname(__FILE__)) . '/zframework/core/RouterHelper.php';
require_once dirname(dirname(__FILE__)) . '/zframework/core/AclUtility.php';
require_once dirname(dirname(__FILE__)) . '/zframework/core/Config.php';
require_once dirname(dirname(__FILE__)) . '/zframework/app/library/db/DbAccessInterface.php';
require_once dirname(dirname(__FILE__)) . '/zframework/app/library/db/SqlComponent.php';
require_once dirname(dirname(__FILE__)) . '/zframework/app/library/db/MysqlComponent.php';
require_once dirname(dirname(__FILE__)) . '/zframework/app/library/db/MysqliComponent.php';
require_once dirname(dirname(__FILE__)) . '/zframework/app/library/db/PdoSqlComponent.php';
require_once dirname(dirname(__FILE__)) . '/zframework/app/library/db/PdoMysqlComponent.php';
require_once dirname(dirname(__FILE__)) . '/zframework/app/library/db/AbstractAccess.php';
require_once dirname(dirname(__FILE__)) . '/zframework/app/library/db/DbAccess.php';
require_once dirname(dirname(__FILE__)) . '/zframework/app/library/db/PdoAccess.php';
require_once dirname(dirname(__FILE__)) . '/zframework/core/AclUtility.php';
require_once dirname(dirname(__FILE__)) . '/zframework/core/PathService.php';
require_once dirname(dirname(__FILE__)) . '/zframework/core/AclXmlConstant.php';
require_once dirname(dirname(__FILE__)) . '/zframework/core/RouterHelper.php';
require_once dirname(dirname(__FILE__)) . '/zframework/app/library/acl/Authentication.php';

abstract class AiryUnitTest extends PHPUnit_Framework_TestCase {
	

    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        set_include_path(dirname(dirname(__FILE__)) . '/zframework/');
        $this->testSetUp();
    }
    
    public function testSetUp(){
    	
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
}