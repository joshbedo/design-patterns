<?php
/*
* Singleton Classes
*/
class BookSingleton{
	private $author = 'Gamma, Helm, Johnson, and Vlissides';
	private $title = 'Design Patterns';
	private static $book = null;
	private static $isLoanedOut = false;

	private function __construct(){
	}

	static function borrowBook(){
		if(False == self::$isLoanedOut){
			if(NULL == self::$book){
				self::$book = new BookSingleton();
			}
			self::$isLoanedOut = true;
			return self::$book;
		}else{
			return null;
		}
	}

	function returnBook(BookSingleton $bokReturned){
		self::$isLoanedOut = false;
	}

	function getAuthor(){ return $this->author; }
	function getTitle(){ return $this->title; }
	function getAuthorAndTitle(){
		return $this->getTitle() . ' by ' . $this->GetAuthor();
	}
}

class BookBorrower{
	private $borrowedBook;
	private $haveBook = false;

	function __construct(){
	}

	function getAuthorAndTitle(){
		if(TRUE == $this->haveBook){
			return $this->borrowedBook->getAuthorAndTitle();
		}else{
			return "I don't have the book";
		}
	}

	function borrowBook(){
		$this->borrowedBook = BookSingleton::borrowBook();
		if($this->borrowedBook == null){
			$this->haveBook = false;
		}else{
			$this->haveBook = true;
		}
	}

	function returnBook(){
		$this->borrowedBook->returnBook($this->borrowedBook);
	}
}

/*
* Initialization
*/

writeln('LET THE TESTING BEGIN! TESTING SINGLETON PATTERN');
writeln('');

$bookBorrower1 = new BookBorrower();
$bookBorrower2 = new BookBorrower();

$bookBorrower1->borrowBook();
writeln('BookBorrower1 asked to borrow the book');
writeln('BookBorrower1 Author and Title: ');
writeln($bookBorrower1->getAuthorAndTitle());

$bookBorrower2->borrowBook();
writeln('BookBorrower2 asked to borrow the book');
writeln('BookBorrower2 Author and Title: ');
writeln($bookBorrower2->getAuthorAndTitle());

$bookBorrower1->returnBook();
writeln('BookBorrower1 returned the book');

$bookBorrower2->borrowBook();
writeln('BookBorrower2 Author and Title: ');
writeln($bookBorrower1->getAuthorAndTitle());
writeln('');

writeln('END TESTING SINGLETON PATTERN');

function writeln($line_in){
	echo $line_in . '<br />';
}


?>