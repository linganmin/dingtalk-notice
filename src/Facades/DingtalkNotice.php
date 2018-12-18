<?php

namespace Lingan\DingtalkNotice\Facades;


use Illuminate\Support\Facades\Facade;

class DingtalkNotice extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "dingtalk-notice";
    }
}