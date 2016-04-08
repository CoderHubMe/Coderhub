<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('menu_is_active')) {
    function menu_is_active($item = "", $theme = array()) {
        if(is_string($item) && is_array($theme)) {
            if(isset($theme['menu']) && is_string($theme['menu']) && $theme['menu'] == $item) { 
                return true;
            } else {
                return false;
            }
        }
    }
}