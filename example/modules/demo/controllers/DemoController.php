<?php
/*
 *   AiryMVC Framework
 *  
 *   DEMO
 */

class DemoController extends AppController {
             
     public function testAction() {
         
         $aVariable = "Demo Demo";
         $this->view->setVar("aVariable", $aVariable);
         $this->view->render();
         
     }
}
