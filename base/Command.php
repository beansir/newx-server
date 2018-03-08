<?php
/**
 * @author bean
 * @version 2.0
 */
namespace newx\server\base;

use newx\console\base\Console;
use newx\helpers\ArrayHelper;
use newx\helpers\StringHelper;

class Command extends Console
{
    /**
     * 异步通信服务
     */
    public function run()
    {
        try {
            // 获取服务
            if (!$this->option) {
                throw new \Exception('server not exists');
            }

            // 服务配置
            $config = ArrayHelper::value($this->config, ['app', $this->option]);
            if (!$config) {
                throw new \Exception("server config error: {$this->option} not exists");
            }

            // 服务类
            $server = '\\service\\' . StringHelper::lower2upper($this->option, '-');

            /**
             * 启动服务
             * @var SwooleInterface $app
             */
            $app = new $server($config);
            $app->start();
        } catch (\Exception $e) {
            exit("{$e->getMessage()} in {$e->getFile()} : {$e->getLine()}\n");
        }
    }
}