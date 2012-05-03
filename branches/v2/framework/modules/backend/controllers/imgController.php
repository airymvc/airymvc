<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of imgController
 *
 * @author Hung-Fu Aaron Chang
 */
class imgController extends AppController {

    //put your code here
    public function getUploadAction() {
        $moduleName = "backend";
        $controllerName = "img";
        $actionName = "upload";
        $action = PathService::getInstance()->getFormActionURL($moduleName, $controllerName, $actionName);
        $uploadForm = new UploadForm("upload", $action);

        $this->view->setVariable("uploadForm", $uploadForm);
        $this->view->render();
    }

    public function uploadAction() {
        //  5MB maximum file size 
        $MAXIMUM_FILESIZE = 5 * 1024 * 1024;
        $filename = $this->params['filename'];
        $rEFileTypes = "/(jpg|jpeg|gif|png)/i";
        $ps = PathService::getInstance();
        $message = null;
        $extType = str_replace("image/", "", $_FILES["file"]["type"]);

        if (!preg_match($rEFileTypes, $extType)) {
            
            $message = "The Upload File Type - {$_FILES["file"]["type"]} Is Not Valid!!";
            $this->view->setVariable("message", $message);
        } else {

            if (($_FILES["file"]["size"] < $MAXIMUM_FILESIZE)) {
                if ($_FILES["file"]["error"] > 0) {
                    $message = $filename . " Upload Failed!!";
                    $this->view->setVariable("message", $message);
                } else {
                    $root = $ps->getRootDir();
                    $path = $root . "/webroot/img/";
                    if (file_exists($path . $_FILES["file"]["name"])) {
                        echo $_FILES["file"]["name"] . " . ";
                        $message = "The Upload File Already Exists!!";
                        $this->view->setVariable("message", $message);
                    } else {
                        move_uploaded_file($_FILES["file"]["tmp_name"], $path . $_FILES["file"]["name"]);
                        $message = "The File {$filename} Is Uploaded Successful !!";
                        $imagePath = $ps->getAbsoluteHostURL() . "/webroot/img/" .$_FILES["file"]["name"];
                        $this->view->setVariable("imagePath", $imagePath);
                    }
                }
            } else {
                $message = $filename . " Size Is Over!!";
                $this->view->setVariable("message", $message);
            }
        }
        $this->view->render();
    }

}

?>
