<?php
/**
 * Demo how to use framework's login method
 *
 * @author Hung-Fu Aaron Chang
 */
class UserLoginController extends AclController {


   /**
    * userLogin, userLoginError, and logout actions are set in acl.xml
    * This is a demo for how to user AclController's $this->_acl (AclComponent) for login (authentication)
    */
    public function userLoginAction() {
                $this->_acl->login("loginForm");
    }

    public function userLoginErrorAction() {
        $this->switchView("demo", "userLogin", "userLogin");
        $this->_acl->loginError("ERROR!!!", "error_msg", "loginForm");
    }

    public function logoutAction() {
        parent::logoutAction();
        echo "<meta http-equiv=refresh content='0; url=index.php?md=demo&cl=test&at=testLogout'>";
    }
    
    /**
     * Below, need to be set in <other_exclusive_actions> in acl.xml for calling the actions
     */

    public function forgotAction() {
        $viewName = "memberInfo_forget";
        $this->loginError($viewName);
    }

}

?>

