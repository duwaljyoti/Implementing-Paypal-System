
<?php
class BookIssueRepository
{
    /**
     * @param BooksIssued $book_issued
     */
    public function __construct(BooksIssued $book_issued)
    {
        $this->book_issued = $book_issued;
    }

    public function listAllBookIssues()
    {
        $this->book_issued->get();
    }
    /**
     * @param $user
     * @return mixed
     */
    public function getBooksIssuedByUser($user)
    {
        $books_issued_data = $this->book_issued->where('username', '=', $user)->get();
        return $book_issued->toArray();
    }
    /**
     * @return int
     */
    public function issueBooksRepo()
    {
        $dt = date("Y-m-d ");
        $new_book_issue = new BooksIssued;
        $new_book_issue->book_id = Input::get('book_id');
        $new_book_issue->student_name = Session::get('username');
        $new_book_issue->issued_date = date("Y-m-d ");
        $new_book_issue->to_return_date = date("Y-m-d ", strtotime("$dt +7 day"));
        $new_book_issue->save();
        return 1;
    }

}
