<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Input extends CI_Input {

    function _sanitize_globals() {

        // Avoid error come from cookie __utmt_~1, it set by Google Analatics
        foreach($_COOKIE as $key => $val) {
            if (strpos($key, '~') !== false) {
                unset($_COOKIE[$key]);
            }
        }

        parent::_sanitize_globals();
    }
}