<?php


/**
 * Description of ValidatorInterface
 *
 * @author changA
 */
interface ValidatorInterface {
    
    public function setRequireValid($errorMsg);
    
    public function setCustomValid($methodName, $object, $errorMsg);
    
    public function validate($value);
    
}

?>
