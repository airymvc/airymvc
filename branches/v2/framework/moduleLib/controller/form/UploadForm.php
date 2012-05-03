<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of uploadForm
 *
 * @author Hung-Fu Aaron Chang
 */
class UploadForm extends PostForm{
    //put your code here
        public function __construct($id, $action) {
        parent::__construct($id);
        $this->createForm($action);
    }
    
    protected function createForm ($action) {  

        $this->setAttribute("name", "file");
        $this->setAttribute("class", "file");
        $this->setAttribute("enctype", "multipart/form-data");
        $this->setAttribute("action", $action);
        
        $txtField = new TextElement("filename");
        $fileElement = new FileElement("upload_file");
        $sBtn = new SubmitElement("submit");
        $html1 = new HtmlScript();
        $html1->setScript("<div id='upload_form' class='upload_form'>");
        $html2 = new HtmlScript();
        $html2->setScript("</div>");
        $fileElement->setLabel('file', 'Please Upload', 'file');
        $fileElement->setAttribute('name', 'file');
        $txtField->setLabel("filename", "File Name");
        $txtField->setAttribute("name", "filename");
        
        $this->setElement($html1);
        $this->setElement($txtField);
        $this->setElement($fileElement);
        $this->setElement($sBtn);
        $this->setElement($html2);
    }
    
}

?>
