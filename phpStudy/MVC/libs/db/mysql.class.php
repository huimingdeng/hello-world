<?php 
class mysql{

	public function err($error){
		die("抱歉，数据库操作有误：".$error);
	}

	/**
	 * 数据库连接
	 * @param array $config 数组，数据库连接参数,dbhost,dbuser,dbpass,dbname,dbcharset
	 * @return bool 返回数据库连接成功或失败
	 */
	public function Connection($config){
		extract($config);
		if(!($conn=mysql_connect($dbhost,$dbuser,$dbpass))){
			$this->err(mysql_error());
		}
		if(!(mysql_selectdb($dbname,$conn))){//选择数据库
			$this->err(mysql_error());
		}
		mysql_query('set names '.$dbcharset);//设置编码格式
	}
	/**
	 * 执行SQL语句
	 * @param  string $sql 要执行的SQL语句
	 * @return bool      返回操作成功或失败
	 */
	public function query($sql){
		if(!($query=mysql_query($sql))){
			$this->err($sql.'<br>'.mysql_error());
		}else{
			return $query;
		}
	}
	/**
	 * 返回资源列表
	 * @param  source $query SQL查询返回的资源
	 * @return array        返回列表数组
	 */
	public function findAll($query){
		while($rs=mysql_fetch_array($query,MYSQL_ASSOC)){
			$list[]=$rs;
		}
		return isset($list)?$list:"";
	}
	/**
	 * 获取单条数据
	 * @param  source $query SQL查询返回的资源
	 * @return array        返回单条数据数组
	 */
	public function findOne($query){
		$rs=mysql_fetch_array($query,MYSQL_ASSOC);
		return $rs;
	}
	/**
	 * 返回指定行指定字段的值
	 * @param  source $query SQL查询返回的资源
	 * @param  integer $row   获取行数
	 * @param  string $field 字段
	 * @return array         返回指定行指定字段的值
	 */
	public function findResult($query,$row=0,$field=''){
		$rs=mysql_result($query,$row,$field);
		return $rs;
	}
	/**
	 * 数据库操作
	 * @param  string $table 操作数据表对象名称
	 * @param  array  $value 需要添加的字段和值的键值对一维数组，array(字段名=>值,....)
	 * @return bool        返回操作数据成功或失败
	 */
	public function insert($table,$value){
		//insert into table(a,b,c) values(a,b,c)
		foreach($value as $k=>$v){
			$key[]="'".$k."'";
			$val[]="'".$v."'";
		}
		$sql = "INSERT INTO $table(".implode(',',$key)." values(".implode(',',$val).")";
		return $this->query($sql);
	}
	/**
	 * 数据库操作
	 * @param  [type] $table [description]
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	public function update($table,$value){

	}
	/**
	 * 数据库操作
	 * @param  [type] $table [description]
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	public function delete($table,$value){

	}
}