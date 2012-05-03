<?php

/**
 * Description of demoTab
 *
 * @author Hung-Fu Aaron Chang
 */
class demoTab extends Tab{
    public function __construct($id) {
        parent::__construct($id);
        $this->createTab();
    }
    
    protected function createTab () {     
        $this->addTab("tab1", "tab1_Name");
        $this->addTab("tab2", "tab2_Name");
        
        $e = new TextElement("t1");
        $e->setAttribute("name", "t1name");
        $e->setLabel('test1_label', 'Test1', 'css');
        
        $this->setElement("tab1", $e);
        
        $e1 = new HtmlScript();
        $e1->setScript("<a herf='aa.html' target='_blank'>");
        
        $e2 = new TextElement("t2");
        $e2->setAttribute("name", "t2name");
        $e2->setLabel('test2_label', 'Test2', 'css1');
        
        $e3 = new HtmlScript();
        $e3->setScript("</a>");
        
        $this->setElement('tab2', $e1);
        $this->setElement("tab2", $e2);
        $this->setElement("tab2", $e3);
        
       
    }
}

?>
