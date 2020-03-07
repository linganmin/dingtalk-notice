<?php

if (!function_exists('dingNotice')) {
    function dingNotice($robot = '')
    {
        if ($robot) {
            return app('dingtalk-notice')->useRobot($robot)->getInstance();
        }
        return app('dingtalk-notice')->useRobot()->getInstance();
    }
}


if (!function_exists('ding_notice')) {
    function ding_notice($robot = '')
    {
        if ($robot) {
            return app('dingtalk-notice')->useRobot($robot)->getInstance();
        }
        return app('dingtalk-notice')->useRobot()->getInstance();
    }
}