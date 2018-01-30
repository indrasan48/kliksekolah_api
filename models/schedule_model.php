<?php

class schedule_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function list($req = array()) {

    	$return = array();
        $return['id'] = $req['id'];

        $year = date('Y');

        if(strtolower($req['month']) == "all") {

	        $query = "
	        SELECT * FROM Txn_AssPlanHead WHERE project_organization=:project_organization
	        ";
	        $condition = array(
	            'project_organization' => $req['origin'],
	        );
	        $result = $this->db->_select($query,$condition);

	        $count_result = $this->db->_rr;
    	}
    	else {

    		$date = date_parse($req['month']);
  			$m = $date['month'];

    		$query = "
	        SELECT * FROM Txn_AssPlanHead WHERE MONTH(project_start_date)=:absen_tanggal AND project_organization=:project_organization
	        ";
	        $condition = array(
	        	'absen_tanggal' => $m,
	            'project_organization' => $req['origin'],
	        );
	        $result = $this->db->_select($query,$condition);

	        $count_result = $this->db->_rr;

    	}

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'schedule data list';
            $return['data'] = $result;
        }
        else {
            $return['status'] = '0';
            $return['messages'] = 'no data';
            $return['data'] = array('data' => 'null');
        }
        return $return;
    }

}

?>