<?php
// If there is a change in the corresponding information in Excel, please modify the program.
set_time_limit(0);
// eg. [gcdev2@pollux ~]$ php Linux_run_php_command_excute_Excel.php test.xlsx
// eg. E:\gcdev2> php Linux_run_php_command_excute_Excel.php test.xlsx
if(count($argv)>1){
	$allExt = array("xlsm","xls","xlsx");
	foreach ($argv as $k => $v) {
		if(basename(__FILE__)!=$v){
			if(in_array(pathinfo($v,PATHINFO_EXTENSION),$allExt)){
				runExportVectorPrice($v);
			}else{
				echo "Sorry, the file you executed is not an extension file that exists in the list:\n";
				echo "[".implode(',', $allExt)."]...\n";
			}
		}
	}

}else{
	echo "Error,Please enter the Excel file to execute....\n";
}

function runExportVectorPrice($filePath){

	include 'Classes/PHPExcel.php';
	include 'httpdocs/order/function.dis.php';

	$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_discISAM;
	$cacheSettings = array();
	PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
	$filename = pathinfo($filePath,PATHINFO_FILENAME);
	$ext = pathinfo($filePath,PATHINFO_EXTENSION);

	$PHPReader = new PHPExcel_Reader_Excel2007();
	if( !$PHPReader->canRead($filePath) ){
	    $PHPReader = new PHPExcel_Reader_Excel5();
	    if( !$PHPReader->canRead($filePath) ){
	        echo 'no Excel'."\n";
	        return ;
	    }
	}
	echo "Begin read Excel.... ".date('H:i:s')." \n";
	$PHPExcel = $PHPReader->load($filePath);
	$sheetcount=$PHPExcel->getSheetCount();
	$sheetName = $PHPExcel->getSheetNames();
	$PHPExcelObj = new PHPExcel();
	// 循环执行链表 Loop execution linked list
	for($sheetIndex=1;$sheetIndex<=$sheetcount;$sheetIndex++){
		
		$currentSheet = $PHPExcel->getSheet($sheetIndex-1);//第一张链表 u1
		$allColumn = $currentSheet->getHighestColumn();
		$allRow = $currentSheet->getHighestRow();
		echo "sheet name:".$sheetName[$sheetIndex-1]."\n"; //u4
		if($sheetIndex > 1){ // 因为默认有一页, 所有从第二开始  
	        $PHPExcelObj->createSheet(); // 创建内置表 
	        echo "create a new sheet "."\n";
	    }
	    
	    $PHPExcelObj->setActiveSheetIndex($sheetIndex-1);
	    
		for($rowIndex=1;$rowIndex<=$allRow;$rowIndex++){
		    $newSheet = $PHPExcelObj->getActiveSheet();
		    $cellname=ord('A');
		    $website_list_price = 0;
			for($cellname;$cellname<=ord('D');$cellname++){
				if($rowIndex==1){//A1,B1 设置为货号和discunt price
			    	if(chr($cellname)=='A'){
			    		$cell = 'Catalog Number';
			    	}elseif(chr($cellname)=='B'){
			    		$cell = 'Website Catalog Number';
			    	}elseif(chr($cellname)=='C'){
			    		$cell = 'Website List price';
			    	}elseif(chr($cellname)=='D'){
			    		$cell = 'website discunt price';
			    	}
			    }else{// A2....An
/**
 eg. If there is a change in the corresponding information in Excel, please modify the program.
 Catalog Number => An (n:number)
 orf_length => In
 list price => (10ug clone's price => Jn)-50
 cloned => Gn
 vector => Ln
*/
			    	$cat_no = $currentSheet->getCell('A'.$rowIndex)->getValue();//Catalog Number
					$seq_length = $currentSheet->getCell('I'.$rowIndex)->getValue();//orf_length
					$price = $currentSheet->getCell('J'.$rowIndex)->getValue()-50;//list price old-J
					$cloned = $currentSheet->getCell('G'.$rowIndex)->getValue();//cloned
					$vector = $currentSheet->getCell('L'.$rowIndex)->getValue();//vector old-K
					if(!empty($vector)){
						$is_clone_in_us = 1;
					}else{
						$is_clone_in_us = 0;
					}

			    	if(chr($cellname)=='A'){
			    		$cell = $currentSheet->getCell('A'.$rowIndex)->getValue();
			    	}elseif(chr($cellname)=='B'){
			    		if(!empty($vector)){
			    			$cell = $cat_no."-10";
			    		}else{
			    			$cell = $cat_no;
			    		}
			    	}elseif(chr($cellname)=='C'){
			    		// Lv105 and Lv242:if vector null enter price+50 else vector not empty price+100
			    		// M02,M13 and M98:if vector null enter price else vector not empty price+50
			    		if(preg_match('/Lv105$|Lv242$/',$cat_no)){
				    		if(!empty($vector)){
				    			$cell = $website_list_price = ($price+100);
				    		}else{
				    			$cell = $website_list_price = ($price+50);
				    		}
				    	}elseif(preg_match('/M02$|M13$|M98$/',$cat_no)){
				    		if(!empty($vector)){
				    			$cell = $website_list_price = ($price+50);
				    		}else{
				    			$cell = $website_list_price = $price;
				    		}
				    	}
			    	}elseif(chr($cellname)=='D'){
			    		
						// if(!empty($cloned)&&$cloned==1&&!empty($vector)){
						if(!empty($cloned)&&$cloned!=0&&!empty($vector)){
							$disprice = nextday_orf_rule($cat_no,$seq_length,$website_list_price,$is_clone_in_us);
							$cell = intval($disprice) + 50;
						}elseif(!empty($cloned)&&empty($vector)&&$cloned!=0){
							$cell = round($website_list_price*0.9);
						}else{
							$cell = $website_list_price;//等於上一個C的價格
						}
			    	}
			    }
			    // echo "save ".chr($cellname).$rowIndex." data ....\n";
				$newSheet->setCellValue(chr($cellname).$rowIndex,$cell);
			}
			echo "setting sheet line ".$rowIndex."....\n";
			$newSheet->setTitle($sheetName[$sheetIndex-1]);
			// $newSheet->setTitle($sheetName[2]);//修改链表sheet u2
		}
	}
	echo "begin save excel...\n";
	// exit;
	// 保存Excel表
	$sheetWrite = PHPExcel_IOFactory::createWriter($PHPExcelObj, 'Excel2007'); 
	// $sheetWrite->save('testExcel2.xlsx');
	$newfilename=$filename."-".date("Y-m-d-H-i").".".$ext;
	$sheetWrite -> save($newfilename);
	echo "finishi save $newfilename....\n";
}