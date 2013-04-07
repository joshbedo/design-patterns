<?php
/*
* BookFactory classes
*/
abstract class AbstractClass{
	//force extending class to define this method
	abstract protected function getValue();
	abstract protected function prefixValue($prefix);

	//common reusable method
	public function printOut(){
		echo $this->getValue() . "\n";
	}
}

class ConcreteClass1 extends AbstractClass{
	protected function getValue(){
		return "ConcreateClass1";
	}
	public function prefixValue($prefix){
		return "{$prefix}ConcreteClass1";
	}
}

class ConcreteClass2 extends AbstractClass{
	public function getValue(){
		return "ConcreteClass2";
	}
	public function prefixValue($prefix){
		return "{$prefix}ConcreteClass2";
	}
}

$class1 = new ConcreteClass1;
$class1->printOut();
echo $class1->prefixValue('FOO_') . "\n";

$class2 = new ConcreteClass2;
$class2->printOut();
echo $class2->prefixValue('FOO_') . "\n";


?>