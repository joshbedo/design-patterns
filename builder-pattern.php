<?php
abstract class AbstractPageBuilder{
	abstract function getPage();
}

abstract class AbstractPageDirector{
	abstract function __construct(AbstractPageBuilder $builder_in);
	abstract function buildPage();
	abstract function getPage();
}

class HTMLPage {
	private $page = null;
	private $page_title = null;
	private $page_header = null;
	private $page_text = null;

	function __construct(){
	}
	function showPage(){
		return $this->page;
	}
	function setTitle($title_in){
		$this->page_title = $title_in;
	}
	function setHeading($heading_in){
		$this->page_heading = $heading_in;
	}
	function setText($text_in){
		$this->page_text .= $text_in;
	}
	function formatPage(){
		$this->page = '<html>';
		$this->page .= '<header><title>'.$this->page_title.'</title></head>';
		$this->page .= '<body>';
		$this->page .= '<h1>'.$this->page_heading.'</h1>';
		$this->page .= $this->page_text;
		$this->page .= '</body>';
		$this->page .= '</html>';
	}
}
?>