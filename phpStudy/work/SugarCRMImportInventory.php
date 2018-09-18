<?php
set_time_limit(0);

class SugarCRMImportInventory
{
	private $file;
	private $PHPReader;
	private $PHPExcel;
	private $sheetTotal;//Excel中总表数
	private $sheet;
	private $sheetNames;
	private $currentSheet;//当前链表
	private $allColumn;//所有列
	private $allRow;//所有行
	private $beginCol = 'A';//默认从A列开始
	private $title=array();//获取标题单元值
	private $values =array();//Excel值
	private $is_mult=false;
	private $cellVal;
	private $fields;
	private $msg=false;//判断执行SugarCRM是否成功
	private $data = array();
	private $newDataNum=0;//Excel中的新数据
	private $oldDataNum=0;//Excel中的已有数据
	private $newAddnum=0;//新增成功数量
	private $modifyNum=0;//更新数量
	public $sugarcrm;
	public $modules=array('inv_inventory');//操作模块，默认为inv_inventory
	private $mtype=0;//0:只对模块进行新增操作，1：只对模块进行更新操作，2：混合模式
	private $dirname;//对应clone信息目录(Vector信息)
	private $vector;

	/**
	 * 
	 * @param string  $filePath 文件路径
	 * @param boolean $is_mult  是否读取Excel表中的所有sheet表（sheet表一致）
	 * @param integer $sheetNo  读取Excel表中第一张sheet表
	 */
	public function __construct($filePath,$is_mult=false,$sheetNo=0){
		require_once 'Library/PHPExcel.php';
		$this->file=pathinfo($filePath,PATHINFO_FILENAME);
		($sheetNo!=0)?$this->sheetNo=$sheetNo:$this->sheetNo=0;
		($is_mult)?$this->is_mult=$is_mult:'';
		$this->getExcelFiles($filePath);
		$this->createObj();
	}

	public function getExcelFiles($filePath){
		
		$this->PHPReader = new PHPExcel_Reader_Excel2007();
		if( !$this->PHPReader->canRead($filePath) ){
		    $this->PHPReader = new PHPExcel_Reader_Excel5();
		    if( !$this->PHPReader->canRead($filePath) ){
		        $this->msg = 'no Excel'."\n";
		        return ;
		    }
		}
		$this->PHPExcel = $this->PHPReader->load($filePath);//打开Exce
		$this->sheetTotal=$this->PHPExcel->getSheetCount();
		$this->sheetNames = $this->PHPExcel->getSheetNames();//获取链表名
		$this->sheet = new PHPExcel();//实例Excel对象
		
	}

	public function multiLoop(){
		if($this->is_mult){//循环Excel表中的所有表
			for($sheetIndex=1;$sheetIndex<=$this->sheetTotal;$sheetIndex++){
				$this->currentSheet = $this->PHPExcel->getSheet($sheetIndex-1);//获取当前子表
				$this->allColumn = $this->currentSheet->getHighestColumn();//获取总列数
				$this->allRow = $this->currentSheet->getHighestRow();//获取总行数
				$this->sheet->setActiveSheetIndex($sheetIndex-1);
				$this->loopGetByCol();
			}
		}else{
			$newSheet = $this->PHPExcel->getActiveSheet();
			$this->currentSheet = $this->PHPExcel->getSheet($this->sheetNo);
			$this->allColumn = $this->currentSheet->getHighestColumn();
			$this->allRow = $this->currentSheet->getHighestRow();
			$this->sheet->setActiveSheetIndex($this->sheetNo);
			$this->loopGetByCol();
		}
		
	}
	
	public function loopGetByCol(){
		$this->newDataNum=0;
		$this->oldDataNum=0;
		for($rowIndex=1;$rowIndex<=$this->allRow;$rowIndex++){
			$cellname=ord($this->beginCol);
			for($cellname;$cellname<=ord($this->allColumn);$cellname++){
				//获取当前子表单元格信息
				$cellVal = $this->currentSheet->getCell(chr($cellname).$rowIndex)->getValue();
				if($rowIndex==1){
					(!empty($cellVal))?$this->title[chr($cellname)]=$cellVal:($this->title[chr($cellname)]=chr($cellname));
				}else{
					$this->values[$rowIndex-1][$this->title[chr($cellname)]] = $cellVal;
				}
				
			}
		}
	}

	public function getCellVal($cellname){
		return $this->currentSheet->getCell($cellname)->getValue();
	}

	public function getSheetName(){
		return $this->sheetNames;
	}

	public function getValue(){
		return $this->values;
	}

	public function createObj(){
		require_once '../sugarcrm/sugarcrm.php';
		$this->sugarcrm = sugarcrm\Sugarcrm::get_instance();
	}

	public function getTitle(){
		return $this->title;
	}
	/**
	 * \\nas1.fulengen.net\na\Lisa\Lists for Fulengen 3.2.18 按目录分类
	 * Excel表列名与库存字段对照(目录对应)
	 * @param  [type] $dirname [description]
	 * @return [type]          [description]
	 */
	public function modulesFields($dirname){
		
		switch ($dirname) {
			case 'AM03':
				$this->dirname = $dirname;
				$fields = array(
					'product ID' => 'name',//Catalog Number
					// 'clonestatus' => 'pm_status_c',//PM Status
					'PrNo' => 'primer_no_c',//Primer ID
					'Vector' => 'vector_c',//Vector
					'StockID' => 'stock_id_c',//Stock ID
					'Note' => 'note_other_c',//
					'Cell' => 'host_cell_c', // Host Cell
					// 'PLATEWELL' => 'plate_well_c',//Plate-Well
					// 'orf_len' => 'length_c',//Length
					// 'Placeno' => 'place_no_c',//Place No.
					'StockPlateNO.' => 'stock_plate_no_c',//Stock_Plate_no
					'Antibiotic' => 'antibiotics_c',//Antibiotics
					);
				break;
			case 'GC':
				$this->dirname = $dirname;
				$fields = array(
					'product_id' => 'name',//Catalog Number
					'clonestatus' => 'pm_status_c',//PM Status
					'NEW_PRIMER_ID' => 'primer_no_c',//Primer ID
					'PLATEWELL' => 'plate_well_c',//Plate-Well
					'orf_len' => 'length_c',//Length
					'Placeno' => 'place_no_c',//Place No.
					'Antibiotic' => 'antibiotics_c',//Antibiotics
					'StockPlateNO.' => 'stock_plate_no_c',//Stock_Plate_no
					);
				break;
		}
		$this->fields = $fields;
		$this->setData();
		// return $this->fields;
	}

	public function setData(){
		if(!empty($this->dirname)){
			$data = array();
			foreach($this->values as $row => $lines){
				foreach ($lines as $k => $v) {
					if(!empty($this->fields[$k]))
						$data[$row][$this->fields[$k]]=$v;
				}
			}
			$this->data = $data;
		}else{
			return false;
		}
	}
	//可控部分
	public function setModules($strModules){
		if(is_string($strModules)&&!empty($strModules)){
			$this->modules=explode(',',$strModules);
		}else{
			$this->modules=array('inv_inventory');
		}
		//重新设置模块
		$this->setDataAfter();
	}
	// 判断当前信息是否为新产品 [ok]
	public function setDataAfter(){
		if(!empty($this->data)&&!empty($this->dirname)){
			$data =$this->data;
			$fields=array_keys($data[1]);
			array_push($fields,'id');
			foreach ($data as $k => $v) {
				if($this->is_Vector($v['name'])){
						if($this->vector===1){
							$search=$v['name'].'-'.$this->dirname;
						}elseif($this->vector===2){
							$search=$this->dirname.'-'.$v['name'];
						}else{
							$search=$v['name'];
						}
					}
				$res=$this->sugarcrm->searchByModule($this->modules,$fields,$search);
				if(!empty($res)){//非空，则可以组装数据,用户更改
					$this->oldDataNum++;
					$this->data[$k]['id']=$res[0]->id->value;
				}else{
					$this->newDataNum++;
				}
			}
			$this->setDataFinal();//最终组装成sugarCRM批量可操作数据
		}
	}

	private function is_Vector(){
		switch ($this->dirname) {
			case 'AM03':
				$this->vector=1;//vector =1 prod_id : 需加$this->dirname
				break;

		}

		if($this->vector!==0){
			return true;
		}else{
			return false;
		}
	}

	public function setDataFinal(){
		// $this->dirname,必须保证clone对应Excel字段匹配
		if(!empty($this->data)&&!empty($this->dirname)){
			$data = $this->data;
			print_r($data);exit;
			$this->data=array();//清空旧数据，用于保存新的可批量处理的数据
			foreach($data as $line =>$arr){
				$tmp_data=array();
				foreach($arr as $k=>$v){
					if($this->is_Vector($v['name'])){
						if($this->vector===1){
							$v['name']=$v['name'].$this->dirname;
						}
					}
			        if($this->mtype===0){
			        	if(array_key_exists('id',$arr)) break;
			        	$tmp_data[]=array("name"=>$k,"value"=>$v);
			        }elseif($this->mtype===1){
			        	if(!array_key_exists('id',$arr)) break;
			        	$tmp_data[]=array("name"=>$k,"value"=>$v);
			        }elseif($this->mtype===2){
			        	$tmp_data[]=array("name"=>$k,"value"=>$v);
			        }else{
			        	$tmp_data=array();
			        }
			        
				}
				if(!empty($tmp_data))
					$this->data[]=$tmp_data;
			}
			if(!empty($this->data)){
				// $this->runImportData();
				print_r($this->data);
			}
		}
	}

	public function runImportData(){
		$result = $this->sugarcrm->importData($this->modules,$this->data,$type=1);
		if($result){
			if($this->mtype===0){
				$this->newAddnum = count($result);
			}elseif($this->mtype===1||$this->mtype===2){
				$this->modifyNum = count($result);
			}
			$this->msg=true;
		}

		$this->setLog();
	}
	public function getData(){
		return $this->data;
	}

	private function setLog(){
		$logname=date('Y-m-d-H-i').'-log.txt';
		if($this->newDataNum&&$this->oldDataNum&&$this->msg){
			$text="文件 ".$this->file." 新增数量为$this->newDataNum ,已存在$this->oldDataNum, ";
			if($this->mtype===0||$this->mtype===1){
				$text.="实际添加数量为 $this->newAddnum, 实际修改数量为 $this->modifyNum";
			}else{
				$text.="实际添加与修改数量为 $this->modifyNum";
			}
		}else{
			$text = implode(',',$this->sugarcrm->errMsgs);
		}
		file_put_contents($logname,$text);
	}

	public function __destruct(){
		$this->sugarcrm = null;
	}
}

$filePath='./FILES/am03test.xlsx';
$test = new SugarCRMImportInventory($filePath);
$test->multiLoop();
$testval=$test->getValue();
// $data=$test->getData();
print_r($testval);
// $files_arr=$test->modulesFields('');
// print_r($files_arr);
// $test->setData();
// $data=$test->getData();
// print_r($data);
// $r=$test->setDataAfter();
// print_r($r);
// $testval=$test->getValue();
// $data=$test->getData();
// print_r($data);
