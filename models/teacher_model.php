<?php

class teacher_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function listdata($req = array()) {

    	$return = array();
        $return['id'] = $req['id'];

        if(strtolower($req['filter']) == "all") {

            $query = "
            SELECT * FROM SISWA_Guru WHERE guru_organization=:guru_organization
            ";
            $condition = array(
                'guru_organization' => $req['origin'],
            );
            $result = $this->db->_select($query,$condition);

            $count_result = $this->db->_rr;
        }
        else {

            $query = "
            SELECT * FROM SISWA_Guru WHERE guru_organization=:guru_organization AND guru_nama=:guru_nama
            ";
            $condition = array(
                'guru_nama' => $req['filter'],
                'guru_organization' => $req['origin'],
            );
            $result = $this->db->_select($query,$condition);

            $count_result = $this->db->_rr;
        }

    	

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'teacher data list';
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