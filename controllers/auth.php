<?php

class auth extends controller {

    function __construct() {
        parent::__construct();
    }

     function index() {
        
    }


    function login() {
        glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['userid'] = isset($_POST['userid']) && $_POST['userid'] !== "" ? $_POST['userid'] : '';
        $req['password'] = isset($_POST['password']) && $_POST['password'] !== "" ? $_POST['password'] : '';
        $req['origin'] = isset($_POST['origin']) && $_POST['origin'] !== "" ? $_POST['origin'] : '';
        $result = $this->model->login($req);
        echo json_encode($result);
    }

    function logout() {
        glfn::_xml_http_request();
        $req['id'] = isset($_POST['id']) && $_POST['id'] !== "" ? $_POST['id'] : '';
        $req['userid'] = isset($_POST['userid']) && $_POST['userid'] !== "" ? $_POST['userid'] : '';
        $req['password'] = isset($_POST['password']) && $_POST['password'] !== "" ? $_POST['password'] : '';
        $result = $this->model->logout($req);

        echo json_encode($result );
    }

}

?>
