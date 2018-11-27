<?php 
namespace BuilderPattern;

abstract class CarBuilder{
	// 建造一个模型，提供一个组装顺序
	public abstract function setSequence($sequence); 
	// 设置完顺序后，可以直接获取模型
	public abstract function getCarModel();
}