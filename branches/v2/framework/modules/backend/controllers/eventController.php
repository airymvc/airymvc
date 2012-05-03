<?php

class eventController extends AppController {

    public function getTitleAction() {
        
        $page         = (isset($this->params['page'])) ? $this->params['page'] : 1;
        $number_page  = (isset($this->params['number_page'])) ? $this->params['number_page'] : 10;
        
        $where = array(""=>array("="=>array('isdelete'=>0)));
        $table = "event";
        $mysql_results = $this->model->getAllByPage($page, $number_page, $where, $table);
        
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
        $field = null;


        if (array_key_exists('years', $this->params)) {
            $field['years'] = $this->params['years'];
        }
        if (array_key_exists('months', $this->params)) {
            $field['months'] = $this->params['months'];
        }
        if (array_key_exists('days', $this->params)) {
            $field['days'] = $this->params['days'];
        }
        if (array_key_exists('title', $this->params)) {
            $field['title'] = $this->params['title'];
        }
        if (array_key_exists('content', $this->params)) {
            $field['content'] = $this->params['content'];
        }
        
        if (array_key_exists('isonline', $this->params) && is_numeric($this->params['isonline'])) {
            $field['isonline'] = $this->params['isonline'];
        }
        if (array_key_exists('isdelete', $this->params) && is_numeric($this->params['isdelete'])) {
            $field['isdelete'] = $this->params['isdelete'];
        }
        
        if (array_key_exists('status', $this->params)) {
            $field['status'] = $this->params['status'];
        }

        $this->model->updateItem($field, $where, 'event');
        echo $this->model->db->getStatement();
        //put the varible back into the view
        $this->getTitleAction();
        
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
        $where = null;
        if ($this->params['status'] >=0) {
            $where= array("AND"=>array("="=>array('isdelete'=>0), "LIKE"=>array('title'=>$query),"="=>array('status'=>$this->params['status'])));
        }else{
            $where= array("AND"=>array("="=>array('isdelete'=>0), "LIKE"=>array('title'=>$query))); 
        }

        
          
        $table = "event";
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
        $this->view->setViewfilepath('event_addView.php');
        if (!array_key_exists('id', $this->params)) {
            //put the varible back into the view
            $this->view->render();
        } else {
            $field_value = array('years'       => $this->params['years'], 
                                 'months'      => $this->params['months'], 
                                 'days'        => $this->params['days'], 
                                 'description' => $this->params['description'], 
                                 'createdate'  => 'CURRENT_TIMESTAMP', 
                                 'isonline'    => 0, 
                                 'isdelete'    => 0, 
                                 'salt'        => md5($this->params['pwd']));
            //get the raw (orginal) mysql results
            $mysql_results = $this->model->addItem($field_value, 'article');
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
        //get the all articles by page, number of items on a page
        $page = $this->params['page'];
        $number_page = $this->params['number_page'];
        $id = $this->params['id'];
        $mysql_results = $this->model->getItemById($id, 'event');
     
        $this->switchView ('backend', 'event_change');
        $this->view->setVariable("mysql_results", $mysql_results);
        $this->view->setVariable("id", $id);
        $this->view->setVariable("page", $page);
        $this->view->setVariable("number_page", $number_page);
        $this->view->render();
    }

}