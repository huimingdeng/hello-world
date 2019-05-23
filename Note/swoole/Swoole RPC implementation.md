# Swoole RPC 实现

参考转载：[https://segmentfault.com/a/1190000019240602](https://segmentfault.com/a/1190000019240602 "swoole RPC 实现")

## 客户端代码：

### HTTP请求

```
<?php
$demo = [
 'type' => 'SW',
 'token' => 'Bb1R3YLipbkTp5p0',
 'param' => [
 'class' => 'Order',
 'method' => 'get_list',
 'param' => [
 'uid' => 1,
 'type' => 2,
 ],
 ],
];

$ch = curl_init();
$options = [
 CURLOPT_URL => 'http://192.168.1.4:9509/',
 CURLOPT_POST => 1,
 CURLOPT_POSTFIELDS => json_encode($demo),
];
curl_setopt_array($ch, $options);
curl_exec($ch);
curl_close($ch);
```

### TCP请求

```
//代码片段
$demo = [
    'type'  => 'SW',
    'token' => 'Bb1R3YLipbkTp5p0',
    'param' => [
        'class'  => 'Order',
        'method' => 'get_list',
        'param' => [
            'uid'  => 1,
            'type' => 2,
        ],
    ],
];
$this->client->send(json_encode($demo));
```

#### 请求方式

- SW 单个请求，等待结果
  
  发出请求后，分配给 Task ，并等待 Task 执行完成后，再返回。

- SN 单个请求，不等待结果
  
  发出请求后，分配给 Task 之后，就直接返回。

#### 发送数据

```
$demo = [
    'type'  => 'SW',
    'token' => 'Bb1R3YLipbkTp5p0',
    'param' => [
        'class'  => 'Order',
        'method' => 'get_list',
        'param' => [
            'uid'  => 1,
            'type' => 2,
        ],
    ],
];
```

- type 同步/异步设置
- token 可进行权限验证
- class 请求的类名
- method 请求的方法名
- uid 参数一
- type 参数二

#### 返回数据

![5ce65554b984959476](https://i.loli.net/2019/05/23/5ce65554b984959476.png "数据类型")

- request_method 请求方式
- request_time 请求开始时间
- response_time 请求结束时间
- code 标识
- msg 标识值
- data 约定数据
- query 请求参数

### 代码

#### OnRequest.php

```
<?php

if (!defined('SERVER_PATH')) exit("No Access");

class OnRequest
{
    private static $query;
    private static $code;
    private static $msg;
    private static $data;

    public static function run($serv, $request, $response)
    {
        try {
            $data = decrypt($request->rawContent());
            self::$query   = $data;
            if (empty($data)) {
                self::$code = '-1';
                self::$msg  = '非法请求';
                self::end($request, $response);
            }

            //TODO 验证Token

            switch ($data['type']) {
                case 'SW': //单个请求,等待结果
                    $task = [
                        'request' => $data,
                        'server'  => 'http'
                    ];
                    $rs = $serv->task(json_encode($task), -1, function ($serv, $task_id, $rs_data) use ($request, $response) {
                        self::$code = '1';
                        self::$msg  = '成功';
                        self::$data = $rs_data['response'];
                        self::end($request, $response);
                    });
                    if ($rs === false) {
                        self::$code = '-1';
                        self::$msg  = '失败';
                        self::end($request, $response);
                    }
                    break;

                case 'SN': //单个请求,不等待结果
                    $task = [
                        'request' => $data,
                        'server'  => 'http'
                    ];
                    $rs = $serv->task(json_encode($task));
                    if ($rs === false) {
                        self::$code = '-1';
                        self::$msg  = '失败';
                    } else {
                        self::$code = '1';
                        self::$msg  = '成功';
                    }
                    self::end($request, $response);
                    break;
                default:
                    self::$code = '-1';
                    self::$msg  = '非法请求';
                    self::end($request, $response);
            }
        } catch(Exception $e) {
        }
    }

    private static function end($request = null, $response = null)
    {
        $rs['request_method'] = $request->server['request_method'];
        $rs['request_time']   = $request->server['request_time'];
        $rs['response_time']  = time();
        $rs['code']           = self::$code;
        $rs['msg']            = self::$msg;
        $rs['data']           = self::$data;
        $rs['query']          = self::$query;
        $response->end(json_encode($rs));
        self::$data = [];
        return;
    }
}
```

#### OnReceive.php

```
<?php

if (!defined('SERVER_PATH')) exit("No Access");

class OnReceive
{
    private static $request_time;
    private static $query;
    private static $code;
    private static $msg;
    private static $data;

    public static function run($serv, $fd, $reactor_id, $data)
    {
        try {
            self::$request_time = time();
            $data = decrypt($data);
            self::$query = $data;

            //TODO 验证Token

            
            switch ($data['type']) {
                case 'SW': //单个请求,等待结果
                    $task = [
                        'fd'           => $fd,
                        'request'      => $data,
                        'server'       => 'tcp',
                        'request_time' => self::$request_time,
                    ];
                    $rs = $serv->task(json_encode($task));
                    if ($rs === false) {
                        self::$code = '-1';
                        self::$msg  = '失败';
                        self::handlerTask($serv, $fd);
                    }
                    break;

                case 'SN': //单个请求,不等待结果
                    $task = [
                        'fd'           => $fd,
                        'request'      => $data,
                        'server'       => 'tcp',
                        'request_time' => self::$request_time,
                    ];
                    $rs = $serv->task(json_encode($task));
                    if ($rs === false) {
                        self::$code = '-1';
                        self::$msg  = '失败';
                    } else {
                        self::$code = '1';
                        self::$msg  = '成功';
                    }
                    self::handlerTask($serv, $fd);
                    break;
                default:
                    self::$code = '-1';
                    self::$msg  = '非法请求';
                    self::handlerTask($serv, $fd);
            }
        } catch(Exception $e) {
        }
    }

    private static function handlerTask($serv, $fd)
    {
        $rs['request_method'] = 'TCP';
        $rs['request_time']   = self::$request_time;
        $rs['response_time']  = time();
        $rs['code']           = self::$code;
        $rs['msg']            = self::$msg;
        $rs['data']           = self::$data;
        $rs['query']          = self::$query;
        $serv->send($fd, json_encode($rs));
    }
}
```


