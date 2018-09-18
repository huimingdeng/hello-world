<?php
namespace sugarcrm;

/**
* Name : SugarCrm
* Description : SugarCrm 操作类，仅完成部分功能（创建、更改记录、查询模块字段、根据模块查询）
* Author : huimingdeng
* Version : 1.1
* URL : 
* CreateTime : 2018-04-24
* UpdateTime : 2018-04-25
*/
class Sugarcrm
{
	private static $_instance =null;
	public $username = 'admin';
	private $password = 'dhm4Cd5snLbb';
	public $url = 'http://www.genecopoeia.com:8000/sugarcrm/service/v4/rest.php';
	public $login_result = null;
	private $version = "1";
	private $appName = "RestTest";
	protected $result=null;
	public $errMsgs = array();

	public function __construct($crmconfig=array())
	{
		if(is_array($crmconfig)&&!empty($crmconfig)){
			$this->username=$crmconfig['username'];
			$this->password='dhm'.$crmconfig['password'];
			(!empty($crmconfig['url']))?$this->url = $crmconfig['url']:'';
		}
		// 登陆验证
		$this->login();
	}
	/**
	 * 使用类，立马验证登陆信息
	 * @return 
	 */
	public function login(){

		$parameters = array(
	         "user_auth" => array(
	              "user_name" => $this->username,
	              "password" => md5(substr($this->password,3)),
	              "version" => $this->version
	         ),
	         "application_name" => $this->appName,
	         "name_value_list" => array(),
	    );

	    $this->login_result = $this->curl_method("login", $parameters, $this->url);
	}
	/**
	 * 根据模块查询结果
	 * @param  array/string $modules 查询模块 string则逗号分隔
	 * @param  string/array  $fields  查询字段 逗号分隔
	 * @param  string  $where    查询字符串
	 * @param  integer  $offset   偏移量 0
	 * @param  integer  $max 	返回记录数 9 0-9 10条
	 * @param  boolean  $bool  布尔类型，是否启用统一查询，默认启用
	 * @param  boolean	$favority  收藏，默认关闭
	 * @return Object          返回查询结果
	 */
	public function searchByModule($modules,$fields,$where,$offset=0,$max=9,$bool=true,$favority=false){
		// var_dump($modules);
		if(empty($modules)&&!is_string($modules)){
			$modules =array('inv_inventory');
			$fields='name,id';
		}elseif(is_string($modules)){
			$modules = explode(',',$modules);
		}
		if($where==''||empty($where)){
			self::throw_exception('抱歉请设置查询条件');
			
			return false;
		}
		if(empty($fields)){
			self::throw_exception('抱歉请设置查询字段');
			return false;
		}elseif(is_string($fields)){
			$fields = explode(',',$fields);
		}
		// 查询条件
		$parameters = array(
	        "session" => $this->login_result->id,
	        'search_string' => $where,
	        'modules' => $modules,	
	        'offset' => $offset,	
	        'max_results' => $max,
	        'id' => '',	
	        'select_fields' => $fields,	
	        'unified_search_only' => $bool,
	        'favorites' => $favority 
	    );
	    /*print_r($parameters);
	    exit;*/
    	$res = $this->curl_method('search_by_module', $parameters, $this->url);
    	// $this->total = $res->result_count;//查询结果数
    	if(!empty($res->entry_list)){
    		$this->result = $res->entry_list[0]->records;
    	}else{
    		$this->result = null;
    	}
    	
    	return $this->result;
	}
	/**
	 * 获取当前模块的所有字段
	 * @param  string $modules 查询模块
	 * @return  Object  	模块字段
	 */
	public function getFields($modules='inv_inventory'){
		$parameters = array(
	         'session' => $this->login_result->id,
	         'module_name' => $modules,
	    );
	    $this->result = $this->curl_method('get_module_fields',$parameters, $this->url);
	    return $this->result;
	}
	/**
	 * 创建记录
	 * @param  string $modules 模块名
	 * @param  array $data  添加的数据，除 id 外 
	 *                      array(array("name" => "name", "value" => "Test Account"))
	 * @param  integer $type 0:单条记录添加，1：多条记录添加
	 * @return object 
	 */
	public function importData($modules,$data,$type=0){
		if(empty($modules)){
			self::throw_exception('请选择模块');
			return false;
		}
		if(empty($data)){
			self::throw_exception('请提供添加数据');
			return false;
		}
		
		$parameters = array(
		    "session" => $this->login_result->id,
		    'module_name' => $modules,
		    'name_value_list' => $data,//  array(array("name" => "user_name"),...)
		);
		($type===0)?$method = 'set_entry':$method = 'set_entries';
		// method :set_entry 创建账号
		$tmp_res = $this->curl_method($method,$parameters,$this->url);
		//批量操作，则返回对象属性ids为数组的结果，单条则返回对象属性entry_list对象（属性name）
		($type===0)?$this->result = $tmp_res->entry_list->name:$this->result = $tmp_res->ids;
		// $this->result = array('a','b');
		return $this->result;
	}
	/**
	 * 更新记录 [OK]
	 * @param  string $modules 操作模块
	 * @param  array $data    更新数据 
	 * eg. $data=array(
	 *           	array(
	 *              	'name'=>'id',
	 *                  'value'=>'c39c0134-1043-5315-2ab7-50b633d86275'
	 *              ),
	 *              array(
	 *                   'name'=>'name',
	 *                   'value'=>'GC-A0012'
	 *              ),
	 *              ... ...
	 *          );
	 * @return object 	返回更新后的数据
	 */
	public function update($modules,$data,$type=0){
		if(empty($modules)){
			self::throw_exception('请选择模块');
			return false;
		}
		if(empty($data)){
			self::throw_exception('请提供更新数据');
			return false;
		}
		if($data[0]['name']!='id'){
			self::throw_exception('更新错误，请提供更新对象的id');
			return false;
		}
		// exit;
		$parameters = array(
		    "session" => $this->login_result->id,
		    'module_name' => $modules,
		    'name_value_list' => $data,
		);
		($type===0)?$method = 'set_entry':$method = 'set_entries';
		$tmp_res = $this->curl_method($method,$parameters,$this->url);
		// $this->result = $tmp_res->entry_list;
		($type===0)?$this->result = $tmp_res->entry_list->name:$this->result = $tmp_res->ids;
		return $this->result;
	}
	/**
	 * 根据模块id删除信息
	 * @param  string $id 模块id
	 * @return boolean	true|false
	 */	
	public function deleteById($id){
		// done...
	}

	/**
	 * SugarCRM 访问方法
	 * @param  string $method     
	 * @param  array $parameters 
	 * @param  string $url        
	 * @return object             
	 */
	public function curl_method($method, $parameters, $url){
		ob_start();
        $curl_request = curl_init();

        curl_setopt($curl_request, CURLOPT_URL, $url);
        curl_setopt($curl_request, CURLOPT_POST, 1);
        curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl_request, CURLOPT_HEADER, 1);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

        $jsonEncodedData = json_encode($parameters);

        $post = array(
             "method" => $method,
             "input_type" => "JSON",
             "response_type" => "JSON",
             "rest_data" => $jsonEncodedData
        );

        curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
        $result = curl_exec($curl_request);
        curl_close($curl_request);

        $result = explode("\r\n\r\n", $result, 2);
        $response = json_decode($result[1]);
        ob_end_flush();

        return $response;
	}
	/**
	 * 异常处理信息
	 * @param  string $errMsg 错误消息
	 * @return string  错误消息
	 */
	public static function throw_exception($errMsg){
		// $tmplate = '<div style="width:80%; background-color:#ABCDEF; color:black; font-size:20px; padding:5px;">'."\n".$errMsg."\n".'</div>'."\n";
		// echo $tmplate;
		array_push(self::$_instance->errMsgs,$errMsg);
		// echo implode(',',self::$_instance->errMsgs)."\n";
		return self::$_instance->errMsgs;
	}
	
	/**
	 * 默认配置文件存在，可直接调用实例化
	 * @return [type] [description]
	 */
	public static function get_instance(){
		if(NULL == self::$_instance)
			self::$_instance = new self();
		return self::$_instance;
	}

	public function __destruct(){
		$this->result = null;
		$this->login_result=null;
	}

}

/**
 * P.S. 关于公司使用，只要用 inv_inventory 修改/添加基因产品信息，用到如下字段
 * eg. 修改单条记录
 * $data = array(
 * 		array('name'=>'id','value'=>$res[0]->id->value),//修改的基因id
 *   	array('name'=>'name','value'=>''),//cat
 *    	array('')
 * )
 * 
 * 
 * 
 * 
 */

?>