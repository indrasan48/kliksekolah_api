<?php

class database {

    VAR $PDO;

    /**
     *
     * @param String $db_type type database (server, MYSQL)
     * @param String $db_host ip database
     * @param String $db_name database used
     * @param Int $db_port port database
     * @param Sting $db_user user login database
     * @param String $db_pass password login database
     */
    function __construct($db_type, $db_host, $db_name, $db_port, $db_user, $db_pass) {
        $this->PDO = new PDO($db_type . ':host=' . $db_host . ';dbname=' . $db_name . '; port=' . $db_port, $db_user, $db_pass);
        $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     *
     * @param String $table table name
     * @param Array $data key => field database, value => insert value data
     * @return Mixed Integer = row affected, String HTML error
     */
    function _insert($table, $data = array()) {
        try {
            ksort($data);
            $fieldname = implode(',', array_keys($data));
            $fieldvalue = ':' . implode(', :', array_keys($data));

            /* reql query */
            $rqvalue = '\'' . implode('\',\'', array_values($data)) . '\'';

            $this->_rq = 'INSERT INTO ' . $table . ' (' . $fieldname . ') VALUES (' . $rqvalue . ')';

            $query = 'INSERT INTO ' . $table . ' (' . $fieldname . ') VALUES (' . $fieldvalue . ')';
            $statement = $this->PDO->prepare($query);

            foreach ($data as $key => $value) {
                $statement->bindValue(':' . $key, $value);
            }

            $statement->execute();
            $this->_rr = $statement->rowCount();
            return $statement->rowCount();

            $statement = null;
            $this->PDO = null;
        } 
        catch (Exception $e) {
            $this->_return_error($e->getMessage(),$query);    
        }
    }

    /**
     *
     * @param String $table table name
     * @param Array $data key => field database, value => insert value data
     * @param type $conditionfield key => field database, value => where value data
     * @return Mixed Integer = row affected, String HTML error
     */
    function _update($table, $data = array(), $conditionfield = array()) {
        try {

            ksort($data);
            ksort($conditionfield);
            $updatedata = null;
            $wheredata = null;
            $rqwhere = null;
            $rqupdate = null;
            foreach ($data as $key => $value) {
                $updatedata .= $key . ' = :' . $key . ', ';
                $rqupdate .= $key . ' = \'' . $value . '\', ';
            }

            $updatedata = rtrim($updatedata, ', ');
            $rqupdate = rtrim($rqupdate, ', ');

            foreach ($conditionfield as $key => $value) {
                $wherekey = 'where' . $key;
                $conditionfield[$wherekey] = $conditionfield[$key];
                unset($conditionfield[$key]);
                $wheredata .= $key . ' = :' . $wherekey . ' AND ';
                $rqwhere .= $key . ' = \'' . $value . '\' AND ';
            }
            $wheredata = rtrim($wheredata, ' AND ');
            $rqwhere = rtrim($rqwhere, ' AND ');

            $finalarray = array_merge($data, $conditionfield);
            ksort($finalarray);


            $this->_rq = 'UPDATE ' . $table . ' SET ' . $rqupdate . ' WHERE ' . $rqwhere;
            $query = 'UPDATE ' . $table . ' SET ' . $updatedata . ' WHERE ' . $wheredata;
            $statement = $this->PDO->prepare($query);

            foreach ($finalarray as $key => $value) {
                $statement->bindValue(':' . $key, $value);
            }
            $statement->execute();
            $this->_rr = $statement->rowCount();
            return $statement->rowCount();

            $statement = null;
            $this->PDO = null;
        } 
        catch (Exception $e) {
            $this->_return_error($e->getMessage(),$query);    
        }
    }

    /**
     *
     * @param String $query query to database
     * @param Array $conditionfield key => field database, value => where value data
     * @param PDO $fetchmode FETCH MODE database
     * @return Mixed Integer = row affected, String HTML error
     */
    function _select($query, $conditionfield = array(), $fetchmode = PDO::FETCH_ASSOC) {
        try {
            $statement = $this->PDO->prepare($query);

            foreach ($conditionfield as $key => $value) {
                $statement->bindValue($key, $value);
            }
            $statement->execute();

            $this->_rr = $statement->rowCount();
            return $statement->fetchall($fetchmode);

            $statement = null;
            $this->PDO = null;
        } 
        catch (Exception $e) {
            $this->_return_error($e->getMessage(),$query);    
        }
    }

    function _customexec($query, $conditionfield = array()) {
        try {
            $statement = $this->PDO->prepare($query);
            foreach ($conditionfield as $key => $value) {
                $statement->bindValue($key, $value);
            }
            $statement->execute();
            $this->_rr = $statement->rowCount();
            return $statement->rowCount();
            $statement = null;
            $this->PDO = null;
        } 
        catch (Exception $e) {
            $this->_return_error($e->getMessage(),$query);    
        }
    }

    function _call($callfucntion, $fetchmode = PDO::FETCH_ASSOC) {
        try {
            $statement = $this->PDO->prepare($callfucntion);
            $statement->execute();

            $this->_rr = $statement->rowCount();
            return $statement->fetchall($fetchmode);

            $statement = null;
            $this->PDO = null;
        } 
        catch (Exception $e) {
            $this->_return_error($e->getMessage(),$query);    
        }
    }

    /**
     *
     * @param Sting $table table name
     * @param Array $conditionfield key => field database, value => where value data
     * @return Mixed Integer = row affected, String HTML error
     */
    function _delete($table, $conditionfield = array()) {
        try {
            ksort($conditionfield);

            $wheredata = null;
            $rqwhere = null;
            foreach ($conditionfield as $key => $value) {
                $wheredata .= ' ' . $key . ' = :' . $key . ' and';
                $rqwhere .= ' ' . $key . ' = \'' . $value . '\' and';
            }
            $wheredata = rtrim($wheredata, 'and');
            $rqwhere = rtrim($rqwhere, 'and');

            $this->_rq = 'DELETE FROM ' . $table . ' WHERE ' . $rqwhere;
            //echo $this->_rq;
            $query = 'DELETE FROM ' . $table . ' WHERE ' . $wheredata;
            $statement = $this->PDO->prepare($query);
            foreach ($conditionfield as $key => $value) {
                $statement->bindValue(':' . $key, $value);
            }
            $statement->execute();
            $this->_rr = $statement->rowCount();
            return $statement->rowCount();

            $statement = null;
            $this->PDO = null;
        } 
        catch (Exception $e) {
            $this->_return_error($e->getMessage(),$query);    
        }
    }

    /**
     *
     * @param Array $variable Data to encryption
     * @return Array Data decryption
     */
    function _htmlspecial_array(&$variable) {
        foreach ($variable as $valuae => &$value) {
            if (!is_array($value)) {
                $value = htmlspecialchars($value);
            } else {
                $this->_htmlspecial_array($value);
            }
        }
        return $variable;
    }

    function _return_error($errmsg,$data) {

    	$data = str_replace("\n", "", $data);
    	$data = str_replace("\t", "", $data);
    	$data = str_replace("        ", "", $data);


        if (DB_DEBUG) {
	    	$return = array();
	    	$return['id'] = "ERROR";
	        $return['status'] = 'ERROR';
	        $return['messages'] = $errmsg;
	        $return['data'] = $data;
    	}
    	else {
	    	$return = array();
	    	$return['id'] = "ERROR";
	        $return['status'] = 'ERROR';
	        $return['messages'] = "SERVER DATABASE ERROR\nPLEASE CONTACT YOUR ADMINISTRATOR";
	        $return['data'] = $data;
    	}

        echo json_encode($return);

        exit();
    }

}
