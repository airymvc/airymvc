<?php
/*
 *   AiryMVC Framework
 *  
 *   UI Element DEMO
 */

class UiDemoController extends AppController {
             
     public function testAutoCompleteAction() {
         
		$selections = array("about", "apple", "tomato", "orange");
		$acTextField = new AutoCompleteTextField('fruit');
		$acTextField->setSelections($selections);
		$acTextField->setLabel("select_fruit", "Select Fruit:");
		
        $this->view->setVar("aVariable", $acTextField);
        $this->view->render();
         
     }
}