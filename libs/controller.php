<?php

class controller{

    
    function __construct() {
        $this->view = new view();
    }

    /**
     * 
     * @param String $name file from folder model
     */
    public function _load_model($name) {

        $path = MODELS . $name . '_model.php';

        if (file_exists($path)) {
            require MODELS . $name . '_model.php';

            $modelName = $name . '_model';
            $this->model = new $modelName();
        }
    }

}
