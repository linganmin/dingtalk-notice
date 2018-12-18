<?php

namespace Lingan\DingtalkNotice\Messages;

class Message
{
    public $message = [];
    public $at = [];
    public $is_at_all = false;
    public $at_mobiles = [];
    public function setAt()
    {
        $this->at = [
            'at' => [
                'atMobiles' => $this->at_mobiles,
                'isAtAll'   => $this->is_at_all,
            ],
        ];
    }
    /**
     * 合并要发送的数据数组
     * @return array
     */
    public function getSendData(): array
    {
        $this->setAt();
        return $this->message + $this->at ?? [];
    }
}