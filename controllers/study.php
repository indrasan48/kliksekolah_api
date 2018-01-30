<?php

class study extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    function list() {
    	glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['origin'] = isset($_POST['origin']) && $_POST['origin'] !== "" ? $_POST['origin'] : '';
        $req['lecturer'] = isset($_POST['lecturer']) && $_POST['lecturer'] !== "" ? $_POST['lecturer'] : '';
        $result = $this->model->list($req);
        echo json_encode($result);
    }
}

?>