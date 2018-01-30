<?php

class chat extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    function list() {
    	glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['userid'] = isset($_POST['userid']) && $_POST['userid'] !== "" ? $_POST['userid'] : '';
        $result = $this->model->list($req);
        echo json_encode($result);
    }

    function detail() {
    	glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['userid'] = isset($_POST['userid']) && $_POST['userid'] !== "" ? $_POST['userid'] : '';
        $req['teacherid'] = isset($_POST['teacherid']) && $_POST['teacherid'] !== "" ? $_POST['teacherid'] : '';
        $result = $this->model->detail($req);
        echo json_encode($result);
    }
}

?>