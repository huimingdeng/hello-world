<?php 
namespace BuilderPattern;
use TemplateMethodPattern;

require(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . '15.Template_method_pattern' . DIRECTORY_SEPARATOR . 'bmwmodel.class.php' );
/**
 * 宝马
 */
class BMWBuilder extends CarBuilder
{
	private $bmw = null;
	function __construct()
	{
		$this->bmw = new TemplateMethodPattern\BMWModel();
	}
	public function setSequence($sequence){
		$this->bmw->setSequence($sequence);
	}

	public function getCarModel()
	{
		return $this->bmw;
	}
}