<?php
class loginModel extends AppModel {
	
   /*
	*  $this->initialDB()
	*  Use $this->db to use function  to get mysql
	*/
	public function __construct() 
	{
		$this->initialDB();
	}

	
	public function getUserByUId($and, $where, $table) 
	{
		/*
		 *  Do a select * from table limit by page, number_per_page
		 */
		$columns[0] = '*';
		//preSelect($columns, $table) = (array, string)
		$this->db->prepareSelect($columns, $table);
		$this->db->putWhere($where);
		$this->db->putAnd($and);
		$stmt = $this->db->getQuery_stmt();
		$mysql_results = $this->db->executeStatement();	

		return $mysql_results;
	}
	


	
}