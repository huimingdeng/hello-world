<?php
/**
 * Class Split
 * 类Python字符分割，未完成
 * @author huimingdeng <1458575181@qq.com>
 * @version 1.0
 */
class Split
{
    /**
     * Split 实例
     * @var null
     */
    private static $_instance = null;
    /**
     * 字符串
     * @var string
     */
    private $string;
    /**
     * 字符串长度
     * @var int|Integer
     */
    private $strlen;
    private $letter; //字母
    private $type; //类型默认为 'list'
    private $list = []; //列表

    public function __construct($string, $type = 'list')
    {
        $this->string = $string;
        $this->splitStr2list();
    }
    /**
     * 分割字符串每一个字符
     * @param string $character 字符编码
     * @return [type] [description]
     */
    private function splitStr2list($character = 'utf8')
    {
        $this->strlen = mb_strlen($this->string);
        if ($this->strlen > 0) {
            for ($i = 0; $i < $this->strlen; $i++) {
                $letter = mb_substr($this->string, $i, 1, $character);
                array_push($this->list, $letter);
            }
        }
    }
    /**
     * 分割字符串成字母
     * @param  int|Integer $start     分割起始位置
     * @param  string $character 编码字符集
     * @return string            返回单个字符(字母)
     */
    private function splitStr2letter($start, $character = 'utf8')
    {

        $letter = mb_substr($this->string, $start, 1, $character);
        return $letter;
    }
    /**
     * 获取字符串单词
     * @param  int|Integer $start 起始位置
     * @return [type]        [description]
     */
    public static function getLetter($start)
    {
        $obj = self::$_instance;
        $end = $obj->strlen;
        if ($start >= $end) {
            echo "Error: Subscript exceeds character length.\n";
            return;
        } elseif ($start < 0) {
            return $obj->splitStr2letter($start);
        } else {
            return $obj->list[$start];
        }
    }
    /**
     * 获取字符长度
     * @return int|Integer 返回字符串的长度
     */
    public function getLen()
    {
        return $this->strlen;
    }
    /**
     * 获取字符串列表
     * @return array 返回一个分割后的数组
     */
    public function getList()
    {
        return $this->list;
    }
    /**
     * 以Python列表形式输出一个字符串
     * @return [type] [description]
     */
    public function dumpList()
    {
        echo '[' . implode(',', $this->list) . ']';
    }

    public static function get_Instance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self('construct中');
        }

        return self::$_instance;
    }
}

$s = Split::get_Instance();
echo $s::getLetter(-1);
$list = $s->getList();
print_r($list);
