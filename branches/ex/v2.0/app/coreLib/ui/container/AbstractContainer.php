<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractContainer
 *
 * @author Hung-Fu Aaron Chang
 */
abstract class AbstractContainer extends UIComponent{
    //put your code here
    protected $_attributes = array();
    protected $_elements = array();
    
    
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
    
    public function setElement($element)
    {
        $this->_elements[] =  $element;
    }
    
    public function setElements($elements)
    {
        $this->_elements = $elements;
    }
    
    
}

?>
