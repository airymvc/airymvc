<?php

class Cps_AllTests extends PHPUnit_Framework_TestSuite
{
    public static function suite()
    {
        $rootLoc = dirname(__FILE__);
        $suite = new PHPUnit_Framework_TestSuite('AiryMVC Framework - Test Suite');

        $suite->addTestFile($rootLoc.'/config/lib/AclUtilityTest.php');
		$suite->addTestFile($rootLoc.'/config/lib/ConfigTest.php');
		$suite->addTestFile($rootLoc.'/app/library/db/MysqlComponentTest.php');
		$suite->addTestFile($rootLoc.'/app/library/db/MysqliComponentTest.php');
		$suite->addTestFile($rootLoc.'/app/library/db/DbAccessTest.php');
		$suite->addTestFile($rootLoc.'/app/library/db/PdoAccessTest.php');
		$suite->addTestFile($rootLoc.'/app/library/acl/AuthenticationTest.php');
		$suite->addTestFile($rootLoc.'/app/library/db/MssqlComponentTest.php');
		$suite->addTestFile($rootLoc.'/app/library/db/PdoMssqlComponentTest.php');
		$suite->addTestFile($rootLoc.'/app/library/page/PaginatorTest.php');
        $suite->addTestFile($rootLoc.'/app/library/acl/LoginFormTest.php');
        
		return $suite;
    }
}