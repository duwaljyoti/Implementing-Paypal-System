<?php
// namespace Repository;
class BookRepository
{
    /**
     * @param Books $books
     */
    public function __construct(Books $books)
    {
        $this->book = $books;
    }
    /**
     * @return mixed
     */
    public function dispAllBooks()
    {
        return $this->book->get();
    }

    /**
     * @param $single_book_id
     * @return mixed
     */
    public function displaySingleBook($single_book_id)
    {
        return $this->book->where('id', '=', $single_book_id)->get();
    }
    /**
     * @return mixed
     */
    public function searchBook()
    {
        return $this->book->where('BooKName', 'LIKE', '%' . Input::get('search_item') . '%')->get();
    }

    /**
     * @return int
     */
    public function editOrAddBookDetailsRepo()
    {
        $new_book_detail = new Books;
        $ToBeUpdatedId = Input::get('id');
        if (isset($ToBeUpdatedId)) {
            $new_book_detail = Books::find($ToBeUpdatedId);
            //$new_book_detail= $this->book->where('id','=',$ToBeUpdatedId); doesnot work
        }

        $new_book_detail->BookName = Input::get('new_book_name');
        $new_book_detail->BookAuthor = Input::get('new_author_name');
        $new_book_detail->bookCategory = Input::get('new_category_name');
        $new_book_detail->availability = Input::get('new_avail');
        $new_book_detail->grade = Input::get('new_grade');
        $new_book_detail->save();
        return 0;
    }

}
