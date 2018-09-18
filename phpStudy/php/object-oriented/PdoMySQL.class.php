<?php

/**
 * PDO数据库链接操作类
 * 	CONFIG 	数据库配置项
 *  	DB_HOST 	数据库域名
 *   	DB_USER 	数据库连接账号  
 *    	DB_PWD 		数据库连接密码  
 *     	DB_NAME 	数据库名  
 *      DB_PORT 	端口 	3306
 *      DB_TYPE 	数据库类型 mysql
 *      DB_CHARSET 	字符集 eg. utf8/gbk
 */
class PdoMySQL
{
	private static $_instance = null;
	public static $config = array();//设置链接参数
	public static $link = null; // PDO 链接标识符
	public static $pconnect = false; //是否支持长连接
	public static $dbVersion = null; //保存数据库版本
	public static $connected = false; //是否连接成功
	public static $PDOStatement = null; //PDO结果集
	public static $queryStr = null;
	public static $error = null; //错误信息
	public static $lastInsertId = null; //插入的ID
	public static $numRows = 0;//上一步操作受影响条数--插入/更改

	/**
	 * 构造函数，创建 PDO 连接
	 * @param array $dbconfig 数据库连接配置信息
	 */
	public function __construct($dbconfig='')
	{
		// 检查 PDO 是否存在
		if(!class_exists('PDO')){
			self::throw_exception('不支持PDO,请先开启.');
			return ;
		}
		if(!is_array($dbconfig)){//无参数，使用默认的
			$dbconfig = array(
				'hostname' => DB_HOST,
				'username' => DB_USER,
				'password' => DB_PWD,
				'database' => DB_NAME,
				'hostport' => DB_PORT,
				'dbms' => DB_TYPE,
				'dsn' => DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME
				);
		}

		if(empty($dbconfig['hostname'])) throw_exception('没有定义数据库的配置，请先定义...');
		self::$config = $dbconfig;
		// pdo 参数设置
		if(empty(self::$config['params'])) self::$config['params'] = array();
		// 单例模式
		if(!isset(self::$link)){
			$configs = self::$config;
			if(self::$pconnect){
				$configs['params'][constant("PDO::ATTR_PERSISTENT")] = true;
			}
			try{
				self::$link = new PDO($configs['dsn'],$configs['username'],$configs['password'],$configs['params']);
			}catch(PDOException $e){
				self::throw_exception($e->getMessage());
			}
			// 判断是否连接成功
			if(!self::$link){
				self::throw_exception('PDO 连接错误...');
				return false;
			}
			// 成功后，设置字符值
			self::$link -> exec('SET NAMES '.DB_CHARSET);
			// 成功返回数据库版本
			self::$dbVersion = self::$link->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
			self::$connected = true;
			// 配置完成后，释放已经无用的配置
			unset($configs);
		}
		
	}
	/**
	 * 获取所有信息 
	 * @param  string $sql SQL语句
	 * @return 			返回结果
	 */
	public function getAll($sql=null){
		if($sql!=null){
			self::query($sql);
		}
		$result = self::$PDOStatement->fetchAll(constant("PDO::FETCH_ASSOC"));
		return $result;
	}
	/**
	 * 获取结果集中的一条信息
	 * @param  string $sql 执行的 SQL 语句
	 * @return       返回查询结果
	 */
	public function getRow($sql=null){
		if(null != $sql){
			self::query($sql);
		}
		$result = self::$PDOStatement -> fetch(constant("PDO::FETCH_ASSOC"));
		return $result;
	}
	/**
	 * 根据主键获取数据
	 * @param  string $tabName 表名
	 * @param  int  $priId   主键编号
	 * @param  string $fields  获取的字段
	 * @return 返回一条数据结果
	 */
	public function getById($tabName,$priId,$fields="*"){
		$sql = "SELECT %s FROM %s WHERE id=%d";
		return $this->getRow(sprintf($sql,$this->parseFields($fields),$tabName,$priId));
	}
	
	/**
	 * 根据条件(字段)查询数据表
	 * @param  string $tabName 查询表名
	 * @param  string $where   查询条件
	 * @param  string $fields  查询的字段
	 * @param  string $group   分组条件
	 * @param  string $having  二次筛选条件
	 * @param  string $order   排序条件
	 * @param  string $limit   查询限制条件
	 * @return  array 返回查询结果
	 */
	public function getByFields($tabName,$where=null,$fields="*",$group=null,$having=null,$order=null,$limit=null){
		$sql = 'SELECT '.$this->parseFields($fields).' FROM '.$tabName
			.$this->parseWhere($where)
			.$this->parseGroup($group)
			.$this->parseHaving($having)
			.$this->parseOrder($order)
			.$this->parseLimit($limit);
		// return $sql;
		$dataAll = $this->getAll($sql);
		return count($dataAll)==1?$dataAll[0]:$dataAll;
	}
	/**
	 * 添加一条数据
	 * @param string $tabName 添加的表名
	 * @param array $data    添加的数据 fieldName => value,eg. array('username'=>'Tom')
	 * @return 返回搜影响条数
	 */
	public function addOne($tabName,$data){
		$keys = array_keys($data);
		array_walk($keys,array('PdoMySQL','addSpecilChar'));
		$fieldsStr = join(',',$keys);
		$values = "'".join("','",$data)."'";
		$sql = "INSERT INTO {$tabName}({$fieldsStr}) VALUES({$values});";
		return $this->execute($sql);
	}
	/**
	 * 更新数据库表操作
	 * @param  string $tabName 修改的表名
	 * @param  array  $data    修改的数据 fieldName => value,eg. array('username'=>'Tom')
	 * @param  string $where   修改条件
	 * @param  string $order   排序条件
	 * @param  string $limit   受限条件
	 * @return           受影响条数
	 */
	public function update($tabName,$data,$where=null,$order=null,$limit=null){
		$sets = '';
		foreach ($data as $k => $v) {
			$sets.= $k."='".$v."',";
		}
		$sets = rtrim($sets,',');
		$sql = "UPDATE {$tabName} SET {$sets}"
			.$this->parseWhere($where)
			.$this->parseOrder($order)
			.$this->parseLimit($limit);
		return $this->execute($sql);
	}
	/**
	 * 删除数据
	 * @param  string  $tabName 删除操作的数据表
	 * @param  string  $where   删除条件
	 * @param  string  $order   排序条件
	 * @param  integer $limit   限制条数
	 * @return 		返回受影响条数
	 */
	public function delete($tabName,$where=null,$order=null,$limit=0){
		$sql = "DELETE FROM {$tabName}"
			.$this->parseWhere($where)
			.$this->parseOrder($order)
			.$this->parseLimit($limit);

		// return $sql;
		return $this->execute($sql);
	}
	/**
	 * 获取最后执行的 SQL 语句
	 * @return 返回 SQL 语句
	 */
	public function getLastSql(){
		$link=self::$link;
		if(!$link) return false;
		return self::$queryStr;
	}
	/**
	 * 得到上一步插入操作产生的 AUTO_INCREMENT 的值
	 * @return string|boolean
	 */
	public function getLastInsertId(){
		$link=self::$link;
		if(!$link) return false;
		return self::$lastInsertId;
	}
	/**
	 * 获取数据库版本信息
	 * @return string|boolean
	 */
	public function getDBVersion(){
		$link=self::$link;
		if(!$link) return false;
		return self::$dbVersion;
	}
	/**
	 * 返回数据库中存在的数据表
	 * @return  返回当前数据库中的数据表
	 */
	public function showTables(){
		$tables = array();
		if(self::query("SHOW TABLES")){
			$result = $this->getAll();
			foreach ($result as $k => $v) {
				$tables[$k]=current($v);//获取当前值
			}
		}
		return $tables;
	}
	/**
	 * 注销数据库连接
	 * @return  boolean
	 */
	public function close(){
		if(!is_null(self::$link)) self::$link = null;
		return true;
	}
	/**
	 * 增删改操作，返回受影响条数
	 * @param  string $sql 增删改操作 SQL 语句
	 * @return 返回受影响条数
	 */
	public function execute($sql=null){
		$link = self::$link;
		if(!$link) return false;
		if(!empty(self::$PDOStatement))self::free();
		self::$queryStr = $sql;
		$result = $link -> exec(self::$queryStr);
		self::haveErrorThrowException();
		if($result){
			self::$lastInsertId = $link->lastInsertId();
			self::$numRows = $result;
			return self::$numRows;
		}else{
			return false;
		}	
	}
	/**
	 * 执行query查询
	 * @param  string $sql 查询sql
	 * @return 返回查询结果
	 */
	public static function query($sql=''){
		$link=self::$link;
		if(!$link) return false;
		// 释放之前的结果集
		if(!empty(self::$PDOStatement))self::free();
		self::$queryStr = $sql;
		// 
		self::$PDOStatement = self::$link->prepare(self::$queryStr);
		$res = self::$PDOStatement -> execute();
		self::haveErrorThrowException();//存在异常则抛出异常
		return $res;
	}
	/**
	 * 释放结果集
	 * @return 释放结果集
	 */
	private static function free(){
		self::$PDOStatement = null;
	}
	/**
	 * 是否存在异常
	 * @return 返回异常信息
	 */
	private static function haveErrorThrowException(){
		$obj = empty(self::$PDOStatement)?self::$link: self::$PDOStatement;
		$arrError = $obj ->errorInfo();
		// print_r($arrError);
		if($arrError[0]!='00000'){
			self::$error = 'SQLSTATUE: '.$arrError[0].'<br>'."\n".'SQL Error: '.$arrError[2]."<br>\n Error SQL: ".self::$queryStr;
			self::throw_exception(self::$error);
			return false;
		}
		if(''==self::$queryStr){
			self::throw_exception('没有可执行的 SQL 语句.');
			return false;
		}
	}
	/**
	 * 绑定字段，解析字段，反引号 `
	 * @param  array/string   $fields 查询字段
	 * @return  string 		返回格式化后的字符串字段
	 */
	private function parseFields($fields){
		if(is_array($fields)){
			array_walk($fields, array("PdoMySQL","addSpecilChar"));//过滤字段
			$fieldsStr = implode(',',$fields);
		}elseif(is_string($fields)&&!empty($fields)){
			if(strpos($fields, '`')===false){//判断是否存在反引号
				$fields = explode(',', $fields);
				array_walk($fields, array("PdoMySQL","addSpecilChar"));
				$fieldsStr = implode(',',$fields);
			}else{//存在则赋值
				$fieldsStr = $fields;
			}
		}else{
			$fieldsStr = "*";
		}
		return $fieldsStr;
	}
	/**
	 * 解析查询条件 
	 * @param  string/array $where 查询条件
	 *         eg. array(
	 *         	fields => array ,
	 *          	array(
	 *           		NAME => TOM,
	 *             		SEX => 1,
	 *           	)
	 *          cond => string/array [or|and] //条件,数组则按顺序--混合or/and
	 *         )
	 * @return string       返回解析后的查询条件
	 */
	private function parseWhere($where){
		$whereStr = '';
		if(is_string($where)&&!empty($where) ){
			$whereStr = $where;
		}elseif(is_array($where)&&!empty($where['fields'])){
			if(is_array($where['fields'])){
				// 存在条件，且条件为字符串
				$keys = array_keys($where['fields']);
				$endkey = trim(end($keys));
				if(array_key_exists('cond',$where) ){
					if(is_string($where['cond'])){
						foreach ($where['fields'] as $k => $v) {
							if($k!=$endkey){
								$whereStr.=$k."='".$v."' ".$where['cond']." ";
							}else{
								$whereStr.=$k."='".$v."'";
							}
						}
					}elseif(is_array($where['cond'])){
						$cond=0;
						foreach ($where['fields'] as $k => $v) {
							if($k!=$endkey){
								$whereStr.=$k."='".$v."' ".$where['cond'][$cond]." ";
							}else{
								$whereStr.=$k."='".$v."'";
							}
							$cond++;
						}
					}	
				}else{//默认 AND 连接多个查询条件
					foreach ($where['fields'] as $k => $v) {
						if($k!=$endkey){
							$whereStr.=$k."='".$v."' AND ";
						}else{
							$whereStr.=$k."='".$v."'";
						}
					}
				}
				unset($keys);//释放不用的数组资源
			}else{
				$whereStr .= $where;
			}
		}elseif(is_array($where)&&count($where)==1){//eg. array('name'=>'1')
			foreach ($where as $k => $v) {
				$whereStr.=$k."='".$v."'";
			}
		}
		// print_r($whereStr);
		return empty($whereStr)?'':' WHERE '.$whereStr;
	}
	/**
	 * 解析分组条件
	 * @param  string/array $group 分组条件
	 * @return string        返回解析后的分组条件
	 */
	private function parseGroup($group){
		$groupStr = '';
		if(is_array($group)){
			$groupStr =' GROUP BY '. implode(',',$group);
		}elseif( is_string($group)&&!empty($group) ){
			$groupStr =' GROUP BY '. $group;
		}
		return empty($groupStr)?'':$groupStr;
	}
	/**
	 * 解析二次筛选条件
	 * @param  string/array $having 二次筛选条件
	 * @return string 	返回解析后的二次筛选条件
	 */
	private function parseHaving($having){
		$havingStr = '';
		if(is_string($having)&&!empty($having)){
			$havingStr.= ' HAVING '.$having;
		}
		return $havingStr;
	}
	/**
	 * 解析排序条件
	 * @param  string/array $order 排序条件
	 * @return string 	返回解析后的排序条件
	 */
	private function parseOrder($order){
		$orderStr = '';
		if(is_array($order)){
			$orderStr.= ' ORDER BY '.join(',',$order);
		}elseif(is_string($order)&&!empty($order)){
			$orderStr.= ' ORDER BY '.$order;
		}
		return $orderStr;
	}
	/**
	 * 限制条件解析
	 * @param  string/array $limit [description]
	 * @return string  返回解析后的限制条件
	 */
	private function parseLimit($limit){
		$limitStr = '';
		if(is_array($limit)){
			if(count($limit)>1){
				$limitStr.= ' LIMIT '.$limit[0].",".$limit[1];
			}else{
				$limitStr.= ' LIMIT '.$limit[0];
			}
		}elseif(is_string($limit)&&!empty($limit)){
			$limitStr.= ' LIMIT '.$limit;
		}
		return $limitStr;
	}
	/**
	 * 字段处理,通过反引号引用字段，防止字段存在关键字
	 * @param string &$value [description]
	 */
	private static function addSpecilChar(&$value){//引用修改值
		if($value==="*"||strpos($value,'.')!==false||strpos($value,'`')!==false){
			//为 * 或 存在 . 不处理
		}elseif(strpos($value,'`')===false){
			$value='`'.trim($value).'`';
		}
		return $value;
	}

	/**
	 * 自定义错误信息处理
	 * @param  string $errMsg 错误信息
	 * @return string         错误信息html模板
	 */
	private static function throw_exception($errMsg){
		$tmplate = '<div style="width:80%; background-color:#ABCDEF; color:black; font-size:20px; padding:5px;">'.$errMsg.'</div>'."\n";
		// echo $tmplate;
		return $tmplate;
	}

	/**
	 * 获取实例自身
	 * @return 返回PDO实例对象
	 */
	public static function get_instance(){
		if(NULL == self::$_instance)
			self::$_instance = new self();
		return self::$_instance;
	}
}



