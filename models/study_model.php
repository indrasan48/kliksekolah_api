<?php

class study_model extends model {

    public function __construct() {
        parent::__construct();
    }

    public function list($req = array()) {

    	$return = array();
        $return['id'] = $req['id'];

        $year = date('Y');

        if(strtolower($req['lecturer']) == "all") {

	        $query = "
	        SELECT * FROM SISWA_Document$year WHERE document_organization=:document_organization
	        ";
	        $condition = array(
	            'document_organization' => $req['origin'],
	        );
	        $result = $this->db->_select($query,$condition);

	        $count_result = $this->db->_rr;
    	}
    	else {

    		$query = "
	        SELECT * FROM SISWA_Document$year WHERE document_guru=:document_guru AND document_organization=:document_organization
	        ";
	        $condition = array(
	            'document_guru' => $req['lecturer'],
	            'document_organization' => $req['origin'],
	        );
	        $result = $this->db->_select($query,$condition);

	        $count_result = $this->db->_rr;

    	}

        if($count_result) {
            $return['status'] = '1';
            $return['messages'] = 'study data list';
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