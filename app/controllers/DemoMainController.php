<?php

class DemoMainController extends \BaseController {
	public function index(){
	$logged_user = Session::get('username');
	return $logged_user; 
	  return View::make('admin_home');	
		if (isset($logged_user))
		 {
		 	echo "here  fm admin";
		 	return View::make('admin_home');
		}
		else 
		{
			echo "no users with such credential";
			echo "<p>First Login";
			return View::make('login');
		}

	}
	public function home(){
			$BooksCategories=DB::table('bookscategories')->get();
			$LatestBook= DB::table('books')->orderBy('id', 'desc')->take(5)->get();
			$AllBooks=DB::table('books')->get();
			$logged_user=Session::get('username');
			$get_all_dates=BooksIssued::where('student_name','=',$logged_user)->get()->toArray();
			foreach($get_all_dates as $dates){
				var_dump($dates['to_return_date'] < '2016-06-26 00:00:00');
				$demo_date=new DateTime($dates['to_return_date']);
				echo $dates['to_return_date']."<P>";
			}
			$data=array('BookCatList'=>$BooksCategories,'LatestBook'=>$LatestBook,'AllBooks'=>$AllBooks,'logged_user'=>$logged_user);
			return View::make('home')->with($data);
	}
	public function admin(){
			$BooksCategories=DB::table('bookscategories')->get();
			$LatestBook= DB::table('books')->orderBy('id', 'desc')->take(5)->get();
			$AllBooks=DB::table('books')->get();
			$data=array('BookCatList'=>$BooksCategories,'LatestBook'=>$LatestBook,'AllBooks'=>$AllBooks);
			return View::make('admin_home')->with($data);
	}
	public function LogOut(){
		Session::forget('username');
		return View::make('login');
	}
	public function sign_up_validator(){
		$sign_up_user_validation=Validator::make(Input::all(),['name'=>'required','username'=>'required|unique:users','password'=>'required','grade'=>'required','faculty'=>'required']);
		if ($sign_up_user_validation->passes()){
			$user= New User;
			$user->name=Input::get('name');
			$user->username=Input::get('username');
			$user->password=Input::get('password');//Hash::make(Input::get('password'));
			$user->grade=Input::get('grade');
			$user->faculty=Input::get('faculty');
			$user->save();
			echo "<script>alert('You Made it..Sign with Your credentials')</script>";
			return View::make('login');
		}
		else 
			return Redirect::back()->withInput()->withErrors($messages = $sign_up_user_validation->messages());
	}
	public function store(){
		$user_validation = Validator::make(Input::all(),['username'=>'required','password'=>'required']);	
		if ($user_validation->passes())
		{
			$user=New User;
			$user->username=Input::get('username');
			$user->password=Input::get('password');
			$users = DB::table('users')
                    ->where('username', '=', $user->username)
                    ->Where('password', '=',$user->password)
                    ->get();
              if((count($users))==0) {
              	return View::make('login',['login_failed_message'=>"<P>Please Login with authentic values"]);   
              } 
              else {
              	$logged_user = Session::get('username'); 
              	var_dump($logged_user);
              	$this->index();
              	Session::put('username', $user->username);
              	if ($user->username=='adminlaravel')
              	return Redirect::action('MainController@admin');
              else 
              {
              	return Redirect::action('MainController@home');
              }
              }
		}
		else return Redirect::back()->withInput()->withErrors($messages = $user_validation->messages());
		
	}
	public function change(){
		$new_updated_name= Input::get('new_cat_name');
		$ToBeUpdatedId=Input::get('id');
		$change = bookscategories::find($ToBeUpdatedId);
		$change->categories = $new_updated_name;
		$change->save();
		if ($change->save()==true){
			echo "<script>alertYour Changes Have Been applied</script>";
			return Redirect::action('MainController@admin');
		}
		else return "<p>We Encountered some problems";		
	}
	public function add(){
		$ToBeAdded=Input::get('field');
		if ($ToBeAdded=="category")
		{
			$AddNew=new bookscategories;
			$AddNew->categories=Input::get('new_category_name');
			$AddNew->save();
			return Redirect::action('MainController@admin');
		}
		else
		{

		}	
	}
	public  function Register(){
		$user=Session::get('user');
		return View::make('register');
	}
	public function Login(){
		return View::make('login');
	}
	public function AdminLogin(){
		return View::make('login');
	}
	public function disp_single_book($disp_single_book)

	{

		$logged_user=Session::get('username');
		$single_book_detail= Books::find($disp_single_book);
		$book_detail=$single_book_detail->toArray();
		$book_id=($book_detail['id']);
		$matchThese=['book_id'=>$book_id,'student_name'=>$logged_user];
		$user_check=BooksIssued::where($matchThese)->get();
		$user_book_issue_data=$user_check->toArray(['issued_date']);
		$book_issued=count($user_check);
		$data_to_be_sent=array();
		$user_check=BooksIssued::where('student_name','=',$logged_user)->get();
		$issued_date_1=$user_check->toArray();
		$issued_date=$return_date=date('y m d');
		foreach($issued_date_1 as $key=>$value){
			$issued_date=$value['issued_date'];
			$return_date=$value['to_return_date'];
		}
		$data_to_be_sent['issued_date']=$issued_date;
		$data_to_be_sent['return_date']=$return_date;
		$data_to_be_sent['total_book_issued']=count($user_check);
		$data_to_be_sent['user_check']=$book_issued;
		$data_to_be_sent['single_book_detail']=Books::find($disp_single_book);
		return View::make('disp_single_book',['complete_data'=>$data_to_be_sent]);
	}
	public function issue_book(){


		$dt = date("Y-m-d ");
		 date( "Y-m-d", strtotime( "$dt +7 day" ) ); // PHP:  2009-03-04

		$book_id=Input::get('book_id');
		$session_username=Session::get('username');
		$new_book_issue= new BooksIssued;
		$new_book_issue->book_id=$book_id;
		$new_book_issue->student_name=$session_username;
		$new_book_issue->issued_date=date("Y-m-d ");
		$new_book_issue->to_return_date=date( "Y-m-d ", strtotime( "$dt +7 day" ) );
		$new_book_issue->save();
		return Redirect::back();	
	}
	public function search(){
		$search_item=Input::get('search_item');
		$search_book_result=Books::where('BooKName', 'LIKE', '%'.$search_item.'%')->get();
		$search_data=array();
		$search_data['search_item']=$search_item;
		$search_data['search_book_result']=$search_book_result;
		return View::make('search_page',['search_data'=>$search_data]);
	}
	public function browse_with_cat($cat_name){
		$book=array();
		$book_result=Books::where('bookCategory','=',$cat_name)->get();
		$book['result']=$book_result->toArray();
		$book['cat_name']=$cat_name;

		return View::make('browse_with_cat',['book'=>$book]);
	}
	public function all_books(){
		$all_books=Books::get();
		return View::make('all_books',['all_books_data'=>$all_books]);
	}
	public function admin_add_books(){
		$all_avail_cat=Bookscategories::get();
		$i=0;
		$category_all=array();
		foreach($all_avail_cat as $category){
			  $category_all[$i]=$category->categories;
			$i++;			
		}

			return View::make('admin_add_books',['all_cats'=>$category_all]);
	}
	public function sign_up(){
		return View::make('sign_up');
	}
	public function edit_book_details(){
		$ToBeUpdatedId=Input::get('id');
		$new_book_name=Input::get('new_book_name');
		$new_cat_name=Input::get('new_category_name');;
		$new_author_name=Input::get('new_author_name');
		$new_avail=Input::get('new_avail');
		$grade=Input::get('new_grade');
		$new_book_detail= Books::find($ToBeUpdatedId);

		$new_book_detail->BookName=$new_book_name;
		$new_book_detail->BookAuthor=$new_author_name;
		$new_book_detail->bookCategory=$new_cat_name;
		$new_book_detail->availability=$new_avail;
		$new_book_detail->grade=$grade;
		$new_book_detail->save();
		if ($new_book_detail->save()==true){
			echo "<script>alert('Your Changes Have Been applied')</script>";
			return Redirect::action('MainController@admin');
		}
		else return "<p>We Encountered some problems";	
	}
	public function add_books(){
		$new_book_detail=new Books;
		$new_book_detail->BookName=Input::get('bookname');
		$new_book_detail->BookAuthor=Input::get('author');
		$new_book_detail->bookCategory=Input::get('category');
		$new_book_detail->availability=Input::get('availability');
		$new_book_detail->grade=Input::get('grade');
		$new_book_detail->save();
		if ($new_book_detail->save()==true){
			echo "<script>alert('Your Changes Have Been applied')</script>";
			return Redirect::action('MainController@admin');
		}
		else return "<p>We Encountered some problems";

	}
}