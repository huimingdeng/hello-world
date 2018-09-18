<?php 
require_once 'config.php';
require_once 'PdoMySQL.class.php';
$pdo = PdoMySQL::get_instance();

// $res = $pdo->getById('employee',8,array('first_name','income','age'));
// echo $pdo::$queryStr."\n";
// print_r($res);
/*$where = array('fields'=>array( 'first_name'=>'HUIMING','last_name'=>'DENG','id'=>6),
	'cond'=>array('and','or')
	);*/
// $table='depart';
// $table = 'employee';
// $sql = "select id from company WHERE company='复能基因'";
// $sql = "select id from `depart` WHERE dname='测试部门2'";
// $res = $pdo->getRow($sql);

$res=$pdo->showTables();
print_r($res);
$res=$pdo->close();
var_dump($res);

// print_r($res);
// $data=array('dname'=>'测试部门2','comid'=>$res['id']);
/*$first_name='TEST2';
$last_name='FU2';
$sex=1;//0：女，1:男
$age=23;
$income=2950.50;
$dprtid=$res['id'];
$data=array(
	'first_name'=>$first_name,
	'last_name'=>$last_name,
	'sex'=>$sex,
	'age'=>$age,
	'income'=>$income,
	'dprtid'=>$dprtid
	);
echo $pdo->addOne($table,$data);*/
$where = "id=13";
$table = "depart";
echo $pdo->delete($table,$where);

/*	$where="id<5";
$fields='id,concat(`first_name`,\'-\',`last_name`) as `name`';
$group=array('id','first_name');
$limit="1";
print_r($pdo->getByFields($table,$where,$fields,$group));
echo $pdo::$queryStr;*/
/*$data=array(
	// 'first_name'=>'JINMING',
	// 'last_name'=>'WU',
	// 'age' =>26,
	'sex' =>1,
	'income' => 5000.00
	// 'dprtid' => 2
	);
// $where="id = 19";
// $where=array('id'=>19);
$where = array('fields'=>array('first_name'=>'JINMING','last_name'=>'WU'),'cond'=>'AND');
$order="id desc";
// echo $pdo->addOne($table,$data);
// var_dump($pdo->update($table,$data,$where,$order));

var_dump($pdo->delete($table,$where,$order));*/

/*$sql = "select * from employee";
$res = $pdo->getAll($sql);
// $res = $pdo->getRow($sql);
print_r($res);*/
/*
  //插入测试
	$sql = "select id from depart WHERE dname='生物信息'";
	$res = $pdo->getRow($sql);
	// $sql = "INSERT INTO employee(first_name,last_name,age,sex,income,dprtid) VALUES('GUANGLIANG','HONG',28,1,6400.00,".$res['id']."),('JIANGCHENG','WEN',27,1,5500.00,".$res['id']."),('ZHIJIE','FENG',30,1,6200.00,".$res['id']."),('WEN','LEI',28,1,5800.00,".$res['id'].");";
	$sql = "INSERT INTO employee(first_name,last_name,age,sex,income,dprtid)";
	$sql.= " VALUES('XIN','CHEN',27,1,6300.00,".$res['id'].");";
	$res = $pdo->execute($sql);
	print_r($res);
	echo "\n";
	echo $pdo::$lastInsertId;

*/
/* // 更新测试
$sql = "UPDATE employee SET age=age+5 WHERE id in (2,3);";
$res = $pdo->execute($sql);
print_r($res);
echo "\n";
echo $pdo::$lastInsertId;
*/
/*
$sql = "SELECT concat(first_name,' ',last_name) as `name`,age,IF(sex=1,'m','f') AS sex,income,dname FROM employee as e LEFT JOIN depart as d ON e.dprtid = d.id WHERE d.id <3;";
$res = $pdo->getAll($sql);

echo  " name\t | \t age\t| sex \t| income\t| depart\t\n";
if(!empty($res)){
	$temp = " %s \t| \t %s \t| %s \t| %s \t| %s\t\n";
	foreach ($res as $rows) {
		echo sprintf($temp,$rows['name'],$rows['age'],$rows['sex'],$rows['income'],$rows['dname']);
	}
}
*/