<?php 
// namespace Repository;
	class BookCategoryRepository{
		public function __construct(Bookscategories $books_categories){
			$this->book_cat=$books_categories;
		}
		public function disp_all_categories(){
			return $this->book_cat->get();			
		}
		public function change_single_book_detail($book_id,$new_updated_cat_name){
			$new_book_cat_name=$this->book_cat->find($book_id);
			$new_book_cat_name->categories=$new_updated_cat_name;
			return $new_book_cat_name->save();
		}
		public function add_category_field($new_category_name){
			$this->book_cat->categories=$new_category_name;
			return $this->book_cat->save();
		}
		public function browse_with_cat_repo($category_name){
			return Books::where('bookCategory','=',$category_name)->get();
		}





	}