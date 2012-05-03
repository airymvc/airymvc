<?php

class memberInfoController extends AppController {

    public function getMemberInfoAction() {
        
        $moduleName = MvcReg::getModuleName();
        $account_id = Base64UrlCode::decrypt(LoginService::getInstance()->getEncryptLoginUserId($moduleName));
 
        $table = "member";
        $memberInfo = $this->model->getMemberInfo($account_id, $table);
        $r = mysql_fetch_array($memberInfo, MYSQL_BOTH);
        $_SESSION['username'] = $r['name'];
        //set back to original result
        mysql_data_seek($memberInfo, 0);
        
        $this->view->setVariable('memberInfo', $memberInfo);
        $this->view->render();
    }

//    public function updateAction() {
//        
//        //get the all members by page, number of items on a page
//        $this->params['page']         = (isset($this->params['page'])) ? $this->params['page'] : 1;
//        $this->params['number_page']  = (isset($this->params['number_page'])) ? $this->params['number_page'] : 10;
// 
//        $where = array(""=>array("="=>array('id'=>$this->params['id'])));
//        $field = null;
//
//        if (array_key_exists('isonline', $this->params) && is_numeric($this->params['isonline'])) {
//            $field['isonline'] = $this->params['isonline'];
//        }
//        if (array_key_exists('isdelete', $this->params) && is_numeric($this->params['isdelete'])) {
//            $field['isdelete'] = $this->params['isdelete'];
//        }
//        if (array_key_exists('account_id', $this->params)) {
//            $field['account_id'] = $this->params['account_id'];
//        }
//        if (array_key_exists('name', $this->params)) {
//            $field['name'] = $this->params['name'];
//        }
//        if (array_key_exists('pwd', $this->params)) {
//            $field['pwd'] = $this->params['pwd'];
//        }
//        if (array_key_exists('birthday', $this->params)) {
//            $field['birthday'] = $this->params['birthday'];
//        }
//        if (array_key_exists('gender', $this->params)) {
//            $field['gender'] = $this->params['gender'];
//        }
//        if (array_key_exists('tel', $this->params)) {
//            $field['tel'] = $this->params['tel'];
//        }
//        if (array_key_exists('address', $this->params)) {
//            $field['address'] = $this->params['address'];
//        }
//        if (array_key_exists('level', $this->params)) {
//            $field['level'] = $this->params['level'];
//        }
//        if (array_key_exists('publish', $this->params)) {
//            $field['publish'] = $this->params['publish'];
//        }
//        if (array_key_exists('points', $this->params)) {
//            $field['points'] = $this->params['points'];
//        }
//        if (array_key_exists('tag_cloud', $this->params)) {
//            $field['tag_cloud'] = $this->params['tag_cloud'];
//        }
//
//        $this->model->updateItem($field, $where, 'member');
//        //put the varible back into the view
//        $this->getAdmAction();
//    }
//
//    public function queryByNameAction() {
//        //get the all members by page, number of items on a page
//        $page = $this->params['page'];
//        $number_page = $this->params['number_page'];
//        $columns = array('*');
//        $query = '%' . $this->params['query'] .'%';
//        
//        $where=       array("AND"=>array("="=>array('isdelete'=>0), "LIKE"=>array('name'=>$query)));
//          
//        $table = "member";
//        //get the raw (orginal) mysql results
//        $mysql_results = $this->model->queryByName_Page($page, $number_page, $columns, $where, $table);
//
//        //put the varible back into the view
//        $response = array('page'          => $page, 
//                          'number_page'   => $number_page, 
//                          'mysql_results' => $mysql_results);
//        $this->view->setResponse($response);
//        $this->view->render();
//    }

    public function addAction() {
        $response_msg = null;
        $this->view->setViewfilepath('memberInfo_regView.php');
        if (!array_key_exists('account_id', $this->params)) {
            //put the varible back into the view
            $this->view->render();
        } else {
            $field_value = array('account_id' => $this->params['account_id']
                , 'pwd' => $this->params['pwd']
                , 'name' => $this->params['name']
                , 'birthday'=> $this->params['birthday']
                , 'gender' => $this->params['gender']
                , 'tel' => $this->params['tel']
                , 'address' => $this->params['address']
                , 'level' => $this->params['level']
                , 'publish' => $this->params['publish']
                , 'points' => $this->params['points']
                , 'tag_cloud' => $this->params['tag_cloud']
                , 'createdate' => 'CURRENT_TIMESTAMP'
                , 'isonline' => 0
                , 'isdelete' => 0
                , 'salt' => md5($this->params['pwd']));
            //get the raw (orginal) mysql results
            $mysql_results = $this->model->addItem($field_value, 'member');
            
            if ($mysql_results) {
                $response_msg = "Successful!!";
            } else {
                $response_msg = "ERROR!!";
            }
            $response = array('response_msg' => $response_msg,
                               'field_info' =>$field_value);
      
            $view = new AppView();
            $viewfilepath = "modules".DIRECTORY_SEPARATOR."default".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."memberInfoView.php";
            $view->setViewFilePath($viewfilepath);
            $this->setView($view);
            $this->view->setResponse($response);

            $this->view->render();
        }
    }

    public function showChangeAction() {
        $encryptId = $this->params['id'];
        $account_id = Base64UrlCode::decrypt($encryptId);
        $mysql_results = $this->model->getMemberInfo($account_id, 'member');

        $this->view->setVariable('mysql_results', $mysql_results);
        $this->switchView("default", "memberInfo_modify");
        $this->view->render();
    }
    
    
    
    public function updateChangeAction() {
        
        $message ="%{Successful}%";
        $this->switchView("default", "memberInfo_modify");

 
        $pwd = $this->params['pwd'];
        $pwd2 = $this->params['pwd2'];
        
        $encryptId   = $this->params['id'];
        $encryptName = $this->params['cname'];
        $id = Base64UrlCode::decrypt($encryptId);
        $name = Base64UrlCode::decrypt($encryptName);
        
        $mysql_results = $this->model->getItemById($id, 'member');
        
        if ($pwd != $pwd2 && $pwd2 != "" && !is_null($pwd2)) {
            $message = "密碼不一致";
            $this->view->setVariable('message', $message);
            $this->view->setVariable('mysql_results', $mysql_results);
            $this->view->render(); 
            return;
        }
        
        $where = array(""=>array("="=>array('account_id'=>$this->params['account_id'])));
        $field = null;

        if (array_key_exists('account_id', $this->params)) {
            $field['account_id'] = $this->params['account_id'];
        }
        if (array_key_exists('name', $this->params)) {
            $field['name'] = $this->params['name'];
            $cname = Base64UrlCode::encrypt($this->params['name']);
            $name  = $this->params['name'];
            $_SESSION['username'] = $name;
        }
        if (array_key_exists('pwd', $this->params)) {
            $field['pwd'] = $this->params['pwd'];
        }
        if (array_key_exists('birthday', $this->params)) {
            $field['birthday'] = $this->params['birthday'];
        }
        if (array_key_exists('gender', $this->params)) {
            $field['sex'] = $this->params['gender'];
        }

        $this->model->updateItem($field, $where, 'member');
        //put the varible back into the view
        $this->view->setVariable('cname', $encryptName);
        $this->view->setVariable('aid', $encryptId);
        $this->view->setVariable('message', $message);
        $this->view->setVariable('mysql_results', $mysql_results);
        $this->view->render(); 
    }

}