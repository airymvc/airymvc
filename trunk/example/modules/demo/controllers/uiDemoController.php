<?php
/*
 *   AiryMVC Framework
 *  
 *   UI Element DEMO
 */

class uiDemoController extends AppController {
             
     public function testAutoCompleteAction() {
         
		$selections = array("about", "apple", "tomato", "orange");
		$acTextField = new AutoCompleteTextField('test_autoComplete');
		$acTextField->setSelections($selections);
		$acTextField->setLabel("testAuto", "testAuto");
		
        $this->view->setVar("aVariable", $acTextField);
        $this->view->render();
         
     }
}