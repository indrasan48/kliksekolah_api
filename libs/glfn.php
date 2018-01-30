<?php

class glfn {

    public static function _pre($pre) {
        echo '<pre>';
        print_r($pre);
        echo '</pre>';
    }

    public static function _redirect($url = null) {
        header('location:' . URL . $url);
        exit();
    }

    public static function _curl_api($link = null, $post) {

        header('X-Requested-With: XMLHttpRequest');
        $url = str_replace(' ', '%20', $link);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Requested-With: XMLHttpRequest'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        $return = json_decode($response, TRUE);
        if (curl_error($ch)) {
            $return = array();
            $return['id'] = $_POST['id'];
            $return['status'] = 0;
            $return['messages'] = curl_error($ch);
        } else {

        }
        curl_close($ch);
    }

    public static function _check_array($array, $key) {
        return isset($array[$key]) ? $array[$key] : 0;
    }

    public static function _xml_http_request($url = '') {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || ($_SERVER['HTTP_X_REQUESTED_WITH']) != 'XMLHttpRequest') {
            $return = array();
            $return['id'] = $_POST['id'];
            $return['status'] = 0;
            $return['messages'] = 'Http Access Forbiden';
            $return['data'] = array();
            echo json_encode($return);
            exit();
        }
    }


}
