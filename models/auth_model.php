<?php

class auth_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function login($req = array()) {

        $return = array();
        $return['id'] = $req['id'];

        $query = "
        SELECT * FROM eon_user WHERE eon_id=:eon_id AND eon_password=:eon_password AND eon_organization=:eon_organization
        ";
        $condition = array(
            'eon_id' => $req['userid'],
            'eon_password' => $req['password'],
            'eon_organization' => $req['origin'],
        );
        $result = $this->db->_select($query,$condition);

        $count_result = $this->db->_rr;

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'login success';
            $return['data'] = $result[0];
        }
        else {
            $return['status'] = '0';
            $return['messages'] = 'login failed';
            $return['data'] = array('data' => 'null');
        }
        return $return;
    }

    public function logout($req = array()) {

        $return = array();
        $return['id'] = $req['id'];

        $return['status'] = '1';
        $return['messages'] = 'logout success';
        $return['data'] = array();
        return $return;
    }

}

?>