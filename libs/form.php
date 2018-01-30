<?php

class form extends validation {

    private $_currentItem = null;
    private $_postData = array();
    private $_validation = array();
    private $_error = array();

    function __construct() {}

    /**
     * 
     * @param String $fieldName Attribute name from form
     * @return Mixed Value from post name
     */
    function _valuepost($fieldName) {
        $valuepost = isset($_POST[$fieldName]) ? $_POST[$fieldName] : '';
        if (isset($valuepost)) {
            $this->_postData[$fieldName] = $valuepost;
            $this->_currentItem = $fieldName;
        }
        return $valuepost;
    }
    /**
     * 
     * @param type $fieldName get 1 field name
     * @return mixed array ex $form->_get() and string ex. $form->_get('name')
     */
    function _get($fieldName = false) {
        if ($fieldName) {
            if (isset($this->_postData[$fieldName])) {
                return $this->_postData[$fieldName];
            }
            return false;
        } else {
            return $this->_postData;
        }
    }

    function _submit() {
        if (empty($this->_error)) {
            return true;
        } else {
            throw new Exception(json_encode($this->_error));
        }
    }
    
    function _return_validation($error)
    {
        if ($error) {
            $this->_error[$this->_currentItem] = $error;
        }
        
    }
    
/*======================================================================================================*/
    
    /**
     * no validation
     * @param type $fieldName set name array from posting data
     * @return $this
     */
    function _novalidation($fieldName) {
        if (isset($_POST[$fieldName])) {
            $this->_postData[$fieldName] = $_POST[$fieldName];
            $this->_currentItem = $fieldName;
        }
        return $this;
    }
    
    /**
     * 
     * @param String $fieldName value input
     * @param int $minlength minimum chars value input
     * @param int $maxlength maximum chars value
     */
    function _number($fieldName, $minlength = null, $maxlength = null) {
        $error = $this->_length($this->_valuepost($fieldName), $minlength, $maxlength);
        $this->_return_validation($error);
        return $this;
    }
    
    function _text($fieldName, $minlength = null, $maxlength = null) {
        $error = $this->_length($this->_valuepost($fieldName), $minlength, $maxlength);
        $this->_return_validation($error);
        return $this;
    }
    
    

}
