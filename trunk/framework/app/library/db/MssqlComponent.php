<?php

/**
 * AiryMVC Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license.
 *
 * It is also available at this URL: http://opensource.org/licenses/BSD-3-Clause
 * The project website URL: https://code.google.com/p/airymvc/
 *
 * @author: Hung-Fu Aaron Chang
 */

class MssqlComponent extends SqlComponent{

    function __construct($databaseId = 0) {
		parent::__construct($databaseId);
    }
    
    /*
     *  $offset @int
     *  $interval @int
     *  
     *  But, we use the following generic solution since we do not have a key.
	 *  
	 *  SELECT TOP $interval * FROM tablename
	 *  WHERE key NOT IN (
     *		SELECT TOP $offset key
     *		FROM tablename
     *		ORDER BY key
	 *	);
	 *  
	 *  After SQL 2005, database has ROW_NUMBER(), so we can use the following. 
	 *  That means that we can only support MS SQL 2005 or above.
	 *  
	 *  SELECT * FROM 
	 *  (SELECT *, ROW_NUMBER() OVER (ORDER BY name) as row FROM table_name) a 
	 *  WHERE row > 5 and row <= 10
	 *  
     */

    public function limit($offset, $interval) {
        $this->limitPart = "";
        $offset = (!is_null($offset)) ? $offset : 0;

        $endNumber = $offset + $interval;
        $this->limitPart = " (row > {$offset}) and (row <= {$endNumber})";
        return $this;
    }
    
    
//    /**
//     * @return the $queryStmt
//     */
//    
//    public function getStatement() {
//        //Combine every part of the query statement
//        switch ($this->queryType) {
//            case "SELECT":
//                $this->queryStmt = null; 
//				$this->queryStmt = $this->composeSelectStatement($this->selectPart, $this->joinPart, $this->joinOnPart, $this->wherePart, 
//									 							 $this->groupPart, $this->orderPart, $this->limitPart);
//                break;
//            case "UPDATE":
//                $this->queryStmt = null;
//                $this->queryStmt = $this->updatePart . $this->wherePart;
//                break;
//            case "INSERT":
//                $this->queryStmt = null;
//                $this->queryStmt = $this->insertPart;
//                break;
//            case "DELETE":
//                $this->queryStmt = null;
//                $this->queryStmt = $this->deletePart . $this->wherePart;
//                break;
//        }
//        return $this->queryStmt;
//    }
    
    
    public function composeSelectStatement($selectPart, $joinPart, $joinOnPart, $wherePart, $groupPart, $orderPart, $limitPart) {
        $queryStmt = ""; 
    	if ($limitPart != "") {
             if ($wherePart != "") {
                 $wherePart .= "AND {$limitPart}";
             }
             $selectParts = explode ("FROM", $selectPart);
             $newSelectParts = $selectParts[0];
             $selectFields = trim(str_ireplace("SELECT", "", $newSelectParts));
             $tableName = $selectParts[1];
                	
     		 // (SELECT *, ROW_NUMBER() OVER (ORDER BY name) as row FROM table_name) a
     		 $fromPart = " FROM (SELECT {$selectFields}, ROW_NUMBER() OVER ({$orderPart}) as row FROM {$tableName}) a";                	
             $queryStmt = $newSelectParts . $fromPart . $joinPart 
                		      . $joinOnPart . $wherePart . $groupPart;
          } else {
             $queryStmt = $selectPart . $joinPart . $joinOnPart
                              . $wherePart . $groupPart . $orderPart; 
          }
          return $queryStmt;
    }
    
    public function execute($statement = NULL) {

    	$statement = is_null($statement) ? $this->getStatement() : $statement;
        $con = mssql_connect($this->dbConfigArray['host'], $this->dbConfigArray['id'], $this->dbConfigArray['pwd']);
        mssql_set_charset($this->dbConfigArray['encoding'] ,$con);
          
        if (!$con) {
            die('Could not connect: ' . mssql_error());
        }

        mssql_select_db($this->dbConfigArray['database'], $con);
        $mssql_results = mssql_query($statement);

        if (!$mssql_results) {
            die('Could not query:' . mssql_error());
        }
        mssql_close($con);
        $this->cleanAll();
        
        return $mssql_results;
    }



    function sqlEscape($content) {
        return $content;
    }


}

?>
