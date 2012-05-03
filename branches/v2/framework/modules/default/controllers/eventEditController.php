<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of eventEditController
 *
 * @author changA
 */
class eventEditController extends AppController{
    //put your code here
   public function newAction() {
        //get the all members by page, number of items on a page
        $encryptId = $this->params['id'];
        $encryptName = $this->params['name'];
        $account_id = Base64UrlCode::decrypt($encryptId);
        $name = Base64UrlCode::decrypt($encryptName);
        $this->view->setVariable("c_account_id", $encryptId);
        $this->view->setVariable("account_id", $account_id);
        $this->view->setVariable("c_name", $encryptName);
        $this->view->setVariable("name", $name);
        $this->view->render();
    }
    
    
     public function addAction() {
        //get the all members by page, number of items on a page
        $encryptId = $this->params['id'];
        $encryptName = $this->params['name'];
        $account_id = Base64UrlCode::decrypt($encryptId);
        $name = Base64UrlCode::decrypt($encryptName);
        $date = $this->params['event_date'];
        $dateArr = explode("-", $date);
        $year = $dateArr[0];
        $month = $dateArr[1];
        $day = $dateArr[2];
        $title = $this->params['event_title'];
        $content = $this->params['event_content'];
        $tag_content = $this->params['event_tag'];        
        $tags = $this->processTags($tag_content);
        
        $result1 = $this->model->getMemberInfo($account_id, 'member');
        $row1 = mysql_fetch_array($result1, MYSQL_BOTH);
        $aId = $row1['id'];
        
        $field_value = array('title'      => $title, 
                             'content'    => $content,
                             'year'       => $year,
                             'month'      => $month,
                             'day'        => $day,
                             'member_id'  => $aId,
                             'status'     => 0,
                             'type'       => 1,
                             'createdate' => 'CURRENT_TIMESTAMP', 
                             'isonline'   => 0, 
                             'isdelete'   => 0);
        //add into even table
        $mysql_result1 = $this->model->addItem($field_value, 'event');
        $sql = "SELECT id FROM event ORDER BY id DESC LIMIT 0,1";
        $this->model->db->setStatement($sql);
        $result = $this->model->db->execute();
        $row = mysql_fetch_array($result, MYSQL_BOTH);
        $lastEventId = $row['id'];
            
        foreach ($tags as $idx => $tag)
        {
             $columns = array('tag'        => $tag, 
                              'event_id'   => $lastEventId,
                              'member_id'  => $aId,
                              'createdate' => 'CURRENT_TIMESTAMP');
            //add into even table
            $mysql_result2 = $this->model->addItem($columns, 'event_tag');           
        }

        $response_msg = "Successful!";
        
        $this->view->setVariable("message", $response_msg);       
        $this->view->setVariable("c_account_id", $encryptId);
        $this->view->setVariable("account_id", $account_id);
        $this->view->setVariable("c_name", $encryptName);
        $this->view->setVariable("name", $name);
        $this->view->render();
    }
    
    
    private function processTags($tag) {
        $tags = array();
        $tagArr = explode(",", $tag);
        foreach ($tagArr as $i=>$t) {
            $t = trim($t);
            if ($t != "")
                $tags[] = trim($t);
        }
        return $tags;
    }
}

?>
