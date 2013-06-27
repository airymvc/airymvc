<?php

/**
 * AiryMVC Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license.
 *
 * It is also available at this URL: http://opensource.org/licenses/BSD-3-Clause
 * The project website URL: https://code.google.com/p/airymvc/
 *
 *
 */

require_once 'RuleInterface.php';
/**
 * Description of StrMaxRule
 *
 * @author Hung-Fu Aaron Chang
 */
class StrMaxLengthRule implements RuleInterface {

   private $_max; 
   /**
    *
    * @param string $pattern 
    */ 
   public function setRule($max){
       $this->_max = $max;
   }
   /**
    *
    * @param string $input
    * @return boolean 
    */ 
   public function validRule($input) {
       if (strlen($input) > $this->_max){
           return false;  
       }
       return true;
   }
}

?>
