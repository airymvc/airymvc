<?php 


class TestController extends AclController {
	
	public function testLoginAction(){
		echo "test!!";
	}
	
    public function sucessfulLoginAction() {
        
         echo "Good!! Login";
    }
    
    public function testLogoutAction() {
        
         echo "Logout!!";
    }
}

?>
