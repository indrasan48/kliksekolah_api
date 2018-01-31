<?php

class invoice_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function listdata($req = array()) {

    	$return = array();
        $return['id'] = $req['id'];

        $year = date('Y');

        if(strtolower($req['month']) == "all") {

	        $query = "
	        SELECT * FROM SISWA_Invoice$year 
            WHERE invoice_eon_id=:invoice_eon_id 
            AND invoice_organization=:invoice_organization
	        ";
	        $condition = array(
	            'invoice_eon_id' => $req['userid'],
	            'invoice_organization' => $req['origin'],
	        );
	        $result = $this->db->_select($query,$condition);

	        $count_result = $this->db->_rr;
    	}
    	else {

    		$date = date_parse($req['month']);
  			$m = $date['month'];

    		$query = "
	        SELECT * FROM SISWA_Invoice$year 
            WHERE MONTH(invoice_date)=:invoice_date 
            AND invoice_eon_id=:invoice_eon_id 
            AND invoice_organization=:invoice_organization
	        ";
	        $condition = array(
	        	'invoice_date' => $m,
	            'invoice_eon_id' => $req['userid'],
	            'invoice_organization' => $req['origin'],
	        );
	        $result = $this->db->_select($query,$condition);

	        $count_result = $this->db->_rr;

    	}

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'invoice data list';
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