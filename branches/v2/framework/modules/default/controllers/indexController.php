<?php
class indexController extends AclController
{

	
	public function indexAction()
	{
            $lastWhere = array(""=>array("="=>array('isonline'=>'1')));
            $lastFiveEvents = $this->model->getLastNEntries(5, $lastWhere, 'event');
            $d =  date('m,d,Y');
            $jdy = explode(",", $d);
            $month = $jdy[0];
            $day = $jdy[1];
            $todayWhere = array("AND"=>array("="=>array('month'=>$month, 'day'=>$day)));
            $todayEvents = $this->model->getEventInToday(5, $todayWhere);
            $this->view->setVariable('todayEvents', $todayEvents);
            $this->view->setVariable('lastFiveEvents', $lastFiveEvents);
            /**
             * When call login function, login function contains $this->view->render(); 
             */
            $demoTab = new demoTab("dtab");
            //var_dump($demoTab);
            //echo $demoTab->render();
            $this->view->setVariable('demo_tab', $demoTab);
            $this->login(null, "form");

	}
        
        public function eventDetailAction(){
            $id = $this->params['id'];
            $eventDetail = $this->model->getItemById($id, 'event');
            //$rows = mysql_fetch_array($eventDetail, MYSQL_BOTH);
            //var_dump($rows);
            $this->switchView('default', 'eventdetail');
            $this->view->setVariable('eventDetail', $eventDetail);          
            $this->login('eventdetail', "form");
            
        }
        
        public function searchAction(){
            $moduleName = MvcReg::getModuleName();
            $_SESSION[$moduleName]['uid'] = "guest";
            $page = null;
            $number_page = null;
            $mysql_results = null;
            $html = null;
            if (isset($this->params['query'])) { 
                echo "Dddd" .  $this->params['query'];
                $query = (isset($_SESSION[$moduleName][$uid]['query'])) ? $_SESSION[$moduleName][$uid]['query'] : null;
        
                $page = $this->params['page'];
                $number_page = $this->params['number_page'];
                $columns = array('*');
                if (!is_null($this->params['query'])) {
                    $query = '%' . $this->params['query'] .'%';
                    $_SESSION[$moduleName][$uid]['query'] = $query;
                }
                $where = array("AND"=>array("="=>array('isonline'=>1), "LIKE"=>array('title'=>$query)));
                $table = "event";
                //get the raw (orginal) mysql results
                $mysql_results = $this->model->queryByName_Page($page, $number_page, $columns, $where, $table);
                
                $sql = $this->model->db->getStatement();
                $linkAction = $this->getCurrentActionURL();
                $pageNav = new Paginator();
                $pageNav->setPageItemKeys("page", "number_page");
                $pageNav->setParams($this->params);
                $html = $pageNav->getPageHtmlBySQL($sql, $linkAction);   
            } else { 
                $month = (isset($_SESSION[$moduleName][$uid]['month'])) ? $_SESSION[$moduleName][$uid]['month'] : null;
                $day = (isset($_SESSION[$moduleName][$uid]['day'])) ? $_SESSION[$moduleName][$uid]['day'] : null;
        
                $page = $this->params['page'];
                $number_page = $this->params['number_page'];
                $columns = array('*');
                if (!is_null($this->params['month']) && !is_null($this->params['day'])) {
                    $month = $this->params['month'];
                    $day   = $this->params['day'];
                    $_SESSION[$moduleName][$uid]['month'] = $month;
                    $_SESSION[$moduleName][$uid]['day']   = $day;
                }
                $where = array("AND"=>array("="=>array("isonline"=> 1,
                                                       "month"   => $month,
                                                       "day"     => $day
                                                      )));      
                $table = "event";
                //get the raw (orginal) mysql results
                $mysql_results = $this->model->queryByName_Page($page, $number_page, $columns, $where, $table);

                $sql = $this->model->db->getStatement();
                
                $linkAction = $this->getCurrentActionURL();
                $pageNav = new Paginator();
                $pageNav->setPageItemKeys("page", "number_page");
                $pageNav->setParams($this->params);
                $html = $pageNav->getPageHtmlBySQL($sql, $linkAction);           
            }
            $loginForm = new LoginForm($moduleName);
            $this->switchView('default', 'search');
            $this->view->setVariable("page", $page);
            $this->view->setVariable("number_page", $number_page);
            $this->view->setVariable("mysql_results", $mysql_results);
            $this->view->setVariable("paginator", $html);
            $this->view->setVariable("form", $loginForm);
            $this->view->render();
            
        }
}
?>
