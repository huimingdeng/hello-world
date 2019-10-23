# 六星-Part-Four

第4部分，逻辑题等。

### 2019-10-22

一群猴子排成一圈，按1，2，…，n依次编号。然后从第1只开始数，数到第m只，把它踢出圈，从它后面再开始数， 再数到第m只，在把它踢出去…，如此不停的进行下去， 直到最后只剩下一只猴子为止，那只猴子就叫做大王。要求编程模拟此过程，输入m、n， 输出最后那个大王的编号。请问这题阐述的是什么问题？
答：约瑟夫环问题
编程过程如下：

```php
/**
 * 获取大王
 * @param  int $n 
 * @param  int $m 
 * @return int  
 */
function get_king_mokey($n, $m){
    $arr = range(1, $n);

    $i = 0;

    while (count($arr) > 1) {
        $i++;
        $survice = array_shift($arr);

        if ($i % $m != 0) {
            array_push($arr, $survice);
        }
    }
    return $arr[0];
}
```

### 2019-10-23


