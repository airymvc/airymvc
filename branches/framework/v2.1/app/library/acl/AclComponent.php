<?php

/**
 * AiryMVC Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license.
 *
 * It is also available at this URL: http://opensource.org/licenses/BSD-3-Clause
 * The project website URL: https://code.google.com/p/airymvc/
 *
 * @author: Hung-Fu Aaron Chang
 */

require_once ('AclUtility.php');
require_once('MysqlAccess.php');


class AclComponent {
	
	const MD5 = "MD5";
	const ACTION_POSTFIX = "Action";
	
	public $_loginForm;
	//put form varriable here
	private $_moduleName; 
	private $_formId; 
	private $_formName;
	private $_uidLabel;
	private $_pwdLabel; 
	private $_formLayout = array(); 
	private $_loginMsgId;
	protected $_view;
	public $params = array();
	
	protected $acDb;
	protected $acDbArray;
    
	
	public function __construct($view) {
		//prepare db
		$this->initialDB();
		
		if ($view instanceof AppView) {
			$this->_view = $view;
		}else {
			throw new Exception("Acl Component does not get correct view object");
		}
		$this->params = Parameter::getParams();
		
	}
	
    public function initialDB() {
        $multiDb = DbConfig::getConfig();
        $acl              = AclUtility::getInstance();
        $this->acDbArray  = $multiDb; 
        
        //set a default value for acDb
        $moduleName = MvcReg::getModuleName();
        $mapTableId = $acl->getTableIdByModule($moduleName);
        $mapDbId    = $acl->getMapDatabaseId($mapTableId);
        if (isset($this->acDbArray[$mapDbId])) {
        	$this->acDb = $this->acDbArray[$mapDbId];
        } else {
        	throw new AiryException("Acl Xml database mapping is wrong, check 'mapping_database_id' value or your config.ini");
        }
    }
    
    public function setDb($mapDbId) {
    	$this->acDb = $this->acDbArray[$mapDbId];
    }

	/**
     * signIn, check with the database table with uid, pwd and mapping table
     * @params: String $uid, String $pwd, String $mapTbl
     */
    public function signIn($moduleName = null, $controllerName = null, $actionName = null) {

        $moduleName = (is_null($moduleName)) ? MvcReg::getModuleName() : $moduleName;
        $controllerName = (is_null($controllerName)) ? MvcReg::getControllerName() : $controllerName;
        $actionName = (is_null($actionName)) ? MvcReg::getActionName() : $actionName;
        
        $acl = AclUtility::getInstance();
        $tbl_id = $acl->getTableIdByModule($moduleName);
        
        //if the module is not from MvcReg or different from MvcReg, need to get the mapDbId again for reset the acDb
        if (!is_null($moduleName) || ($moduleName == MvcReg::getModuleName())) {
        	$mapDbId    = $acl->getMapDatabaseId($tbl_id);
        	$this->setDb($mapDbId);
        }
        
        $tableName = $acl->getTableById($tbl_id);
        $mapFields = $acl->getMappingFieldByTbl($tbl_id);
        
        //prepare encryption setting
        $encrytionArray = $acl->getEncrytion();
        $encrytion = $encrytionArray[$tbl_id];
        $useEcryption = (isset($encrytion['use_pwd_encryption'])) ? $encrytion['use_pwd_encryption'] : NULL;
        //This sets the default method to PHP MD5 encryption
        $encrytionOption = (isset($encrytion['encrytion_option'])) ? $encrytion['encrytion_option'] : "PHP";
        $encrytionMethod = (isset($encrytion['encrytion_method'])) ? $encrytion['encrytion_method'] : "MD5";        

        $dbUid = $mapFields["user_id"];
        $dbPwd = (isset($mapFields["pwd"])) ? $mapFields["pwd"] : null;
        $dbSalt = (isset($mapFields["pwd_encrypt"])) ? $mapFields["pwd_encrypt"] : null;
        $dbIsdelete = (isset($mapFields["is_delete"])) ? $mapFields["is_delete"] : null;
        $dbIsdeleteValue = (isset($mapFields["is_delete_value"]) && !is_null($dbIsdelete)) ? $mapFields["is_delete_value"] : null;

        $params = Parameter::getParams();
        if (isset($params["{$dbUid}"]) && isset($params["{$dbPwd}"])) {
        	$uid = $params["{$dbUid}"];
        	$pwd = $params["{$dbPwd}"];
        } else {
        	throw new AiryException("Not passing the user id and password from the login form");
        }

        $mysql_results = null;
        //determine use encryption for password or not 
        if (!is_null($useEcryption) && (($useEcryption == 1) || (strtoupper($useEcryption) == "TRUE"))) {
        	$salt = "";
        	if (strtoupper($encrytionOption) == "PHP") {
        		/**
        		 * Currently, only support MD5
        		 */
        		if (strtoupper($encrytionMethod) == self::MD5) {
        			$salt = md5(trim($pwd));
        		}
        	} else {
        		$encryObj = new $encrytionOption();
        		$salt = $encryObj->$encrytionMethod(trim($pwd));
        	}
            $mysql_results = $this->getUserByUid($tableName, $dbUid, $uid, $dbIsdelete, $dbIsdeleteValue);
        } else {
            $mysql_results = $this->getUserByUid($tableName, $dbUid, $uid, $dbIsdelete, $dbIsdeleteValue);
        }
        $rows = mysql_fetch_array($mysql_results, MYSQL_ASSOC);
        $bLogin = false;
        
        if (is_array($rows)) {
        	if (!is_null($useEcryption) && (($useEcryption == 1) || (strtoupper($useEcryption) == "TRUE"))) {
            	if ($rows[$dbSalt] == $salt) {
                	$bLogin = true;
            	}
       		} else {
            	if ($rows[$dbPwd] == $pwd) {
                	$bLogin = true;
            	}
        	}
        }
        
        if ($bLogin) {
            $_SESSION[$moduleName][Authentication::UID] = $uid;
            $_SESSION[$moduleName][Authentication::ENCRYPT_UID] = Base64UrlCode::encrypt($uid);
            $_SESSION[$moduleName][Authentication::IS_LOGIN] = true;
            $_SESSION[Authentication::UID]['module'] = $moduleName;
            foreach ($rows as $key => $value) {
                    $_SESSION[$moduleName]['user'][$key] = $value;
            }
            
            $successfulArray = $acl->getSuccessfulDispatch();
            $successfulController = $successfulArray[$moduleName]['controller'];
            $successfulAction = $successfulArray[$moduleName]['action'];
            //forward to login sucessful action - this is set in the act.xml
            Dispatcher::forward($moduleName, $successfulController, $successfulAction, $params);
        } else {
            $authArray = $acl->getAuthentications();
            $loginErrorActionName = "loginErrorAction";
            if (isset($authArray[$moduleName]['login_error_action'])) {
                $loginErrorActionName = $authArray[$moduleName]['login_error_action'];
            } 
            //forward to login error action
            Dispatcher::forward($moduleName, $controllerName, $loginErrorActionName, $params);
        }
    }
    
    public function loginOut($forwardView = NULL) {
        $moduleName = MvcReg::getModuleName();
        unset($_SESSION[$moduleName][Authentication::UID]);
        unset($_SESSION[$moduleName][Authentication::ENCRYPT_UID]);
        unset($_SESSION[$moduleName][Authentication::IS_LOGIN]);
        unset($_SESSION[Authentication::UID]['module']);
    }
    
    /**
     * Modify the following function
     */
    
    //getter and setter for each form variables
    
    public function prepareLoginForm() {

        $this->_moduleName = (is_null($this->_moduleName)) ? MvcReg::getModuleName() : $this->_moduleName;
        $this->_formName   = (is_null($this->_formName)) ? "system_login_form" : $this->_formName;
        $this->_formId     = (is_null($this->_formId)) ? "system_login_form" : $this->_formId;
        $this->_uidLabel   = (is_null($this->_uidLabel)) ? "%{Username}%" : $this->_uidLabel;
        $this->_pwdLabel   = (is_null($this->_pwdLabel)) ? "%{Password}%" : $this->_pwdLabel;
        $this->_loginMsgId = (is_null($this->_loginMsgId)) ? "system_login_message" : $this->_loginMsgId; 
        
   		 /**
     	  * FormLayout example:
     	  * 
     	  * array(formId      => array('<div class="class_selector">', '</div>'),
     	  *       elementId1  => array('<div class="elememtClass1">', '</div>'),
     	  *       elementId2  => array('<div class="elememtClass2">', '</div>'),
    	  *       ...
     	  *       {elementId} => array('{open_html}, {close_html})
     	  *      );
     	  *      
     	  */ 
        $this->_formLayout = array($this->_formId  => array("<div class='{$this->_formName}' name='{$this->_formName}'>", "</div>"));           
        $loginForm = new LoginForm($this->_formId, $this->_formName, $this->_uidLabel, $this->_pwdLabel, $this->_moduleName, $this->_formLayout, $this->_loginMsgId, null);
        return $loginForm;
    }
    
    public function login($loginFormName = null) {
        $this->_loginForm = $this->prepareLoginForm();
    	$loginFormName = (is_null($loginFormName)) ? $this->_loginForm->getFormId() : $loginFormName;
    	
        //to generate the view
        $this->_view->setVariable($loginFormName, $this->_loginForm);
        $this->_view->render();
    } 

    

    
    public function resetLoginForm($moduleName = null, $formId = null, $formName = null, $uidLabel = null, $pwdLabel = null, $formLayout = null, $loginMsgId = null) {
        $this->setLoginFormOptions($moduleName, $formId, $formName, $uidLabel, $pwdLabel, $formLayout, $loginMsgId);
    	$this->_loginForm = $this->prepareLoginForm();
        return $this->_loginForm;
    }
    
    
    public function loginError($errorMessage = null, $errorMsgVariableName = null, $loginFormName = null) {
    	if (is_null($this->_loginForm)) {
    		$this->_loginForm = $this->prepareLoginForm();
    	}
        $this->_loginForm->populateErrorMessage($errorMessage);
        $loginFormName = (is_null($loginFormName)) ? $this->_loginForm->getFormId() : $loginFormName;
        
        $errorMessage = is_null($errorMessage) ? "ERROR!!" : $errorMessage;
        $errorMsgVariableName = is_null($errorMsgVariableName) ? 'loginErrorMessage' : $errorMsgVariableName;
        
        $this->_view->setVariable($loginFormName, $this->_loginForm);
        $this->_view->setVariable($errorMsgVariableName, $errorMessage);
        $this->_view->render();
    }
    
    /**
     * This is the convenient method for setup all the form variables
     * @param String $moduleName
     * @param String $formId
     * @param String $formName
     * @param String $uidLabel
     * @param String $pwdLabel
     * @param array $formLayout
     * @param String $loginMsgId
     */
    public function setLoginFormOptions($moduleName = null, $formId = null, $formName = null ,$uidLabel = null, $pwdLabel = null, $formLayout = null, $loginMsgId = null) {
		$this->setModuleName($moduleName);
		$this->setFormId($formId);
		$this->setFormName($formName);
		$this->setLoginMsgId($loginMsgId);
		$this->setPwdLabel($pwdLabel);
		$this->setUidLabel($uidLabel);
		$this->setFormLayout($formLayout);
    }
    
    
	/**
	 * @return the $_loginForm
	 */
	public function getLoginForm() {
		return $this->_loginForm;
	}

	/**
	 * @return the $_moduleName
	 */
	public function getModuleName() {
		return $this->_moduleName;
	}

	/**
	 * @return the $_formId
	 */
	public function getFormId() {
		return $this->_formId;
	}

	/**
	 * @return the $_formName
	 */
	public function getFormName() {
		return $this->_formName;
	}

	/**
	 * @return the $_uidLabel
	 */
	public function getUidLabel() {
		return $this->_uidLabel;
	}

	/**
	 * @return the $_pwdLabel
	 */
	public function getPwdLabel() {
		return $this->_pwdLabel;
	}

	/**
	 * @return the $_formLayout
	 */
	public function getFormLayout() {
		return $this->_formLayout;
	}

	/**
	 * @return the $_loginMsgId
	 */
	public function getLoginMsgId() {
		return $this->_loginMsgId;
	}

	/**
	 * @param Form $_loginForm
	 */
	public function setLoginForm($loginForm) {
		$this->_loginForm = $loginForm;
	}

	/**
	 * @param String $moduleName
	 */
	public function setModuleName($moduleName) {
		$this->_moduleName = $moduleName;
	}

	/**
	 * @param String $formId
	 */
	public function setFormId($formId) {
		$this->_formId = $formId;
	}

	/**
	 * @param String $formName
	 */
	public function setFormName($formName) {
		$this->_formName = $formName;
	}

	/**
	 * @param String $uidLabel
	 */
	public function setUidLabel($uidLabel) {
		$this->_uidLabel = $uidLabel;
	}

	/**
	 * @param String $pwdLabel
	 */
	public function setPwdLabel($pwdLabel) {
		$this->_pwdLabel = $pwdLabel;
	}

	/**
	 * @param array() $_formLayout
	 */
	public function setFormLayout($formLayout) {
		$this->_formLayout = $formLayout;
	}

	/**
	 * @param String $loginMsgId
	 */
	public function setLoginMsgId($loginMsgId) {
		$this->_loginMsgId = $loginMsgId;
	}

    public function setViewVariable($variableName, $variable) {
    	$this->_view->setVariable($variableName, $variable); 
    }
    
    private function getUserByUid($table_name, $uid_field, $uid, $isdelete_field = null, $isdelete= null) {

		$columns = array('*');
        if (is_null($isdelete_field) || is_null($isdelete)) {
            $where = array("AND"=>array("="=>array( $uid_field  => $uid)));
        } else {
            $where = array("AND"=>array("="=>array( $uid_field  => $uid),
                                        "!="=>array( $isdelete_field => $isdelete)));            
        }
        $this->acDb->select($columns, $table_name);
        $this->acDb->where($where);
        $mysql_results = $this->acDb->execute();	
        return $mysql_results;
    }
     
	
}

?>
