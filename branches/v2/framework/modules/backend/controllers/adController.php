<?php

class adController extends AppController {

    public function getAdAction() {

        //get the all members by page, number of items on a page
        $page = (isset($this->params['page'])) ? $this->params['page'] : 1;
        $number_page = (isset($this->params['number_page'])) ? $this->params['number_page'] : 10;

        //put where condition
        $where_fields = array("" => array("=" => array('isdelete' => 0)));
        $table = "advert";
        //get the raw (orginal) mysql results
        $mysql_results = $this->model->getAllByPage($page, $number_page, $where_fields, $table);

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

    public function updateAction() {
        $this->params['page'] = (isset($this->params['page'])) ? $this->params['page'] : 1;
        $this->params['number_page'] = (isset($this->params['number_page'])) ? $this->params['number_page'] : 10;

        $where = array("" => array("=" => array('id' => $this->params['id'])));
        $field = null;

        if (array_key_exists('isonline', $this->params) && is_numeric($this->params['isonline'])) {
            $field['isonline'] = $this->params['isonline'];
        }
        if (array_key_exists('isdelete', $this->params) && is_numeric($this->params['isdelete'])) {
            $field['isdelete'] = $this->params['isdelete'];
        }
        if (array_key_exists('title', $this->params)) {
            $field['title'] = $this->params['title'];
        }
        if (array_key_exists('content', $this->params)) {
            $field['content'] = $this->params['content'];
        }

        $this->model->updateItem($field, $where, 'advert');
        //put the varible back into the view
        $this->getAdAction();
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
            $query = '%' . $this->params['query'] . '%';
            $_SESSION[$moduleName][$uid]['query'] = $query;
        }
        $where = array("AND" => array("=" => array('isdelete' => 0), "LIKE" => array('name' => $query)));

        $table = "advert";
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
        $this->switchView('backend', 'ad_add');
        if (!array_key_exists('title', $this->params)) {
            $uploadDiv = new uploadDiv("upload", $action);
            $this->view->setVariable("uploadDiv", $uploadDiv);
            $this->view->render();
        } else {
            $MAXIMUM_FILESIZE = 5 * 1024 * 1024;
            $filename = $this->params['filename'];
            $rFileTypes = "/(jpg|jpeg|gif|png)/i";
            $ps = PathService::getInstance();
            $response_msg = null;
            $extType = str_replace("image/", "", $_FILES["file"]["type"]);

            if (!preg_match($rFileTypes, $extType)) {
                $response_msg = "The Upload File Type - {$_FILES["file"]["type"]} Is Not Valid!!";
            } else {

                if (($_FILES["file"]["size"] < $MAXIMUM_FILESIZE)) {
                     if ($_FILES["file"]["error"] > 0) {
                         $response_msg = $filename . " Upload Failed!!";
                     } else {
                         $root = $ps->getRootDir();
                         $path = $root . "/webroot/img/";
                         if (file_exists($path . $_FILES["file"]["name"])) {
                             echo $_FILES["file"]["name"] . " . ";
                             $response_msg = "The Upload File Already Exists!!";
                             $this->view->setVariable("response_msg", $response_msg);
                         } else {
                             move_uploaded_file($_FILES["file"]["tmp_name"], $path . $_FILES["file"]["name"]);
                             $response_msg = "The File {$filename} Is Uploaded Successful !!";
                             $imagePath = $ps->getAbsoluteHostURL() . "/webroot/img/" . $_FILES["file"]["name"];
 
                             $field_value = array('title'      => $this->params['title'],
                                                  'content'    => $this->params['content'],
                                                  'createdate' => 'CURRENT_TIMESTAMP',
                                                  'image_path' =>  $imagePath,
                                                  'isonline'   => 0,
                                                  'isdelete'   => 0);
                             
                             //get the raw (orginal) mysql results
                             $mysql_results = $this->model->addItem($field_value, 'advert');                            
                             $response_msg = "Successful!!"; 
                         }
                     }
                } else {
                    $response_msg = $filename . " Size Is Over!!";        
                }
            }
            $this->view->setVariable("response_msg", $response_msg);
            $uploadDiv = new uploadDiv("upload", $action);
            $this->view->setVariable("uploadDiv", $uploadDiv);
            $this->view->setVariable("imagePath", $imagePath);
            $this->view->render();           

        }
    }

    public function uploadAction() {
        //  5MB maximum file size 

    }

    public function showChangeAction() {
        //get the all members by page, number of items on a page
        $page = $this->params['page'];
        $number_page = $this->params['number_page'];
        $id = $this->params['id'];
        $mysql_results = $this->model->getItemById($id, 'advert');

        $this->switchView('backend', 'ad_change');
        $this->view->setVariable("mysql_results", $mysql_results);
        $this->view->setVariable("id", $id);
        $this->view->setVariable("page", $page);
        $this->view->setVariable("number_page", $number_page);
        $this->view->render();
    }

}