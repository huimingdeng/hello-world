<?php

// 调用函数
function M($tb_name = ''){
    return new Db($tb_name);
}

// DB类
class Db {
    static private $_connect = null; // 数据库连接实例，这边用的是 PDO
    private $_tbName = '';

    // 设置表名
    public function __construct($tb_name = ''){
        $this->_tbName = $tb_name;
    }

    // 执行sql语句
    public function query($sql = ''){
        return self::$_connect->query($sql);
    }

    // 获取所有记录
    public function getAll($sql = ''){
        $query = $this->query($sql);
        $data  = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    // 获取字段结构
    public function getConstructure(){
        // 获取表结构
        $sql  = 'describe ' . $this->tbName;
        $data = $this->getAll($sql);
        $constructure = array();

        foreach ($data as $v)
        {
            $constructure[$v['Field']] = $this->getType($v['Type']);
        }

        return $constructure;
    }

    // 获取具体数据类型
    public function getType($type = ''){
        if (preg_match("/tinyint/" , $type) === 1) {
            return 'tinyint';
        }

        if (preg_match("/int/" , $type) === 1) {
            return 'int';
        }

        if (preg_match("/char/" , $type) === 1) {
            return 'char';
        }

        if (preg_match("/varchar/" , $type) === 1) {
            return 'varchar';
        }

        if (preg_match("/text/" , $type) === 1) {
            return 'text';
        }
        // 数据库类型不止以上这些，其他的请自行补充
        ...
    }

    // 格式化值：也就是自动决定是否给值加 引号
    public function format($key = '' , $val = ''){
        $c = $this->getConstructure();

        // 等等之类，其他的请自行补充
        $add_quote_type_range = array('char' , 'varchar' , 'text');

        foreach ($c as $k => $v)
        {
            if ($k === $key) {
                foreach ($add_quote_type_range as $v1)
                {
                    if ($key === $v1){
                        return "'" . $val . "'";
                    }
                }

                return $val;
            }
        }

        return false;
    }

    // 保存数据
    public function save(array $data = array()){
        // 数据库所有字段名称
        $fields = array_keys($data);

        foreach ($data as $k => $v)
        {
            $data[$k] = $this->format($k , $v);
        }

        $vals = array_values($data);

        $sql = 'insert into ' . $this->tbName . '(' . $fields . ') values (' . join(' , ' , $vals) . ')';

        $this->query($sql);
    }
}