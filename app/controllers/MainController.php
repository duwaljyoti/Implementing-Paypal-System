<?php
phpversion();

class MainController extends \BaseController
{
    /**
     * @param BookRepository $book
     * @param BookCategoryRepository $bookscategories
     * @param BookIssueRepository $bookissued
     */
    public function __construct(BookRepository $book, BookCategoryRepository $bookscategories, BookIssueRepository $bookissued)
    {
        $this->book = $book;
        $this->book_categories = $bookscategories;
        $this->book_issued = $bookissued;
    }
    /**
     * @return mixed
     */
    public function index()
    {
        $logged_user = Session::get('username');
        return $logged_user;
        return View::make('admin_home');
        if (isset($logged_user)) {
            return View::make('admin_home');
        } else {
            echo "No users with such credential..<p>First Login";
            return View::make('login');
        }
    }
    public function home()
    {
        $logged_user = Session::get('username');
        foreach ($this->book->disp_all_books() as $dates) {
            var_dump($dates['to_return_date'] < '2016-06-26 00:00:00');
            $demo_date = new DateTime($dates['to_return_date']);
            echo $dates['to_return_date'] . "<P>";
        }
        $data = array('BookCatList' => $this->book_categories->disp_all_categories(), 'LatestBook' => $this->book->disp_all_books(), 'AllBooks' => $this->book->disp_all_books(), 'logged_user' => $logged_user);
        return View::make('home')->with($data);
    }
    public function admin()
    {
        $data = array('BookCatList' => $this->book_categories->disp_all_categories(), 'LatestBook' => $this->book->disp_all_books(), 'AllBooks' => $this->book->disp_all_books());
        return View::make('admin_home')->with($data);
    }

    public function change()
    {;
        $this->book_categories->change_single_book_detail(Input::get('id'), Input::get('new_cat_name'));
        return Redirect::action('MainController@admin');
    }
    public function add()
    {
        $this->book_categories->add_category_field(Input::get('new_category_name'));
        return Redirect::action('MainController@admin');
    }
    public function Register()
    {
        $user = Session::get('user');
        return View::make('register');
    }

    /**
     * @param $book_id
     */
    public function dispSingleBook($book_id)
    {
        $logged_user = Session::get('username');
        $book_complete_detail = $this->book->display_single_book($book_id);
        $matchThese = ['book_id' => $book_id, 'student_name' => $logged_user];
        $user_check = BooksIssued::where($matchThese)->get();
        $book_issued = count($user_check);
        $data_to_be_sent = array();
        $user_check = BooksIssued::where('student_name', '=', $logged_user)->get();
        $issued_date_1 = $user_check->toArray();
        $issued_date = $return_date = date('y m d');
        foreach ($issued_date_1 as $key => $value) {
            $issued_date = $value['issued_date'];
            $return_date = $value['to_return_date'];
        }
        $data_to_be_sent['issued_date'] = $issued_date;
        $data_to_be_sent['return_date'] = $return_date;
        $data_to_be_sent['total_book_issued'] = count($user_check);
        $data_to_be_sent['user_check'] = $book_issued;

        $data_to_be_sent['single_book_detail'] = Books::find($book_id);
        return View::make('disp_single_book', ['complete_data' => $data_to_be_sent]);
    }
    public function issueBook()
    {

        $book_issue_test = $this->book_issued->issue_books_repo();
        if ($book_issue_test == 1) {
            return Redirect::back();
        } else {
            echo "<p>Some Error ocurred while issuing book";
        }

    }

    public function search()
    {
        $search_book_result = $this->book->search_book();
        $search_data = array();
        $search_data['search_item'] = Input::get('search_item');
        $search_data['search_book_result'] = $search_book_result;
        return View::make('search_page', ['search_data' => $search_data]);
    }
    /**
     * @param $cat_name
     */
    public function browseWithCat($cat_name)
    {
        $book = array();
        $book_result = $this->book_categories->browse_with_cat_repo($cat_name);
        $book['result'] = $book_result->toArray();
        $book['cat_name'] = $cat_name;
        return View::make('browse_with_cat', ['book' => $book]);
    }
    public function allBooks()
    {
        $all_books = $this->book->disp_all_books();
        return View::make('all_books', ['all_books_data' => $all_books]);
        // return View::make('all_books',['all_books_data'=>$this->book->disp_all_books()]);
    }
    public function adminAddBooks()
    {
        $all_avail_cat = $this->book_categories->disp_all_categories();
        $i = 0;
        $category_all = array();
        foreach ($all_avail_cat as $category) {
            $category_all[$i] = $category->categories;
            $i++;
        }
        return View::make('admin_add_books', ['all_cats' => $category_all]);
    }

    public function editBookDetails()
    {

        $new_book_detail = $this->book->edit_or_add_book_details_repo();
        echo "<script>alert('Your Changes Have Been applied')</script>";
        return Redirect::action('MainController@admin');
    }
    public function addBooks()
    {
        $this->book->edit_or_add_book_details_repo();
        echo "<script>alert('Your Changes Have Been applied')</script>";
        return Redirect::action('MainController@admin');

    }
}
