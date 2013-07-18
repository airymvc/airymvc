<?php

/*
 *   AiryMVC Framework
 *  
 *   LICENSE
 *  
 *   This source file is subject to the new BSD license.
 *  
 *   It is also available at this URL: http://opensource.org/licenses/BSD-3-Clause
 *   The project website URL: https://code.google.com/p/airymvc/
 *  
 *   @author: Hung-Fu Aaron Chang
 */


class indexController extends AppController {

     public function init() {
         $layoutFile = $this->getViewDir() .DIRECTORY_SEPARATOR. "layouts" . DIRECTORY_SEPARATOR . 
                       "testLayout.php";
         $layoutSetting = array ("Controller_Action" => array ("module"     => "demo",
                                                               "controller" => "index",
                                                               "action"     => "testHelloWorld"),
                                 "Content"           => $this->view
                                );
         $this->layout->setLayout($layoutFile, $layoutSetting);
     }
             
     public function testHelloWorldAction() {
         
         $aVariable = "Hello World! This is the action to test layout";
         $this->view->setVar("aVariable", $aVariable);
         $this->view->render();
         
     }
     
     public function contentAction() {
         $content = "This is the content";
         $this->view->setVar("content", $content);
         $this->layout->render();
     }
     
     public function testContentAction() {
         $content = "This is another content1";
         $this->view->setVar("content", $content);
         $this->layout->render();
     }

}


?>