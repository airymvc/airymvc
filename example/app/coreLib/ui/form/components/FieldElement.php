<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('AbstractFormElement.php');
/**
 * Description of fieldElement
 *
 * @author Hung-Fu Aaron Chang
 */
class FieldElement extends AbstractFormElement{
    //put your code here
    protected $_label;
    protected $_label_id;
    protected $_label_css;
    
    public function setLabel($label_id, $label, $label_css = null)
    {
        $this->_label     = $label;
        $this->_label_id  = $label_id;
        $this->_label_css = $label_css;
    }
    
    public function render()
    {
        $inputText = "<div id='{$this->_label_id}' class='{$this->_label_css}'>{$this->_label}</div><input";
        foreach ($this->_attributes as $key => $value)
        {
            $inputText = $inputText . " " . $key ."=\"".$value ."\"";
        }
        $inputText = $inputText . ">";
        $this->_elementText = $inputText;
        return $this->_elementText;
    }
}

?>
