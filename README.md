<h2 align="center">NewX Server</h2>

## 安装说明
使用composer一键安装
```
composer require beansir/newx-server
```

## 搭建结构
* service
    * config
        * config.php
        * database.php
    * WebSocket.php
* server // 脚本执行文件

#### 创建脚本执行文件server
```php
#!/usr/bin/env php
<?php
defined('PROJECT_PATH') or define('PROJECT_PATH', __DIR__);
 
require PROJECT_PATH . '/vendor/beansir/newx-server/server';
```

#### 服务配置文件
server/config.php
```php
<?php
return [
    'app' => [
        // 服务器配置
        'tcp' => [
            'host' => '0.0.0.0',
            'port' => 9501
        ],
        'web-socket' => [
            'host' => '0.0.0.0',
            'port' => 9502
        ],
        'http' => [
            'host' => '0.0.0.0',
            'port' => 9503
        ],
    ],
    'database' => [
        // 数据库配置，非必须配置项
        'default' => [
            'host'      => '127.0.0.1',
            'user'      => 'user',
            'password'  => 'password',
            'db'        => 'db',
            'type'      => 'mysqli'
        ],
    ]
];
```

#### WebSocket
```php
<?php
namespace service;
class WebSocket extends \newx\server\base\WebSocket
{
    /**
     * 监听客户端连接
     * @param $server
     * @param $request
     */
    public function open($server, $request)
    {
        var_dump($request);
    }

    /**
     * 监听客户端数据
     * @param $server
     * @param $frame
     */
    public function message($server, $frame)
    {
        var_dump($frame);
    }

    /**
     * 监听客户端关闭连接
     * @param $server
     * @param $fd
     */
    public function close($server, $fd)
    {
        var_dump($fd);
    }
}
```

#### 启动服务
```
server web-socket
```