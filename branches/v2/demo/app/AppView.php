<?php
class AppView{
	
	public $response;
	public $viewfilepath;
        private $_variables;
	
	public function __construct()
	{
		$this->response = null;
		$this->viewfilepath = null;
	}	
	
	public function render()
	{
            $jsFlag = false;
            //$rsp will be passed to view as a return key-value pair array
            if (!is_null($this->_variables)) {
                foreach ($this->_variables as $name=>$value)
                {
                    if ($value instanceof UIComponent || $value instanceof JUIComponent) {
                        $htmlValue = $value->render();
                        $newHtmlValue = $this->replaceWordByKey($htmlValue);
                        /**
                         * @todo: Detect javascript and replace them, and put them in the header 
                         */
                        $headerJS = $this->getHeaderJS($newHtmlValue);

                        if (!is_null($headerJS) && isset($headerJS)) {
                            $jsFlag = true;                            
                            //$newHtmlValue = $this->removeHeaderJSFromHtml($newHtmlValue, $headerJS);
                        }
                        ${$name} = $newHtmlValue;                   
                    } else {
                        ${$name} = $value;
                    }         
                }
            }

            $path = PathService::getInstance();
            $httpServerHost = $path->getAbsoluteHostURL();
            $serverHost = $path->getAbsoluteHostPath();
            if ($jsFlag) {
                ob_start(array('AppView', 'callbackWithJS'));
            } else {
                ob_start(array('AppView', 'callback'));
            }
            include $this->viewfilepath;
            ob_end_flush();
	}
	
	/**
	 * @return the $response
	 */
	public function getResponse() {
		return $this->response;
	}

	/**
	 * @return the $viewfilepath
	 */
	public function getViewfilepath() {
		return $this->viewfilepath;
	}

	/**
	 * @param field_type $response
	 */
	public function setResponse($response) {
		$this->response = $response;
	}

        public function setVariable($variableName, $value) {
              $this->_variables[$variableName] = $value;
        }
        
        
        public function setVar($variableName, $value) {
              $this->_variables[$variableName] = $value;
        }
        
	/**
	 * @param field_type $viewfilepath
	 */
	public function setViewFilePath($viewfilepath) {
		$this->viewfilepath = $viewfilepath;
	}
        
        public function callbackWithJS($buffer)
        {   
            $buffer = $this->addJsLib($buffer);
            $buffer = $this->replaceWordByKey($buffer);
            return $buffer;
        }
        
        
        public function callback($buffer)
        {            
            return $this->replaceWordByKey($buffer);
        }
        /**
         *
         * @param type $buffer 
         */
        private function replaceWordByKey($buffer){
            /**
             * @todo: a java script and css header insertation
             */
            preg_match_all('/(%({\w*})({\w*})%|%({\w*})%)/', $buffer, $matches);
            $lang = LangService::getInstance();
            /**
             * @todo: consider two level keyword like %{A}{B}% 
             */
            foreach ($matches[0] as $idx => $rawWdKey) {
                $tmpWdKey = str_replace('%{', '', $rawWdKey);
                $wdKey = str_replace('}%', '', $tmpWdKey);
                $toReplaceWord = $lang->getWord($wdKey, LangReg::getLanguageCode()); 
                $buffer = str_replace($rawWdKey, $toReplaceWord, $buffer);
            }   
            
            return $buffer;
        }
        
        private function getHeaderJS($html){
            /**
             * @todo: a java script and css header insertation
             */
            $jsArray = array();
            preg_match_all('/<script.*script>/', $html, $matches); 
            foreach ($matches[0] as $idx => $js) {
                 if (!is_null($js) && !empty($js) && isset($js)){
                     $jsArray[] = $js;
                 }
            } 
            return $jsArray;
        }
        
        private function removeHeaderJSFromHtml($html, $jsArray){
             foreach ($jsArray as $idx => $replaceJS) {
                $html = str_replace($replaceJS, '', $html);
            }  
            return $html;
        }
        
                /**
         *
         * @param type $buffer 
         */
        private function addJsLib($buffer){
            /**
             * @todo: a java script and css header insertation
             *        set default value below, should use config.ini to replace them
             */
            $lib = '</title>';
            $lib = $lib  . '<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">';
            $lib = $lib  . '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>';
            $lib = $lib  . '<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>';

            /**
             *  @todo: javascript lib insertation 
             */
   
            $buffer = str_replace('</title>', $lib, $buffer);   
            
            return $buffer;
        }


	
}