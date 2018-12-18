<?php

namespace Lingan\DingtalkNotice\Messages;

class TextMessage extends Message
{
    public $content;

    public function __construct(string $content = "")
    {
        $this->content = $content;
        $this->setMessage();
    }

    public function setMessage()
    {
        $this->message = [
            'msgtype' => 'text',
            'text'    => [
                'content' => $this->content,
            ],
        ];
    }
}