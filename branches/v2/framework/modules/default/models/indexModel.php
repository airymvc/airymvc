<?php
class indexModel extends commonModel{
    
    	public function __construct() 
	{
		$this->initialDB();
	}
	/**
         *
         * @param integer $number
         * @param string $where
         * @return array : mysql result 
         */
        public function getEventInToday($number, $where) 
	{                
                $this->db->select(array(0 =>'*'), 'event');
                $this->db->where($where);
                $this->db->limit(null, $number);
		$mysql_results = $this->db->execute();	
		return $mysql_results;
	}
	/**
         * SELECT columns FROM table where condition ORDER BY id DESC LIMIT n;
         * @param integer $lastN
         * @param string $table 
         */
        public function getLastNEntries($lastN, $where, $table)
        {
		$columns = array (0 => '*');
                $this->db->select($columns, $table);
                $this->db->where($where);
                $this->db->limit(null, $lastN);
                $this->db->orderBy("id", "DESC");
		$mysql_results = $this->db->execute();	
		return $mysql_results;            
        }
}