<?php
abstract class AbstractFactoryMethod{
	abstract function makePHPBook($param);
}

class OReillyFactoryMethod extends AbstractFactoryMethod{
	private $context = "OReilly";
	function makePHPBook($param){
		$book = null;
		switch($param){
			case "us":
				$book = new OReillyPHPBook;
				break;
			case "other":
				$book = new SamsPHPBook;
				break;
			default:
				$book = new OReillyPHPBook;
				break;
		}
		return $book;
	}
}

class SamsFactoryMethod extends AbstractFactoryMethod{
	private $context = "Sams";
	function makePHPBook($param){
		$book = null;
		switch($param){
			case "us":
				$book = new SamsPHPBook;
				break;
			case "other":
				$book = new OReillyPHPBook;
				break;
			default:
				$book = new SamsPHPBook;
				break;
		}
		return $book;
	}
}

abstract class AbstractBook{
	abstract function getAuthor();
	abstract function getTitle();
}

abstract class AbstractPHPBook{
	private $subject = "PHP";
}

class OReillyPHPBook extends AbstractPHPBook{
	private $author;
	private $title;
	private static $oddOrEven = 'odd';
	function __construct(){
		if('odd' == self::$oddOrEven){
			$this->author = 'Rasmus Lerdorf and Keving Tatroe';
			$this->title = 'Programming PHP';
			self::$oddOrEven = 'even';
		}else{
			$this->author = 'David Sklar and Adam Trachtenberg';
			$this->title = 'PHP Cookbook';
			self::$oddOrEven = 'odd';
		}
	}
	function getAuthor() { return $this->author; }
	function getTitle() { return $this->title; }
}

class SamsPHPBook extends AbstractPHPBook{
	private $author;
	private $title;
	function __construct(){
		mt_srand((double)microtime()*10000000);
		$rand_num = mt_rand(0,1);

		if(1 > $rand_num){
			$this->author = 'George Schlossnagle';
			$this->title = 'Advanced PHP Programming';
		}else{
			$this->author = 'Christian wenz';
			$this->title  = 'PHP Phrasebook';
		}
	}
	function getAuthor() { return $this->author; }
	function getTitle(){ return $this->title; }
}

writeln('START TESTING FACTORY METHOD PATTERN');
writeln('');

writeln('testing OReillyFactoryMethod');
$factoryMethodInstance = new OReillyFactoryMethod;
testFactoryMethod($factoryMethodInstance);

writeln('testing SamsFactoryMethod');
$factoryMethodInstance = new SamsFactoryMethod;
testFactoryMethod($factoryMethodInstance);

function testFactoryMethod($factoryMethodInstance){
	$phpus = $factoryMethodInstance->makePHPBook("us");
	writeln('us php author: ' .$phpus->getAuthor());
	writeln('us php title: ' .$phpus->getTitle());

	$phpus = $factoryMethodInstance->makePHPBook("other");
	writeln('other php author: ' .$phpus->getAuthor());
	writeln('other php title: ' .$phpus->getTitle());

	$phpus = $factoryMethodInstance->makePHPBook("otherother");
	writeln('otherother php author: ' .$phpus->getAuthor());
	writeln('otherother php title: ' .$phpus->getTitle());
}

function writeln($line_in){
	echo $line_in."<br />";
}
?>