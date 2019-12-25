# PHP函数-日常使用集锦

该文档为日常开发中遇到的PHP内置函数，记录其用法示例。(此文档没有进行划分，可能时间函数没有放在一起，今后可能会进行一定的整理。)

## String 字符串函数

### <i style="color:red;">`strcmp(string1,string2)`</i> 函数

比较两个字符串,区分大小写。

| 参数      | 描述                                                                             |
| ------- | ------------------------------------------------------------------------------ |
| string1 | 必需。规定要比较的第一个字符串。                                                               |
| string2 | 必需。规定要比较的第二个字符串。                                                               |
| 返回值     | 0 - 如果两个字符串相等<br/>< 0 - 如果 string1 小于 string2 <br/>> 0 - 如果 string1 大于 string2 |
| PHP 版本  | 4+                                                                             |

```php
<?php 
    echo strcmp("Hello","Hello"); // return 0
    echo "\n";
    echo strcmp("Hello","hELLo"); // return -1
    echo "\n";
    echo strcmp("Hello","HEllo"); // return 1
疑问解答：
    1.如何比较 string1 和 string2 大小计算的呢？
     例如：上面返回 -1 的例子：
     ord('H') 的ASCII码为：72; 
     ord('h') 的ASCII码为：104，
     则字符串第一个字母比较大小，string1[0] < string2[0] return -1
```

### <i style="color:red;">`strcasecmp(string1,string2)`</i> 函数

比较两个字符串，不区分大小写。

| 参数      | 描述                                                                           |
| ------- | ---------------------------------------------------------------------------- |
| sting1  | 必需。规定要比较的第一个字符串。                                                             |
| string2 | 必需。规定要比较的第二个字符串。                                                             |
| 返回值     | 0 - 如果两个字符串相等 <br/><0 - 如果 string1 小于 string2<br/>>0 - 如果 string1 大于 string2 |
| PHP版本   | 4+                                                                           |

### 面向对象链式操作

`__call` 和 `call_user_func` 等函数实现。 参考[PHP 三种方式实现链式操作](https://blog.csdn.net/cain_123456/article/details/54632574 "PHP 三种方式实现链式操作")、[PHP对象链式操作实现原理分析](https://www.jb51.net/article/94282.htm "PHP对象链式操作实现原理分析") 和 [如何在PHP中实现链式方法调用](https://blog.51cto.com/momodev/843999 "如何在PHP中实现链式方法调用")

## 其它函数

#### mail 函数

```php
bool mail( string $to , string $subject , string $message [, string `$additional_headers` [, string `$additional_parameters` ]] )
```

中文乱码问题，在`additional_headers`中添加 `"Content-type: text/plain; charset=utf-8\r\n";` eg.

```php
$subject = stripslashes($the_post['Title']); 
$headers　= "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/plain; charset=utf-8\r\n"; 
$headers .= "Content-Transfer-Encoding: 8bit\r\n"; 
$message = stripslashes(strip_tags($the_post['Content'])); 
mail($to, $subject, $message, $headers); 
```

### URL 函数

#### [http_build_query](https://www.php.net/manual/zh/function.http-build-query)函数

```php
 http_build_query( mixed $query_data [, string $numeric_prefix [, string $arg_separator [, int $enc_type = PHP_QUERY_RFC1738 ]]] ) : string
```

生成 URL-encode 之后的请求字符串。

| 参数               | 描述                                                                                                                         |
| ---------------- | -------------------------------------------------------------------------------------------------------------------------- |
| `query_data`     | 必需。可以是数组或包含属性的对象.<br/>一个 `query_data` 数组可以是简单的一维结构，也可以是由数组组成的数组（其依次可以包含其它数组）<br/>如果 `query_data` 是一个对象，只有 public 的属性会加入结果。 |
| `numeric_prefix` | 可选。如果在基础数组中使用了数字下标同时给出了该参数，此参数值将会作为基础数组中的数字下标元素的前缀。<br/>这是为了让 PHP 或其它 CGI 程序在稍后对数据进行解码时获取合法的变量名。                           |
| `arg_separator`  | 可选。除非指定并使用了这个参数，否则会用 arg_separator.output 来分隔参数。since `5.1.2`                                                              |
| `enc_type`       | 可选。默认使用 `PHP_QUERY_RFC1738`.  since `5.4.0`                                                                                |
| 返回值              | 返回一个 URL 编码后的字符串                                                                                                           |

```php
$post_data = array(        
    'secret' => 'your_website_key',        
    'response' => date("Y-m-d H:i:s", time())
);

$postdata = http_build_query($post_data);
-------------------------------------------------------------------
eg. return string 'secret=6Le0ucgUAAAAAGmfMlKy5dO-ScdXhuQ1j96u3NJM&response=2019-12-25+02%3A41%3A09'
```

### 其它扩展之 Stream 函数

#### [stream_context_create](https://www.php.net/manual/zh/function.stream-context-create) 函数

```php
 stream_context_create([ array $options [, array $params ]] ) : resource
```

创建并返回一个资源流上下文，该资源流中包含了 `options` 中提前设定的所有参数的值。

| 参数      | 描述                                                      |
| ------- | ------------------------------------------------------- |
| options | 必须是一个二维关联数组，格式如下：`$arr['wrapper']['option'] = $value` 。 |
| params  | 必须是 `$arr['parameter'] = $value` 格式的关联数组。 since `5.3.0` |
| 返回值     | 上下文资源流，类型为 resource                                     |

### 文件系统函数

#### [file_get_contents](https://www.php.net/manual/zh/function.file-get-contents) 函数

```php
file_get_contents( string $filename [, bool $use_include_path = false [, resource $context [, int $offset = -1 [, int $maxlen ]]]] ) : string
```

将整个文件读入一个字符串

| 参数                 | 描述                                                                                                                                                                                                                                                         |
| ------------------ | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `filename`         | 要读取的文件的名称                                                                                                                                                                                                                                                  |
| `use_include_path` | `Note: As of PHP 5 the FILE_USE_INCLUDE_PATH can be used to trigger include path search.`                                                                                                                                                                  |
| `context`          | A valid context resource created with [**`stream_context_create()`**](#stream_context_create). 如果你不需要自定义 **`context`**，可以用 NULL 来忽略                                                                                                                        |
| `offset`           | The offset where the reading starts on the original stream.<br/>Seeking (offset) is not supported with remote files. Attempting to seek on non-local files may work with small offsets, but this is unpredictable because it works on the buffered stream. |
| `maxlen`           | Maximum length of data read. The default is to read until end of file is reached. Note that this parameter is applied to the stream processed by the filters.                                                                                              |
| 返回值                | The function returns the read data 或者在失败时返回 FALSE.                                                                                                                                                                                                         |

For example:

```php
$url = 'https://www.google.com/recaptcha/api/siteverify';
$post_data = [
    'secret' => 'your_website_key',
    'response' => 'your_reCaptcha_response_token'
];
$postdata = http_build_query($post_data);
$options = [
    'http' => [
        'method' => 'POST',
        'header' => 'Content-type:application/x-www-form-urlencoded',
        'content' => $postdata,
        'timeout' => 30 // unit second
    ]
];
$context = stream_context_crreate($options);
$result = file_get_contents($url, false, $context);
return $result;
```


