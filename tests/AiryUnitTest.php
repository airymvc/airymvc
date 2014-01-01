<?php

require_once dirname(dirname(__FILE__)) . '/zframework/core/PathService.php';
require_once dirname(dirname(__FILE__)) . '/zframework/core/AclUtility.php';
require_once dirname(dirname(__FILE__)) . '/zframework/core/Config.php';

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