<?php

if (!function_exists('dingNotice')) {
    function dingNotice($robot = '')
    {
        if ($robot) {
            return app('ding-notice')->useRobot($robot)->getInstance();
        }
        return app('ding-notice')->useRobot()->getInstance();
    }
}