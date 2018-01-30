<?php

class error_link extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->view->render('error/index',true);
    }

}

?>
