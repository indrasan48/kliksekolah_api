<?php

class teacher extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    function list() {
    	glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['origin'] = isset($_POST['origin']) && $_POST['origin'] !== "" ? $_POST['origin'] : '';
        $req['filter'] = isset($_POST['filter']) && $_POST['filter'] !== "" ? $_POST['filter'] : '';
        $result = $this->model->list($req);
        echo json_encode($result);
    }
}

?>