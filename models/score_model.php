<?php

class score_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function listdata($req = array()) {

    	$return = array();
        $return['id'] = $req['id'];

        $year = date('Y');

        if(strtolower($req['month']) == "all") {

	        $query = "
	        SELECT * FROM SISWA_Ulangan$year 
            WHERE ulangan_eon_id=:ulangan_eon_id 
            AND ulangan_organization=:ulangan_organization
	        ";
	        $condition = array(
	            'ulangan_eon_id' => $req['userid'],
	            'ulangan_organization' => $req['origin'],
	        );
	        $result = $this->db->_select($query,$condition);

	        $count_result = $this->db->_rr;
    	}
    	else {

    		$date = date_parse($req['month']);
  			$m = $date['month'];

    		$query = "
	        SELECT * FROM SISWA_Ulangan$year 
            WHERE MONTH(ulangan_tanggal)=:ulangan_tanggal 
            AND ulangan_eon_id=:ulangan_eon_id 
            AND ulangan_organization=:ulangan_organization
	        ";
	        $condition = array(
	        	'ulangan_tanggal' => $m,
	            'ulangan_eon_id' => $req['userid'],
	            'ulangan_organization' => $req['origin'],
	        );
	        $result = $this->db->_select($query,$condition);

	        $count_result = $this->db->_rr;

    	}

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'score data list';
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