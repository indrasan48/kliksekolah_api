<?php

class merit extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    function listdata() {
    	glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['origin'] = isset($_POST['origin']) && $_POST['origin'] !== "" ? $_POST['origin'] : '';
        $req['userid'] = isset($_POST['userid']) && $_POST['userid'] !== "" ? $_POST['userid'] : '';
        $result = $this->model->listdata($req);
        echo json_encode($result);
    }
}

?>