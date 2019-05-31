<?php 

/**
 * 简单的PHP区块链
 * @author huimingdeng <1458575181@qq.com>
 */
namespace common\library\block;
/**
 * 区块结构
 * @package common\library\block
 */
class block {
    private $index;
    private $timestamp;
    private $data;
    private $previous_hash;
    private $random_str;
    /**
     * hash 值存取
     * @var string
     */
    private $hash;

    public function __construct($index, $timestamp, $data, $random_str, $previous_hash)
    {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previous_hash = $previous_hash;
        $this->random_str = $random_str;
        $this->hash = $this->hash_block();
    }

    public function __get($name){
        return $this->$name;
    }

    private function hash_block(){
        $str = $this->index . $this->timestamp . $this->data . $this->random_str . $this->previous_hash;
        return hash("sha256", $str);
    }
}
