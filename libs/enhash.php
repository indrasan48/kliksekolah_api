<?php

class enhash {

    /**
     * 
     * @param Hash $algo function encrypt from PHP (sha128, sha256, md5, dsb)
     * @param String $data data
     * @param String $key key same like salt
     * @return encrypted data
     */
    public static function _hash_login_user22($algo, $data, $key) {
        $context = hash_init($algo, HASH_HMAC, $key);
        hash_update($context, $data);
        return hash_final($context);
    }
    
    public static function _hash_signin($algo, $data, $key) {
        $context = hash_init($algo, HASH_HMAC, $key);
        hash_update($context, $data);
        return hash_final($context);
    }
    
 
    public static function _hash_csrf($algo, $data, $key) {
        $context = $data.$key;
        return hash('sha512', $context);
    }

}
