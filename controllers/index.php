<?php

class index extends controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
<<<<<<< HEAD
		print_r( $_POST );
		echo $_POST['method'];
        //$this->view->render('index/index');
=======
    	$this->view->render('index/index');
>>>>>>> cfc5e06873e82c001b6df1fb716099cac43f4d8d
    }

}

?>
