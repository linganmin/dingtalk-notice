<?php

namespace Lingan\DingtalkNotice;

class DingtalkNotice
{

    private static $instance = null;

    private $config;

    /**
     * DingtalkNotice constructor.
     * @param $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }


    private function useRobot($robot = 'default')
    {
        self::$instance = new DingtalkNoticeService($this->config, $robot);
        return $this;
    }

    public static function getInstance()
    {
        return self::$instance;
    }

}