<h1 align="center"> dingtalk-notice </h1>

<p align="center"> .</p>


## Installing

```bash
composer require lingan/dingtalk-notice -vvv
```

## Usage
### 在Laravel中使用
#### 发布配置文件
```shell
php artisan vendor:publish
```
配置为文件
```php
return [
    'robot_base_url' => env('DING_ROBOT_URL', 'https://oapi.dingtalk.com/robot/send'),
    'timeout'        => 2.0,
    'access_token'   => [
        'default' => env('DING_TOKEN', '你的钉钉群组机器人token'),// 默认
        'others'  => [ // 扩展更多token,预留
            'xxx' => env('XXX_TOKEN', '你的钉钉群组机器人token'),
        ],
    ],
];
```

#### 使用辅助函数发送
```bash
dingNotice()
->setTextMessage('这里是报错信息')
->setAtMobiles(['188xxxxxxxx'])
->send();
```
#### 使用Facade发送
```bash
\Lingan\DingtalkNotice\Facades\DingtalkNotice::getFacadeRoot()
->useRobot()
->getInstance()
->setTextMessage('这里是报错信息')
->setAtMobiles(['188xxxxxxxx'])
->send();
```
#### 使用服务容器发送
```bash
app('dingtalk-notice')
->useRobot()
->getInstance()
->setTextMessage('这里是报错信息')
->setAtMobiles(['188xxxxxxxx'])
->send();
```

### 在非Laravel项目中使用
```bash

require_once './vendor/autoload.php';

// 配置文件
$config = [
    'robot_base_url' => 'https://oapi.dingtalk.com/robot/send',
    'timeout' => 2.0,
    'access_token' => [
        'default' => env('DING_TOKEN', '你的钉钉群组机器人token'),// 默认
    ],
];
// 实例化
$dingtalk = new \Lingan\DingtalkNotice\DingtalkNotice($config);

// 发送
$dingtalk->useRobot()
->getInstance()
->setTextMessage('这里是报错信息')
->setAtMobiles(['188xxxxxxxx'])
->send();

```

## TODO

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/linganmin/dingtalk-notice/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/linganmin/dingtalk-notice/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT