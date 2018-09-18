<?php  
	/**
	 * 命名遵守 O则 --统一
	* MVC复习（学习）测试
	*/
	class testController
	{
		
		function show()
		{
			global $view;
			$testModel=M('test');
			$data=$testModel->get();
			// $testView=V('test');
			$view->assign('str',"he ha hi");
			$view->display('test.tpl');
			// $testView->display($data);
		}
	}
?>