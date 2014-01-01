<?php

class Cps_AllTests extends PHPUnit_Framework_TestSuite
{
    public static function suite()
    {
        $rootLoc = dirname(__FILE__);
        $suite = new PHPUnit_Framework_TestSuite('AiryMVC Framework - Test Suite');

        $suite->addTestFile($rootLoc.'/config/lib/AclUtilityTest.php');
		$suite->addTestFile($rootLoc.'/config/lib/ConfigTest.php');

        return $suite;
    }
}