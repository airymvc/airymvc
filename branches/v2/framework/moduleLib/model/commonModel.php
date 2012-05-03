<?php
/**
 * This class collect all the common function for models. 
 */
class commonModel extends AppModel {
    

        public function getAllByPage($page, $number_page, $where, $table) 
	{
		if (is_null($page))
		{
                    $page = 1;
		}
		if (is_null($number_page))
		{
                    $number_page = 10;
		}
		$offset = ($page - 1)*$number_page;
                
		$columns[0] = '*';

                $this->db->select($columns, $table);
                $this->db->where($where);
                $this->db->limit($offset, $number_page);
		$mysql_results = $this->db->execute();	
		return $mysql_results;
	}
        
        public function getItemById($id, $table) 
	{
		$columns[0] = '*';
                $where = array(""=>array("="=>array('id'=>$id)));

                $this->db->select($columns, $table);
                $this->db->where($where);
                $mysql_results = $this->db->execute(); 

		return $mysql_results;
	}
        
        public function queryByName_Page($page, $number_page, $columns, $where, $table) 
	{
		if (is_null($page))
		{
			$page = 1;
		}
		if (is_null($number_page))
		{
			$number_page = 10;
		}
		$offset = ($page - 1)*$number_page;

		$this->db->select($columns, $table);
		$this->db->where($where);
		$this->db->limit($offset, $number_page);
		$mysql_results = $this->db->execute();	

		return $mysql_results;
	}
        
	public function addItem($columns, $table) 
	{
		$this->db->insert($columns, $table);
		$mysql_results = $this->db->execute();	

		return $mysql_results;
	}
	
	public function updateItem($columns, $where, $table) 
	{
                $this->db->update($columns, $table);   
                $this->db->where($where);
                $mysql_results = $this->db->execute();
		return $mysql_results;
	}
}
?>
