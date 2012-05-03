<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of eventEditModel
 *
 * @author changA
 */
class eventEditModel extends commonModel{
    
    	public function __construct() 
	{
		$this->initialDB();
	}
        
        public function getMemberInfo($account_id, $table)
        {
            $where = array("AND"=>array("="=>array('account_id'=>$account_id, 'isdelete' => 0)));
            $columns[0] = '*';

            $this->db->select($columns, $table);
            $this->db->where($where);
            $mysql_results = $this->db->execute();	
            return $mysql_results;
        }
}

?>
