<?php

class reportController extends AppController {
    /*
     * This is the standard method to combine model and view
     * in view, you need to use $rsp[key] to get the value
     * 
     */

    public function getRptAction() {
        $page = (isset($this->params['page'])) ? $this->params['page'] : 1;
        $number_page = (isset($this->params['number_page'])) ? $this->params['number_page'] : 10;

        $mysql_results = $this->model->getEventReportByPageStatus($page, $number_page);

        $sql = $this->model->db->getStatement();
        $linkAction = $this->getCurrentActionURL();
        $pageNav = new Paginator();
        $pageNav->setPageItemKeys("page", "number_page");
        $html = $pageNav->getPageHtmlBySQL($sql, $linkAction);

        $this->view->setVariable("page", $page);
        $this->view->setVariable("number_page", $number_page);
        $this->view->setVariable("mysql_results", $mysql_results);
        $this->view->setVariable("paginator", $html);
        $this->view->render();
    }

    public function updateAction() {
        //get the all admins by page, number of items on a page
        $this->params['page']         = (isset($this->params['page'])) ? $this->params['page'] : 1;
        $this->params['number_page']  = (isset($this->params['number_page'])) ? $this->params['number_page'] : 10;
 
        $where = array(""=>array("="=>array('id'=>$this->params['id'])));
        $field = array();

        
        if (array_key_exists('status', $this->params) && is_numeric($this->params['status'])) {
            $field['status'] = $this->params['status'];
        }
        if (array_key_exists('isdelete', $this->params) && is_numeric($this->params['isdelete'])) {
            $field['isdelete'] = $this->params['isdelete'];
        }

        $this->model->updateItem($field, $where, 'event');
        $this->getRptAction();
    }

    public function queryByNameAction() {
 
        $moduleName = MvcReg::getModuleName();
        $_SESSION[$moduleName]['uid'] = $uid;
        $query = (isset($_SESSION[$moduleName][$uid]['query'])) ? $_SESSION[$moduleName][$uid]['query'] : null;
        
        //get the all admins by page, number of items on a page
        $page = $this->params['page'];
        $number_page = $this->params['number_page'];
        $columns = array('*');
        if (!is_null($this->params['query'])) {
            $query = '%' . $this->params['query'] .'%';
            $_SESSION[$moduleName][$uid]['query'] = $query;
        }
        $where= array("AND"=>array("="=>array('isdelete'=>0), "LIKE"=>array('title'=>$query)));
          
        $table = "report";
        //get the raw (orginal) mysql results
        $mysql_results = $this->model->queryByName_Page($page, $number_page, $columns, $where, $table);

        $sql = $this->model->db->getStatement();
        $linkAction = $this->getCurrentActionURL();
        $pageNav = new Paginator();
        $pageNav->setPageItemKeys("page", "number_page");
        $html = $pageNav->getPageHtmlBySQL($sql, $linkAction);   

        //$this->view->setResponse($response);
        $this->view->setVariable("page", $page);
        $this->view->setVariable("number_page", $number_page);
        $this->view->setVariable("mysql_results", $mysql_results);
        $this->view->setVariable("paginator", $html);
        $this->view->render();
    }

    public function addAction() {
        $response_msg = null;
        $this->view->setViewfilepath('report_addView.php');
        if (!array_key_exists('account_id', $this->params)) {
            //put the varible back into the view
            $this->view->render();
        } else {
            $field_value = array('account_id' => $this->params['account_id']
                , 'reported_account' => $this->params['reported_account']
                , 'reported_event' => $this->params['reported_event']
                , 'report_reason' => $this->params['report_reason']
                , 'createdate' => 'CURRENT_TIMESTAMP'
                , 'suspend_days' => 0
                , 'isdelete' => 0
                , 'salt' => md5($this->params['pwd']));
            //get the raw (orginal) mysql results
            $mysql_results = $this->model->addItem($field_value, 'report');
            if ($mysql_results) {
                $response_msg = "Successful!!";
            } else {
                $response_msg = "ERROR!!";
            }
            $response = array('response_msg' => $response_msg);
            $this->view->setResponse($response);
            //put the varible back into the view
            $this->view->render();
        }
    }

    public function showChangeAction() {
        //get the all reportss by page, number of items on a page
        $page = $this->params['page'];
        $number_page = $this->params['number_page'];
        $id = $this->params['id'];
        $mysql_results = $this->model->getItemById($id, 'report');

        $response = array('id' => $id
            , 'page' => $page
            , 'number_page' => $number_page
            , 'mysql_results' => $mysql_results);
        $this->view->setResponse($response);
        //You setup the view file path for including
        //view->render() is for showing the view
        $this->view->setViewfilepath('report_changeView.php');
        $this->view->render();
    }

}