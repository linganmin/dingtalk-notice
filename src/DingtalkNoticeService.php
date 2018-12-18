<?php

namespace Lingan\DingtalkNotice;


use Lingan\DingtalkNotice\Messages\TextMessage;

class DingtalkNoticeService
{

    protected $config;
    protected $robotUrl;
    protected $robot;
    protected $access_token;
    protected $messageInstance = null;

    /**
     * DingtalkNoticeService constructor.
     * @param array $config
     * @param string $robot
     */
    public function __construct(array $config, string $robot)
    {
        $this->config = $config;
        $this->robot = $robot;

        $this->setAccessToken();
        $this->setRobotUrl();
    }


    /**
     * 设置推送地址
     */
    protected function setRobotUrl()
    {
        // 判断有没有设置token
        if (!$this->access_token) {
            $this->access_token = $this->config['access_token']['default'];
        }
        $this->robotUrl = $this->config['robot_base_url'] . '?access_token=' . $this->access_token;
    }

    /**
     * 读取钉钉机器人的access_token，默认使用default里面的值
     */
    protected function setAccessToken()
    {
        if ($this->access_token != 'default') {
            $this->access_token = $this->config['access_token']['others'][$this->robot] ?? '';
        } else {
            $this->access_token = $this->config['access_token']['default'];
        }
    }

    /**
     * 设置@的用户的手机号
     * @param array $mobiles
     * @return $this
     */
    public function setAtMobiles(array $mobiles)
    {
        if ($this->messageInstance) {
            $this->messageInstance->at_mobiles = $mobiles;
        }
        return $this;
    }


    /**
     * 设置at all
     * @return $this
     */
    public function setAtAll()
    {
        if ($this->messageInstance) {
            $this->messageInstance->is_at_all = true;
        }
        return $this;
    }

    /**
     * 发送
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send()
    {
        if (!$this->messageInstance) {
            throw new \Exception('发送失败，失败原因：没有设置有效的消息类型和内容');
        }
        $res = HttpService::getInstance()->httpPost($this->robotUrl, $this->messageInstance->getSendData(), 'json');

        if ($res['errcode'] != 0) {
            throw new \Exception('发送失败，失败原因：' . $res['errmsg']);
        }
    }

    /**
     * 发送纯文本
     * @param string $text
     * @return $this
     */
    public function setTextMessage(string $text)
    {
        $this->messageInstance = new TextMessage($text);

        return $this;
    }
}