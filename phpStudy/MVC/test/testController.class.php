<?php  
	/**
	 * 命名遵守 O则 --统一
	* MVC复习（学习）测试
	*/
	class testController
	{
		
		function show()
		{
			$testModel=new testModel();
			$data=$testModel->get();
			$testView=new testView();
			$testView->display($data);
		}
	}
?>