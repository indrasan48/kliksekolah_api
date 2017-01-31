<?php

class attendance_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function listdata($req = array()) {

    	$return = array();
        $return['id'] = $req['id'];

        $year = date('Y');

        if(strtolower($req['month']) == "all") {

	        $query = "
	        SELECT * FROM SISWA_Absen$year WHERE absen_eon_id=:absen_eon_id AND absen_organization=:absen_organization
	        ";
	        $condition = array(
	            'absen_eon_id' => $req['userid'],
	            'absen_organization' => $req['origin'],
	        );
	        $result = $this->db->_select($query,$condition);

	        $count_result = $this->db->_rr;
    	}
    	else {

    		$date = date_parse($req['month']);
  			$m = $date['month'];

    		$query = "
	        SELECT * FROM SISWA_Absen$year WHERE MONTH(absen_tanggal)=:absen_tanggal AND absen_eon_id=:absen_eon_id AND absen_organization=:absen_organization
	        ";
	        $condition = array(
	        	'absen_tanggal' => $m,
	            'absen_eon_id' => $req['userid'],
	            'absen_organization' => $req['origin'],
	        );
	        $result = $this->db->_select($query,$condition);

	        $count_result = $this->db->_rr;

    	}

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'attendance data list';
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