<?php

class loginController extends AclController
{
    function __construct() {
        $this->setRegisterViewName("register");
        //$this->setFormLabels("%{AccountID}%", "%{Pwd}%");
    }

}
?>
