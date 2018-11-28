<?php 
namespace BuilderPattern;
use TemplateMethodPattern;

require(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . '15.Template_method_pattern' . DIRECTORY_SEPARATOR . 'benzmodel.class.php' );
/**
 * 奔驰构建者
 */
class BenzBuilder extends CarBuilder
{
	private $benz;

	public function __construct(){
		$this->benz = new TemplateMethodPattern\BenzModel();
	}

	public function setSequence($sequence){
		$this->benz->setSequence($sequence);
	}

	public function getCarModel()
	{
		return $this->benz;
	}
}