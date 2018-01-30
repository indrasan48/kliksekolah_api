<?php

class chat_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function list($req = array()) {

    	$return = array();
        $return['id'] = $req['id'];

        $query = "
        SELECT * FROM EON_chat ec
		WHERE ec.idstudent = :userid 
		ORDER BY ec.idteacher
        ";
        $condition = array(
            'userid' => $req['userid'],
        );
        $result = $this->db->_select($query,$condition);

        $count_result = $this->db->_rr;
    	

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'chat data list';
            $return['data'] = $result;
        }
        else {
            $return['status'] = '0';
            $return['messages'] = 'no data';
            $return['data'] = array('data' => 'null');
        }
        return $return;
    }

    public function detail($req = array()) {

    	$return = array();
        $return['id'] = $req['id'];

        $query = "
		SELECT * FROM EON_chat ec
		JOIN EON_chat_detail ecd
		ON ec.kdchat = ecd.kdchat
		WHERE ec.idstudent = :userid AND ec.idteacher = :teacherid;
        ";
        $condition = array(
            'userid' => $req['userid'],
            'teacherid' => $req['teacherid'],
        );
        $result = $this->db->_select($query,$condition);

        $count_result = $this->db->_rr;
    	

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'chat data list';
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