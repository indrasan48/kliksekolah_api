<?php

class wisdom extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
    }


    function listdata() {
        glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['origin'] = isset($_POST['origin']) && $_POST['origin'] !== "" ? $_POST['origin'] : '';
        $result = $this->model->listdata($req);
        echo json_encode($result);
    }

    function like() {
        glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['code'] = isset($_POST['code']) && $_POST['code'] !== "" ? $_POST['code'] : '';
        $req['origin'] = isset($_POST['origin']) && $_POST['origin'] !== "" ? $_POST['origin'] : '';
        $req['time'] = isset($_POST['time']) && $_POST['time'] !== "" ? $_POST['time'] : '';
        $result = $this->model->like($req);
        echo json_encode($result);

    }
}

?>