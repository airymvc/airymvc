<?php

/**
 * Description of Tab
 *
 * @author Hung-Fu Aaron Chang
 */
class Tab extends JUIComponent{
    
    protected $_tabs;
    protected $_attributes = array();
    protected $_elements = array();
    protected $_tabText;
    
    public function __construct($id, $class = null) {
        $this->setAttribute('id', $id);
        if (!is_null($class)) {
            $this->setAttribute('class', $class);
        }
    }
    //put your code here
    public function addTab($id, $label){
        $this->_tabs[$id] = $label;
    }
        
    
    /**
     * attributes is a key-value structure that stores all the form attribtes 
     */
    public function setAttribute($key, $value)
    {
        $this->_attributes[$key] =  $value;
    }
    
    public function setAttributes($attributes)
    {
        $this->_attributes = $attributes;
    }
    
    public function setElement($tabId, $element)
    {
        $this->_elements[$tabId][] =  $element;
    }
    
    public function setElements($tabId, $elements)
    {
        $this->_elements[$tabId] = $elements;
    }
    
    public function render()
    {
        $tabId = null;
        $tabText = "<div ";
        foreach ($this->_attributes as $key => $value)
        {
            if ($key == "id") {
                $tabId = $value;
            }
            $tabText = $tabText . " " . $key ."=\"".$value ."\"";
        }
        $tabText = $tabText . "><ul>";
        foreach ($this->_tabs as $id => $label) {
            $tabText = $tabText . "<li><a href='#" . $id . "'>" . $label . "</a></li>";
        }
        
        $tabText = $tabText. '</ul>';
        
        foreach ($this->_tabs as $tid => $class) {
            $tabText = $tabText . "<div id='" . $tid . "'>";
            /**
             * Render the form elements here 
             */
            if (!is_null($this->_elements[$tid]) && isset($this->_elements[$tid])) {
                foreach ($this->_elements[$tid] as $elemKey => $element)
                {
                    $tabText = $tabText . $element->render();
                }
            }
            $tabText = $tabText . "</div>";
        }
        $tabText = $tabText . "</div>";
        /**
         * Add Javascript support, follow the Jquery Tool Tabs
         */
        $tabText = $tabText . '<script type="text/javascript">';
        $tabText = $tabText . '$(function() {';
        $tabText = $tabText . '$("div#' . $tabId .'").tabs();';
        $tabText = $tabText . '});';
        $tabText = $tabText . '</script>';
        
        $this->_tabText = $tabText;
        
        return $this->_tabText;
    }
}

?>
