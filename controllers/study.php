<?php

class study extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    function listdata() {
    	glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['origin'] = isset($_POST['origin']) && $_POST['origin'] !== "" ? $_POST['origin'] : '';
        $req['lecturer'] = isset($_POST['lecturer']) && $_POST['lecturer'] !== "" ? $_POST['lecturer'] : '';
        $result = $this->model->listdata($req);
        echo json_encode($result);
    }
}

?>