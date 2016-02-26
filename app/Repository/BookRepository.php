<?php 
// namespace Repository;
	class BookRepository{
		public function __construct(Books $books){
			$this->book=$books;
		}
		public function disp_all_books(){
			return $this->book->get();			
		}
		
		public function display_single_book($single_book_id){
				 return $this->book->where('id','=',$single_book_id)->get();
		}
		public function search_book(){
			return $this->book->where('BooKName', 'LIKE', '%'.Input::get('search_item').'%')->get();
		}

		public function edit_or_add_book_details_repo(){
			$new_book_detail=new Books;
			$ToBeUpdatedId=Input::get('id');
			if (isset($ToBeUpdatedId)){
				$new_book_detail= Books::find($ToBeUpdatedId);
			}
			
			$new_book_detail->BookName=Input::get('new_book_name');
			$new_book_detail->BookAuthor=Input::get('new_author_name');
			$new_book_detail->bookCategory=Input::get('new_category_name');
			$new_book_detail->availability=Input::get('new_avail');
			$new_book_detail->grade=Input::get('new_grade');
			$new_book_detail->save();
			return 0;
		}





	}