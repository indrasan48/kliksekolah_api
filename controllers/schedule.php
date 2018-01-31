<?php

class schedule extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    function listdata() {
    	glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['origin'] = isset($_POST['origin']) && $_POST['origin'] !== "" ? $_POST['origin'] : '';
        $req['month'] = isset($_POST['month']) && $_POST['month'] !== "" ? $_POST['month'] : '';
        $result = $this->model->listdata($req);
        echo json_encode($result);
    }
}

?>