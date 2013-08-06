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


class IndexController extends AppController {
             
     public function helloWorldAction() {
         
         $aVariable = "Hello World! This is the action to test layout";
         $this->view->noDoctype();
         $this->view->setVar("aVariable", $aVariable);
         $this->view->render();
         
     }

}


?>