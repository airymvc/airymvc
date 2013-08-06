<?php
/*
 *   AiryMVC Framework
 *  
 *   DEMO
 */

class DemoLayoutController extends AppController {
	
     public function init() {
         $layoutFile = $this->getViewDir() .DIRECTORY_SEPARATOR. "layouts" . DIRECTORY_SEPARATOR . 
                       "testLayout.php";
         $layoutSetting = array ("Controller_Action" => array ("module"     => "demo",
                                                               "controller" => "index",
                                                               "action"     => "helloWorld"),
                                 "Content"           => $this->view
                                );
         $this->layout->setLayout($layoutFile, $layoutSetting);
     }
             
     public function testNoLayoutAction() {
         
         $aVariable = "test no layout";
         $this->view->setVar("aVariable", $aVariable);
         $this->view->render();
         
     }
     
     public function contentAction() {
         $content = "This is the content";
         $this->view->setVar("content", $content);
         $this->layout->render();
     }
     
     public function anotherContentAction() {
         $content = "This is another content1";
         $this->view->setVar("content", $content);
         $this->layout->render();
     }
}
