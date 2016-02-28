<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

// Route::get('/','MainController@index');
// Route::post('/store','MainController@store');

Route::get('/logout', 'UserController@LogOut');
Route::get('/register', 'MainController@Register');
Route::get('/login', 'UserController@Login');
Route::post('/store', 'UserController@store');
Route::get('/', 'MainController@home');
Route::get('/admin', 'MainController@admin');
Route::get('/edit/category/{cat_id}', function ($cat_id) {
    $bookscategories_details = Bookscategories::where('id', '=', $cat_id)->get();
    $bookscategories_details_array = $bookscategories_details->toArray();
    return View::make('edit')->with('bookcategories_detail', $bookscategories_details_array);
});
Route::get('/edit_book/book/{book_id}', function ($book_id) {
    $books_details = Books::where('id', '=', $book_id)->get();
    $books_details_array = $books_details->toArray();
    return View::make('edit_book')->with('books_detail', $books_details_array);
});
Route::get('/delete/category/{cat_id}', function ($cat_id) {
    $books_categories_to_be_deleted = Bookscategories::find($cat_id);
    $books_categories_to_be_deleted->delete();
    return Redirect::back();
});
Route::get('/add_new/{field} ', function ($field) {
    if ($field == "Category") {
        return View::make('add', ['field' => $field]);
    }
});
Route::get('/single_book/{single_book_id}', function ($single_book_id) {
    return App::make('MainController')->dispSingleBook($single_book_id);
});
Route::post('/change', 'MainController@change');
Route::post('/add', 'MainController@add');
Route::post('/login', 'UserController@store');
Route::post('/issue_book', 'MainController@issue_book');
Route::post('/search ', 'MainController@search');
Route::get('/category/{cat_name} ', function ($cat_name) {
    return App::make('MainController')->browseWithCat($cat_name);
});
Route::get('/all_books', 'MainController@all_books');
Route::get('/add_books_admin', 'MainController@admin_add_books');
Route::get('/sign_up', 'UserController@signUp');

// Route::post('/sign_up_new_user', 'UserController@signUpNewUser');
Route::get('/final_sign_up', 'UserController@signUpUserRepo');
Route::post('/edit_book_details', 'MainController@edit_book_details');
Route::post('/add_books', 'MainController@add_books');
Route::get('/demo', 'Demo@demo');

// Mail Part

Route::get('/forgetPass', 'MailController@index');
Route::post('/sendDemo', 'MailController@sendEmailDemo');
// Route::get('/pulic/changePass/{userid}', function ($userId) {
//     $users = User::where('id', '=', $userId)->get();
//     return View::make('Mail/resetPass')->with("userInfo", $users);
// });
Route::get('/reset/{userId} ', function ($userId) {
    $userInfo = User::where('id', '=', $userId)->get();
    return View::make('Mail/resetPass', ['userId' => $userId, 'userDetails' => $userInfo]);
});
Route::post('/resetPassword', 'UserController@resetPassword');
