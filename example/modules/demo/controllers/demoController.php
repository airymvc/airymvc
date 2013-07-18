<?php
/*
 *   AiryMVC Framework
 *  
 *   DEMO
 */

class demoController extends AppController {
             
     public function testAction() {
         
         $aVariable = "Demo Demo";
         $this->view->setVar("aVariable", $aVariable);
         $this->view->render();
         
     }
}