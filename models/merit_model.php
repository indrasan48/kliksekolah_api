<?php

class merit_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function listdata($req = array()) {

    	$return = array();
        $return['id'] = $req['id'];

        $year = date('Y');

        $query = "
        SELECT * FROM SISWA_Merit$year WHERE merit_eon_id=:merit_eon_id AND merit_organization=:merit_organization
        ";
        $condition = array(
            'merit_eon_id' => $req['userid'],
            'merit_organization' => $req['origin'],
        );
        $result = $this->db->_select($query,$condition);

        $count_result = $this->db->_rr;
    	

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'merit data list';
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