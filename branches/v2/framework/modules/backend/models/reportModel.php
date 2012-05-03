<?php
class reportModel extends commonModel {
	

    public function __construct()
    {
        $this->initialDB();
    }
    
    	public function getEventReportByPageStatus($page, $number_page, $status = null) 
	{
		if (is_null($page)) {
			$page = 1;
		}
		if (is_null($number_page)) {
			$number_page = 10;
		}
                
		$offset = ($page - 1)*$number_page;
                
		$columns = array(0=>'event.id',
                                 1=>'event_report.event_id',
                                 2=>'member.id',
                                 3=>'event_report.reason',
                                 4=>'event.status',
                                 5=>'event_report.report_date',
                                 6=>'member.account_id',
                                 7=>'event.title');
                $joinTables = array (0 => 'event_report',
                                     1 => 'member');
                $condition = array ("AND" => array(array("=", 'event'       => 'id', 
                                                              'event_report'=> 'event_id'),
                                                   array("=", 'member'      => 'id', 
                                                              'event_report'=> 'member_id') 
                                   ));
                
                $this->db->select($columns, 'event');
                $this->db->innerJoin ($joinTables);
                $this->db->joinOn($condition);
                if (!is_null($status)) {
                    $where = array(""=>array("="=>array('event.status'=>$status)));
                    $this->db->where($where); 
                } 
                $this->db->limit($offset, $number_page);           
		$mysql_results = $this->db->execute();	

		return $mysql_results; 
	}
	
}