<?php



abstract class AiryUnitTest extends PHPUnit_Framework_TestCase {
	

    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
    	$framework = "zframework";
        set_include_path(dirname(dirname(__FILE__)) . "/{$framework}/");
        $this->includeTestFiles($framework);
        $this->testSetUp();
    }
    
    protected function includeTestFiles($framework) {
    	$frameworkRoot = dirname(dirname(__FILE__));
		require_once $frameworkRoot . "/{$framework}/core/PathService.php";
		require_once $frameworkRoot . "/{$framework}/core/AclXmlConstant.php";
		require_once $frameworkRoot . "/{$framework}/core/RouterHelper.php";
		require_once $frameworkRoot . "/{$framework}/core/AclUtility.php";
		require_once $frameworkRoot . "/{$framework}/core/Config.php";
		require_once $frameworkRoot . "/{$framework}/app/library/db/DbAccessInterface.php";
		require_once $frameworkRoot . "/{$framework}/app/library/db/SqlComponent.php";
		require_once $frameworkRoot . "/{$framework}/app/library/db/MysqlCommon.php";
		require_once $frameworkRoot . "/{$framework}/app/library/db/MysqlComponent.php";
		require_once $frameworkRoot . "/{$framework}/app/library/db/MysqliComponent.php";
		require_once $frameworkRoot . "/{$framework}/app/library/db/PdoSqlComponent.php";
		require_once $frameworkRoot . "/{$framework}/app/library/db/PdoMysqlComponent.php";
		require_once $frameworkRoot . "/{$framework}/app/library/db/MssqlComponent.php";
		require_once $frameworkRoot . "/{$framework}/app/library/db/PdoMssqlComponent.php";
		require_once $frameworkRoot . "/{$framework}/app/library/db/AbstractAccess.php";
		require_once $frameworkRoot . "/{$framework}/app/library/db/DbAccess.php";
		require_once $frameworkRoot . "/{$framework}/app/library/db/PdoAccess.php";
		require_once $frameworkRoot . "/{$framework}/core/AclUtility.php";
		require_once $frameworkRoot . "/{$framework}/core/PathService.php";
		require_once $frameworkRoot . "/{$framework}/core/AclXmlConstant.php";
		require_once $frameworkRoot . "/{$framework}/core/RouterHelper.php";
		require_once $frameworkRoot . "/{$framework}/app/library/acl/Authentication.php";
		require_once $frameworkRoot . "/{$framework}/app/library/page/Paginator.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/UIComponent.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/form/AbstractForm.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/form/PostForm.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/components/AbstractFormElement.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/components/FieldElement.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/components/InputType.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/components/ButtonElement.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/components/TextElement.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/components/PasswordElement.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/components/SubmitElement.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/components/CheckBoxElement.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/components/TextAreaElement.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/components/DivElement.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/components/HtmlScript.php";
		require_once $frameworkRoot . "/{$framework}/app/library/ui/html/form/AbstractForm.php";		
		require_once $frameworkRoot . "/{$framework}/app/library/acl/LoginForm.php";
   	
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