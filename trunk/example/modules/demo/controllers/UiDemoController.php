<?php
/*
 *   AiryMVC Framework
 *  
 *   UI Element DEMO
 */

class UiDemoController extends AppController {
             
     public function testAutoCompleteAction() {
         
		$selections = array("papaya", "apple", "tomato", "orange", "lemon");
		$acTextField = new AutoCompleteTextField('fruit');
		$acTextField->setSelections($selections);
		$acTextField->setLabel("select_fruit", "Select Fruit:");
		//set variable in view
        $this->view->setVar("aVariable", $acTextField);
        $this->view->render();
     }
}