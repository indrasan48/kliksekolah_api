<?php

class index extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
		print_r( $_POST );
		echo $_POST['method'];
        //$this->view->render('index/index');
    }

}

?>
