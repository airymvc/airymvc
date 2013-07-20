<?php

require_once dirname(__FILE__) . '/../app/library/acl/LoginForm.php';
require_once dirname(__FILE__) . '/../app/library/acl/AclXmlConstant.php';
require_once dirname(__FILE__) . '/../app/library/ui/html/form/PostForm.php';
require_once dirname(__FILE__) . '/../app/library/ui/html/UIComponent.php';
require_once dirname(__FILE__) . '/../core/MvcReg.php';
require_once dirname(__FILE__) . '/../app/library/acl/Authentication.php';
require_once dirname(__FILE__) . '/../config/lib/AclUtility.php';
require_once dirname(__FILE__) . '/../core/PathService.php';
require_once dirname(__FILE__) . '/../config/lib/Config.php';
require_once dirname(__FILE__) . '/../app/library/ui/html/components/TextElement.php';
require_once dirname(__FILE__) . '/../app/library/ui/html/components/PasswordElement.php';
require_once dirname(__FILE__) . '/../app/library/ui/html/components/SubmitElement.php';
require_once dirname(__FILE__) . '/../app/library/ui/html/components/DivElement.php';

$loginform = new LoginForm(null, null, null, null, "default", null, null, "http://test?abc");
echo $loginform->render();

?>