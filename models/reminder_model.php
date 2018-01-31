<?php

class reminder_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function listdata($req = array()) {

    	$return = array();
        $return['id'] = $req['id'];

        $year = date('Y');

        if(strtolower($req['month']) == "all") {

	        $query = "
	        SELECT * FROM EON_Reminder 
            WHERE reminder_eon_id=:reminder_eon_id 
            AND reminder_organization=:reminder_organization
	        ";
	        $condition = array(
	            'reminder_eon_id' => $req['userid'],
	            'reminder_organization' => $req['origin'],
	        );
	        $result = $this->db->_select($query,$condition);

	        $count_result = $this->db->_rr;
    	}
    	else {

    		$date = date_parse($req['month']);
  			$m = $date['month'];

    		$query = "
	        SELECT * FROM EON_Reminder 
            WHERE MONTH(reminder_target_date)=:reminder_target_date 
            AND reminder_eon_id=:reminder_eon_id 
            AND reminder_organization=:reminder_organization
	        ";
	        $condition = array(
	        	'reminder_target_date' => $m,
	            'reminder_eon_id' => $req['userid'],
	            'reminder_organization' => $req['origin'],
	        );
	        $result = $this->db->_select($query,$condition);

	        $count_result = $this->db->_rr;

    	}

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'reminder data list';
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