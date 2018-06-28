<?php

if ( ! function_exists('isElementActive')) {
    /**
     * @param $var
     * @param $value
     * @return string
     */
    function isElementActive($var, $value)
    {
        ( $var == $value ) ? $ret = 'active' : $ret = '';

        return $ret;
    }
}

if ( ! function_exists('isTabActive')) {
    /**
     * @param      $tab
     * @param null $default
     * @return string
     */
    function isTabActive($tab, $default = null)
    {
        if ( ! Session::has('tab') && $default == true) {
            return 'active';
        }

        if (Session::has('tab') == $tab) {
            return 'active';
        }
    }
}

if ( ! function_exists('getActiveTab')) {
    /**
     * @param      $tab
     * @param null $default
     * @return string
     */
    function getActiveTab($tab, $default = null)
    {
        if (Request::old('ruleset') == $tab || Session::get('ruleset') == $tab) {
            return 'active';
        }

        if ( ! Session::has('ruleset') && ! Request::old('ruleset')) {
            if ($tab == $default) {
                return 'active';
            }
        }
    }
}

if ( ! function_exists('isActiveTab')) {
    /**
     * Determines if a tab is active
     * @param $param
     * @param $tab
     * @return string
     */
    function isActiveTab($param, $tab)
    {
        if ($param == $tab) {
            return 'active';
        }
    }
}
