<?php

class view {

    function __construct() {
        
    }

    /**
     *
     * @param String $name File from folder Views
     * @param String $noInclude load folder without header and footer
     */
    public function render($name, $noInclude = false) {
        if ($noInclude == true) {
            require VIEWS . $name . '.php';
        } else {
            require VIEWS . 'header.php';
            require VIEWS . $name . '.php';
            require VIEWS . 'footer.php';
        }
    }

}
