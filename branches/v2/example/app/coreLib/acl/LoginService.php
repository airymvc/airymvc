<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginSessionService
 *
 * @author Hung-Fu Aaron Chang
 */
class LoginService {
    
    private static $instance; 
    /**
     *  Use Singleton pattern here
     */
    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new self();
        }    
        
        return self::$instance;
    }
    
    /**
     *
     * @param String $moduleName
     * @return String uid 
     */
    public function getLoginUserId($moduleName = null)
    {
        if (!is_null($moduleName)) {
            return $_SESSION[$moduleName][Authentication::UID];
        }
        
        $currentModuleName = MvcReg::getModuleName();
        return $_SESSION[$currentModuleName][Authentication::UID];
        
    }
    public function getEncryptLoginUserId ($moduleName = null){
        if (!is_null($moduleName)) {
            return $_SESSION[$moduleName][Authentication::ENCRYPT_UID];
        }
        
        $currentModuleName = MvcReg::getModuleName();
        return $_SESSION[$currentModuleName][Authentication::ENCRYPT_UID];        
    }
    public function isLogin($moduleName = null)
    {
        if (!is_null($moduleName)) {
            return $_SESSION[$moduleName][Authentication::UID];
        }
        
        $currentModuleName = MvcReg::getModuleName();
        return $_SESSION[$currentModuleName][Authentication::UID];        
    }
}

?>
