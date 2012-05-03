<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userLoginController
 *
 * @author Hung-Fu Aaron Chang
 */
class userLoginController extends AclController{
    //put your code here
    function __construct() {
        $this->setRegisterViewName("register");
        //$this->setFormLabels("%{AccountID}%", "%{Pwd}%");
    }
    
    public function userLoginAction(){
        $viewName = "user_login";
        $this->login($viewName);
    }
    
    public function userLoginErrorAction() {
        $viewName = "user_login";
        $this->loginError($viewName);       
    }
    public function logoutAction() {
        parent::logoutAction();
        unset($_SESSION['username']);
        echo "logout";
        
    }
    public function registerAction() {
        $this->register();
    }
}

?>
