<?php

class chat extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    function listdata() {
    	glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['userid'] = isset($_POST['userid']) && $_POST['userid'] !== "" ? $_POST['userid'] : '';
        $result = $this->model->listdata($req);
        echo json_encode($result);
    }

    function detail() {
    	glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['userid'] = isset($_POST['userid']) && $_POST['userid'] !== "" ? $_POST['userid'] : '';
        $req['chatid'] = isset($_POST['chatid']) && $_POST['chatid'] !== "" ? $_POST['chatid'] : '';
        $result = $this->model->detail($req);
        echo json_encode($result);
    }
}

?>