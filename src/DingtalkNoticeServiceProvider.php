<?php
/**
 * Created by PhpStorm.
 * User: lingan
 * Date: 2018/12/18
 * Time: 下午4:28
 */

namespace Lingan\DingtalkNotice;


use Illuminate\Support\ServiceProvider;

class DingtalkNoticeServiceProvider extends ServiceProvider
{
    /**
     * 按需加载
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/dingtalk.php' => config_path('dingtalk.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('dingtalk-notice', function ($app) {
            return new DingtalkNotice($app['config']['dingtalk']);
        });
    }

    public function provides()
    {
        return ['dingtalk-notice'];
    }

}