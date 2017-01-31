<?php

class wisdom_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function listdata($req = array()) {

        $return = array();
        $return['id'] = $req['id'];

        $query = "
        SELECT * FROM EON_Wisdom WHERE wisdom_eon_organization=:wisdom_eon_organization
        ";
        $condition = array(
            'wisdom_eon_organization' => $req['origin'],
        );
        $result = $this->db->_select($query,$condition);

        $count_result = $this->db->_rr;

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'wisdom data list';
            $return['data'] = $result;
        }
        else {
            $return['status'] = '0';
            $return['messages'] = 'no data';
            $return['data'] = array('data' => 'null');
        }
        return $return;
    }

    public function like($req = array()) {

        $return = array();
        $return['id'] = $req['id'];

        $query = "SELECT * FROM EON_Wisdom WHERE wisdom_eon_id=:wisdom_eon_id AND wisdom_eon_organization=:wisdom_eon_organization AND wisdom_time=:wisdom_time";
        $condition = array(
            'wisdom_eon_id' => $req['code'],
            'wisdom_eon_organization' => $req['origin'],
            'wisdom_time' => $req['time'],
        );
        $result = $this->db->_select($query,$condition);

        $count_result = $this->db->_rr;

        $likes = 0;

        if($count_result) {
        	$likes = $result[0]['wisdom_like'];
        }

        $update_table = "EON_Wisdom";
        $update_data = array(
        	'wisdom_like' => $likes + 1,
        );
        $update_cond = array(
            'wisdom_eon_id' => $req['code'],
            'wisdom_eon_organization' => $req['origin'],
            'wisdom_time' => $req['time'],
        );

        $this->db->_update($update_table,$update_data,$update_cond);

        $count_result = $this->db->_rr;
        
        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'like success';
            $return['data'] = array('like' => 'success');
        }
        else {
            $return['status'] = '0';
            $return['messages'] = 'like failed';
            $return['data'] = array('like' => 'failed');
        }
        return $return;
    }
}

?>