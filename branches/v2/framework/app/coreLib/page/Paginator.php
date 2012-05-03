<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once '/usr/local/zend/apache2/htdocs/test/history/config/lib/Config.php';
//require_once '/usr/local/zend/apache2/htdocs/test/history/app/coreLib/db/MysqlAccess.php';
/**
 * Description of Paginator
 *
 * @author Hung-Fu Aaron Chang
 */
class Paginator{
    //put your code here
    private $_linkAction;
    private $_params;
    private $_totalPage;
    private $_numberItemsOnPage;
    private $_currentPage;
    private $_numberItemsOnPageKey;
    private $_pageKey;
    private $_pageHtml;
    
    private $db;

    public function __construct() {
        $this->_pageKey = "page";
        $this->_numberItemsOnPageKey = "items_per_page";
        $this->_currentPage = 1;
        $this->_numberItemsOnPage = 10;
        $this->initialDB();
    }
    
    public function setPageItemKeys($pageKey, $numberItemsOnPageKey) {
        $this->_pageKey = $pageKey;
        $this->_numberItemsOnPageKey = $numberItemsOnPageKey;
    }
    
    
    public function setPreviousNext($previousText, $nextText)
    {
        
    }
    
    public function initialDB() {
        $Config = Config::getInstance();
        $dbConfig_array = $Config->getDBConfig();

        //Check if the dbtype is "MySQL"
        if (strtolower($dbConfig_array['dbtype']) == "mysql") {
            $this->db = new MysqlAccess();
        }
        //Check if the dbtype is others....... 
    }
    
    public function setLinkAction($linkAction) {
        $this->_linkAction = $linkAction;
    }
    /**
     *
     * @param array $params 
     */
    public function setParams($params) {
        $this->_params = $params;
    }
    
    public function getPageHtmlBySQL($sql, $linkAction, $navPrefix = "<span class='page_number'>&nbsp;", $navPostfix = '&nbsp;</span>',  $currentPage = null, $numberItemsOnPage = null) {
        $search = "/^SELECT(.*)FROM/i";
        $replace = "SELECT COUNT(*) FROM";
        $sql = preg_replace($search, $replace, $sql);
        
        $search1 = "/LIMIT?((\s)+(\d)+,(\s)+(\d)+)/";
        $replace1 = "";
        $countSql = trim(preg_replace($search1, $replace1, $sql));
        
        
        $this->db->setStatement($countSql);
        $rows = mysql_fetch_array($this->db->execute());
        $this->_totalPage = $rows['COUNT(*)'];
        
        $pageHtml = '<div id="paginator" class="paginator">';
        
        $this->setLinkAction($linkAction);
        $currentPage = (is_null($currentPage)) ? $this->_currentPage : $currentPage;
        $numberItemsOnPage = (is_null($numberItemsOnPage)) ? $this->_numberItemsOnPage : $numberItemsOnPage;
        //$offset = round($numberItemsOnPage/2);
        $start = 1;
        $end = ceil($this->_totalPage/$numberItemsOnPage);
        $navPrefix = str_ireplace("'", '"', $navPrefix);
        $navPostfix = str_ireplace("'", '"', $navPostfix);
        $curNavPrefix = str_replace('class="', 'class="current_page ', $navPrefix);
        
        $paramsString = "";
        foreach ($this->_params as $key=>$value){
                 $paramsString = $paramsString . "&" .$key . "=" . $value;
        }
        
        for ($i = $start; $i<=$end; $i++) {
             if ($paramsString == "") {
                    $link = $this->_linkAction . '&' 
                          . $this->_pageKey . '=' . $i . '&'
                          . $this->_numberItemsOnPageKey . '=' . $numberItemsOnPage;
             } else {
                    $link = $this->_linkAction . '&' 
                          . $this->_pageKey . '=' . $i . '&'
                          . $this->_numberItemsOnPageKey . '=' . $numberItemsOnPage 
                          . $paramsString;                 
             }
             if ($i == $currentPage) {
                $pageHtml = $pageHtml . '<a id="page_link page_link_item_'. $i .'" href="'. $link .'" class="page_link page_link_'. $i .'">'.$curNavPrefix 
                          . $i . $navPostfix .'</a>';                 
             } else {
                $pageHtml = $pageHtml . '<a href="'. $link .'" class="page_link page_link_'. $i .'">' .$navPrefix 
                          . $i . $navPostfix .'</a>'; 
             }
        }
        $pageHtml = $pageHtml . '</div>';
        $this->_pageHtml = $pageHtml;
        

        return $this->_pageHtml;
        
    }
    
    private function getPreviousPage() {
        $prev = (($this->_currentPage - 1) < 1) ? 1 : ($this->_currentPage - 1);
        return $prev;
    }
    
    private function getNextPage()
    {
        $next = (($this->_currentPage + 1) > $this->_totalPage) ? $this->_totalPage : ($this->_currentPage + 1);
        return $next;
    }
    
    private function getTotalPage()
    {
        return $this->_totalPage;
    }
}

?>
