<?php

namespace Lingan\DingtalkNotice;


use GuzzleHttp\Client;

class HttpService
{
    private static $instance = null;

    private $client;
    private $config = [];


    /**
     * HttpService constructor.
     * @param Client $client
     */
    private function __construct(Client $client)
    {
        $this->client = $client;
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /**
     * @return HttpService|null
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self(new Client());
        }
        return self::$instance;
    }


    /**
     * 请求
     * @param $request_type
     * @param $url
     * @param $data
     * @param string $application_type
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function httpGuzzle(string $request_type, string $url, array $data, string $application_type = 'form_params')
    {
        $request_type = strtoupper($request_type);
        $temp_config = [];
        switch ($request_type) {
            case 'GET':
                $temp_config['query'] = $data;
                break;
            case 'POST':
                switch ($application_type) {
                    case 'json':
                        $temp_config['json'] = $data;
                        break;
                    default:
                        $temp_config['form_params'] = $data;
                        break;
                }
                break;
            default:
                break;
        }
        $config = array_merge($this->config, $temp_config);

        try {
            $response = $this->client->request($request_type, $url, $config);
            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            } else {
                return [];
            }
        } catch (\Exception $exception) {

            $msg = 'post请求失败: ' . $exception->getMessage();
//            dd($msg);
//            ding_notice()->setTextMessage($msg)->setAtMobiles(['18862612650'])->send();
//            \Log::info($msg);
            return [];
        }
    }


    /**
     * Get请求
     * @param $url
     * @param array $data
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpGet(string $url, array $data = [])
    {

        return $this->httpGuzzle('get', $url, $data);

    }


    /**
     * Post请求
     * @param $url
     * @param array $data
     * @param string $application_type
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpPost(string $url, array $data = [], string $application_type = 'form_data')
    {
        return $this->httpGuzzle('post', $url, $data, $application_type);
    }
}