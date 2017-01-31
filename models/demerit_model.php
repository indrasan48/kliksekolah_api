<?php

class demerit_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function listdata($req = array()) {

    	$return = array();
        $return['id'] = $req['id'];

        $year = date('Y');

        $query = "
        SELECT * FROM SISWA_Demerit$year WHERE demerit_eon_id=:demerit_eon_id AND demerit_organization=:demerit_organization
        ";
        $condition = array(
            'demerit_eon_id' => $req['userid'],
            'demerit_organization' => $req['origin'],
        );
        $result = $this->db->_select($query,$condition);

        $count_result = $this->db->_rr;
    	

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'demerit data list';
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