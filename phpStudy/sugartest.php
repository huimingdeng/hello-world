<?php
require_once('sugarcrm/sugarcrm.php');
use sugarcrm\Sugarcrm;

$obj=Sugarcrm::get_instance();
$data=array(
    'name'=>'GC-X0921',
    'pm_status_c'=>'Conserved',
    'primer_no_c'=>'PF13959s',
    'length_c'=>'1083',
    'plate_well_c'=>'420F_C06',
    'place_no_c'=>'Rp293-43',
    'antibiotics_c'=>'kanamycin',
    'stock_plate_no_c'=>'GC-024-C09',
    );
// $obj->importData();



// 查询测试，只能查询一个模块
/*$fields=array
        (
            'name',
            'pm_status_c',
            'primer_no_c',
            'length_c',
            'plate_well_c',
            'place_no_c',
            'antibiotics_c',
            'stock_plate_no_c',
            'id',
            // 'date_entered_label',
        );//Inventory
        // array('inv_inventory','inv_inventory_cstm')
$res=$obj->searchByModule(array('inv_inventory'),$fields,'GC-');
// Test ----------- 
// echo "<pre>";
print_r($res);*/
// echo "</pre>";
// echo "<pre>";
// print_r($obj->getFields());
// echo "</pre>";
// $proid=$res[0]->id->value;
// echo $proid;
