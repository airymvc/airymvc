<?php

/**
 * Description of abstractFormElement
 *
 * @author Hung-Fu Aaron Chang
 */
class AbstractFormElement extends UIComponent{
    //put your code here
    protected $_attributes = array();
    protected $_elementText;
    
   
    public function setId($id)
    {
        $this->_attributes['id'] = $id;
    }
    public function getId()
    {
        return $this->_attributes['id'];
    }
    
    public function setName($name)
    {
        $this->_attributes['name'] = $name;
    }
    public function getName()
    {
        return $this->_attributes['name'];
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
    
    public function render()
    {
        $inputText = "<input";
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