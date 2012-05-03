<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadDiv
 *
 * @author Hung-Fu Aaron Chang
 */
class UploadDiv extends DivContainer{
    //put your code here
        public function __construct($id) {
        $this->setAttribute("id", $id); 
        $this->createDiv();
    }
    
    protected function createDiv () {  

        $this->setAttribute("name", "advert_add");
        $this->setAttribute("class", "advert_add");
        
        $txtField = new TextElement("filename");
        $fileElement = new FileElement("upload_file");

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
        $this->setElement($html2);
    }
}

?>
