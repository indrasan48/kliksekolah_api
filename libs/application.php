<?php

class application {

    private $_url = null;
    private $_controller = null;

    function __construct() {
        //header("Content-Type: application/json");
        $this->_url();
        $this->_load_default_controller();
        $this->_load_exist_controller();
        $this->_call_method_controler();
        
    }

    function _url() {
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
        if (substr($url, -1) == "/") {
            $url = rtrim($url, '/');
            header('location:' . URL . $url);
        }
        $url = isset($url) ? $url : null;
        $this->_url = explode('/', $url);
    }

    function _load_default_controller() {
        if (empty($this->_url[0])) {
            require 'controllers/index.php';
            $this->_controller = new index();
            $this->_controller->index();
            exit();
        }
    }
    function _load_default_controller22() {
        if ($this->_url[0]) {
            require 'controllers/index.php';
            $this->_controller = new index();
            $this->_controller->index();
            exit();
        }
    }
    
    

    function _load_exist_controller() {
        $file = CONTROLLERS . $this->_url[0] . '.php';
        if (file_exists($file)) {
            require $file;
            $this->_controller = new $this->_url[0];
            $this->_controller->_load_model($this->_url[0]);
        } else {
            $this->_error();
        }
    }

    function _call_method_controler() {

        $length = count($this->_url);

        if ($length > 1) {
            if (!method_exists($this->_controller, $this->_url[1])) {
                $this->_error();
            }
        }

        switch ($length) {
            case 5:
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;
            case 4:
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                break;
            case 3:
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;
            case 2:
                $this->_controller->{$this->_url[1]}();
                break;
            default :
                $this->_controller->index();
                break;
        }
    }

    private function _error() {
        require CONTROLLERS . 'error.php';
        $this->_controller = new error_link();
        $this->_controller->index();
        exit();
    }

}
