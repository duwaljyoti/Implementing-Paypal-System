<?php

class Demo extends BaseController {

	public function __construct(  BookRepository  $book){
		$this->book=$book;
	}
	public function demo(){
		$book=$this->book->disp_demo();
		dd($book);
		// $book=$this->book->disp_all();
		// echo count($book);
		// dd($book);
	}
}